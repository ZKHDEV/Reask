/*
    主页
*/

$(function () {
    $('.all-btn').on('click', expandList);
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

// 原型式继承方法
function inheritObject(o) {
    function F() { }
    F.prototype = o;
    return new F();
}

// 寄生式继承方法
function inheritPrototype(subClass, superClass) {
    var p = inheritObject(superClass.prototype);
    p.constructor = subClass;
    subClass.prototype = p;
}

// 问题抽象类
var Question = function () {
    this.childrens = [];
    this.element = null;
}
Question.prototype = {
    init: function () {
        throw new Error('Please override init method!');
    },
    add: function () {
        throw new Error('Please override add method!');
    },
    getElement: function () {
        throw new Error('Please override getElement method!');
    }
}

// 问题列表容器
var Container = function (id, parent) {
    Question.call(this);
    this.id = id;
    this.parent = parent;
    this.init();
}
inheritPrototype(Container, Question);
Container.prototype.init = function () {
    this.element = document.createElement('ul');
    this.element.id = this.id;
    this.element.className = 'menu';
}
Container.prototype.add = function (child) {
    this.childrens.push(child);
    this.element.appendChild(child.getElement());
    return this;
}
Container.prototype.getElement = function () {
    return this.element;
}
Container.prototype.show = function () {
    this.parent.appendChild(this.element);
}

// 问题列表项
var Item = function (classname) {
    Question.call(this);
    this.classname = classname;
    this.init();
}
inheritPrototype(Item, Question);
Item.prototype.init = function () {
    this.element = document.createElement('li');
    this.element.className = this.classname;
}
Item.prototype.add = function (child) {
    this.childrens.push(child);
    this.element.appendChild(child.getElement());
    return this;
}
Item.prototype.getElement = function () {
    return this.element;
}

// 问题项子元素
var QuesLink = function (title, href) {
    Question.call(this);
    this.title = title;
    this.href = href;
    this.init();
}
inheritPrototype(QuesLink, Question);
QuesLink.prototype.init = function () {
    this.element = document.createElement('a');
    this.element.href = this.href;
    this.element.innerHTML = this.title + '<span class="icon-goto">&#x203A;</span>';
}
QuesLink.prototype.getElement = function () {
    return this.element;
}
QuesLink.prototype.add = function () { };

    // 渲染问题列表
    (function renderQuesList() {
        var container = new Container('ques-list', document.getElementById('ques-container')),
            list = window.CONFIG.question;
        for (var i in list) {
            container.add(
                new Item(list[i][2]).add(new QuesLink(list[i][1], list[i][0]))
            );
        }
        container.show();
    }());