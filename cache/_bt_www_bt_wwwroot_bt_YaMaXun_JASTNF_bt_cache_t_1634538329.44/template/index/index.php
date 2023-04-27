<?php include(pe_tpl('header.html'));?>
<div class="content" style="padding-top:5px">
	<div class="jdt_banner">
		<ul class="banList">
			<?php $index_jdt = 1;?>
			<?php foreach($cache_ad['pc']['index_jdt'] as $k=>$v):?>
			<li <?php if($index_jdt++==1):?>class="active1"
				<?php endif;?>><a href="<?php echo $v['ad_url'] ?>" target="_blank"><img src="<?php echo pe_thumb($v['ad_logo']) ?>" /></a>
			</li>
			<?php endforeach;?>
		</ul>
		<div style="position:relative; width:725px; margin:0 auto; z-index:100">
			<div class="fomW">
				<div class="jsNav">
					<?php $index_jdt = 1;?>
					<?php foreach($cache_ad['pc']['index_jdt'] as $v):?>
					<a href="javascript:;" class="trigger <?php if($index_jdt++==1):?>current<?php endif;?>"></a>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
	<div class="fr top_right">
		<div class="action_list">
			<div class="action_tt">
				<h3 class="fl"><?php echo $cache_class[1]['class_name'] ?></h3>
				<a class="fr" href="<?php echo pe_url('article-list-1') ?>">Nhiều hơn ></a>
				<div class="clear"></div>
			</div>
			<ul>
				<?php foreach($notice_list as $k=>$v):?>
				<li <?php if($k>=7):?>style="border-bottom:0"
					<?php endif;?>><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>"
						target="_blank"><?php echo $v['article_name'] ?></a><?php echo pe_date($v['article_atime'], 'm-d') ?>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="top_fuwu">
			<ul>
				<li>
					<i class="i_1"></i>
					<h3>Đảm bảo tính xác thực</h3>
				</li>
				<li>
					<i class="i_3"></i>
					<h3>Giao hàng như chóp</h3>
				</li>
				<li style="border-right:0">
					<i class="i_4"></i>
					<h3>Đảm bảo hoàn trả hàng</h3>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	<!--限时折扣 Start-->
	<?php if(count($product_zhekou)):?>
	<div class="mx_tt">
		<span class="fl">Thời hạn chiết khấu</span>
		<a href="<?php echo pe_url('huodong-zhekou') ?>" class="fr">Nhiều hơn></a>
		<div class="clear"></div>
	</div>
	<div class="mx_box">
		<?php foreach($product_zhekou as $k=>$v):?>
		<div class="mx_pro" <?php if(($k+1)%5==0):?>style="padding-right:0; border-right:0"
			<?php endif?>>
			<?php if($v['huodong_stime'] <= time() && $v['isUser'] == 1):?>
			<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank">
				<?php else:?>
				<a  title="<?php echo $v['product_name'] ?>">
					<?php endif;?>
					<div class="ms_pro">
						<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>"
							title="<?php echo $v['product_name'] ?>" width="195" height="195" class="js_imgload" />
						<div class="ms_time">
							<?php if($v['huodong_stime'] >= time()):?>
							<span class="timer-text">Trước khi chương trình bắt đầu</span>
							<span class="huodong_time" endtime="<?php echo $v['huodong_stime'] ?>"></span>
							<input class="refresh_etime" type="hidden" value="<?php echo $v['huodong_etime'] ?>" />
							<?php else:?>
							Còn lại <span class="huodong_time" endtime="<?php echo $v['huodong_etime'] ?>"></span>
							<?php endif;?>
						</div>
						<div class="ms_bg"></div>
					</div>
					<div style="padding:5px 0 0">
						<p class="prolist_name1"><?php echo $v['product_name'] ?></p>
						<div class=""><s class="c999 font12">Giá gốc：¥<?php echo product_money($v['product_smoney']) ?></s></div>
						<div class="ms_jg">
							<span class="ms_jg_l">
								<span class="money3">¥<?php echo product_money($v['product_money']) ?></span>
							</span>
							<!-- <span class="ms_jg_r">立即抢购</span> -->
							<?php if($v['huodong_stime'] >= time()):?>
							<span class="ms_jg_r" style="background-color: #a8a0a0;">Chờ đợi bắt đầu</span>
							<?php else:?>
							<?php if($v['isUser'] == 1):?>
							<span class="ms_jg_r">Lập tức chọn mua</span>
							<?php else:?>
							<span style="background-color: #a8a0a0;" class="ms_jg_r">Lập tức chọn mua</span>
							<?php endif;?>
							<?php endif;?>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
				</a>
		</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<?php endif;?>
	<!--限时折扣 End-->
	<!--分类1 Start-->
	<?php foreach($category_indexlist as $category):?>
	<div class="prolist_html mat20">
		<div class="prolist_tt">
			<div class="fl">
				<h3><?php echo $category['category_name'] ?></h3>
			</div>
			<a href="<?php echo pe_url('product-list-'.$category['category_id']) ?>" title="<?php echo $category['category_name'] ?>"
				target="_blank" class="fr c999">Nhiều hơn ></a>
			<?php if(is_array($cache_category_arr[$category['category_id']])):?>
			<div class="prolist_ttfl">
				Danh mục phổ biến：
				<span style="overflow:hidden; height:16px;">
					<?php foreach($cache_category_arr[$category['category_id']] as $k=>$v):?>
					<a href="<?php echo pe_url('product-list-'.$k) ?>" title="<?php echo $v['category_name'] ?>"
						target="_blank"><?php echo $v['category_name'] ?></a>
					<span class="mal10 mar10 xian"></span>
					<?php endforeach;?>
				</span>
			</div>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<?php foreach($category['product_list'] as $k=>$v):?>
		<div class="prolist" <?php if(($k+1)%4==0):?>style="margin-right:0"
			<?php endif;?>>
			<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank">
				<div class="pro_bq">
					<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>"
						title="<?php echo $v['product_name'] ?>" width="250" height="250" class="js_imgload" />
					<?php if($v['huodong_tag']):?>
					<div class="bq_name"><?php echo $v['huodong_tag'] ?></div>
					<?php endif;?>
				</div>
				<p class="prolist_name"><?php echo $v['product_name'] ?></p>
				<p class="mat8">
					<span class="money1 fl"><span
							class="num font18 mar3">¥</span><?php echo product_money($v['product_money']) ?></span></span>
					<span class="font12 fr c999">Đã bán<?php echo $v['product_sellnum'] ?>件</span>
				</p>
				<div class="clear"></div>
			</a>
		</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<?php endforeach;?>
	<!--分类1 End-->
	<div class="yl_list">
		<div class="yl_tt"><span>Liên kết</span></div>
		<div class="yl_name">
			<?php foreach($cache_link as $v):?>
			<a href="<?php echo $v['link_url'] ?>" target="_blank" title="<?php echo $v['link_name'] ?>"><?php echo $v['link_name'] ?></a>
			<?php endforeach;?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_tpl'] ?>js/jquery.banner.js"></script>
<script type="text/javascript">
	$(function () {
		pe_jstime(".huodong_time", '<?php echo time() ?>', 'html');
		$(".jdt_banner").swBanner();
	})
</script>
<?php if($alert && $alert['article_id']):?>
<script type="text/javascript">
	$(function () {
		if (window.sessionStorage.getItem('alert') != 'true') {
			layer.open({
				title: 'Thông báo',
				content: '<?php print_r($alert["article_text"]); ?>',
				area: ['360px', '300px']
			});
			window.sessionStorage.setItem('alert', 'true');
		}
	})
</script>
<?php endif;?>
<?php if($msg):?>
<script type="text/javascript">
	layer.open({
		title: 'Thông báo',
		content: '<?php print_r($msg["msg_text"]); ?>',
		area: ['360px', '300px']
	});
</script>
<?php endif;?>
<?php include(pe_tpl('footer.html'));?>