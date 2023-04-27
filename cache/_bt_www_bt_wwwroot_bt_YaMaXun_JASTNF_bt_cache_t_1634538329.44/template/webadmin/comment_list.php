<?php include(pe_tpl('header.html','admin'));?>

<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=comment" <?php if($act=='index' && !$_g_star):?>class="sel"<?php endif;?>>所有评价（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=comment&star=hao" <?php if($act=='index' && $_g_star=='hao'):?>class="sel"<?php endif;?>>好 评（<?php echo $tongji['hao'] ?>）<i></i></a>
		<a href="webadmin.php?mod=comment&star=zhong" <?php if($act=='index' && $_g_star=='zhong'):?>class="sel"<?php endif;?>>中 评（<?php echo $tongji['zhong'] ?>）<i></i></a>
		<a href="webadmin.php?mod=comment&star=cha" <?php if($act=='index' && $_g_star=='cha'):?>class="sel"<?php endif;?>>差 评（<?php echo $tongji['cha'] ?>）<i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="star" value="<?php echo $_g_star ?>" />
				评价用户：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext input100 mar5" />
				评价内容：<input type="text" name="text" value="<?php echo $_g_text ?>" class="inputtext input150 mar5" />
				商品名称：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input150 mar5" />
				<select name="reply" class="selectmini">
				<option value="" href="<?php echo pe_updateurl('reply', '') ?>">= 是否回复 =</option>
				<?php foreach(array(1=>'已回复', 0=>'未回复') as $k=>$v):?>
				<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('reply', $k) ?>" <?php if(strlen($_g_reply) && $_g_reply==$k):?>selected="selected"<?php endif;?>><?php echo ++$index?>) <?php echo $v ?></option>
				<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'comment_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt">评价内容</th>
			<!--<th class="bgtt" width="100">综合评分</th>-->
			<th class="bgtt" width="150">评价用户</th>
			<th class="bgtt" colspan="2">商品信息</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<?php $comment_logo = $v['comment_logo'] ? explode(',', $v['comment_logo']) : array()?>
		<tr>
			<td><input type="checkbox" name="comment_id[]" value="<?php echo $v['comment_id'] ?>" /></td>
			<td><?php echo $v['comment_id'] ?></td>
			<td valign="top" style="text-align:left">
				<p><?php echo $v['comment_text'] ?></p>
				<?php if(count($comment_logo)):?>
				<p class="mat5">
				<?php foreach($comment_logo as $index=>$logo):?>
				<a href="webadmin.php?mod=comment&act=logo&id=<?php echo $v['comment_id'] ?>&num=<?php echo $index ?>" target="_blank"><img src="<?php echo pe_thumb($logo, '_40', '_40') ?>" style="border:1px solid #eaeaea" /></a>
				<?php endforeach;?>
				</p>
				<?php endif;?>
				<div class="font12 cbbb mat10"><?php echo pe_date($v['comment_atime'], 'Y年m月d日 H:i') ?><span class="mal20"><?php echo pe_comment($v['comment_star'], 12) ?></span></div>
			</td>
			<!--<td><?php echo pe_comment($v['comment_star']) ?></td>-->
			<td>
				<img src="<?php echo pe_thumb($v['user_avatar'], '_120', '_120', 'avatar') ?>" style="width:40px">
				<p class="mat2"><a href="http://www.ip138.com/ips.asp?ip=<?php echo $v['user_ip'] ?>" target="_blank"><?php echo $v['user_name'] ?></a>
			</p>
			<td width="40"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" width="40" height="40" class="imgbg" /></a></td>
			<td class="aleft" width="210" style="padding-left:0"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue"><?php echo $v['product_name'] ?></a></td>
			<td>
				<a href="webadmin.php?mod=comment&act=edit&id=<?php echo $v['comment_id'] ?>&<?php echo pe_fromto() ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=comment&act=del&id=<?php echo $v['comment_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'comment_id')" />
			<button href="webadmin.php?mod=comment&act=del&token=<?php echo $pe_token ?>" onclick="return pe_cfall(this, 'comment_id', 'form', '批量删除')">批量删除</button>
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