
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php?mod=setting&act=base"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="main">
	<form method="post" id="form">
	<div class="zc_box2">
		<?php if($user['user_paypw']):?>
		<div class="zc_list">
			<div class="zc_name">Mật khẩu hiện tại</div>
			<div class="zc_text"><input type="password" name="user_oldpw" placeholder="Mật khẩu hiện tại" /></div>
		</div>
		<?php endif;?>
		<div class="zc_list">
			<div class="zc_name">Mật khẩu thanh toán mới</div>
			<div class="zc_text"><input type="password" name="user_pw" placeholder="Mật khẩu thanh toán mới" /></div>
		</div>
		<div class="zc_list">
			<div class="zc_name">Xác nhận mật khẩu mới</div>
			<div class="zc_text"><input type="password" name="user_pw1" placeholder="Xác nhận mật khẩu mới" /></div>
		</div>
	</div>
	<div class="loginbtn" style="margin:20px 10px;">
		<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
		<input type="hidden" name="pesubmit" />
		<input type="button" value="Gửi" />
	</div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	$(":button").click(function(){
		/*if ($(":input[name='user_oldpw']").val().length == 0) {
			app_tip('Vui lòng nhập mật khẩu ban đầu');
			return false;
		}
		if ($(":input[name='user_pw']").val().length < 6 || $(":input[name='user_pw']").val().length > 20) {
			app_tip('Mật khẩu mới có 6-20 ký tự');
			return false;
		}
		if ($(":input[name='user_pw1']").val().length < 6 || $(":input[name='user_pw1']").val().length > 20) {
			app_tip('Xác nhận mật khẩu 6-20 ký tự');
			return false;
		}
		if ($(":input[name='user_pw']").val() != $(":input[name='user_pw1']").val()) {
			app_tip('Mật khẩu mới và mật khẩu xác nhận không trung khớp');
			return false;
		}*/
		app_submit("<?php echo pe_nowurl() ?>", function(json){
			if (json.result) {
				var url = '<?php echo $_g_fromto ?>' ? '<?php echo $_g_fromto ?>' : 'user.php?mod=setting&act=base';
				app_open(url, 1000);
			}
		});
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>