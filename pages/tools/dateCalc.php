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
                <input type="text" id="date-calc-diff-content-from-year" />年<input type="text"
                    id="date-calc-diff-content-from-month" />月<input type="text"
                    id="date-calc-diff-content-from-day" />日（默认今天）<p>
                    距离<input type="text" id="date-calc-diff-content-to-year" />年<input type="text"
                        id="date-calc-diff-content-to-month" />月<input type="text"
                        id="date-calc-diff-content-to-day" />日<p>
                        <button>相差</button></div>
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
    $("p").click(function() {
        $(this).hide();
    });
});
</script>

</html>