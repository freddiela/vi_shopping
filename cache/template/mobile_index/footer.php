
<?php if(in_array($mod, array('index', 'huodong', 'category'))):?>
<div class="foot_nav">
	<ul>
	<li><a href="<?php echo $pe['host_root'] ?>" <?php if($mod=='index'):?>class="sel"<?php endif;?>><i class="foot_i1"></i><span>Trang đầu</span></a></li>
	<li><a href="<?php echo pe_url('category') ?>"><i class="foot_i2"></i><span>Phân loại</span></a></li>
	<li><a href="<?php echo pe_url('cart') ?>"><i class="foot_i5"></i><span>Giỏ hàng</span></a></li>
	<li><a href="<?php echo $pe['host_root'] ?>user.php?mod=order"><i class="foot_i3"></i><span>Đơn hàng của tôi</span></a></li>
	<li><a href="<?php echo $pe['host_root'] ?>user.php"><i class="foot_i4"></i><span>của tôi</span></a></li>
	</ul>
	<div class="clear"></div>
</div>
<?php endif;?>
<link rel="stylesheet" href="<?php echo $pe['host_root'] ?>public/plugin/jqweui/weui.min.css">
<link rel="stylesheet" href="<?php echo $pe['host_root'] ?>public/plugin/jqweui/jquery-weui.min.css">
<script src="<?php echo $pe['host_root'] ?>public/plugin/jqweui/jquery-weui.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/layer_mobile/layer.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/app.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/jquery.scrollLoading.js"></script>
<script type="text/javascript">
$(function(){
	$("img.js_imgload").scrollLoading();
});
//顶部菜单点击
function top_menu() {
	if ($("#top_menu").is(":hidden")) {
		$("#top_menu").show();
	}
	else {
		$("#top_menu").hide();	
	}
	$("#top_menu a").live("click", function(){
		$("#top_menu").hide();
	})
}

function is_login() {
	
	var ua = window.navigator.userAgent.toLowerCase(); 
    if (ua.match(/MicroMessenger/i) == 'micromessenger') { 
        if ('<?php echo user_checkguest() ?>' == false) {
			app_open("<?php echo $wechaturl ?>&<?php echo pe_fromto() ?>");
			return;
		}else{
			app_open("<?php echo $pe['host_root'] ?>user.php", 500);
		}
    }
    else { 
        if ('<?php echo user_checkguest() ?>' == false) {
			app_tip('vui lòng đăng nhập trước');
			app_open("<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>", 500);
			return;
		}
		else{
			app_open("<?php echo $pe['host_root'] ?>user.php", 500);
		}
    }
}
pe_loadscript("<?php echo $pe['host_root'] ?>api.php?mod=cron");
</script>
</body>
</html>