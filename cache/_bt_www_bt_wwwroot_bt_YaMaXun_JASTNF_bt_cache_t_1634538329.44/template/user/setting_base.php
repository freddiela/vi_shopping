<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
		<div class="hy_tt"><a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a></div>
		<div class="hy_table">
			<form method="post" id="form">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="text-align:right;" width="150">Tên người sử dùng：</td>
						<td><?php echo $info['user_name'] ?></td>
					</tr>
					<tr>
						<td style="text-align:right;">Cấp bậc hội viên：</td>
						<td><span class="dj_btn"><?php echo $cache_userlevel[$info['userlevel_id']]['userlevel_name'] ?></span></td>
					</tr>
					<tr>
						<td style="text-align:right;">Họ tên thật：</td>
						<td>
							<?php if($info['user_tname']):?>
							<?php echo $info['user_tname'] ?>
							<?php else:?>
							<input type="text" name="user_tname" value="<?php echo $info['user_tname'] ?>" class="inputall input200" />
							<?php endif;?>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Số điện thoại：</td>
						<td><input type="text" name="user_phone" value="<?php echo $info['user_phone'] ?>" class="inputall input200" /></td>
					</tr>
					<tr>
						<td style="text-align:right;">Hộp thư：</td>
						<td><input type="text" name="user_email" value="<?php echo $info['user_email'] ?>" class="inputall input200" /></td>
					</tr>
					<tr>
						<td style="text-align:right;">Ngày đăng ký：</td>
						<td><?php echo pe_date($info['user_atime']) ?></td>
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
<script type="text/javascript">
	$(function(){
		$(":button").click(function(){
			if ($('[name="user_tname"]').length) {
				layer.confirm('Dụng tên thật nếu gửi sẽ không thể sửa đổi, vui lòng xác nhận!', {shade: [0.6, '#000']}, function(index) {
					layer.close(index);
					pe_submit("user.php?mod=setting&act=base", function(res) {
						if (res.result == true) {
							window.location.reload();
						}
					});
				});
			} else {
				pe_submit("user.php?mod=setting&act=base", function(res) {
					if (res.result == true) {
						window.location.reload();
					}
				});
			}
		})
	})
</script>
<?php include(pe_tpl('footer.html'));?>