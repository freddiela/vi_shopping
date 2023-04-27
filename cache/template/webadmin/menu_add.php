<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tr>
			<td align="right" width="150">导航名称：</td>
			<td><input type="text" name="info[menu_name]" value="<?php echo $info['menu_name'] ?>" class="inputall input200" /> <span class="c888">（如：百度）</span></td>
		</tr>
		<tr>
			<td align="right">链接地址：</td>
			<td>
				<select name="info[menu_type]" class="inputselect">
				<option value="diy">自定义链接</option>
				<?php foreach($menu_sys_arr as $k=>$v):?>
				<?php if($v == 'line'):?>	
				<option disabled>==========分割线==========</option>
				<?php else:?>
				<option value="<?php echo $v['modurl'] ?>" url="<?php echo $v['url'] ?>" <?php if($v['modurl']==$info['menu_url']):?>selected="selected"<?php endif;?>><?php echo $k ?></option>			
				<?php endif;?>
				<?php endforeach;?>
				</select>
				<input type="text" name="info[menu_url]" value="<?php echo $info['menu_url'] ?>" class="inputall input400" /> <!--<span class="c888">（如：http://www.phpshe.com）</span>-->
			</td>
		</tr>
		<tr>
			<td align="right" width="150">打开方式：</td>
			<td>
				<?php foreach(array(1=>'新标签', 0=>'当前页') as $k=>$v):?>
				<label class="mar20"><input type="radio" name="info[menu_target]" value="<?php echo $k ?>" class="inputfix" <?php if($k==$info['menu_target']):?>checked="checked"<?php endif;?> /> <?php echo $v ?>&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<td align="right">显示顺序：</td>
			<td><input type="text" name="info[menu_order]" value="<?php echo $info['menu_order'] ?>" class="inputall input100" /></td>
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
<script type="text/javascript">
$(function(){
	menu_html(1);
	$(":input[name='info[menu_type]']").change(function(){
		menu_html();
	})
})
function menu_html(init) {
	if ($(":input[name='info[menu_type]']").find(":checked").val() == 'diy') {
		if (init == 1) {
			$(":input[name='info[menu_url]']").removeAttr("disabled");		
		}
		else {
			$(":input[name='info[menu_url]']").removeAttr("disabled").val('');		
		}
	}
	else {
		$(":input[name='info[menu_url]']").attr("disabled", "disabled").val($(":input[name='info[menu_type]']").find(":checked").attr("url"));
	}
}
</script>
<?php include(pe_tpl('footer.html','admin'));?>