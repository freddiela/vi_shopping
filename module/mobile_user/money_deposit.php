<?php
$menumark = 'money_deposit';
switch($act) {
	    //####################// 转出到余额 //####################//
		case 'out':
			$menumark = 'money_deposit';
			if (isset($_p_pesubmit)) {
				$_p_mdp_id = $_p_order_payment;
				$_p_mdp_money = $_p_order_money;
				$planInfo = $db->pe_select('money_deposit_plan', array('mdp_user_id' => $_s_user_id, 'mdp_id' => $_p_mdp_id));
				if (empty($planInfo)) pe_jsonshow(array('result' => false, 'show' => '没找到计划'));
				if ($_p_mdp_money > $planInfo['mdp_money']) pe_jsonshow(array('result' => false, 'show' => '计划余额不足'));
	
				$sql_set['mdp_money'] = $planInfo['mdp_money'] - $_p_mdp_money;
				$sql_set['mdp_first_money'] = $planInfo['mdp_first_money']  - $_p_mdp_money;
				if ($db->pe_update('money_deposit_plan', array('mdp_id' => $_p_mdp_id, 'mdp_user_id' => $_s_user_id), $sql_set)) {
					$userInfo = $db->pe_select('user', array('user_id' => $_s_user_id,));
					$user_set['user_money'] = $userInfo['user_money'] + $_p_mdp_money;
					if ($db->pe_update('user', array('user_id' => $_s_user_id), $user_set)) {
						$data = [
							'mdl_user_id' => $_s_user_id,
							'mdl_deposit_plan_id' => $_p_mdp_id,
							'mdl_datetime' => date('Y-m-d H:i:s', time()),
                            'mdp_tx_time' => date('Y-m-d H:i:s', strtotime($planInfo['mdp_tx_time'])),
							'mdl_add_money' => 0 - $_p_mdp_money
						];
						$tx = strtotime($data['mdp_tx_time']);
						if($tx > time()){
						pe_jsonshow(array('result' => false, 'show' => '转出时间未到'));
						}
						$db->pe_insert('money_deposit_log', $data);
						pe_jsonshow(array('result' => true, 'show' => '转出成功'));
					}
				}
				pe_jsonshow(array('result' => false, 'show' => '转出错误'));
			}
			$sql = "SELECT * from " . dbpre . "money_deposit_plan p join " . dbpre . "money_deposit m on m.deposit_id = p.mdp_deposit_id where mdp_user_id = " . $_s_user_id . ' and p.mdp_money > 0 order by mdp_end_time asc';
			$info_list = $db->sql_selectall($sql, array(30, $_g_page));
			$seo = pe_seo($menutitle = '转出到余额');
			include(pe_tpl('money_deposit_out.html'));
			break;
	//####################// 转进 //####################//
	case 'in':
        $menumark = 'money_deposit';
        if (isset($_p_pesubmit)) {
            /* var_dump($_p_mdp_money,$_p_deposit_id); */
			$_p_deposit_id = $_p_order_payment;
			$_p_mdp_money = $_p_order_money;
            if ($_p_mdp_money > $user['user_money']) pe_jsonshow(array('result' => false, 'show' => '余额不足'));

            $planInfo = $db->pe_select('money_deposit', array('deposit_id' => $_p_deposit_id));
            if (empty($planInfo)) pe_jsonshow(array('result' => false, 'show' => '找不到计划'));

            $data = [
                'mdp_user_id' => $_s_user_id,
                'mdp_deposit_id' => $_p_deposit_id,
                'mdp_money' => $_p_mdp_money,
                'mdp_add_time' => date('Y-m-d H:i:s', time()),
                'mdp_end_time' => date('Y-m-d H:i:s', strtotime('+' . $planInfo['deposit_cycle'] . ' ' . $planInfo['deposit_type'])),
                'mdp_tx_time' => date('Y-m-d H:i:s', strtotime('+' . $planInfo['deposit_cle'] . ' ' . $planInfo['deposit_name'])),
                'mdp_first_money' => $_p_mdp_money
            ];
            if ($db->pe_insert('money_deposit_plan', pe_dbhold($data))) {
                $sql_set['user_money'] = $user['user_money'] - $_p_mdp_money;
                $db->pe_update('user', array('user_id' => $_s_user_id), $sql_set);
                pe_jsonshow(array('result' => true, 'show' => '转进成功'));
            } else {
                pe_jsonshow(array('result' => false, 'show' => '转进失败'));
            }
        }
        $info_list = $db->pe_selectall('money_deposit', array('order by' => '`deposit_rate` desc'), '*');
        $seo = pe_seo($menutitle = '转进余额宝');
        include(pe_tpl('money_deposit_in.html'));
        break;
	//####################// 余额宝 //####################//
	default:
	    $user_info['deposit_all'] = $db->pe_select('money_deposit_plan', array('mdp_user_id' => $_s_user_id), 'sum(mdp_money) as `allMoney`');
	    $user_info['deposit_yesterday'] = $db->pe_select('money_deposit_log', 'and mdl_add_money > 0 and mdl_user_id = ' . $_s_user_id . ' and TO_DAYS(NOW( ) ) - TO_DAYS(mdl_datetime) <= 1 ', 'sum(mdl_add_money) as `allAddMoney`');
		$user_info['deposit_add'] = $db->pe_select('money_deposit_log', 'and mdl_add_money > 0 and mdl_user_id = ' . $_s_user_id , 'sum(mdl_add_money) as `allAddMoney`');
		$sql = "SELECT deposit_cycle,deposit_type,deposit_rate,mdl_datetime,mdl_add_money FROM hq_money_deposit_log l JOIN hq_money_deposit_plan p ON l.mdl_deposit_plan_id = p.mdp_id left JOIN hq_money_deposit d ON d.deposit_id = p.mdp_deposit_id where l.mdl_user_id = {$_s_user_id} order by mdl_datetime desc";

		$log_info = $db->sql_selectall($sql);
		foreach ($log_info as $key => $value) {
			$log_info[$key]['type'] = 0;
		}
		$sql = "SELECT `deposit_cycle`,`deposit_type`,`deposit_rate`,`mdp_add_time` as 'mdl_datetime',`mdp_first_money` as 'mdl_add_money' FROM hq_money_deposit_plan p JOIN hq_money_deposit d ON d.deposit_id = p.mdp_deposit_id WHERE mdp_user_id = " .  $_s_user_id;
        $info_list = $db->sql_selectall($sql);
		foreach ($info_list as $key => $value) {
			$info_list[$key]['type'] = 1;
		}
		$info_list =  array_merge($info_list, $log_info);
		$seo = pe_seo($menutitle='余额宝');
		include(pe_tpl('money_deposit.html'));
	break;
}
?>