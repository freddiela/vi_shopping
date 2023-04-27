<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'pintuan';
pe_lead('hook/category.hook.php');
pe_lead('hook/product.hook.php');
$category_treelist = category_treelist();
$cache_brand = cache::get('brand');
switch ($act) {
	//####################// 添加拼团 //####################//
	case 'add':
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
			$_p_info['huodong_type'] = $_p_huodong_type ? $_p_huodong_type : 'pintuan';

            $product_ids = $_p_product_id;
            $product_moneys = $_p_product_money;
            $product_ptnums = $_p_product_ptnum;
			$userIds = $_p_product_user_id;
			$huodong_id = $db->pe_insert('huodong', pe_dbhold($_p_info));
			if($huodong_id && is_array($product_ids)){
                foreach($product_ids as $k=>$v){
                    $info = $db->pe_select('product', array('product_id'=>$v));
                    $sqlset['huodong_id'] = $huodong_id;
                    $sqlset['huodong_tag'] = $_p_info['huodong_tag'];
                    $sqlset['huodong_type'] = $_p_info['huodong_type'];
                    $sqlset['huodong_stime'] = $_p_info['huodong_stime'];
                    $sqlset['huodong_etime'] = $_p_info['huodong_etime'];
                    $sqlset['product_id'] = $v;
                    $sqlset['product_name'] = $info['product_name'];
                    $sqlset['product_logo'] = $info['product_logo'];
                    $sqlset['product_smoney'] = $info['product_smoney'];
                    $sqlset['product_money'] = $product_moneys[$v];
                    $sqlset['product_ptnum'] = $product_ptnums[$v];
					$sqlset['product_user_id'] = $userIds[$v];
                    $db->pe_insert('huodongdata', pe_dbhold($sqlset));
                }
			}
			pe_success('添加成功!', 'webadmin.php?mod=pintuan');
		}
        $info_list = array();
		$seo = pe_seo($menutitle='限时拼团', '', '', 'admin');
        $activity_time_list = $db->pe_selectall('activity_time', array('is_deleted'=>0,'is_active' => 1,'order by' => 'id asc'));
		include(pe_tpl('pintuan_add.html','admin'));
	break;
	//####################// 拼团修改 //####################//
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
			$_p_info['huodong_type'] = $_p_huodong_type ? $_p_huodong_type : 'pintuan';

            $product_ids = $_p_product_id;
            $product_moneys = $_p_product_money;
            $product_ptnums = $_p_product_ptnum;
			$userIds = $_p_product_user_id;
			$db->pe_update('huodong',array('huodong_id'=>$huodong_id), pe_dbhold($_p_info));
			//删除现有的折扣数据
			$db->pe_delete('huodongdata',array('huodong_id'=>$huodong_id));
            if(is_array($product_ids)){
                foreach($product_ids as $k=>$v){
                    $info = $db->pe_select('product', array('product_id'=>$v));
                    $sqlset['huodong_id'] = $huodong_id;
                    $sqlset['huodong_tag'] = $_p_info['huodong_tag'];
                    $sqlset['huodong_type'] = $_p_info['huodong_type'];
                    $sqlset['huodong_stime'] = $_p_info['huodong_stime'];
                    $sqlset['huodong_etime'] = $_p_info['huodong_etime'];
                    $sqlset['product_id'] = $v;
                    $sqlset['product_name'] = $info['product_name'];
                    $sqlset['product_logo'] = $info['product_logo'];
                    $sqlset['product_smoney'] = $info['product_smoney'];
                    $sqlset['product_money'] = $product_moneys[$v];
                    $sqlset['product_ptnum'] = $product_ptnums[$v];
					$sqlset['product_user_id'] = $userIds[$v];
                    $db->pe_insert('huodongdata', pe_dbhold($sqlset));
                }
            }
			pe_success('修改成功!', 'webadmin.php?mod=pintuan');
		}
		$info = $db->pe_select('huodong', array('huodong_id'=>$huodong_id));
		$info['activity_time'] = date('Y-m-d H:i:s', $info['huodong_stime']) . ' - ' . date('Y-m-d H:i:s', $info['huodong_etime']);
		//读取关联的限定商品
		$info_list = $db->pe_selectall('huodongdata', array('huodong_id'=>$huodong_id),'*');
        $activity_time_list = $db->pe_selectall('activity_time', array('is_deleted'=>0,'is_active' => 1,'order by' => 'id asc'));
		$seo = pe_seo($menutitle='限时拼团', '', '', 'admin');
		include(pe_tpl('pintuan_add.html','admin'));
	break;
	//####################// 拼团删除 //####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('huodong', array('huodong_id'=>is_array($_p_huodong_id) ? $_p_huodong_id : $_g_id))) {
			$db->pe_delete('huodongdata',array('huodong_id'=>is_array($_p_huodong_id) ? $_p_huodong_id : $_g_id));
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	
	//####################// 向父窗口添加product //####################//
	case 'product_info':
		$product_id = intval($_g_id);
		if($product_id){
			$info = $db->pe_select('huodongdata', array('huodong_id'=>$product_id));
			$info_list=json_encode($info);
			echo "{\"info_list\":[".$info_list."]}";
		}
	break;

	

	//####################// 向父窗口添加product //####################//
	case 'product_add':
		$product_id = intval($_g_id);
		if($product_id){
			$info = $db->pe_select('product', array('product_id'=>$product_id));
			$html = '<tr class="js_product" id="'.$info['product_id'].'">
						<td>'.$info['product_id'].'<input type="hidden" name="product_id[]" value="'.$info['product_id'].'" /></td>
						<td><img src="'.pe_thumb($info['product_logo'], 100, 100).'" width="40" height="40" class="imgbg" /></td>
						<td class="aleft"><a href="'.pe_url('product-'.$info['product_id']).'" target="_blank" class="cblue">'.$info['product_name'].'</a></td>
						<td>'.$info['product_smoney'].'</td>
						<td><input type="text" name="product_money['.$info['product_id'].']" value="'.$info['product_money'].'" class="inputall input100 center" /></td>
						<td><input type="text" name="product_ptnum['.$info['product_id'].']" value="'.$info['product_ptnum'].'" class="inputall input100 center" /></td>
						<td>
						<input type="text" name="product_user_id['.$info['product_id'].']" value="0" class="inputall input40 center" />
						<a href="webadmin.php?mod=zhekou&act=user_list&id={$v[\'product_id\']}"
							onclick="return pe_dialog(this, \'选择指定会员\', 1000, 550)" id="fabu">选择会员</a>
						</td>
						<td><a href="javascript:;" class="admin_btn">删除</a></td>
					</tr>';
            echo json_encode(array('html'=>$html));
		}else{
            echo json_encode(array('html'=>'null'));
		}
	break;
	
	
	//####################// 商品列表 //####################//
	case 'product_list':
		$cache_category = cache::get('category');
		$_g_category_id && $sqlwhere .= is_array($category_cidarr = category_cidarr($_g_category_id)) ? " and `category_id` in('".implode("','", $category_cidarr)."')" : " and `category_id` = '{$_g_category_id}'";
		$_g_brand_id && $sqlwhere .= " and `brand_id` = '{$_g_brand_id}'";
		$_g_name && $sqlwhere .= " and `product_name` like '%{$_g_name}%'";
		$sqlwhere .= " and `product_state` = 1";
		$sqlwhere .= " order by `product_order` asc, `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(30, $_g_page));
		$seo = pe_seo($menutitle='选择商品', '', '', 'admin');
		include(pe_tpl('pintuan_product_list.html','admin'));
	break;
	
	//####################// 列表 //####################//
	default :
        $sqlwhere = " and `huodong_type`='pintuan'";
		$_g_name && $sqlwhere .= " and `huodong_name` like '%{$_g_name}%'";
		$sqlwhere .= " order by `huodong_id` desc";
		$info_list = $db->pe_selectall('huodong', $sqlwhere, '*', array(20, $_g_page));
		$tongji['all'] = $db->pe_num('huodong', $sqlwhere);
		
		$seo = pe_seo($menutitle='限时拼团', '', '', 'admin');
		include(pe_tpl('pintuan_list.html','admin'));
	break;
}
?>