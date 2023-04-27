
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="<?php echo pe_url('article-list-'.$class_id) ?>"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content">
	<div class="dingdan_info1">
		<div class="mat10 font18 c333 aleft"><?php echo $info['article_name'] ?></div>
		<div class="mat10 font12 c999 fl">Được xuất bản vào：<?php echo pe_date($info['article_atime']) ?></div>
		<div class="mat10 font12 c999 fr"><?php echo $info['article_clicknum'] ?> người xem</div>
		<div class="clear"></div>
		<div class="xian"></div>
		<div class="danye_main mat20"><?php echo $info['article_text'] ?></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".danye_main img").removeAttr("height").removeAttr("width");
})
</script>
<?php include(pe_tpl('footer.html'));?>