<?php
switch($act) {
	//####################// 修改头像  //####################//
	case 'logo':
		$menumark = 'setting_logo';
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_logo');
		if (preg_match("/^http(s)?:\\/\\/.+/",$info['user_logo']))
		{
			$user_logo = $info['user_logo'];
		}
		else{
			$user_logo = pe_thumb($info['user_logo'], '_120', '_120', 'avatar');
		}
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_logo'=>pe_dbhold($_p_user_logo)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'提交成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'提交失败'));
			}
		}
		$seo = pe_seo($menutitle='修改头像');
		include(pe_tpl('setting_logo.html'));
	break;
	//####################// 登录密码修改  //####################//
	case 'pw':
		$menumark = 'setting_pw';
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!$db->pe_num('user', array('user_id'=>$_s_user_id, 'user_pw'=>md5($_p_user_oldpw)))) pe_jsonshow(array('result'=>false, 'show'=>'当前密码错误'));
			if (strlen($_p_user_pw) < 6 or strlen($_p_user_pw) > 20) pe_jsonshow(array('result'=>false, 'show'=>'新密码为6-20位字符'));
			if ($_p_user_pw != $_p_user_pw1) pe_jsonshow(array('result'=>false, 'show'=>'新密码与确认密码不一致'));
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_pw'=>md5($_p_user_pw)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$seo = pe_seo($menutitle='修改登录密码');
		include(pe_tpl('setting_pw.html'));
		
	break;
	//####################// 邮箱修改  //####################//
	case 'email':
		$menumark = 'setting_email';
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_email');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!pe_formcheck('email', $_p_user_email)) pe_jsonshow(array('result'=>false, 'show'=>'请填写正确的邮箱'));
			if ($db->pe_num('user', " and `user_email` = '".pe_dbhold($_p_user_email)."' and `user_id` != '{$_s_user_id}'")) pe_jsonshow(array('result'=>false, 'show'=>'邮箱已存在'));
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_email'=>pe_dbhold($_p_user_email)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$seo = pe_seo($menutitle='修改邮箱');
		include(pe_tpl('setting_email.html'));
	break;
	//####################// 手机号修改  //####################//
	case 'phone':
		$menumark = 'setting_phone';
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_phone');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!pe_formcheck('phone', $_p_user_phone)) pe_jsonshow(array('result'=>false, 'show'=>'请填写正确的手机号'));
			if ($db->pe_num('user', " and `user_phone` = '".pe_dbhold($_p_user_phone)."' and `user_id` != '{$_s_user_id}'")) pe_jsonshow(array('result'=>false, 'show'=>'手机号已存在'));
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_phone'=>pe_dbhold($_p_user_phone)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$seo = pe_seo($menutitle='修改手机号');
		include(pe_tpl('setting_phone.html'));
	break;
	//####################// 真实姓名修改  //####################//
	case 'tname':
		$menumark = 'setting_tname';
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_tname');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (strlen($_p_user_tname) < 2 or strlen($_p_user_tname) > 20) pe_jsonshow(array('result'=>false, 'show'=>'真实姓名2-8位字符'));
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_tname'=>pe_dbhold($_p_user_tname)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$seo = pe_seo($menutitle='修改真实姓名');
		include(pe_tpl('setting_tname.html'));
	break;

	//####################// 支付密码修改  //####################//
	case 'paypw':
		$menumark = 'setting_pw';
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($user['user_paypw'] && !$db->pe_num('user', array('user_id'=>$_s_user_id, 'user_paypw'=>md5($_p_user_oldpw)))) pe_jsonshow(array('result'=>false, 'show'=>'当前密码错误'));
			if (strlen($_p_user_pw) < 6 or strlen($_p_user_pw) > 20) pe_jsonshow(array('result'=>false, 'show'=>'新密码为6-20位字符'));
			if ($_p_user_pw != $_p_user_pw1) pe_jsonshow(array('result'=>false, 'show'=>'新密码与确认密码不一致'));
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_paypw'=>md5($_p_user_pw)))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$seo = pe_seo($menutitle='修改支付密码');
		include(pe_tpl('setting_paypw.html'));
	break;
    //####################// 收款账户 //####################//
    case 'userbank':
        $menumark = 'setting_userbank';
        $info_list = $db->pe_selectall('userbank', array('user_id'=>$_s_user_id, 'order by'=>'userbank_id desc'), '*', array(30, $_g_page));

        $tongji['all'] = $db->pe_num('userbank', array('user_id'=>$_s_user_id));
        $seo = pe_seo($menutitle='收款账户');
        include(pe_tpl('userbank_list.html'));
        break;
	//####################// 个人信息 //####################//
	default:
		$menumark = 'setting_base';
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_p_user_phone) {
				if (!pe_formcheck('phone', $_p_user_phone)) pe_jsonshow(array('result'=>false, 'show'=>'请填写正确的手机号'));
				if ($db->pe_num('user', " and `user_phone` = '".pe_dbhold($_p_user_phone)."' and `user_id` != '{$_s_user_id}'")) pe_jsonshow(array('result'=>false, 'show'=>'手机号已存在'));
			}
			if ($_p_user_email) {
				if (!pe_formcheck('email', $_p_user_email)) pe_jsonshow(array('result'=>false, 'show'=>'请填写正确的邮箱'));
				if ($db->pe_num('user', " and `user_email` = '".pe_dbhold($_p_user_email)."' and `user_id` != '{$_s_user_id}'")) pe_jsonshow(array('result'=>false, 'show'=>'邮箱已存在'));
			}
			$sql_set['user_tname'] = $_p_user_tname;
			$sql_set['user_phone'] = $_p_user_phone;
			$sql_set['user_email'] = $_p_user_email;
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), pe_dbhold($sql_set))) {
				pe_jsonshow(array('result'=>true, 'show'=>'修改成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败'));
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));				
		$seo = pe_seo($menutitle='个人信息');
		include(pe_tpl('setting_base.html'));
	break;
}
?>