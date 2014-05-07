<!-- This file contains the structure of the header, which is to be included in almost all pages for this website-->
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Social Travel Guide</title>
<link href="<?php echo $host . $app_path?>css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $host . $app_path?>js/jquery-ui-1.10.4/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
<script src="<?php echo $host . $app_path?>js/jquery-ui-1.10.4/jquery-1.10.2.js"></script>
<script src="<?php echo $host . $app_path?>js/jquery-ui-1.10.4/ui/jquery-ui.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByKHFIg_YhjM-zQLygRug7U1I1aLb-qjY&sensor=false">
</script>
<!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script src="<?php echo $host . $app_path?>js/colorbox-master/jquery.colorbox-min.js"></script>
</head>

<body>
<div id="wrapper">
	<div id="banner">
    <img class="logo" src="<?php echo $host . $app_path?>images/logo.jpg" alt="logo.jpg">
    <img class="megaphone" src="<?php echo $host . $app_path?>images/megaphone.jpg" alt="megaphone">
    <h1 id="title" class="text_center">Social Travel Guide</h1>
    <!-- Links to navigate around the website -->
        <ul id="main_menu" class="menu">
            <li><a href="<?php echo $host . $app_path; ?>">Home</a></li>
            <!--<li><a href="../itineraries.php">Itineraries</a></li>-->
            <li><a href="<?php echo $host . $app_path; ?>/view/about.php">About</a></li>
            <li><a href="<?php echo $host . $app_path; ?>/view/contact.php">Contact</a></li>
        </ul>
    </div> <!-- end banner -->   