/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2010-1001 koyshe <koyshe@gmail.com>
 */

/* ====================== wxsdk封装函数 ====================== */
//分享触发函数
function wx_share(json){
	var name = json.name;
	var desc = (typeof(json.desc) != 'undefined' && json.desc != '') ? json.desc : '点击查看详情';
	var url = json.url;
	var img = json.img;
	var success = json.success;
    wx.updateAppMessageShareData({ 
	    title: name,
	    desc: desc,
		link: url,
	    imgUrl: img,
        success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
        }
    });
    wx.updateTimelineShareData({ 
	    title: name,
	    link: url,
	    imgUrl: img,
        success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
        }
    })
	return;
	
	//分享到朋友圈
	wx.onMenuShareTimeline({
	    title: name,
	    link: url,
	    imgUrl: img,
	    success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
		}
	});
	//分享给朋友
	wx.onMenuShareAppMessage({
	    title: name,
	    desc: desc,
		link: url,
	    imgUrl: img,
	    success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
		}
	});
	//分享到QQ
	wx.onMenuShareQQ({
	    title: name,
	    desc: desc,
	    link: url,
	    imgUrl: img,
	    success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
		}
	});
	//分享到腾讯微博
	wx.onMenuShareWeibo({
	    title: name,
	    desc: desc,
		link: url,
	    imgUrl: img,
	    success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
		}
	});
	//分享到QQ空间
	wx.onMenuShareQZone({
	    title: name,
	    desc: desc,
		link: url,
	    imgUrl: img,
	    success: function () {
			if (success && typeof(success) == "function") {
				func;
			}
		}
	});
}
//打开微信分享
function wx_share_open() {
	$("#wx_share").show();
}
//关闭微信分享
function wx_share_close() {
	$("#wx_share").hide();
}
//选择图片并上传
function wx_upload(img_id, img_value, func) {
	//选择照片
	wx.chooseImage({
	    count: 1, // 默认9
	    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
	    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
	    success: function (res) {
	        //alert(res.localIds); // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			$("#"+img_id).attr("src", res.localIds);
			wx.uploadImage({
			    localId: res.localIds.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得
			    isShowProgressTips: 1, // 默认为1，显示进度提示
			    success: function (res) {
			        //var serverId = res.serverId; // 返回图片的服务器端ID
			        $(":input[name='"+img_value+"']").val(res.serverId);
			        //$(":input[name='order_id']").val(res.serverId);
			    	if (func && typeof(func) == "function") {
			    		func(img_id, img_value);
			    	}
			    }
			});
		}
	});
}