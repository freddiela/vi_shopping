
<?php include(pe_tpl('header.html'));?>
<style>body{background:#FFF!important;}</style>
<div class="login_top">
	<div class="zc_tt" style="color:#000;">用户注册</div>
	<div class="top_dl"><img src="<?php echo pe_thumb($cache_setting['wap_logo']) ?>"></div>
	<a class="u_fh" href="<?php echo $pe['host_root'] ?>"><i class="sy_ico"></i></a>
</div>
<div class="">
	<form method="post" id="form">
	<div class="zc_box1">
		<!--<div class="dl_sx">-->
			<!--<a href="javascript:;" class="logintype js_reg sel" reg_type="phone">手机号注册</a>-->
			<!--<a href="javascript:;" class="logintype js_reg" reg_type="email">邮箱注册</a>-->
		<!--	<div class="clear"></div>-->
		<!--</div>-->
		<div class="clear"></div>
		<div class="zc_list">
			<div class="zc_mal zc_i1"><input type="text" name="user_name" class="zc_input1" placeholder="用户名（5-15位字符）" /></div>
		</div>
		<div class="zc_list">
			<div class="zc_mal zc_i2">
				<input type="password" style="display:none;width:0;height:0;" disabled="disabled" />
				<input type="password" name="user_pw" class="zc_input1" placeholder="登录密码（6-20位字符）" autocomplete="new-password" />
			</div>
		</div>
		<!--<div class="zc_list">
			<div class="zc_mal zc_i2"><input type="password" name="user_pw1" class="zc_input1" placeholder="再次输入登录密码" /></div>
		</div>-->
		<div class="zc_list js_phone">
			<div class="zc_mal zc_i5"><input type="text" name="user_tname" class="zc_input1" placeholder="真实姓名" /></div>
		</div>
		<!--<div class="zc_list js_email">-->
		<!--	<div class="zc_mal zc_i3"><input type="text" name="user_email" class="zc_input1" placeholder="电子邮箱" /></div>-->
		<!--</div>-->
		<?php if($cache_setting['tg_state']):?>
		<div class="zc_list js_phone"> 
			<div class="zc_mal zc_i4"><input type="text" name="invite_code" class="zc_input1" placeholder="邀请码" value="<?php echo $invite_code ?>" /></div>
		</div>
		<?php endif;?>
		<!--<div class="zc_list">
			<div class="zc_mal zc_i4">
				<input type="text" name="authcode" class="zc_input1" placeholder="图片验证码" />
				<img src="<?php echo $pe['host_root'] ?>public/class/authcode.class.php?w=100&h=41" onclick="pe_yzm(this)" class="zc_imgyzm" style="cursor:pointer;" />
			</div>
		</div>-->
		<?php if($cache_setting['web_checkphone']):?>
		<div class="zc_list js_phone" style="border-bottom:0">
			<div class="zc_mal zc_i4">
				<input type="text" name="phone_yzm" class="zc_input1" placeholder="短信验证码" />
				<div class="zc_smsyzm" href="<?php echo $pe['host_root'] ?>index.php?mod=check&act=send_yzm&type=reg" onclick="pe_sendyzm(this, 'user_phone')">获取验证码</div>
			</div>
		</div>
		<?php endif;?>
		<?php if($cache_setting['web_checkemail']):?>
		<div class="zc_list js_email" style="border-bottom:0">
			<div class="zc_mal zc_i4">
				<input type="text" name="email_yzm" class="zc_input1" placeholder="邮箱验证码" />
				<div class="zc_smsyzm" href="<?php echo $pe['host_root'] ?>index.php?mod=check&act=send_yzm&type=reg" onclick="pe_sendyzm(this, 'user_email')">获取验证码</div>
			</div>
		</div>
		<?php endif;?>
	</div>
	<div class="loginbtn" style="margin:20px;">
		<input type="hidden" name="reg_type" value="email" />
		<input type="hidden" name="pesubmit" />
		<input type="button" value="注 册" />
	</div>
	</form>
	<div class="zh_zc1" style="text-align:center;"><a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&fromto=<?php echo urlencode($_g_fromto) ?>" title="登录">直接登录</a></div>
</div>
<script type="text/javascript">
$(function(){
	$(".js_reg").click(function(){
		$(".js_reg").removeClass("sel");
		$(this).addClass("sel");
		if ($(this).attr("reg_type") == 'email') {
			$(".js_email").show().find(":input").removeAttr("disabled");
			$(".js_phone").hide().find(":input").attr("disabled", "disabled");
		}
		else {
			$(".js_phone").show().find(":input").removeAttr("disabled");
			$(".js_email").hide().find(":input").attr("disabled", "disabled");	
		} 
		$(":input[name='reg_type']").val($(this).attr("reg_type"));
		$(".zc_list:visible:last").css("border-bottom", "0");
	})
	$(".js_reg:eq(0)").click();
	$(":button").click(function(){
		if ($(":input[name='user_name']").val() == '') {
			app_tip('请填写用户名');
			return false;
		}
		if ($(":input[name='user_pw']").val() == '') {
			app_tip('请填写登录密码');
			return false;
		}
		/*if ($(":input[name='user_pw1']").val() == '') {
			app_tip('请填写确认密码');
			return false;
		}
		if ($(":input[name='user_pw']").val() != $(":input[name='user_pw1']").val()) {
			app_tip('登录密码与确认密码不一致');
			return false;
		}*/
		if ($(":input[name='reg_type']").val() == 'email' && $(":input[name='user_email']").val() == '') {
			app_tip('请填写电子邮箱');
			return false;
		}
		if ($(":input[name='reg_type']").val() == 'phone' && $(":input[name='user_phone']").val() == '') {
			app_tip('请填写手机号码');
			return false;
		}
		/*if ($(":input[name='authcode']").val() == '') {
			app_tip('请填写图形验证码');
			return false;
		}*/
		$(this).val('提交中...');
		app_submit('user.php?mod=do&act=register', function(json){
			if (json.result) {
				if ('<?php echo $_g_fromto ?>' != '') {
					app_open('<?php echo $_g_fromto ?>', 1000);
				}
				else {
					app_open('user.php', 1000);				
				}
			}
			else {
	    		$(":button").val('注 册');			
			}
		})
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>