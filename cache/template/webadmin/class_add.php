<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20">
		<tr>
			<td align="right">分类类型：</td>
			<td>
				<?php foreach(array('news'=>'资讯中心', 'help'=>'帮助中心') as $k=>$v):?>
				<?php $checked = ((!$info['class_type'] && $k=='news') or ($info['class_type'] && $k==$info['class_type'])) ? 'checked="checked"' : ''?>
				<label class="mar10"><input type="radio" name="info[class_type]" value="<?php echo $k ?>" <?php echo $checked ?> /> <?php echo $v ?></label>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<td align="right" width="150">分类名称：</td>
			<td><input type="text" name="info[class_name]" value="<?php echo $info['class_name'] ?>" class="inputall input200" /></td>
		</tr>
		<tr>
			<td align="right">分类排序：</td>
			<td><input type="text" name="info[class_order]" value="<?php echo $info['class_order'] ?>" class="inputall input80" /></td>
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