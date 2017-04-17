/*
    主题色
*/

// 获取URL参数
var $_GET = (function () {
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if (typeof (u[1]) == "string") {
        u = u[1].split("&");
        var get = {};
        for (var i in u) {
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return "";
    }
})();

// 主题色对象
var Color = {
    init: function () {
        this.initColor();
        this.flushThemeColor();
        this.initLinkColorNo();
    },
    // 初始化主题色
    initColor: function () {  
        window.$no = $_GET['color'] ? $_GET['color'] : 0;
        window.$color = window.CONFIG.colors[window.$no];
    },
    // 渲染主题色
    flushThemeColor: function () {  
        $('.themecolor').css('background-color', window.$color);
        $('.like').css('border', '6px solid ' + window.$color);
    },
    // 初始化链接颜色参数
    initLinkColorNo: function () {  
        // 主页链接
        var $links = $('#ques-list li a');
        if ($links.length) {
            $links.each(function () {
                var $link = $(this);
                var $linkHref = $link.attr('href');
                if ($linkHref.indexOf("color=") === -1) {
                    $(this).attr('href', $linkHref + '?color=' + window.$no);
                }
            });
        }

        // 详情页返回按钮
        var $returnBtn = $('.return-btn');
        if ($returnBtn.length) {
            var $returnBtnHref = $returnBtn.attr('href');
            if ($returnBtnHref.indexOf("color=") === -1) {
                $returnBtn.attr('href', $returnBtnHref + '?color=' + window.$no);
            }
        }
    }
}
Color.init();