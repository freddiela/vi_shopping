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
			<td align="right" width="150" class="c666">分类名称：</td>
			<td><input type="text" name="info[category_name]" value="<?php echo $info['category_name'] ?>" class="inputall input250" /></td>
		</tr>
		<tr>
			<td align="right" class="c666">上级分类：</td>
			<td>
				<select name="info[category_pid]" class="inputselect" style="width:268px">
				<option value="0">============ 无 ============</option>
				<?php foreach($category_treelist as $v):?>
				<option value="<?php echo $v['category_id'] ?>" <?php if($v['category_id']==$info['category_pid']):?>selected="selected"<?php endif;?> <?php if(in_array($v['category_id'], (array)$category_noid)):?>disabled="disabled"<?php endif;?>><?php echo $v['category_showname'] ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right" class="c666">分类排序：</td>
			<td><input type="text" name="info[category_order]" value="<?php echo $info['category_order'] ?>" class="inputall input80" /></td>
		</tr>
        <tr>
			<td align="right">分类图标：</td>
			<td>
				<p><img src="<?php echo pe_thumb($info['category_icon']) ?>" class="fl" style="border:1px solid #ddd;width:140px;height:140px" /></p>
				<p><input type="file" name="category_icon" /></p>
			</td>
		</tr>
		<tr>
			<td align="right" class="c666">页面标题：</td>
			<td><input type="text" name="info[category_title]" value="<?php echo $info['category_title'] ?>" class="inputall input500" /> <span class="c888">（SEO选项）</span></td>
		</tr>
		<tr>
			<td align="right" class="c666">页面关键词：</td>
			<td><input type="text" name="info[category_keys]" value="<?php echo $info['category_keys'] ?>" class="inputall input500" /> <span class="c888">（SEO选项）</span></td>
		</tr>
		<tr>
			<td align="right" class="c666">页面描述：</td>
			<td><textarea name="info[category_desc]" style="width:500px;height:100px;"><?php echo $info['category_desc'] ?></textarea> <span class="c888">（SEO选项）</span></td>
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