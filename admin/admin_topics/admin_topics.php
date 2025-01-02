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
    <title>Competitive Programming Sheets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_topics_styles.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirm_delete_topic(event) {
            if (confirm('Are you sure you want to delete this topic?')) {
                var x = document.getElementById('delete_topic');
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
                        <a class="nav-link " aria-current="page" href="../admin_home/home_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../admin_topics/admin_topics.php">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../teams/ecpc_Admin.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../../logout.php" style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>


    <header>
        <h1>Competitive Programming Sheets</h1>
    </header>

    <main>
        <!-- Add Topic Section -->
        <div class="add-topic">
            <h2>Add New Topic</h2>
            <form method="POST" action="admin_topics_functions.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="topic_name" class="form-label">Topic Name</label>
                    <input type="text" class="form-control" id="topic_name" name="topic_name" required>
                </div>

                <div class="mb-3">
                    <label for="topic_description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="topic_description" name="topic_description" required>
                </div>

                <div class="mb-3">
                    <label for="topic_img" class="form-label">Topic Image</label>
                    <input type="file" class="form-control" id="topic_img" name="topic_img" accept="image/" required>
                </div>

                <div class="mb-3">
                    <label for="topic_sub" class="form-label">Subtopics</label>
                    <input type="text" class="form-control" id="topic_sub" name="topic_sub" required>
                </div>

                <div class="mb-3">
                    <label for="topic_level" class="form-label">Choose Level</label>
                    <select class="form-select" id="topic_level" name="topic_level" required>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                    </select>
                </div>
                <br>
                <button type="submit" name="add_topic" class="btn btn-primary">Add Topic</button>
            </form>
        </div>

        <!-- Delete Topic Section -->
        <div class="delete-topic">
            <h2>Delete Topic</h2>
            <form method="POST" action="admin_topics_functions.php">
                <div class="mb-3">
                    <label for="delete_topic" class="form-label">Select Topic to Delete</label>
                    <select class="form-select" id="delete_topic" name="topic_id" required>
                        <?php

                        $sql = "SELECT `topic_id`, `topic_name` 
                                FROM `topics`";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <option value="<?= $row['topic_id'] ?>"><?= $row['topic_name'] ?></option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="delete_topic" id="delete_topic" class="btn btn-danger"
                    onclick="confirm_delete_topic(event)">
                    Delete Topic
                </button>
            </form>
        </div>
    </main>


    <?php

    for ($topic_level = 1; $topic_level <= 3; ++$topic_level) {
        ?>
        <h1 class="text-center my-4">Level <?= $topic_level ?></h1>
        <main>
            <?php
            $sql = "SELECT `topic_name`, `topic_img`, `topic_description`, `topic_sub` , `topic_id`
                    FROM `topics`
                    WHERE topic_level = $topic_level";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $topic_id = $row['topic_id'];
                    $topic_name = $row['topic_name'];
                    $topic_img = $row['topic_img'];
                    $topic_description = $row['topic_description'];
                    $topic_sub = $row['topic_sub'];
                    ?>

                    <div class="course">
                        <a href="../admin_sheet/admin_sheet.php?topic_id=<?= $topic_id ?>">
                            <img src="../../image/<?= $topic_img ?>" alt="<?= $topic_name ?>">
                            <div class="details">
                                <h2><?= $topic_name ?></h2>
                                <p><?= $topic_description ?></p>
                                <span>Topics: <?= $topic_sub ?></span>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </main>
        <?php
    }
    ?>


</body>

</html>