<?php include(pe_tpl('header.html'));?>
<style>
    .side_fh1 {
        background: #fff;
        height: auto;
        font-family: "微软雅黑";
        padding: 0 0 0 10px;
        border: 0px;
        text-align: center;
    }
</style>
<div class="pagetop">
    <div class="fh"><a href="user.php"></a></div>
    <div><?php echo $menutitle ?></div>
    <div class="cd"><a href="javascript:top_menu();"></a></div>
    <?php include(pe_tpl('top_menu.html'));?>
</div>
<div style="height: 100%;width: 100%;background-color: #f3f3f3;">
    <div style="background-color: rgb(245, 116, 65);height: 200px;width: 100%;">

    </div>
    <div
        style="margin: 15px;background-color: white;height: 290px;border-radius: 5px;position: relative;top: -200px;text-align: center;">
        <div style="padding-top: 40px;color: #868383;">
            总金额(元)
        </div>
        <div style="padding-top: 10px;font-size: 30px;font-weight: 600;">
            <?php echo $user_info['deposit_all']['allMoney'] > 0 ?$user_info['deposit_all']['allMoney']:'0.00' ?>
        </div>
        <div class="side_fh1">
            <a style="width: 50%;" href="#">昨日收益（元）<span>
                    <?php echo $user_info['deposit_yesterday']['allAddMoney'] *1
                    > 0 ? $user_info['deposit_yesterday']['allAddMoney'] : '0.00' ?> </span></a>
            <a style="width: 50%;" href="#">累计收益（元）<span> <?php echo $user_info['deposit_add']['allAddMoney'] *1
                    > 0 ? $user_info['deposit_add']['allAddMoney'] : '0.00' ?> </span></a>
        </div>
        <div class="side_fh1" style="padding:0 20px">
            <a style="width: 50%;" href="user.php?mod=money_deposit&act=out"><span
                    style="padding: 10px 20px;background-color: rgb(248, 210, 195);border-radius: 5px;width: 70%;color: rgb(245, 116, 65);">转出</span></a>
            <a style="width: 50%;" href="user.php?mod=money_deposit&act=in"><span
                    style="padding: 10px 20px;background-color: rgb(245, 116, 65);border-radius: 5px;width: 70%;color: #fff;">转入</span></a>
        </div>
        <div class="main" style="margin-top: 190px;text-align: left;">
            <div class="tx_tt" style="border-top-left-radius: 5px;border-top-right-radius: 5px;"><i></i>余额记录</div>
            <?php if(!count($info_list)):?>
            <div class="nodata">
                <div class="nodata_img"></div>
                <div class="nodata_tip">暂无信息</div>
            </div>
            <?php endif;?>
            <div class="jf_box" style="margin-top:0;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                <?php foreach($info_list as $k=>$v):?>
                <div class="jf_list">
                    <div class="jifen_l">
                        <p><?php echo $v['deposit_cycle'] ?><?php echo $v['deposit_type'] == 'hours'? '小时':
                            ($v['deposit_type'] == 'day' ? '天':'年') ?> + <?php echo $v['deposit_rate'] *100 ?>%</p>
                        <span class="c888"><?php echo $v['mdl_datetime'] ?></span>
                    </div>
                    <div class="jifen_r" style="width: 130px;">
                       <span style="margin-right: 10px;"> <?php echo $v['mdl_add_money'] ?></span>
                        <?php if($v['type'] == 1):?>
                       <span style="color: #ea0813"> 转进</span>
                        <?php elseif($v['mdl_add_money'] > 0):?>
                       <span style="color: #ea0813"> 收益</span>
                        <?php else:?>
                       <span style="color: #1fde6b"> 转出</span>
                        <?php endif;?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>

</div>

<?php include(pe_tpl('footer.html'));?>