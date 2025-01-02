<?php
require_once '../admin/admin_home/functions.php';
var_dump($_POST);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['confirm-password'];
$user_level = $_POST['user-level'];

create_user($username, $email, $password, $user_level);
header("Location: ../login/login.php");

?>