<?php
//新的订单
$order = $db->pe_select('order', array('order_state'=>'wpay'));

//新的充值
$order_pay = $db->pe_select('order_pay', array('order_state'=>'wpay'));

//新的回收订单
$order_recovery = $db->pe_select('order_recovery', array('status'=>0));

//新的提现
$cashout = $db->pe_select('cashout', array('cashout_state'=>0));

$result = [
    'order' => $order ? true : false,
    'recharge' => $order_pay ? true : false,
    'recovery' => $order_recovery ? true : false,
    'cashout' => $cashout ? true : false
];
pe_jsonshow($result);