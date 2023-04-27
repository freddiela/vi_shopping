<?php include(pe_tpl('do_header.html'));?>
<div class="login_bg">
	<div style="width:1000px; margin:0 auto">
		<div class="login_r">
			<div class="zctt"><?php echo $menutitle ?></div>
			<form method="post" id="form">
				<div class="zc_input1">
					Đăng nhập tài khoản：<input type="text" name="user_name" class="login_input1" placeholder="Tên người dùng / số điện thoại di động / hộp thư" />
				</div>
				<div class="zc_input1 mat20">
					Mật khẩu đăng nhập：<input type="text" name="user_pw" class="login_input1" placeholder="Mật khẩu đăng nhập" onfocus="this.type='password'" />
				</div>
				<div class="mat25">
					<input type="hidden" name="pesubmit" />
					<input type="button" class="loginbtn1" value="Đăng nhập ngay lập tức" />
				</div>
			</form>
			<div class="login_other mat20">
				<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register" class="mar10">Đăng kí miễn phí</a> |
				<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=getpw" class="mal10">Quên mật khẩu</a>
				<?php if($service && $service['setting_value']):?>
				<div style="margin-top: 5px;"><a href="<?php echo $service['setting_value'] ?>" style="color: #3366CC;">Liên hệ với phụ vụ khách hàng</a></div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(window).keydown(function (event) {
			if (event.keyCode == 13) $(":button").click();
		});
		$(":button").click(function(){
			if ($(":input[name='user_name']").val() == '') {
				pe_tip('Vui lòng điền số tài khoản');
				return false;
			}
			if ($(":input[name='user_pw']").val() == '') {
				pe_tip('Vui lòng điền mật khẩu');
				return false;
			}
			$(this).val('Đang đăng nhập...');
			pe_submit('user.php?mod=do&act=login', function(json){
				if (json.result) {
					if ('<?php echo $_g_fromto ?>' != '') {
						pe_open('<?php echo $_g_fromto ?>', 1000);
					}
					else {
						pe_open('user.php', 1000);
					}
				}
				else {
					$(":button").val('Đăng nhập');
				}
			})
		})
	})
</script>
<?php include(pe_tpl('do_footer.html'));?>