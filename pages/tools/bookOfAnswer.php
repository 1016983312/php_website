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
                <div class="font-subtitle">神秘的</div>
                <div class="font-title"> 答案之书
                </div>
                <div class="font-body m-top-45">解答你的世界里正在发生的一切</div>
                <div class="font-body">忙碌的工作,快节奏的生活</div>
                <div class="font-body m-top-45">先想一个最近你特别纠结的问题</div>
                <div class="font-body">然后盯着屏幕专注10秒</div>
                <div class="font-body">再自然的按下按钮</div>
                <div class="font-body">你就会看到你问题的答案</div>
            </div>


        </div>
        <div class="sub-content-body">
            <form id="formBookOfAnswer" action="bookOfAnswer_result.php" method="post">
                <input type="hidden" id="boa-button-hidden-number" name="boa-button-hidden-number" value="">
                <button type="button" onclick="btnGetAnswer()" class="ant-btn ant-btn-black">获取答案</button>
                
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
    $("#boa-button-hidden-number").val(randomNum(1, 183));
    <?php 

    ?>
    
    document.getElementById("formBookOfAnswer").submit(); 
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