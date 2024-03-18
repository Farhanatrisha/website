<?php
if (empty($_COOKIE['token'])) {
    header("Location: login");
    exit();

} else {
    //payload data extractor:
    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    $token = $_COOKIE['token'];
    $token_parts = explode('.', $token);
    $userData = json_decode(base64url_decode($token_parts[1]), true);
    return $userData;
}
