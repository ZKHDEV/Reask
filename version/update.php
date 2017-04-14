<?php
    require_once("tool/CheckLogin.php");
    checkLogin();
    header('Content-Type:text/html;charset=utf-8');

    if(empty($_GET))
    {
        echo '信息不存在';
        die;
    }

    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    if(!empty($_POST))
    {
        foreach($_POST as $item)
        {
            if(empty($item))
            {
                header('Refresh:3;URL=update.php'.'?id='.$_GET['id']);
                echo '每一项都不能为空';
                die;
            }
        }

        $sql="select * from `reask_version` where version_code=? and version_id!=?";
        $params=array($_POST['version_code'],$_POST['version_id']);
        $result=$dal::query($sql,$params);
        $res=$result->getAllRows();
        if(!empty($res))
        {
            header('Refresh:3;URL=update.php'.'?id='.$_GET['id']);
            echo '版本号已存在';
            die;
        }

        $_POST['version_date']=date("Y-m-d H:i:s");

        $sql="update reask_version set version_code=?,version_detail=?,version_date=?";
        $params=array($_POST['version_code'],$_POST['version_detail'],$_POST['version_date']);
        $lastInsertId=$dal::update($sql,$params);
        if($lastInsertId)
        {
            header('Refresh:1;URL=admin.php');
            echo '修改成功';
            die;
        }
        else
        {
            header('Refresh:3;URL=update.php'.'?id='.$_GET['id']);
            echo '修改失败，请重试';
            die;
        }
    }
    else
    {
        $sql="select * from reask_version where version_id=?";
        $dbrecordset=$dal::query($sql,$_GET['id']);
        $version=$dbrecordset->next();
        if(empty($version))
        {
            echo '信息不存在';
            die;
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>修改版本</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/back.css">
    </head>

    <body>
        <div class="container">
            <h2>修改版本 <a href="admin.php" class="btn btn-danger btn-xs">返回</a></h2>
            <hr>
            <div class="col-md-4">
                <form class="updateform" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="version_id" id="version_id" value="<?php echo $version['version_id'];?>">
                    <div class="form-group">
                        <label for="version_code">版本号*</label>
                        <input type="text" name="version_code" id="version_code" class="form-control" autofocus="autofocus" required="required" maxlength="10" value="<?php echo $version['version_code'];?>">
                    </div>
                    <div class="form-group">
                        <label for="version_detail">更新详情(使用半角分号表示换行)*</label>
                        <textarea name="version_detail" id="version_detail" class="form-control" cols="30" rows="6" required="required"><?php echo $version['version_detail'];?></textarea>
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