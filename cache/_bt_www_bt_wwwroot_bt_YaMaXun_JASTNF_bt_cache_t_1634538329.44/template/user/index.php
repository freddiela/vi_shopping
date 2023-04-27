<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<!--<div class="hy_tt">
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order">个人中心</a>
		</div>-->
		<div class="u_index_box mat5">
			<div class="u_index_rtt">
				<div class="user_tx"><a href="user.php?mod=setting&act=logo"><img
							src="<?php echo pe_thumb($user['user_logo'], '_120', '_120', 'avatar') ?>" /></a></div>
				<div class="fl mal20 mat10">
					Xin chào：<span class="cred"><?php echo $_s_user_name ?></span><span
						class="mal20 dj_btn"><?php echo $cache_userlevel[$user['userlevel_id']]['userlevel_name'] ?></span>
					<div>Lần đăng nhập lần trước：<?php echo pe_date($_s_user_ltime) ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="u_index_l">
				<div class="u_info">
					<div style="margin-left:0px;">
						<p>Số điện thoại：
							<?php if($user['user_phone']):?>
							<span class="c999"><?php echo userbank_num($user['user_phone']) ?></span>
							<?php else:?>
							<a href="user.php?mod=setting&act=base" class="cblue">Hoàn thiện</a>
							<?php endif;?>
						</p>
						<p>Hộp thư：
							<?php if($user['user_email']):?>
							<span class="c999"><?php echo $user['user_email'] ?></span>
							<?php else:?>
							<a href="user.php?mod=setting&act=base" class="cblue">Hoàn thiện</a>
							<?php endif;?>
						</p>

						<div>Số dư tích điểm ：<a href="user.php?mod=pointlog" class="c999"><?php echo $user['user_point'] ?> 个</a></div>
					</div>
				</div>
			</div>
			<div class="u_index_m">
				<div>Chờ thanh toán：<span class="c999"><a href="user.php?mod=order&state=wpay"><?php echo $tongji['wpay'] ?></a> 个</span></div>
				<div>Chờ giao hàng：<span class="c999"><a href="user.php?mod=order&state=wsend"><?php echo $tongji['wsend'] ?></a> 个</span>
				</div>
			</div>
			<div class="u_index_r">
				<div class="u_ye_l">
					<div>Số dư tài khoản：<a href="user.php?mod=moneylog" class="corg"><?php echo $user['user_money'] ?> việt nam đồng</a></div>
				<?php if($user['user_money_frozen'] > 0):?>
				    <div>Số dư không thể sử dụng：<a href="user.php?mod=moneylog" class="corg"><?php echo $user['user_money_frozen'] ?> việt nam đồng</a></div>
				<?php endif;?>
				</div>
				<div class="u_ye_r">
					<a href="user.php?mod=pay">Nạp tiền</a>
					<a href="user.php?mod=cashout&act=add" class="btntx">Rút tiền</a>
					<a href="user.php?mod=money_deposit" class="btntx" style="background-color: #1e9fff;">Số dư bao</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="u_jilu_tt">
			<a href="javascript:;" class="fl">Đơn  hàng mới nhất</a>
			<div class="clear"></div>
		</div>
		<?php foreach($info_list as $v):?>
		<div class="hy_ordertt">
			<span class="fl"><?php echo pe_date($v['order_atime']) ?></span>
			<span class="fl" style="margin-left:30px">Mã số đặt đơn hàng：<?php echo $v['order_id'] ?></span>
			<?php if($v['pintuan_id'] && $v['order_pstate']):?>
			<span class="fr mar10">Mã số tham gia nhóm：<a
					href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=pintuan&id=<?php echo $v['pintuan_id'] ?>"
					target="_blank"><?php echo $v['pintuan_id'] ?></a></span>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
			<tr>
				<td style="text-align:left;">
					<?php foreach($v['product_list'] as $kk=>$vv):?>
					<div class="dingdan_list" <?php if($kk==0):?>style="padding-top:0;border-top:0"
						<?php endif;?>>
						<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" class="fl mar5 dingdan_img"
							target="_blank"><img src="<?php echo pe_thumb($vv['product_logo'], 100, 100) ?>" /></a>
						<div class="fl dingdan_name">
							<?php if($v['order_type']=='pintuan'):?><span class="tag_pintuan">Tham gia vào một nhóm</span>
							<?php endif;?>
							<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" target="_blank"
								class="dd_name"><?php echo $vv['product_name'] ?></a>
							<p class="c888 mat5"><?php echo order_skushow($vv['product_rule']) ?></p>
						</div>
						<div class="fl dingdan_jg">¥<?php echo $vv['product_money'] ?> <span
								class="mat5 c888 font12">×<?php echo $vv['product_num'] ?></span></div>
						<div class="fr dingdan_tk">
							<?php if($vv['refund_id']):?>
							<a href="user.php?mod=refund&act=view&id=<?php echo $vv['refund_id'] ?>"
								target="_blank"><?php echo refund_stateshow($vv['refund_state']) ?></a>
							<?php elseif(in_array($v['order_state'], array('wsend', 'wget'))):?>
							<a href="user.php?mod=refund&act=add&id=<?php echo $vv['orderdata_id'] ?>"
								onclick="return pe_dialog(this, 'Yêu cầu hoàn tiền / trả hàng ', 600, 400)"> Hoàn tiền / trả hàng</a>
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
					<?php echo order_stateshow($v['order_state']) ?>
					<p><a href="user.php?mod=order&act=view&id=<?php echo $v['order_id'] ?>" target="_blank">Chi tiết đơn hàng</a></p>
				</td>
				<td width="100">
					<?php if($v['order_state'] == 'wpay'):?>
					<a class="tag_org" href="index.php?mod=order&act=pay&id=<?php echo $v['order_id'] ?>" target="_blank">Thanh toán ngay lập tức</a>
					<p class="mat5"><a class="c999" href="user.php?mod=order&act=close&id=<?php echo $v['order_id'] ?>"
							onclick="return pe_dialog(this, 'Hủy đơn hàng', 550, 400)">Hủy đơn hàng</a></p>
					<?php elseif($v['order_state'] == 'wget' && $v['order_payment'] != 'cod'):?>
					<a class="tag_green"
						href="javascript:pe_confirm('Đã được nhận hàng', 'user.php?mod=order&act=success&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>');">Xác nhận việc nhận hàng</a>
					<?php elseif($v['order_state'] == 'success' && !$v['order_comment']):?>
					<a class="tag_gray" href="user.php?mod=order&act=comment&id=<?php echo $v['order_id'] ?>"
						onclick="return pe_dialog(this, 'Cho ra đánh giá', 800, 500)">Cho ra đánh giá</a>
					<?php else:?>
					-
					<?php endif;?>
				</td>
			</tr>
		</table>
		<?php endforeach;?>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>