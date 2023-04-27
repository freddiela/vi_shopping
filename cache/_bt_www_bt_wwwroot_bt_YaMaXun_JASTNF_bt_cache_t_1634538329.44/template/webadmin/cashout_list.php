<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=cashout" <?php if(!$_g_state):?>class="sel"<?php endif;?>>待审核（<?php echo $tongji[0] ?>）<i></i></a>
		<a href="webadmin.php?mod=cashout&state=1" <?php if($_g_state==1):?>class="sel"<?php endif;?>>已审核（<?php echo $tongji[1] ?>）<i></i></a>
		<a href="webadmin.php?mod=cashout&state=2" <?php if($_g_state==2):?>class="sel"<?php endif;?>>已取消（<?php echo $tongji[2] ?>）<i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				用户名：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input100 mar5" />
				姓名：<input type="text" name="banktname" value="<?php echo $_g_banktname ?>" class="inputtext input100 mar5" />
				帐号：<input type="text" name="banknum" value="<?php echo $_g_banknum ?>" class="inputtext input200 mar5" />
				<select name="bankname" class="selectmini">
				<option value="" href="<?php echo pe_updateurl('bankname', '') ?>">= 账户类型 =</option>
				<?php foreach($ini['userbank_type'] as $k=>$v):?>
				<option value="<?php echo $v ?>" href="<?php echo pe_updateurl('bankname', $v) ?>" <?php if($_g_bankname==$v):?>selected="selected"<?php endif;?>>[<?php echo ++$kkk?>]<?php echo $v ?></option>
				<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'cashout_id')" /></th>
			<th class="bgtt" width="120">申请日期</th>
			<th class="bgtt" width="130">用户名</th>
			<th class="bgtt" width="120">提现金额</th>
			<th class="bgtt">收款账户</th>
			<th class="bgtt" width="120">用户IP</th>
			<th class="bgtt" width="100">审核日期</th>
			<th class="bgtt" width="110">审核状态</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="cashout_id[]" value="<?php echo $v['cashout_id'] ?>"></td>
			<td><?php echo pe_date_color(pe_date($v['cashout_atime'])) ?></td>
			<td><?php echo $v['user_name'] ?></td>
			<td>
				<p class="corg num strong"><?php echo $v['cashout_money'] ?></p>
				<p class="c999">（已扣：<?php echo $v['cashout_fee'] ?>）</p>
			</td>
			<td class="aleft" valign="top" style="padding:5px;color:#555">
				<p>【类型】<?php echo $v['cashout_bankname'] ?><?php if($v['cashout_bankaddress']):?><span class="cbbb">（<?php echo $v['cashout_bankaddress'] ?>）</span><?php endif;?></p>
				<p>【帐号】<?php echo $v['cashout_banknum'] ?></p>
				<p>【姓名】<?php echo $v['cashout_banktname'] ?></p>
			</td>
			<td><?php echo $v['cashout_ip'] ?></td>
			<td><?php echo pe_date($v['cashout_ptime'], 'm-d H:i') ?></td>
			<td>
				<?php if($v['cashout_state'] == 1):?>
				<img src="<?php echo $pe['host_admintpl'] ?>images/dui.png" />
				<?php elseif($v['cashout_state'] == 2):?>
				<img src="<?php echo $pe['host_admintpl'] ?>images/cuo.png" />
				<?php else:?>
				<a href="webadmin.php?mod=cashout&act=success&id=<?php echo $v['cashout_id'] ?>" class="admin_edit mar3" onclick="return pe_cfone(this, '结算完成')">通过</a>
				<a href="webadmin.php?mod=cashout&act=refuse&id=<?php echo $v['cashout_id'] ?>" class="admin_del" onclick="return pe_cfone(this, '拒绝提现')">拒绝</a>
				<?php endif;?>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'cashout_id')" />
			<button href="webadmin.php?mod=cashout&act=success" onclick="return pe_cfall(this, 'cashout_id', 'form', '批量通过')">批量通过</button>
		</span>
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