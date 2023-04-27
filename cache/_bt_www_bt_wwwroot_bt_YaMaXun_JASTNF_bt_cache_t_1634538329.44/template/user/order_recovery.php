<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
    <?php include(pe_tpl('user_menu.html'));?>
    <div class="fr huiyuan_main">
        <div class="hy_tt">
            <a href="<?php echo $pe['host_root'] ?>user.php?mod=order_recovery" <?php if(!$_g_state):?>class="sel"<?php endif;?>>Thu hồi ghi nhớ<span>(<?php echo $tongji['huishou'] ?>)</span><i></i></a>
            <a href="<?php echo $pe['host_root'] ?>user.php?mod=order_recovery&state=order" <?php if($_g_state == 'order'):?>class="sel"<?php endif;?>>Đơn hàng có thể thu hồi<i></i></a>
            <a href="javascript:duihuan_open();" class="fabu_btn">Đăng ký thu hồi</a>
        </div>
        <div class="hy_tablelist">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
                <th width="130">Mã số đơn đặt hàng</th>
                <th width="150">Họ tên</th>
                <th width="150">Tên người sử dùng</th>
				<th width="150">Thu hồi giá  (việt nam đồng)</th>
                <th width="150">Trạng thái thu hồi</th>
                <th width="200">Lý do thất bại</th>
			</tr>
			<?php foreach($info_list as $v):?>
			<tr>
				<td><?php echo $v['order_id'] ?></td>
				<td><?php echo $v['user_tname'] ?></td>
				<td><?php echo $v['user_name'] ?></td>
                <td><?php echo $v['amount'] ?></td>
                <td>
                    <?php if($v['status'] == 0):?>
                    <span class="cblue">Đang chờ xem xét</span>
                    <?php elseif($v['status'] == 2):?>
                    <span class="cgreen">Thành công thu hồi</span>
                    <?php else:?>
                    <span class="cred1">Thu hồi thất bại</span>
                    <?php endif;?>
                </td>
                <td><?php echo $v['reason'] ?></td>
			</tr>
			<?php endforeach;?>
			</table>
        </div>
        <div class="fenye mat10"><?php echo $db->page->html ?></div>
    </div>
</div>
<?php include(pe_tpl('footer.html'));?>
<script type="text/html" id="huishou_tianjia_html">
<form method="post" id="form" class="order_recovery_add">
    <div class="content">
        <table>
            <tr>
                <td align="right">Tên người sử dùng：</td>
                <td><input readonly="readonly" type="text" name="info[user_name]" value="" class="inputall input250 name" placeholder="Tên người sử dùng" /></td>
            </tr>
            <tr>
                <td align="right">Họ tên：</td>
                <td><input readonly="readonly" type="text" name="info[user_tname]" value="" class="inputall input250 tname" placeholder="Họ tên" /></td>
            </tr>
            <tr>
                <td align="right">Mã số đơn đặt hàng：</td>
                <td><input oninput="getOrder(this)" type="text" name="info[order_id]" value="" class="inputall input250 orderid" placeholder="Mã số đơn đặt hàng" /></td>
            </tr>
            <tr>
                <td align="right">Giá sản phẩm：</td>
                <td><input type="text" name="info[amount]" value="" class="inputall input250 amount" placeholder="Giá sản phẩm" /></td>
            </tr>
        </table>
    </div>
    <div style="text-align:center">
        <div class="quan_dh" style="margin-top:0;">
            <input type="hidden" name="pesubmit" />
            <input class="submit" type="button" value="Đăng ký thu hồi" onclick="huishou_btn()" />
        </div>
    </div>
</form>
</script>
<script type="text/javascript">
function duihuan_open() {
	layer.open({
		type: 1,
		title: 'Thu hồi đơn đặt hàng',
		area: ['500px', '350px'],
		fixed: false,
		shadeClose: true,
		shade: 0.5,
		content: $("#huishou_tianjia_html").html()
	});
}
function huishou_btn() {
	pe_submit("user.php?mod=order_recovery&act=add", function(json){
		if (json.result) {
			pe_open('reload', 1000);
		}
	});
}
function getOrder(target) {
	$('.submit').attr('disabled', true);
	$('.name').val('');
	$('.tname').val('');
	$('.amount').val('');
    var val = target.value.trim();
    if (val && val.length == 15) {
        $.ajax({
            url: '/user.php?mod=order_recovery&act=validate',
            data: {
                id: val
            },
			dataType: 'json',
			success: function(res) {
				if (res && res.code == 200) {
					$('.name').val(res.data.user_name);
					$('.tname').val(res.data.user_tname);
					$('.amount').val(res.data.money);
					$('.submit').attr('disabled', false);
				} else if (res){
					if (res.msg) {
						pe_tip(res.msg);
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