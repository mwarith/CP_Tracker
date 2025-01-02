<?php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "cp-tracker"
);


function init($conn, $table_name, $user_id, $topic_id)
{
    $table_check = ($table_name == "material" ? "checked" : "solved");
    $id1 = $table_name . "_id";
    $sql = "SELECT $id1
            FROM $table_check
            WHERE `user_id` = $user_id";
    // select material_id from checked where user_id = 1
    $result = $conn->query($sql);
    $freq = [];
    foreach ($result as $row) {
        $freq[$row[$id1]] = 1;
    }

    $id2 = $table_name . "_id";
    $sql2 = "SELECT $id2
            FROM $table_name
            WHERE `topic_id` = $topic_id";

    $result = $conn->query($sql2);
    foreach ($result as $row) {
        if (!isset($freq[$row[$id2]])) {
            $sql3 = "INSERT INTO $table_check (`user_id`, $id1)
                            VALUES ($user_id, $row[$id2])";
            $conn->query($sql3);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <link rel="stylesheet" href="sheet_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CP Traker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../home/home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../topics/topics.php"
                        >Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../standings/standings.php">Standing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../teams/ecpc.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../donate/donate.php">Donate ACPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../../logout.php"  style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="table-container">
        <h1 class="table-title">Materials</h1>
        <table id="dynamicTable">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Status</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                $topic_id = -1;
                $user_id = $_SESSION['user_id'];
                $table_name = "checked";

                if (isset($_GET['topic_id'])) {
                    $topic_id = $_GET['topic_id'];
                }
                init($conn, "material", $user_id, $topic_id);

                $sql = "SELECT `material_id`, `material_title`, `material_url`, `material_tag`
                        FROM `material`
                        WHERE `topic_id` = $topic_id";

                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $material_id = $row['material_id'];
                    $material_title = $row["material_title"];
                    $material_url = $row["material_url"];
                    $material_tag = $row["material_tag"];
                    $sql2 = "SELECT `checked_flag`
                            FROM `checked`
                            WHERE `material_id` = $material_id
                            AND `user_id` = $user_id";

                    $res = $conn->query($sql2);

                    $material_status = $res->fetch_assoc();
                    ?>

                    <tr>
                        <td>
                            <a href="<?= $material_url ?>">
                                <?= $material_title ?>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="update_status.php">
                                <input type="hidden" name="material_id" value="<?= $material_id ?>">
                                <input type="hidden" name="user_id" value=" <?= $user_id ?>">
                                <input type="hidden" name="table_name" value=" <?= $table_name ?>">
                                <select name="status" class="status-dropdown" onchange="this.form.submit()">
                                    <option value="Done" class="status-done" <?= ($material_status['checked_flag'] == 1 ? 'selected' : '') ?>> Done </option>
                                    <option value="Not Started" class="status-default"
                                        <?= ($material_status['checked_flag'] == 0 ? 'selected' : '') ?>>
                                        Not Started
                                    </option>
                                </select>
                            </form>


                        </td>
                        <td> <?= $material_tag ?></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Problems  changesss  -->
    <div class="table-container">
        <h1 class="table-title">Problems</h1>
        <table id="dynamicTable">
            <thead>
                <tr>
                    <th>Problem Link</th>
                    <th>Status</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $topic_id = -1;
                $user_id = $_SESSION['user_id'];  // changessssss
                $table_name = "solved";
                if (isset($_GET['topic_id'])) {
                    $topic_id = $_GET['topic_id'];
                }
                init($conn, "problem", $user_id, $topic_id);

                $sql = "SELECT `problem_id`, `problem_title`, `problem_url`, `problem_tag`
                        FROM `problem`
                        WHERE `topic_id` = $topic_id";

                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $problem_id = $row['problem_id'];
                    $problem_title = $row["problem_title"];
                    $problem_url = $row["problem_url"];
                    $problem_tag = $row["problem_tag"];
                    $sql2 = "SELECT `solved_flag`
                            FROM `solved`
                            WHERE `problem_id` = $problem_id
                            AND `user_id` = $user_id";

                    $res = $conn->query($sql2);

                    $problem_status = $res->fetch_assoc();
                    ?>
                    <tr>
                        <td>
                            <a href="<?= $problem_url ?>">
                                <?= $problem_title ?>
                            </a>
                        </td>
                        <td>

                            <form method="POST" action="update_status.php">
                                <input type="hidden" name="problem_id" value="<?= $problem_id ?>">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                <input type="hidden" name="table_name" value="<?= $table_name ?>">
                                <select name="status" class="status-dropdown" onchange="this.form.submit()">
                                    <option value="Accepted" class="status-accepted" <?= ($problem_status['solved_flag'] == 1 ? 'selected' : '') ?>>Accepted</option>
                                    <option value="Hint" class="status-hint" <?= ($problem_status['solved_flag'] == 2 ? 'selected' : '') ?>> Hint </option>
                                    <option value="Wrong Answer" class="status-error" <?= ($problem_status['solved_flag'] == 3 ? 'selected' : '') ?>>Wrong Answer</option>
                                    <option value="Not Started" class="status-default" <?= ($problem_status['solved_flag'] == 0 ? 'selected' : '') ?>>Not Started</option>
                                </select>
                            </form>

                        </td>
                        <td>
                            <?= $problem_tag ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>