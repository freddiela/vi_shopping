
<?php include(pe_tpl('header.html'));?>
<div class="pagetop" style="position:fixed; top:0; left:0; width:100%; z-index:999; display:none;">
	<div class="fh"><a href="javascript:app_open('back');"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content">
	<div class="spimg">
		<div class="swiper-container">
		    <div class="swiper-wrapper">
		    	<?php foreach($album_list as $v):?>
		        <div class="swiper-slide"><img src="<?php echo pe_thumb($v, '_800', '_800') ?>" /></div>
		        <?php endforeach;?>
		    </div>
		    <!-- 如果需要分页器 -->
		    <div class="swiper-pagination"></div>
		</div>
		<div class="foot_jt"><a href="javascript:app_open('back');"></a></div>
		<div class="foot_jtbg"></div>
		<div class="foot_sc"><a href="<?php echo pe_url('cart') ?>"></a></div>
		<div class="foot_scbg"></div>
		<div class="foot_fx"><a href="javascript:share_btn();"></a></div>
		<div class="foot_fxbg"></div>
	</div>
	<?php if($info['huodong_tag']):?>
	<div class="hd_box">
		<span class="fl ico_hd"><i></i><span><?php echo $info['huodong_tag'] ?></span><s class="mal10 font12">¥ <?php echo $info['product_smoney'] ?></s></span>
		<span class="fr hd_r"><span>Khoảng cách kết thúc</span><p id="huodong_time" endtime="<?php echo $info['huodong_etime'] ?>"></p></span>
		<div class="clear"></div>
	</div>
	<?php endif;?>
	<div class="pro_info" style="position:relative;border-top:0">
		<div style="position:relative;">
			<div class="pro_tt"><?php echo $info['product_name'] ?></div>
			<!--<div class="pro_fx" onclick="share_btn();">
				<i></i><p>分享</p>
			</div>-->
		</div>
		<div class="jg_price mat5"><span class="font14 mar5">₫</span><?php echo $info['product_money'] ?></div>
		<div class="yunfei_box">
			<span style="text-align:left">Phí vận chuyển：<?php if($info['product_wlmoney'] == 0):?>Miễn phí vận chuyển<?php else:?>¥ <?php echo $info['product_wlmoney'] ?><?php endif;?></span>
			<span style="text-align:center">Bán chạy：<?php echo $info['product_sellnum'] ?> 件</span>
			<span style="text-align:right">Phần thưởng：<?php echo $info['product_point'] ?> 积分</span>
			<div class="clear"></div>
		</div>
	</div>
	<?php if(count($rule_list)):?>
	<div class="xz_box" onclick="buy_open();">lựa chọn：
		<?php foreach($rule_list as $k=>$v):?>
		<?php echo $v['name'] ?>
		<?php endforeach;?>
		<i></i>
	</div>
	<?php endif;?>
	<?php if(count($quan_list)):?>
	<div class="yhq_list">
		<div class="pro_quan" onclick="app_page('page_quan');">
			Nhận phiếu giảm giá：
			<?php foreach($quan_list as $k=>$v):?>
			<span class="coupon">Toàn bộ <?php echo $v['quan_limit'] ?> trừ <?php echo $v['quan_money'] ?></span>
			<?php endforeach;?>
			<span class="quan_num">Tổng cộng có <?php echo count($quan_list) ?> trang tính </span>
			<i></i>
		</div>
	</div>
	<?php endif;?>
</div>
<?php if($comment['comment_id']):?>
<div class="pro_pjbox mat10">
	<div class="pro_pjtt">
		<a href="<?php echo pe_url('comment-list-'.$product_id) ?>">
			xem xét sản phẩm（<?php echo $info['product_commentnum'] ?>）
			<span>Tất cả các nhận xét</span>
			<i></i>
		</a>
	</div>
	<div class="mat5">
		<ul class="plmain_ul pl_pro">
			<li class="fl pl_tx"><img src="<?php echo pe_thumb($comment['user_logo'], '_120', '_120', 'avatar') ?>"></li>
			<li class="fl"><?php echo $comment['user_name'] ?><p class="cbbb mat3"></p></li>
			<li class="fr c999 font12"><?php echo pe_date($comment['comment_atime'], 'Y-m-d') ?></li>
		</ul>
		<div class="clear"></div>
		<div class="pingjia font14"><?php echo $comment['comment_text'] ?></div>
		<div class="shaitu" style="display:none;">
			<ul>
			<?php foreach($comment['comment_logo'] as $k=>$v):?>
			<li><div class="li_box"><a href="javascript:app_iframe('<?php echo pe_url('comment-logo', 'id='.$comment['comment_id'].'&num='.$k) ?>')"><img src="<?php echo pe_thumb($v, '_400', '_400') ?>" /></div></a></li>
			<?php endforeach;?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<!--<div class="xian2 mat10"></div>-->
