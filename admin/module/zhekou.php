<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'zhekou';
pe_lead('hook/category.hook.php');
pe_lead('hook/product.hook.php');
$category_treelist = category_treelist();
$cache_brand = cache::get('brand');
switch ($act) {
		//####################// 弹窗成功且关闭 //####################//
	case 'success_and_close':
		pe_success('添加成功!');
		//####################// 添加优惠券 //####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (empty($_p_huodong_time)) {
				$_p_info['huodong_atime'] = time();
				$_p_info['huodong_stime'] = time();
				$_p_info['huodong_etime'] = time();
			} else {
				$timeArr = explode(" - ", $_p_huodong_time);
				$_p_info['huodong_atime'] = strtotime($timeArr[0]);
				$_p_info['huodong_stime'] = strtotime($timeArr[0]);
				$_p_info['huodong_etime'] = strtotime($timeArr[1]);
			}
			/* $_p_info['huodong_atime'] = $_p_info['huodong_atime'] ? strtotime($_p_info['huodong_atime']) : time();
			$_p_info['huodong_stime'] = $_p_info['huodong_stime'] ? strtotime($_p_info['huodong_stime']) : time();
			$_p_info['huodong_etime'] = $_p_info['huodong_etime'] ? strtotime($_p_info['huodong_etime']) : time(); */
			$_p_info['huodong_type'] = $_p_info['huodong_type'] ? $_p_info['huodong_type'] : 'zhekou';
			$product_ids = $_p_product_id;
			$zhes = $_p_product_zhe;
			$userIds = $_p_product_user_id;
			$product_zhe_counts = $_p_product_zhe_count;

			$huodong_id = $db->pe_insert('huodong', pe_dbhold($_p_info));

			if (is_array($product_ids)) {
				foreach ($product_ids as $k => $v) {
					$info = $db->pe_select('product', array('product_id' => $v));
					/* $sql_update['huodong_id'] = $huodong_id;
                    $sql_update['huodong_tag'] = $_p_info['huodong_tag'];
                    $sql_update['huodong_type'] = $_p_info['huodong_type'];
                    $sql_update['huodong_stime'] = $_p_info['huodong_stime'];
                    $sql_update['huodong_etime'] = $_p_info['huodong_etime'];
                    $db->pe_update('product', array('product_id'=>$v), pe_dbhold($sql_update));*/
					$sqlset['huodong_id'] = $huodong_id;
					$sqlset['huodong_tag'] = $_p_info['huodong_tag'];
					$sqlset['huodong_type'] = $_p_info['huodong_type'];
					$sqlset['huodong_stime'] = $_p_info['huodong_stime'];
					$sqlset['huodong_etime'] = $_p_info['huodong_etime'];
					$sqlset['product_id'] = $v;
					$sqlset['product_name'] = $info['product_name'];
					$sqlset['product_logo'] = $info['product_logo'];
					$sqlset['product_smoney'] = $info['product_smoney'];
					$sqlset['product_money'] = ($zhes[$v] / 10) * $info['product_smoney'];
					$sqlset['product_zhe'] = $zhes[$v];
					$sqlset['product_count'] = $product_zhe_counts[$v];
					$sqlset['product_ptnum'] = $info['product_ptnum'];
					$sqlset['product_user_id'] = $userIds[$v];
					$db->pe_insert('huodongdata', pe_dbhold($sqlset));
				}
			}
			pe_success('添加成功!', 'webadmin.php?mod=zhekou');
		}
		$info_list = array();
		$seo = pe_seo($menutitle = '限时折扣', '', '', 'admin');
		$activity_time_list = $db->pe_selectall('activity_time', array('is_deleted' => 0, 'is_active' => 1, 'order by' => 'id asc'));
		include(pe_tpl('zhekou_add.html', 'admin'));
		break;
		//####################// 优惠券修改 //####################//
	case 'edit':
		$huodong_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (empty($_p_huodong_time)) {
				$_p_info['huodong_stime'] = time();
				$_p_info['huodong_etime'] = time();
			} else {
				$timeArr = explode(" - ", $_p_huodong_time);
				$_p_info['huodong_stime'] = strtotime($timeArr[0]);
				$_p_info['huodong_etime'] = strtotime($timeArr[1]);
			}
			/* $_p_info['huodong_stime'] = $_p_info['huodong_stime'] ? strtotime($_p_info['huodong_stime']) : time();
			$_p_info['huodong_etime'] = $_p_info['huodong_etime'] ? strtotime($_p_info['huodong_etime']) : time(); */
			$_p_info['huodong_type'] = $_p_info['huodong_type'] ? $_p_info['huodong_type'] : 'zhekou';
			$product_ids = $_p_product_id;
			$zhes = $_p_product_zhe;
			$product_zhe_counts = $_p_product_zhe_count;
			$userIds = $_p_product_user_id;
			$db->pe_update('huodong', array('huodong_id' => $huodong_id), pe_dbhold($_p_info));
			//删除现有的折扣数据
			$db->pe_delete('huodongdata', array('huodong_id' => $huodong_id));
			if (is_array($product_ids)) {
				foreach ($product_ids as $k => $v) {
					$info = $db->pe_select('product', array('product_id' => $v));
					/*$sql_update['huodong_id'] = $huodong_id;
                    $sql_update['huodong_tag'] = $_p_info['huodong_tag'];
                    $sql_update['huodong_type'] = $_p_info['huodong_type'];
                    $sql_update['huodong_stime'] = $_p_info['huodong_stime'];
                    $sql_update['huodong_etime'] = $_p_info['huodong_etime'];
                    $db->pe_update('product', array('product_id'=>$v), pe_dbhold($sql_update));*/
					$sqlset['huodong_id'] = $huodong_id;
					$sqlset['huodong_tag'] = $_p_info['huodong_tag'];
					$sqlset['huodong_type'] = $_p_info['huodong_type'];
					$sqlset['huodong_stime'] = $_p_info['huodong_stime'];
					$sqlset['huodong_etime'] = $_p_info['huodong_etime'];
					$sqlset['product_id'] = $v;
					$sqlset['product_name'] = $info['product_name'];
					$sqlset['product_logo'] = $info['product_logo'];
					$sqlset['product_smoney'] = $info['product_smoney'];
					$sqlset['product_money'] = ($zhes[$v] / 10) * $info['product_smoney'];
					$sqlset['product_zhe'] = $zhes[$v];
					$sqlset['product_count'] = $product_zhe_counts[$v];
					$sqlset['product_ptnum'] = $info['product_ptnum'];
					$sqlset['product_user_id'] = $userIds[$v];
					$db->pe_insert('huodongdata', pe_dbhold($sqlset));
				}
			}
			pe_success('修改成功!', 'webadmin.php?mod=zhekou');
		}
		$info = $db->pe_select('huodong', array('huodong_id' => $huodong_id));
		$info['activity_time'] = date('Y-m-d H:i:s', $info['huodong_stime']) . ' - ' . date('Y-m-d H:i:s', $info['huodong_etime']);
		//读取关联的限定商品
		$info_list = $db->pe_selectall('huodongdata', array('huodong_id' => $huodong_id), '*');
		$seo = pe_seo($menutitle = '限时折扣', '', '', 'admin');
		$activity_time_list = $db->pe_selectall('activity_time', array('is_deleted' => 0, 'is_active' => 1, 'order by' => 'id asc'));
		include(pe_tpl('zhekou_add.html', 'admin'));
		break;
		//####################// 优惠券删除 //####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('huodong', array('huodong_id' => is_array($_p_huodong_id) ? $_p_huodong_id : $_g_id))) {
			$db->pe_delete('huodongdata', array('huodong_id' => is_array($_p_huodong_id) ? $_p_huodong_id : $_g_id));
			pe_success('删除成功!');
		} else {
			pe_error('删除失败...');
		}
		break;
		//####################// 向父窗口添加product //####################//
	case 'product_add':
		$product_id = intval($_g_id);
		if ($product_id) {
			$info = $db->pe_select('product', array('product_id' => $product_id));

			$html = "<tr class=\"js_product\" id=\"" . $info['product_id'] . "\" product_smoney=\"" . $info['product_smoney'] . "\"><td>" . $info['product_id'] . "<input type=\"hidden\" name=\"product_id[]\" value=\"" . $info['product_id'] . "\" /></td><td><img src=\"" . pe_thumb($info['product_logo'], 100, 100) . "\" width=\"40\" height=\"40\" class=\"imgbg\" \/></td><td class=\"aleft\"><a href=\"" . pe_url('product-' . $info['product_id']) . "\" target=\"_blank\" class=\"cblue\">" . $info['product_name'] . "</a></td><td>" . $info['product_money'] . "</td><td><input type=\"text\" name=\"product_zhe[" . $info['product_id'] . "]\" value=\"\" class=\"inputall input40 center js_zhe\" \/> 折</td><td><span class=\"js_money corg\">0</span></td><td><input name=\"product_zhe_count[" . $info['product_id'] . "]\" type=\"text\" class=\"inputall input40 js_sl\" \/></td><td><input value=\"0\" name=\"product_user_id[" . $info['product_id'] . "]\" type=\"text\" class=\"inputall input40 \" \/><a href=\"webadmin.php?mod=zhekou&act=user_list&id={$v['product_id']}\"
			onclick=\"return pe_dialog(this, '选择指定会员', 1000, 550)\" id=\"fabu\">选择会员</a></td><td><a href=\"javascript:;\" class=\"admin_btn\">删除</a></td></tr>";
			echo json_encode(array('html' => $html));
		} else {
			echo json_encode(array('html' => 'null'));
		}
		break;

		//####################// 会员列表 //####################//
	case 'user_list':
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

		$seo = pe_seo($menutitle = '选择会员', '', '', 'admin');
		include(pe_tpl('quan_user_list.html', 'admin'));
		break;
		//####################// 商品列表 //####################//
	case 'product_list':
		$cache_category = cache::get('category');
		$_g_category_id && $sqlwhere .= is_array($category_cidarr = category_cidarr($_g_category_id)) ? " and `category_id` in('" . implode("','", $category_cidarr) . "')" : " and `category_id` = '{$_g_category_id}'";
		$_g_brand_id && $sqlwhere .= " and `brand_id` = '{$_g_brand_id}'";
		$_g_name && $sqlwhere .= " and `product_name` like '%{$_g_name}%'";
		$sqlwhere .= " and `product_state` = 1";
		$sqlwhere .= " order by `product_order` asc, `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(30, $_g_page));
		$seo = pe_seo($menutitle = '选择商品', '', '', 'admin');
		include(pe_tpl('quan_product_list.html', 'admin'));
		break;

		//####################// 列表 //####################//
	default:
		$sqlwhere = " and `huodong_type`='zhekou'";
		$_g_name && $sqlwhere .= " and `huodong_name` like '%{$_g_name}%'";
		$sqlwhere .= " order by `huodong_id` desc";
		$info_list = $db->pe_selectall('huodong', $sqlwhere, '*', array(20, $_g_page));
		$tongji['all'] = $db->pe_num('huodong', $sqlwhere);
		$seo = pe_seo($menutitle = '限时折扣', '', '', 'admin');
		include(pe_tpl('zhekou_list.html', 'admin'));
		break;
}
