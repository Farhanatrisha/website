<?php //set sub pages in the array:
if (!in_array($url[1], array(""), TRUE)) {require("pages/404-page.php");die();} else {/*OK*/}
//checking token:
require("components/other-elements/admin-token-check.php");

//api: get all subjects
$api_url = "$api_master_url/app/v1/show_subject_area";
$method = "GET";
$token = null;
$data = null;
$allSubjects = apiCalling($api_url, $token, $method, $data);

//api: submit add subject
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["subject-btn"])) {

    $api_url = "$api_master_url/app/v1/add_subject_area";
    $method = "POST";
    $token = $_COOKIE['token'];
    $data = array(
        'subject_name' => clean_inputs($_POST['subject'])
    );
    $formRespond = apiCalling($api_url, $token, $method, $data);
    //session:
    $_SESSION["form-status"] = $formRespond["status"];
    $_SESSION["form-message"] = $formRespond["message"];
    header("Location: ".$canonical_link);
    exit();
}

//api: submit delete subject
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["delete-btn"])) {

    $subjectId = clean_inputs($_POST['id']);
    $api_url = "$api_master_url/app/v1/delete_subject_area/$subjectId";
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
<title>Settings - CyberPulse University</title>
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
                        <h3>Site Settings</h3>
                        <?php require('components/other-elements/admin-page-navigation.php'); ?>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>Add New Subject</p>
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="login-user-div-add-member form-group">
                                <div class="form-input-column-div">
                                    <p>Subject Name</p>
                                    <input type="text" name="subject" required>
                                </div>
                                <div class="form-input-column-div">
                                    <p>&nbsp;</p>
                                    <button type="submit" class="button" name="subject-btn"><i class="fa fa-plus icon"></i> Add Subject</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>See All Subjects</p>
                        <div class="table-container">
                            <table>
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($allSubjects['data'])) {
                                    foreach ($allSubjects['data'] as $allSubject) {
                                        echo '
                                    <td>' . $allSubject['subject_name'] . '</td>
                                    <td>
                                    <form id="delete-form-' . $allSubject['id'] . '" method="post" enctype="multipart/form-data" action="">
                                        <input type="hidden" name="id" value="' . $allSubject['id'] . '" autocomplete="off" required>
                                        <button type="submit" class="button delete-btn" name="delete-btn" data-form-id="' . $allSubject['id'] . '"><i class="fa fa-trash-o icon"></i>Remove</button>
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