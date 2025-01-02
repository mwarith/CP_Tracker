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
    <link rel="stylesheet" href="topics_styles.css">
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
                        <a class="nav-link active" href="../topics/topics.php">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../standings/standings.php">Standing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../teams/ecpc.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../donate/donate.php">Donate ACPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../logout.php" style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>



    <header>
        <h1>Competitive Programming Sheets</h1>
    </header>

    <main>



        <?php
        session_start();
        $topic_level = $_SESSION['user_level'];
        $sql = "SELECT `topic_name`, `topic_img`, `topic_description`, `topic_sub` , `topic_id`
                FROM `topics`
                WHERE `topic_level` = $topic_level";
        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {
            $topic_id = $row['topic_id'];
            $topic_name = $row['topic_name'];
            $topic_img = $row['topic_img'];
            $topic_description = $row['topic_description'];
            $topic_sub = $row['topic_sub'];
            ?>
            <div class="course">
                <a href="../topics/sheet/sheet.php?topic_id=<?= $topic_id ?>">
                    <img src="../image/<?= $topic_img ?>" alt="<?= $topic_name ?>">
                    <div class="details">
                        <h2><?= $topic_name ?></h2>
                        <p><?= $topic_description ?></p>
                        <span>Topics: <?= $topic_sub ?></span>
                    </div>
                </a>
            </div>
            <?php
        }

        $conn->close();
        ?>
    </main>

</body>

</html>