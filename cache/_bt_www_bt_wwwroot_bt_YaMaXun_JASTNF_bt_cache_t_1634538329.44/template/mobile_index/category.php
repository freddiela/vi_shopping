<?php include(pe_tpl('header.html'));?>
<!-- 搜索框 -->
<div class="container">
	<!-- 搜索框 -->
	<div class="pagetop">
	<div class="fh"><a href="<?php echo $pe['host_root'] ?>"></a></div>
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
	<!-- /搜索框 -->
	<div class="cate-content dis-flex" >
	  <!-- 左侧 一级分类 -->
	  <div class="cate-left f-28">
      	<?php if(is_array($cache_category_arr[0])):?>
      	<?php foreach($cache_category_arr[0] as $k=>$v):?>
		<span class="type-nav onelist-hidden" data-id="<?php echo $k ?>"><?php echo $v['category_name'] ?></span>
        <?php endforeach;?>
        <?php endif;?>
	  </div>
	  <!-- 右侧 商品列表 -->
	  <div class="cate-right b-f">
		  <!-- 导航1数据box 开始-->
          <?php if(is_array($cache_category_arr[0])):?>
      	<?php foreach($cache_category_arr[0] as $k=>$v):?>
		  <div class="cate-right-cont">
			<div class="cate-two-box">
				<div class="cate-cont-box">
                	<?php if(is_array($cache_category_arr[$v['category_id']])):?>
					<?php foreach($cache_category_arr[$v['category_id']] as $kk=>$vv):?>
					<!-- 导航1数据 单条数据结构开始 -->
					<div class="flex-three">
					<a href="<?php echo pe_url('product-list-'.$vv['category_id']) ?>">
						<div class="cate-img" id="<?php echo $vv['category_id'] ?>">
							<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($vv['category_icon'], 78, 75) ?>" alt="<?php echo $vv['category_name'] ?>" class="js_imgload">
						</div>
						<span class="onelist-hidden"><?php echo $vv['category_name'] ?></span>
					</a>
					</div>
					<!-- 导航1数据 单条数据结构结束 -->
                    <?php endforeach;?>
                    <?php endif;?>
					
				</div>
			</div>
		  </div>
          <?php endforeach;?>
        <?php endif;?>
		  
	  </div>
	</div>
	<div >
	  <div class="yoshop-notcont">
		<span class="iconfont icon-wushuju"></span>
		<span class="cont">亲，暂无商品分类哦</span>
	  </div>
	</div>
  
</div>
<!--  -->
<!--  -->
<!--  -->
<script>
	//左侧导航默认选中第一个
	$('.type-nav').eq(0).addClass('selected');
	$('.cate-right-cont').eq(0).addClass('on');
	//绑定导航切换
	$(document).on('click','.type-nav',function(){
		var index = $(this).index();
		console.log(index)
		$(this).addClass('selected').siblings().removeClass('selected')
		$(".cate-right-cont").eq(index).addClass('on').siblings().removeClass('on')
	})
</script>
<?php include(pe_tpl('footer.html'));?>