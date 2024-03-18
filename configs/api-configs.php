<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Set Database Configurations</title>
<link rel="icon" href="<?php echo $website_link; ?>/assets/media/favicon.png">
<link rel="stylesheet" href="<?php echo $website_link; ?>/assets/css/font-awesome.min.css">
<style>
* {
    border: 0;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
@font-face {
    font-family: 'CustomFontEnglish';
    src: url('assets/fonts/inter-regular.ttf') format('truetype');
}
html {
    text-rendering: optimizeLegibility;
    -webkit-font-kerning: normal;
    font-kerning: normal;
    -webkit-text-size-adjust: 100%;
    -moz-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    text-size-adjust: 100%;
}
body {
    margin: 0;
    border: 0;
    background-color: #F0F0F1 !important;
    font-family: 'CustomFontEnglish', sans-serif, arial;
    color: #333333;
    font-size: 16px;
}
select {
    color: #44443d;
    padding: 0 5px;
    border: 1px solid rgb(203, 203, 203);
    height: 35px;
    width: 100%;
    outline: none;
    font-size: 16px;
    text-align: left;
    background-color: #f5f5f5;
    border-radius: 4px;
    font-size: 16px;
}
button {
    background: rgba(207, 216, 220, 0.5);
    padding: 7px 15px;
    border: 1px solid #208296;
    color: #208296;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    white-space: nowrap;
    margin-top: 20px;
    margin-right: 10px;
}
button:hover {
    background-color: #f5f5f5;
}
table{
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
}
table td,.table th{
    padding: 15px 15px 15px 15px;
    text-align: left;
    font-size:16px;
    vertical-align: top;
}
table tr{
    margin-bottom: 0px;
    display: block;
}
table td:first-child {
    width: 160px;
}
table td:nth-child(2) input {
    width: 300px;
    vertical-align: top;
    margin-right: 20px;
    margin-bottom: 5px;
}
.table-description {
    width: 320px;
    display: inline-block;
    font-size: 14px;
}
input {
    width: 100%;
    height: 30px;
    outline: none;
    border: 1px solid #cccccc;
    padding: 0px 5px;
    font-size: 14px;
    color: #333;
    border-radius: 4px;
}
input:focus {
    border: 1px solid #0F2F59;
}
@media screen and (max-width: 920px) {
    table td:nth-child(2) input {
        max-width: 350px;
        width: 100%;
    }
    .table-description {
        width: auto;
    }
}
.alpha-container-div {
    padding: 5px;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.main-container-div {
    max-width: 900px;
    background-color: #ffffff;
    padding: 10px;
    border-radius: 4px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    overflow: auto;
}
.heading-display-div {
    padding: 10px;
}
.heading-display-div > h2, h3 {
    margin-bottom: 30px;
    border-bottom: 1px solid #cccccc;
    padding-bottom: 10px;
}
.form-error-msg {
    text-align: left;
    background-color: rgba(255, 57, 57, 0.10);
    color: red;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid red;
    font-size: 16px;
    margin-bottom: 20px;
}
.form-error-msg a {
    font-size: 14px;
    display: block;
    margin-top: 3px;
}
.form-button-div {
    display: flex;
    flex-direction: row-reverse;
    float: left;
    margin-bottom: 10px;
}
</style>
</head>
<body>
<?php
//add all includes here:
include_once("functions/input-sanitizer.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST["submit-btn"]) AND (isset($_POST['api-url']))) {

        $api_master_url = clean_inputs($_POST['api-url']);
        $api_config_file = "<?php
\$api_master_url = '$api_master_url';";

        if (!empty($api_master_url)) {
            //check api url:
            $api_url_chk = "$api_master_url/app/v1/show_subject_area";
            $method = "GET";
            $token = null;
            $data = null;
            $allSubjects = apiCalling($api_url_chk, $token, $method, $data);
            if (isset($allSubjects['status']) && $allSubjects['status'] == 200) {

                //create api url file:
                $file_name = fopen('configs/api-url.php', 'wb');
                if (fwrite($file_name, $api_config_file)) {
                    fclose($file_name);

                    header("location: ./"); // refresh page
                }

            } else {
                $error_head = "Connection Failed!";
                $error_text = "Without correct API URL this site can not be functional.";
            }
        } else {
            $error_head = "Enter REST API URL!";
            $error_text = "Without API URL this site can not be functional.";
        }
    }
}
?>
<div class="alpha-container-div">
    <div class="main-container-div">
        <div class="heading-display-div">
            <h3>API Configurations:</h3>
            <div id="db-config-data">
                <?php
                if (isset($error_head) OR isset($error_text)) {
                    echo "
                <div class='form-error-msg'>
                <b>{$error_head}</b><br/>
                <a><i class='fa fa-lightbulb-o'></i> {$error_text}</a>
                </div>
                ";
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>API URL</strong>
                                </td>
                                <td>
                                    <input type="text" name="api-url" value="" required>
                                    <div class="table-description">
                                        <a>Enter the REST API URL here.<br/> e.g. https://localhost/cyber-pulse-backend</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-button-div">
                        <button type="submit" name="submit-btn" id="submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>