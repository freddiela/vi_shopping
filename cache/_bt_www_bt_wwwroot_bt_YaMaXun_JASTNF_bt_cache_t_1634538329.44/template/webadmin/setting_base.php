<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<?php include(pe_tpl('setting_menu.html','admin'));?>
	<div class="right_main">
		<form method="post" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tr>
			<td align="right" width="150">网站标题：</td>
			<td><input type="text" name="info[web_title]" value="<?php echo $info['web_title']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">关&nbsp;&nbsp;键 词：</td>
			<td><input type="text" name="info[web_keywords]" value="<?php echo $info['web_keywords']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">网站描述：</td>
			<td><textarea name="info[web_description]" style="width:505px;height:100px;"><?php echo $info['web_description']['setting_value'] ?></textarea></td>
		</tr>
		<tr>
			<td align="right">PC版Logo：</td>
			<td>
				<div class="fl" style="width:510px">
					<?php if($info['web_logo']['setting_value']):?>
					<p class="mab5"><img src="<?php echo pe_thumb($info['web_logo']['setting_value']) ?>" height="55" style="border:1px solid #ddd" /></p>
					<?php endif?>
					<p><input type="file" name="web_logo" /></p>
				</div>
				<div class="fl c999 mal10 mat15">（电脑PC版Logo，尺寸300*55）</div>
				<div class="clear"></div>
			</td>
		</tr>
		<tr>
			<td align="right">H5版Logo：</td>
			<td>
				<div class="fl" style="width:510px">
					<?php if($info['wap_logo']['setting_value']):?>
					<p class="mab5"><img src="<?php echo pe_thumb($info['wap_logo']['setting_value']) ?>" height="55" style="border:1px solid #ddd" /></p>
					<?php endif?>
					<p><input type="file" name="wap_logo" /></p>
				</div>
				<div class="fl c999 mal10 mat15">（手机H5版Logo，尺寸200*200）</div>
				<div class="clear"></div>
			</td>
		</tr>
		<tr>
			<td align="right">公众号二维码：</td>
			<td>
				<?php if($info['web_qrcode']['setting_value']):?>
				<p class="mab5"><img src="<?php echo pe_thumb($info['web_qrcode']['setting_value']) ?>" height="70" style="border:1px solid #ddd" /></p>
				<?php endif?>
				<p><input type="file" name="web_qrcode" /></p>
			</td>
		</tr>
		<tr>
			<td align="right">客服电话：</td>
			<td><input type="text" name="info[web_phone]" value="<?php echo $info['web_phone']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">客服 QQ：</td>
			<td><input type="text" name="info[web_qq]" value="<?php echo $info['web_qq']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">在线客服：</td>
			<td><input type="text" name="info[online_service]" value="<?php echo $info['online_service']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">版权所有：</td>
			<td><input type="text" name="info[web_copyright]" value="<?php echo $info['web_copyright']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">ICP备案号：</td>
			<td><input type="text" name="info[web_icp]" value="<?php echo $info['web_icp']['setting_value'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">热门搜索：</td>
			<td>
				<input type="text" name="info[web_hotword]" value="<?php echo $info['web_hotword']['setting_value'] ?>" class="inputall input500" />
				<span class="c999 mal10">（多个请用“,”隔开）</span>
			</td>
		</tr>
		<tr>
			<td align="right">快递设置：</td>
			<td>
				<textarea name="info[web_wlname]" style="width:505px;height:120px;" class="fl"><?php echo $info['web_wlname']['setting_value'] ?></textarea>
				<span class="fl c999 mal10" style="margin-top:45px">（多个请用“,”隔开）</span>
				<div class="clear"></div>
			</td>
		</tr>
		<tr>
			<td align="right">统计代码：</td>
			<td>
				<textarea name="info[web_tongji]" style="width:505px;height:120px;" class="fl"><?php echo $info['web_tongji']['setting_value'] ?></textarea>
				<span class="fl c999 mal10" style="margin-top:45px">（第三方流量统计代码）</span>
				<div class="clear"></div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
				<input type="submit" name="pesubmit" value="提 交" class="tjbtn">
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>