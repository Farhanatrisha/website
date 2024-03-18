<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit-btn"])) {

    $url = "$api_master_url/app/v1/admin_login";
    $method = "POST";
    $token = null;
    $data = array(
        'admin_email' => clean_inputs($_POST['email']),
        'admin_password' => clean_inputs($_POST['password'])
    );
    $formRespond = apiCalling($url, $token, $method, $data);

    //receive token & store into cookie:
    if (isset($formRespond['status']) && ($formRespond['status'] == "200")) {
        $receivedToken = $formRespond['token'];
        $tokenExpire = time() + 60 * 60 * 24 * 7; //7 days
        setcookie("token", $receivedToken, $tokenExpire, "/", "", "true", "true");
        header('Location: submissions');
    }
}