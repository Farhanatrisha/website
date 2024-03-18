<div class="page-navigation">
    <?php
    require_once("functions/dash-into-space.php");
    $output = '<i class="fa fa-link"></i> <a href="'.$website_link.'/dashboard">Dashboard</a>';

    if (!empty($url[0] && $url[0] != "dashboard")) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]'>".replace_dash_with_space($url[0])."</a>";
    } else {
        $output .= "";
    }
    if (!empty($url[1])) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]/$url[1]'>".replace_dash_with_space($url[1])."</a>";
    }
    if (!empty($url[2])) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]/$url[1]/$url[2]'>".replace_dash_with_space($url[2])."</a>";
    }
    if (!empty($url[3])) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]/$url[1]/$url[2]/$url[3]'>".replace_dash_with_space($url[3])."</a>";
    }
    if (!empty($url[4])) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]/$url[1]/$url[2]/$url[3]/$url[4]'>".replace_dash_with_space($url[4])."</a>";
    }
    if (!empty($url[5])) {
        $output .= "<i class='fa fa-angle-right'></i> <a href='$website_link/$url[0]/$url[1]/$url[2]/$url[3]/$url[4]/$url[5]'>".replace_dash_with_space($url[5])."</a>";
    }
    echo $output;
    ?>
</div>
