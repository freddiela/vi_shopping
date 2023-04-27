<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<?php include(pe_tpl('setting_menu.html','admin'));?>
	<form method="post" enctype="multipart/form-data">
		<div class="right_main">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
				<tr>
					<td align="right" width="150">游客购买：</td>
					<td>
						<?php foreach(array(1=>'开启', 0=>'关闭') as $k=>$v):?>
						<label class="mar30"><input type="radio" name="info[web_guestbuy]" value="<?php echo $k ?>" class="inputfix" <?php if($info['web_guestbuy']['setting_value']==$k):?>checked="checked"<?php endif;?> /> <?php echo $v ?></label>
						<?php endforeach;?>
						<span class="c999">（开启后用户可以不注册购买）</span>
					</td>
				</tr>
				<tr>
					<td align="right">注册验证：</td>
					<td>
						<?php foreach(array('web_checkphone'=>'手机验证码', 'web_checkemail'=>'邮箱验证码') as $k=>$v):?>
						<label for="<?php echo $k ?>" class="mar10"><input type="checkbox" name="info[<?php echo $k ?>]" value="1" id="<?php echo $k ?>" class="inputfix" <?php if($info[$k]['setting_value']):?>checked="checked"<?php endif?> /> <?php echo $v ?></label>
						<?php endforeach?>
						<span class="c999 mal10">（注册时是否验证手机/邮箱）</span>
					</td>
				</tr>
				<tr>
					<td align="right">提现金额：</td>
					<td>
						<input type="text" name="info[cashout_min]" value="<?php echo $info['cashout_min']['setting_value'] ?>" class="inputall input100" /> 元
						<span class="c999 mal10">（最低提现金额）</span>
					</td>
				</tr>
				<tr>
					<td align="right">提现费用：</td>
					<td>
						<input type="text" name="info[cashout_fee]" value="<?php echo $info['cashout_fee']['setting_value']*100 ?>" class="inputall input100" /> %
						<span class="c999 mal10">（提现手续费）</span>
					</td>
				</tr>
				<tr>
					<td align="right">提现功能：</td>
					<td>
						<?php foreach(array(1=>'开启', 0=>'关闭') as $k=>$v):?>
						<label class="mar30"><input type="radio" name="info[cashout_is_need_order]" value="<?php echo $k ?>" <?php if($info['cashout_is_need_order']['setting_value']==$k):?>checked="checked"<?php endif;?> /> <?php echo $v ?></label>
						<?php endforeach;?>
						<span class="c999 mal10">（提现时是否需要购买商品）</span>
					</td>
				</tr>
				<tr>
					<td align="right" width="150">分销功能：</td>
					<td>
						<?php foreach(array(1=>'开启', 0=>'关闭') as $k=>$v):?>
						<label class="mar30"><input type="radio" name="info[tg_state]" value="<?php echo $k ?>" <?php if($info['tg_state']['setting_value']==$k):?>checked="checked"<?php endif;?> /> <?php echo $v ?></label>
						<?php endforeach;?>
					</td>
				</tr>
				<tr>
					<td align="right">一级分成(小数)：</td>
					<td><input type="text" name="info[tg_fc1]" value="<?php echo $info['tg_fc1']['setting_value'] ?>" class="inputall input100" />0.1代表10%</td>
				</tr>
				<tr>
					<td align="right">二级分成(小数)：</td>
					<td><input type="text" name="info[tg_fc2]" value="<?php echo $info['tg_fc2']['setting_value'] ?>" class="inputall input100" />0.2代表20%</td>
				</tr>
				<tr>
					<td align="right">三级分成(小数)：</td>
					<td><input type="text" name="info[tg_fc3]" value="<?php echo $info['tg_fc3']['setting_value'] ?>" class="inputall input100" />0.5代表50%</td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td>
						<input type="hidden" name="pesubmit" />
						<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
						<input type="submit" value="提 交" class="tjbtn" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<?php include(pe_tpl('footer.html','admin'));?>