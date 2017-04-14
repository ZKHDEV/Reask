<?php
    require_once("tool/CheckLogin.php");
    checkLogin();
    header('Content-Type:text/html;charset=utf-8');
    if(!empty($_POST))
    {
        foreach($_POST as $item)
        {
            if(empty($item))
            {
                header('Refresh:3;URL=add.php');
                echo '每一项都不能为空';
                die;
            }
        }

        require_once("tool/SqlHelper.php");
        $dal=new DAL;
        $sql="select * from `reask_version` where version_code=?";
        $params=array($_POST['version_code']);
        $result=$dal::query($sql,$params);
        $version=$result->getAllRows();
        if(!empty($version))
        {
            header('Refresh:3;URL=add.php');
            echo '版本号已存在';
            die;
        }

        $_POST['version_date']=date("Y-m-d H:i:s");
        if($_FILES['file']['error']!==4)
        {
            require_once("tool/Upload.php");
            upload($_POST['version_apkname'].'.apk');
        }
        else
        {
            header('Refresh:3;URL=add.php');
            echo '文件上传失败，请重试';
            die;
        }

        $sql="insert into reask_version values(null,?,?,?,?)";
        $params=array($_POST['version_code'],$_POST['version_apkname'],$_POST['version_detail'],$_POST['version_date']);
        $lastInsertId=$dal::insert($sql,$params);
        if($lastInsertId)
        {
            header('Refresh:1;URL=admin.php');
            echo '添加成功';
            die;
        }
        else
        {
            header('Refresh:3;URL=add.php');
            echo '添加失败，请重试';
            die;
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>添加版本</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/back.css">
    </head>

    <body>
        <div class="container">
            <h2>添加版本 <a href="admin.php" class="btn btn-danger btn-xs">返回</a></h2>
            <hr>
            <div class="col-md-4">
                <form class="versionform" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="version_code">版本号*</label>
                        <input type="text" name="version_code" id="version_code" class="form-control" autofocus="autofocus" required="required" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="version_apkname">APK文件名(不用加后缀名)*</label>
                        <input type="text" name="version_apkname" id="version_apkname" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="apkfile">上传APK*</label>
                        <input type="file" id="apkfile" name="file" onchange="checkfile()">
                    </div>
                    <div class="form-group">
                        <label for="version_detail">更新详情(使用半角分号表示换行)*</label>
                        <textarea name="version_detail" id="version_detail" class="form-control" cols="30" rows="6" required="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-large btn-success" style="margin-bottom: 100px">提交</button>
                    <button type="reset" class="btn btn-large btn-info" style="margin-bottom: 100px">重置</button>
                </form>
            </div>
        </div>
        <script src="./assets/js/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/validate.js"></script>
    </body>

    </html>