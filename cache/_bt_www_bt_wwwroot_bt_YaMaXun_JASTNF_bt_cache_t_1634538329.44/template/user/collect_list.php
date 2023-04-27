<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="javascript:;" class="sel"><?php echo $menutitle ?><span>(<?php echo $tongji['all'] ?>)</span><i></i></a>
		</div>
		<div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th colspan="2">Thông tin sản phẩm</th>
				<th width="100">Giá bán</th>
				<th width="100">Ngày được lưu lại</th>
				<th width="80">Thao tác</th>
			</tr>
			<?php foreach($info_list as $v):?>
			<tr>
				<td width="50"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" class="dingdan_img" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" /></a></td>
				<td class="aleft" style="padding-left:0"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue"><?php echo $v['product_name'] ?></a></td>
				<td>¥<?php echo $v['product_money'] ?></td>
				<td><?php echo pe_date($v['collect_atime'], 'Y-m-d') ?></td>
				<td><a href="javascript:pe_confirm('Xóa bỏ ngày lưu lại', 'user.php?mod=collect&act=del&id=<?php echo $v['collect_id'] ?>&token=<?php echo $pe_token ?>');" class="tag_gray">Xóa bỏ</a></td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>