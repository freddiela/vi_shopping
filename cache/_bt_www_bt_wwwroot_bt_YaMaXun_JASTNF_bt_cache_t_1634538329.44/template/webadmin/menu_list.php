<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=menu" class="sel">导航列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=menu&act=add" id="fabu">添加导航</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'menu_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40">排序</th>
			<th class="bgtt" width="180">导航名称</th>
			<th class="bgtt aleft" style="padding-left:50px">链接地址</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<tr>
			<td></td>
			<td>-</td>
			<td>-</td>
			<td>首页</td>
			<td class="aleft" style="padding-left:50px"><?php echo $pe['host_root'] ?></td>
			<td>-</td>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="menu_id[]" value="<?php echo $v['menu_id'] ?>" /></td>
			<td><?php echo $v['menu_id'] ?></td>
			<td><input type="text" name="menu_order[<?php echo $v['menu_id'] ?>]" value="<?php echo $v['menu_order'] ?>" class="inputtext input30 center" /></td>
			<td><?php echo $v['menu_name'] ?></td>
			<?php if($v['menu_type'] == 'sys'):?>
			<td class="aleft" style="padding-left:50px"><a href="<?php echo pe_url($v['menu_url']) ?>" target="_blank"><?php echo pe_url($v['menu_url']) ?></a></td>
			<?php else:?>
			<td class="aleft" style="padding-left:50px"><a href="<?php echo $v['menu_url'] ?>" target="_blank"><?php echo $v['menu_url'] ?></a></td>
			<?php endif;?>
			<td>
				<a href="webadmin.php?mod=menu&act=edit&id=<?php echo $v['menu_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=menu&act=del&id=<?php echo $v['menu_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'menu_id')" />
			<button href="webadmin.php?mod=menu&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'menu_id', 'form', '批量删除')">批量删除</button>
			<button href="webadmin.php?mod=menu&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>