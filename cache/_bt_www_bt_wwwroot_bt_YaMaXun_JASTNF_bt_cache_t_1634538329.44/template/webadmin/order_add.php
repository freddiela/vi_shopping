<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
		<div class="clear"></div>
	</div>
	<div class="right_main mab15">
	<div class="huiyuan_main" style="padding:0 35px 20px;">
		<div class="liucheng mat20">订单状态</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tr>
			<td align="right" class="c888" width="80">订单编号：</td>
			<td><?php echo $info['order_id'] ?></td>
		</tr>
		<tr>
			<td align="right" class="c888">当前状态：</td>
			<td>
				<span class="mar20"><?php echo order_stateshow($info['order_state']) ?></span>
				<?php if($info['order_state']=='wpay'):?>
				<a class="tag_org mar10" href="webadmin.php?mod=order&act=pay&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '订单付款', 600, 450, 'order_pay')">立即付款</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=money&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '修改价格', 950, 550, 'order_money')">修改价格</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=address&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '修改收货信息', 600, 450, 'order_address')">修改地址</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=close&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')">取消订单</a>
				<?php elseif($info['order_state'] == 'wtuan'):?>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=address&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '修改收货信息', 600, 450, 'order_address')">修改地址</a>
				<?php elseif($info['order_state'] == 'wsend'):?>
				<a class="tag_blue mar10" href="webadmin.php?mod=order&act=send&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '填写发货信息', 600, 450, 'order_send')">发 货</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=address&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '修改收货信息', 600, 450, 'order_address')">修改地址</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=close&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')">取消订单</a>
				<?php elseif($info['order_state'] == 'wget'):?>
				<a class="tag_green mar10" href="webadmin.php?mod=order&act=success&id=<?php echo $info['order_id'] ?>&token=<?php echo $pe_token ?>" onclick="return pe_cfone(this, '买家已收到商品')">确认收货</a>
				<a class="tag_gray mar10" href="webadmin.php?mod=order&act=close&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')">取消订单</a>
				<?php endif;?>
			</td>
		</tr>
		<?php if($info['order_state']=='close'):?>
		<tr>
			<td align="right">关闭说明：</td>
			<td><?php echo $info['order_closetext'] ?></td>
		</tr>
		<?php endif;?>
		</table>
		<?php if(count($prokey_list)):?>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">卡密信息</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list mat10">
		<tr>
			<th class="bgtt" width="60"><strong>序号</strong></th>
			<th class="bgtt" width="200"><strong>卡号</strong></th>
			<th class="bgtt" width="200"><strong>密码</strong></th>
			<th class="bgtt" width="200"><strong>有效期至</strong></th>
			<th class="bgtt"></th>
		</tr>
		<?php foreach($prokey_list as $k=>$v):?>
		<tr>
			<td><?php echo $k+1 ?></td>
			<td><?php echo $v['prokey_user'] ?></td>
			<td><?php echo $v['prokey_pw'] ?></td>
			<td><?php echo $v['prokey_edate'] ?></td>
			<td></td>
		</tr>
		<?php endforeach;?>
		</table>
		<?php endif;?>
		<?php if(!$info['order_virtual']):?>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">收货信息</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tr>
			<td align="right" class="c888" width="80">用户帐号：</td>
			<td><?php if($info['user_id']):?><?php echo $info['user_name'] ?></span><?php else:?><span class="c888">未登录用户<?php endif;?></td>
		</tr>
		<tr>
			<td align="right" class="c888">姓　　名：</td>
			<td><?php echo $info['user_tname'] ?></td>
		</tr>
		<tr>
			<td align="right" class="c888">手机号码：</td>
			<td><?php echo $info['user_phone'] ?></td>
		</tr>
		<tr>
			<td align="right" class="c888">收货地址：</td>
			<td><?php echo $info['user_address'] ?></td>			
		</tr>
		<tr>
			<td align="right" class="c888">订单备注：</td>
			<td><?php echo $info['order_text'] ?></td>
		</tr>	
		<tr>
			<td align="right" class="c888">快递信息：</td>
			<td><?php if($info['order_wl_name']):?><a href="<?php echo pe_url('order-kuaidi', 'id='.$info['order_wl_id']) ?>" target="_blank" class="tag_kd"><?php echo $info['order_wl_name'] ?>：<?php echo $info['order_wl_id'] ?></a><?php else:?>无<?php endif;?></td>
		</tr>	
		</table>
		<?php endif;?>
		<div class="shixian mat20"></div>
		<div class="liucheng mat20">订单信息</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_bak mat10">
		<tr>
			<td align="right" class="c888" width="80">下单时间：</td>
			<td><?php echo pe_date($info['order_atime']) ?></td>
		</tr>
		<tr>
			<td align="right" class="c888">付款时间：</td>
			<td><?php if($info['order_ptime']):?><?php echo pe_date($info['order_ptime']) ?><?php else:?>--<?php endif;?></td>
		</tr>
		<tr>
			<td align="right" class="c888">发货时间：</td>
			<td><?php if($info['order_stime']):?><?php echo pe_date($info['order_stime']) ?><?php else:?>--<?php endif;?></td>
		</tr>	
		<tr>
			<td align="right" class="c888">付款方式：</td>
			<td><?php echo $info['order_payment_name'] ?></td>
		</tr>
		</table>
		<div class="shixian mat20"></div>		
		<div class="liucheng mat20">商品清单</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_list mat20">
		<tr>
			<td class="bgtt1" width="" align="center" colspan="3">商品名称</td>
			<td class="bgtt1" width="90" align="center">单价(元)</td>
			<td class="bgtt1" width="90" align="center">数量</td>
			<td class="bgtt1" width="150" align="center">商品优惠</td>
			<td class="bgtt1" width="110" align="center">小计(元)</td>			
		</tr>
		<?php foreach($product_list as $k=>$v):?>
		<tr>
			<td style="border-right:0;width:60px"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" width="50" height="50" class="imgbg"></a></td>
			<td style="border-left:0;border-right:0;text-align:left;">
				<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" title="<?php echo $v['product_name'] ?>" target="_blank" class="cblue dd_name"><?php echo $v['product_name'] ?></a>
				<p class="c888 mat5"><?php echo order_skushow($v['product_rule']) ?></p>
			</td>
			<td style="border-left:0;width:80px;">
				<?php if($v['refund_state']):?>
				<a href="webadmin.php?mod=refund&act=view&id=<?php echo $v['refund_id'] ?>" target="_blank"><?php echo refund_stateshow($v['refund_state']) ?></a>
				<?php endif;?>
			</td>
			<td>¥ <span class="num"><?php echo $v['product_money'] ?></span></td>
			<td><span class="num"><?php echo $v['product_num'] ?></span></td>
			<td><?php echo order_jjmoney_show($v['product_jjmoney']) ?></td>
			<td>¥ <span class="num"><?php echo $v['product_allmoney'] ?></span></td>
		</tr>
		<?php endforeach;?>
		</table>
		<div class="dingdan_jiesuan" style="padding:10px; line-height:30px; font-family:微软雅黑; font-size:14px;">
			<?php if($info['order_point_get']):?>
			<div class="dingdan_jiesuan_l">可获得积分：<span class="cgreen num"><?php echo $info['order_point_get'] ?></span> 点</div>
			<?php endif;?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>商品金额：</td>
				<td width="100">¥ <?php echo $info['order_product_money'] ?></td>
			</tr>
			<tr>
				<td>运费：</td>
				<td>¥ <?php echo $info['order_wl_money'] ?></td>
			</tr>
			<?php if($info['order_quan_money']>0):?>
			<tr>
				<td>使用优惠券：</td>
				<td><a href="javascript:;" title="<?php echo $info['order_quan_name'] ?>">- ¥ <?php echo $info['order_quan_money'] ?></a></td>
			</tr>
			<?php endif;?>
			<?php if($info['order_point_money']>0):?>
			<tr>
				<td>使用积分：</td>
				<td><a href="javascript:;" title="使用<?php echo $info['order_point_use'] ?>积分">- ¥ <?php echo $info['order_point_money'] ?></a></td>
			</tr>
			<?php endif;?>
			<tr>
				<td>应付金额：</td>
				<td class="font16 cred strong">¥ <?php echo $info['order_money'] ?></td>
			</tr>
			</table>
			<div class="clear"></div>
		</div>
	</div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>