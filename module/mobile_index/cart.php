<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
pe_lead('hook/order.hook.php');
$user_id = $user['user_id'] ? $user['user_id'] : pe_user_id();
switch ($act) {
	//####################// 购物车添加/立即购买 //####################//
	case 'add':
	case 'buy':
	case 'pintuan':
		$product_id = intval($_g_id);
		$product_guid = intval($_g_guid);
		$product_num = intval($_g_num);
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		//检测库存		
		$product = product_buyinfo($product_guid);
		if (!$product['product_id']) pe_jsonshow(array('result'=>false, 'show'=>'商品下架或失效'));
        //检测是否设置购买id
        if(!empty($product['user_ids'])){
            $user_ids = explode(',',$product['user_ids']);
            if(!in_array($user_id, $user_ids)){
                pe_jsonshow(array('result'=>false, 'show'=>"亲，你没抢到哦，请继续努力！！"));
            }
        }
        //检测是否限购
        if($product['huodong_type'] == 'zhekou'){
            //判断时间
            if($product['huodong_stime'] > time()){
                pe_jsonshow(array('result'=>false, 'show'=>"折扣时间还未开始！"));
            }
            //活动期间用户已购买数量
            $orderdata = product_buynum($product['product_id'],$user_id,$product['huodong_stime'],$product['huodong_etime']);
            if($orderdata){
                $buynum = $orderdata['product_num'] + $product_num;
            }else{
                $buynum = $product_num;
            }
            $huodongdata = $db->pe_select('huodongdata', array('huodong_id'=> $product['huodong_id'], 'product_id'=>$product['product_id']),'product_count');
            if($huodongdata && $huodongdata['product_count'] && (int)$buynum > (int)$huodongdata['product_count']){
                pe_jsonshow(array('result'=>false, 'show'=>"该商品每人限购{$huodongdata['product_count']}件"));
            }
        }
		if ($product['product_num'] < $product_num) pe_jsonshow(array('result'=>false, 'show'=>"库存仅剩{$product['product_num']}件"));
		//检测虚拟商品
		if ($act == 'add' && $product['product_type'] == 'virtual') pe_jsonshow(array('result'=>false, 'show'=>'不能加入购物车'));
		//检测拼团
		if ($act == 'add' && $product['huodong_type'] == 'pintuan') pe_jsonshow(array('result'=>false, 'show'=>'不能加入购物车'));
		if ($act == 'pintuan' && !pintuan_check($product['huodong_id'], $_g_pintuan_id)) pe_jsonshow(array('result'=>false, 'show'=>'拼团无效或结束'));
		$cart = $db->pe_select('cart', array('cart_act'=>'cart', 'user_id'=>$user_id, 'product_guid'=>$product_guid));
		if ($act == 'add' && $cart['cart_id']) {
			$sql_set['product_num'] = $cart['product_num'] + $product_num;
			if ($product['product_num'] < $sql_set['product_num']) pe_jsonshow(array('result'=>false, 'show'=>"库存仅剩{$product['product_num']}件"));		
			if (!$db->pe_update('cart', array('cart_id'=>$cart['cart_id']), $sql_set)) pe_jsonshow(array('result'=>false, 'show'=>'异常请重新操作'));	
			$cart_id = $cart['cart_id'];
		}
		else {
			$sql_set['cart_act'] = $act == 'add' ? 'cart' : 'buy';
			if ($act == 'pintuan') {
				$sql_set['cart_type'] = 'pintuan';			
				$sql_set['huodong_id'] = $product['huodong_id'];	
				$sql_set['pintuan_id'] = $_g_pintuan_id;	
			}
			else {
				$sql_set['cart_type'] = 'fixed';
			}
			$sql_set['cart_atime'] = time();
			$sql_set['product_id'] = $product['product_id'];
			$sql_set['product_guid'] = $product['product_guid'];
			$sql_set['product_name'] = $product['product_name'];
			$sql_set['product_rule'] = $product['product_rule'];
			$sql_set['product_logo'] = $product['product_logo'];
			$sql_set['product_money'] = $product['product_money'];
			$sql_set['product_num'] = $product_num;
			$sql_set['user_id'] = $user_id;
            if($product['huodong_id']){
                $sql_set['huodong_id'] = $product['huodong_id'];
            }
			$cart_id = $db->pe_insert('cart', pe_dbhold($sql_set, array('product_rule')));
			if (!$cart_id) pe_jsonshow(array('result'=>false, 'show'=>'异常请重新操作'));
		}
		pe_jsonshow(array('result'=>true, 'id'=>$cart_id, 'cart_num'=>user_cartnum()));
	break;
	//####################// 购物车修改(为零就删除吧) //####################//
	case 'edit':
		$cart_id = intval($_g_id);
		$product_num = intval($_g_num);
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		$cart = $db->pe_select('cart', array('cart_id'=>$cart_id, 'user_id'=>$user_id));		
		if ($product_num) {			
			$product = product_buyinfo($cart['product_guid']);
			if (!$product['product_id']) pe_jsonshow(array('result'=>false, 'show'=>'商品下架或失效', 'num'=>$product_num));
			if ($product['product_num'] < $product_num) pe_jsonshow(array('result'=>false, 'show'=>"库存仅剩{$product['product_num']}件", 'num'=>$product['product_num']));
			if (!$db->pe_update('cart', array('cart_id'=>$cart['cart_id']), array('product_num'=>$product_num))) {
				pe_jsonshow(array('result'=>false, 'show'=>'修改失败', 'num'=>$cart['product_num']));
			}
		}
		else {
			if (!$db->pe_delete('cart', array('cart_id'=>$cart['cart_id'],'type'=>0))) {
				pe_jsonshow(array('result'=>false, 'show'=>'删除失败', 'num'=>$cart['product_num']));
			}	
		}
		echo json_encode(array('result'=>true, 'cart_num'=>user_cartnum(), 'num'=>$product_num));
	break;
	//####################// 购物车列表 //####################//
	default:
		$product_table = $_g_table ? pe_dbhold($_g_table) : 'product';
		$cart = cart_list('all');
		$info_list = $cart['all_list'];
		$info = $cart['money'];
		if (isset($_p_pesubmit)) {
			if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
			$cart_id = is_array($_p_cart_id) ? $_p_cart_id : array();
			foreach ($info_list as $k=>$v) {
				if (!in_array($v['cart_id'], $cart_id)) continue;
				if ($v['error']) pe_jsonshow(array('result'=>false, 'show'=>"【{$v['error']['show']}】{$v['product_name']}"));
				$cart_arr[] = $v['cart_id'];		
			}
			if (!is_array($cart_arr)) pe_jsonshow(array('result'=>false, 'show'=>'请选择商品'));
			pe_jsonshow(array('result'=>true, 'id'=>implode(',', $cart_arr)));
		}
		$seo = pe_seo($menutitle='我的购物车');
		include(pe_tpl('cart_list.html'));
	break;
}
?>