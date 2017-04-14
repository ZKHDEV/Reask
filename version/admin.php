<?php
    require_once("tool/CheckLogin.php");
    checkLogin();
    header('Content-Type:text/html;charset=utf-8');
    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    $selectSql="select * from reask_version order by version_code desc";
    $dbrecordset=$dal::query($selectSql);
    $versions=$dbrecordset->getAllRows(); 
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>问忆版本管理</title>
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/back.css">
    </head>

    <body>
        <div class="container">
            <h2>问忆版本管理 <a href="logout.php" class="btn btn-danger btn-xs">注销</a></h2>

            <hr><a style="margin: 20px 0" class="btn btn-success" href="add.php">添加</a><br>
            <table id="admin-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>版本号</th>
                        <th>APK文件名</th>
                        <th>日期</th>
                        <th>更新详情</th>
                        <th>修改</th>
                        <th>删除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($versions as $item):?>
                    <tr>
                        <td>
                            <?php echo $item['version_code'];?>
                        </td>
                        <td>
                            <?php echo $item['version_apkname'];?>
                        </td>
                        <td>
                            <?php echo $item['version_date'];?>
                        </td>
                        <td>
                            <a type="button" class="btn btn-link updetail"
                                        data-container="body" data-toggle="popover" data-placement="left"
                                        data-content="<?php echo str_replace('<br>',';',$item['version_detail']);?>">
                                更新详情
                            </a>
                        </td>
                        <td><a href="update.php?id=<?php echo $item['version_id'];?>">修改</a></td>
                        <td><a href="delete.php?id=<?php echo $item['version_id'];?>" onclick="return confirm('确认删除？');">删除</a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <script src="./assets/js/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/page.js"></script>
        <script>
            $(function (){
                $(".updetail").popover();
            });
        </script>
    </body>

    </html>