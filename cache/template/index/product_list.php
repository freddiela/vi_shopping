<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now"><?php echo $nowpath ?></div>
	<div class="">		
		<div class="list_sx">
			<div class="pinpai_fl mal10">
				<span class="list_sx_l">Phân loại：</span>
				<div class="list_sx_r">
				<a href="<?php echo pe_url('product-list-'.$category_zk_id) ?>" title="全部" <?php if($category_id==$category_zk_id):?>class="sel"<?php endif;?>>Toàn bộ </a>
				<?php if(is_array($cache_category_arr[$category_zk_id])):?>
				<?php foreach($cache_category_arr[$category_zk_id] as $k=>$v):?>				
				<a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>" title="<?php echo $v['category_name'] ?>" <?php if($category_id==$k):?>class="sel"<?php endif;?>><?php echo $v['category_name'] ?></a>
				<?php endforeach;?>
				<?php endif;?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="shixian mat15 mab15"></div>
			<?php if(count($brand_list)):?>
			<div class="pinpai_fl mal10">
				<span class="list_sx_l">Thương hiệu：</span>
				<div class="list_sx_r">
				<a href="<?php echo pe_updateurl('brand', '') ?>" title="Toàn bộ " <?php if(!$_g_brand):?>class="sel"<?php endif;?>>Toàn bộ </a>
				<?php foreach($brand_list as $v):?>
				<a href="<?php echo pe_updateurl('brand', $v['brand_id']) ?>" title="<?php echo $v['brand_name'] ?>" <?php if($_g_brand==$v['brand_id']):?>class="sel"<?php endif;?>><?php echo $v['brand_name'] ?></a>
				<?php endforeach;?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="shixian mat15 mab15"></div>
			<?php endif;?>
			<div class="pinpai_fl mal10">
				<span class="list_sx_l">Trình tự ：</span>
				<div class="list_sx_r">
				<ul>
					<li class="prolist_px"><a href="<?php echo pe_updateurl('orderby', '') ?>" <?php if(!$_g_orderby):?>class="sel"<?php endif;?>>Tổng hợp trình tự </a></li>
					<li class="prolist_px"><a href="<?php echo pe_updateurl('orderby', 'sellnum_desc') ?>" <?php if($_g_orderby=='sellnum_desc'):?>class="sel"<?php endif;?>>Số lượng bán hàng</a></li>
					<li class="prolist_px">
						<?php if($_g_orderby=='money_asc'):?>
						<a href="<?php echo pe_updateurl('orderby', 'money_desc') ?>" class="sel">Giá bán<i class="i4"></i></a>
						<?php elseif($_g_orderby=='money_desc'):?>
						<a href="<?php echo pe_updateurl('orderby', 'money_asc') ?>" class="sel">Giá bán<i class="i1"></i></a>
						<?php else:?>
						<a href="<?php echo pe_updateurl('orderby', 'money_desc') ?>"><span class="fl">Giá bán</span></a>
						<?php endif;?>
					</li>
					<li class="prolist_px"><a href="<?php echo pe_updateurl('orderby', 'commentnum_desc') ?>" <?php if($_g_orderby=='commentnum_desc'):?>class="sel"<?php endif;?>>Đánh giá Số </a></li>
					<li class="prolist_px"><a href="<?php echo pe_updateurl('orderby', 'clicknum_desc') ?>" <?php if($_g_orderby=='clicknum_desc'):?>class="sel"<?php endif;?>>Nhân khi</a></li>
				</ul>
				</div>
				<!--<span class="fr mat8 mar10 c888">已找到 <strong><?php echo $db->page->listnums ?></strong> 个商品</span>-->
				<div class="clear"></div>
			</div>
		</div>
		<div class="prolist_html">
			<?php foreach($info_list as $k=>$v):?>
			<div class="prolist" <?php if(($k+1)%4==0):?>style="margin-right:0"<?php endif;?>>
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank">
				<div class="pro_bq">
					<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>" title="<?php echo $v['product_name'] ?>" width="250" height="250" class="js_imgload" />
					<?php if($v['huodong_tag']):?><div class="bq_name"><?php echo $v['huodong_tag'] ?></div><?php endif;?>
				</div>
				<p class="prolist_name"><?php echo $v['product_name'] ?></p>
				<p class="mat8">
					<span class="money1 fl"><span class="num font18 mar3">₫</span><?php echo product_money($v['product_money']) ?></span>
					<span class="font12 fr c999">Đã bán<?php echo $v['product_sellnum'] ?>Miếng</span>
				</p>
				<div class="clear"></div>
				</a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="fenye mat15"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>