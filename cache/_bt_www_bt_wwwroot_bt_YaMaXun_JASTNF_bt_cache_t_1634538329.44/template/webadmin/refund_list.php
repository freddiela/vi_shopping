<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=refund" <?php if(!$_g_state):?>class="sel"<?php endif;?>>全部申请（<?php echo $tongji['all'] ?>）<i></i></a>
		<?php foreach($ini['refund_state'] as $k=>$v):?>
		<a href="webadmin.php?mod=refund&state=<?php echo $k ?>" <?php if($_g_state==$k):?>class="sel"<?php endif;?>><?php echo $v ?>（<?php echo $tongji[$k] ?>）<i></i></a>
		<?php endforeach;?>
		<a href="webadmin.php?mod=refund_addr" onclick="return pe_dialog(this, '退货地址管理', '800', 500)" id="fabu">退货地址管理</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				订单编号：<input type="text" name="order_id" value="<?php echo $_g_order_id ?>" class="inputtext input150 mar5" />
				退款编号：<input type="text" name="id" value="<?php echo $_g_id ?>" class="inputtext input150 mar5" />
				用户名：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext input100 mar5" />
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" style="border-bottom:0;">商品信息</th>
			<th class="bgtt" style="border-bottom:0;" width="111">退款金额</th>
			<th class="bgtt" style="border-bottom:0;" width="121">用户名</th>
			<th class="bgtt" style="border-bottom:0;" width="91">类型</th>
			<th class="bgtt" style="border-bottom:0;" width="91">状态</th>
			<th class="bgtt" style="border-bottom:0;" width="91">操作</th>
		</tr>
		</table>
		<?php foreach($info_list as $k=>$v):?>
		<div class="hy_ordertw c666 mat10">
			退款编号：<span class="num" style="margin-right:60px"><?php echo $v['refund_id'] ?></span>
			申请日期：<span class="num"><?php echo pe_date($v['refund_atime']) ?></span>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
		<tr>
			<td class="aleft" style="border-left:0;padding:8px 10px;">
				<div class="dingdan_list" <?php if($kk==0):?>style="padding-top:0"<?php endif;?>>
				<table width="100%" class="dd_tb1">
				<tr>
					<td width="50"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" width="40" height="40" class="imgbg" /></a></td>
					<td>
						<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank" class="cblue dd_name"><?php echo $v['product_name'] ?></a>
						<p class="c999"><?php echo order_skushow($v['product_rule']) ?></p>
						<p class="c999 font12">订单号：<a href="webadmin.php?mod=order&act=edit&id=<?php echo $v['order_id'] ?>" target="_blank" class="c999"><?php echo $v['order_id'] ?></a></p>
					</td>
					<td class="aright">
						<span class="num"><?php echo $v['product_money'] ?></span>(×<?php echo $v['product_num'] ?>)
					</td>
				</tr>
				</table>
				</div>
			</td>
			<td width="110">
				<p class="corg num strong"><?php echo $v['refund_money'] ?></p>
				<p class="c999">（含运费：<?php echo $v['refund_wl_money'] ?>）</p>
			</td>
			<td width="120"><?php echo $v['user_name'] ?></td>
			<td width="90"><?php echo $ini['refund_type'][$v['refund_type']] ?></td>
			<td width="90"><?php echo refund_stateshow($v['refund_state']) ?><p class="mat5"><a href="webadmin.php?mod=refund&act=view&id=<?php echo $v['refund_id'] ?>" target="_blank" class="c999">查看详情</a></p></td>
			<td width="90" style="border-right:0;">
				<?php if($v['refund_state']=='wcheck'):?>
				<a class="tag_org" href="webadmin.php?mod=refund&act=agree&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, '同意本次申请', 650, 390, 'refund')">同意申请</a>
				<p class="mat5"><a class="tag_gray" href="webadmin.php?mod=refund&act=refuse&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, '拒绝本次申请', 650, 410, 'refund')">拒绝申请</a></p>
				<?php elseif($v['refund_state'] == 'wsend'):?>
				<a class="tag_gray" href="webadmin.php?mod=refund&act=refuse&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, '拒绝本次申请', 650, 410, 'refund')">拒绝申请</a>
				<?php elseif($v['refund_state'] == 'wget'):?>
				<a class="tag_green" href="webadmin.php?mod=refund&act=success&id=<?php echo $v['refund_id'] ?>&token=<?php echo $pe_token ?>" onclick="return pe_cfone(this, '已收货并退款')">确认收货</a>
				<p class="mat5"><a class="tag_gray" href="webadmin.php?mod=refund&act=refuse&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, '拒绝本次申请', 650, 410, 'refund')">拒绝申请</a></p>
				<?php elseif($v['refund_state'] == 'refuse'):?>
				<a class="tag_org" href="webadmin.php?mod=refund&act=agree&id=<?php echo $v['refund_id'] ?>" onclick="return pe_dialog(this, '同意本次申请', 650, 390, 'refund')">同意申请</a>
				<?php elseif($v['refund_state'] == 'close'):?>
				<a href="webadmin.php?mod=refund&act=del&id=<?php echo $v['refund_id'] ?>&token=<?php echo $pe_token ?>" onclick="return pe_cfone(this, '删除本次申请')" class="c999">删除</a>
				<?php else:?>
				-
				<?php endif;?>
			</td>
		</tr>
		</table>
		<?php endforeach;?>
	</div>
	<div class="right_bottom">
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("select").change(function(){
		window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
	})
})
</script>
<?php include(pe_tpl('footer.html','admin'));?>