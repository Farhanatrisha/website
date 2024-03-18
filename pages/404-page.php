<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="web, app, bse, bsepress, webapps, package, service">
<title>Not Found! - CyberPulse University</title>
<link rel="icon" href="<?php echo $website_link; ?>/assets/media/favicon.png">
<?php require('components/header-elements/error-header-scripts.php'); ?>
</head>
<body>
<?php require('components/header-elements/error-header-section.php'); ?>
<div class="main-container-wrapper">
    <div class="main-container-div">
        <div class="main-container-div-content">
            <div class="error-page-div">
                <img src="<?php echo $website_link; ?>/assets/media/page-not-found.svg">
                <div class="error-page-btn-div">
                    <a onclick="history.back();" class="go-back-btn"><i class="fa fa-arrow-circle-left"></i> Go back</a>
                    <a style="margin: 0 10px;font-size: 14px;">Or,</a>
                    <a class="go-home-btn" href="<?php echo $website_link; ?>"><i class="fa fa-home"></i> Go to homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('components/footer-elements/admin-footer-scripts.php'); ?>
</body>
</html>