</div>
<?php endif;?>
<div style="margin-bottom:60px;">
<div class="pj_tt1 pj_tt2"><div class="xian_tt"></div><span><i></i>Chi tiết</span></div>
<!--<div class="pro_main mat10">
	<div class="pro_tt" id="js_menu">
		<a href="javascript:;" class="sel">详情<span class="xian1"></span></a>
		<a href="javascript:;"><span style="position:relative">评价<span class="plnum"><?php echo $info['product_commentnum'] ?></span></span></a>
		<div class="clear"></div>
	</div>
</div>-->
<!--详情 Start-->
<div class="content js_menuhtml">
	<div class="main_xq">
		<?php if($info['product_video']):?>
		<div id="product_video" style="width:100%;height:auto;"></div>
		<?php endif;?>	
		<?php echo $info['product_text'] ?>
	</div>
</div>
<!--详情 end-->
<!--评论 Start-->
<div class="promain js_menuhtml" style="display:none;">
	<div class="plmenu" id="js_commentmenu">
		<a href="javascript:;" val="0" class="sel">tất cả các (<?php echo $info['product_commentnum'] ?>)</a>
		<a href="javascript:;" val="hao">Đánh giá tốt (<?php echo intval($comment_ratearr[0]) ?>)</a>
		<a href="javascript:;" val="zhong">Đánh giá trung bình (<?php echo intval($comment_ratearr[1]) ?>)</a>
		<a href="javascript:;" val="cha">Đánh giá tiêu cực (<?php echo intval($comment_ratearr[2]) ?>)</a>
	</div>
	<div id="js_commenthtml">
		<script type="text/html" id="js_commenttpl">
		{{each list as v k}}
		<div class="pj_box" style="margin-top:5px">
			<div class="pingjia font14" style="padding-bottom:0;padding-top:15px">
				{{v.comment_text}}
			</div>
			<ul class="plmain_ul" style="height:20px; line-height:20px; padding:15px 0 10px; border-bottom:0">
				<li class="fl c999 font12">{{v.user_name}} | {{v.comment_atime}}</li>
				<li class="fr mal10 c999 font12"><div class="">{{v.comment_star}}</div></li>	
			</ul>
			<div class="clear"></div>
		</div>
		{{/each}}
		<div class="fenye mat10">{{page}}<div class="clear"></div></div>
		</script>
	</div>
</div>
<!--评论 End-->
<!--咨询 Start-->
<div class="promain js_menuhtml" style="display:none;">
	<div id="js_askhtml">
		<script type="text/html" id="js_asktpl">
		{{each list as v k}}	
		<div class="wd_box">
			<div>{{v.user_name}}：{{v.ask_text}}</div>
			<div class="cbbb font12">{{v.ask_atime}}</div>
			<div class="mat5 cred">Trả lời：<?php echo $info['ask_replytext'] ?></div>
			<div class="cbbb font12">{{v.ask_atime}}</div>
		</div>
		{{/each}}
		<div class="fenye mat10">{{page}}<div class="clear"></div></div>			
		</script>	
	</div>
	<div class="ask_form">Tôi muốn tham khảo ý kiến
		<div class="mat10 mar10">
			<textarea name="ask_text" style="width:100%;height:80px;resize:none"></textarea>
		</div>
		<div class="loginbtn"><input type="button" value="Gửi" class="ask_btn" onclick="ask_add()" /></div>				
	</div>
