<?php
function replace_dash_with_space($data) {
    $data = htmlspecialchars($data);
    $data = str_replace("-", " ", $data);
    return $data;
}
