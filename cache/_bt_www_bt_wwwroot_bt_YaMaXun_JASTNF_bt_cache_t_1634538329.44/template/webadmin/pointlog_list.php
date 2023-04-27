<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=pointlog" class="sel"><?php echo $menutitle ?>（<?php echo $tongji['all'] ?>）<i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				用户名：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext inputtext_100" />
				<select name="type" class="selectmini">
				<option value="" href="<?php echo pe_updateurl('type', '') ?>">= 积分类型 =</option>
				<?php foreach($ini['pointlog_type'] as $k=>$v):?>
				<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('type', $k) ?>" <?php if($_g_type==$k):?>selected="selected"<?php endif;?>><?php echo ++$index?>)<?php echo $v ?></option>
				<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="130">交易日期</th>
			<th class="bgtt" width="150">用户名</th>
			<th class="bgtt" width="100">交易类型</th>
			<th class="bgtt" width="100">增加(个)</th>
			<th class="bgtt" width="100">减少(个)</th>
			<th class="bgtt" width="100">结余(个)</th>
			<th class="bgtt">备注</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td class="num"><?php echo pe_date_color(pe_date($v['pointlog_atime'])) ?></span></td>
			<td><?php echo $v['user_name'] ?></td>
			<td><?php echo $ini['pointlog_type'][$v['pointlog_type']] ?></td>
			<td><span class="num strong cgreen"><?php echo $v['pointlog_in']?'+'.$v['pointlog_in']:'' ?></span></td>
			<td><span class="num strong cred"><?php echo $v['pointlog_out']?'-'.$v['pointlog_out']:'' ?></span></td>
			<td><span class="num"><?php echo $v['pointlog_now'] ?></span></td>
			<td class="aleft"><?php echo $v['pointlog_text'] ?></td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("select").change(function(){
		window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html','admin'));?>