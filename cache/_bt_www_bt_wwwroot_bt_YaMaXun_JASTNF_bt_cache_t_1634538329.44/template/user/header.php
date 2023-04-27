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
	<div class="width980">
		<span class="fl">Chào mừng bạn đến<?php echo $cache_setting['web_title'] ?>！</span>
		<div class="fr top_r">
			<?php if(pe_login('user')):?>
			Xin chào：<a href="<?php echo $pe['host_root'] ?>user.php" style="color:#DF002F;padding:0;border:0"><?php echo $_s_user_name ?></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=logout" title="Đăng xuất" style="padding-left:0;color:#999">[Đăng xuất]</a>
			<?php else:?>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>" title="Đăng nhập">Đăng nhập</a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register&<?php echo pe_fromto() ?>" title="Đăng ký">Đăng ký miễn phí</a>
			<?php endif;?>	
			
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order" title="Đơn hàng của tôi" class="scj">Đơn hàng của tôi</a>
			<a href="<?php echo pe_url('article-news') ?>" title="Trung tâm thông tin" style="border-right:0;">Trung tâm thông tin</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php if($mod!='sign'):?>
<div style="background:#E45050; padding-bottom:20px; position:relative">
<div class="width980">
	<div class="fl logo">
		<a href="<?php echo $pe['host_root'] ?>user.php">Trung tâm thành viên</a>
	</div>
	<div class="user_nav">
		<li><h3><a href="<?php echo $pe['host_root'] ?>" title="Trang đầu">Trang đầu</a></h3></li>
		<?php foreach((array)$cache_menu as $v):?>
		<li><h3><a href="<?php echo $v['menu_url'] ?>" title="<?php echo $v['menu_name'] ?>" <?php echo $v['target'] ?>><?php echo $v['menu_name'] ?></a></h3></li>
		<?php endforeach;?>
	</div>
	<div class="sear fr">				
		<form method="get" action="<?php echo $pe['host_root'] ?>index.php">
		<input type="hidden" name="mod" value="product" />
		<input type="hidden" name="act" value="list" />
		<div class="inputbg fl"><input type="text" name="keyword" value="<?php echo htmlspecialchars($_g_keyword) ?>" class="fl searinput c666" /></div>
		<input type="submit" class="fl sear_btn" onclick="this.form.submit();return false;" value="Tìm kiếm" />
		</form>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php endif;?>