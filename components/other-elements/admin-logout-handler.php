<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["logout-btn"])) {

    setcookie('token', '', time() - 3600, '/');
    unset($_COOKIE['token']);
    header("Location: login");
}