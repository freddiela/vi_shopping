
<?php include(pe_tpl('header.html'));?>
<div class="lq_top"><p><?php echo $menutitle ?></p></div>
<div class="content" style="min-height:500px; _height:500px;">
	<?php foreach($info_list as $k=>$v):?>
	<div class="yhq_list" <?php if(($k+1)%3==0):?>style="margin-right:0"<?php endif;?>>
		<div class="yhq_l">
			<div class="yhq_jg"> ¥ <span class="yhq"><?php echo $v['quan_money'] ?></span></div>
			<div class="mat10">
				<p><span class="c888">Tên sản phẩm chiết khấu：</span><?php echo $v['quan_name'] ?></p>
				<p><span class="c888">Điều kiện sử dụng：</span><?php echo quan_limitshow($v) ?></p>
				<p><span class="c888">Ngày có hiệu lực: </span><?php echo $v['quan_sdate'] ?> đến <?php echo $v['quan_edate'] ?></p>
			</div>
		</div>
		<?php if(is_array($myquan[$k][$v['quan_id']])):?>
		<div class="yhq_btn yhq_btn2"><a href="<?php echo pe_url('quan-'.$v['quan_id']) ?>" name="<?php echo $v['quan_name'] ?>" target="_blank"><span>Đã nhận lấy</span></a></div>
		<?php else:?>
		<div class="yhq_btn"><a href="<?php echo pe_url('quan-'.$v['quan_id']) ?>" name="<?php echo $v['quan_name'] ?>" target="_blank"><span>Nhận ngay bây giờ</span></a></div>
		<?php endif;?>
	</div>
	<?php endforeach;?>
</div>
<?php include(pe_tpl('footer.html'));?>
<style type="text/css">
body{background:#f8f8f8;}
</style>