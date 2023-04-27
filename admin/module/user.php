<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'user';
pe_lead('hook/user.hook.php');
$cache_userlevel = cache::get('userlevel');
$cache_userlevel_arr = cache::get('userlevel_arr');
switch ($act) {
		//####################// 代理操作 //####################//
	case 'agent_edit':
		$user_id = intval($_g_id);
		$agent = intval($_g_agent);
		pe_token_match();
		if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold(array('agent' => $agent)))) {
			pe_success('修改成功!', $_g_fromto);
		} else {
			pe_error('修改失败...');
		}
		break;
		//####################// 会员激活 //####################//
	case 'active':
		$user_id = intval($_g_id);
		pe_token_match();
		if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold(array('user_status' => 0)))) {
			pe_success('激活成功!', $_g_fromto);
		} else {
			pe_error('激活失败...');
		}
		break;
		//####################// 冻结余额 //####################//
	case 'frozen':
		$user_id = intval($_g_id);
		$frozen_money = intval($_g_money);
		pe_token_match();
		$info = $db->pe_select('user', array('user_id' => $user_id));
		$sql_frozen_money = $info['user_money_frozen'] + $frozen_money;
		if($sql_frozen_money < 0 ) pe_error('用户冻结余额不足');
		$sql_user_money = $info['user_money'] - $frozen_money;
		if($sql_user_money < 0 ) pe_error('用户剩余余额不足');

		if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold(array('user_money' => $sql_user_money, 'user_money_frozen' => $sql_frozen_money)))) {
			pe_success('冻结成功!', $_g_fromto);
		} else {
			pe_error('冻结失败...');
		}
		break;
		//####################// 会员冻结 //####################//
	case 'freeze':
		$user_id = intval($_g_id);
		pe_token_match();
		if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold(array('user_status' => 1)))) {
			pe_success('冻结成功!', $_g_fromto);
		} else {
			pe_error('冻结失败...');
		}
		break;
		//####################// 会员修改 //####################//
	case 'cart':
		$user_id = intval($_g_id);
		$cart = cart_list('all', $user_id);
		$info_list = $cart['all_list'];
		$info = $cart['money'];
		$seo = pe_seo($menutitle = '会员购物车', '', '', 'admin');
		include(pe_tpl('user_cart.html', 'admin'));
		break;
		//####################// 添加会员购物车 //####################//
	case 'cart_add':
		$user_id = intval($_g_id);
		$product_id = intval($_g_product_id);

		$prodata_list = $db->pe_selectall('prodata', array('product_id' => $product_id, 'order by' => 'product_order asc'), 'product_guid, product_ruleid, product_money, product_mmoney, product_num');
		foreach ($prodata_list as $k => $v) {
			$prodata_list[$k]['product_money'] = product_money($v['product_money']);
			//if ($info['product_money'] != $info['product_smoney']) $prorule_list[$k]['product_money'] = $info['product_money'];
			if (!$v['product_num']) unset($prodata_list[$k]);
		}
		$info = $db->pe_select('product', array('product_id' => $product_id));
		$data = [
			'cart_act' => 'cart',
			'cart_type' => 'fixed',
			'cart_atime' => time(),
			'product_id' => $product_id,
			'product_name' => $info['product_name'],
			'product_guid' => $prodata_list[0]['product_guid'],
			'product_rule' => $info['product_rule'],
			'product_logo' => $info['product_logo'],
			'product_money' => $prodata_list[0]['product_money'],
			'product_num' => 1,
			'user_id' => $user_id,
			'type' => 1,
		];
		$cart_id = $db->pe_insert('cart', $data);

		if (!$cart_id) pe_jsonshow(array('result' => false, 'show' => '异常请重新操作'));
		pe_jsonshow(array('result' => true, 'id' => $cart_id));
		break;	//####################// 添加会员购物车 //####################//
	case 'cart_edit':
		$cart_id = intval($_g_id);
		$product_num = intval($_g_num);
		$cart = $db->pe_select('cart', array('cart_id' => $cart_id));
		if ($product_num) {
			$product = product_buyinfo($cart['product_guid']);
			if (!$product['product_id']) pe_jsonshow(array('result' => false, 'show' => '商品下架或失效', 'num' => $product_num));
			if ($product['product_num'] < $product_num) pe_jsonshow(array('result' => false, 'show' => "库存仅剩{$product['product_num']}件", 'num' => $product['product_num']));
			if (!$db->pe_update('cart', array('cart_id' => $cart['cart_id']), array('product_num' => $product_num))) {
				pe_jsonshow(array('result' => false, 'show' => '修改失败', 'num' => $cart['product_num']));
			}
		} else {
			if (!$db->pe_delete('cart', array('cart_id' => $cart['cart_id']))) {
				pe_jsonshow(array('result' => false, 'show' => '删除失败', 'num' => $cart['product_num']));
			}
		}
		echo json_encode(array('result' => true, 'cart_num' => user_cartnum(), 'num' => $product_num));
		break;
		//####################// 商品列表 //####################//
	case 'product_list':
		$user_id = intval($_g_id);
		$cache_category = cache::get('category');
		$_g_category_id && $sqlwhere .= is_array($category_cidarr = category_cidarr($_g_category_id)) ? " and `category_id` in('" . implode("','", $category_cidarr) . "')" : " and `category_id` = '{$_g_category_id}'";
		$_g_brand_id && $sqlwhere .= " and `brand_id` = '{$_g_brand_id}'";
		$_g_name && $sqlwhere .= " and `product_name` like '%{$_g_name}%'";
		$sqlwhere .= " and `product_state` = 1";
		$sqlwhere .= " order by `product_order` asc, `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(30, $_g_page));
		$seo = pe_seo($menutitle = '选择商品', '', '', 'admin');
		include(pe_tpl('cart_product_list.html', 'admin'));
		break;
		//####################// 会员修改 //####################//
	case 'edit':
		$user_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_user_pw && $_p_info['user_pw'] = md5($_p_user_pw);
			$_p_user_paypw && $_p_info['user_paypw'] = md5($_p_user_paypw);
			$_p_tguser_name && $_p_info['tguser_name'] = $_p_tguser_name;
			if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold($_p_info))) {
				userlevel_callback($user_id);
				pe_success('修改成功!', $_g_fromto);
			} else {
				pe_error('修改失败...');
			}			
