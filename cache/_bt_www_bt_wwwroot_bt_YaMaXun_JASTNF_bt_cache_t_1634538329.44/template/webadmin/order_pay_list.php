<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=order_pay" <?php if(!$_g_state):?>class="sel"<?php endif;?>><?php echo $menutitle ?>（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=order_pay&state=wpay" <?php if($_g_state=='wpay'):?>class="sel"<?php endif;?>>待付款（<?php echo $tongji['wpay'] ?>）<i></i></a>
		<a href="webadmin.php?mod=order_pay&state=success" <?php if($_g_state=='success'):?>class="sel"<?php endif;?>>已付款（<?php echo $tongji['success'] ?>）<i></i></a>
		<a href="webadmin.php?mod=order_pay&state=failed" <?php if($_g_state=='failed'):?>class="sel"<?php endif;?>>充值失败（<?php echo $tongji['failed'] ?>）<i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				订单号：<input type="text" name="id" value="<?php echo $_g_id ?>" class="inputtext input200 mar5" />
				用户名：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext input100" />
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
				<tr>
					<th class="bgtt" width="130">充值日期</th>
					<th class="bgtt" width="">订单号</th>
					<th class="bgtt" width="">汇款人</th>
					<th class="bgtt" width="150">充值金额</th>
					<th class="bgtt" width="150">用户名</th>
					<th class="bgtt" width="120">支付方式</th>
					<th class="bgtt" width="130">付款日期</th>
					<th class="bgtt" width="120">订单状态</th>
					<th class="bgtt" width="120">充值失败原因</th>
					<th class="bgtt" width="80">操作</th>
				</tr>
				<?php foreach($info_list as $v):?>
				<tr>
					<td class="num"><?php echo pe_date_color(pe_date($v['order_atime'])) ?></span></td>
					<td><?php echo $v['order_id'] ?></td>
					<td><?php echo $v['order_remitter'] ?></td>
					<td><span class="num strong cgreen"><?php echo $v['order_money'] ?></span></td>
					<td><?php echo $v['user_name'] ?></td>
					<td><?php echo $v['order_payment_name'] ?></td>
					<?php if($v['order_state'] == 'success'):?>
					<td class="num"><?php echo pe_date_color(pe_date($v['order_ptime'])) ?></td>
					<td><span class="cgreen">充值成功</span></td>
					<?php elseif($v['order_state'] == 'failed'):?>
					<td class="num">-</td>
					<td><span class="cred">充值失败</span></td>
					<?php else:?>
					<td class="num">-</td>
					<td><span class="cblue">待付款</span></td>
					<?php endif;?>
					<td><?php echo $v['reason'] ?></td>
					<td>
						<?php if($v['order_state'] == 'wpay'):?>
						<a href="webadmin.php?mod=order_pay&act=confirm_recharge&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>" class="tag_blue" onclick="return pe_dialog(this, '确认充值，单号【<?php echo $v['order_id'] ?>】', 600, 300, 'order_pay_success')">确认充值</a>
						<a href="webadmin.php?mod=order_pay&act=fail_recharge&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>" class="tag_org mat5" onclick="return pe_dialog(this, '充值失败，单号【<?php echo $v['order_id'] ?>】', 600, 300, 'order_pay_fail')">充值失败</a>
						<?php endif;?>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</form>
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