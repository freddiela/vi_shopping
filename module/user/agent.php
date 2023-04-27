
<?php
$menumark = 'agent';
pe_lead('hook/order.hook.php');
switch ($act) {
        //####################// 交易记录 //####################//
        
    case 'agent_pay':
        if($_s_user_agent != 1) {
            pe_error('不是代理');
            return;
        }
        $menumark = 'agent_pay';
        $seo = pe_seo($menutitle = '交易记录');
        $userArr = $db->sql_selectall('SELECT * from hq_tguser t join hq_user u on u.user_id = t.user_id where t.tguser_id = ' . $_s_user_id);
        $userId = '';
        foreach ($userArr as $key => $value) {
            if (empty($userId)) {
                $userId = $value['user_id'];
            } else {
                $userId .= ',' . $value['user_id'];
            }
        }

        if (!empty($_g_user_id)) {
            $userId = $_g_user_id;
        }
        if (!empty($userId)) {
            $sql_where .= " and `user_id` in ({$userId}) order by `order_id` desc";
            $info_list = $db->pe_selectall('order', $sql_where, '*', array(20, $_g_page));
            foreach ($info_list as $k => $v) {
                $info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id' => $v['order_id']));
                $order_recovery  = $db->pe_select('order_recovery', array('order_id' => $v['order_id']), 'status');
                if ($order_recovery) {
                    $info_list[$k]['recovery_status'] = $order_recovery['status'];
                } else {
                    $info_list[$k]['recovery_status'] = null;
                }
            }
        } else {
            $info_list = [];
        }
        include(pe_tpl('agent_pay.html'));
        break;
        //####################// 充值记录 //####################//
    case 'agent_recharge':
        if($_s_user_agent != 1) {
            pe_error('不是代理');
            return;
        }
        $menumark = 'agent_recharge';
        $userArr = $db->sql_selectall('SELECT * from hq_tguser t join hq_user u on u.user_id = t.user_id where t.tguser_id = ' . $_s_user_id);
        $userId = '';
        foreach ($userArr as $key => $value) {
            if (empty($userId)) {
                $userId = $value['user_id'];
            } else {
                $userId .= ',' . $value['user_id'];
            }
        }

        if (!empty($_g_user_id)) {
            $userId = $_g_user_id;
        }
        $sum = 0;
        if (!empty($userId)) {
            $sql_where .= " and `moneylog_type` = 'recharge' and `user_id` in ({$userId}) order by `moneylog_id` desc";
            $info_list = $db->pe_selectall('moneylog', $sql_where, '*', array(30, $_g_page));
            $sum = $db->pe_select('moneylog', $sql_where, 'sum(moneylog_in) all_moneylog_in');
            $sum = $sum['all_moneylog_in'];
        } else {
            $info_list = [];
        }

        $seo = pe_seo($menutitle = '充值记录');

        include(pe_tpl('agent_recharge.html'));
        break;
        //####################// 提现记录 //####################//
    case 'agent_withdrawal':
        if($_s_user_agent != 1) {
            pe_error('不是代理');
            return;
        }
        $menumark = 'agent_withdrawal';
        $userArr = $db->sql_selectall('SELECT * from hq_tguser t join hq_user u on u.user_id = t.user_id where t.tguser_id = ' . $_s_user_id);
        $userId = '';
        foreach ($userArr as $key => $value) {
            if (empty($userId)) {
                $userId = $value['user_id'];
            } else {
                $userId .= ',' . $value['user_id'];
            }
        }

        if (!empty($_g_user_id)) {
            $userId = $_g_user_id;
        }
        $sum = 0;
        if (!empty($userId)) {
            $sql_where .= " and `user_id` in ({$userId}) order by `cashout_id` desc";
            $info_list = $db->pe_selectall('cashout', $sql_where, '*', array(20, $_g_page));
            $sum = $db->pe_select('cashout', $sql_where, 'sum(cashout_money)+sum(cashout_fee) all_cashout_money');
            $sum = $sum['all_cashout_money'];
        } else {
            $info_list = [];
        }


        $seo = pe_seo($menutitle = '提现记录');

        include(pe_tpl('agent_withdrawal.html'));
        break;
        //####################// 取消提现 //####################//
    case 'user':
        if($_s_user_agent != 1) {
            pe_error('不是代理');
            return;
        }
        $_g_name && $sqlwhere .= " and u.`user_name` like '%{$_g_name}%'";
        $_g_phone && $sqlwhere .= " and u.`user_phone` like '%{$_g_phone}%'";
        $_g_email && $sqlwhere .= " and u.`user_email` like '%{$_g_email}%'";
        $_g_userlevel_id && $sqlwhere .= " and `userlevel_id` = '{$_g_userlevel_id}'";

        $seo = pe_seo($menutitle = '会员列表');
        $info_list = $db->sql_selectall('SELECT * from hq_tguser t join hq_user u on u.user_id = t.user_id where t.tguser_id = ' . $_s_user_id . $sqlwhere);
        include(pe_tpl('agent.html'));
        break;
        //####################// 代理 //####################//
    default:
        if($_s_user_agent != 1) {
            pe_error('不是代理');
            return;
        }
        $_g_name && $sqlwhere .= " and u.`user_name` like '%{$_g_name}%'";
        $_g_phone && $sqlwhere .= " and u.`user_phone` like '%{$_g_phone}%'";
        $_g_email && $sqlwhere .= " and u.`user_email` like '%{$_g_email}%'";
        $_g_userlevel_id && $sqlwhere .= " and `userlevel_id` = '{$_g_userlevel_id}'";

        $seo = pe_seo($menutitle = '会员列表');
        $info_list = $db->sql_selectall('SELECT * from hq_tguser t join hq_user u on u.user_id = t.user_id where t.tguser_id = ' . $_s_user_id . $sqlwhere);
        include(pe_tpl('agent.html'));
        break;
}
