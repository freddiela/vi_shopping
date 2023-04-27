<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<?php include(pe_tpl('setting_menu.html','admin'));?>
	<div class="right_main">
		<div class="tixing corg">
			<p>短信使用的是阿里大鱼，可以先注册一个阿里大鱼的帐号<a href="http://www.alidayu.com/" class="cblue" target="_blank">申请帐号</a>，然后查看<a href="http://www.qiye1000.com/xyshop/index.php?mod=doc&act=23" class="cblue" target="_blank">使用说明</a></p>
		</div>
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20">
		<tr>
			<td align="right" width="150">appKey：</td>
			<td><input type="text" name="info[sms_key]" value="<?php echo $info['sms_key']['setting_value'] ?>" class="inputall input300" /></td>
		</tr>
        <tr>
			<td align="right" width="150">secretKey：</td>
			<td><input type="text" name="info[sms_secret]" value="<?php echo $info['sms_secret']['setting_value'] ?>" class="inputall input300" /></td>
		</tr>
		<tr>
			<td align="right">短信签名：</td>
			<td><input type="text" name="info[sms_sign]" value="<?php echo $info['sms_sign']['setting_value'] ?>" class="inputall input300" /> <span class="c999">（例：逍遥商城 要与阿里短信中的签名保持一致哦）</span></td>
		</tr>
		
		<tr>
			<td align="right">管理员手机号：</td>
			<td>
				<input type="text" name="info[sms_admin]" value="<?php echo $info['sms_admin']['setting_value'] ?>" class="inputall input300" />
				
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="pesubmit" />
				<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
				<input type="submit" value="提 交" class="tjbtn" />
			</td>
		</tr>
		</table>
		</form>
	</div>
	<div class="now">
		<a href="javascript:;" class="sel">短信通知<i></i></a>
	</div>
	<?php foreach(array('user'=>'会员', 'admin'=>'管理员') as $user_type=>$user_name):?>
	<div class="right_main">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">序号</th>
			<th class="bgtt" width="">通知类型</th>
			<th class="bgtt" width="250">通知用户</th>
			<th class="bgtt" width="250">通知模板</th>
			<th class="bgtt" width="250">启用状态</th>
		</tr>
		<?php $num=1?>
		<?php foreach($notice_list[$user_type] as $k=>$v):?>
		<tr>
			<td><?php echo $num++ ?></td>
			<td><?php echo $v['notice_name'] ?></td>
			<td><?php echo $user_name ?></td>
			<td>
				<a href="webadmin.php?mod=notice&act=edit&type=sms&id=<?php echo $v['notice_id'] ?>" class="admin_edit" onclick="return pe_dialog(this, '修改短信模板', 850, 500, 'notice')">编辑</a>
			</td>
			<td class="layui-form">
				<input type="checkbox" <?php if($v['notice_sms_state']):?>checked<?php endif;?> lay-skin="switch" lay-text="开启|关闭" url="webadmin.php?mod=notice&act=sms_state&id=<?php echo $v['notice_id'] ?>&token=<?php echo $pe_token ?>" />
			</td>
		</tr>
		<?php endforeach;?>
		</table>
	</div>
	<?php endforeach;?>
</div>
<link rel="stylesheet" href="<?php echo $pe['host_root'] ?>public/plugin/layui/css/layui.css">
<script src="<?php echo $pe['host_root'] ?>public/plugin/layui/layui.js"></script>
<script type="text/javascript">
$(function(){
	$.getJSON("http://www.phpshe.com/api.php?mod=sms&act=point&key=<?php echo $info['sms_key']['setting_value'] ?>&ver=0.1&callback=?", function(json){
		if (!json.result) json.point = 0;
		$("#point").html(json.point+' 条');
	})
	$("#sms_test").click(function(){
		$(this).attr("href", "webadmin.php?mod=setting&act=sms_test&user="+$(":input[name='info[sms_admin]']").val()+"&token=<?php echo $pe_token ?>");
	})
})
layui.use(['form'], function(){
	form = layui.form;
	form.on('switch', function(data){
		var url = $(this).attr("url") + "&value=" + (this.checked ? 1 : 0)
		pe_getinfo(url);
	});
});
</script>
<?php include(pe_tpl('footer.html','admin'));?>