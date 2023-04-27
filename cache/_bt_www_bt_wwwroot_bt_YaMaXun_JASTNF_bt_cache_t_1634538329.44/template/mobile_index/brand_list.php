
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="javascript:app_open('back')"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content">
	<div class="brand_zm">
		<div class="bradn_zm_r">
			<a href="javascript:;" class="js_brandbtn sel">Toàn bộ </a>
			<?php foreach($word_arr as $v):?>
			<a href="javascript:;" class="js_brandbtn brand_tt"><?php echo $v ?></a>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="pinpai">
		<?php foreach($info_list as $v):?>
		<div class="pinpai_list1">
			<div class="pinpai_mar5">
			<a href="<?php echo pe_url('brand-'.$v['brand_id']) ?>" title="<?php echo $v['brand_name'] ?>" class="js_brand word_<?php echo $v['brand_word'] ?>">
				<div class="pinpai_box">
					<img src="<?php echo pe_thumb($v['brand_logo']) ?>" />
					<p><?php echo $v['brand_name'] ?></p>
				</div>
			</a>
			</div>
		</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".js_brandbtn").click(function(){
		$(".js_brandbtn").removeClass("sel");
		$(this).addClass("sel");
		if ($(this).text() == 'Toàn bộ ') {
			$(".js_brand").show();		
		}
		else {
			$(".js_brand").hide();
			$(".word_"+$(this).text()).show();		
		}
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>