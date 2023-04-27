
<?php include(pe_tpl('header.html'));?>
<div class="content" style="margin-bottom:62px;">
	<div class="user_info">
		<div class="user_tt">Trung tâm cá nhân</div>
		<div class="user_tx_box">
			<div class="user_tx">
				<a href="user.php?mod=setting&act=logo"><img src="<?php echo $user_logo ?>" /></a>
			</div>
			<?php if(pe_login('user')):?>
			<div class="user_text">
				<div class=""><?php echo $_s_user_name ?><p class="mat10"><span class="dj_btn"><?php echo $cache_userlevel[$user['userlevel_id']]['userlevel_name'] ?></span></p></div>
			</div>
			<?php else:?>
			<div class="center mat20 font16">
				<a href="user.php?mod=do&act=login">Đăng nhập</a>　|　<a href="user.php?mod=do&act=register">Đăng kí</a>
			</div>
			<?php endif;?>
		</div>

	</div>
	<div class="side_all">
		<div class="side_fh1">
			<a href="user.php?mod=moneylog">Số dư tài khoản <span><?php echo $user['user_money'] ?> Việt nam đồng</span></a>
			<a href="user.php?mod=pointlog">Số dư tích điểm <span><?php echo $user['user_point'] ?> cái</span></a>
			<a href="user.php?mod=quan">Phiếu giảm giá<span><?php echo $tongji['quan'] ?> cái</span></a>			
			<?php if($user['user_money_frozen'] > 0):?>
			<a href="user.php?mod=moneylog">Số dư không thể sử dụng<span><?php echo $user['user_money_frozen'] ?> Việt nam đồng</span></a>				
			<?php endif;?>		
			<?php if($allMoney['allMoney'] > 0):?>
			<a href="user.php?mod=money_deposit">Số dư bao<span><?php echo $allMoney['allMoney'] ?> </span></a>
			<?php endif;?>
			<?php if($allMoney['allMoney'] <= 0):?>
			<a href="user.php?mod=money_deposit">Số dư bao<span>0.00 </span></a>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<div class="nav">
			<a class="tgdd_tt" href="user.php?mod=order"><span class="fl">Đơn hàng của tôi</span><span class="fr c888 font13">Xem thêm đơn đặt hàng</span><i class="more_jt"></i></a>
			<ul>
				<li><a href="user.php?mod=order&state=wpay"><i class="user_tb1"></i>Chờ thanh toán<?php if($tongji['wpay']):?><span><?php echo $tongji['wpay'] ?></span><?php endif;?></a></li>
				<li><a href="user.php?mod=order&state=wsend"><i class="user_tb2"></i>Chờ giao hàng<?php if($tongji['wsend']):?><span><?php echo $tongji['wsend'] ?></span><?php endif;?></a></li>
				<li><a href="user.php?mod=order&state=wget"><i class="user_tb3"></i>Đang chờ nhận<?php if($tongji['wget']):?><span><?php echo $tongji['wget'] ?></span><?php endif;?></a></li>
				<li><a href="user.php?mod=order&state=wpj"><i class="user_tb4"></i>Đang chờ đánh giá<?php if($tongji['wpj']):?><span><?php echo $tongji['wpj'] ?></span><?php endif;?></a></li>
				<li><a href="user.php?mod=refund"><i class="user_tb5"></i>Hoàn tiền / trả hàng<?php if($tongji['refund']):?><span><?php echo $tongji['refund'] ?></span><?php endif;?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="ck_nav mat10">
			<ul>
				<li><a href="user.php?mod=collect"><i class="ck_i7"></i><span>Bộ sưu tập của tôi</span><p></p></a></li>
				<li><a href="user.php?mod=comment"><i class="ck_i1"></i><span>Bình luận của tôi</span><p></p></a></li>
				<li><a href="user.php?mod=useraddr"><i class="ck_i3"></i><span>Địa chỉ nhận hàng</span><p></p></a></li>
				<!--			<li><a href="user.php?mod=userbank"><i class="ck_i2"></i><span>收款账户</span><p></p></a></li>-->
				<li><a href="user.php?mod=setting&act=base"><i class="ck_i4"></i><span>Cài đặt tài khoản</span><p></p></a></li>
				<li><a href="user.php?mod=order_recovery"><i class="ck_huishou"></i><span>Trung tâm thu hồi</span><p></p></a></li>
				<li><a href="<?php echo $cache_setting['online_service'] ?>"><i class="ck_kefu"></i><span>Liên hệ với phụ vụ khách hàng</span><p></p></a></li>
			
                	<?php if($_s_user_agent == 1):?>
                	<?php if($cache_setting['tg_state']):?>
<!--				<li><a href="user.php?mod=tg&act=invite"><i class="ck_invite"></i><span>邀请好友</span><p></p></a></li>-->
				<li><a href="user.php?mod=tg&act=user"><i class="ck_i5"></i><span>Trung tâm mời gọi</span><p></p></a></li>
				<?php endif;?>	<?php endif;?>
				<!--			<li><a href="<?php echo pe_url('article-list-1') ?>"><i class="ck_i6"></i><span>网站公告</span><p></p></a></li>-->
			</ul>
			<div class="clear"></div>
		</div>
		<div class="ck_nav_xian"></div>
		<div class="side_ul mat10 mab10" style="display:none">
			<ul>
				<li class="side_i2"><a href="user.php?mod=comment">Bình luận của tôi<span></span><i></i></a></li>
				<li class="side_i1"><a href="user.php?mod=collect">Bộ sưu tập của tôi<span></span><i></i></a></li>
				<li class="side_i3"><a href="user.php?mod=userbank">Tài khoản nhận tiền<span></span><i></i></a></li>
				<li class="side_i4"><a href="user.php?mod=useraddr">Địa chỉ quản lý<span></span><i></i></a></li>
				<li class="side_i5"><a href="user.php?mod=setting&act=base">Cài đặt tài khoản<span></span><i></i></a></li>

				<?php if(pe_login('user')):?>
				<li class="side_i7"><a href="javascript:user_logout();">đăng xuất<span></span><i></i></a></li>
				<?php endif;?>
			</ul>
		</div>
	</div>
</div>
<div class="foot_nav">
	<ul>
		<li><a href="<?php echo $pe['host_root'] ?>"><i class="foot_i1"></i><span>Trang đầu</span></a></li>
		<li><a href="<?php echo pe_url('category-list') ?>"><i class="foot_i2"></i><span>Phân loại</span></a></li>
		<li><a href="<?php echo pe_url('cart') ?>"><i class="foot_i5"></i><span>Giỏ hàng</span></a></li>
		<li><a href="<?php echo $pe['host_root'] ?>user.php?mod=order"><i class="foot_i3"></i><span>Đơn hàng của tôi</span></a></li>
		<li><a href="<?php echo $pe['host_root'] ?>user.php"><i class="foot_i4"></i><span>Thông tin cá nhân</span></a></li>
	</ul>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>