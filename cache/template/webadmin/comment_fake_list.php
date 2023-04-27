<?php include(pe_tpl('header.html','admin'));?>

<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=comment_fake" <?php if($act=='index' && !$_g_star):?>class="sel"
			<?php endif;?>>评价计划<i></i>
		</a>
		<a href="webadmin.php?mod=comment_fake&star=comment" <?php if($act=='index' && $_g_star=='comment'
			):?>class="sel"
			<?php endif;?>>评价内容<i></i>
		</a>

		<a href="webadmin.php?mod=comment_fake&act=comment_add"
			onclick="return pe_dialog(this, '添加评价', 920, 300, 'comment_add')" id="fabu">添加评论</a>
		<a href="webadmin.php?mod=comment_fake&act=comment_plan_add" id="fabu">添加计划</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
			<thead>

				<th class="bgtt" style="border-bottom:0;">编号</th>
				<th class="bgtt" style="border-bottom:0;">商品数</th>
				<!-- <th class="bgtt" style="border-bottom:0;">内容</th> -->
				<th class="bgtt" style="border-bottom:0;" width="240">操作</th>
			</thead>
			<tbody class="list-items">
				<?php foreach($info_list as $k=>$v):?>
				<tr>
					<td data-value="<?php echo $v['cfp_id'] ?>" style="background-color: rgb(255, 255, 255);">
						<?php echo $v['cfp_id'] ?></td>
					<td data-value="<?php echo $v['cfp_goods_num'] ?>" style="background-color: rgb(255, 255, 255);">
						<?php echo $v['cfp_goods_num'] ?></td>
					<!-- <td data-value="<?php echo $v['cf_comment_text'] ?>" style="background-color: rgb(255, 255, 255);">
						<?php echo $v['cf_comment_text'] ?>
					</td> -->

					<td style="background-color: rgb(255, 255, 255); text-align: right;">
						<?php if($v['status']==0):?>
						<a href="webadmin.php?mod=comment_fake&act=plan_edit&id=<?php echo $v['cfp_id'] ?>"
							class="admin_edit mar3">修改</a>
						<!-- <a class="btn tag_org" onclick="del(<?php echo $v['cf_id'] ?>)">删除</a> -->
						<a href="webadmin.php?mod=comment_fake&act=plan_del&id=<?php echo $v['cfp_id'] ?>&token=<?php echo $pe_token ?>"
							class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
						<?php endif;?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<input type="hidden" class="pe_token" value="<?php echo $pe_token ?>" />
	</div>

</div>
<script type="text/javascript">
	$(function () {
		$("select").change(function () {
			window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
		})
	})
</script>

<?php include(pe_tpl('footer.html','admin'));?>