<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
switch ($act) {
        //####################// 折扣列表 //####################//
    case 'zhekou':
        $sqlfield = " `product_id`,`product_name`,`product_logo`,`product_money`,`product_smoney`,`huodong_etime`,`huodong_stime`";
        /* $sql = "select ".$sqlfield." from (select * from ".dbpre."huodongdata order by product_money asc) as bb where `huodong_etime`>".time()." and `huodong_type`='zhekou'  group by product_id order by product_money asc";

		$info_list = $db->sql_selectall($sql,  array(9999, $_g_page)); */
        $sql = "SELECT	* FROM hq_huodong hq JOIN hq_huodongdata hd ON hq.huodong_id = hd.huodong_id WHERE hd.huodong_type = 'zhekou' and hq.huodong_etime >" . time() . " order by product_money asc";
        $info_list = $db->sql_selectall($sql,  array(9999, $_g_page));
        foreach ($info_list as $key => $value) {
            $arr = explode(",", $value['product_user_id']);
            $info_list[$key]['isUser'] = in_array($_s_user_id, $arr) || $value['product_user_id'] == 0 ? '1' : '0';
        }

        $nowpath = " > ";
        $menutitle = "限时折扣";
        $seo = pe_seo($menutitle);
        include(pe_tpl('huodong_zhekou.html'));
        break;

        //####################// 拼团列表 //####################//
    case 'pintuan':
        $sqlfield = " `product_id`,`product_name`,`product_logo`,`product_money`,`product_smoney`,`huodong_etime`,product_ptnum,`huodong_stime`";
        $sql = "select " . $sqlfield . " from (select * from " . dbpre . "huodongdata order by product_money asc) as bb where `huodong_etime`>" . time() . " and `huodong_type`='pintuan'  group by product_id order by huodong_stime DESC";

        $info_list = $db->sql_selectall($sql,  array(9999, $_g_page));
        foreach ($info_list as $key => $value) {
            $arr = explode(",", $value['product_user_id']);
            $info_list[$key]['isUser'] = in_array($_s_user_id, $arr) || $value['product_user_id'] == 0 ? '1' : '0';
        }
        $nowpath = " > ";
        $menutitle = "限时拼团";
        $seo = pe_seo($menutitle);
        include(pe_tpl('huodong_pintuan.html'));
        break;

        //####################// 套餐列表 //####################//
    case 'taocan':
        $sqlfield = "`huodong_id`, `huodong_desc`,`huodong_pic`,`huodong_price`";
        $sql = "select " . $sqlfield . " from " . dbpre . "huodong where `huodong_type`='taocan' order by huodong_id DESC";

        $info_list = $db->sql_selectall($sql,  array(9999, $_g_page));
        if (!empty($info_list)) {
            foreach ($info_list as $k => $v) {
                $huodongdata = $db->pe_selectall('huodongdata', array('huodong_id' => $v['huodong_id']), 'product_id,product_smoney');
                if (!empty($huodongdata)) {
                    foreach ($huodongdata as $h) {
                        $ids[$v['huodong_id']][] = $h['product_id'];
                        $product_money[$v['huodong_id']]['product_money'] += $h['product_smoney'];
                    }
                }
                $info_list[$k]['product_money'] = pe_num($product_money[$v['huodong_id']]['product_money'], 'round', 1, true);
                $info_list[$k]['product_id'] = implode(',', $ids[$v['huodong_id']]);
            }
        }
        //var_dump($info_list);

        $nowpath = " > ";
        $menutitle = "优惠套餐";
        $seo = pe_seo($menutitle);
        include(pe_tpl('huodong_taocan.html'));
        break;

        //####################// 折扣（领取） //####################//
    default:
}
