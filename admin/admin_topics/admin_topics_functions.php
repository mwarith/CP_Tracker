<?php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "cp-tracker"
);

if (isset($_POST['add_topic'])) {
    $topic_name = $_POST['topic_name'];
    $topic_description = $_POST['topic_description'];
    $topic_sub = $_POST['topic_sub'];
    $topic_level = intval($_POST['topic_level']);

    $uploadDir = 'image/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $topic_img_path = '';

    if (isset($_FILES['topic_img'])) {
        $imagename = rand(1000, 10000) . $_FILES['topic_img']['name'];
        $imagetmp = $_FILES['topic_img']['tmp_name'];
        $imagesize = $_FILES['topic_img']['size'];
        $allowExt = array("jpg", "png", "gif", "mp3", "pdf", "svg", "SVG");
        $strToArray = explode(".", $imagename);
        $ext = end($strToArray);
        $ext = strtolower($ext);

        if (!empty($imagename) && !in_array($ext, $allowExt)) {
            $topic_img_path = "EXT";
        }
        if (empty($msgError)) {
            move_uploaded_file($imagetmp, '../../image/' . $imagename);
            $topic_img_path = $imagename;
        } else {
            $topic_img_path = "fail";
        }
    } else {
        $topic_img_path = "empty";
    }



    $sql = "INSERT INTO `topics` (`topic_name`, `topic_img`, `topic_description`, `topic_level`, `topic_sub`)
            VALUES ('$topic_name', '$topic_img_path', '$topic_description', $topic_level, '$topic_sub')";

    if ($conn->query($sql) === TRUE) {
        echo "New topic added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}


if (isset($_POST['delete_topic'])) {
    $topic_id = intval($_POST['topic_id']);

    $sql = "DELETE FROM `topics`
            WHERE topic_id = $topic_id";
    $conn->query($sql);
}

header("Location: " . $_SERVER['HTTP_REFERER']);

$conn->close();
exit;
?>