<div class="huiyuan_left">
	<a href="user.php"><h3 class="hy_tb6"><s></s>个人中心</h3></a>
	<h3 class="hy_tb2"><s></s>Quản lý giao dịch</h3>
	<ul>
		<li><a href="user.php?mod=order" <?php if($menumark=='order'):?>class="sel"<?php endif;?>>Đơn hàng của tôi</a></li>
		<li><a href="user.php?mod=comment" <?php if($menumark=='comment'):?>class="sel"<?php endif;?>>Bình luận của tôi</a></li>
		<li><a href="user.php?mod=collect" <?php if($menumark=='collect'):?>class="sel"<?php endif;?>>Bộ sưu tập của tôi</a></li>
		<li><a href="user.php?mod=refund" <?php if($menumark=='refund'):?>class="sel"<?php endif;?>>Yêu cầu hoàn tiền / trả hàng </a></li>
		<li><a href="user.php?mod=order_recovery" <?php if($menumark=='order_recovery'):?>class="sel"<?php endif;?>>Trung tâm thu hồi</a></li>
	</ul>
	<div class="xuxian"></div>
	<h3 class="hy_tb4"><s></s>Trung tâm tài chính</h3>
	<ul>
    	<li><a href="user.php?mod=quan" <?php if($menumark=='quan'):?>class="sel"<?php endif;?>>Phiếu giảm giá của tôi</a></li>
		<li><a href="user.php?mod=moneylog" <?php if($menumark=='moneylog'):?>class="sel"<?php endif;?>>Chi tiết tiền quỹ  </a></li>
		<li><a href="user.php?mod=pointlog" <?php if($menumark=='pointlog'):?>class="sel"<?php endif;?>>Chi tiết tích điểm</a></li>
		<li><a href="user.php?mod=pay" <?php if(in_array($mod, array('pay', 'cashout'))):?>class="sel"<?php endif;?>>Nạp tiền / Rút tiền</a></li>
	</ul>
	<div class="xuxian"></div>
	<h3 class="hy_tb3"><s></s>Thiết lập người dùng</h3>
	<ul>
		<li><a href="user.php?mod=setting&act=base" <?php if($menumark=='setting_base'):?>class="sel"<?php endif;?>>Thông tin cá nhân</a></li>
		<li><a href="user.php?mod=setting&act=pw" <?php if($menumark=='setting_pw'):?>class="sel"<?php endif;?>>Thay đổi mật khẩu</a></li>
		<li><a href="user.php?mod=userbank" <?php if($menumark=='userbank'):?>class="sel"<?php endif;?>>Tài khoản nhận tiền</a></li>
		<li><a href="user.php?mod=useraddr" <?php if($menumark=='useraddr'):?>class="sel"<?php endif;?>>Địa chỉ nhận hàng</a></li>
	</ul>

	<?php if($cache_setting['tg_state']):?>
	<div class="xuxian"></div>
	<h3 class="hy_tb5"><s></s>Trung tâm mời gọi</h3>
	<ul>
		<li><a href="user.php?mod=tg" <?php if($menumark=='tg_index'):?>class="sel"<?php endif;?>>Mời bạn bè</a></li>
		<li style="padding-bottom:20px"><a href="user.php?mod=tg&act=list" <?php if($menumark=='tg_list'):?>class="sel"<?php endif;?>>Thu nhập của tôi</a></li>
	</ul>
	<?php endif;?>

</div>