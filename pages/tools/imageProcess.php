<?php  
require_once 'AipImageProcess.php';

// 你的 APPID AK SK
const APP_ID = '24327231';
const API_KEY = 'gyGimPqi9Y0Pk5loAii9XMyb';
const SECRET_KEY = 'gr1KWSdRzBtq4sb8OTeGL247IMmlLTYu';

$client = new AipImageProcess(APP_ID, API_KEY, SECRET_KEY);
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图片优化处理</title>
    <link rel="stylesheet" type="text/css" href="css/webuploader.css">
    <script type="text/javascript" src="../../assets/webuploader/webuploader.nolog.js"></script>
</head>

<body>
    <div class="menu">
        <?php include '../../components/navigator.php';?>
    </div>
    <div id="date-calc-content" class="content">
        <div id="date-calc-diff-content" class="sub-content">
            <div id="uploader-image-1">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/assets/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: 'http://webuploader.duapp.com/server/fileupload.php',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
});
</script>

</html>