
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="<?php echo $pe['host_root'] ?>"></a></div>
	<div><?php echo $ini['class_type'][$class_type] ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content">
	<div class="subnav1">
		<?php if(is_array($cache_class_arr[$class_type])):?>
		<?php foreach($cache_class_arr[$class_type] as $v):?>
		<a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($class_id==$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a> 
		<?php endforeach;?>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	<div class="fenlei_list zx_list">
		<ul>
		<?php foreach($info_list as $k=>$v):?>
		<li>
			<a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>">
			<?php echo $v['article_name'] ?><p class="cbbb font12 num"><?php echo pe_date($v['article_atime']) ?></p>
			</a>
			<i></i>
		</li>
		<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="fenye mat10"><?php echo $db->page->html ?><div class="clear"></div></div>
</div>
<?php include(pe_tpl('footer.html'));?>