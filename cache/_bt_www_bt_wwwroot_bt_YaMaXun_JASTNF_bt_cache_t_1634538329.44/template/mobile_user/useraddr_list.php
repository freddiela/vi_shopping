
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
		<div class="nodata_tip">暂无信息</div>
	</div>
	<?php endif;?>
	<?php foreach($info_list as $v):?>
	<div class="user_box_zh mat10 pageid" style="border-bottom:0">
		<div class="add_list">
			<span class="fl"><?php echo $v['user_tname'] ?></span>
			<span class="fr"><?php echo userbank_num($v['user_phone']) ?></span>
			<div class="clear"></div>
			<div class="mat5">
				<?php if($v['address_default']):?><span class="cred">[默认]</span><?php endif;?>
				<span class="c999"><?php echo $v['address_province'] ?> <?php echo $v['address_city'] ?> <?php echo $v['address_area'] ?> <?php echo $v['address_text'] ?></span>
			</div>
			<div class="xian"></div>
			<div class="fr mat10">
				<a href="user.php?mod=useraddr&act=edit&id=<?php echo $v['address_id'] ?>" class="edit_btn mar10">修改</a>
				<a href="user.php?mod=useraddr&act=del&id=<?php echo $v['address_id'] ?>&token=<?php echo $pe_token ?>" onclick="return app_delinfo(this, '删除该地址')" class="edit_btn">删除</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php endforeach;?>
	<div class="fenye mab10"><?php echo $db->page->html ?></div>
</div>
<div class="fb_btn1"><a href="user.php?mod=useraddr&act=add">添加新地址</a></div>
<?php include(pe_tpl('footer.html'));?>