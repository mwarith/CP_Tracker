<?php
require_once 'functions.php';
var_dump($_POST);
$id = $_POST['news-id'];
delete_news($id);
header('location:home_admin.php');
?>