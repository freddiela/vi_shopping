<div class="clear"></div>
<div class="width980">
<?php echo ad_show('pc', 'footer') ?>
<?php if($mod=='index'):?><?php echo ad_show('pc', 'index_footer') ?><?php endif;?>
</div>
<div class="celan">
	<a href="<?php echo pe_url('cart') ?>" style="margin-top:90px;">
		<div class="cl_sl js_cartnum"><?php echo user_cartnum() ?></div>
		<div class="ico_gwc"><i></i></div>
		<div class="font14 mat8"  data-i18n-text="购物车2" >购物<br/>车</div>
	</a>
	
	<!-- <a href="javascript:;" style="position:relative" id="qrcode_btn">
		<div class="cl_weixin"><i></i></div>
		<div class="cl_ewm" id="qrcode_show"><img src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>"></div>
	</a>
	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cache_setting['web_qq'] ?>&site=qq&menu=yes" target="_blank">
		<div class="cl_qq"><i></i></div>
	</a> -->
	<a href="<?php echo $cache_setting['online_service'] ?>" style="position:relative">
		<div class="font14 ck_kefu"></div>
	</a>
	<!-- <a href="javascript:;" style="position:relative" id="tel_btn">
		<div class="font14">电话</div>
		<div class="cl_tel" id="tel_show"><?php echo $cache_setting['web_phone'] ?></div>
	</a> -->
	<a href="javascript:right_scrolltop();" class="topback"><i></i></a>
</div>
<div class="foot">
	<div class="foot_sm">
		<ul>
		<li>
			<i class="i_1"></i>
			<h3 data-i18n-text="自营保正品">自营保正品</h3>
			<p data-i18n-text="现货自营 正品保证">现货自营 正品保证</p>
		</li>
		<li>
			<i class="i_2"></i>
			<h3 data-i18n-text="全场免运费">全场免运费</h3>
			<p data-i18n-text="不限品类 满99免邮">不限品类 满99免邮</p>
		</li>
		<li>
			<i class="i_3"></i>
			<h3 data-i18n-text="发货如闪电">发货如闪电</h3>
			<p data-i18n-text="极速发货 航空直达">极速发货 航空直达</p>
		</li>
		<li>
			<i class="i_4"></i>
			<h3 data-i18n-text="退货有保障">退货有保障</h3>
			<p data-i18n-text="开箱验货 30天退换">开箱验货 30天退换</p>
		</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="bottom_link">
		<div class="border_link">
			<?php foreach($cache_class_arr['help'] as $v):?>
			<?php if(++$help_index>5)break;?>
			<?php $info_list = $db->pe_selectall('article', array('class_id'=>$v['class_id']))?>
			<div class="item_1 fl">
				<h3><?php echo $v['class_name'] ?></h3>
				<ul>
					<?php foreach($info_list as $vv):?>
					<li><a href="<?php echo pe_url('article-'.$vv['article_id']) ?>" title="<?php echo $vv['article_name'] ?>"><?php echo $vv['article_name'] ?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endforeach;?>
			<div class="foot_telnum">
				<p><span><?php echo $cache_setting['web_phone'] ?></span></p>
				<span class="font14 cfen" data-i18n-text="周一 至 周五　8:30-18:00">周一 至 周五　8:30-18:00</span>
				<div class="mat10">
				<img class="fl" src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>">
				<div class="x_sm_text" data-i18n-text="扫扫有惊喜"></div>
				<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="subnav">
		Copyright <span class="num">©</span> <?php echo $cache_setting['web_copyright'] ?> All Rights Reserved <?php echo $cache_setting['web_icp'] ?> <?php echo $cache_setting['web_tongji'] ?>&nbsp;
		
	</div>
</div>
<!--<div id="top">
	<div id="izl_rmenu" class="izl-rmenu">
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cache_setting['web_qq'] ?>&site=qq&menu=yes" target="_blank" class="btn btn-qq"></a>
		<div class="btn btn-wx"><img class="pic" src="<?php echo pe_thumb($cache_setting['web_qrcode']) ?>" /></div>
		<div class="btn btn-phone"><div class="phone"><?php echo $cache_setting['web_phone'] ?></div></div>
		<div class="btn btn-top"></div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>kefu/css/style.css">
<script type="text/javascript" src="<?php echo $pe['host_tpl'] ?>kefu/js/index.js"></script>-->
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/jquery.scrollLoading.js"></script>
	<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/js/jquery.i18n.properties-1.0.x.min.js"></script>
