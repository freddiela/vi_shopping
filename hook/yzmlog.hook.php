<?php
function send_yzm($type, $user, $apitype = 'juhe') {
	global $db, $cache_setting;
	pe_lead('hook/qunfa.hook.php');
	$user = pe_dbhold($user);
	$yzm = rand(100000,999999);
	//$linshi_pw = substr(md5($pe['host_root'].$email.rand(1,9999).time()), 5, 6);
	if ($type == 'email') {
		$email['qunfa_name'] = "尊敬的{$user}用户，请查收您的验证码";	
		$email['qunfa_text'] = "尊敬的用户，您的邮箱验证码为：{$yzm}，验证码有效期为30分钟！请尽快验证，谢谢！";			
		$result = qunfa_email($user, $email);
	}
	else {
		//一分钟内最多发送3次
		$nowtime = time() - 60;
		$yzmnum = $db->pe_num("yzmlog", " and `yzmlog_user` = '{$user}' and `yzmlog_atime` >= '{$nowtime}'");
		if ($yzmnum >= 3) {
			return array('result'=>false, 'show'=>'您发送的太频繁了，请稍后再试');
		}
		//一天内未验证次数超过5次的手机号就不让再发送了
		$yzmnum = $db->pe_num("yzmlog", " and `yzmlog_user` = '{$user}' and `yzmlog_state` = 0 and `yzmlog_adate` >= '".date('Y-m-d')."'");
		if ($yzmnum >= 5) {
			return array('result'=>false, 'show'=>'您今日发送太多了，请明日再试');
		}
		//一天内未验证次数超过10次的ip就不让再发送了
		$yzmnum = $db->pe_num("yzmlog", " and `yzmlog_ip` = '".pe_ip()."' and `yzmlog_state` = 0 and `yzmlog_adate` >= '".date('Y-m-d')."'");
		if ($yzmnum >= 10) {
			return array('result'=>false, 'show'=>'您今日发送太多了，请明日再试');
		}
        $cache_notice = cache::get('notice');
        $notice = $cache_notice['user_register'];
        //file_put_contents('notice.log', "【".date('Y-m-d H:i:s')."】notice:\r\n".var_export($notice,true)."\r\n\r\n",FILE_APPEND);
        if ($notice['user']['notice_sms_state']) {
            $info_list['noticelog_type'] = 'sms';
            $info_list['noticelog_user'] = $user;
            $info_list['noticelog_name'] = '';
            $info_list['noticelog_text'] = "【{$cache_setting['sms_sign']}】".notice_tag_replace($notice['user']['notice_sms_text'], ['code'=>$yzm]);
            $info_list['noticelog_atime'] = time();
            //file_put_contents('notice.log', "【".date('Y-m-d H:i:s')."】sms_param:\r\n".$_SESSION['sms_param']."\r\n\r\n",FILE_APPEND);
            if(isset($_SESSION['sms_param'])){
                $sms_param = "{".rtrim($_SESSION['sms_param'],",")."}";
                $result = qunfa_sms($user, $sms_param,$notice['user']['notice_sms_templateid']);
                if($result){
                    $result = array('result'=>true, 'show'=>'发送成功');
                    $info_list['noticelog_state'] = 'success';
                    add_yzmlog($user, $yzm);
                }else{
                    $result = array('result'=>false, 'show'=>'发送失败');
                    $info_list['noticelog_state'] = 'fail';
                }
                unset($_SESSION['sms_param']);
                $sql_set[] = pe_dbhold($info_list);
                if (is_array($sql_set)) $db->pe_insert('noticelog', $sql_set);
            }
        }else{
            $result = array('result'=>false, 'show'=>'系统错误');
        }
	}
    return $result;
}

function check_yzm($user, $value, $update = 0) {
	global $db;
	$info = $db->pe_select("yzmlog", array('yzmlog_user'=>pe_dbhold($user), 'order by'=>'yzmlog_id desc'));
	if ($info['yzmlog_value'] != $value) {
		$db->pe_update("yzmlog", array('yzmlog_id'=>$info['yzmlog_id']), "`yzmlog_checknum` = `yzmlog_checknum` + 1");
		return false;
		//return array('result'=>false, 'show'=>'验证码错误');
	}
	if ($info['yzmlog_state']) {
		return false;
		//return array('result'=>false, 'show'=>'请勿重复使用');
	}
	if (time() - $info['yzmlog_atime'] >= 1800) {
		return false;
		//return array('result'=>false, 'show'=>'验证码已过期');
	}
	if ($info['yzmlog_checknum'] >= 20) {//超过20次就有软件破解嫌疑
		return false;		
	}
	if ($update) update_yzm($user, $value);
	return true;
	//return array('result'=>true, 'show'=>'验证码正确');
}

function update_yzm($user, $value) {
	global $db;
	$db->pe_update('yzmlog', array('yzmlog_user'=>pe_dbhold($user), 'yzmlog_value'=>pe_dbhold($value)), array('yzmlog_state'=>1));
}

function add_yzmlog($user, $yzm) {
	global $db;
	$sql_set['yzmlog_user'] = $user;
	$sql_set['yzmlog_value'] = $yzm;
	$sql_set['yzmlog_atime'] = time();
	$sql_set['yzmlog_adate'] = date('Y-m-d');
	$sql_set['yzmlog_ip'] = pe_ip();
	if ($db->pe_insert("yzmlog", $sql_set)) {
		return true;
	}
	else {
		return false;
	}
}
?>