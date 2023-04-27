<?php include(pe_tpl('header_dialog.html','admin'));?>
<div style="margin-bottom:55px">
<form method="post" id="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
<tr>
	<th class="bgtt" width="50">排序</th>
	<th class="bgtt" width="100">收货人</th>
	<th class="bgtt" width="120">手机号码</th>
	<th class="bgtt">退货地址</th>
	<th class="bgtt" width="100">操作</th>
</tr>
<?php foreach($info_list as $v):?>
<tr>
	<td><input type="text" name="address_order[<?php echo $v['address_id'] ?>]" value="<?php echo $v['address_order'] ?>" class="inputtext input30 center" /></td>
	<td><?php echo $v['refund_tname'] ?></td>
	<td class="num"><?php echo $v['refund_phone'] ?></td>
	<td class="aleft"><?php echo $v['refund_address'] ?></td>
	<td>
		<a href="webadmin.php?mod=refund_addr&act=edit&id=<?php echo $v['address_id'] ?>" class="admin_edit mar3">修改</a>
		<a href="webadmin.php?mod=refund_addr&act=del&id=<?php echo $v['address_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
	</td>
</tr>
<?php endforeach;?>
</table>
<div class="right_bottom">
	<span class="fl">
		<button href="webadmin.php?mod=refund_addr&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">更新排序</button>
	</span>
	<div class="clear"></div>
</div>
</form>
</div>
<div id="fabu_btn"><a href="webadmin.php?mod=refund_addr&act=add">+ 添加退货地址</a></div>
<?php include(pe_tpl('footer_dialog.html','admin'));?>