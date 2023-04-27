<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="javascript:;" class="sel"><?php echo $menutitle ?><span>(<?php echo $tongji['all'] ?>)</span><i></i></a>
			<a href="user.php?mod=useraddr&act=add" class="fabu_btn">新增地址</a>
			<div class="clear"></div>
		</div>
		<div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="100">收货人</th>
				<th width="120">手机号码</th>
				<th>收货地址</th>
				<th width="130">操作</td>
			</tr>
			<?php foreach($info_list as $v):?>
			<tr>
				<td><?php echo $v['user_tname'] ?></td>
				<td><?php echo userbank_num($v['user_phone']) ?></td>
				<td class="aleft">
					<?php if($v['address_default']):?><span class="cred">[默认]</span><?php endif;?>
					<?php echo $v['address_province'] ?> <?php echo $v['address_city'] ?> <?php echo $v['address_area'] ?> <?php echo $v['address_text'] ?>
				</td>
				<td>
					<a href="user.php?mod=useraddr&act=edit&id=<?php echo $v['address_id'] ?>" class="tag_gray mar5">修改</a>
					<a href="javascript:pe_confirm('删除该地址', 'user.php?mod=useraddr&act=del&id=<?php echo $v['address_id'] ?>&token=<?php echo $pe_token ?>')" class="tag_gray">删除</a>				
				</td>
			</tr>
			<?php endforeach;?>
			</table>
		</div>
		<div class="fenye mat10"><?php echo $db->page->html ?></div>
	</div>
	<div class="clear"></div>
</div>
<?php include(pe_tpl('footer.html'));?>