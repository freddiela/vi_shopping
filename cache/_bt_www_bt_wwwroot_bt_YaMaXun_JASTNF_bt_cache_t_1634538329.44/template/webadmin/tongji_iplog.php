<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<?php include(pe_tpl('tongji_menu.html','admin'));?>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="100">ID号</th>
			<th class="bgtt" width="200">访客所在地</th>
			<th class="bgtt" width="200">访客IP</th>
			<th class="bgtt" width="200">访问日期</th>
			<th class="bgtt" width="200">访问时间</th>
			<th class="bgtt"></th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td class="num"><?php echo $v['iplog_id'] ?></td>
			<td class="ipname" ip="<?php echo $v['iplog_ip'] ?>"><img src="<?php echo $pe['host_admintpl'] ?>images/load.gif" /></td>
			<td class="num"><a href="http://www.ip138.com/ips.asp?ip=<?php echo $v['iplog_ip'] ?>" target="_blank"><?php echo $v['iplog_ip'] ?></a></td>
			<td class="num"><?php echo pe_date_color(pe_date($v['iplog_atime'])) ?></td>
			<td class="num"><?php echo pe_dayago($v['iplog_atime']) ?></td>
			<td></td>
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
	var ips = new Array();
	$(".ipname").each(function(){
		ips.push($(this).attr("ip"));
	})
	$.getJSON("http://www.phpshe.com/index.php?mod=api&act=ipname&ips="+ips.join(",")+"&callback=?", function(json){
		$(".ipname").each(function(index){
			$(this).html(json.ipname[index]);
		})
	})
})
</script>
<?php include(pe_tpl('footer.html','admin'));?>