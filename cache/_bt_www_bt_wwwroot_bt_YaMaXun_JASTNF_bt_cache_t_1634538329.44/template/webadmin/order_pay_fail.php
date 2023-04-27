<?php include(pe_tpl('header_dialog.html','admin'));?>
<form id="order_pay_confirm_form" method="post" action="/admin/webadmin.php?mod=order_pay&act=fail_recharge" enctype="multipart/form-data">
    <table class="wenzhang">
        <tbody>
            <tr>
                <td align="right" width="100">失败原因：</td>
                <td>
                    <input type="text" name="info[reason]"  class="inputtext input300" />
                </td>
            </tr>
        </tbody>
    </table>
    <div class="center mat20 mab10">
		<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
        <input type="hidden" name="pesubmit" />
        <input type="hidden" name="info[order_id]" value="<?php echo $order_id ?>"/>
		<input type="button" value="提 交" class="tjbtn submit" />	
	</div>
</form>
<script>
    $('.submit').on('click', function() {
        $('#order_pay_confirm_form').submit();
    })
</script>