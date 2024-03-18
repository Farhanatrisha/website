<?php //set sub pages in the array:
if (!in_array($url[1], array(""), TRUE)) {require("pages/404-page.php");die();} else {/*OK*/}
//checking token:
require("components/other-elements/admin-token-check.php");

//api: get all admins
$api_url = "$api_master_url/app/v1/show_all_form_data";
$method = "GET";
$token = $_COOKIE['token'];
$data = null;
$allForms = apiCalling($api_url, $token, $method, $data);

//api: submit delete form
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["delete-btn"])) {

    $userId = clean_inputs($_POST['id']);
    $api_url = "$api_master_url/app/v1/delete_single_form/$userId";
    $method = "POST";
    $token = $_COOKIE['token'];
    $data = null;
    $formRespond = apiCalling($api_url, $token, $method, $data);
    //session:
    $_SESSION["form-status"] = $formRespond["status"];
    $_SESSION["form-message"] = $formRespond["message"];
    header("Location: ".$canonical_link);
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Submissions - CyberPulse University</title>
<link rel="icon" href="<?php echo $website_link; ?>/assets/media/favicon.png">
<?php require('components/header-elements/admin-header-scripts.php'); ?>
</head>
<body>
<?php require('components/header-elements/admin-header-section.php'); ?>
<div class="main-container-box-div">
    <div class="main-container-cover">
        <div class="main-first-container" id="main-first-container">
            <?php require('components/other-elements/admin-sidebar-panel.php'); ?>
        </div>
        <div class="main-snd-container" id="main-snd-container">
            <div class="dashboard-content-main-container">
                <div class="dashboard-content-start">
                    <div class="page-header-title-nav">
                        <h3>Form Submissions</h3>
                        <?php require('components/other-elements/admin-page-navigation.php'); ?>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>All Submitted Forms</p>
                        <div class="table-container">
                            <table>
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birth Date</th>
                                    <th>Interested Area</th>
                                    <th>Marketing</th>
                                    <th>Correspondence</th>
                                    <th>Submission Date</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($allForms['data'])) {
                                    foreach ($allForms['data'] as $allForm) {
                                        echo '
                                    <td>' . $allForm['name'] . '</td>
                                    <td>' . $allForm['email'] . '</td>
                                    <td>' . $allForm['birth_date'] . '</td>
                                    <td>' . $allForm['interested_area'] . '</td>
                                    <td>' . $allForm['marketing_updates'] . '</td>
                                    <td>' . $allForm['correspondence'] . '</td>
                                    <td>' . $allForm['submitted_date'] . '</td>
                                    <td>
                                    <form id="delete-form-' . $allForm['form_id'] . '" method="post" enctype="multipart/form-data" action="">
                                        <input type="hidden" name="id" value="' . $allForm['form_id'] . '" autocomplete="off" required>
                                        <button type="submit" class="button delete-btn" name="delete-btn" data-form-id="' . $allForm['form_id'] . '"><i class="fa fa-trash-o icon"></i>Remove</button>
                                    </form>
                                    </td>
                                </tr>
                                ';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
//show the response status:
if((isset($_SESSION["form-status"])) && ($_SESSION["form-status"]=="200" OR $_SESSION["form-status"]=="201")) {
    echo '<div class="notification success" id="pushNotification">
<span><i class="fa fa-check"></i> '. $_SESSION["form-message"] .'</span>
</div>';
}
if(isset($_SESSION["form-status"]) && ($_SESSION["form-status"]=="401" OR $_SESSION["form-status"]=="422" OR $_SESSION["form-status"]=="500")) {
    echo '<div class="notification failed" id="pushNotification">
<span><i class="fa fa-warning"></i> '. $_SESSION["form-message"] .'</span>
</div>';
}
unset($_SESSION["form-status"]);
unset($_SESSION["form-message"]);
?>
<?php require('components/footer-elements/admin-footer-scripts.php'); ?>
</body>
</html>