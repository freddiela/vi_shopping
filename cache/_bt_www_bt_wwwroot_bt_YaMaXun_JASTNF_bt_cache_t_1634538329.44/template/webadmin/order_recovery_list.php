<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
    <div class="now">
        <a href="webadmin.php?mod=order_recovery" class="sel">回收管理(<?php echo $tongji[0]['all'] ?>)<i></i></a>
        <span style="margin-top: 10px;" class="btn tag_blue batch" data-type="2">批量回收</span>
        <span style="margin-top: 10px;" class="btn tag_red batch" data-type="1">批量拒绝回收</span>
        <div class="clear"></div>
    </div>
    <div class="right_main">
        <div class="search">
            <form method="get">
                <input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
                <input type="hidden" name="state" value="<?php echo $_g_state ?>" />
                <select name="orderby" class="selectmini">
                    <option value="" href="<?php echo pe_updateurl('orderby', '') ?>">默认排序</option>
                    <?php foreach($orderby_arr as $k=>$v):?>
                    <option value="<?php echo $k ?>" href="<?php echo pe_updateurl('orderby', $k) ?>" <?php if($_g_orderby==$k):?>
                        selected="selected"
                        <?php endif;?>><?php echo $v ?>
                    </option>
                    <?php endforeach;?>
                </select>
            </form>
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
            <thead>
                <th class="bgtt" style="border-bottom:0;"><input class="checkall" type="checkbox"></th>
                <th class="bgtt" style="border-bottom:0;">编号</th>
                <th class="bgtt" style="border-bottom:0;">用户信息</th>
                <th class="bgtt" style="border-bottom:0;">姓名</th>
                <th class="bgtt" style="border-bottom:0;">用户名</th>
                <th class="bgtt" style="border-bottom:0;">回收价格</th>
                <th class="bgtt" style="border-bottom:0;">订单编号</th>
                <th class="bgtt" style="border-bottom:0;">审核状态</th>
                <th class="bgtt" style="border-bottom:0;">回收失败原因</th>
                <th class="bgtt" style="border-bottom:0;" width="240">操作</th>
            </thead>
            <tbody class="list-items">
                <?php foreach($info_list as $k=>$v):?>
                <tr>
                    <td style="background-color: rgb(255, 255, 255);">
                        <?php if($v['status']==0):?>
                        <input data-amount="<?php echo $v['amount'] ?>" data-userid="<?php echo $v['user_id'] ?>" data-roid="<?php echo $v['id'] ?>"
                            class="checkitem" type="checkbox">
                        <?php endif;?>
                    </td>
                    <td data-value="<?php echo $v['id'] ?>" style="background-color: rgb(255, 255, 255);"><?php echo $v['id'] ?></td>
                    <td data-value="<?php echo $v['user_id'] ?>" style="background-color: rgb(255, 255, 255);">用户ID:<?php echo $v['user_id'] ?>
                    </td>
                    <td data-value="<?php echo $v['user_tname'] ?>" style="background-color: rgb(255, 255, 255);"><?php echo $v['user_tname'] ?>
                    </td>
                    <td data-value="<?php echo $v['user_name'] ?>" style="background-color: rgb(255, 255, 255);"><?php echo $v['user_name'] ?>
                    </td>
                    <td data-value="<?php echo $v['amount'] ?>" style="background-color: rgb(255, 255, 255);"><?php echo $v['amount'] ?></td>
                    <td data-value="<?php echo $v['order_id'] ?>" style="background-color: rgb(255, 255, 255);"><?php echo $v['order_id'] ?>
                    </td>
                    <td data-value="<?php echo $v['status'] ?>" style="background-color: rgb(255, 255, 255);">
                        <?php if($v['status']==0):?>
                        <span class="cblue">待审核</span>
                        <?php elseif($v['status']==2):?>
                        <span class="cgreen">回收成功</span>
                        <?php else:?>
                        <span class="cred">回收失败</span>
                        <?php endif;?>
                    </td>
                    <td><?php echo $v['reason'] ?></td>
                    <td style="background-color: rgb(255, 255, 255); text-align: right;">
                        <?php if($v['status']==0):?>
                        <a class="btn tag_green mar5" onclick="confirmSuccess(<?php echo $v['id'] ?>)">审核通过</a>
                        <a class="btn tag_org mar5" onclick="confirmFailed(<?php echo $v['id'] ?>)">审核失败</a>
                        <a class="btn tag_blue mar5" onclick="edit(<?php echo $k ?>)">编辑</a>
                        <a class="btn tag_org" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <input type="hidden" class="pe_token" value="<?php echo $pe_token ?>" />
    </div>
    <div class="right_bottom">
        <span class="fr fenye"><?php echo $db->page->html ?></span>
        <div class="clear"></div>
    </div>
