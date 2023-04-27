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
			<td align="right" width="150">广告位置：</td>
			<td>
				<select name="ad_position" class="inputselect">
				<?php foreach($ini['ad_type'] as $k=>$v):?>
				<?php foreach($v['list'] as $kk=>$vv):?>
				<option value="<?php echo $k ?>|<?php echo $kk ?>" <?php if($k==$info['ad_type'] && $kk==$info['ad_position']):?>selected="selected"<?php endif;?>><?php echo $v['name'] ?> - <?php echo $vv['name'] ?><?php echo $vv['size'] ?></option>
				<?php endforeach;?>
				<?php endforeach;?>
				</select>		
			</td>
		</tr>
		<tr>
			<td align="right">广告图片：</td>
			<td>
				<p><img src="<?php echo pe_thumb($info['ad_logo']) ?>" width="410" height="180" style="border:1px solid #ddd" /></p>
				<p><input type="file" name="ad_logo" /></p>
			</td>
		</tr>
		<tr>
			<td align="right">广告链接：</td>
			<td><input type="text" name="info[ad_url]" value="<?php echo $info['ad_url'] ?>" class="inputall input400" /></td>
		</tr>
		<tr>
			<td align="right">广告状态：</td>
			<td>
				<?php foreach(array(1=>'显示', 0=>'隐藏') as $k=>$v):?>
				<label style="margin-right:20px"><input type="radio" name="info[ad_state]" value="<?php echo $k ?>" <?php if($info['ad_state']==$k):?>checked="checked"<?php endif;?> /> <?php echo $v ?></label>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<td align="right">显示顺序：</td>
			<td><input type="text" name="info[ad_order]" value="<?php echo $info['ad_order'] ?>" class="inputall input80" /></td>
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
var category_lists = <?php echo $category_list ?>;
$(function(){
	category_show("<?php echo $info['category_id'] ?>");
	$(":input[name='info[ad_position]']").change(function(){
		category_show();
	})
})
function category_show(category_id) {
	category_list = category_lists[$(":input[name='info[ad_position]'] option:selected").val()];
	var category_id = category_id ? category_id : 0;
	if (typeof(category_list) == 'object') {
		var html = '<select name="info[category_id]" class="inputselect mal5">';
		html += '<option value="0">= 请选择 =</option>';
		for (var k in category_list) {
			var selected = (category_list[k]['id'] == category_id) ? 'selected="selected"' : "";
			html += '<option value="'+category_list[k]['id']+'" '+selected+'>'+category_list[k]['name']+'</option>';
		}
		html +="</option>";
		$(":input[name='info[ad_position]']").after(html);
	}
	else {
		$(":input[name='info[category_id]']").remove();
	}
}
</script>
<?php include(pe_tpl('footer.html','admin'));?>