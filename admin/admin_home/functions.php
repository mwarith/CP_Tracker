<?php

$conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "cp-tracker"
);

function create_user($username, $email, $password, $user_level)
{
        global $conn;
        $query = "INSERT INTO `user`(`user_username`, `user_email`, `user_password`, `user_level`)
                VALUES ('$username','$email','$password', $user_level)";
        mysqli_query($conn, $query);
}

function add_news($title, $content)
{
        global $conn;
        $query = "INSERT INTO `news`(`news_text`)
                VALUES ('$title:$content')";
        mysqli_query($conn, $query);
}

function fetch_news()
{
        global $conn;
        $query = "SELECT * 
                FROM `news` 
                order by `news_id` desc";
        $result = mysqli_query($conn, $query);
        return $result;
}

function delete_news($id)
{
        global $conn;
        $query = "DELETE FROM `news` 
                WHERE `news_id` = " . $id;
        mysqli_query($conn, $query);
}


?>