<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'money_deposit';
switch ($act) {
        //####################// 规则添加 //####################//
    case 'add':
        if (isset($_p_pesubmit)) {
            pe_token_match();

            $_p_info['deposit_rate'] = pe_num($_p_info['deposit_rate'] / 100, 'floor', 5);
           // var_dump($_p_info);
            if ($db->pe_insert('money_deposit', pe_dbhold($_p_info))) {
                pe_success('添加成功!', 'webadmin.php?mod=money_deposit');
            } else {
                pe_error('添加失败...');
            }
        }
        $seo = pe_seo($menutitle = '添加规则', '', '', 'admin');
        include(pe_tpl('money_deposit_add.html', 'admin'));
        break;
        //####################// 规则修改 //####################//
    case 'edit':
        $deposit_id = intval($_g_id);
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $_p_info['deposit_rate'] = pe_num($_p_info['deposit_rate'] / 100, 'floor', 5);
            if ($db->pe_update('money_deposit', array('deposit_id' => $deposit_id), pe_dbhold($_p_info))) {

                pe_success('修改成功!', 'webadmin.php?mod=money_deposit');
            } else {
                pe_error('修改失败...');
            }
        }
        $info = $db->pe_select('money_deposit', array('deposit_id' => $deposit_id));
        $seo = pe_seo($menutitle = '修改规则', '', '', 'admin');
        include(pe_tpl('money_deposit_add.html', 'admin'));
        break;
        //####################// 等级删除 //####################//
    case 'del':
        pe_token_match();
        $deposit_id = is_array($_p_deposit_id) ? $_p_deposit_id : intval($_g_id);
        if ($db->pe_delete('money_deposit', array('deposit_id' => $deposit_id))) {
            pe_success('删除成功!');
        } else {
            pe_error('删除失败...');
        }
        break;

        //####################// 资金明细 //####################//
    default:
        $sql_where .= ' order by deposit_id desc';
        $info_list = $db->pe_selectall('money_deposit', $sql_where, '*', array(50, $_g_page));
        $seo = pe_seo($menutitle = '余额宝设置');
        include(pe_tpl('money_deposit.html', 'admin'));
        break;
}
