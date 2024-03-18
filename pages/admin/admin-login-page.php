<?php //set sub pages in the array:
if (!in_array($url[1], array(""), TRUE)) {require("pages/404-page.php");die();} else {/*OK*/}

//cookie checking:
if(isset($_COOKIE['token'])) {
    header("Location: submissions");
    exit();
}

//api: login submission form
require("components/other-elements/admin-login-handler.php");

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Login - CyberPulse University</title>
<link rel="icon" href="<?php echo $website_link; ?>/assets/media/favicon.png">
<?php require('components/header-elements/admin-header-scripts.php'); ?>
</head>
<body>
<div class="main-container-wrapper">
    <div class="main-container-div">
        <div class="form-container">
            <div class="form-introduction">
                <a href="<?php echo $website_link; ?>"><img src="<?php echo $website_link; ?>/assets/media/site-logo.png"></a>
                <h3>Login to admin dashboard</h3>
            </div>
            <div id="form-display-message">
                <?php
                if(isset($formRespond['status']) && ($formRespond['status']=="422" OR $formRespond['status']=="500")) {
                    echo '
                <div class="form-error-msg">
                    <p>'. $formRespond["message"] .'</p>
                </div>
                ';
                }
                ?>
            </div>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="button" name="submit-btn">Login<i class="fa fa-arrow-circle-right icon"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require('components/footer-elements/admin-footer-scripts.php'); ?>
</body>
</html>