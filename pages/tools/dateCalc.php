<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日期计算器</title>
    <link rel="stylesheet" type="text/css" href="css/datecalc.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div id="date-calc-content" class="content">
        <div id="date-calc-diff-content" class="sub-content">
            <div class="sub-content-title">
                计算两个日期相差天数
            </div>
            <div class="sub-content-body">
                <table>
                    <tr>
                        <td style="text-align:right">起始：
                        </td>
                        <td><input type="number" id="date-calc-diff-content-from-year" />
                        </td>
                        <td>年
                        </td>
                        <td><input type="number" id="date-calc-diff-content-from-month" />
                        </td>
                        <td>月
                        </td>
                        <td><input type="number" id="date-calc-diff-content-from-day" />
                        </td>
                        <td>日
                        </td>
                        <td>（默认今天）
                        </td>

                    </tr>
                    <tr>
                        <td style="text-align:right"> 距离：
                        </td>
                        <td><input type="number" id="date-calc-diff-content-to-year" />
                        </td>
                        <td>年
                        </td>
                        <td><input type="number" id="date-calc-diff-content-to-month" />
                        </td>
                        <td>月
                        </td>
                        <td><input type="number" id="date-calc-diff-content-to-day" />
                        </td>
                        <td>日
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="sub-content-body">
                <button id="calcDateDiff" type="button" onclick="dateDiffClick()"
                    class="button button-raised button-pill button-inverse">计算</button>
            </div>
            <div class="sub-content-body"> <strong id="calcDateDiffResultTitle">相差</strong>
                <input id="calcDateDiffResult" type="text" readonly></input><strong
                    id="calcDateDiffResultDay">天</strong>
            </div>
        </div>
        <div id="date-calc-extrapolation-content" class="sub-content">
            <div class="sub-content-title">
                推算前后若干天具体日期
            </div>
            <div class="sub-content-body">
                <table>
                    <tr>
                        <td style="text-align:right">起始日期：
                        </td>
                        <td><input type="number" id="date-calc-extrapolation-content-from-year" />
                        </td>
                        <td>年
                        </td>
                        <td><input type="number" id="date-calc-extrapolation-content-from-month" />
                        </td>
                        <td>月
                        </td>
                        <td><input type="number" id="date-calc-extrapolation-content-from-day" />
                        </td>
                        <td>日
                        </td>
                        <td>（默认今天）
                        </td>

                    </tr>
                    <tr>
                        <td style="text-align:right"> 推移：
                        </td>
                        <td><input type="number" id="date-calc-extrapolation-content-to-day" />
                        </td>
                        <td>天
                        </td>
                        <td colspan=5>（历史日期用负值，未来日期用正值。）
                        </td>
                    </tr>
                </table>
            </div>
            <div class="sub-content-body">
                <button id="calcDateExtrapo" type="button" onclick="dateExtrapolationClick()"
                    class="button button-raised button-pill button-inverse">推算</button>
            </div>
            <div class="sub-content-body"> <strong id="calcDateExtrapoResultTitle">推算日期为：</strong>
                <input id="calcDateExtrapoResult" type="text" readonly style="width:70px"></input>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    var myDate = new Date;
    var year = myDate.getFullYear(); //获取当前年
    var mon = myDate.getMonth() + 1; //获取当前月,从0开始所以+1
    var day = myDate.getDate(); //获取当前日
    $("#date-calc-diff-content-from-year").val(year); //diff
    $("#date-calc-diff-content-from-month").val(mon);
    $("#date-calc-diff-content-from-day").val(day);
    $("#date-calc-extrapolation-content-from-year").val(year); //extrapolation
    $("#date-calc-extrapolation-content-from-month").val(mon);
    $("#date-calc-extrapolation-content-from-day").val(day);
    $("#date-calc-diff-content-to-year").val("2013");
    $("#date-calc-diff-content-to-month").val("3");
    $("#date-calc-diff-content-to-day").val("3");

    $("#calcDateDiffResultTitle,#calcDateDiffResultDay,#calcDateDiffResult,#calcDateExtrapoResultTitle,#calcDateExtrapoResult,#calcDateExtrapoResultDay")
        .css("visibility", "hidden");


});
//字符串转成Time所需方法
function stringToTime(string) {
    var f = string.split(' ', 2);
    var d = (f[0] ? f[0] : '').split('-', 3);
    var t = (f[1] ? f[1] : '').split(':', 3);
    return (new Date(
        parseInt(d[0], 10) || null,
        (parseInt(d[1], 10) || 1) - 1,
        parseInt(d[2], 10) || null,
        parseInt(t[0], 10) || null,
        parseInt(t[1], 10) || null,
        parseInt(t[2], 10) || null
    )).getTime();
}
//计算两个时间的差值
//返回值：天
function dateDiff(date1, date2) {
    var type1 = typeof date1,
        type2 = typeof date2;
    if (type1 == 'string')
        date1 = stringToTime(date1);
    else if (date1.getTime)
        date1 = date1.getTime();
    if (type2 == 'string')
        date2 = stringToTime(date2);
    else if (date2.getTime)
        date2 = date2.getTime();
    return (date2 - date1) / (1000 * 60 * 60 * 24);
}

