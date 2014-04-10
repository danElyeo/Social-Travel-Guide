<!-- This file contains the structure of the header, which is to be included in almost all pages for this website-->
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Social Travel Guide</title>
<link href="<?php echo $app_path?>css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="wrapper">
	<div id="banner">
    <img class="logo" src="<?php echo $app_path?>images/logo.jpg" alt="logo.jpg">
    <img class="megaphone" src="<?php echo $app_path?>images/megaphone.jpg" alt="megaphone">
    <h1 id="title" class="text_center">Social Travel Guide</h1>
    <!-- Links to navigate around the website -->
        <ul id="main_menu" class="menu">
            <li><a href="<?php echo $app_path?>">Home</a></li>
            <li><a href="../itineraries.php">Itineraries</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li>
        </ul>
    </div> <!-- end banner -->
