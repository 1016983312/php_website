<!DOCTYPE html>
<?php

// 微信 JS 接口签名校验工具: https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=jsapisign
$appid = 'wx855f1f4845f7cc6d';
$secret = '029e0fd0d493ea052299bddd4dd6dbc7';


// 获取token
$token_data = file_get_contents('./wechat_token.txt');
if (!empty($token_data)) {
    $token_data = json_decode($token_data, true);
}

$time  = time() - $token_data['time'];
if ($time > 7000) {
    $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
    $token_res = https_request($token_url);
    $token_res = json_decode($token_res, true);
    $token = $token_res['access_token'];

    $data = array(
        'time' =>time(),
        'token' =>$token
    );
    $res = file_put_contents('./wechat_token.txt', json_encode($data));
    if ($res) {
        //echo '更新 token 成功';
    }
} else {
    $token = $token_data['token'];
}


// 获取ticket
$ticket_data = file_get_contents('./wechat_ticket.txt');
if (!empty($ticket_data)) {
    $ticket_data = json_decode($ticket_data, true);
}

$time  = time() - $ticket_data['time'];
if ($time > 7000) {
    $ticket_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token}&type=jsapi";
    $ticket_res = https_request($ticket_url);
    $ticket_res = json_decode($ticket_res, true);
    $ticket = $ticket_res['ticket'];

    $data = array(
        'time'    =>time(),
        'ticket'  =>$ticket
    );
    $res = file_put_contents('./wechat_ticket.txt', json_encode($data));
    if ($res) {
        //echo '更新 ticket 成功';
    }
} else {
    $ticket = $ticket_data['ticket'];
}


// 进行sha1签名
$timestamp = time();
$nonceStr = createNonceStr();

// 注意 URL 建议动态获取(也可以写死).
// $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$protocol ="https://";
$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // 调用JSSDK的页面地址
// $url = $_SERVER['HTTP_REFERER']; // 前后端分离的, 获取请求地址(此值不准确时可以通过其他方式解决)
$str = "jsapi_ticket={$ticket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
$sha_str = sha1($str);

function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}


/**
 * 模拟 http 请求
 * @param  String $url  请求网址
 * @param  Array  $data 数据
 */
function https_request($url, $data = null){
    // curl 初始化
    $curl = curl_init();

    // curl 设置
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    // 判断 $data get  or post
    if ( !empty($data) ) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // 执行
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}

