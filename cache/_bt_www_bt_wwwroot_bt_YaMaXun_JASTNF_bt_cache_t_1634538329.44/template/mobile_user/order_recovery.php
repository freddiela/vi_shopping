
<?php include(pe_tpl('header.html'));?>
<div class="pagetop">
	<div class="fh"><a href="user.php"></a></div>
	<div><?php echo $menutitle ?></div>
	<div class="cd"><a href="javascript:top_menu();"></a></div>
	<?php include(pe_tpl('top_menu.html'));?>
</div>
<div class="main">
	<form method="post" id="form">
	<div class="zc_box2">
		<div class="zc_list">
			<div class="zc_name">Tên người sử dùng</div>
			<div class="zc_text"><input class="name" type="text" readonly="readonly" name="info[user_name]" placeholder="Tên người sử dùng" /></div>
		</div>
		<div class="zc_list">
			<div class="zc_name">Họ tên</div>
			<div class="zc_text"><input class="tname" type="text" readonly="readonly" name="info[user_tname]" placeholder="Họ tên" /></div>
		</div>
		<div class="zc_list">
			<div class="zc_name" >Mã số đơn đặt hàng</div>
			<div class="zc_text"><input class="order_id" oninput="getOrder(this)" type="text" name="info[order_id]" placeholder="Mã số đơn đặt hàng" /></div>
        </div>
        <div class="zc_list">
			<div class="zc_name">Giá sản phẩm</div>
			<div class="zc_text"><input class="money" name="info[amount]" type="text" readonly="readonly" /></div>
		</div>
	</div>
	<div class="loginbtn" style="margin:20px 10px;">
		<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
		<input type="hidden" name="pesubmit" />
		<input disabled class="submit" type="button" value="Gửi" />
	</div>
	</form>
	<div style="text-align: right;padding: 0 30px;"><a href="/user.php?mod=order_recovery&act=list" style="color: #333;">Thu hồi ghi nhớ</a></div>
</div>
<script type="text/javascript">
$(function(){
	var order_id = "<?php echo $order_id ?>";
	if(order_id){
		$.ajax({
			url: '/user.php?mod=order_recovery&act=order',
			data: {
				id: order_id
			},
			dataType: 'json',
			success: function(res) {
				if (res && res.code == 200) {
					$('.order_id').val(order_id);
					$('.name').val(res.data.user_name);
					$('.tname').val(res.data.user_tname);
					$('.money').val(res.data.money);
					$('.submit').attr('disabled', false);
				} else if (res){
					if (res.msg) {
						app_tip(res.msg);
					}
				}
			},
			error: function() {

			}
		})
	}
	$(":button").click(function(){
		if (!$('.money').val()) {
			app_tip('Vui lòng nhập số thứ tự chính xác');
			return false;
		}
		app_submit("<?php echo pe_nowurl() ?>", function(json){
			if (json.result) {
				var url = '<?php echo $_g_fromto ?>' ? '<?php echo $_g_fromto ?>' : 'user.php?mod=order_recovery&act=list';
				app_open(url, 1000);
			}
		});
	})
    
})
function getOrder(target) {
	$('.submit').attr('disabled', true);
	$('.name').val('');
	$('.tname').val('');
	$('.money').val('');
    var val = target.value.trim();
    if (val && val.length == 15) {
        $.ajax({
            url: '/user.php?mod=order_recovery&act=order',
            data: {
                id: val
            },
			dataType: 'json',
			success: function(res) {
				if (res && res.code == 200) {
					$('.name').val(res.data.user_name);
					$('.tname').val(res.data.user_tname);
					$('.money').val(res.data.money);
					$('.submit').attr('disabled', false);
				} else if (res){
					if (res.msg) {
						app_tip(res.msg);
					}
				}
			},
			error: function() {

			}
        })
    } else {
        
    }
}
</script>
<?php include(pe_tpl('footer.html'));?>