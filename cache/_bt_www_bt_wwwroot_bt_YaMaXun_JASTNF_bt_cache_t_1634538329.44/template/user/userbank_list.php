<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="javascript:;" class="sel"><?php echo $menutitle ?><span>(<?php echo $tongji['all'] ?>)</span><i></i></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=userbank&act=add" class="fabu_btn">新增账户</a>
		</div>
		<div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="200">账户类型</th>
				<th>收款帐号</th>
				<th width="200">收款人</th>
				<th width="80">操作</th>
			</tr>
			<?php foreach($info_list as $v):?>
			<tr>
				<td><?php echo $v['userbank_name'] ?></td>
				<td><?php echo $v['userbank_num'] ?></td>
				<td><?php echo $v['userbank_tname'] ?></td>
				<td><a href="javascript:pe_confirm('删除该账户', 'user.php?mod=userbank&act=del&id=<?php echo $v['userbank_id'] ?>&token=<?php echo $pe_token ?>')" class="tag_gray">删除</a></td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>