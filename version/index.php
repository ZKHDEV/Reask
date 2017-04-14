<?php
    header('Content-Type:text/html;charset=utf-8');
    require_once("tool/SqlHelper.php");

    $dal=new DAL;
    $sql="select * from `reask_version` order by version_code desc limit 1";
    $result=$dal::query($sql);
    $version=$result->getAllRows()[0];

    $version_name = isset($_GET['version_name']) ? $_GET['version_name']:'';
    if(!empty($version_name))
    {
        $islast = $version['version_code'] > $version_name ? false : true;
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>版本信息</title>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="./assets/css/index.css">
    </head>

    <body>
        <img src="./assets/images/bg.png" class="back">
        <div class="content">
            <p class="version-title">V<?php echo $version['version_code'];?>
            </p>
            <div class="detail">
                更新详情：<br>
                <?php echo str_replace(';','<br>',$version['version_detail']);?>
            </div>
            <?php 
            if(isset($islast) && $islast){
                echo "<a class='download-btn disable-btn' disabled='disabled'>已是最新版本</a>";
            }else{
                $version_url='./apk/'.$version['version_apkname'].'.apk';
                echo "<a href='$version_url' class='download-btn'>下载</a>";
            }
        ?>
        </div>
        
        <script src="./assets/js/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/index.js"></script>
    </body>

    </html>