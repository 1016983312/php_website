<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>响应式菜单切换效果</title>
    <link rel="stylesheet" href="/css/navigator2.css" />
</head>

<body>
    <div class="menu">
        <div class="sub-menu">
            <div class="logo">logo</div>
            <div class="toggle-menu">
                <ul class="toggle">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <ul class="sub">
                <li>
                    <span><a href="/index.php" class="nodrop">首页</a></span>
                    <ul class="child-menu">
                        <li>导航子菜单1-1</li>
                        <li>导航子菜单1-2</li>
                        <li>导航子菜单1-3</li>
                    </ul>
                </li>
                <li>
                    <span>常用工具</span>
                    <ul class="child-menu">
                        <li><a href="/pages/tools/dateCalc.php">日期计算器</a></li>
                        <li><a href="/pages/tools/bookOfAnswer.php">答案之书</a></li>
                        <li>导航子菜单2-3</li>
                    </ul>
                </li>
                <li>
                    <span><a href="/pages/contactus/contactus.php" class="nodrop">联系我</a></span>
                    <ul class="child-menu">
                        <li>导航子菜单3-1</li>
                        <li>导航子菜单3-2</li>
                        <li>导航子菜单3-3</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="banner">Banner</div>
</body>
<script>
(function() {
    document.querySelector('.menu .toggle').onclick = function(e) {
        e.stopPropagation();
        this.classList.toggle('active');
        let menu = document.querySelector('.sub');
        menu.classList.toggle('on');
    };
    let subMenu = document.querySelectorAll('.sub > li');
    for (let i = 0, len = subMenu.length; i < len; i++) {
        (function(b) {
            subMenu[b].onclick = function(e) {
                e.stopPropagation();
                // document.querySelector('.child-menu.on') && document.querySelector('.child-menu.on').classList.remove('on');
                for (let j = 0, lenj = subMenu.length; j < lenj; j++) {
                    if (j !== b) {
                        document.querySelectorAll('.child-menu')[j].classList.remove('on');
                    }
                }
                this.querySelector('.child-menu').classList.toggle('on');
            }
        })(i);
    }
    document.onclick = function() {
        console.log(document.querySelector('.menu .toggle'));
        document.querySelector('.menu .toggle').classList.contains('active') && document.querySelector(
            '.menu .toggle').click();
        document.querySelector('.child-menu.on') && document.querySelector('.child-menu.on').classList.remove(
            'on');
    }
})();
</script>

</html>