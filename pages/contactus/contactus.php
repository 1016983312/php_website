<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>联系我们</title>
    <link rel="stylesheet" type="text/css" href="css/contactus.css">
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div class="content">
        <div class="sub-content-title">
            联系我们
        </div>
        <div class="">
        From:<br>
        <input type="text"><p>
        To:<br>
        <input type="text"><p>
        Subject:<br>
        <input type="text"><p>
        Body:<br>
        <input type="text"><p>
        <a onclick="sendMailClick()" id="sendMail" class="button button-raised button-pill button-inverse">发送</a>
        </div>
    </div>
</body>
<script type="text/javascript">

//按钮点击事件
function sendMailClick() {
    alert("Send success ! ")
    };
</script>

</html>