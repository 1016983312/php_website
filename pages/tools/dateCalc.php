<!DOCTYPE html>
<html lang="en">

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
                        <td>
                        </td>
                        <td><input type="text" id="date-calc-diff-content-from-year" />
                        </td>
                        <td>年
                        </td>
                        <td><input type="text" id="date-calc-diff-content-from-month" />
                        </td>
                        <td>月
                        </td>
                        <td><input type="text" id="date-calc-diff-content-from-day" />
                        </td>
                        <td>日
                        </td>
                        <td>（默认今天）
                        </td>

                    </tr>
                    <tr>
                        <td> 距离
                        </td>
                        <td><input type="text" id="date-calc-diff-content-to-year" />
                        </td>
                        <td>年
                        </td>
                        <td><input type="text" id="date-calc-diff-content-to-month" />
                        </td>
                        <td>月
                        </td>
                        <td><input type="text" id="date-calc-diff-content-to-day" />
                        </td>
                        <td>日
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
                <a onclick="dateDiffClick()" id="calcDateDiff" class="button button-raised button-pill button-inverse">计算</a><strong id="calcDateDiffResultTitle">相差</strong><input id="calcDateDiffResult" type="text" readonly></input><strong id="calcDateDiffResultDay">天</strong>
            </div>
        </div>

        <div id="date-calc-extrapolation-content" class="sub-content">
            <div class="sub-content-title">
                推算前后若干天具体日期
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
    $("#date-calc-diff-content-from-year").val(year);
    $("#date-calc-diff-content-from-month").val(mon);
    $("#date-calc-diff-content-from-day").val(day);

    $("#calcDateDiffResultTitle,#calcDateDiffResultDay,#calcDateDiffResult").css("visibility","hidden");

    
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
    //按钮点击事件
    function dateDiffClick() {
        var fromYear = $("#date-calc-diff-content-from-year").val();
        var fromMonth = $("#date-calc-diff-content-from-month").val();
        var fromDay = $("#date-calc-diff-content-from-day").val();
        var toYear = $("#date-calc-diff-content-to-year").val();
        var toMonth = $("#date-calc-diff-content-to-month").val();
        var toDay = $("#date-calc-diff-content-to-day").val();
        var fromDate = fromYear + "-" + fromMonth + "-" + fromDay;
        var toDate = toYear + "-" + toMonth + "-" + toDay;
        var dateDiffDay = dateDiff(fromDate, toDate);
        if (dateDiffDay) {
            $("#calcDateDiffResult").val(dateDiffDay);
            $("#calcDateDiffResultTitle,#calcDateDiffResultDay,#calcDateDiffResult").css("visibility","visible");
        }
    };
</script>

</html>