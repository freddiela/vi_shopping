<?php include(pe_tpl('header.html'));?>
<div class="top_box1">
	<div class="pagetop1">
		<div class="top_logo"><a href="<?php echo $pe['host_root'] ?>"><img src="<?php echo pe_thumb($cache_setting['wap_logo']) ?>"></a></div>
		<div class="sear" onclick="javascript:app_iframe('<?php echo $pe['host_root'] ?>index.php?mod=search');">
			<div class="sear_input_box"><input name="keyword" type="text" class="sear_input" placeholder="Tìm kiếm từ khóa" />
			</div>
			<div class="sear_tj"><input type="button" value=" "></div>
			<div class="clear"></div>
		</div>
		<div class="cd"><a href="javascript:top_menu();"></a></div>
		<?php include(pe_tpl('top_menu.html'));?>
	</div>
</div>
<div class="content" style="margin:47px 0 60px">
	<div class="swiper-container jdt">
		<div class="swiper-wrapper">
			<?php if(is_array($cache_ad['h5']['index_jdt'])):?>
			<?php foreach($cache_ad['h5']['index_jdt'] as $v):?>
			<div class="swiper-slide">
				<a href="<?php echo $v['ad_url'] ?>"><img data-src="<?php echo pe_thumb($v['ad_logo']) ?>" class="swiper-lazy"></a>
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<?php endforeach;?>
			<?php endif;?>
		</div>
		<!-- 如果需要分页器 -->
		<div class="swiper-pagination"></div>
	</div>
	<div class="nav">
		<ul>
			<li><a href="<?php echo pe_url('category-list') ?>"><i class="ck_sp"></i><span>Toàn bộ thương hiệu</span></a></li>
			<li><a href="<?php echo pe_url('huodong-zhekou') ?>"><i class="nav_i5"></i><span>Thời hạn chiết khấu</span></a></li>
			<li><a href="<?php echo pe_url('brand-list') ?>"><i class="ck_ppzq"></i><span>Khu thương hiệu</span></a></li>
			<li><a href="<?php echo pe_url('quan-list') ?>"><i class="ck_yhj"></i><span>Trung tâm phiếu thưởng</span></a></li>
			<!--		<li><a href="<?php echo pe_url('article-news') ?>"><i class="ck_zx"></i><span>资讯中心</span></a></li>-->
			<li><a href="<?php echo pe_url('huodong-taocan') ?>"><i class="ck_tc"></i><span>Gói giảm giá</span></a></li>
			<li><a href="<?php echo pe_url('huodong-pintuan') ?>"><i class="nav_i9"></i><span>Nhóm thời gian giới hạn</span></a></li>
			<li><a href="<?php echo pe_url('cart') ?>"><i class="ck_gwc"></i><span>Giỏ hàng</span></a></li>
			<li><a href="user.php?mod=order_recovery"><i class="ck_huishou"></i><span>Trung tâm thu hồi</span></a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="index_gg" id="gundong_html">
		<div class="gg_tt">公告</div>
		<div class="index_gglist gundong_list">
			<ul>
				<?php foreach($notice_list as $v):?>
				<li><a class="new_name" href="<?php echo pe_url('article-'.$v['article_id']) ?>"><?php echo pe_cut($v['article_name'], 16,
						'...') ?></a></li>
				<?php endforeach;?>
			</ul>
			<a class="new_more" href="<?php echo pe_url('article-list-1') ?>">Nhiều hơn</a>
		</div>
	</div>
	<?php if(count($product_zhekou)):?>
	<div class="tuijian_list mat10 ms_list">
		<a href="<?php echo pe_url('huodong-zhekou') ?>" title="限时折扣">
			<div class="tuijian_tt1">
				<p></p>Thời hạn chiết khấu<i class="tj_more"></i>
			</div>
		</a>
		<ul>
			<?php foreach($product_zhekou as $k=>$v):?>
			<li>
				<div class="li_box" style="background:#fff;">
					<?php if($v['huodong_stime'] <= time() && $v['isUser'] == 1):?>
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>">
						<?php else:?>
						<a href="#" title="<?php echo $v['product_name'] ?>"></a>
						<?php endif;?>
						<div class="prolist_logo">
							<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif"
								data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>" title="<?php echo $v['product_name'] ?>"
								class="js_imgload" />
							<?php if($v['huodong_stime'] >= time()):?>
							<div class="prolist_time"><i></i><span class="huodong_time"
								endtime="<?php echo $v['huodong_stime'] ?>"></span></div>
							<?php else:?>
							<div class="prolist_time"><i></i><span class="huodong_time"
									endtime="<?php echo $v['huodong_etime'] ?>"></span></div>
							<?php endif;?>
							<div class="prolist_timebg"></div>
						</div>
					</a>
					<div class="prolist_name">
						<p><?php echo $v['product_name'] ?></p>
						<s class="c999 font12">¥<?php echo product_money($v['product_smoney']) ?></s>
					</div>
					<div class="prolist_qgbtn">
						<span>¥<?php echo product_money($v['product_money']) ?></span>

						<?php if($v['huodong_stime'] >= time()):?>
						<a href="#" title="Lập tức chọn mua" style="background-color: #a8a0a0;">Chờ đợi bắt đầu</a>
						<?php else:?>
						<?php if($v['isUser'] == 1):?>
						<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="Lập tức chọn mua">Lập tức chọn mua</a>
						<?php else:?>
						<a href="#" title="Lập tức chọn mua" style="background-color: #a8a0a0;">Không đủ điều kiện tham gia</a>
						<?php endif;?>
						<?php endif;?>
					</div>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
	<?php endif;?>
	<?php foreach($category_indexlist as $category):?>
	<div class="tuijian_list mat10">
		<a href="<?php echo pe_url('product-list-'.$category['category_id']) ?>" title="<?php echo $category['category_name'] ?>">
			<div class="tuijian_tt">
				<p></p><?php echo $category['category_name'] ?><i class="tj_more"></i>
			</div>
		</a>
		<ul>
			<?php foreach($category['product_list'] as $k=>$v):?>
			<li>
				<div class="li_box">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>">
						<div class="prolist_logo">
							<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif"
								data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>" title="<?php echo $v['product_name'] ?>"
								class="js_imgload" />
							<?php if($v['huodong_tag']):?>
							<div class="prolist_tag"><?php echo $v['huodong_tag'] ?></div>
							<?php endif;?>
						</div>
					</a>
					<div class="prolist_name">
						<p><a href="<?php echo pe_url('product-'.$v['product_id']) ?>"
								title="<?php echo $v['product_name'] ?>"><?php echo $v['product_name'] ?></a></p>
						<span>¥<?php echo product_money($v['product_money']) ?></span>
					</div>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
	<?php endforeach;?>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_root'] ?>public/plugin/swiper/swiper.min.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/swiper/swiper.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/wxsdk.js?v=<?php echo time() ?>"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/wxapi.js?v=<?php echo time() ?>"></script>
