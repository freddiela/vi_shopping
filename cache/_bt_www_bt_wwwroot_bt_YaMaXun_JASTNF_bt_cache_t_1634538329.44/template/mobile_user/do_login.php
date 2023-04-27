<?php include(pe_tpl('header.html'));?>
<style>body{background:#FFF!important;}</style>

<div class="login_top">
	<div class="zc_tt">Người sử dùng đăng nhập</div>
	<div class="top_dl"><img src="<?php echo pe_thumb($cache_setting['wap_logo']) ?>"></div>
	<a class="u_fh" href="<?php echo $pe['host_root'] ?>"><i class="sy_ico"></i></a>
</div>
<form method="post" id="form">
	<div class="zc_box1" style="padding:0 10px">
		<div class="zc_list">
			<div class="zc_mal zc_i1"><input type="text" name="user_name" class="zc_input1" placeholder="Tên người dùng / số điện thoại di động / hộp thư" /></div>
		</div>
		<div class="zc_list">
			<div class="zc_mal zc_i2"><input type="text" name="user_pw" class="zc_input1" placeholder="Mật khẩu đăng nhập" onfocus="this.type='password'" /></div>
		</div>
	</div>
	<div class="loginbtn" style="margin:30px 20px;">
		<input type="hidden" name="pesubmit" />
		<input type="button" value="Đăng nhập" />
	</div>
</form>
<div class="zh_zc1">
	<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register&fromto=<?php echo urlencode($_g_fromto) ?>" class="mar10">Đăng ký miễn phí</a> |
	<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=getpw" class="mal10">Quên mật khẩu</a>
	<?php if($service && $service['setting_value']):?>
	<div style="margin-top: 20px;"><a href="<?php echo $service['setting_value'] ?>" style="color: #3366CC;">Liên hệ với phụ vụ khách hàng</a></div>
	<?php endif;?>
</div>
<script type="text/javascript">
	$(function(){
		$(":button").click(function(){
			if ($(":input[name='user_name']").val() == '') {
				app_tip('Vui lòng điền số tài khoản');
				return false;
			}
			if ($(":input[name='user_pw']").val() == '') {
				app_tip('Vui lòng điền mật khẩu');
				return false;
			}
			$(this).val('Đang đăng nhập...');
			app_submit('user.php?mod=do&act=login', function(json){
				if (json.result) {
					if ('<?php echo $_g_fromto ?>' != '') {
						app_open('<?php echo $_g_fromto ?>', 1000);
					}
					else {
						app_open('user.php', 1000);
					}
				}
				else {
					$(":button").val('Đăng nhập');
				}
			})
		})
	})
</script>
<?php include(pe_tpl('footer.html'));?>