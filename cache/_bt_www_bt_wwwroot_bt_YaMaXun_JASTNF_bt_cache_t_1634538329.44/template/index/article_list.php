<?php include(pe_tpl('header.html'));?>
<div class="content">
	<div class="now">Vị trí hiện tại：<a href="<?php echo $pe['host_root'] ?>">Trang đầu</a> <?php echo $nowpath ?></div>
	<div class="danye_left">
		<div class="danye_help">
			<div class="danye_list">
				<h3 class="fl_tb1"><s></s>Trung tâm thông tin </h3>
				<ul>
				<?php foreach((array)$cache_class_arr['news'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($class_id==$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="danye_help mat10">
			<div class="danye_list">
				<h3 class="fl_tb2"><s></s>Trung tâm hổ trợ</h3>
				<ul>
				<?php foreach((array)$cache_class_arr['help'] as $v):?>
				<li><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" title="<?php echo $v['class_name'] ?>" <?php if($class_id==$v['class_id']):?>class="sel"<?php endif;?>><?php echo $v['class_name'] ?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	<div class="danye_right">
		<div class="page_tt"><span><?php echo $menutitle ?></span></div>
		<ul class="wenzhang_list">
			<?php foreach($info_list as $k=>$v):?>
			<li <?php if($k+1==count($info_list)):?>style="border-bottom:0"<?php endif?>>
				<a href="<?php echo pe_url('article-'.$v['article_id']) ?>" title="<?php echo $v['article_name'] ?>" target="_blank"><?php echo $v['article_name'] ?></a>
				<span class="fr c888"><?php echo pe_date($v['article_atime'], 'Y-m-d') ?></span>
				<div class="clear"></div>
			</li>
			<?php endforeach;?>
		</ul>
		<div class="fenye mat5 mab10 mar10"><?php echo $db->page->html ?><div class="clear"></div></div>
	</div>
</div>
<?php include(pe_tpl('footer.html'));?>