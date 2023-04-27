
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content" style="margin-bottom:75px;">
	<?php if(!count($info_list)):?>
	<div class="nodata">
		<div class="nodata_img"></div>
		<div class="nodata_tip">không có thông tin</div>
	</div>
	<?php endif;?>
	<?php foreach($info_list as $v):?>
	<div class="user_box_zh mat10 pageid" style="border-bottom:0;">
		<div class="add_list">
			<span class="fl"><?php echo $v['userbank_name'] ?>（<?php echo userbank_num($v['userbank_num']) ?>）</span>
			<span class="fr"><?php echo $v['userbank_tname'] ?></span>
			<div class="clear"></div>
			<?php if($v['userbank_address']):?>
			<div class="mat5 c999"><?php echo $v['userbank_address'] ?></div>
			<?php endif;?>
			<div class="xian"></div>
			<div class="fr mat10">
				<a href="user.php?mod=userbank&act=del&id=<?php echo $v['userbank_id'] ?>&token=<?php echo $pe_token ?>" onclick="return app_delinfo(this, 'Xóa tài khoản này')" class="edit_btn">Xóa bỏ</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php endforeach;?>
	<div class="fenye mab10"><?php echo $db->page->html ?></div>
</div>
<div class="fb_btn1"><a href="user.php?mod=userbank&act=add">Thêm địa chỉ mới </a></div>
<?php include(pe_tpl('footer.html'));?>