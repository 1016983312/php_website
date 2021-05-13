<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/default.css">
    <link rel="stylesheet" type="text/css" href="/css/navigator.css">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b4c2b867ae98c9be8d4d28d6c8521d17";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
    </script>

</head>

<body>
    <div id="menu">
        <div id="sub-menu">
            <div class="divlogo m-left-45 m-right-10"><a href="/index.php" class="logo" title="asribs"><img
                        src="/images/Asribs.png" alt="asribs"></a>
            </div>
            <div class="toggle-menu m-right-35">
                <ul class="toggle">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <ul class="sub">
                <li>
                    <span><a href="/index.php" class="nodrop">首页</a></span>
                </li>
                <li class="drop">
                    <span><a href="#">常用工具</a></span>
                    <ul class="child-menu">
                        <li><a href="/pages/tools/dateCalc.php">日期计算器</a></li>
                        <li><a href="/pages/tools/bookOfAnswer.php">答案之书</a></li>
                    </ul>
                </li>
                <li class="drop">
                    <span><a href="#">联系我们</a></span>
                    <ul class="child-menu">
                        <li><a href="#">个人介绍</a></li>
                        <li><a href="/pages/contactus/contactus.php">有话想说</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.0.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/jquery-3.5.1.min.js" type="text/javascript"><\/script>')</script>
<script>
(function() {
    document.querySelector('.menu .toggle').onclick = function(e) {
        e.stopPropagation();
        this.classList.toggle('active');
        let menu = document.querySelector('.sub');
        menu.classList.toggle('on');
    };
    let subMenu = document.querySelectorAll('.sub > .drop');
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