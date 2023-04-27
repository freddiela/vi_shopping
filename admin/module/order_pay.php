<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'order_pay';
switch ($act) {
    //####################// 确认充值 //####################//
    case 'confirm_recharge':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $_p_info['order_pstate'] = 1;
            $_p_info['order_state'] = 'success';
            $_p_info['order_ptime'] = strtotime($_p_info['order_ptime']);
            if ($db->pe_update('order_pay', array('order_id'=>$_p_info['order_id']), pe_dbhold($_p_info))) {
                $order_pay = $db->pe_select('order_pay', array('order_id'=>$_p_info['order_id']),'order_money,user_id,order_payment_name');
                pe_lead('hook/user.hook.php');
                add_moneylog($order_pay['user_id'], 'recharge', $order_pay['order_money'], "充值成功，支付方式【{$order_pay['order_payment_name']}】，单号【{$_p_info['order_id']}】");
                pe_success('确认充值成功!', '', 'dialog');
            }
            else {
                pe_error('确认充值失败');
            }
        }else{
            $order_id = $_g_id;
            include(pe_tpl('order_pay_confirm.html','admin'));
        }
        break;
    //####################// 充值失败 //####################//
    case 'fail_recharge':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $_p_info['order_pstate'] = 0;
            $_p_info['order_state'] = 'failed';
            if ($db->pe_update('order_pay', array('order_id'=>$_p_info['order_id']), pe_dbhold($_p_info))) {
                pe_success('操作成功!', '', 'dialog');
            }
            else {
                pe_error('操作失败');
            }
        }else{
            $order_id = $_g_id;
            include(pe_tpl('order_pay_fail.html','admin'));
        }
        break;
	//####################// 充值记录 //####################//
	default:
		$_g_id && $sql_where .= " and `order_id` = '{$_g_id}'";
		$_g_state && $sql_where .= " and `order_state` = '{$_g_state}'";
		$_g_user_name && $sql_where .= " and `user_name` like '%{$_g_user_name}%'";
		$sql_where .= ' order by `order_id` desc';

		$info_list = $db->pe_selectall('order_pay', $sql_where, '*', array(50, $_g_page));
		$tongji_arr = $db->index('order_state')->pe_selectall('order_pay', array('group by'=>'order_state'), 'count(1) as `num`, `order_state`');
		foreach (array('wpay', 'success','failed') as $v) {
			$tongji[$v] = intval($tongji_arr[$v]['num']);
			$tongji['all'] += $tongji[$v]; 
		}	
		
		$seo = pe_seo($menutitle='充值记录');
		include(pe_tpl('order_pay_list.html','admin'));
	break;
}
?>