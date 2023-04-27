<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<?php include(pe_tpl('setting_menu.html','admin'));?>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'express_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="50">排序</th>
			<th class="bgtt" width="200">模板名称</th>
			<th class="bgtt"></th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="express_id[]" value="<?php echo $v['express_id'] ?>" /></td>
			<td><?php echo $v['express_id'] ?></td>
			<td><input type="text" name="express_order[<?php echo $v['express_id'] ?>]" value="<?php echo $v['express_order'] ?>" class="inputtext input30 center" /></td>
			<td><?php echo $v['express_name'] ?></td>
			<td></td>
			<td>
				<a href="webadmin.php?mod=express&act=edit&id=<?php echo $v['express_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="webadmin.php?mod=express&act=del&id=<?php echo $v['express_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'express_id')" />
			<button href="webadmin.php?mod=express&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'express_id', 'form', '批量删除')">批量删除</button>
			<button href="webadmin.php?mod=express&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this, 'form')">更新排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>