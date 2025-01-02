<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile_style.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Settings</title>
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
                        session_start();
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
                    <li class="nav-item">
                        <a class="nav-link" href="../teams/ecpc_Admin.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../logout.php" style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="setting-container">
        <div class="setting-frame">
            <div class="frame-head">
                <h2 class="frame-name">Settings</h2>
                <div class="frame-line"></div>
            </div>
            <form action="process.php" method="post" class="box" target="hiddenIframe">
                <label for="" class="username-label">Username</label>
                <span class="colon colon1">:</span>
                <input type="text" name="u_username" placeholder="Enter The Username">

                <br>
                <label for="" class="password-label">Password</label>
                <span class="colon colon2">:</span>
                <input class="password1" name="u_password" type="password" placeholder="Enter The Password">

                <br>
                <label for="" class="email-label">Email</label>
                <span class="colon colon3">:</span>
                <input type="email" class="email" name="u_email" placeholder="Enter The Email">

                <div class="check-line"></div>

                <button type="submit" name="update" class="save">Save</button>
                <button class="cancel" type="button" onclick="window.location.href='profile.php';">Cancel</button>
                <p class="submit-p">Type your current password to save</p>
                <input class="password2" name="checked_password" type="password"
                    placeholder="Type your current password" required>
            </form>
            <iframe name="hiddenIframe" style="display:none;"></iframe>
        </div>
    </div>
</body>

</html>