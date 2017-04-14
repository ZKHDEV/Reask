<?php
require_once("tool/CheckLogin.php");
checkLogin();
$version_id = isset($_GET['id']) ? $_GET['id']:'';
if(!empty($version_id))
{
    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    $sql="delete from reask_version where version_id=?";
    $params=array($version_id);
    $dal::delete($sql,$params);
    header('Location:admin.php');
}