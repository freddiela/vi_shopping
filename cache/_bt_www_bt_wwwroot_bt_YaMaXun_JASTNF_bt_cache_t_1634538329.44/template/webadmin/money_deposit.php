<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
    <div class="now">
        <a href="webadmin.php?mod=money_deposit" class="sel"><?php echo $menutitle ?><i></i></a>
        <a href="webadmin.php?mod=money_deposit&act=add" id="fabu">添加规则</a>
        <div class="clear"></div>
    </div>
    <div class="right_main">
        <form method="post" id="form">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                <tr>
                    <th class="bgtt" width="130">周期</th>
                    <th class="bgtt" width="130">体现周期</th>
                    <th class="bgtt" width="130">利息周期</th>
                    <th class="bgtt" width="130">提现周期</th>
                    <th class="bgtt" width="150">利率</th>
                    <th class="bgtt">操作</th>
                </tr>
                <?php foreach($info_list as $v):?>
                <tr>
                    <td class="num"><?php echo $v['deposit_cycle'] ?></span></td>
                    <td class="num"><?php echo $v['deposit_cle'] ?></span></td>
                    <td><?php echo $v['deposit_type'] == 'hours'? '小时': ($v['deposit_type'] == 'day' ? '天':'年') ?></td>
                    <td><?php echo $v['deposit_name'] == 'hours'? '小时': ($v['deposit_type'] == 'day' ? '天':'年') ?></td>
                    <td><?php echo $v['deposit_rate'] * 100 ?>%</td>
                    <td><a href="webadmin.php?mod=money_deposit&act=edit&id=<?php echo $v['deposit_id'] ?>"
                            class="admin_edit mar3">修改</a>
                        <a href="webadmin.php?mod=money_deposit&act=del&id=<?php echo $v['deposit_id'] ?>&token=<?php echo $pe_token ?>"
                            class="admin_del mar3" onclick="return pe_cfone(this, '删除')">删除</a>
                    </td>

                </tr>
                <?php endforeach;?>
            </table>
        </form>
    </div>
    <div class="right_bottom">
        <span class="fr fenye"><?php echo $db->page->html ?></span>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("select").change(function () {
            window.location.href = 'webadmin.php' + $(this).find("option:selected").attr("href");
        })
    })
</script>
<?php include(pe_tpl('footer.html','admin'));?>