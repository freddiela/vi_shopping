<?php
$menumark = 'user';
switch($act) {
	//####################// 修改地址 //####################//
	case 'edit':
		$userbank_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!in_array($_p_userbank_type, array('alipay', 'tenpay')) && !$_p_userbank_address) pe_error('请填写开户行');
			if (!$_p_userbank_num) pe_error('请填写收款帐号');
			if (!$_p_userbank_tname) pe_error('请填写收款人');
			$sql_set['userbank_type'] = $_p_userbank_type;
			$sql_set['userbank_name'] = $ini['userbank_type'][$_p_userbank_type];
			$sql_set['userbank_address'] = $_p_userbank_address;
			$sql_set['userbank_tname'] = $_p_userbank_tname;
			$sql_set['userbank_num'] = $_p_userbank_num;			
			if ($db->pe_update('userbank', array('userbank_id'=>$userbank_id), pe_dbhold($sql_set))) {
				pe_success('修改成功！', '', 'dialog');
			}
			else {
				pe_error('修改失败...');
			}
		}
		$info = $db->pe_select('userbank', array('userbank_id'=>$userbank_id));
		$seo = pe_seo($menutitle='修改地址');
		include(pe_tpl('userbank_add.html','admin'));
	break;
	//####################// 地址删除 //####################//
	case 'del':
		pe_token_match();
		$userbank_id = !empty($_p_userbank_id) ? $_p_userbank_id : $_g_userbank_id;
		if ($db->pe_delete('userbank', array('userbank_id'=>$userbank_id))) {
			pe_success('删除成功！');
		}
		else {
			pe_error('删除失败...');
		}
	break;
    //####################// 编辑 //####################//
    case 'edit_banknum':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $userbank_ids = $_p_userbank_id;
            $userbank_nums = $_p_userbank_num;
            $userbank_types = $_p_userbank_type;
            if(is_array($userbank_ids)){
                foreach ($userbank_ids as $k=>$v){
                    $db->pe_update('userbank', array('userbank_id'=>$v), pe_dbhold(array(
                        'userbank_num' => $userbank_nums[$v],
                        'userbank_type' => $userbank_types[$v],
                        'userbank_name' => $ini['userbank_type'][$userbank_types[$v]]
                    )));
                }
                pe_success('操作成功!', '', 'dialog');
            }
            pe_error('操作失败');
        }else{
            $user_id = $_g_id;
            $info_list = $db->pe_selectall('userbank', array('user_id'=>$user_id));
            include(pe_tpl('userbank_add.html','admin'));
        }
        break;
    //####################// 详细 //####################//
    case 'detail':
        $user_id = $_g_id;
        $list = $db->pe_selectall('userbank', array('user_id'=>$user_id));
        if ($list) {
            pe_jsonshow($list);
        }
        else {
            pe_jsonshow([]);
        }
        break;
	//####################// 地址列表 //####################//
	default:
		$_g_name && $sqlwhere .= " and `user_name` like '%{$_g_name}%'";
		$_g_tname && $sqlwhere .= " and `userbank_tname` like '%{$_g_tname}%'";
		$_g_num && $sqlwhere .= " and `userbank_num` like '%{$_g_num}%'";
		$_g_type && $sqlwhere .= " and `userbank_type` = '{$_g_type}'";
		$_g_user_id && $sqlwhere .= " and `user_id` = '{$_g_user_id}'";
		$sqlwhere .= " order by `userbank_id` desc";
		$info_list = $db->pe_selectall('userbank', $sqlwhere, '*', array(50, $_g_page));

		$tongji['user'] = $db->pe_num('user');
		$tongji['useraddr'] = $db->pe_num('useraddr');
		$tongji['userbank'] = $db->pe_num('userbank');
		$seo = pe_seo($menutitle='收货地址');
		include(pe_tpl('userbank_list.html','admin'));
	break;
}
?>