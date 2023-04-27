<?php include(pe_tpl('header.html'));?>
<div class="qg_top">
	<p><?php echo $menutitle ?></p>
</div>
<div class="content">
	<div class="tuijian_list">
		<?php foreach($info_list as $k=>$v):?>
		<div class="prolist" <?php if(($k+1)%4==0):?>style="margin-right:0"
			<?php endif;?>>
			<?php if($v['huodong_stime'] <= time() && $v['isUser'] == 1):?>
			<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank">
			<?php else:?>
			<a title="<?php echo $v['product_name'] ?>">
			<?php endif;?>
				<div class="prolist_img">
					<img src="<?php echo $pe['host_tpl'] ?>images/pixel.gif" data-url="<?php echo pe_thumb($v['product_logo'], 400, 400) ?>"
						title="<?php echo $v['product_name'] ?>" width="265px" height="265px" class="js_imgload" />
					<div class="ms_time">
						<!-- 剩余 <span class="huodong_time" endtime="<?php echo $v['huodong_etime'] ?>"></span> -->
						<?php if($v['huodong_stime'] >= time()):?>
						<span class="timer-text"  data-i18n-text="距拼团开始">距拼团开始</span>
						<span class="huodong_time" endtime="<?php echo $v['huodong_stime'] ?>"></span>
						<input class="refresh_etime" type="hidden" value="<?php echo $v['huodong_etime'] ?>" />
						<?php else:?>
						Còn lại <span class="huodong_time" endtime="<?php echo $v['huodong_etime'] ?>"></span>
						<?php endif;?>
					</div>
					<div class="ms_bg1"></div>
				</div>
				<p class="prolist_name"><?php echo $v['product_name'] ?></p>
			</a>
			<div class="qg_box">
				<span class="qg_l">
					<span class="mar10 money4"><span class="font16">¥</span><?php echo product_money($v['product_money']) ?></span>
					<s class="font12"><i>¥<?php echo product_money($v['product_smoney']) ?></i></s>
				</span>
				<?php if($v['huodong_stime'] >= time()):?>
				<a href="#" title="<?php echo $v['product_name'] ?>" class="qg_r" style="background-color: #a8a0a0;"><?php echo $v['product_ptnum'] ?>Nhóm người</a>
				<?php else:?>
				<?php if($v['isUser'] == 1):?>
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank"
					class="qg_r"><?php echo $v['product_ptnum'] ?>Nhóm người</a>
				<?php else:?>
				<a title="<?php echo $v['product_name'] ?>" class="qg_r" style="background-color: #a8a0a0;" data-i18n-text="无参加资格">无参加资格</a>
				<?php endif;?>
				
				<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="fenye mat15"><?php echo $db->page->html ?></div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(function () {
		pe_jstime(".huodong_time", '<?php echo time() ?>', 'html');
	})
</script>
<style type="text/css">
	.prolist {
		height: 360px;
	}
</style>
<?php include(pe_tpl('footer.html'));?>