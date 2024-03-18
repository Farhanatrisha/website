<?php
function apiCalling($url, $token, $method, $data) {

    //url section:
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //method section:
    if ($method == "GET") { //GET method
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

    } else { //POST method
        $data = http_build_query($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    //get response:
    $response = curl_exec($ch);
    curl_close($ch);

    //response output:
    if ($response) {
        $responseData = json_decode($response, true);
        return $responseData;
    }

}