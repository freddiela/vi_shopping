<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=article" <?php if($act=='index' && !$_g_type):?>class="sel"<?php endif;?>>资讯中心（<?php echo $tongji['news'] ?>）<i></i></a>
		<a href="webadmin.php?mod=article&type=help" <?php if($act=='index' && $_g_type=='help'):?>class="sel"<?php endif;?>>帮助中心（<?php echo $tongji['help'] ?>）<i></i></a>
		<a href="webadmin.php?mod=article&act=add" id="fabu">添加文章</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="type" value="<?php echo $_g_type ?>" />
				文章名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input200" />
				<select name="class_id" class="selectmini">
				<option value="" href="<?php echo pe_updateurl('class_id', '') ?>">= 所有分类 =</option>
				<?php $selnum=1;?>
				<?php foreach($cache_class_arr[$_g_type?'help':'news'] as $v):?>
				<option value="<?php echo $v['class_id'] ?>" href="<?php echo pe_updateurl('class_id', $v['class_id']) ?>" <?php if($_g_class_id==$v['class_id']):?>selected="selected"<?php endif;?>><?php echo $selnum++ ?>)<?php echo $v['class_name'] ?></option>
				<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'article_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt aleft">文章名称</th>
			<th class="bgtt" width="120">分类名称</th>
			<th class="bgtt" width="120">发布日期</th>
			<th class="bgtt" width="70">浏览量</th>
			<th class="bgtt" width="80">是否弹框提示</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><input type="checkbox" name="article_id[]" value="<?php echo $v['article_id'] ?>"></td>
			<td><?php echo $v['article_id'] ?></td>
			<td class="aleft"><a href="<?php echo pe_url('article-'.$v['article_id']) ?>" target="_blank"><?php echo $v['article_name'] ?></a></td>
			<td><?php echo $cache_class[$v['class_id']]['class_name'] ?></td>
			<td class="num"><?php echo pe_date($v['article_atime']) ?></td>
			<td class="num"><?php echo $v['article_clicknum'] ?></td>
			<td class="num">
				<?php echo $v['is_alert'] == 0 ? '不弹框' : '弹框' ?>
			</td>
			<td>
				<a href="webadmin.php?mod=article&act=edit&id=<?php echo $v['article_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=article&act=del&id=<?php echo $v['article_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'article_id')" />
			<button href="webadmin.php?mod=article&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'article_id', 'form', '批量删除')">批量删除</button>
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