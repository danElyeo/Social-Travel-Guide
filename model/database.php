<?php
$dsn = 'mysql:host=localhost;dbname=social_travel_guide';
//$username = 'mgs_user';
//$password = 'pa55word';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include '../errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    //global $app_path;
    include '../errors/db_error.php';
    exit;
}
?>