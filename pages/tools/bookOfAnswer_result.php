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




        <?php
  $link = mysqli_connect('b-4wgbneeca75xlj.bch.rds.bj.baidubce.com','b_4wgbneeca75xlj','1qaz!QAZ','b_4wgbneeca75xlj','3306'); 
  if (mysqli_connect_errno($link)) 
  { 
      echo "连接 MySQL 失败: " . mysqli_connect_error(); 
  } 
 if ($link)
 {
     $answer_page_num=$_POST['boa-button-hidden-number'];
     $sql =  "select * from bookOfAnswer_answers where answer_page = '{$answer_page_num}'";
     $res = mysqli_query($link,$sql);
     while($rows = mysqli_fetch_assoc($res)){
         echo "<div id=\"boa-chinese-sub-content\" class=\"sub-content\">
            <div class=\"sub-content-title bookOfAnswer_chinese\">";
         echo $rows["answer_chinese"];
         echo "</div>
         <div class=\"sub-content-body\">
         </div>
     </div>";
      
     echo " <div id=\"boa-english-sub-content\" class=\"sub-content\">
     <div class=\"sub-content-title bookOfAnswer_english\">";
     echo $rows["answer_english"];
         echo "</div>
 </div>";

       
        echo "<br/>";   
    }
 };
 mysqli_close($con);
?>
    </div>
    <div class="sub-content-body">
        <form id="formBookOfAnswer_result" action="bookOfAnswer_result.php" method="post">
            <input type="hidden" id="boa-button-hidden-number" name="boa-button-hidden-number" value="">
            <button type="button" onclick="btnGetAnswer()" class="ant-btn ant-btn-black">获取答案</button>
        </form>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {


});
//按钮点击事件
function btnGetAnswer() {
    $("#boa-button-hidden-number").val(randomNum(1, 183));
    document.getElementById("formBookOfAnswer_result").submit(); 
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