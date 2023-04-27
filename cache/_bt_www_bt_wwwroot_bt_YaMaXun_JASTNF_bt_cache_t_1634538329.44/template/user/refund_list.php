<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="user.php?mod=refund" <?php if(!$_g_state):?>class="sel"<?php endif;?>>Đăng ký toàn bộ（<?php echo $tongji['all'] ?>）<i></i><i></i></a>
			<?php foreach($ini['refund_state'] as $k=>$v):?>
			<a href="user.php?mod=refund&state=<?php echo $k ?>" <?php if($_g_state==$k):?>class="sel"<?php endif;?>><?php echo $v ?>（<?php echo $tongji[$k] ?>）<i></i></a>
			<?php endforeach;?>
		</div>
		<div class="mat15">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_ordertt1">
			<tr>
				<td>Thông tin sản phẩm</td>
				<td width="101">Số tiền hoàn trả</td>
				<td width="101">Hình thức hoàn tiền</td>
				<td width="101">Trang thái</td>
				<td width="101">Thao tác</td>
			</tr>
			</table>
		</div>
		<?php foreach($info_list as $v):?>
		<div class="hy_ordertt">
			<span class="fl"><?php echo pe_date($v['refund_atime']) ?></span>
			<span class="fl" style="margin-left:30px">Mã số đơn đặt hàng：<?php echo $v['order_id'] ?></span>
			<span class="fl" style="margin-left:30px">Mã số hoàn tiền：<?php echo $v['refund_id'] ?></span>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
		<tr>
			<td style="text-align:left;">
				<div class="dingdan_list" style="padding-top:0;border-top:0">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" class="fl mar5 dingdan_img" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" /></a>
					<div class="fl dingdan_name">
						<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="dd_name"><?php echo $v['product_name'] ?></a>
						<p class="c888 mat5"><?php echo order_skushow($v['product_rule']) ?></p>
					</div>
					<div class="fr dingdan_jg">¥<?php echo $v['product_money'] ?> <span class="mat5 c888 font12">×<?php echo $v['product_num'] ?></span></div>
					<div class="clear"></div>
				</div>
			</td>
			<td width="100">
				<p class="corg font14">₫<?php echo $v['refund_money'] ?></p>
				<p class="c999">(Bao gồm phí vận chuyển：<?php echo $v['refund_wl_money'] ?>)</p>
			</td>
			<td width="100"><?php echo $ini['refund_type'][$v['refund_type']] ?></td>
			<td width="100"><?php echo refund_stateshow($v['refund_state']) ?><p class="mat5"><a href="user.php?mod=refund&act=view&id=<?php echo $v['refund_id'] ?>" target="_blank">kiểm tra chi tiết</a></p></td>
			<td width="100">
				<?php if(in_array($v['refund_state'], array('wcheck', 'refuse'))):?>
				<a class="tag_org" href="user.php?mod=refund&act=edit&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, 'Sửa đổi hoàn tiền/ Đăng ký hoàn trả hàng', 600, 400)">Đăng ký sửa đổi</a>
				<p class="mat5"><a class="c999" href="javascript:pe_confirm('Hủy đăng ký hoàn trả hàng', 'user.php?mod=refund&act=close&id=<?php echo $v['refund_id'] ?>&token=<?php echo $pe_token ?>');">Hủy đăng ký</a></p>
				<?php elseif($v['refund_state'] == 'wsend'):?>
				<a class="tag_blue" href="user.php?mod=refund&act=send&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, 'Điền vào đơn hoàn trả hàng', 600, 400)">Điền mã số đơn hàng</a>
				<p class="mat5"><a class="c999" href="javascript:pe_confirm('Hủy đăng ký hoàn trả hàng', 'user.php?mod=refund&act=close&id=<?php echo $v['refund_id'] ?>&token=<?php echo $pe_token ?>');">Hủy đăng ký</a></p>
				<?php else:?>
				-
				<?php endif;?>
			</td>
		</tr>
		</table>
		<?php endforeach;?>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>