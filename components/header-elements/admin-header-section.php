<?php
//admin logout:
require('components/other-elements/admin-logout-handler.php');
?>
<div class="header-div-cover-container">
    <div class="header-div-left-container">
        <a class="header-nav-btn" onclick="navButtonToggle()"><i class="fa fa-navicon"></i></a>
        <a class="header-site-logo" href="<?php echo $website_link; ?>/dashboard"><img src="<?php echo $website_link; ?>/assets/media/site-logo.png" height="40"></a>
        <a class="header-site-logo-small" href="<?php echo $website_link; ?>/dashboard"><img src="<?php echo $website_link; ?>/assets/media/site-logo-small.png" height="40"></a>
    </div>
    <div class="header-div-right-container">
        <div class="header-div-right-left-element"></div>
        <div class="header-div-right-right-element">
            <span class="header-profile-text"><?php echo $userData['name'] ?></span>
            <a class="header-profile-name" href="<?php echo $website_link; ?>/members"></a>
            <form method="post" enctype="multipart/form-data" action="">
                <button class="header-logout-btn" type="submit" name="logout-btn">Logout <i class="fa fa-sign-out"></i></button>
            </form>
        </div>
    </div>
</div>
