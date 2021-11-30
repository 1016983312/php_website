<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24点计算器 Lucky 24</title>
    <link rel="stylesheet" type="text/css" href="css/24calculator.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div id="boa-chinese-content" class="content">
        <div id="boa-button-sub-content" class="sub-content m-top-45">
            <div class="sub-content-title bookOfAnswer_chinese">
                <div class="font-subtitle">24点计算器</div>
                <div class="font-title"> 请输入数字：</div>
                <div class="font-body m-top-45"><input type="text"><input type="text"><input type="text"><input type="text"></div>
                <div class="font-body"><button type="button" onclick="btnGetAnswer()" class="ant-btn ant-btn-black">计算</button></div>
                <div class="font-body m-top-45"><input type="text"></div>
                <div class="font-body">24点游戏是一种益智游戏，24点是把4个整数（一般是正整数）通过加减乘除以及括号运算，使最后的计算结果是24的一个数学游戏，24点可以考验人的智力和数学敏感性，它能在游戏中提高人们的心算能力。24点计算器中能列举出所有的可能计算结果.

24点计算通常是使用扑克牌来进行游戏的，一副牌中抽去大小王后还剩下52张（如果初练也可只用1～10这40张牌），任意抽取4张牌（称为牌组），用加、减、乘、除（可加括号）把牌面上的数算成24。24点游戏中每张牌必须只能用一次，如抽出的牌是3、8、8、9，那么算式为（9－8）×8×3或3×8÷（9－8）或（9－8÷8）×3等。</div>
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