<?php
$serverLink = $_SERVER['REQUEST_URI'];
$serverUrl = $_SERVER['QUERY_STRING'];

//filter url for '/' and '//':
if (stripos(strtolower($serverLink), '//') !== false) {
    $url_new = str_replace('//', '', $serverLink);
    $url_new = rtrim($url_new, '/');
    echo "<script type='text/javascript'> document.location = '{$url_new}'; </script>";
}

$serverModUrl = rtrim($serverUrl, '/');  //remove last '/'.
$routerUrl = str_replace('url=', '', $serverModUrl);
$url = explode("/", $routerUrl);

//set empty value to avoid offset error up to $url[5]:
for ($i = 0; $i < 5; $i++) {
    if (!isset($url[$i])) {
        $url[$i] = "";
    }
}
