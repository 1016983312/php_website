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
            <div class=\"sub-content-title\">";
         echo $rows["answer_chinese"];
         echo "</div>
         <div class=\"sub-content-body\">
         </div>
     </div>";
      
     echo " <div id=\"boa-english-sub-content\" class=\"sub-content\">
     <div class=\"sub-content-title\">";
     echo $rows["answer_english"];
         echo "</div>
 </div>";

       
        echo "<br/>";   
    }
 };
 mysqli_close($con);
?>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    //按钮点击事件
    function btnGetAnswer() {

    };

});
</script>

</html>