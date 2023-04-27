<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=user" <?php if(!$_g_userlevel_id):?>class="sel"
			<?php endif;?>>会员列表（<?php echo $tongji['all'] ?>）<i></i>
		</a>
		<?php foreach($cache_userlevel as $k=>$v):?>
		<a href="webadmin.php?mod=user&userlevel_id=<?php echo $k ?>" <?php if($_g_userlevel_id==$k):?>class="sel"
			<?php endif;?>><?php echo $v['userlevel_name'] ?>（<?php echo $tongji[$k] ?>）<i></i>
		</a>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="userlevel_id" value="<?php echo $_g_userlevel_id ?>" />
				用户名：<input type="text" name="name" value="<?php echo $_g_name ?>" class="inputtext input100 mar5" />
				手机号码：<input type="text" name="phone" value="<?php echo $_g_phone ?>" class="inputtext input100 mar5" />
				电子邮箱：<input type="text" name="email" value="<?php echo $_g_email ?>" class="inputtext input150" />
				<select name="orderby" class="selectmini">
					<option value="" href="<?php echo pe_updateurl('orderby', '') ?>">= 默认排序 =</option>
					<?php $selnum=1;?>
					<?php foreach(array('ltime|desc'=>'最近登录', 'point|desc'=>'最多积分', 'ordernum|desc'=>'最多订单') as $k=>$v):?>
					<option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>
						selected="selected"
						<?php endif;?>><?php echo $selnum++ ?>)<?php echo $v ?>
					</option>
					<?php endforeach;?>
				</select>
				<input type="submit" value="搜索" class="input_btn" />
			</form>
		</div>
		<form method="post" id="form">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
				<tr>
					<th class="bgtt" width="20"><input type="checkbox" name="checkall"
							onclick="pe_checkall(this, 'user_id')" /></th>
					<th class="bgtt" width="50">ID号</th>
					<th class="bgtt">用户名</th>
					<th class="bgtt">用户姓名</th>
					<th class="bgtt" width="100">等级</td>
					<th class="bgtt">上级</th>
					<th class="bgtt" width="70">余额</td>
					<th class="bgtt" width="70">冻结余额</td>
					<th class="bgtt" width="70">积分</th>
					<th class="bgtt" width="70">订单数</td>
					<th class="bgtt" width="80">手机号码</th>
					<!--<th class="bgtt" width="160">常用邮箱</th>-->
					<th class="bgtt" width="70">注册日期</th>
					<th class="bgtt" width="80">银行卡</th>
					<th class="bgtt">在线状态</th>
					<th class="bgtt">请求地址</th>
					<th class="bgtt" width="380">操作</th>
				</tr>
				<?php foreach($info_list as $v):?>
				<tr>
					<td><input type="checkbox" name="user_id[]" value="<?php echo $v['user_id'] ?>"></td>
					<td class="num"><?php echo $v['user_id'] ?></td>
					<td><?php echo $v['user_name'] ?></td>
					<td><?php echo $v['user_tname'] ?></td>
					<td><?php echo $cache_userlevel[$v['userlevel_id']]['userlevel_name'] ?></td>
					<td><?php echo $v['tguser_name'] ?></td>
					<td><span class="num corg"><?php echo $v['user_money'] ?></span></td>
					<td><span class="num corg"><?php echo $v['user_money_frozen'] ?></span></td>
					<td class="num"><?php echo $v['user_point'] ?></td>
					<td class="num"><a href="webadmin.php?mod=order&user_id=<?php echo $v['user_id'] ?>" class="cblue"
							target="_blank"><?php echo $v['user_ordernum'] ?></a></td>
					<td class="num"><?php echo $v['user_phone'] ?></td>
					<!--<td class="num"><?php echo $v['user_email'] ?></td>-->
					<td class="num"><?php echo pe_date_color(pe_date($v['user_atime'], 'Y-m-d')) ?></span></td>
					<td class="num">
						<a href="webadmin.php?mod=userbank&act=edit_banknum&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>"
							class="admin_primary" data-userid="<?php echo $v['user_id'] ?>"
							onclick="return pe_dialog(this, '银行卡信息【会员ID: <?php echo $v['user_id'] ?>】', 600, 300, 'edit')">详情</a>
					</td>
					<td class="num">
						<!-- 一分钟以内有操作自在线 -->
						<?php
					if ($v['user_operation_time'] + 1*60 > time()) {
						echo '<span class="cgreen">在线</span>';
						} else {
						echo '不在线';
						}
						?>
					</td>
					<td class="num"><?php echo $v['user_from'] ?></td>
					<td>
						<?php if($v['agent']==0):?>
						<a style="width: 60px;"
							href="webadmin.php?mod=user&act=agent_edit&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>&agent=1"
							class="admin_del mar3" onclick="return pe_cfone(this, '升为代理')">升为代理</a>
						<?php else:?>
						<a style="width: 60px;"
							href="webadmin.php?mod=user&act=agent_edit&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>&agent=0"
							class="admin_del mar3" onclick="return pe_cfone(this, '取消代理')">取消代理</a>
						<?php endif;?>
						<a href="webadmin.php?mod=user&act=cart&id=<?php echo $v['user_id'] ?>" class="admin_edit mar3">购物车</a>
						<a href="webadmin.php?mod=user&act=edit&id=<?php echo $v['user_id'] ?>&<?php echo pe_fromto() ?>"
							class="admin_edit mar3">修改</a>
						<a href="webadmin.php?mod=user&act=del&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>"
							class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
						<!-- <a href="webadmin.php?mod=user&act=login&id=<?php echo $v['user_id'] ?>&token=<?php echo $pe_token ?>" class="admin_btn mar3" target="_blank">登录</a> -->
						<?php if($v['user_status']==0):?>
						<a data-userid="<?php echo $v['user_id'] ?>" onclick="freeze(this)" class="admin_del"
							href="javascript:void(0);">冻结</a>
						<?php else:?>
						<a data-userid="<?php echo $v['user_id'] ?>" onclick="active(this)" class="admin_edit"
							href="javascript:void(0);">激活</a>
						<?php endif;?>
						<a data-userid="<?php echo $v['user_id'] ?>" onclick="frozen(this)" style="width: 60px;" class="admin_del"
							href="javascript:void(0);">冻结余额</a>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fl mal10">
			<input type="checkbox" name="checkall" onclick="pe_checkall(this, 'user_id')" />
			<button href="webadmin.php?mod=user&act=del&token=<?php echo $pe_token ?>"
				onclick="return pe_cfall(this, 'user_id', 'form', '批量删除')">批量删除</button>
			<input type="button" value="批量发送信息" id="sendMsg" />
			<input id="pe_token" type="hidden" value="<?php echo $pe_token ?>" />
		</span>
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		/*var ips = new Array();
		$(".ipname").each(function(){
			ips.push($(this).attr("ip"));
		})
		$.getJSON("http://www.phpshe.com/index.php?mod=api&act=ipname&ips="+ips.join(",")+"&callback=?", function(json){
			$(".ipname").each(function(index){
				$(this).find("a").html(json.ipname[index]);
			})
		})*/
		$("#sendMsg").click(function () {
			if ($("input[name='user_id[]']:checked").length == 0) {
				alert('请勾选需要发送的用户!');
				return false;
			}
			var user_id = new Array();
			$("input[name='user_id[]']:checked").each(function () {
				user_id.push($(this).val());
			})
			idArr = user_id.join(",");
			layer.prompt({ title: '输入要发送的信息', formType: 2 }, function (text, index) {
				layer.close(index);
				$.ajax({
					url: 'webadmin.php?mod=user&act=addMsg&id=' + idArr + '&text=' + text,
					dataType: 'json',
					success: function (res) {
						layer.msg(res.show)
					},
					error: function () {
						layer.msg('请求失败，请稍后再试', { icon: 5 });
					}
				})
			});
			/* console.log(url )
			art.dialog.open(url, { title: '发送邮件', width: 730, height: 470, id: 'sendemail' }); */
		})
		$("select").change(function () {
			window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
		})
		$('.view_userbanks').on('click', function (evt) {
			var id = $(this).data('userid');
			$.ajax({
				url: 'webadmin.php?mod=userbank&act=detail&id=' + id,
				dataType: 'json',
				success: function (res) {
					console.log(res)
				},
				error: function () {
					layer.msg('请求失败，请稍后再试', { icon: 5 });
				}
			})
		})
	})
	function freeze(e) {
		layer.confirm('确定冻结该用户？', {
			yes: function () {
				layer.load(1, { shade: [0.6, '#000'] });
				var userid = $(e).data('userid');
				$.ajax({
					url: "webadmin.php?mod=user&act=freeze&id=" + userid + '&token=' + $('#pe_token').val(),
					dataType: 'json',
					success: function (res) {
						location.reload();
					},
					error: function () {
						location.reload();
					}
				})
			}
		})
	}
	function frozen(e) {
		layer.prompt({ title: '输入要冻结的金额', formType: 0 }, function (value, index) {
			layer.load(1, { shade: [0.6, '#000'] });
			var userid = $(e).data('userid');
			$.ajax({
				url: "webadmin.php?mod=user&act=frozen&money=" + value + "&id=" + userid + '&token=' + $('#pe_token').val(),
				dataType: 'json',
				success: function (res) {
					location.reload();
				},
				error: function () {
					location.reload();
				}
			})
		});
	}

	function active(e) {
		layer.confirm('确定激活该用户？', {
			yes: function () {
				layer.load(1, { shade: [0.6, '#000'] });
				var userid = $(e).data('userid');
				$.ajax({
					url: "webadmin.php?mod=user&act=active&id=" + userid + '&token=' + $('#pe_token').val(),
					dataType: 'json',
					success: function (res) {
						location.reload();
					},
					error: function () {
						location.reload();
					}
				})
			}
		})

	}
</script>
<?php include(pe_tpl('footer.html','admin'));?>