<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=admin" class="sel"><?php echo $menutitle ?>（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=admin&act=add" id="fabu">添加帐号</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="">管理帐号</th>
			<th class="bgtt" width="200">管理权限</th>
			<th class="bgtt" width="300">上次登录</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['admin_id'] ?></td>
			<td><?php echo $v['admin_name'] ?></td>
			<td><?php echo $adminlevel_list[$v['adminlevel_id']]['adminlevel_name'] ?></td>
			<td><?php echo pe_date($v['admin_ltime']) ?></td>
			<td>
				<a href="webadmin.php?mod=admin&act=edit&id=<?php echo $v['admin_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=admin&act=del&id=<?php echo $v['admin_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>