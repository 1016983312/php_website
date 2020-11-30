<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>答案之书 The book of answer</title>
    <link rel="stylesheet" type="text/css" href="css/bookOfAnswer.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div id="boa-chinese-content" class="content">
        <div id="boa-button-sub-content" class="sub-content m-top-45">
            <div class="sub-content-title bookOfAnswer_chinese">
                <div>神秘的<br />
                    答案之书
                </div>
                <div>解答你的世界里正在发生的一切</div>
                <div>忙碌的工作,快节奏的生活,烦人的感情<br />
                    无数的选择,无效的困惑和无奈摆在我们面前
                </div>
                <div>
                    这个时候,你只需要点开下面的按钮<br />
                    拿走一个简单的答案和暗示
                </div>
                <div>
                    先想一个最近你特别纠结的问题,然后盯着屏幕专注10秒<br />
                    再自然的按下按钮,你就会看到你问题的答案
                </div>


            </div>
            <div class="sub-content-body">
                <form action="bookOfAnswer_result.php" method="post">
                    <input type="hidden" id="boa-button-hidden-number" name="boa-button-hidden-number" value="">
                    <input type="submit" value="获取答案" onclick="btnGetAnswer()">
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {


});
//按钮点击事件
function btnGetAnswer() {
    $("#boa-button-hidden-number").val(randomNum(1, 22));
};

//生成从minNum到maxNum的随机数
function randomNum(minNum, maxNum) {
    switch (arguments.length) {
        case 1:
            return parseInt(Math.floor(Math.random() * minNum + 1), 10);
            break;
        case 2:
            return parseInt(Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum, 10);
            break;
        default:
            return 1;
            break;
    }
}
</script>

</html>