//计算某天前后多少天
//返回值：date
function dateExtrapo(date, days) {
    var nd = new Date(date);
    nd = nd.valueOf();
    nd = nd + days * 24 * 60 * 60 * 1000;
    nd = new Date(nd);
    //alert(nd.getFullYear() + "年" + (nd.getMonth() + 1) + "月" + nd.getDate() + "日");
    var y = nd.getFullYear();
    var m = nd.getMonth() + 1;
    var d = nd.getDate();
    if (m <= 9) m = "0" + m;
    if (d <= 9) d = "0" + d;
    var cdate = y + "-" + m + "-" + d;
    return cdate;
}
//按钮点击事件
function dateDiffClick() {
    var fromYear = $("#date-calc-diff-content-from-year").val();
    var fromMonth = $("#date-calc-diff-content-from-month").val();
    var fromDay = $("#date-calc-diff-content-from-day").val();
    var toYear = $("#date-calc-diff-content-to-year").val();
    var toMonth = $("#date-calc-diff-content-to-month").val();
    var toDay = $("#date-calc-diff-content-to-day").val();
    if (!fromYear) {
        alert("起始\"年\"不能为空！");
        ruturn;
    }
    if (!fromMonth) {
        alert("起始\"月\"不能为空！");
        ruturn;
    }
    if (!fromDay) {
        alert("起始\"日\"不能为空！");
        ruturn;
    }
    if (!toYear) {
        alert("结束\"年\"不能为空！");
        ruturn;
    }
    if (!toMonth) {
        alert("结束\"月\"不能为空！");
        ruturn;
    }
    if (!toDay) {
        alert("结束\"日\"不能为空！");
        ruturn;
    }
    if (!validatePositiveInt(fromYear, fromMonth, fromDay, toYear, toMonth, toDay)) {
        alert('请输入正整数！');
        ruturn;
    }
    var fromDate = fromYear + "-" + fromMonth + "-" + fromDay;
    var toDate = toYear + "-" + toMonth + "-" + toDay;
    var dateDiffDay = dateDiff(fromDate, toDate);
    if (dateDiffDay) {
        $("#calcDateDiffResult").val(dateDiffDay);
        $("#calcDateDiffResultTitle,#calcDateDiffResultDay,#calcDateDiffResult").css("visibility", "visible");
    }
};

//检测是否是正整数
function validatePositiveInt(n1, n2, n3, n4, n5, n6) {
    var validateResult = false;
    if (n1 % 1 === 0 && n2 % 1 === 0 && n3 % 1 === 0 && n4 % 1 === 0 && n5 % 1 === 0 && n6 % 1 === 0) {
        validateResult = true;
    }
    if (n1 < 0 || n2 < 0 || n3 < 0 || n4 < 0 || n5 < 0 || n6 < 0) {
        validateResult = true;
    }
    return validateResult;
}

//检测是否是整数
function validateInt(n1, n2, n3, n4) {
    var validateResult = false;
    if (n1 % 1 === 0 && n2 % 1 === 0 && n3 % 1 === 0 && n4 % 1 === 0) {
        validateResult = true;
    }
    return validateResult;
}

function dateExtrapolationClick() {
    var fromYear = $("#date-calc-extrapolation-content-from-year").val();
    var fromMonth = $("#date-calc-extrapolation-content-from-month").val();
    var fromDay = $("#date-calc-extrapolation-content-from-day").val();
    var extrapoDays = $("#date-calc-extrapolation-content-to-day").val();

    if (!fromYear) {
        alert("起始\"年\"不能为空！");
        ruturn;
    }
    if (!fromMonth) {
        alert("起始\"月\"不能为空！");
        ruturn;
    }
    if (!fromDay) {
        alert("起始\"日\"不能为空！");
        ruturn;
    }
    if (!extrapoDays) {
        alert("\"推移天数\"不能为空！");
        ruturn;
    }
    if (!validatePositiveInt(fromYear, fromMonth, fromDay, 1, 1, 1)) {
        alert('请输入正整数！');
        ruturn;
    }
    // if (!validateInt(fromYear, fromMonth, fromDay, parseInt(extrapoDays))) {
    //     alert('请输入整数！');
    //     ruturn;
    // }
    var fromDate = fromYear + "-" + fromMonth + "-" + fromDay;
    var dateExtrapoDate = dateExtrapo(fromDate, extrapoDays);
    if (dateExtrapoDate) {
        $("#calcDateExtrapoResult").val(dateExtrapoDate);
        $("#calcDateExtrapoResultTitle,#calcDateExtrapoResult").css("visibility", "visible");
    }
}
</script>

</html>