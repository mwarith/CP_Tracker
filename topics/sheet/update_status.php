<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "cp-tracker"
);


if (isset($_POST['table_name'])) {
    $_table_name = $_POST['table_name'];
    $user_id = intval($_POST['user_id']);
    $status = $_POST['status'];
    $item_id =
        ($_table_name == "solved" ?
            intval($_POST['problem_id']) :
            intval($_POST['material_id']));

    function update($conn, $table_name, $user_id, $item_id, $status)
    {

        $flags = [
            "Accepted" => 1,
            "Done" => 1,
            "Hint" => 2,
            "Wrong Answer" => 3
        ];

        $flag = 0;
        if (array_key_exists($status, $flags)) {
            $flag = $flags[$status];
        }

        $table_flag = $table_name . "_flag";
        $id = ($table_name == "solved" ? "problem" : "material") . "_id";

        $sql = "UPDATE $table_name
                SET $table_flag = '$flag'
                WHERE `user_id` = $user_id
                AND $id = $item_id";

        $conn->query($sql);
    }

    update($conn, $_table_name, $user_id, $item_id, $status);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $conn->close();
    exit;
}
?>