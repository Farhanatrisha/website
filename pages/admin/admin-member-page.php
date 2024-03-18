<?php //set sub pages in the array:
if (!in_array($url[1], array(""), TRUE)) {require("pages/404-page.php");die();} else {/*OK*/}
//checking token:
require("components/other-elements/admin-token-check.php");

//api: get all admins
$api_url = "$api_master_url/app/v1/show_all_admins";
$method = "GET";
$token = $_COOKIE['token'];
$data = null;
$allAdmins = apiCalling($api_url, $token, $method, $data);

//api: submit admin registration
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["member-btn"])) {

    $api_url = "$api_master_url/app/v1/admin_register";
    $method = "POST";
    $token = $_COOKIE['token'];
    $data = array(
        'admin_name' => clean_inputs($_POST['name']),
        'admin_email' => clean_inputs($_POST['email']),
        'admin_password' => clean_inputs($_POST['password']),
        'admin_role' => clean_inputs($_POST['role'])
    );
    $formRespond = apiCalling($api_url, $token, $method, $data);
    //session:
    $_SESSION["form-status"] = $formRespond["status"];
    $_SESSION["form-message"] = $formRespond["message"];
    header("Location: ".$canonical_link);
    exit();
}

//api: delete an admin
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["delete-btn"])) {

    $userId = clean_inputs($_POST['id']);
    $api_url = "$api_master_url/app/v1/delete_single_admin/$userId";
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
<title>Members - CyberPulse University</title>
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
                        <h3>Members</h3>
                        <?php require('components/other-elements/admin-page-navigation.php'); ?>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>Your Information</p>
                        <div class="login-user-div">
                            <div class="form-input-column">
                                <div class="form-input-column-div">
                                    <p>Name</p>
                                    <a><?php echo $userData["name"] ?></a>
                                </div>
                                <div class="form-input-column-div">
                                    <p>Email</p>
                                    <a><?php echo $userData["email"] ?></a>
                                </div>
                                <div class="form-input-column-div">
                                    <p>Role</p>
                                    <a><?php echo $userData["role"] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>Add New Member</p>
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="login-user-div-add-member form-group">
                                <div class="form-input-column-div">
                                    <p>Name</p>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="form-input-column-div">
                                    <p>Email</p>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-input-column-div">
                                    <p>Password</p>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="form-input-column-div">
                                    <p>Role</p>
                                    <select name="role" required>
                                        <option value="" hidden selected>Select</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                <div class="form-input-column-div">
                                    <p>&nbsp;</p>
                                    <button type="submit" class="button" name="member-btn"><i class="fa fa-user-plus icon"></i> Add Member</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="dashboard-content-container-div">
                        <p>See All Members</p>
                        <div class="table-container">
                            <table>
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($allAdmins['data'])) {
                                foreach ($allAdmins['data'] as $allAdmin) {
                                    echo '
                                    <td>' . $allAdmin['name'] . '</td>
                                    <td>' . $allAdmin['email'] . '</td>
                                    <td>' . $allAdmin['role'] . '</td>
                                    <td>
                                    <form id="delete-form-' . $allAdmin['user_id'] . '" method="post" enctype="multipart/form-data" action="">
                                        <input type="hidden" name="id" value="' . $allAdmin['user_id'] . '" autocomplete="off" required>
                                        <button type="submit" class="button delete-btn" name="delete-btn" data-form-id="' . $allAdmin['user_id'] . '"><i class="fa fa-trash-o icon"></i>Remove</button>
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