<script type="text/javascript">
$(function(){
	$("img.js_imgload").scrollLoading();
	$(".fenlei_li").hover(
		function(){	
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");	
			$(".fenlei_li").removeClass("fenlei_li_sel");
			$(this).find(".fenlei_h3 a").addClass("sel");
			$(this).addClass("fenlei_li_sel");
			$(".fenlei_li").find(".js_right").hide();
			var _top = $(this).index() * 35;
			$(this).find(".js_right").css("top", "-"+_top+"px").show();
		},
		function(){
			$(".fenlei_li").find(".fenlei_h3 a").removeClass("sel");
			$(".fenlei_li").removeClass("fenlei_li_sel");
			$(".fenlei_li").find(".js_right").hide();	
		}
	)
	var hoverTimer;
	$("#menu_nav").hover(function(){
        clearTimeout(hoverTimer);
        $("#menu_html").add(".fenlei_li_more").show();
	}, function(){
        clearTimeout(hoverTimer);
        hoverTimer = setTimeout(function(){
			<?php if($mod!='index'):?>$("#menu_html").hide();<?php endif;?>
			$(".fenlei_li_more").hide();
        }, 100);
	})
	//二维码显示
	$("#qrcode_btn").hover(function(){
        $("#qrcode_show").show();
	}, function(){
        $("#qrcode_show").hide();
	})
	//电话显示
	$("#tel_btn").hover(function(){
        $("#tel_show").show();
	}, function(){
        $("#tel_show").hide();
	})
	
	
	
	    var think_var = 'vi';
        $("#lang_select").val(think_var);
        $("#lang_select").change(function () {
            var value = $(this).val();
            if (getCookie('think_var') != value) {
                think_var = value;
                //setCookie('think_var', value, 30);
                //console.log('getCookie', getCookie('think_var'));
                window.location.href = window.location.origin + window.location.pathname + appendQuerystring('lang', value);
            }
        });

        var language = think_var;
        console.log(think_var);


        $.i18n.properties({
            name: 'strings',    // 属性文件名 命名格式： 文件名_国家代号.properties
            path: '/public/js/i18n/',   //注意这里路径是你属性文件的所在文件夹
            mode: 'map',
            cache: false,
            language: language,
            callback: function () {
                try {
                    //初始化页面元素
                    $('[data-i18n-placeholder]').each(function () {
                        $(this).attr('placeholder', $.i18n.prop($(this).data('i18n-placeholder')));
                    });
                    $('[data-i18n-img]').each(function () {
                        $(this).attr('src', $.i18n.prop($(this).data('i18n-img')));
                    });
                    $('[data-i18n-text]').each(function () {
                        //如果text里面还有html需要过滤掉
                        var html = $(this).html();
                        var reg = /<(.*)>/;
                        if (reg.test(html)) {
                            var htmlValue = reg.exec(html)[0];
                            $(this).html(htmlValue + $.i18n.prop($(this).data('i18n-text')));
                        } else {
                            $(this).text($.i18n.prop($(this).data('i18n-text')));
                        }
                    });
                    $('[data-i18n-value]').each(function () {
                        $(this).val($.i18n.prop($(this).data('i18n-value')));
                    });
                    
                    $('[data-i18n-title]').each(function () {
                        $(this).attr('title', $.i18n.prop($(this).data('i18n-title')));
                    });
                } catch (ex) {
                }
            }
        });
	
	
	
});
function right_scrolltop() {
	$("body,html").animate({"scrollTop":0});	
}
pe_loadscript("<?php echo $pe['host_root'] ?>api.php?mod=cron");


  function setCookie(name, value, days, domain, path) {
        var date = new Date();
        days = days || 730; // 两年
        path = path || '/';
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = '; expires=' + date.toGMTString();
        var cookieValue = name + '=' + value + expires + '; path=' + path;
        if (domain) {
            cookieValue += '; domain=' + domain;
        }
        document.cookie = cookieValue;
    }



function getCookie(name) {
        var prefix = name + "="
        var start = document.cookie.indexOf(prefix)

        if (start == -1) {
            return null;
        }

        var end = document.cookie.indexOf(";", start + prefix.length)
        if (end == -1) {
            end = document.cookie.length;
        }

        var value = document.cookie.substring(start + prefix.length, end)
        return unescape(value);
    }
    
    
    function appendQuerystring(key, value) {
	    var search = location.search;
	    if (search.indexOf('?') === -1) {
	        return '?' + key + '=' + value;
	    } else {
	        search = search.substring(1, search.length);
	        var arr = search.split('&');
	        var newSearch = '?';
	        for (let i = 0; i < arr.length; i++) {
	            if (arr[i].startsWith(key + '=')) {
	                arr[i] = key + '=' + value;
	            }
	            newSearch += arr[i] + '&';
	        }
	        return newSearch.substring(0, newSearch.length - 1);
	    }
}
    

</script>
</body>
</html>