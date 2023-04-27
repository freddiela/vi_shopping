<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20">
		<tr>
			<td align="right" width="150">文章名称：</td>
			<td><input type="text" name="info[article_name]" value="<?php echo $info['article_name'] ?>" class="inputall input500" /></td>
		</tr>
		<tr>
			<td align="right">文章分类：</td>
			<td>
				<select name="info[class_id]" class="inputselect">
				<?php foreach($cache_class_arr['news'] as $v):?>
				<option value="<?php echo $v['class_id'] ?>" <?php if($v['class_id']==$info['class_id']):?>selected="selected"<?php endif;?>>[资讯中心] <?php echo $v['class_name'] ?></option>
				<?php endforeach;?>
				<option value="0" disabled>--------------------------</option>
				<?php foreach($cache_class_arr['help'] as $v):?>
				<option value="<?php echo $v['class_id'] ?>" <?php if($v['class_id']==$info['class_id']):?>selected="selected"<?php endif;?>>[帮助中心] <?php echo $v['class_name'] ?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">发布日期：</td>
			<td><input type="text" name="info[article_atime]" value="<?php echo pe_date($info['article_atime'] ? $info['article_atime'] : time()) ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" class="Wdate inputall" /></td>
		</tr>
			<tr>
				<td align="right">是否弹框提示：</td>
				<td>
					<select name="info[is_alert]" class="inputselect input150">
						<option value="0">不弹框</option>
						<option value="1" <?php if($info['is_alert']==1):?>selected="selected"<?php endif;?>>弹框</option>
					</select>
				</td>
			</tr>
		<tr>
			<td align="right">文章详情：</td>
			<td>

<script id="editor" type="text/plain" name="info[article_text]" style="width:900px;height:450px;">
<?php echo $info['article_text'] ?>
</script>

            </td>
		</tr>
		</table>
		<div class="mat10 mab10">
			<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
			<input type="submit" name="pesubmit" id="submit" value="提 交" class="tjbtn" style="margin-left:435px" />
		</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/my97/WdatePicker.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $pe['host_root'] ?>public/plugin/u8editor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $pe['host_root'] ?>public/plugin/u8editor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $pe['host_root'] ?>public/plugin/u8editor/lang/zh-cn/zh-cn.js"></script>



<script type="text/javascript">
//实例化编辑器
var ue = UE.getEditor('editor');

</script>
<?php include(pe_tpl('footer.html','admin'));?>