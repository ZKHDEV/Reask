<?php
/*
  文件过大需修改php.ini上传大小配置
*/
function upload($file_name)
{
  if (strtolower(substr($_FILES["file"]["name"],-4)) == ".apk")
  {
    if ($_FILES["file"]["error"] > 0)
    {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
      die;
      }
    else
    {
    if (file_exists("apk/" . $file_name))
      {
        header('Refresh:3;URL=add.php');
        echo $file_name . " 已经存在 ";
        die;
      }
    else
      {
        if(!move_uploaded_file($_FILES["file"]["tmp_name"],"apk/" . $file_name))
        {
          header('Refresh:3;URL=add.php');
          echo "文件上传失败";
          die;
        }

        return $file_name;
      }
    }
  }
  else
  {
    header('Refresh:3;URL=add.php');
    echo "文件格式错误";
    die;
  }
}