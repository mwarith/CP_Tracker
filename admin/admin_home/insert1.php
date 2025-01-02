<?php
require_once 'functions.php';
// var_dump($_POST);
$title = $_POST['news-title'];
$content = $_POST['news-content'];
add_news($title, $content);
header('location: home_admin.php');
?>