?>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24点计算器 24 Game</title>
    <link rel="stylesheet" type="text/css" href="css/24calculator.css">
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
    <div class="content">
        <div class="sub-content">
            <div class="sub-content-title calc24 m-bottom-45">
                <div class="font-subtitle">24点计算器</div>
                <div class="sub-content-body">
                    <form id="24calculator" action="#" method="post">
                        <div class="font-title"> 请输入数字</div>
                        <div class="font-body m-top-45">
                            <input type="text" maxlength="6" id="t1" size="5" value="1" οnfοcus=”this.select()
                                onclick="this.select()" x-webkit-speech />
                            <input type="text" maxlength="6" id="t2" size="5" value="2" οnfοcus=”this.select()
                                onclick="this.select()" />
                            <input type="text" maxlength="6" id="t3" size="5" value="3" οnfοcus=”this.select()
                                onclick="this.select()" />
                            <input type="text" maxlength="6" id="t4" size="5" value="4" οnfοcus=”this.select()
                                onclick="this.select()" />
                        </div>
                        <div class="font-body m-top-45">
                            <button id="btnTranslateVoiceStart" onclick="translateVoiceStart()" type="button"
                                class="ant-btn ant-btn-black m-right-10">开始语音识别</button>
                            <button id="btnTranslateVoiceEnd" onclick="translateVoiceEndAndTranslate()" type="button"
                                class="ant-btn ant-btn-black m-right-10">结束语音识别</button>
                        </div>
                        <div class="font-body m-top-45">
                            <button type="button" onclick="btnGetAnswer()"
                                class="ant-btn ant-btn-black m-right-10">计算</button>
                        </div>
                    </form>
                </div>
                <div class="font-body m-top-45">
                    运算结果
                </div>
                <div class="font-body"><input type="text" id="resultExpressions" οnfοcus=”this.select()
                        onclick="this.select()" /></div>
                <div class="sub-content-body calc24Description">
                    24点游戏是一种益智游戏</div>
                <div class="sub-content-body calc24Description">
                    把4个整数通过加减乘除以及括号运算，使最后的计算结果是24的一个数学游戏
                </div>
                <div class="sub-content-body calc24Description">可以考验人的智力和数学敏感性，它能在游戏中提高人们的心算能力
                </div>
                <div class="sub-content-body calc24Description">
                    如数字是1、2、3、4，那么算式为(1+2+3)*4
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.0.min.js"></script>
<script>
window.jQuery || document.write('<script src="/js/jquery-3.5.1.min.js" type="text/javascript"><\/script>')
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#t1").focus();
    $("#t1").select();
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
    ];
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
                                getExpressionOperator(j) + element[2];
                        } else {
                            expressionItem = element[0] + getExpressionOperator(i) + element[1] + getExpressionOperator(
                                j) + element[2];
                        }
                        if ((getExpressionOperator(k) === '*' || getExpressionOperator(k) === '\/') && (
                                getExpressionOperator(j) === '+' || getExpressionOperator(j) === '-')) {
                            expressionItem = '(' + expressionItem + ')' + getExpressionOperator(k) + element[3];
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
            result1 = neval(element[0] + operArr[i] + '(' + element[1] + ')'); //result1 = (n1?n2)
            for (var k = 0; k < operArr.length; k++) {
                if (element[3] == 0 && operArr[k] === '\/') {
                    continue;
                }
                if (haveAnswerFlag) {
                    break;
                }
                result2 = neval(element[2] + operArr[k] + '(' + element[3] + ')'); //result1 = (n3?n4)
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
                            } else {
                                expressionItem = element[0] + getExpressionOperator(i) + element[1];
                            }
                            if (getExpressionOperator(k) === '+' || getExpressionOperator(k) === '-') {
                                expressionItem = expressionItem + getExpressionOperator(j) + '(' + element[2] +
                                    getExpressionOperator(k) + element[3] + ')';
                            } else {
                                expressionItem = expressionItem + getExpressionOperator(j) + element[2] +
                                    getExpressionOperator(k) + element[3];
                            }
                        } else {
                            expressionItem = element[0] + getExpressionOperator(i) + element[1] + getExpressionOperator(
                                j) + element[2] + getExpressionOperator(k) + element[3];
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

<script Language="JavaScript" src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="text/javascript">
wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo $appid ?>', // 必填，公众号的唯一标识
    timestamp: '<?php echo $timestamp ?>', // 必填，生成签名的时间戳
    nonceStr: '<?php echo $nonceStr ?>', // 必填，生成签名的随机串
    signature: '<?php echo $sha_str ?>', // 必填，签名
    jsApiList: ['scanQRCode', 'startRecord', 'stopRecord', 'uploadVoice', 'onVoiceRecordEnd', 'translateVoice',
        'updateAppMessageShareData','updateTimelineShareData'] // 必填，需要使用的JS接口列表
});

wx.ready(function() {
    wx.updateAppMessageShareData({
        title: '24点计算器',
        desc: 'Powered by ASRIBS.COM',
        link: 'https://asribs.com/pages/tools/wx24calculator.php',
        imgUrl: 'https://asribs.com/images/Asribs.png',
        success: function() {
            // 设置成功
            alert("updateAppMessageShareData success");
        }
    })
    wx.updateTimelineShareData({
        title: '24点计算器',
        link: 'https://asribs.com/pages/tools/wx24calculator.php',
        imgUrl: 'https://asribs.com/images/Asribs.png', // 分享图标
        success: function() {
            // 设置成功
            alert("updateTimelineShareData success");
        }
    })
});

// wx.error(function(res) {
//     // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
// });

// wx.checkJsApi({
//     jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
//     success: function(res) {
//         // 以键值对的形式返回，可用的api值true，不可用为false
//         // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
//     }
// });

function test() {
    console.log('ok啦');
    wx.scanQRCode({
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function(res) {
            var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            console.log(result);
        }
    });
}

//开始微信语音上传
function translateVoiceStart() {
    wx.startRecord({
        this.$wx.onVoiceRecordEnd({
            // 录音时间超过一分钟没有停止的时候会执行 complete 回调
            complete: function(res) {
                //this.resetVoiceOption();
                this.uploadVoice(res.localId);
            }
        });
    });
}

//结束微信语音上传并智能识别
function translateVoiceEndAndTranslate() {
    wx.stopRecord({
        success: function(res) {
            var recordLocalId = res.localId;
            wx.translateVoice({
                localId: recordLocalId, // 需要识别的音频的本地Id，由录音相关接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function(res) {
                    alert(res.translateResult); // 语音识别的结果
                }
            });
        }
    });
}
</script>

</html>