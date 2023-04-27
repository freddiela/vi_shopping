<?php
switch($act) {
	//####################// 我的收益 //####################//
	case 'list':	
	$menumark = 'tg_list';
    $day = strtotime(date('Y-m-d'));
    $mon = strtotime(date('Y') . '-' . date('m') . '-1');
	$tongji['all'] = $db->pe_num('tguser', array('tguser_id'=>$_s_user_id));
	$tongji['mon'] = $db->pe_num('tguser', " and `tguser_id` = '{$_s_user_id}' and `user_atime` >= '{$day}'"); 
	$tongji['day'] = $db->pe_num('tguser', " and `tguser_id` = '{$_s_user_id}' and `user_atime` >= '{$mon}'"); 
	
	$money['all'] = $db->pe_select('moneylog', array('user_id'=>$_s_user_id,'moneylog_type'=>'tg'), 'sum(moneylog_in) as `money`');
	$money['mon'] = $db->pe_select('moneylog', " and `user_id` = '{$_s_user_id}' and `moneylog_type` = 'tg' and `moneylog_atime` >= '{$mon}'", 'sum(moneylog_in) as `money`'); 
	$money['day'] = $db->pe_select('moneylog', " and `user_id` = '{$_s_user_id}' and `moneylog_type` = 'tg' and `moneylog_atime` >= '{$day}'", 'sum(moneylog_in) as `money`'); 
	
	
	
		$info_list = $db->pe_selectall('moneylog', array('user_id'=>$_s_user_id,'moneylog_type'=>'tg',  'order by'=>'moneylog_id desc'), '*', array(30, $_g_page));
		$tongji['all'] = $db->pe_num('moneylog', array('user_id'=>$_s_user_id,'moneylog_type'=>'tg'));
		$seo = pe_seo($menutitle='我的收益');
		include(pe_tpl('tg_list.html'));
	break;
	//####################// 邀请好友 //####################//
	default:
	    pe_lead('hook/user.hook.php');
		$menumark = 'tg';
		$info_list = $db->pe_selectall('tguser', array('tguser_id'=>$_s_user_id,'order by'=>'user_atime desc'), '*', array(30, $_g_page));
		foreach ($info_list as $k => $v) {
				$info_list[$k]['money_cost'] = $db->pe_selectall('user', array('user_id'=>$v['user_id']));
			}	
		$tongji['all'] = $db->pe_num('tguser', array('tguser_id'=>$_s_user_id));//user_money_cost//
		$seo = pe_seo($menutitle='邀请好友');
		include(pe_tpl('tg.html'));
	break;
}
?>