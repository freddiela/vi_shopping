<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=rule" class="sel">规格列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=rule&act=add" id="fabu">添加规格</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt aleft" width="180" style="padding-left:30px">规格名称</th>
			<th class="bgtt">规格选项</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['rule_id'] ?></td>
			<td class="aleft" style="padding-left:30px"><?php echo $v['rule_name'] ?> <?php if($v['rule_memo']):?><span class="corg">[<?php echo $v['rule_memo'] ?>]</span><?php endif;?></td>
			<td><?php foreach((array)$cache_rule[$v['rule_id']]['list'] as $vv):?><span class="rule_id mal5"><?php echo $vv['ruledata_name'] ?></span><?php endforeach;?></td>
			<td>
				<a href="webadmin.php?mod=rule&act=edit&id=<?php echo $v['rule_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=rule&act=del&id=<?php echo $v['rule_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
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
<?php include(pe_tpl('footer.html','admin'));?>