
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="javascript:app_open('back');"></a></div>
	<div class="shop_top_m" style="padding-top:7px;">
		<form method="get">
			<div class="sear" onclick="javascript:app_iframe('<?php echo $pe['host_root'] ?>index.php?mod=search&keyword=<?php echo $_g_keyword ?>');">
				<div class="sear_input_box"><input name="keyword" type="text" value="<?php echo htmlspecialchars($_g_keyword) ?>" class="sear_input" style="background:#eee;" placeholder="Vui lòng nhập tên sản phẩm" /></div>
				<div class="sear_tj"><input type="submit" value=" "></div>
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="bg_fl" id="search_bg" style="display:none"></div>
<div class="screen">
	<!--分类筛选循环 Start-->
	<div class="screen01">
		<div class="screen_name" id="category_btn">
			<span class="fenlei_name"><?php echo $category_name ?></span> <i class="jt_xia1"></i>
		</div>
	</div>
	<div class="screen_list divhide" id="category_html">
		<div class="screen_left" style="width:100%;">
			<ul>
			<li <?php if($category_id==$category_zk_id):?>class="sel"<?php endif;?>><a href="<?php echo pe_url('product-list-') ?>">Toàn bộ </a><span></span></li>
			<?php if(is_array($cache_category_arr[$category_zk_id])):?>
			<?php foreach($cache_category_arr[$category_zk_id] as $k=>$v):?>
			<li <?php if($category_id==$k):?>class="sel"<?php endif;?>><a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>"><?php echo $v['category_name'] ?></a><span></span></li>
			<?php endforeach;?>
			<?php endif;?>
			</ul>
		</div>
	</div>
	<!--分类筛选循环 End-->
	<!--品牌筛选循环 Start-->
	<div class="screen01" id="orderby_btn">
		<div class="screen_name">
			<?php echo $brand_name ?> <i class="jt_xia1"></i>
		</div>
	</div>
	<div class="screen_list divhide" id="orderby_html">
		<div class="screen_left" style="width:100%;">
			<ul>
            <li <?php if(!$_g_brand):?>class="sel"<?php endif;?>><a href="<?php echo pe_updateurl('brand', '') ?>" title="Toàn bộ ">Toàn bộ </a></li>
			<?php foreach($brand_list as $k=>$v):?>
			<li <?php if($_g_brand==$v['brand_id']):?>class="sel"<?php endif;?>><a href="<?php echo pe_updateurl('brand', $v['brand_id']) ?>"><?php echo $v['brand_name'] ?></a><span></span></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<!--品牌筛选循环 End-->
	<!--排序筛选循环 Start-->
	<div class="screen01" id="orderby_btn">
		<div class="screen_name">
			<?php echo $orderby_name ?> <i class="jt_xia1"></i>
		</div>
	</div>
	<div class="screen_list divhide" id="orderby_html">
		<div class="screen_left" style="width:100%;height:246px">
			<ul>
            <li <?php if(!$_g_orderby):?>class="sel"<?php endif;?>><a href="<?php echo pe_updateurl('orderby', '') ?>">Tổng hợp trình tự </a></li>
			<?php foreach($orderby_list as $k=>$v):?>
			<li <?php if($_g_orderby==$k):?>class="sel"<?php endif;?>><a href="<?php echo pe_updateurl('orderby', $k) ?>"><?php echo $v ?></a><span></span></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<!--排序筛选循环 End-->
</div>
<!--循环 Start-->
<div class="content">
	<div class="tuijian_list mat10">
		<ul>
		<?php foreach($info_list as $k=>$v):?>
		<li>
			<div class="li_box">
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>">
					<div class="prolist_logo">
						<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>" title="<?php echo $v['product_name'] ?>" class="js_imgload" />
						<?php if($v['huodong_tag']):?><div class="prolist_tag"><?php echo $v['huodong_tag'] ?></div><?php endif;?>
					</div>
				</a>
				<div class="prolist_name">
					<p><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>"><?php echo $v['product_name'] ?></a></p>
					<span>¥<?php echo product_money($v['product_money']) ?></span>
				</div>
			</div>
		</li>
		<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="fenye mat10 mab10"><?php echo $db->page->html ?><div class="clear"></div></div>
</div>
<script type="text/javascript">
$(function(){
	$("#search_bg").click(function(){
		$("#search_bg").add(".screen_list").hide();
		$("body").css("overflow-y", "auto");
	})
	$(".screen01").click(function(){
		$(".screen_list").hide();
		var _index = $(this).index(".screen01");
		$(".screen_list:eq("+_index+")").show();
		$("#search_bg").show().height($(window).height() - 90);
		$("body").css("overflow-y", "hidden");
	})
	$("#category_html .screen_left li").click(function(){
		$("#category_html .screen_left li").removeClass("sel");
		$(this).addClass("sel");
		$(".screen_right").hide();
		$("#category_select" + $(this).attr("category_id")).show();
		$("body").css("overflow-y", "auto");
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>