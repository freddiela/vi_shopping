<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
    <div class="now">
        <a href="javascript:;" class="sel"><?php echo $menutitle ?><i></i></a>
        <div class="clear"></div>
    </div>
    <div class="right_main">
        <form method="post" id="form">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="wenzhang mat20 mab20">
                <tr>
                    <td align="right" width="150">周期数：</td>
                    <td><input type="text" name="info[deposit_cycle]" value="<?php echo $info['deposit_cycle'] ?>"
                            class="inputall input200" /></td>
                </tr>
                <tr>
                    <td align="right">周期单位：</td>
                    <td>
                        <label class="mar30"><input type="radio" name="info[deposit_type]" value="hours" <?php if('hours'==$info['deposit_type']):?>checked="checked"<?php endif;?> /> 小时</label>
                        <label class="mar30"><input type="radio" name="info[deposit_type]" value="day" <?php if('day'==$info['deposit_type']):?>checked="checked"<?php endif;?> /> 天</label>
                    </td>
                </tr>                
                <tr>
                    <td align="right" width="150">限制转出周期：</td>
                    <td><input type="text" name="info[deposit_cle]" value="<?php echo $info['deposit_cle'] ?>"
                            class="inputall input200" /></td>
                </tr>
                <tr>
                    <td align="right">周期单位：</td>
                    <td>
                        <label class="mar30"><input type="radio" name="info[deposit_name]" value="hours" <?php if('hours'==$info['deposit_name']):?>checked="checked"<?php endif;?> /> 小时</label>
                        <label class="mar30"><input type="radio" name="info[deposit_name]" value="day" <?php if('day'==$info['deposit_name']):?>checked="checked"<?php endif;?> /> 天</label>
                    </td>
                </tr>
                <tr>
                    <td align="right">利率：</td>
                    <td><input type="text" name="info[deposit_rate]" value="<?php echo $info['deposit_rate']*100 ?>"
                            class="inputall input100" /> % <span class="cbbb">（打9折，请填90%）</span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
                        <input type="submit" name="pesubmit" value="提 交" class="tjbtn" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
   
</script>
<?php include(pe_tpl('footer.html','admin'));?>