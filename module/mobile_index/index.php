<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
 
$cache_link = cache::get('link');

//网站公告
$notice_list = $db->pe_selectall('article', array('class_id'=>1,'order by'=>'`article_atime` desc'), '*', array(8));

//折扣商品
/* $product_zhekou = $db->pe_selectall('product', array('product_state'=>1, 'huodong_type'=>'zhekou', 'order by'=>'huodong_id asc'), '*', array(5)); */
$sql = "SELECT	* FROM hq_huodong hq JOIN hq_huodongdata hd ON hq.huodong_id = hd.huodong_id WHERE hd.huodong_type = 'zhekou' and hq.huodong_etime >" . time() . " order by product_money asc";
$product_zhekou = $db->sql_selectall($sql,  array(9999, $_g_page));
foreach ($product_zhekou as $key => $value) {
	$arr = explode(",", $value['product_user_id']);
	$product_zhekou[$key]['isUser'] = in_array($_s_user_id, $arr) || $value['product_user_id'] == 0 ? '1' : '0';
}

//推荐商品
//$product_newlist = product_newlist(5);

//分类商品
$category_indexlist = array();
foreach((array)$cache_category_arr[0] as $k=>$v) {
	$v['product_list'] = $db->pe_selectall('product', array('category_id'=>category_cidarr($v['category_id']), 'product_state'=>1, 'order by'=>'product_istuijian desc, product_order asc, product_id desc'), '*', array(8));
	$category_indexlist[] = $v;
}

//弹窗
$alert = $db->pe_select('article', array('is_alert'=>1));

if ($_s_user_id != null) {
	$msg  = $db->pe_select('msg', array('msg_user_id' => $_s_user_id, 'msg_state' => 0));
	$db->pe_update('msg', array('msg_id' => $msg['msg_id']), pe_dbhold(array('msg_state' => 1)));
}

$seo = pe_seo();
include(pe_tpl('index.html'));
?>