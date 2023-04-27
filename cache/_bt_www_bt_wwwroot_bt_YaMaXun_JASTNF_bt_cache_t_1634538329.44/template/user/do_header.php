<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $seo['title'] ?></title>
<meta name="viewport" content="width=1200" />
<meta name="keywords" content="<?php echo $seo['keywords'] ?>" />
<meta name="description" content="<?php echo $seo['description'] ?>" />
<meta name="viewport" content="width=1200" />
<link rel="shortcut icon" type="image/ico" href="<?php echo $pe['host_root'] ?>favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>css/style.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/global.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/layer/layer.js"></script>
</head>
<body>
<div class="quick_menu">
	<div class="width980" style="width:1000px;">
		<span class="fl">Chào mừng bạn đến<?php echo $cache_setting['web_title'] ?>！</span>
		<div class="fr top_r">
			<?php if(pe_login('user')):?>
			您好：<a href="<?php echo $pe['host_root'] ?>user.php" style="color:#DF002F;padding:0;border:0"><?php echo $_s_user_name ?></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=logout" title="Đăng xuất" style="padding-left:0;color:#999">[Đăng xuất]</a>
			<?php else:?>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>" title="Đăng nhập">Đăng nhập</a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register&<?php echo pe_fromto() ?>" title="Đăng kí">Đăng kí miễn phí</a>
			<?php endif;?>	
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order" title="Đơn hàng của tôi" class="scj">Đơn hàng của tôi</a>
			<a href="<?php echo pe_url('article-news') ?>" title="Trung tâm thông tin" style="border-right:0;">Trung tâm thông tin</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="width980" style="width:1000px;">
	<div class="login_logo">
		<a href="<?php echo $pe['host_root'] ?>" title="<?php echo $cache_setting['web_name'] ?>"><img src="<?php echo pe_thumb($cache_setting['web_logo']) ?>" alt="<?php echo $cache_setting['web_name'] ?>" /></a>
	</div>
</div>