// 			if (!$tguser_name) pe_jsonshow(array('result' => false, 'show' => '用户不存在'));
		}
		$info = $db->pe_select('user', array('user_id' => $user_id));
		$seo = pe_seo($menutitle = '修改会员', '', '', 'admin');
		include(pe_tpl('user_add.html', 'admin'));
		break;
		//####################// 会员删除 //####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('user', array('user_id' => is_array($_p_user_id) ? $_p_user_id : intval($_g_id)))) {
			pe_success('会员删除成功!');
		} else {
			pe_error('会员删除失败...');
		}
		break;
		//####################// 充值(扣除)金额 //####################//
	case 'addmoney':
	case 'delmoney':
		$user_id = intval($_g_id);
		$info = $db->pe_select('user', array('user_id' => $user_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$type = $act == 'delmoney' ? 'del' : 'add';
			$user_money = pe_num($_p_money, 'floor', 1);
			if (!$user_id) pe_jsonshow(array('result' => false, 'show' => '用户不存在'));
			if ($user_money < 0.1) pe_jsonshow(array('result' => false, 'show' => '请填写金额'));
			if ($type == 'del' && $user_money > $info['user_money']) pe_jsonshow(array('result' => false, 'show' => '余额不足'));
			if (!$_p_text) pe_jsonshow(array('result' => false, 'show' => '请填写说明'));
			if (add_moneylog($user_id, $type, $user_money, $_p_text)) {
				pe_jsonshow(array('result' => true, 'show' => '操作成功'));
			} else {
				pe_jsonshow(array('result' => false, 'show' => '操作失败'));
			}
		}
		$cashout = $db->pe_select('cashout', array('user_id' => $user_id, 'cashout_state' => 0));
		$seo = pe_seo($menutitle = '充值(扣除)金额', '', '', 'admin');
		include(pe_tpl('user_addmoney.html', 'admin'));
		break;
		//####################// 增加(扣除)积分 //####################//
	case 'addpoint':
	case 'delpoint':
		$user_id = intval($_g_id);
		$info = $db->pe_select('user', array('user_id' => $user_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$type = $act == 'delpoint' ? 'del' : 'add';
			$user_point = intval($_p_point);
			if (!$user_id) pe_jsonshow(array('result' => false, 'show' => '用户不存在'));
			if ($user_point < 1) pe_jsonshow(array('result' => false, 'show' => '请填写积分'));
			if ($type == 'del' && $user_point > $info['user_point']) pe_jsonshow(array('result' => false, 'show' => '余额不足'));
			if (!$_p_text) pe_jsonshow(array('result' => false, 'show' => '请填写说明'));
			if (add_pointlog($user_id, $type, $user_point, $_p_text)) {
				pe_jsonshow(array('result' => true, 'show' => '操作成功'));
			} else {
				pe_jsonshow(array('result' => false, 'show' => '操作失败'));
			}
		}
		$seo = pe_seo($menutitle = '增加(扣除)积分', '', '', 'admin');
		include(pe_tpl('user_addpoint.html', 'admin'));
		break;
		//####################// 变更推荐人 //####################//
	case 'add_tguser':
		$user_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$user_name = pe_dbhold($_p_user_name);
			if ($user_name) {
				$tguser = $db->pe_select('user', array('user_name' => $user_name));
				if (!$tguser['user_id']) pe_jsonshow(array('result' => false, 'show' => '用户不存在'));
				if ($tguser['user_id'] == $user_id) pe_jsonshow(array('result' => false, 'show' => '推荐人不能为本人'));
				if ($tguser['tguser_id'] == $user_id) pe_jsonshow(array('result' => false, 'show' => '不能互相推荐'));
			} else {
				$tguser['user_id'] = 0;
				$tguser['user_name'] = '';
			}
			$sql_set['tguser_id'] = $tguser['user_id'];
			$sql_set['tguser_name'] = $tguser['user_name'];
			if ($db->pe_update('user', array('user_id' => $user_id), pe_dbhold($sql_set))) {
				$db->query("TRUNCATE TABLE  `" . dbpre . "tguser`");
				//推荐关系父子数组
				$tguser_arr = $db->index('tguser_id|user_id')->pe_selectall('user', " and tguser_id > 0", 'user_id, user_name, user_atime, tguser_id, tguser_name');
				$user_list = $db->pe_selectall('user', array('order by' => 'user_id asc'), 'user_id, user_name');
				foreach ($user_list as $v) {
					tguser_build($v['user_id'], $v);
				}
				//生成新的推荐记录
				/*tguser_link($tguser_id);
				foreach ($tguser_list as $v) {
					tguser_build($v['user_id'], $v, 1);
				}*/
				pe_jsonshow(array('result' => true, 'show' => '修改成功'));
			} else {
				pe_jsonshow(array('result' => false, 'show' => '修改失败'));
			}
		}
		$info = $db->pe_select('user', array('user_id' => $user_id));
		$seo = pe_seo($menutitle = '添加推荐人', '', '', 'admin');
		include(pe_tpl('user_add_tguser.html', 'admin'));
		break;
		//####################// 发送邮件 //####################//
	case 'email':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			!$_p_email_user && pe_error('收件人必须填写...');
			!$_p_email_name && pe_error('邮件标题必须填写...');
			!$_p_email_text && pe_error('邮件内容必须填写...');
			$email_user = explode(',', $_p_email_user);
			foreach ($email_user as $k => $v) {
				if (!$v) continue;
				$noticelog_list[$k]['noticelog_user'] = pe_dbhold($v);
				$noticelog_list[$k]['noticelog_name'] = pe_dbhold($_p_email_name);
				$noticelog_list[$k]['noticelog_text'] = $_p_email_text;
				$noticelog_list[$k]['noticelog_atime'] = time();
			}
			if ($db->pe_insert('noticelog', $noticelog_list)) {
				pe_success('发送成功!', '', 'dialog');
			} else {
				pe_error('发送失败...');
			}
		}
		$info_list = $db->pe_selectall('user', array('user_id' => explode(',', $_g_id)));
		$email_user = array();
		foreach ($info_list as $v) {
			$v['user_email'] && $email_user[] = $v['user_email'];
		}
		$seo = pe_seo($menutitle = '发送邮件', '', '', 'admin');
		include(pe_tpl('user_email.html', 'admin'));
		break;
		//####################// 会员登录 //####################//
	case 'addMsg':
		$idArr = explode(",", $_g_id);
		$data = [];
		foreach ($idArr as $key => $value) {
			$data[$key]['msg_text']  =  $_g_text;
			$data[$key]['msg_time']  =  date('Y-m-d H:i:s', time());
			$data[$key]['msg_user_id']  =  $value;
			$data[$key]['msg_state']  =  0;
			/* $data[]['msg_text'] = [
				'msg_text' => $_g_text,
				'msg_time' => date('Y-m-d H:i:s', time()),
				'msg_user_id' => $value,
				'msg_state' => 0
			]; */
		}
		if ($db->pe_insert('msg', $data)) {
			pe_jsonshow(array('result' => true, 'show' => '发送成功'));
		} else {
			pe_jsonshow(array('result' => false, 'show' => '发送失败'));
		}
		break;
		//####################// 会员登录 //####################//
	case 'login':
		pe_token_match();
		$user = $db->pe_select('user', array('user_id' => intval($_g_id)));
		$_SESSION['user_idtoken'] = md5($user['user_id'] . $pe['host_root']);
		$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['user_name'] = $user['user_name'];
		$_SESSION['user_ltime'] = $user['user_ltime'];
		$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
		pe_success('会员登录成功！', 'user.php');
		break;
		//####################// 会员列表 //####################//
	default:
		$_g_name && $sqlwhere .= " and `user_name` like '%{$_g_name}%'";
		$_g_phone && $sqlwhere .= " and `user_phone` like '%{$_g_phone}%'";
		$_g_email && $sqlwhere .= " and `user_email` like '%{$_g_email}%'";
		$_g_userlevel_id && $sqlwhere .= " and `userlevel_id` = '{$_g_userlevel_id}'";
		if (in_array($_g_orderby, array('ltime|desc', 'point|desc', 'ordernum|desc'))) {
			$orderby = explode('|', $_g_orderby);
			$sqlwhere .= " order by `user_{$orderby[0]}` {$orderby[1]}";
		} else {
			$sqlwhere .= " order by `user_id` desc";
		}
		$info_list = $db->pe_selectall('user', $sqlwhere, '*', array(50, $_g_page));

		$tongji['all'] = $db->pe_num('user');
		$tongji_arr = $db->index('userlevel_id')->pe_selectall('user', array('group by' => 'userlevel_id'), 'userlevel_id, count(1) as `num`');
		foreach ($cache_userlevel as $k => $v) {
			$tongji[$k] = intval($tongji_arr[$k]['num']);
		}
		$seo = pe_seo($menutitle = '会员列表', '', '', 'admin');
		include(pe_tpl('user_list.html', 'admin'));
		break;
}
//重建推层级表
function tguser_build($user_id, $tguser, $level = 1)
{
	global $db, $tguser_arr;
	if (is_array($tguser_arr[$user_id])) {
		foreach ($tguser_arr[$user_id] as $v) {
			$sql_set['tguser_id'] = $tguser['user_id'];
			$sql_set['tguser_name'] = $tguser['user_name'];
			$sql_set['tguser_level'] = $level;
			$sql_set['user_id'] = $v['user_id'];
			$sql_set['user_name'] = $v['user_name'];
			$sql_set['user_atime'] = $v['user_atime'];
			$db->pe_insert('tguser', pe_dbhold($sql_set));
			tguser_build($v['user_id'], $tguser, $level + 1);
		}
	}
}
//获取推荐关系链(已废弃)
/*function tguser_link($user_id) {
	global $db, $tguser_list, $tguser_arr;
	$info_list = $db->pe_selectall('user', array('tguser_id'=>$user_id));
	foreach ($info_list as $k=>$v) {
		$db->pe_delete('tguser', array('user_id'=>$v['user_id']));
		$tguser_list[$v['user_id']] = $v;
		$tguser_arr["{$v['tguser_id']}|{$v['user_id']}"] = $v;
		tguser_link($v['user_id']);
	}
}*/

