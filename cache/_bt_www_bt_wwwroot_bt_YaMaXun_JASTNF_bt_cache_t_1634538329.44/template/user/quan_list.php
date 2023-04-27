
<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="javascript:;" class="sel"><?php echo $menutitle ?><span>(<?php echo $tongji['all'] ?>)</span><i></i></a>
			<a href="javascript:duihuan_open();" class="fabu_btn">Mã số phiếu trao đổi</a>
		</div>
		<div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th>Tên phiếu Chiết khấu</th>
				<th width="100">Mệnh giá</th>
				<th width="100">Điều kiện sử dụng</th>
				<th width="100">Sản phẩm có hạn</th>
				<th width="200">Có hiệu lực đến ngày</th>
				<th width="80">Trang thái</td>
			</tr>
			<?php foreach($info_list as $v):?>
			<tr>
				<td class="aleft"><a href="<?php echo pe_url('quan-'.$v['quan_id']) ?>" title="<?php echo $v['quan_name'] ?>" target="_blank" class="cblue"><?php echo $v['quan_name'] ?></a></td>
				<td><span class="corg">¥<?php echo $v['quan_money'] ?></span></td>
				<td>Đầy <?php echo $v['quan_limit'] ?> Việt nam đồng</td>
				<td><?php echo $v['product_id']?'Một phần sản phẩm':'không có' ?></td>
				<td><?php echo $v['quan_sdate'] ?> đến <?php echo $v['quan_edate'] ?></td>
				<td>
					<?php if($v['quanlog_state']==0):?>
					<span class="tag_green">Chưa sử dụng</span>				
					<?php elseif($v['quanlog_state']==1):?>
					<span class="tag_gray">Đã sử dụng</span>					
					<?php elseif($v['quanlog_state']==2):?>
					<s class="tag_gray" style="color:#bbb">Đã hết hạn</s>
					<?php endif;?>
				</td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/html" id="duihuan_html">
<form method="post" id="form">
<div class="quan_box" style="text-align:center">
	<input type="text" name="quan_key" value="" class="inputall input200" placeholder="Vui lòng nhập mã phiếu giảm giá 10 chữ số" />
	<div class="quan_dh">
		<input type="hidden" name="pesubmit" />
		<input type="button" value="Trao đổi mã số phiếu " onclick="duihuan_btn()" />
	</div>
</div>
</form>
</script>
<script type="text/javascript">
function duihuan_open() {
	layer.open({
		type: 1,
		title: 'Trao đổi phiếu giảm giá',
		area: ['350px', '220px'],
		fixed: false,
		shadeClose: true,
		shade: 0.5,
		content: $("#duihuan_html").html()
	});
}
//兑换优惠券
function duihuan_btn() {
	pe_submit("user.php?mod=quan&act=duihuan", function(json){
		if (json.result) {
			pe_open('reload', 1000);
		}
	});
}
</script>
<?php include(pe_tpl('footer.html'));?>