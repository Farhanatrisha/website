<?php //set sub pages in the array:
if (!in_array($url[1], array(""), TRUE)) {require("pages/404-page.php");die();} else {/*OK*/}

//checking token:
require("components/other-elements/admin-token-check.php");

//api: get form data end extract location:
$api_url = "$api_master_url/app/v1/show_all_form_data";
$method = "GET";
$token = $_COOKIE['token'];
$data = null;
$allForms = apiCalling($api_url, $token, $method, $data);

$markers = array();
if (isset($allForms['data'])) {
    foreach ($allForms['data'] as $location) {
        $markers[] = array(
            'lat' => $location['latitude'],
            'lng' => $location['longitude']
        );
    }
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
<title>Map - CyberPulse University</title>
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
                        <h3 style="margin-bottom: 10px;">Location of Submissions:</h3>
                        <div id="map"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
var markers = <?php echo json_encode($markers); ?>;
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 0, lng: 0},
        zoom: 2
    });

    // Add markers to the map
    markers.forEach(function(marker) {
        new google.maps.Marker({
            position: {lat: parseFloat(marker.lat), lng: parseFloat(marker.lng)},
            map: map
        });
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvMuFhq98_GDFupIZbrnVy_QwW858eDso&callback=initMap"></script>
<?php require('components/footer-elements/admin-footer-scripts.php'); ?>
</body>
</html>