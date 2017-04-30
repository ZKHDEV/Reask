/**
 * 主题色
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

// 调色盘
var ColorPicker = (function () {
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

    return {
        get: function(num){
            return colors[num] ? colors[num] : null;
        }
    }
})();

// 主题色对象
var Color = {
    init: function () {
        this.initColor();
        this.flushThemeColor();
        this.initLinkColorNo();
    },
    initColor: function () {  // 初始化主题色
        window.$no = $_GET['color'] ? $_GET['color'] : 0;
        window.$color = ColorPicker.get(window.$no);
    },
    flushThemeColor: function () {  // 渲染主题色
        $('html').css('background-color', window.$color);
        $('.download-btn').css('color', window.$color);
    }
}
Color.init();