</div>
</div>
<!--咨询 End-->
<div class="pro_foot">
	<div class="pro_foot_left">
		<div class="sy"><a href="<?php echo $pe['host_root'] ?>"><i></i>Trang đầu</a></div>
		<div class="sc"><a href="javascript:collect_btn();"><i class="<?php echo $collect['collect_id']?'sel':'' ?>"></i>Sưu tầm</a></div>
		<div class="qq"><a href="javascript:kefu_btn();"><i></i>dịch vụ khách hàng</a></div>
	</div>
	<div class="pro_foot_right">
		<?php if($info['product_state']==2):?>
		<a href="javascript:;" class="xj"> Hàng hóa đã được loại bỏ</a>
		<?php elseif($info['product_num']==0):?>
		<a href="javascript:;" class="xj">Đã bán hết</a>
		<?php elseif($info['product_type']=='virtual'):?>
		<a href="javascript:buy_open('buy');" class="gm" style="width:100%">Mua ngay bây giờ </a>
		<?php else:?>
		<a href="javascript:buy_open('add');">Thêm vào giỏ hàng</a>
		<a href="javascript:buy_open('buy');" class="gm">Mua ngay bây giờ </a>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<div id="page_buy" class="divhide">
	<div style="background:#fff; position:relative; padding:10px 0; z-index:999">
		<div class="tc_pro">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="52"><span class="tc_img"><img src="<?php echo pe_thumb($info['product_logo'], '_400', '_400') ?>"></span></td>
				<td valign="top">
					<p class="jg_name"><?php echo $info['product_name'] ?></p>
					<p class="cred mat10">₫<span id="product_money"><?php echo $info['product_money'] ?></span></p>
				</td>
				<td width="30"><div class="close_btn" onclick="app_page_close();"></div></td>
			</tr>
			</table>
		</div>
		<div class="sh_xian"></div>
		<div class="sh_box">
			<?php foreach($rule_list as $k=>$v):?>
			<div style="padding:10px 0 5px; margin-right:10px; border-bottom:1px #eee solid">
				<div class="sh_tt"><?php echo $v['name'] ?>：</div>
				<div class="js_rule">
					<?php foreach($v['list'] as $kk=>$vv):?>
					<span rule_id="<?php echo $v['id'] ?>" ruledata_id="<?php echo $vv['id'] ?>" class="js_ruledata prodata_span"><?php echo $vv['name'] ?><i></i></span>
					<?php endforeach;?>
				</div>
				<div class="clear"></div>
			</div>
			<?php endforeach;?>
			<!--<div class="sh_xian"></div>-->
			<div class="sh_buy">
				<span class="">Số lượng mua：</span>
				<div class="shuliang">
					<input type="hidden" name="product_guid" value="<?php echo $product_guid ?>" />
					<span class="img1" onclick="pe_numchange('product_num', '-', 1);"><i></i></span>
					<span class="shuliang_box"><input type="text" name="product_num" value="1" /></span>
					<span class="img2" onclick="pe_numchange('product_num', '+', <?php echo $info['product_num'] ?>);"><i></i></span>
				</div>
			</div>
		</div>
	</div>
	<div class="buy_btn">
		<?php if($info['product_state']==2):?>
		<a href="javascript:;" class="xj" style="width:100%">Hàng hóa đã được loại bỏ</a>
		<?php elseif($info['product_num']==0):?>
		<a href="javascript:;" class="xj" style="width:100%">Đã bán hết</a>
		<?php elseif($info['product_type']=='virtual'):?>
		<a href="javascript:buy_btn('buy', '<?php echo $info['product_id'] ?>');" type="buy" class="gm">Mua ngay bây giờ </a>
		<?php else:?>
		<a href="javascript:buy_btn('add', '<?php echo $info['product_id'] ?>');" type="add">Thêm vào giỏ hàng</a>
		<a href="javascript:buy_btn('buy', '<?php echo $info['product_id'] ?>');" type="buy" class="gm">Mua ngay bây giờ </a>
		<?php endif;?>
		<div class="clear"></div>
	</div>
</div>
<div id="page_share" class="divhide">
	<div class="add_tt">Nhấn và giữ hoặc chụp ảnh màn hình để chia sẻ với bạn bè</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<div style="position:relative">
		<div class="share_box" id="share_html">
			<div class="share_img"><img src="<?php echo pe_thumb($info['product_logo'], '_800', '_800') ?>"></div>
			<div class="share_pro">
				<img src="<?php echo user_qrcode(pe_url('product-'.$info['product_id'], 'u='.$_s_user_id)) ?>">
				<div class="share_name"><?php echo $info['product_name'] ?></div>
				<div class="mat5 cred font16">₫<?php echo $info['product_money'] ?></div>
				<div class="clear"></div>
			</div>
		</div>
		<img src="#" id="share_img" style="position:absolute;top:0;left:0;display:none" />
	</div>
