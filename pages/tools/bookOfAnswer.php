<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>答案之书</title>
    <link rel="stylesheet" type="text/css" href="css/bookOfAnswer.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div id="boa-chinese-content" class="content">
        <div id="boa-button-sub-content" class="sub-content">
            <div class="sub-content-title">
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
        $("#boa-button-hidden-number").val(randomNum(1,22));
    };

    //生成从minNum到maxNum的随机数
    function randomNum(minNum, maxNum) {
        switch (arguments.length) {
            case 1:
                return parseInt(Math.random() * minNum + 1, 10);
                break;
            case 2:
                return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
                break;
            default:
                return 1;
                break;
        }
    }
</script>

</html>