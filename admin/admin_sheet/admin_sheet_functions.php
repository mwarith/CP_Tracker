<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli(
        "localhost",
        "root",
        "",
        "cp-tracker"
    );

    if (isset($_POST['add_material'])) {
        $title = $_POST['material_title'];
        $url = $_POST['material_url'];
        $tag = $_POST['material_tag'];
        $topic_id = intval($_POST['topic_id']);

        $sql = "INSERT INTO `material` (`material_title`, `material_url`, `material_tag`, `topic_id`)
                VALUES ('$title', '$url', '$tag', $topic_id)";
        $conn->query($sql);
    }

    if (isset($_POST['add_problem'])) {
        $title = $_POST['problem_title'];
        $url = $_POST['problem_url'];
        $tag = $_POST['problem_tag'];
        $topic_id = intval($_POST['topic_id']);

        $sql = "INSERT INTO `problem` (`problem_title`, `problem_url`, `problem_tag`, `topic_id`)
                VALUES ('$title', '$url', '$tag', $topic_id)";
        $conn->query($sql);
    }

    if (isset($_POST['delete_material'])) {
        $material_id = intval($_POST['material_id']);
        $sql = "DELETE FROM `material` 
                WHERE `material_id` = $material_id";
        $conn->query($sql);
    }

    if (isset($_POST['delete_problem'])) {
        $problem_id = intval($_POST['problem_id']);
        $sql = "DELETE FROM `problem`
                WHERE `problem_id` = $problem_id";
        $conn->query($sql);
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    $conn->close();
    exit;
}
?>