</div>
<div id="page_quan" class="divhide">
	<div class="add_tt">Nhận phiếu giảm giá</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<form method="post" id="form_quan"><input type="hidden" name="pesubmit" /></form>
	<div class="lq_box">
		<?php foreach($quan_list as $k=>$v):?>
		<div class="dingdan_yhq" id="quan_<?php echo $v['quan_id'] ?>">
			<div class="dd_yhq_l">
				<div class="dd_yhq_money"><span class="font12">¥</span> <?php echo $v['quan_money'] ?></div>
				<div class="font12 mat5">Sử dụng đầy đủ <?php echo $v['quan_limit'] ?></div>
				<div class="font12">Khoảng thời gian có hiệu lực từ <?php echo $v['quan_sdate'] ?> đến <?php echo $v['quan_edate'] ?></div>
			</div>
			<div class="dd_yhq_r">
				<a href="javascript:quan_btn('<?php echo $v['quan_id'] ?>');"><?php if(is_array($myquan_arr[$v['quan_id']])):?>Đã nhận lấy<?php else:?>Nhận ngay bây giờ<?php endif;?></a>
			</div>		
			<div class="clear"></div>
		</div>
		<?php endforeach;?>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_root'] ?>public/plugin/swiper/swiper.min.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/swiper/swiper.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/ckplayer/ckplayer.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/html2canvas.js?v=1"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/wxsdk.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/wxapi.js"></script>
<script type="text/javascript">
template.config('escape', false);
$(function(){
	$(".main_xq img").removeAttr("height").removeAttr("width");
	pe_jstime("#huodong_time", '<?php echo time() ?>', 'html');
	//相册切换
	var swiper = new Swiper('.swiper-container', {
	    pagination: '.swiper-pagination',
	    paginationClickable: true,
	    // Disable preloading of all images
	    preloadImages: false,
	    initialSlide : 0
	});	
	//规格选择
	prodata_check();
	$(".js_ruledata").click(function(){
		if ($(this).hasClass("prodata_lock")) return;
		if ($(this).hasClass("prodata_sel")) {
			$(this).removeClass("prodata_sel");
		}
		else {
			$(this).parent(".js_rule").find(".js_ruledata").removeClass("prodata_sel");
			$(this).addClass("prodata_sel");
		}
		prodata_check();
	});
	//顶部菜单跟随滚动
	var pagetop = $(".pagetop").offset().top;
	$(window).scroll(function(){
		if ($(document).scrollTop() > pagetop) {
			$(".pagetop").show();
		}
		else {
			$(".pagetop").hide();	
		}
	});
})
var videoObject = {
	container: '#product_video',//"#"代表容器的ID，"."或""代表容器的class
	variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
	flashplayer:false,//如果强制使用flashplayer则设置成true
	poster:"<?php echo pe_thumb($info['product_logo']) ?>",
	video:"<?php echo $pe['host_root'] ?><?php echo $info['product_video'] ?>"//视频地址
};
var player=new ckplayer(videoObject);
//收藏商品
function collect_btn() {
	app_getinfo("<?php echo $pe['host_root'] ?>index.php?mod=product&act=collect&id=<?php echo $info['product_id'] ?>", function(json){
		if (json.result && json.type == 'del') {
			$(".sc i").removeClass('sel');
		}
		else if (json.result) {
			$(".sc i").addClass('sel');		
		}
	});
}

//分享商品
function share_btn() {
	app_page('page_share', function(){
		setTimeout(function(){
			div_toimg("share_html", "share_img");
		}, 500)
	});
}

//领取优惠券
function quan_btn(id) {
	app_submit("<?php echo $pe['host_root'] ?>index.php?mod=quan&act="+id, function(json){
		if (json.result) {
			$("#quan_"+id).addClass("sel").find("a").text('Đã nhận lấy');
		}
	}, 'form_quan')
}

