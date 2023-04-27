<?php include(pe_tpl('header.html'));?>
<body class="box">
<div class="pagetop">
	<form method="get" action="<?php echo $pe['host_root'] ?>index.php" target="_parent">
	<div class="fh"><a href="javascript:app_iframe_close()"></a></div>
	<div class="shop_top_m" style="padding-top:7px;">
		<div class="sear">
			<input type="hidden" name="mod" value="product" />
			<input type="hidden" name="act" value="list" />
			<div class="sear_input_box"><input name="keyword" type="text" value="<?php echo $_g_keyword ?>" class="sear_input" style="background:#eee;" placeholder="请输入商品名称" /></div>
			<div class="sear_tj"><input type="submit" value=" "></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="sear_r"><input type="submit" value="搜索"></div>
	</for1m>
</div>
<div class="sear_text">
	<div class="mat10 mal10 c888">搜索历史</div>
	<div class="user_list">
		<ul>
       
		<?php foreach($info_list as $v):?>
		<li>
			<a href="<?php echo $pe['host_root'] ?>index.php?mod=product&act=list&keyword=<?php echo $v ?>" target="_parent">
				<span></span><?php echo $v ?>
			</a>
		</li>
		<?php endforeach;?>
		</ul>
	</div>
</div>
<!--循环 End-->
<script type="text/javascript">
$(function(){
	$(":input[name='keyword']").val('').focus().val('<?php echo $_g_keyword ?>');
})
</script>
<?php include(pe_tpl('footer.html'));?>