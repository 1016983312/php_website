<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>走时校准助手</title>
    <link rel="stylesheet" type="text/css" href="css/timeAdjustHelper.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>

    <div class="content">
        <div class="sub-content">
            <div class="sub-content-title timeAdjustHelper_title">走时校准助手</div>
        </div>
        <div class="sub-content-body">
            <div id="main">
                <div id="show_time"></div>
                <div id="show_second_f"><div id="show_second"></div></div>
                <div id="show_week"></div>
            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {});

setInterval("fun(show_time)", 1);

function fun(timeID) {
    var date = new Date();
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    var w = date.getDay();
    var ww = '星期' + '日一二三四五六'.charAt(new Date().getDay());
    var h = date.getHours();
    var minute = date.getMinutes();
    var s = date.getSeconds();
    var sss = date.getMilliseconds();
    if (m < 10) {
        m = "0" + m;
    }
    if (d < 10) {
        d = "0" + d;
    }
    if (h < 10) {
        h = "0" + h;
    }
    if (minute < 10) {
        minute = "0" + minute;
    }
    if (s < 10) {
        s = "0" + s;
    }
    if (sss < 10) {
        sss = "00" + sss;
    } else if (sss < 100) {
        sss = "0" + sss;
    }
    document.getElementById(timeID.id).innerHTML = y + "-" + m + "-" + d + "    " + h + ":" + minute;
    document.getElementById("show_second").innerHTML =s + "." +sss;
    document.getElementById("show_week").innerHTML =ww;
}
</script>

</html>