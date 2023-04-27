<?php

$menumark = 'order_recovery';
switch ($act) {
        //####################// 编辑 //####################//
    case 'del':
        pe_token_match();
        $id = intval($_p_id);
        if ($db->pe_delete('order_recovery', array('id' => $id), pe_dbhold(['is_deleted' => 1]))) {
            pe_success('删除成功!', $_g_fromto);
        } else {
            pe_error('删除失败...');
        }
        break;
        //####################// 编辑 //####################//
    case 'edit':
        if (isset($_p_pesubmit)) {
            pe_token_match();
            $id = intval($_p_info['id']);
            if ($db->pe_update('order_recovery', array('id' => $id), pe_dbhold($_p_info))) {
                pe_success('修改成功!', $_g_fromto);
            } else {
                pe_error('修改失败...');
            }
        }
        break;
        //####################// 审核通过 //####################//
    case 'auditsuccess':
        pe_lead('hook/user.hook.php');
        pe_token_match();
        $id = intval($_p_id);
        if ($db->pe_update('order_recovery', array('id' => $id), pe_dbhold(['status' => 2, 'audit_at' => date('Y-m-d H:i:s')]))) {
            $info = $db->pe_select('order_recovery', array('id' => $id), 'id,amount,user_id');
            add_moneylog($info['user_id'], 'recovery', $info['amount'], "订单回收,回收单号【{$info['id']}】");
            pe_success('回收成功!', $_g_fromto);
        } else {
            pe_error('回收失败...');
        }
        break;
        //####################// 审核失败 //####################//
    case 'auditfailed':
        pe_token_match();
        $id = intval($_p_id);
        $reason = $_p_reason;
        $sql_set = [
            'reason' => $reason,
            'status' => 1,
            'audit_at' => date('Y-m-d H:i:s')
        ];
        if ($db->pe_update('order_recovery', array('id' => $id), pe_dbhold($sql_set))) {
            pe_success('拒绝回收成功!', $_g_fromto);
        } else {
            pe_error('拒绝回收失败...');
        }
        break;
        //####################// 批量操作 //####################//
    case 'batchhandler':
        pe_token_match();
        $items = $_p_items;
        $reason = $_p_reason;
        $type = $_p_type;
        if (empty($items)) {
            pe_error('未选中订单');
        }
        $sql_set = [
            'status' => $type,
            'audit_at' => date('Y-m-d H:i:s')
        ];
        if ($type == 1) {
            $sql_set['reason'] = $reason;
        }
        foreach ($items as $v) {
            $arr_id[] = $v['id'];
        }
        $ids = implode(',', $arr_id);
        if ($db->pe_update('order_recovery', " and id in({$ids}) ", pe_dbhold($sql_set))) {
            if ($type == 2) {
                pe_lead('hook/user.hook.php');
                foreach ($items as $v) {
                    add_moneylog($v['userid'], 'recovery', $v['amount'], "订单回收,回收单号【{$v['id']}】");
                }
            }
            pe_success('批量操作成功!', $_g_fromto);
        } else {
            pe_error('批量操作成功...');
        }
        break;
        //####################// 订单列表 //####################//
    default:
        /* $sql_where .= " order by `id` desc"; */
        $orderby_arr['amount|desc'] = '回收金额（多到少）';
        $orderby_arr['amount|asc'] = '回收金额（少到多）';
        $orderby_arr['created_at|desc'] = '创建时间（新到旧）';
        $orderby_arr['created_at|asc'] = '创建时间（旧到新）';

        if (empty($_g_orderby)) $_g_orderby = 'id|asc';
        $orderby = explode('|', $_g_orderby);
        $info_list = $db->pe_selectall('order_recovery', array('is_deleted' => 0, 'order by' => "{$orderby[0]} {$orderby[1]}"), '*', array(30, $_g_page));

        $tongji[0]['all'] = $db->pe_num('order_recovery');

        $seo = pe_seo($menutitle = '订单回收', '', '', 'admin');
        include(pe_tpl('order_recovery_list.html', 'admin'));
        break;
}
