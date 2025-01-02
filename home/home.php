<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Competitive Programming Training</title>
    <link rel="stylesheet" href="home_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Navbar -->
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
                        <a class="nav-link active" aria-current="page" href="../home/home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../topics/topics.php">Training</a>
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


    <!-- Home Content -->
    <section class="home-content">
        <h1>Welcome to CP-Tracker</h1>
        <p>Train for competitive programming, improve your skills, and participate in contests to achieve your goals.
        </p>
        <p>Our mission is to prepare students for success in programming competitions like ECPC, ICPC, and more!</p>
    </section>

    <section class="news-section">
        <h2>Latest News</h2>
        <?php
        require_once '../admin/admin_home/functions.php';
        $news = fetch_news();

        while ($it = $news->fetch_assoc()) {
            $text = explode(':', $it['news_text']);
            echo <<<HTML
            <div class="news-item">
                <p><strong>$text[0] </strong><br> $text[1]</p>
            </div>
            HTML;
        }
        ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 CP-Tracker. All rights reserved.</p>
    </footer>
</body>

</html>
<!-- 
title
content

-->