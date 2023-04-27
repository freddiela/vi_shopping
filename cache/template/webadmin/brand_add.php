<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20">
		<tr>
			<td align="right" width="150">品牌名称：</td>
			<td><input type="text" name="info[brand_name]" value="<?php echo $info['brand_name'] ?>" class="inputall input300" /></td>
		</tr>
		<tr>
			<td align="right">品牌图片：</td>
			<td>
				<div>
					<img src="<?php echo pe_thumb($info['brand_logo']) ?>" class="fl" style="border:1px solid #ddd;width:140px;height:56px" />
					<span class="c999 fl mat15 mal10">（140*56）</span>
					<div class="clear"></div>
				</div>
				<p class="mat5"><input type="file" name="brand_logo" /></p>
			</td>
		</tr>
		<tr>
			<td align="right">品牌简介：</td>
			<td><textarea name="info[brand_text]" style="width:550px;height:180px;"><?php echo $info['brand_text'] ?></textarea></td>
		</tr>
		<tr>
			<td align="right">品牌排序：</td>
			<td><input type="text" name="info[brand_order]" value="<?php echo $info['brand_order'] ?>" class="inputall input60" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
				<input type="submit" name="pesubmit" value="提 交" class="tjbtn" />
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>