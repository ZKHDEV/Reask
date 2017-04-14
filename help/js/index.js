$(function () {
    $('.all-btn').on('click', expandList);

    // 点赞按钮事件
    $('.heart').on("click", function () {
        $(this).css("background-position", "");
        var D = $(this).attr("rel");
        if (D === 'like') {
            $(this).addClass("heartAnimation").attr("rel", "unlike");
        }
        $(this).unbind();
    });
});

// 展开全部链接
function expandList() {
    $(this).fadeOut(200);
    $('.header-title').text('全部问题');
    $('title').text('全部问题');
    $('html,body').addClass('themecolor');
    $('.back-animate-box').hide();
    $('.menu').css('margin-bottom', '70px').children("li.hidden").slideDown(500);
    Color.flushThemeColor();  // 刷新主题色
}

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

// 调色盘
var colors = {
    0: '#4c87eb',
    1: '#ea6c3c',
    2: '#cd2d27',
    3: '#12bb8f',
    4: '#814d93',
    5: '#f24c81',
    6: '#f9c14c',
    7: '#79c159',
    8: '#919191'
}

var Color = {
    init: function () {
        this.initColor();
        this.flushThemeColor();
        this.initLinkColorNo();
    },
    initColor: function () {  // 初始化主题色
        window.$no = $_GET['color'] ? $_GET['color'] : 0;
        window.$color = colors[window.$no];
    },
    flushThemeColor: function () {  // 渲染主题色
        $('.themecolor').css('background-color', window.$color);
        $('.like').css('border', '6px solid ' + window.$color);
    },
    initLinkColorNo: function () {  // 初始化链接颜色参数
        // 主页链接
        var $links = $('.menu a');
        $links.each(function () {
            var $link = $(this);
            var $linkHref = this.href;
            if ($linkHref.indexOf("color=") === -1) {
                $(this).attr('href', $linkHref + '?color=' + window.$no);
            }
        });
        // 返回按钮
        var $returnBtn = $('.returnbtn');
        var $returnBtnHref = this.href;
        if ($returnBtnHref.indexOf("color=") === -1) {
            $returnBtn.attr('href', $returnBtnHref + '?color=' + window.$no);
        }
    }
}
Color.init();