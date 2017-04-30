/**
 * 回答页
 */

$(function () {
    $('.heart').on("click", heartAnimate);
});

// 点赞动画
function heartAnimate() {
    $(this).css("background-position", "");
    var D = $(this).attr("rel");
    if (D === 'like') {
        $(this).addClass("heartAnimation").attr("rel", "unlike");
    }
    $(this).unbind();
}
