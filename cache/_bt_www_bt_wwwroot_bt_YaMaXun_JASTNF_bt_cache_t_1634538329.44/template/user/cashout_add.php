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
			<form method="post" id="form">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="text-align:right;" width="150">Số dư tài khoản：</td>
						<td><span class="corg"><?php echo $info['user_money'] ?> Việt nam đồng</span></td>
					</tr>
					<tr>
						<td style="text-align:right;">Tài khoản nhận tiền：</td>
						<td>
							<select name="userbank_id" class="inputselect">
								<option value="">Vui lòng chọn tài khoản nhận tiền</option>
								<?php foreach($userbank_list as $k=>$v):?>
								<!--<option value="<?php echo $v['userbank_id'] ?>"><?php echo $v['userbank_name'] ?>(<?php echo substr($v['userbank_num'], 0, 4) ?>**** ****<?php echo substr($v['userbank_num'], -4) ?>)</option>-->
								<option value="<?php echo $v['userbank_id'] ?>"><?php echo $v['userbank_name'] ?> (<?php echo userbank_num($v['userbank_num']) ?>)</option>
								<?php endforeach;?>
							</select>
							<span id="userbank_id_show"></span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Rút tiền mặt：</td>
						<td>
							<input type="text" name="cashout_money" class="inputall input100" autocomplete="off" /> Việt nam đồng
							<span id="cashout_money_show" class="mal10"></span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Khấu trừ phí thủ tục：</td>
						<td><span id="cashout_fee">0</span> Việt nam đồng</td>
					</tr>
					<tr>
						<td style="text-align:right;">Mật khẩu thanh toán：</td>
						<td>
							<input type="password" name="user_paypw" class="inputall input150" autocomplete="new-password" />
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
			<div class="tixing c888" style="margin-top:70px"><p class="cred mab10">Nhắc nhở：</p>một đơn<?php echo $cache_setting['cashout_min'] ?>việt nam đồng có thể rút tiền và mỗi giao dịch khấ trừ <?php echo $cache_setting['cashout_fee']*100 ?>% phí thủ tục</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(function(){
		if (<?php echo count($userbank_list) ?> == 0) {
			pe_alert('Vui lòng thêm tài khoản người nhận tiền trước', function(){
				pe_open('user.php?mod=userbank&act=add&fromto=<?php echo urlencode(pe_nowurl()) ?>');
			});
		}
		var user_paypw = "<?php echo $info['user_paypw'] ?>";
		if(user_paypw==""){
			pe_alert('Vui lòng cài đặt mật khẩu thanh toán trước', function(){
				pe_open('user.php?mod=setting&act=paypw&fromto=<?php echo urlencode(pe_nowurl()) ?>');
			});
		}
		$(":input[name='cashout_money']").bind('keyup blur', function(){
			var cashout_money = pe_num($(this).val(), 'round', 1);
			var cashout_fee = pe_num(cashout_money * <?php echo $cache_setting['cashout_fee'] ?>, 'round', 1);
			$("#cashout_fee").html(cashout_fee);
		})
		$(":button").click(function(){
			var cashout_money = pe_num($(":input[name='cashout_money']").val(), 'float', 1);
			if (cashout_money <= 0) {
				pe_tip('Vui lòng điền số tiền rút');
				return false;
			}
			if ($("input[name='user_paypw']").val().trim() == '') {
				pe_tip('Vui lòng điền mật khẩu thanh toán');
				return false;
			}
			pe_submit("user.php?mod=cashout&act=add", function(json){
				if (json.result) {
					pe_open("user.php?mod=cashout", 1000);
				}
			})
		})
	})
</script>
<?php include(pe_tpl('footer.html'));?>