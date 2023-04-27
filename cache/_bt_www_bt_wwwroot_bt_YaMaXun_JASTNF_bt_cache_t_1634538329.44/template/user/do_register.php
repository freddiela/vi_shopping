<?php include(pe_tpl('do_header.html'));?>
<div class="login_bg1">
<div style="width:1000px; margin:0 auto; position:relative">
	<div class="login_r" style="height:410px; width:300px; position:absolute; right:0; top:-50px;">
		<div class="zctt_qh">
			<a href="javascript:;" class="js_reg sel" reg_type="phone">会员注册</a>
		<!-- 	<a href="javascript:;" class="js_reg" reg_type="email" style="border-right:0">邮箱注册</a> -->
			<div class="clear"></div>
		</div>
		<form method="post" id="form">
		<div class="zc_input1">
			用&nbsp;&nbsp;户 名：<input type="text" name="user_name" class="login_input1" placeholder="5-15位字符（字母/数字/汉字）" />
		</div>
		<div class="zc_input1 mat10">
			<input type="password" style="display:none;width:0;height:0;" disabled />
			登录密码：<input type="password" name="user_pw" class="login_input1" placeholder="请输入6-20位密码"  autocomplete="new-password" />
		</div>
		<!--<div class="zc_input1 mat10">
			确认密码：<input type="password" name="user_pw1" class="login_input1" placeholder="请再次输入登录密码" />
		</div>-->
		<div class="zc_input1 mat10 js_phone">
			真实姓名：<input type="text" name="user_tname" class="login_input1" placeholder="真实的姓名" />
		</div>
		<div class="zc_input1 mat10 js_phone">
			邀请码：<input type="text" name="invite_code" class="login_input1" placeholder="邀请码可空" value="<?php echo $invite_code ?>" />
		</div>
		<div class="zc_input1 mat10 js_email">
			电子邮箱：<input type="text" name="user_email" class="login_input1" placeholder="常用电子邮箱" />
		</div>
		<div class="zc_input1 mat10" style="border-bottom:1px #e2e2e2 solid; padding-right:0; width:290px">
			<span class="fl">验&nbsp;&nbsp;证 码：</span>
			<input type="text" name="authcode" class="login_input1 fl" placeholder="图片验证码" style="width:100px" />
			<img src="<?php echo $pe['host_root'] ?>public/class/authcode.class.php?w=100&h=40" onclick="pe_yzm(this)" class="fr mal5" style="cursor:pointer; border:0; height:40px;" />
			<div class="clear"></div>
		</div>
		<?php if($cache_setting['web_checkphone']):?>
		<div class="zc_input1 mat10 js_phone" style="position:relative">
			短信验证：<input type="text" name="phone_yzm" class="login_input1" placeholder="短信验证码" style="width:100px;" />
			<div class="user_yzm" href="<?php echo $pe['host_root'] ?>index.php?mod=check&act=send_yzm&type=reg" onclick="pe_sendyzm(this, 'user_phone')">获取验证码</div>
		</div>
		<?php endif;?>
		<?php if($cache_setting['web_checkemail']):?>
		<div class="zc_input1 mat10 js_email" style="position:relative">
			邮箱验证：<input type="text" name="email_yzm" class="login_input1" placeholder="邮箱验证码" style="width:100px;" />
			<div class="user_yzm" href="<?php echo $pe['host_root'] ?>index.php?mod=check&act=send_yzm&type=reg" onclick="pe_sendyzm(this, 'user_email')">获取验证码</div>
		</div>
		<?php endif;?>
		<div class="mat20">
			<input type="hidden" name="reg_type" value="email" />
			<input type="hidden" name="pesubmit" />
			<input type="button" class="loginbtn1" value="点击注册" />
		</div>
		</form>
		<div class="login_other mat20" style="text-align:right">
			已有注册账号？请直接 <a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&fromto=<?php echo urlencode($_g_fromto) ?>" title="登录"><span class="corg">登录</span></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
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
	})
	$(".js_reg:eq(0)").click();
	$(":button").click(function(){
		if ($(":input[name='user_name']").val() == '') {
			pe_tip('请填写用户名');
			return false;
		}
		if ($(":input[name='user_pw']").val() == '') {
			pe_tip('请填写登录密码');
			return false;
		}
		/*if ($(":input[name='user_pw1']").val() == '') {
			pe_tip('请填写确认密码');
			return false;
		}
		if ($(":input[name='user_pw']").val() != $(":input[name='user_pw1']").val()) {
			pe_tip('登录密码与确认密码不一致');
			return false;
		}*/
		if ($(":input[name='reg_type']").val() == 'email' && $(":input[name='user_email']").val() == '') {
			pe_tip('请填写电子邮箱');
			return false;
		}
		if ($(":input[name='reg_type']").val() == 'phone' && $(":input[name='user_phone']").val() == '') {
			pe_tip('请填写手机号码');
			return false;
		}
		if ($(":input[name='authcode']").val() == '') {
			pe_tip('请填写图形验证码');
			return false;
		}
		$(this).val('提交中...');
		pe_submit('user.php?mod=do&act=register', function(json){
			if (json.result) {
				if ('<?php echo $_g_fromto ?>' != '') {
					pe_open('<?php echo $_g_fromto ?>', 1000);
				}
				else {
					pe_open('user.php', 1000);				
				}
			}
			else {
	    		$(":button").val('注 册');			
			}
		})
	})
})
</script>
<?php include(pe_tpl('do_footer.html'));?>