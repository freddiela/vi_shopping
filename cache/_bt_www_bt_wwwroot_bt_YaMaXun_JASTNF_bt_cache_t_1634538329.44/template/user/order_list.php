<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order" <?php if(!$_g_state):?>class="sel"<?php endif;?>>Tất cả các đơn đặt hàng<span>(<?php echo $tongji['all'] ?>)</span><i></i></a> |
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order&state=wpay" <?php if($_g_state=='wpay'):?>class="sel"<?php endif;?>>Chờ thanh toán<span>(<?php echo $tongji['wpay'] ?>)</span><i></i></a> |
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order&state=wsend" <?php if($_g_state=='wsend'):?>class="sel"<?php endif;?>>Chờ giao hàng<span>(<?php echo $tongji['wsend'] ?>)</span><i></i></a> |
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order&state=wget" <?php if($_g_state=='wget'):?>class="sel"<?php endif;?>>Chờ giao hàng<span>(<?php echo $tongji['wget'] ?>)</span><i></i></a> |
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order&state=success" <?php if($_g_state=='success'):?>class="sel"<?php endif;?>>Giao dịch hoàn tất<span>(<?php echo $tongji['success'] ?>)</span><i></i></a> |
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order&state=wpj" <?php if($_g_state=='wpj'):?>class="sel"<?php endif;?>>Đang chờ đánh giá<span>(<?php echo $tongji['wpj'] ?>)</span><i></i></a>
		</div>
		<div class="mat15">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_ordertt1">
			<tr>
				<td>Thông tin sản phẩm</td>
				<td width="100">Hoàn tiền / trả hàng</td>
				<td width="121">Thanh toán thực tế (Việt nam đồng)</td>
				<td width="101">Trang thái</td>
				<td width="101">Thao tác</td>
			</tr>
			</table>
		</div>
		<?php foreach($info_list as $v):?>
		<div class="hy_ordertt">
			<span class="fl"><?php echo pe_date($v['order_atime']) ?></span>
			<span class="fl" style="margin-left:30px">Mã số đặt đơn hàng：<?php echo $v['order_id'] ?></span>
			<?php if($v['pintuan_id'] && $v['order_pstate']):?>
			<span class="fr mar10">Mã số tham gia nhóm：<a href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=pintuan&id=<?php echo $v['pintuan_id'] ?>" target="_blank"><?php echo $v['pintuan_id'] ?></a></span>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
		<tr>
			<td style="text-align:left;">
				<?php foreach($v['product_list'] as $kk=>$vv):?>
				<div class="dingdan_list" <?php if($kk==0):?>style="padding-top:0;border-top:0"<?php endif;?>>
					<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" class="fl mar5 dingdan_img" target="_blank"><img src="<?php echo pe_thumb($vv['product_logo'], 100, 100) ?>" /></a>
					<div class="fl dingdan_name">
						<?php if($v['order_type']=='pintuan'):?><span class="tag_pintuan">Tham gia vào một nhóm</span><?php endif;?>
						<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" target="_blank" class="dd_name"><?php echo $vv['product_name'] ?></a>
						<p class="c888 mat5"><?php echo order_skushow($vv['product_rule']) ?></p>
					</div>
					<div class="fl dingdan_jg">¥<?php echo $vv['product_money'] ?> <span class="mat5 c888 font12">×<?php echo $vv['product_num'] ?></span></div>
					<div class="fr dingdan_tk">
						<?php if($vv['refund_id']):?>
						<a href="user.php?mod=refund&act=view&id=<?php echo $vv['refund_id'] ?>" target="_blank"><?php echo refund_stateshow($vv['refund_state']) ?></a>
						<?php elseif(in_array($v['order_state'], array('wsend', 'wget')) && $v['recovery_status'] == null):?>
						<a href="user.php?mod=refund&act=add&id=<?php echo $vv['orderdata_id'] ?>" onclick="return pe_dialog(this, 'Yêu cầu hoàn tiền / trả hàng ', 600, 400)">Hoàn tiền / trả hàng</a>	
                        <?php elseif($v['recovery_status'] != null):?>
						<a href="#">Thu hồi đơn hàng không thao tác được</a>
						<?php endif;?>
					</div>
					<div class="clear"></div>
				</div>
				<?php endforeach;?>
			</td>
			<td width="120">
				<p class="corg font14 strong"><?php echo $v['order_money'] ?></p>
				<p class="c999">（Bao gồm phí vận chuyển：<?php echo $v['order_wl_money'] ?>）</p>
				<p class="c999"><?php echo $v['order_payment_name'] ?></p>
			</td>
			<td width="100">
				<?php if($v['recovery_status'] == null):?>
				<?php echo order_stateshow($v['order_state']) ?>
				<?php elseif($v['recovery_status'] != null):?>
				<p>
					<?php if($v['recovery_status']==0):?>
					<span class="cblue">Đang thu hồi</span>
					<?php elseif($v['recovery_status']==1):?>
					<span class="cred">Thu hồi thất bại</span>
					<?php else:?>
					<span class="cgreen">Đã nhận lại</span>
					<?php endif;?>
				</p>
				<?php endif;?>
				<p><a href="user.php?mod=order&act=view&id=<?php echo $v['order_id'] ?>" target="_blank">Chi tiết đơn hàng</a></p>
			</td>
			<td width="100">
				<?php if($v['order_state'] == 'wpay'):?>
				<a class="tag_org" href="index.php?mod=order&act=pay&id=<?php echo $v['order_id'] ?>" target="_blank">Thanh toán ngay lập tức</a>
				<p class="mat5"><a class="c999" href="user.php?mod=order&act=close&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, 'Hủy đơn hàng', 550, 400)">Hủy đơn hàng</a></p>
				<?php elseif($v['order_state'] == 'wget' && $v['order_payment'] != 'cod'):?>
				<a class="tag_green" href="javascript:pe_confirm('Đã được nhận hàng', 'user.php?mod=order&act=success&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>');">Xác nhận việc nhận hàng</a>
				<?php elseif($v['order_state'] == 'success' && !$v['order_comment']):?>
				<a class="tag_gray" href="user.php?mod=order&act=comment&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, 'Cho ra đánh giá', 800, 500)">Cho ra đánh giá</a>
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