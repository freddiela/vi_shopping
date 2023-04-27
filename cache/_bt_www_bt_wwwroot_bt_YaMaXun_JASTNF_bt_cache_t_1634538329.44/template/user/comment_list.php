<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="javascript:;" class="sel"><?php echo $menutitle ?><span>(<?php echo $tongji['all'] ?>)</span><i></i></a>
		</div>
		<div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th>Đánh giá chi tiết</th>
				<th colspan="2">Thông tin sản phẩm</th>
			</tr>
			<?php foreach($info_list as $v):?>
			<?php $comment_logo = $v['comment_logo'] ? explode(',', $v['comment_logo']) : array()?>
			<tr>
				<td valign="top" style="text-align:left">
					<?php echo $v['comment_text'] ?>
					<?php if(count($comment_logo)):?>
					<div class="pj_img">
						<?php foreach($comment_logo as $vv):?>
						<a href="javascript:;"><img src="<?php echo pe_thumb($vv, '_400', '_400') ?>" /></a>
						<?php endforeach;?>
					</div>
					<div class="pj_bigimg"></div>
					<?php endif;?>
					<div class="mat10 cbbb font12"><?php echo pe_date($v['comment_atime'], 'Y-m-d H:i') ?><span class="mal20"><?php echo pe_comment($v['comment_star'], 12) ?></span></div>
					<?php if($v['comment_reply']):?>
					<div class="mat10 corg" style="padding:10px;background:#f8f8f8 ;border-radius:5px">
						<div>Trả lời của người bán：<?php echo $v['comment_reply_text'] ?></div>
						<div class="mat5 font12"><?php echo pe_date($v['comment_reply_time'], 'Y-m-d- H:i') ?></div>
					</div>
					<?php endif;?>
				</td>
				<td valign="top" width="50"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" class="dingdan_img" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" /></a></td>
				<td valign="top" width="250" class="aleft" style="padding-left:0">
					<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="c888"><?php echo $v['product_name'] ?></a>
				</td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
$(function(){
	//晒图预览
	$(".pj_img img").live("click", function(){
		var pj_bigimg = $(this).parents(".pj_img").next(".pj_bigimg");
		$(this).parents(".pj_img").find("img").removeClass("sel");
		if (pj_bigimg.find("img").attr("src") == $(this).attr("src")) {
			pj_bigimg.empty();
		}
		else {
			$(this).addClass("sel");
			pj_bigimg.html('<img src="'+$(this).attr("src")+'" />');
		}
	})
})
</script>
<?php include(pe_tpl('footer.html'));?>