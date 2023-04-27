<?php

/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 * 计划任务 一分钟执行一次，url ： /index.php?mod=money_deposit&act=doTask
 */
$menumark = 'money_deposit';
switch ($act) {
        //####################// 定时任务 //####################//
    case 'doTask':
        $planInfo = $db->sql_selectall("SELECT * from hq_money_deposit_plan where mdp_add_time < NOW() and mdp_end_time <= now() and mdp_money > 0");

        foreach ($planInfo as $key => $value) {
            $depositInfo = $db->pe_select('money_deposit', array('deposit_id' => $value['mdp_deposit_id']));
            //收益金额
            $mdp_money = $value['mdp_money'] *  $depositInfo['deposit_rate'];
            //计算下次收益时间
            $nextEndTime = date('Y-m-d H:i:s', strtotime('+' . $depositInfo['deposit_cycle'] . ' ' . $depositInfo['deposit_type'], strtotime($value['mdp_end_time'])));

            //记录
            $data = [
                'mdl_user_id' => $value['mdp_user_id'],
                'mdl_deposit_plan_id' => $value['mdp_id'],
                'mdl_datetime' => date('Y-m-d H:i:s', time()),
                'mdl_add_money' => $mdp_money
            ];
            $db->pe_insert('money_deposit_log', $data);

            //更新计划总金额、下次收益时间
            $data = [
                'mdp_money' => $value['mdp_money'] + $mdp_money,
                'mdp_end_time' => $nextEndTime
            ];
            $db->pe_update('money_deposit_plan', array('mdp_id' => $value['mdp_id']), $data);
        }

        pe_lead('hook/product.hook.php');
        $commentFakeInfo = $db->sql_selectall("SELECT * from hq_comment_fake_specific s join hq_comment_fake f on f.cf_id = s.cfs_cf_id where cfs_time <= now() and cfs_state = 0");
        foreach ($commentFakeInfo as $key => $value) {
            $info = $db->pe_select('product', array('product_id' => $value['cfs_product_id']), 'product_id, product_name, product_logo');

            $sql_set['comment_star'] = intval($value['cf_comment_star']);
            $sql_set['comment_text'] = $value['cf_comment_text'];
            $sql_set['comment_logo'] = '';
            $sql_set['comment_atime'] = $value['cfs_time'] ? strtotime($value['cfs_time']) : time();
            $sql_set['product_id'] = $value['cfs_product_id'];
            $sql_set['product_name'] = $info['product_name'];
            $sql_set['product_logo'] = $info['product_logo'];
            $sql_set['user_name'] = rand('111111', '999999');
            $sql_set['user_ip'] = pe_ip();
            $user = $db->pe_select('user', array('user_name' => pe_dbhold($sql_set['user_name'])));
            if ($user['user_id']) {
                $sql_set['user_id'] = $user['user_id'];
            }
            product_jsnum($value['cfs_product_id'], 'commentnum');
            $db->pe_insert('comment', pe_dbhold($sql_set));
            $data = [
                'cfs_state' => 1
            ];
            $db->pe_update('comment_fake_specific', array('cfs_id' => $value['cfs_id']), $data);
        }
        break;
}
