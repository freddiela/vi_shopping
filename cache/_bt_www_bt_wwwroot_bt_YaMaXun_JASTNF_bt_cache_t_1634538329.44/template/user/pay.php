<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt">
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=pay" <?php if($menumark=='pay'):?>class="sel"<?php endif;?>>Nạp tiền tài khoản<i></i></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=cashout&act=add" <?php if($menumark=='cashout_add'):?>class="sel"<?php endif;?>>Áp dụng cho tiền mặt<i></i></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=cashout" <?php if($menumark=='cashout_list'):?>class="sel"<?php endif;?>>Bản thông kê rút tiền<i></i></a>
		</div>
		<div class="hy_table">
			<form method="post" id="form" target="_blank">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="text-align:right;" width="150">Số dư tài khoản：</td>
						<td><span class="corg"><?php echo $user['user_money'] ?> Việt nam đồng</span></td>
					</tr>
					<tr>
						<td style="text-align:right;">Nạp tiền ：</td>
						<td>
							<input type="text" name="order_money" value="" class="inputall input150" /> Việt nam đồng
							<span id="order_money_show" class="mal10"></span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Tên người chuyển khoản：</td>
						<td>
							<input type="text" name="order_remitter" value="" class="inputall input150" /> 
							<span id="order_remitter_show" class="mal10"></span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Phương thức thanh toán：</td>
						<td>
							<?php foreach($payment_list as $k=>$v):?>
							<label for="<?php echo $k ?>" class="fl mar10" style="width:145px;height:45px;line-height:45px;padding-left:10px;border:1px solid #eaeaea;background:#f8f8f8;border-radius:3px">
								<input type="radio" class="fl mar10 mat15" name="order_payment" id="<?php echo $k ?>" value="<?php echo $k ?>" />
								<span class="fl"><img src="<?php echo $pe['host_root'] ?>public/plugin/payment/<?php echo $k ?>/logo.png" class="mat8" /></span>
								<div class="clear"></div>
							</label>
							<?php endforeach;?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
							<input type="hidden" name="pesubmit" />
							<input type="button" value="Gửi"  class="tjbtn" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/formcheck.js"></script>
<script type="text/javascript">
	$(function(){
		//支付方式
		$(":input[name='order_payment']:eq(0)").attr("checked", "checked");
		$(":button").click(function(){
			var order_money = pe_num($(":input[name='order_money']").val(), 'floor', 1);
			if (order_money < 0.1) {
				pe_tip('Số tiền nạp tối thiểu là 1 (nhân dân tệ)');
				return false;
			}
			layer.confirm('Xác nhận nạp tiền？', {shade: [0.6, '#000']}, function(index) {
				layer.close(index);
				$.ajaxSettings.async = false;
				pe_submit("<?php echo pe_nowurl() ?>", function(json){
					if (json.result) {
						$("#form").attr("action", json.url).submit();
					}
				})
			})
		})
	})
</script>
<?php include(pe_tpl('footer.html'));?>