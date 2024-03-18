<?php
//session started here:
session_start();
session_regenerate_id(true);

//add basic includes here:
require('configs/canonical-link.php'); //canonical
require('controller/route-controller.php'); //router
require("functions/input-sanitizer.php");
require("configs/api-url.php");

//api handler:
require("api/api-form-handler.php");

//add all dashboard page here with the level of $url[0]:
if (empty($api_master_url)) { //configure database info.
    require_once("configs/api-configs.php");

} elseif (empty($url[0]) OR $url[0] == "login") {
    require("pages/admin/admin-login-page.php");

} elseif ($url[0] == "submissions") {
    require("pages/admin/admin-submission-page.php");

} elseif ($url[0] == "map") {
    require("pages/admin/admin-map-page.php");

} elseif ($url[0] == "settings") {
    require("pages/admin/admin-settings-page.php");

} elseif ($url[0] == "members") {
    require("pages/admin/admin-member-page.php");

} else {
    require("pages/404-page.php");
}