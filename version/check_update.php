<?php
$version_name = isset($_GET['versionName']) ? $_GET['versionName']:'';
if(!empty($version_name))
{
        require_once('tool/SqlHelper.php');
        $dal=new DAL;
        $sql="select * from `reask_version` order by version_code desc limit 1";
        $result=$dal::query($sql);
        $version=$result->getAllRows()[0];
        // $version_url='http://'.$_SERVER['HTTP_HOST'].'/version/apk/'.$version['version_apkname'].'.apk';
        $info['newVersion'] = $version['version_code'] > $version_name ? 'true' : 'false';     
        exit(json_encode($info));
}