//客服按钮
function kefu_btn() {
	$.actions({
	  actions: [{
	    text: '<a class="kf_ico1" href="<?php echo pe_kfurl("qq", $cache_setting['web_qq']) ?>"><i></i>dịch vụ trực tuyến</a>'
	  },
	  {
	    text: '<a class="kf_ico2" href="tel:<?php echo $cache_setting['web_phone'] ?>"><i></i>Tư vấn qua điện thoại</a>'
	  }]
	});
}
//立即购买/加入购物车按钮
function buy_btn(act, id) {
	if ('<?php echo user_checkguest() ?>' == false) {
		app_open("<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>");
		return;
	}
	if ($(":input[name='product_guid']").val() == '') {
		app_tip('Vui lòng chọn thông số kỹ thuật sản phẩm');
		return;		
	}
	app_getinfo("<?php echo $pe['host_root'] ?>index.php?mod=cart&act="+act+"&id="+id+"&guid="+$(":input[name='product_guid']").val()+"&num="+$(":input[name='product_num']").val(), function(json){
		if (json.result == true) {
			if (act == 'buy') {
				app_page_close();
				app_open("<?php echo $pe['host_root'] ?>index.php?mod=order&act=add&id="+json.id);
			}
			else {
				$("#cart_num").html(json.cart_num);
				app_page_close();
				app_tip('Sản phẩm đã được thêm vào giỏ hàng!');
			}
		}
	})
}
//打开购买选项
function buy_open(act) {
	if (typeof(act) != 'undefined') {
		var ua = window.navigator.userAgent.toLowerCase(); 
		if (ua.match(/MicroMessenger/i) == 'micromessenger') { 
			if ('<?php echo $_s_user_wx_openid ?>' == '' && '<?php echo user_checkguest() ?>' !=false) {
				app_tip('Liên kết với WeChat');
				app_open("<?php echo $wechaturl ?>");
				return;
			}
			if (typeof(act) != 'undefined' && '<?php echo user_checkguest() ?>' == false) {
				app_tip('vui lòng đăng nhập trước');
				app_open("<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>");
				return;
			}
		}
		else { 
			
			if ('<?php echo user_checkguest() ?>' == false) {
			app_tip('vui lòng đăng nhập trước');
			app_open("<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>");
			return;
			}
		}
	}
	
	if (typeof(act) != 'undefined' && '<?php echo user_checkguest() ?>' == false) {
		app_tip('vui lòng đăng nhập trước');
		app_open("<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>", 500);
		return;
	}
	$(".buy_btn a").hide().attr("show", 0);
	if (typeof(act) != 'undefined') {
		$(".buy_btn a[type='"+act+"']").show().attr("show", 1);
	}
	else {
		$(".buy_btn a").show().attr("show", 1);
	}
	if ($(".buy_btn a[show='1']").length == 2) {
		$(".buy_btn a[show='1']").css("width", "50%");
	}
	else {
		$(".buy_btn a[show='1']").css("width", "100%");
	}
	app_page('page_buy');
}
//规格检测
function prodata_check() {
	var prodata_list = <?php echo $prodata_list ?>;
	$(".js_ruledata").each(function(){
		var sel_arr = new Array();
		var rule_id = $(this).attr("rule_id");
		var ruledata_id = $(this).attr("ruledata_id");
		sel_arr.push(ruledata_id);	
		$(".prodata_sel[rule_id!="+rule_id+"]").each(function(){
			sel_arr.push($(this).attr("ruledata_id"));
		})
		for (var i in prodata_list) {
			var match_num = 0;
			var product_ruleid = prodata_list[i]['product_ruleid'].split(',');
			for (id in sel_arr) {
				if (jQuery.inArray(sel_arr[id], product_ruleid) >= 0) match_num++;		
			}
			if (match_num == sel_arr.length) {
				var match_result = true; 
				break;
			}
			else {
				var match_result = false;
			}
		}
		if (match_result) {
			$(this).removeClass('prodata_lock');
		}
		else {
			$(this).addClass('prodata_lock');
		}
	})
	//更新选中规格组合
	var prodata_sel = new Array();

	$(".prodata_sel").each(function(){
		prodata_sel.push($(this).attr("ruledata_id"));
	})
	var product_ruleid = prodata_sel.join(',');
	$(":input[name='product_ruleid']").val('');
	//循环规格选中的有效列表
	for (var i in prodata_list) {
		//如果选中规格组合完成
		if (prodata_list[i]['product_ruleid'] == product_ruleid) {
			$(":input[name='product_guid']").val(prodata_list[i]['product_guid']);
			$("#product_money").html(prodata_list[i]['product_money']);
			$("#product_mmoney").html(prodata_list[i]['product_mmoney']);
			$("#product_num").html(prodata_list[i]['product_num']);
		}
	}
}
<?php echo wechat_jsapi_config('onMenuShareTimeline|onMenuShareAppMessage|onMenuShareQQ|onMenuShareWeibo|onMenuShareQZone|hideMenuItems') ?>;
wx.ready(function(){
	wx_share({
		name: "<?php echo $info['product_name'] ?>",
		desc: "Giá mua：<?php echo $info['product_money'] ?>",
		url: "<?php echo pe_url('product-'.$info['product_id'], 'u='.$_s_user_id) ?>",
		img: "<?php echo pe_thumb($info['product_logo'], '_800', '_800') ?>"
	})
	wx.hideMenuItems({
		menuList: ['menuItem:favorite'] // 要隐藏的菜单项，只能隐藏"传播类"和"保护类"按钮，所有menu项见附录3
	});
})
</script>
<?php include(pe_tpl('footer.html'));?>