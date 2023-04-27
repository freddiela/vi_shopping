<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
$menumark = 'activity_time';
switch ($act) {
	//####################// 活动时间添加 //####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_insert('activity_time', pe_dbhold($_p_info))) {
				pe_success('添加成功!', 'webadmin.php?mod=activity_time');
			}
			else {
				pe_error('添加失败...');
			}
		}
		$seo = pe_seo($menutitle='添加活动时间', '', '', 'admin');
		include(pe_tpl('activity_time_add.html','admin'));
	break;
	//####################// 活动时间修改 //####################//
	case 'edit':
		$id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('activity_time', array('id'=>$id), pe_dbhold($_p_info))) {
				pe_success('修改成功!', 'webadmin.php?mod=activity_time');
			}
			else {
				pe_error('修改失败...' );
			}
		}
		$info = $db->pe_select('activity_time', array('id'=>$id));
		$seo = pe_seo($menutitle='修改活动时间', '', '', 'admin');
		include(pe_tpl('activity_time_add.html','admin'));
	break;
	//####################// 活动时间删除 //####################//
	case 'delete':
		pe_token_match();
		$id = intval($_p_id);
		if ($db->pe_update('activity_time', array('id'=>$id),pe_dbhold(array('is_deleted' => 1)))) {
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//####################// 活动时间列表 //####################//
	default:
		$info_list = $db->pe_selectall('activity_time', array('is_deleted' => 0,'order by'=>'id asc'), '*', array(10, $_g_page));
		$tongji['all'] = $db->pe_num('activity_time');
		
		$seo = pe_seo($menutitle='活动时间管理', '', '', 'admin');
		include(pe_tpl('activity_time.html','admin'));
	break;
}
?>