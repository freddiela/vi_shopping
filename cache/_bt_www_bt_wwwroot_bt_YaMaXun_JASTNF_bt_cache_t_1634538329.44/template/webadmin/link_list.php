<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=link" class="sel">链接列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=link&act=add" id="fabu">添加链接</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'link_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40">排序</th>
			<th class="bgtt" width="230">链接名称</th>
			<th class="bgtt aleft">链接地址</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="link_id[]" value="<?php echo $v['link_id'] ?>" /></td>
			<td><?php echo $v['link_id'] ?></td>
			<td><input type="text" name="link_order[<?php echo $v['link_id'] ?>]" value="<?php echo $v['link_order'] ?>" class="inputtext input30 center" /></td>
			<td><?php echo $v['link_name'] ?></td>
			<td class="aleft"><a href="<?php echo $v['link_url'] ?>" target="_blank"><?php echo $v['link_url'] ?></a></td>
			<td>
				<a href="webadmin.php?mod=link&act=edit&id=<?php echo $v['link_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=link&act=del&id=<?php echo $v['link_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'link_id')" />
			<button href="webadmin.php?mod=link&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'link_id', 'form', '批量删除')">批量删除</button>
			<button href="webadmin.php?mod=link&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>