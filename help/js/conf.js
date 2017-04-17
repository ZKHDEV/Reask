/*
    配置文件
*/

(function () {
    var config = {
        // 主题色
        colors: {
            0: '#4c87eb',
            1: '#ea6c3c',
            2: '#cd2d27',
            3: '#12bb8f',
            4: '#814d93',
            5: '#f24c81',
            6: '#f9c14c',
            7: '#79c159',
            8: '#919191'
        },
        // 问题列表
        question: [
            ['answer1.html','为什么我的问题不能正常提醒？','normal'],
            ['answer2.html','如何查看我的问题统计图？','normal'],
            ['answer3.html','如何根据时间查看我的问题？','normal'],
            ['answer4.html','如何修改和删除分类？','normal'],
            ['answer5.html','如何设置问题提醒形式？','normal'],
            ['answer6.html','如何添加分类？','normal'],
            ['answer7.html','如何修改主题色？','hidden'],
            ['answer8.html','我下载的新版本问·忆在哪里？','hidden']    
        ]
    };
    window.CONFIG = config;
}())