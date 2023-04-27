<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'comment_fake';
pe_lead('hook/product.hook.php');
switch ($act) {
        //####################// 计划修改 //####################//
    case 'plan_edit':
        $deposit_id = intval($_g_id);
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $db->pe_delete('comment_fake_specific', array('cfs_plan_id' => $deposit_id));
            $product_ids = $_p_product_id;
            $zhes = $_p_product_zhe;
            $product_zhe_counts = $_p_product_zhe_count;
            $planData = [
                'cfp_comment_sum' => count($product_zhe_counts),
                'cfp_goods_num' => count($zhes),
            ];
            $db->pe_update('comment_fake_plan', array('cfp_id' => $deposit_id), $planData);
            if (is_array($product_ids)) {
                foreach ($product_ids as $k => $v) {
                    $sqlset['cfs_product_id'] = $v;
                    $sqlset['cfs_cf_id'] = $product_zhe_counts[$v];
                    $sqlset['cfs_time'] = $zhes[$v];
                    $sqlset['cfs_state'] = 0;
                    $sqlset['cfs_plan_id'] = $deposit_id;

                    $db->pe_insert('comment_fake_specific', pe_dbhold($sqlset));
                }
            }
            pe_success('修改成功!');
        }

        $info_list = $db->sql_selectall("select * from `hq_comment_fake_specific` s join `hq_product` p on p.`product_id` = s.`cfs_product_id` where s.`cfs_plan_id` = " . $deposit_id);
        $seo = pe_seo($menutitle = '修改计划', '', '', 'admin');
        include(pe_tpl('comment_fake_plan_add.html', 'admin'));
        break;
        //####################// 删除计划 //####################//
    case 'plan_del':

        pe_token_match();
        $deposit_id = is_array($_p_deposit_id) ? $_p_deposit_id : intval($_g_id);
        if ($db->pe_delete('comment_fake_plan', array('cfp_id' => $deposit_id))) {
            $db->pe_delete('comment_fake_specific', array('cfs_plan_id' => $deposit_id));
            pe_success('删除成功!');
        } else {
            pe_error('删除失败...');
        }
        break;
        //####################// 添加计划 //####################//
    case 'comment_plan_add':

        if (isset($_p_pesubmit)) {
            $product_ids = $_p_product_id;
            $zhes = $_p_product_zhe;
            $product_zhe_counts = $_p_product_zhe_count;
            $planInfo = $db->pe_select('comment_fake_plan', array('order by' => 'cfp_id desc'));
            $planData = [
                'cfp_comment_sum' => count($product_zhe_counts),
                'cfp_goods_num' => count($zhes),
            ];
            $db->pe_insert('comment_fake_plan', pe_dbhold($planData));
            if (is_array($product_ids)) {
                foreach ($product_ids as $k => $v) {
                    $sqlset['cfs_product_id'] = $v;
                    $sqlset['cfs_cf_id'] = $product_zhe_counts[$v];
                    $sqlset['cfs_time'] = $zhes[$v];
                    $sqlset['cfs_state'] = 0;
                    $sqlset['cfs_plan_id'] = $planInfo['cfp_id'] + 1;

                    $db->pe_insert('comment_fake_specific', pe_dbhold($sqlset));
                }
            }
            pe_success('添加成功!', 'webadmin.php?mod=comment_fake');
        }
        $seo = pe_seo($menutitle = '添加计划', '', '', 'admin');
        $info_list = array();
        include(pe_tpl('comment_fake_plan_add.html', 'admin'));
        break;
        //####################// 添加评价内容 //####################//
    case 'comment_del':

        pe_token_match();
        if ($db->pe_delete('comment_fake', array('cf_id' => $_p_id))) {
            pe_success('删除成功!');
        } else {
            pe_error('删除失败...');
        }

        break;
        //####################// 添加评价内容 //####################//
    case 'comment_edit':
        pe_token_match();
        $data = [
            'cf_comment_star' => $_p_info['cf_comment_star'],
            'cf_comment_text' => $_p_info['cf_comment_text']
        ];
        if ($db->pe_update('comment_fake', array('cf_id' => $_p_info['cf_id']), pe_dbhold($data))) {
            pe_success('修改成功!');
        } else {
            pe_error('修改失败...');
        }
        break;
        //####################// 添加评价内容 //####################//
    case 'comment_add':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $data = [
                'cf_comment_star' => $_p_comment_star,
                'cf_comment_text' => $_p_comment_text
            ];
            if ($db->pe_insert('comment_fake', pe_dbhold($data))) {
                pe_success('添加成功!');
            } else {
                pe_error('添加失败...');
            }
        }
        $seo = pe_seo($menutitle = '添加计划', '', '', 'admin');
        include(pe_tpl('comment_fake_comment_add.html', 'admin'));
        break;
        //####################// 添加计划 //####################//
    case 'add':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            if ($db->pe_insert('activity_time', pe_dbhold($_p_info))) {
                pe_success('添加成功!', 'webadmin.php?mod=activity_time');
            } else {
                pe_error('添加失败...');
            }
        }
        $seo = pe_seo($menutitle = '添加计划', '', '', 'admin');
        include(pe_tpl('comment_fake_add.html', 'admin'));
        break;
        //####################// 向父窗口添加product //####################//
    case 'product_add':
        $product_id = intval($_g_id);
        if (empty($_g_time)) {
            $time = date("Y-m-d H:i:s", strtotime('+100 s', time()));
        } else {
            $timeArr = explode(" - ", $_g_time);
            $time = date('Y-m-d H:i:s', mt_rand(strtotime($timeArr[0]), strtotime($timeArr[1])));
        }

        if (empty($_g_commentFakeId)) {
            $list  = $db->pe_selectall('comment_fake');
            $key = mt_rand(1, count($list));
            $commentFakeId = $list[$key - 1]['cf_id'];
        } else {
            $commentFakeId = $_g_commentFakeId;
        }
        if ($product_id) {

            $info = $db->pe_select('product', array('product_id' => $product_id));

            $html = "<tr class=\"js_product\" id=\"" . $info['product_id'] . "\" product_smoney=\"" . $info['product_smoney'] . "\"><td>" . $info['product_id'] . "<input type=\"hidden\" name=\"product_id[]\" value=\"" . $info['product_id'] . "\" /></td><td><img src=\"" . pe_thumb($info['product_logo'], 100, 100) . "\" width=\"40\" height=\"40\" class=\"imgbg\" \/></td><td class=\"aleft\"><a href=\"" . pe_url('product-' . $info['product_id']) . "\" target=\"_blank\" class=\"cblue\">" . $info['product_name'] . "</a></td><td><input type=\"text\" name=\"product_zhe[" . $info['product_id'] . "]\" value=\"" . $time . "\" class=\"inputall input200 center js_zhe\" \/></td><td><input value='" . $commentFakeId . "' name=\"product_zhe_count[" . $info['product_id'] . "]\" type=\"text\" class=\"inputall input40 js_sl\" \/></td><td><a href=\"javascript:;\" class=\"admin_btn\">删除</a></td></tr>";
            echo json_encode(array('html' => $html));
        } else {
            echo json_encode(array('html' => 'null'));
        }
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
        include(pe_tpl('comment_fake_plan_product_list.html', 'admin'));
        break;
        //####################// 评价列表 //####################//
    default:
        if (empty($_g_star)) {
            $info_list = $db->pe_selectall('comment_fake_plan', array('order by' => 'cfp_id asc'));
            $seo = pe_seo($menutitle = '评价计划', '', '', 'admin');
            include(pe_tpl('comment_fake_list.html', 'admin'));
            break;
        } else {
            $info_list = $db->pe_selectall('comment_fake', array('order by' => 'cf_id asc'));
            $seo = pe_seo($menutitle = '评价计划', '', '', 'admin');
            include(pe_tpl('comment_fake_comment_list.html', 'admin'));
            break;
        }
}
