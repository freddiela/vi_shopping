
<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=quan" class="sel">优惠券列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=quan&act=add" id="fabu">添加优惠券</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40"></th>
			<th class="bgtt aleft">优惠券名称</th>
			<th class="bgtt" width="100">领取方式</th>
			<th class="bgtt" width="80">限定商品</th>
			<th class="bgtt" width="50">总数量</th>
			<th class="bgtt" width="50">已领取</th>
			<th class="bgtt" width="50">已使用</th>
			<th class="bgtt" width="80">创建日期</th>
			<th class="bgtt" width="80">有效日期</th>
			<th class="bgtt" width="60">状态</th>
			<th class="bgtt" width="150">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['quan_id'] ?></td>
			<td><img src="<?php echo $pe['host_admintpl'] ?>images/quan.png" style="width:33px;" /></td>
			<td class="aleft"><a href="<?php echo pe_url('quan-'.$v['quan_id']) ?>" target="_blank" class="cblue"><?php echo $v['quan_name'] ?></a><br/><?php echo $v['quan_money'] ?>元<span class="c999">（满<?php echo $v['quan_limit'] ?>元可用）</span></td>
			<td><?php echo $ini['quan_type'][$v['quan_type']] ?></td>
			<td><?php echo $v['product_id']?count(explode(',', $v['product_id'])).'个':'无' ?></td>
			<td><?php echo $v['quan_num'] ?></td>
			<td><?php echo $v['quan_num_get'] ?></td>
			<td><?php echo $v['quan_num_use'] ?></td>
			<td><?php echo pe_date($v['quan_atime'], 'Y-m-d') ?></td>
			<td><?php echo $v['quan_sdate'] ?><br/><?php echo $v['quan_edate'] ?></td>
			<td>
				<?php if($v['quan_edate'] < date('Y-m-d')):?>
				<del class="c888">已过期</del>
				<?php elseif($v['quan_sdate'] > date('Y-m-d')):?>
				<span class="corg">未开始</span>
				<?php else:?>
				<span class="cgreen">进行中</span>		
				<?php endif;?>		
			</td>
			<td>
				<a href="webadmin.php?mod=quan&act=edit&id=<?php echo $v['quan_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=quan&act=del&id=<?php echo $v['quan_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
				<?php if($v['quan_type'] == 'offline'):?>
				<a href="webadmin.php?mod=quan&act=mylog&id=<?php echo $v['quan_id'] ?>" class="admin_btn" onclick="return pe_dialog(this, '【<?php echo $v['quan_name'] ?>】券码列表', 900, 550)">券码</a>
				<?php else:?>
				<a href="webadmin.php?mod=quan&act=mylog&id=<?php echo $v['quan_id'] ?>" class="admin_btn" onclick="return pe_dialog(this, '【<?php echo $v['quan_name'] ?>】领取记录', 900, 550)">明细</a>		
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
<?php include(pe_tpl('footer.html','admin'));?>