<script type="text/javascript">
	$(function () {
		//var jdt_height = $(".content").width()/1.33;
		//$(".jdt, .jdt img").height(jdt_height);
		//焦点图切换
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			paginationClickable: true,
			// Disable preloading of all images
			preloadImages: false,
			// Enable lazy loading
			lazyLoading: true,
			initialSlide: 0,
			autoplay: 2500
		});
		pe_jstime(".huodong_time", '<?php echo time() ?>', 'html');
	})
	//滚动公告
	$("#gundong_html").slide({
		mainCell: ".gundong_list ul",
		effect: "topLoop",
		vis: 1,
		delayTime: 1000,
		interTime: 3000,
		autoPage: true,
		autoPlay: true
	});
	{ wechat_jsapi_config('updateAppMessageShareData|updateTimelineShareData') };
	wx.ready(function () {
		wx_share({
			name: "<?php echo $cache_setting['web_title'] ?>",
			desc: "<?php echo pe_text($cache_setting['web_description']) ?>",
			url: "<?php echo $pe['host_root'] ?>index.php?u=<?php echo $_s_user_id ?>",
			img: "<?php echo pe_thumb($cache_setting['web_logo']) ?>"
		})
	})
</script>
<?php if($alert && $alert['article_id']):?>
<script type="text/javascript">
	console.log('---')
	$(function () {
		if (window.sessionStorage.getItem('alert') != 'true') {
			layer.open({
				title: 'Thông báo',
				content: '<div style="text-align:left;"><?php print_r($alert["article_text"]); ?></div>',
				btn: ['Chắc chắn']
			})
			window.sessionStorage.setItem('alert', 'true');
		}
	})
</script>
<?php endif;?>
<?php if($msg):?>
<script type="text/javascript">
	console.log('---')
	$(function () {
		if (window.sessionStorage.getItem('msg') != '') {
			layer.open({
				title: 'Thông báo',
				content: '<div style="text-align:left;"><?php print_r($msg["msg_text"]); ?></div>',
				btn: ['Chắc chắn']
			})
			window.sessionStorage.setItem('msg', 'true');
		}
	})
</script>
<style type="text/css">
	.sear {
		margin: 0 60px 0 50px;
	}
</style>
<?php endif;?>
<?php include(pe_tpl('footer.html'));?>