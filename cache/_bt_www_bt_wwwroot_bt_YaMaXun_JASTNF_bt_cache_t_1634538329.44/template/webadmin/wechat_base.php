<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="admin.php?mod=wechat&act=base" <?php if($mod=='wechat'):?>class="sel"<?php endif;?>>微信设置<i></i></a>
		<div class="clear"></div>
	</div>
	<form method="post" id="form">
	<div class="right_main">
		<div class="tixing corg">由于微信公众平台配置略微繁琐，请先阅读：<a href="http://www.qiye1000.com/xyshop/index.php?mod=doc&act=24" class="cblue" target="_blank">微信公众平台配置说明</a></div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tr>
			<td align="right" width="150">开发者AppID：</td>
			<td><input type="text" name="info[wechat_appid]" value="<?php echo $info['wechat_appid']['setting_value'] ?>" class="inputall input400" /></td>
		</tr>
		<tr>
			<td align="right">开发者AppSecret：</td>
			<td><input type="text" name="info[wechat_appsecret]" value="<?php echo $info['wechat_appsecret']['setting_value'] ?>" class="inputall input400" /></td>
		</tr>
		<tr>
			<td align="right">IP白名单：</td>
			<td><?php echo $_SERVER['SERVER_ADDR'] ?></td>
		</tr>
		<tr>
			<td align="right">业务域名：</td>
			<td><?php echo trim(substr($pe['host_root'], 7), '/') ?></td>
		</tr>
		<tr>
			<td align="right">JS接口安全域名：</td>
			<td><?php echo trim(substr($pe['host_root'], 7), '/') ?></td>
		</tr>
		<tr>
			<td align="right">网页授权域名：</td>
			<td><?php echo trim(substr($pe['host_root'], 7), '/') ?></td>
		</tr>
		</table>
	</div>
	<div class="now"><a href="javascript:;" class="sel">服务器配置<i></i></a></div>
	<div class="right_main">
		<div class="tixing corg">此项用于用户自由二次开发扩展，默认不用设置</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tr>
			<td align="right" width="150">服务器URL：</td>
			<td><?php echo $pe['host_root'] ?>api.php?mod=wechat_push</td>
		</tr>
		<tr>
			<td align="right">Token令牌：</td>
			<td>
				<?php echo $info['wechat_token']['setting_value'] ?>
				<input type="hidden" name="info[wechat_token]" value="<?php echo $info['wechat_token']['setting_value'] ?>" />
			</td>
		</tr>
		</table>
	</div>
	<div class="center mat20 mab20">
		<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
		<input type="submit" name="pesubmit" value="提 交" class="tjbtn" />	
	</div>
	</form>
</div>
<?php include(pe_tpl('footer.html','admin'));?>