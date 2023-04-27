<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php?mod=moneylog"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="content">
	<div class="lb_sx">
		<a href="<?php echo $pe['host_root'] ?>user.php?mod=cashout&act=add" <?php if($act=='add'):?>class="sel"<?php endif;?>>Đăng ký rút tiền</a>
		<a href="<?php echo $pe['host_root'] ?>user.php?mod=cashout" <?php if($act=='index'):?>class="sel"<?php endif;?>>Bản ghi rút tiền</a>
		<div class="lb_xian"></div>
		<div class="clear"></div>
	</div>
	<form method="post" id="form">
		<div class="tx_box"> 
			<div class="tx_wen" onclick="app_alert('một đơn <?php echo $cache_setting['cashout_min'] ?> việt nam đồng có thể rút tiền và mỗi giao dịch khấ trừ <?php echo $cache_setting['cashout_fee']*100 ?>% phí thủ tục')">Rút tiền mặt<i></i></div>
			<div class="tx_input">
				<span>¥</span> <input type="text" name="cashout_money" placeholder="Vui lòng nhập số tiền rút "/>
			</div>
			<div class="mat15 c999">số dư hiện tại： <?php echo $info['user_money'] ?> </div>
		</div>
		<div class="zc_box2 mat10">
			<div class="zc_list">
				<div class="zc_name">Khấu trừ phí thủ tục </div>
				<div class="zc_text"><span class="num" id="cashout_fee">0</span> </div>
			</div>
			<div class="zc_list" style="padding-right:10px;">
				<div class="zc_name">Tài khoản nhận tiền</div>
				<div class="zc_text">
					<select name="userbank_id">
						<?php foreach($userbank_list as $k=>$v):?>
						<option value="<?php echo $v['userbank_id'] ?>"><?php echo $v['userbank_name'] ?> (<?php echo userbank_num($v['userbank_num']) ?>)</option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="zc_list">
				<div class="zc_name">Mật khẩu thanh toán</div>
				<div class="zc_text">
					<input type="password" name="user_paypw" autocomplete="new-password" placeholder="Vui lòng nhập mật khẩu thanh toán" />
				</div>
			</div>
		</div>
		<div class="loginbtn" style="margin:15px;">
			<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
			<input type="hidden" name="pesubmit" />
			<input type="button" value="Gửi" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$(function(){
		if (<?php echo count($userbank_list) ?> == 0) {
			app_alert('Vui lòng thêm tài khoản người nhận tiền trước', function(){
				app_open('user.php?mod=userbank&act=add&fromto=<?php echo urlencode(pe_nowurl()) ?>');
			});
		}
		var user_paypw = "<?php echo $info['user_paypw'] ?>";
		if(user_paypw==""){
			app_alert('Vui lòng cài đặt mật khẩu thanh toán trước', function(){
				app_open('user.php?mod=setting&act=paypw&fromto=<?php echo urlencode(pe_nowurl()) ?>');
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
				app_tip('Vui lòng điền số tiền rút');
				return false;
			}
			if ($("input[name='user_paypw']").val().trim() == '') {
				app_tip('Vui lòng điền mật khẩu thanh toán');
				return false;
			}
			app_submit("user.php?mod=cashout&act=add", function(json){
				if (json.result) {
					app_open("user.php?mod=cashout", 1000);
				}
			})
		})
	})
</script>
<?php include(pe_tpl('footer.html'));?>