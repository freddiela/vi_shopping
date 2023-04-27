
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="main">
	<form method="post" id="form">
		<div class="zc_box2">
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=tname">
					<span class="sk_name">Họ tên thật</span>
					<div class="info_tt"><?php echo $info['user_tname'] ?></div>
					<i></i>
				</a>
			</div>
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=phone">
					<span class="sk_name">Số điện thoại</span>
					<div class="info_tt"><?php echo userbank_num($info['user_phone']) ?></div>
					<i></i>
				</a>
			</div>
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=email">
					<span class="sk_name">Hộp thư</span>
					<div class="info_tt"><?php echo $info['user_email'] ?></div>
					<i></i>
				</a>
			</div>
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=pw">
					<span class="sk_name">Mật khẩu đăng nhập</span>
					<div class="info_tt">Sửa đổi</div>
					<i></i>
				</a>
			</div>
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=paypw">
					<span class="sk_name">Mật khẩu thanh toán</span>
					<div class="info_tt">Sửa đổi</div>
					<i></i>
				</a>
			</div>
			<div class="zc_list sk_box">
				<a href="user.php?mod=setting&act=userbank">
					<span class="sk_name">Tài khoản nhận tiền</span>
					<div class="info_tt">Thiết lập</div>
					<i></i>
				</a>
			</div>
		</div>
	</form>
</div>
<div class="fb_btn1"><a href="javascript:user_logout();">Thoát khỏi tài khoản hiện tại</a></div>
<script type="text/javascript">
	function user_logout() {
		app_getinfo('user.php?mod=do&act=logout', function(json){
			if (json.result) {
				app_open('user.php', 1000);
			}
		});
	}
</script>
<style type="text/css">
	.info_tt{ text-align:right}
</style>
<?php include(pe_tpl('footer.html'));?>