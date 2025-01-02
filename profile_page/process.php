<?php
session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_username'];


if (isset($_POST['update'])) {
    $updated_username = $_POST['u_username'];
    $updated_password = $_POST['u_password'];
    $updated_email = $_POST['u_email'];
    $checked_password = $_POST['checked_password'];

    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "cp-tracker"
    );

    if (!$conn) {
        echo mysqli_connect_error();
    }


    $query_username = "UPDATE `user` 
                        SET `user_username`='$updated_username' 
                        WHERE `user_id` = $user_id";
    $query_password = "UPDATE `user` 
                        SET `user_password`='$updated_password'
                        WHERE `user_id` = $user_id";
    $query_email = "UPDATE `user` 
                    SET `user_email`='$updated_email' 
                    WHERE `user_id` = $user_id";
    $query_check_password = "SELECT `user_password` 
                            FROM `user`
                            WHERE `user_id` = $user_id";

    $result = mysqli_query($conn, $query_check_password);
    $row = mysqli_fetch_assoc($result);
    $password = $row['user_password'];

    if (!empty($updated_username)) {
        if ($checked_password == $password) {
            mysqli_query($conn, $query_username);
            $_SESSION['user_username'] = $updated_username;
        }
    }
    if (!empty($updated_password)) {
        if ($checked_password == $password) {
            mysqli_query($conn, $query_password);
            $_SESSION['user_password'] = $updated_password;
        }
    }
    if (!empty($updated_email)) {
        if ($checked_password == $password) {
            mysqli_query($conn, $query_email);
            $_SESSION['user_email'] = $updated_email;
        }
    }
}



?>