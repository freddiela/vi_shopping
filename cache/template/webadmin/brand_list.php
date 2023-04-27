<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=brand" class="sel">品牌列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=brand&act=add" id="fabu">添加品牌</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'brand_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="60">排序</td>
			<th class="bgtt" width="150">品牌名称</th>
			<th class="bgtt" width="150">品牌图片</th>
			<th class="bgtt">品牌简介</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="brand_id[]" value="<?php echo $v['brand_id'] ?>" /></td>
			<td><?php echo $v['brand_id'] ?></td>
			<td><input type="text" name="brand_order[<?php echo $v['brand_id'] ?>]" value="<?php echo $v['brand_order'] ?>" class="inputtext input30 center" /></td>
			<td><a href="<?php echo pe_url('brand-'.$v['brand_id']) ?>" target="_blank"><?php echo $v['brand_name'] ?></a></td>
			<td><a href="<?php echo pe_url('brand-'.$v['brand_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($v['brand_logo']) ?>" style="width:140px; height:56px;" /></a></td>
			<td class="aleft" valign="top"><?php echo pe_cut(pe_text($v['brand_text']), 60, '...') ?></td>
			<td>
				<a href="webadmin.php?mod=brand&act=edit&id=<?php echo $v['brand_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=brand&act=del&id=<?php echo $v['brand_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'brand_id')" />
			<button href="webadmin.php?mod=brand&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'brand_id', 'form', '批量删除')">批量删除</button>
			<button href="webadmin.php?mod=brand&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>