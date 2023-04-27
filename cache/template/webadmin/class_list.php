<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=class" <?php if($_g_type=='news'):?>class="sel"<?php endif;?>>资讯中心<i></i></a>
		<a href="webadmin.php?mod=class&type=help" <?php if($_g_type=='help'):?>class="sel"<?php endif;?>>帮助中心<i></i></a>
		<a href="webadmin.php?mod=class&act=add" <?php if($act=='add'):?>class="sel"<?php endif;?> id="fabu">添加分类</a>
		<?php if($act=='edit'):?><a href="javascript:;" class="sel">修改信息</a><?php endif;?>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="60">排序</th>
			<th class="bgtt">分类名称</td>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $k=>$v):?>
		<tr>
			<td><input type="text" name="class_order[<?php echo $v['class_id'] ?>]" value="<?php echo $v['class_order'] ?>" class="inputtext input40 center" /></td>
			<td class="aleft"><a href="<?php echo pe_url('article-list-'.$v['class_id']) ?>" target="_blank"><?php echo $v['class_name'] ?></a></td>
			<td>
				<?php if($v['class_id'] != 1):?>
				<a href="webadmin.php?mod=class&act=edit&id=<?php echo $v['class_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=class&act=del&id=<?php echo $v['class_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
				<?php else:?>
				-
				<?php endif?>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl">
			<button href="webadmin.php?mod=class&act=order&token=<?php echo $pe_token ?>" onclick="pe_doall(this,'form')">批量排序</button>
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>