function cart_list($cart_id = null, $user_id)
{
	global $db;
	$all_list = $del_list = array();
	if ($cart_id === 'all') {
		$sql_where['cart_act'] = 'cart';
	} else {
		$sql_where['cart_id'] = pe_dbhold($cart_id);
	}
	$sql_where['user_id'] = $user_id;
	$info_list = $db->pe_selectall('cart', pe_dbhold($sql_where));
	$cart_num = count($info_list);
	foreach ($info_list as $k => $v) {
		$error = null;
		$product_guid = intval($v['product_guid']);
		$product = product_buyinfo($product_guid);
		//未参团按原价购买
		if ($product['huodong_type'] == 'pintuan' && $v['cart_type'] != 'pintuan') $product['product_money'] = $product['product_smoney'];
		$buy['cart_id'] = $v['cart_id'];
		//检测商品是否失效或删除并格式化商品数据
		if ($product['product_id'] && $product['product_guid']) {
			$buy['product_id'] = $product['product_id'];
			$buy['product_guid'] = $product['product_guid'];
			$buy['product_name'] = $product['product_name'];
			$buy['product_rule'] = $product['product_rule'];
			$buy['product_logo'] = $product['product_logo'];
			$buy['product_money'] = $product['product_money'];
			$buy['product_maxnum'] = $product['product_num'];
			$buy['product_num'] = $v['product_num'];
			if (!$error && ($product['product_type'] == 'virtual' or $product['huodong_type'] == 'pintuan') && $cart_num > 1) {
				$error = array('show' => "只能单买", 'del' => true);
			}
			if (!$error && $v['cart_type'] == 'pintuan' && !pintuan_check($v['huodong_id'], $v['pintuan_id'])) {
				$error = array('show' => '拼团无效或结束', 'del' => true);
			}
			if (!$error && $buy['product_num'] > $buy['product_maxnum']) {
				$error = array('show' => "仅剩{$buy['product_maxnum']}件");
			}
		} else {
			$buy['product_id'] = $v['product_id'];
			$buy['product_guid'] = $v['product_guid'];
			$buy['product_name'] = $v['product_name'];
			$buy['product_rule'] = $v['product_rule'];
			$buy['product_logo'] = $v['product_logo'];
			$buy['product_money'] = $v['product_money'];
			$buy['product_maxnum'] = $v['product_num'];
			$buy['product_num'] = $v['product_num'];
			$error = array('show' => '下架或失效', 'del' => true);
		}
		$buy['product_money'] = product_money($buy['product_money']);
		$buy['product_allmoney'] = $buy['product_money'] * $buy['product_num'];
		$all_list[$product_guid] = $buy;
		$all_list[$product_guid]['error'] = $error;
		if ($error['del']) $del_list[$product_guid] = $all_list[$product_guid];
		$info['order_type'] = $v['cart_type'];
		$info['order_virtual'] = $product['product_type'] == 'virtual' ? 1 : 0;
		$info['order_name'][] = $product['product_name'];
		//$info['order_product_id'][] = $buy['product_id'];
		//$info['order_product_num'] += $buy['product_num'];
		$info['order_product_money'] += $buy['product_allmoney'];
		$info['order_wl_money'] += $product['product_wlmoney'];
		$info['order_point_get'] += $product['product_point'] * $v['product_num'];
		$info['huodong_id'] = $v['huodong_id'];
		$info['pintuan_id'] = $v['pintuan_id'];
	}
	//格式化显示数据
	$info['order_name'] = is_array($info['order_name']) ? implode(';', $info['order_name']) : '';
	//$info['order_product_id'] = is_array($info['order_product_id']) ? implode(',', $info['order_product_id']) : '';
	//$info['order_product_num'] = intval($info['order_product_num']);
	$info['order_product_money'] = pe_num($info['order_product_money'], 'round', 1, true);
	$info['order_wl_money'] = pe_num($info['order_wl_money'], 'round', 1, true);
	$info['order_money'] = pe_num($info['order_product_money'] + $info['order_wl_money'], 'round', 1, true);
	$info['order_point_get'] = intval($info['order_point_get']);
	return array('all_list' => $all_list, 'del_list' => $del_list, 'info' => $info);
}

