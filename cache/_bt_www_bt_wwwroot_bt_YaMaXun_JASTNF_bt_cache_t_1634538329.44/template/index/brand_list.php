<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="brand_zm">
		<div class="brand_zm_l">
			全部品牌
			<p>All Brands</p>
		</div>
		<div class="bradn_zm_r">
			<a href="javascript:;" class="js_brandbtn sel">全部</a>
			<?php foreach($word_arr as $v):?>
			<a href="javascript:;" class="js_brandbtn brand_tt"><?php echo $v ?></a>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="brand_list mat15">
		<div class="pinpai">
			<?php foreach($info_list as $v):?>
			<a href="<?php echo pe_url('brand-'.$v['brand_id']) ?>" title="<?php echo $v['brand_name'] ?>" class="js_brand word_<?php echo $v['brand_word'] ?>" <?php if(++$brand_index%5==0):?>style="margin-right:0"<?php endif;?>>
				<div class="pinpai_box">
					<img src="<?php echo pe_thumb($v['brand_logo']) ?>" />
					<p><?php echo $v['brand_name'] ?></p>
				</div>
			</a>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".js_brandbtn").click(function(){
		$(".js_brandbtn").removeClass("sel");
		$(this).addClass("sel");
		if ($(this).text() == '全部') {
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