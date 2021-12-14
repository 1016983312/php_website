<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24点计算器 24 Game</title>
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
                <div class="sub-content-body">
                    <form id="24calculator" action="#" method="post">
                        <div class="font-title"> 请输入数字</div>
                        <div class="font-body m-top-45">
                            <input type="text" maxlength="6" id="t1" size="5" value="1">
                            <input type="text" maxlength="6" id="t2" size="5" value="2">
                            <input type="text" maxlength="6" id="t3" size="5" value="3">
                            <input type="text" maxlength="6" id="t4" size="5" value="4">
                        </div>
                        <div class="font-body"><button type="button" onclick="btnGetAnswer()"
                                class="ant-btn ant-btn-black">计算</button></div>
                    </form>
                </div>
                <div class="font-body m-top-45">
                    运算结果：
                </div>
                <div class="font-body"><input type="text" id="resultExpressions"></div>
                <div class="font-body">
                    24点游戏是一种益智游戏，24点是把4个整数（一般是正整数）通过加减乘除以及括号运算，使最后的计算结果是24的一个数学游戏，24点可以考验人的智力和数学敏感性，它能在游戏中提高人们的心算能力。24点计算器中能列举出所有的可能计算结果.

                    24点计算通常是使用扑克牌来进行游戏的，一副牌中抽去大小王后还剩下52张（如果初练也可只用1～10这40张牌），任意抽取4张牌（称为牌组），用加、减、乘、除（可加括号）把牌面上的数算成24。24点游戏中每张牌必须只能用一次，如抽出的牌是3、8、8、9，那么算式为（9－8）×8×3或3×8÷（9－8）或（9－8÷8）×3等。
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {

});
//按钮点击事件
function btnGetAnswer() {
    var num1 = $("#t1").val();
    var num2 = $("#t2").val();
    var num3 = $("#t3").val();
    var num4 = $("#t4").val();
    operatorArrary = ['+', '-', '*', '/'];
    var expressions = new Array();
    validateInt(num1, num2, num3, num4);
    getCalc24ExpressionsA(num1, num2, num3, num4, operatorArrary, expressions);
    //expressions = arrayRemoveDuplicate(expressions, expressions); //remove duplicate item
    $("#resultExpressions").val(expressions);
}

//检测是否是整数
function validateInt(n1, n2, n3, n4) {
    var validateResult = false;
    if (n1 % 1 === 0 && n2 % 1 === 0 && n3 % 1 === 0 && n4 % 1 === 0) {
        validateResult = true;
    }
    if (!validateResult) {
        alert('请输入整数！');
    }
}

