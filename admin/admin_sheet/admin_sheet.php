<?php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "cp-tracker"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_sheet_styles.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirm_delete_problem(event) {
            if (confirm('Are you sure you want to delete this material?')) {
                var x = document.getElementById('delete_problem');
                x.submit();
            }
            else {
                event.preventDefault();
            }
        }
        function confirm_delete_material(event) {
            if (confirm('Are you sure you want to delete this material?')) {
                var x = document.getElementById('delete_material');
                x.submit();
            }
            else {
                event.preventDefault();
            }
        }
    </script>


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
                        <a class="nav-link active" aria-current="page" href="../admin_home/home_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin_topics/admin_topics.php">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../teams/ecpc_Admin.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../../logout.php">Logout</a>
            </div>
        </div>
    </nav>


    <?php
    $topic_id = 0;
    if (isset($_GET['topic_id'])) {
        $topic_id = $_GET['topic_id'];
    }
    ?>

    <main>

        <!-- Add Material -->
        <div class="add-material">
            <h2>Add Material</h2>
            <form action="admin_sheet_functions.php" method="POST">
                <div class="mb-3">
                    <label for="material_title" class="form-label">Material Title</label>
                    <input type="text" class="form-control" id="material_title" name="material_title" required>
                </div>

                <div class="mb-3">
                    <label for="material_url" class="form-label">Material URL</label>
                    <input type="text" class="form-control" id="material_url" name="material_url" required>
                </div>

                <div class="mb-3">
                    <label for="material_tag" class="form-label">Material Tag</label>
                    <input type="text" class="form-control" id="material_tag" name="material_tag" required>
                </div>
                <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
                <button type="submit" name="add_material" class="btn btn-primary">Add Material</button>
            </form>
        </div>


        <!-- Delete Material -->
        <div class="delete-material">
            <h2>Delete Material</h2>
            <form action="admin_sheet_functions.php" method="POST">
                <div class="mb-3">
                    <label for="delete_material" class="form-label">Select Material to Delete</label>
                    <select class="form-select" name="material_id" id="material_id" required>
                        <?php

                        $sql = "SELECT `material_id`, `material_title` 
                                FROM `material` 
                                WHERE `topic_id` = $topic_id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value='<?= $row['material_id'] ?>'> <?= $row['material_title'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="delete_material" id="delete_material" class="btn btn-danger"
                    onclick="confirm_delete_material(event)">Delete
                    Material</button>
            </form>
        </div>
    </main>


    <!-- Materials Table -->
    <div class="table-container">
        <h1 class="table-title">Materials</h1>
        <table id="dynamicTable">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `material_title`, `material_url`, `material_tag` 
                            FROM `material` 
                            WHERE `topic_id` = $topic_id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <a href='<?= $row['material_url'] ?>'><?= $row['material_title'] ?></a>
                        </td>
                        <td>
                            <?= $row['material_tag'] ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <main>

        <!-- Add Problem -->
        <div class="add-problem">
            <h1 class="table-title">Add Problem</h1>
            <form action="admin_sheet_functions.php" method="POST">
                <div class="mb-3">
                    <label for="problem_title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="problem_title" name="problem_title" required>
                </div>

                <div class="mb-3">
                    <label for="problem_url" class="form-label">Problem URL</label>
                    <input type="text" class="form-control" id="problem_url" name="problem_url" required>
                </div>

                <div class="mb-3">
                    <label for="problem_tag" class="form-label">Problem Tag</label>
                    <input type="text" class="form-control" id="problem_tag" name="problem_tag" required>
                </div>
                <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
                <button type="submit" name="add_problem" class="btn btn-primary">Add Problem</button>
            </form>
        </div>

        <!-- Delete Problem -->
        <div class="delete-problem">
            <h1 class="table-title">Delete Problem</h1>
            <form action="admin_sheet_functions.php" method="POST">
                <div class="form-group">
                    <label for="problem_id">Select Problem to Delete</label>

                    <select class="form-select" name="problem_id" id="problem_id" required>
                        <?php
                        $sql = "SELECT problem_id, problem_title
                                FROM problem 
                                WHERE topic_id = $topic_id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <option value='<?= $row['problem_id'] ?>'><?= $row['problem_title'] ?></option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="delete_problem" id="delete_problem" class="btn btn-danger"
                    onclick="confirm_delete_problem(event)">Delete Problem</button>

            </form>
        </div>
    </main>

    <!-- Problems Table -->
    <div class="table-container">
        <h1 class="table-title">Problems</h1>
        <table id="dynamicTable">
            <thead>
                <tr>
                    <th>Problem Link</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `problem_title`, `problem_url`, `problem_tag` 
                        FROM `problem` 
                        WHERE `topic_id` = $topic_id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <a href='<?= $row['problem_url'] ?>'> <?= $row['problem_title'] ?> </a>
                        </td>
                        <td>
                            <?= $row['problem_tag'] ?>
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