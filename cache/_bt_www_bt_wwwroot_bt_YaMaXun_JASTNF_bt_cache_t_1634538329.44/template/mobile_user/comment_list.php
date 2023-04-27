
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="main">
	<?php if(!count($info_list)):?>
	<div class="nodata">
		<div class="nodata_img"></div>
		<div class="nodata_tip">không có thông tin</div>
	</div>
	<?php endif;?>
	<?php foreach($info_list as $k=>$v):?>
	<?php $comment_logo = $v['comment_logo'] ? explode(',', $v['comment_logo']) : array()?>
	<div class="ask_dd">
		<ul class="plmain_ul pl_pro">
			<li class="fl pl_tx"><img src="<?php echo pe_thumb($v['user_logo'], '_120', '_120', 'avatar') ?>"></li>
			<li class="fl mat2 font12"><?php echo $v['user_name'] ?><p class="cbbb mat3"><?php echo pe_date($v['comment_atime']) ?></p></li>
			<li class="fr c999 font12" style="line-height:26px"><?php echo pe_comment($v['comment_star']) ?></li>
		</ul>
		<div class="clear"></div>
		<p class="pingjia"><?php echo $v['comment_text'] ?></p>
		<div class="shaitu">
			<ul>
			<?php foreach($comment_logo as $kk=>$vv):?>
			<li><div class="li_box"><a href="javascript:app_iframe('<?php echo pe_url('comment-logo', 'id='.$v['comment_id'].'&num='.$kk) ?>')"><img src="<?php echo pe_thumb($vv, '_400', '_400') ?>" /></a></div></li>
			<?php endforeach;?>
			</ul>
			<div class="clear"></div>
		</div>
		<?php if($v['comment_reply']):?>
		<div class="mjpj">商家回复：<?php echo $v['comment_reply_text'] ?><div class="mat5 font12"><?php echo pe_date($v['comment_reply_time']) ?></div></div>
		<?php endif;?>
		<div class="pj_pro mat10">
			<div class="dingdan_img"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" class="imgbg" /></a></div>
			<div class="dingdan_name">
				<p style="padding-top:10px;"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>"><?php echo $v['product_name'] ?></a></p>
			</div>
			<div class="clear"></div>
		</div>	
	</div>
	<?php endforeach;?>
	<div class="fenye mab10"><?php echo $db->page->html ?></div>
</div>
<?php include(pe_tpl('footer.html'));?>