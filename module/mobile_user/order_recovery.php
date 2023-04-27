<?php
$menumark = 'order_recovery';
switch($act) {
    //####################// 获取订单 //####################//
    case 'order':
        $order_id = $_g_id;
        $order = $db->pe_select('order', array('order_id'=>$order_id, 'order_pstate' => 1));
        if(!$order){
            pe_jsonshow(array('code'=> 400, 'msg'=>'对不起，找不到您的可回收的订单'));
        }
        //判断是否可回收状态
        $orderdata = $db->pe_select('orderdata', array('order_id'=>$order_id));
        if($orderdata){
            $product  = $db->pe_select('product', array('product_id'=>$orderdata['product_id']),'product_r_day');
            if($product['product_r_day']){
                $product_r_day = $order['order_ptime'] + $product['product_r_day'] * 24 * 3600;
                if(time() < $product_r_day){
                    pe_jsonshow(array('code'=> 400, 'msg'=>'对不起，该订单'.pe_date($product_r_day).'后才可回收！'));
                }
            }
        }
        $order_recovery = $db->pe_select('order_recovery', array('order_id'=>$order_id));
        if($order_recovery){
            pe_jsonshow(array('code'=> 400, 'msg'=>'订单已回收了，不能再回收了'));
        }
        $orderdata = $db->pe_selectall('orderdata', array('order_id'=>$order_id),'product_id,product_num');
        if($orderdata){
            $product_rmoney = 0;
            foreach ($orderdata as $v){
                $product = $db->pe_select('product', array('product_id'=>$v['product_id']),'product_rmoney');
                $product_rmoney += bcmul($product['product_rmoney'],$v['product_num'],2);
            }
        }
        $res = [
            'code' => 200,
            'data' => [
                'user_name' => $order['user_name'],
                'user_tname' => $order['user_tname'],
                'money' => pe_num($product_rmoney,'round', 2, true)
            ]
        ];
        pe_jsonshow($res);
        break;
    //####################// 回收记录 //####################//
    case 'list':
        $recovery_list = $db->pe_selectall('order_recovery', array('user_id'=>$_s_user_id, 'order by'=>'`id` desc'), '*', array(20, $_g_page));
        $seo = pe_seo($menutitle='回收记录');
        include(pe_tpl('order_recovery_list.html'));
        break;
	//####################// 回收申请 //####################//
	default:
        if (isset($_p_pesubmit)) {
            $user_name = $_p_info['user_name'];
            $user_tname = $_p_info['user_tname'];
            $order_id = $_p_info['order_id'];
            $amount = $_p_info['amount'];
            $sql_set = [
                'user_id' => $_s_user_id,
                'user_tname' => $user_tname,
                'user_name' => $user_name,
                'amount' => $amount,
                'order_id' => $order_id
            ];
            if ($db->pe_insert('order_recovery', pe_dbhold($sql_set))) {
                pe_jsonshow(array('result'=>true, 'show'=>'申请已提交'));
            }
            else {
                pe_jsonshow(array('result'=>false, 'show'=>'提交失败'));
            }
        }else{
            $order_id = $_g_order_id;
            include(pe_tpl('order_recovery.html'));
        }
	break;
}
?>