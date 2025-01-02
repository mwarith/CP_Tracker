<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile_style.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Profile</title>
    <?php
    session_start();
    ?>
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
                        <a class="nav-link " aria-current="page" href=<?php
                        if ($_SESSION['is_admin'] == 1)
                            echo "../admin/admin_home/home_admin.php";
                        else
                            echo "../home/home.php";
                        ?>>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php
                        if ($_SESSION['is_admin'] == 1)
                            echo "../admin/admin_topics/admin_topics.php";
                        else
                            echo "../topics/topics.php";
                        ?>>Training</a>
                    </li>
                    <!-- Standings -->


                    <?php

                    if (!$_SESSION['is_admin']) {
                        echo '<li class="nav-item">
                            <a class="nav-link" href=../standings/standings.php>Standings</a>
                            </li>';
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href=<?php
                        if ($_SESSION['is_admin'] == 1)
                            echo "../teams/ecpc_Admin.php";
                        else
                            echo "../teams/ecpc.php" ?>>ECPC</a>
                        </li>
                        <!-- Donate ACPC -->

                        <?php
                        if ($_SESSION['is_admin'] == 0) {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="../donate/donate.php">Donate ACPC</a>
                                </li>';
                        }
                        ?>

                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../logout.php" style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>


    <div class="page">
        <div class="container">
            <div class="contents">
                <div class="head">
                    <?php
                    $user_id = $_SESSION['user_id'];

                    $conn = mysqli_connect(
                        "localhost",
                        "root",
                        "",
                        "cp-tracker"
                    );

                    if (!$conn) {
                        echo mysqli_connect_error();
                    }

                    $username = $_SESSION['user_username'];
                    echo "<h2 class='username'>$username</h2>";
                    ?>

                    <div class="line"></div>
                </div> <!-- /head -->


                <ul>
                    <i class="fa-solid fa-star"></i>
                    <?php


                    $level = $_SESSION['user_level'];
                    echo "<span class='level'>Level $level</span>";
                    ?>

                    <br>
                    <label for="" class="settings-label">
                        <i class="fa-solid fa-gear"></i>
                        <span class="settings">Settings</span>
                    </label>
                    <li>
                        <a href="settings.php"><i class="fa-solid fa-user"></i></a>
                        <a href="settings.php" class="change">Change Username</a>
                    </li>
                    <li>
                        <a href="settings.php"><i class="fa-solid fa-lock"></i></a>
                        <a href="settings.php" class="change">Change Password</a>
                    </li>
                    <li>
                        <a href="settings.php"><i class="fa-solid fa-envelope"></i></a>
                        <a href="settings.php" class="change">Change Email</a>
                    </li>
                </ul>

            </div> <!-- /contents -->

        </div> <!-- /container -->

            <div class="upcc">
                <div class="ucc1">
                    <h3 class="h3">Upcoming Contest</h3>
                </div>
                <a href="https://codeforces.com/contests">Educational Codeforces Round 173 (Rated for Div. 2)</a>
        </div> <!-- /bottom -->

    </div> <!-- /page -->

</body>

</html>