//获取购买商品信息
function product_buyinfo($product_guid)
{
	global $db;
	$sql_field = "a.`product_id`, a.`product_guid`, a.`product_rule`, a.`product_money`, a.`product_smoney`, a.`product_num`, b.`product_name`, b.`product_type`, b.`product_logo`, b.`product_wlmoney`, b.`product_point`, b.`huodong_id`, b.`huodong_type`, b.`huodong_tag`, b.`huodong_stime`, b.`huodong_etime`,b.`user_ids`";
	$sql = "select {$sql_field} from `" . dbpre . "prodata` a, `" . dbpre . "product` b where a.`product_id` = b.`product_id` and a.`product_guid` = '{$product_guid}' and b.`product_state` = 1";
	$info = $db->sql_select($sql);
	return $info;
}

//获取用户活动时间内购买商品数量
function product_buynum($product_id, $user_id, $stime, $etime)
{
	global $db;
	$sql_field = "sum(a.`product_num`) as product_num";
	$sql = "select {$sql_field} from `" . dbpre . "orderdata` a, `" . dbpre . "order` b where a.`order_id` = b.`order_id` and a.`product_id` = {$product_id} and b.`user_id` = {$user_id} and (b.order_atime between {$stime} and {$etime})";
	$info = $db->sql_select($sql);
	return $info;
}

//商品价格
function product_money($money)
{
	global $user, $cache_userlevel;
	if ($user['user_id']) {
		$zhe = $cache_userlevel[$user['userlevel_id']]['userlevel_zhe'];
		$money = $zhe ? pe_num($money * $zhe, 'round', 1) : $money;
	}
	return $money;
}

//计算商品活动价
function huodong_money($huodong_money, $money, $type, $value)
{
	if ($huodong_money) return $huodong_money;
	if ($type == 'zhe') {
		$money = round($money * $value, 1);
	} else {
		$money = round($money - $value, 1);
	}
	return $money;
}

//订单商品规格显示
function order_skushow($product_rule)
{
	$html = '';
	if ($product_rule) {
		$product_rule = unserialize($product_rule);
		if ($product_rule) {
			foreach ($product_rule as $v) {
				$html .= "{$v['name']}：{$v['value']}；";
			}
		} else {
			$html .= '规格请联系客服选择';
		}
	}
	return trim($html, '；');
}