//获得所有得出24点的表达式A方法
function getCalc24ExpressionsA(n1, n2, n3, n4, operArr, expressions) {
    //顺序有:1.((n1?n2)?n3)?n4; 2.((n1?(n2?n3))?n4; 3.n1?((n2?n3)?n4); 4.n1?(n2?(n3?n4)); 5.((n1?n4)?n3)n2; 6.((n1?n3)?n2)?n4; 7.((n2?n4)?n1)?n3; 8.((n1?n2)?n4)?n3; 9.n2?(n1?(n3?n4)); 
    //10.((n1?n4)?n2)n3; 11.((n1?n3)?n4)?n2; 12.((n2?n4)?n3)?n1;
    var expressionItem = "";
    var numberArray = [
        [n1, n2, n3, n4],
        [n1, n2, n4, n3],
        [n1, n3, n2, n4],
        [n1, n3, n4, n2],
        [n1, n4, n3, n2],
        [n1, n4, n2, n3],
        [n2, n1, n3, n4],
        [n2, n1, n4, n3],
        [n2, n3, n1, n4],
        [n2, n3, n4, n1],
        [n2, n4, n1, n3],
        [n2, n4, n3, n1],
        [n3, n1, n2, n4],
        [n3, n1, n4, n2],
        [n3, n2, n1, n4],
        [n3, n2, n4, n1],
        [n3, n4, n2, n1],
        [n3, n4, n1, n2],
        [n4, n1, n2, n3],
        [n4, n1, n3, n2],
        [n4, n2, n1, n3],
        [n4, n2, n3, n1],
        [n4, n3, n1, n2],
        [n4, n3, n2, n1]
    ];;
    //var indexValue = operArr.length;
    var result1 = 0; //前两个计算结果
    var result2 = 0; //前三个计算结果
    var haveAnswerFlag = false;
    //获取4个整数
    //获取计算需要的符号
    //遍历or递归计算可能性
    //将结果存入变量，显示在前端页面控件内
    for (let m = 0; m < numberArray.length; m++) {
        var element = numberArray[m];
        for (var i = 0; i < operArr.length; i++) {
            if (element[1] == 0 && operArr[i] === '\/') {
                continue;
            }
            if (haveAnswerFlag) {
                break;
            }
            result1 = neval(element[0] + operArr[i] + '(' + element[1] + ')')
            for (var j = 0; j < operArr.length; j++) {
                if (element[2] == 0 && operArr[j] === '\/') {
                    continue;
                }
                if (haveAnswerFlag) {
                    break;
                }
                result2 = neval(result1 + operArr[j] + '(' + element[2] + ')')
                for (var k = 0; k < operArr.length; k++) {
                    if (element[3] == 0 && operArr[k] === '\/') {
                        continue;
                    }
                    if (haveAnswerFlag) {
                        break;
                    }
                    if (neval(result2 + operArr[k] + '(' + element[3] + ')') == 24) {
                        if ((getExpressionOperator(j) === '*' || getExpressionOperator(j) === '\/') && (
                                getExpressionOperator(i) === '+' || getExpressionOperator(i) === '-')) {
                            expressionItem = '(' + element[0] + getExpressionOperator(i) + element[1] + ')' +
                                getExpressionOperator(j) + element[2]
                        } else {
                            expressionItem = element[0] + getExpressionOperator(i) + element[1] + getExpressionOperator(
                                j) + element[2]
                        }
                        if ((getExpressionOperator(k) === '*' || getExpressionOperator(k) === '\/') && (
                                getExpressionOperator(j) === '+' || getExpressionOperator(j) === '-')) {
                            expressionItem = '(' + expressionItem + ')' + getExpressionOperator(k) + element[3]
                        } else {
                            expressionItem = expressionItem + getExpressionOperator(k) + element[3];
                        }
                        expressions.push(expressionItem);
                        haveAnswerFlag = true;
                    }
                }
            }
        }
        //顺序有:1.(n1?n2)?(n3?n4);
        for (var i = 0; i < operArr.length; i++) {
            if (element[1] == 0 && operArr[i] === '\/') {
                continue;
            }
            if (haveAnswerFlag) {
                break;
            }
            result1 = neval(element[0] + operArr[i] + '(' + element[1] + ')') //result1 = (n1?n2)
            for (var k = 0; k < operArr.length; k++) {
                if (element[3] == 0 && operArr[k] === '\/') {
                    continue;
                }
                if (haveAnswerFlag) {
                    break;
                }
                result2 = neval(element[2] + operArr[k] + '(' + element[3] + ')') //result1 = (n3?n4)
                for (var j = 0; j < operArr.length; j++) {
                    if (result2 == 0 && operArr[j] === '\/') {
                        continue;
                    }
                    if (haveAnswerFlag) {
                        break;
                    }
                    if (neval(result1 + operArr[j] + '(' + result2 + ')') == 24) {
                        if (getExpressionOperator(j) === '*' || getExpressionOperator(j) === '\/') {
                            if (getExpressionOperator(i) === '+' || getExpressionOperator(i) === '-') {
                                expressionItem = '(' + element[0] + getExpressionOperator(i) + element[1] + ')';
                            }else{
                                expressionItem =element[0] + getExpressionOperator(i) + element[1];
                            }
                            if (getExpressionOperator(k) === '+' || getExpressionOperator(k) === '-') {
                                expressionItem = expressionItem + getExpressionOperator(j) + '(' + element[2] + getExpressionOperator(k) + element[3] +')';
                            }
                            else{
                                expressionItem = expressionItem + getExpressionOperator(j) + element[2] + getExpressionOperator(k) + element[3];
                            }
                        } else {
                            expressionItem = element[0] + getExpressionOperator(i) + element[1] + getExpressionOperator(
                                j) + element[2] + getExpressionOperator(k) + element[3]
                        }
                        expressions.push(expressionItem);
                        haveAnswerFlag = true;
                    }
                }
            }
        }
    }
    if (expressions == '') {
        expressions.push("我尽力了，实在没有解。。。");
    }
    return expressions;
}



//获得表达式
function getExpressionOperator(number) {
    if (number == 0) {
        return "+";
    }
    if (number == 1) {
        return "-";
    }
    if (number == 2) {
        return "*";
    }
    if (number == 3) {
        return "/";
    }
}

//数组去重
function arrayRemoveDuplicate(arr1, arr2) {
    return Array.from(new Set(arr1.concat(arr2)));
}

function neval(str) {
    var fn = Function;
    return new fn('return ' + str)();
}
</script>



</html>