</div>
<script type="text/html" id="huishou_xiugai_html">
    <form method="post" class="order_recovery_edit">
        <div class="content">
            <table>
                <tr>
                    <td align="right">用户名：</td>
                    <td><input type="text" name="info[user_name]" value="" class="inputall input250 ename" placeholder="用户名" /></td>
                </tr>
                <tr>
                    <td align="right">姓名：</td>
                    <td><input type="text" name="info[user_tname]" value="" class="inputall input250 etname" placeholder="姓名" /></td>
                </tr>
                <tr>
                    <td align="right">商品订单号：</td>
                    <td><input readonly="readonly" type="text" name="info[order_id]" value="" class="inputall input250 eorderid" placeholder="商品订单号" /></td>
                </tr>
                <tr>
                    <td align="right">商品价格：</td>
                    <td><input type="text" name="info[amount]" value="" class="inputall input250 eamount" placeholder="商品价格" /></td>
                </tr>
            </table>
        </div>
        <div style="text-align:center">
            <div class="quan_dh" style="margin-top:0;">
                <input type="hidden" name="pesubmit" />
                <input type="hidden" name="info[id]" class="recoveryid" />
                <input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
                <input class="submit_edit tjbtn" type="button" value="提交" />
            </div>
        </div>
    </form>
</script>
<script type="text/html" id="order_confirm_failed_templ">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang">
        <tbody>
            <tr>
                <td colspan="2" align="center">确认拒绝回收？</td>
            </tr>
            <tr>
                <td align="right">失败原因:</td>
                <td><input class="inputtext input300 fail-reason" /></td>
            </tr>
        </tbody>
    </table>
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.checkall', function (e) {
            if ($(this).prop('checked')) {
                $('.checkitem').attr('checked', true);
            } else {
                $('.checkitem').attr('checked', false);
            }
        })
        // 批量回收
        $(document).on('click', '.batch', function (e) {
            if (!$('.checkitem:checked').length) {
                pe_tip('未选中订单');
                return;
            }
            var type = $(this).data('type');
            var msg = type == 2 ? '确认批量回收' : '确认批量拒绝回收';
            if (type == 2) {
                layer.confirm('确认批量回收', { shade: [0.6, '#000'] }, function (index) {
                    layer.close(index);
                    layer.load(1, { shade: [0.6, '#000'] });
                    batchSendRequest(type, null);
                })
            } else {
                layer.open({
                    type: 1,
                    id: 'confirm_failed',
                    shadeClose: true,
                    content: $('#order_confirm_failed_templ').html(),
                    area: ['500px', '250px'],
                    btn: ['确定', '取消'],
                    yes: function (index, layero) {
                        if ($('#confirm_failed .fail-reason').val().trim() == '') {
                            pe_tip('请输入拒绝原因');
                            return;
                        }
                        layer.close(index);
                        layer.load(1, { shade: [0.6, '#000'] });
                        batchSendRequest(type, $('#confirm_failed .fail-reason').val().trim());
                    }
                })
            }

        })
        // 编辑提交
        $(document).on('click', '.submit_edit', function () {
            if (isNaN(Number($('.eamount').val()))) {
                pe_tip('请填写正确的金额');
                return;
            }
            layer.load(1, { shade: [0.6, '#000'] });
            $.ajax({
                url: '/admin/webadmin.php?mod=order_recovery&act=edit',
                type: 'post',
                data: $('.order_recovery_edit').serialize(),
                success: function (res) {
                    document.location.reload();
                },
                error: function () {
                    document.location.reload();
                }
            })
            console.log();
        })
    })
    function confirmSuccess(id) {
        layer.confirm('确认回收？', { shadeClose: true }, function (index) {
            layer.close(index);
            layer.load(1, { shade: [0.6, '#000'] });
            $.ajax({
                url: '/admin/webadmin.php?mod=order_recovery&act=auditsuccess',
                type: 'POST',
                data: {
                    id: id,
                    pe_token: $('.pe_token').val()
                },
                dataType: 'json',
                success: function (res) {
                    document.location.reload();
                },
                error: function () {
                    document.location.reload();
                }
            })
        });
    }
    function del(id) {
        layer.confirm('确认删除？', { shadeClose: true }, function (index) {
            layer.close(index);
            layer.load(1, { shade: [0.6, '#000'] });
            $.ajax({
                url: '/admin/webadmin.php?mod=order_recovery&act=del',
                type: 'POST',
                data: {
                    id: id,
                    pe_token: $('.pe_token').val()
                },
                dataType: 'json',
                success: function (res) {
                    document.location.reload();
                },
                error: function () {
                    document.location.reload();
                }
            })
        });
    }
    function confirmFailed(id) {
        open
        layer.open({
            type: 1,
            id: 'confirm_failed',
            shadeClose: true,
            content: $('#order_confirm_failed_templ').html(),
            area: ['500px', '250px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
                if ($('#confirm_failed .fail-reason').val().trim() == '') {
                    pe_tip('请输入拒绝原因');
                    return;
                }
                layer.close(index);
                layer.load(1, { shade: [0.6, '#000'] });
                $.ajax({
                    url: '/admin/webadmin.php?mod=order_recovery&act=auditfailed',
                    type: 'POST',
                    data: {
                        id: id,
                        reason: $('#confirm_failed .fail-reason').val().trim(),
                        pe_token: $('.pe_token').val()
                    },
                    dataType: 'json',
                    success: function (res) {
                        document.location.reload();
                    },
                    error: function () {
                        document.location.reload();
                    }
                })
            }
        });
    }
    function edit(idx) {
        layer.open({
            type: 1,
            title: '编辑',
            area: ['500px', '380px'],
            fixed: false,
            shadeClose: true,
            shade: 0.5,
            content: $("#huishou_xiugai_html").html()
        })
        var status = $('.list-items tr').eq(idx).find('td').eq(7).data('value');
        $('.ename').val($('.list-items tr').eq(idx).find('td').eq(4).data('value'));
        $('.etname').val($('.list-items tr').eq(idx).find('td').eq(3).data('value'));
        $('.eorderid').val($('.list-items tr').eq(idx).find('td').eq(6).data('value'));
        $('.eamount').val($('.list-items tr').eq(idx).find('td').eq(5).data('value'));
        $('.recoveryid').val($('.list-items tr').eq(idx).find('td').eq(1).data('value'))
        if (status != 0) {
            $('.eamount').attr('readonly', 'readonly');
        }
    }
    function batchSendRequest(type, reason) {
        var items = [];
        $('.checkitem:checked').each(function (idx, item) {
            items.push({
                id: $(item).data('roid'),
                userid: $(item).data('userid'),
                amount: $(item).data('amount')
            });
        })
        $.ajax({
            url: '/admin/webadmin.php?mod=order_recovery&act=batchhandler',
            type: 'post',
            dataType: 'json',
            data: {
                items: items,
                type: type,
                reason: reason,
                pe_token: $('.pe_token').val()
            },
            success: function (res) {
                document.location.reload();
            },
            error: function () {
                document.location.reload();
            }
        })
    }
    $(function () {
        $("select").change(function () {
            window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
        })
    })
</script>
<?php include(pe_tpl('footer.html','admin'));?>