<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ecpc_style.css">
    <title>ECPC Page</title>

    <?php

    $CoachMap = [];
    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "cp-tracker"
    );

    $sql = "SELECT *
            FROM team_coach";
    $coaches_result = $conn->query($sql);

    $coach_name = $team_name = $member1 = $member2 = $member3 = $drive = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $coach_name = $_POST['coach_name'] ?? '';
        $team_name = $_POST['teamName'] ?? '';
        $member1 = $_POST['member1'] ?? '';
        $member2 = $_POST['member2'] ?? '';
        $member3 = $_POST['member3'] ?? '';
        $drive = $_POST['drive'] ?? '';

        if ($coach_name != '' && $team_name != '' && $member1 != '' && $member2 != '' && $member3 != '' && $drive != '') {

            if (!$conn) {
                echo mysqli_connect_error();
            }
            $stmt = $conn->prepare("INSERT INTO `teams`( `team_name`, `coach_id`, `team_url`)
                                            VALUES (?,?,?)");
            $stmt->bind_param("sis", $team_name, $coach_name, $drive);
            if ($stmt->execute()) {
                $team_id = $stmt->insert_id;
                $stmt = $conn->prepare("INSERT INTO `team_member`(`team_id`, `team_member_name`)
                                                VALUES (?,?)");
                $stmt->bind_param("is", $team_id, $member1);
                if ($stmt->execute()) {
                    $stmt = $conn->prepare("INSERT INTO `team_member`(`team_id`, `team_member_name`)
                                                    VALUES (?,?)");
                    $stmt->bind_param("is", $team_id, $member2);
                    if ($stmt->execute()) {
                        $stmt = $conn->prepare("INSERT INTO `team_member`(`team_id`, `team_member_name`) 
                                                        VALUES (?,?)");
                        $stmt->bind_param("is", $team_id, $member3);
                        if ($stmt->execute()) {

                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit();
                        }
                    }
                }
            } else {
                echo "<script>alert('Failed to create the team.');</script>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Please fill in all the fields.');</script>";
        }
    }

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
                        <a class="nav-link" aria-current="page" href="../home/home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../topics/topics.php"
                        >Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../standings/standings.php">Standing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../teams/ecpc.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../donate/donate.php">Donate ACPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../logout.php"  style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>


    <div id="the_whole_page">
        <form action="" class="form-container" method="POST">
            <div id="Container" class="mt-navbar">
                <h1>Create ECPC Team</h1>

                <label for="coach_name" class="form-label">Coach Name</label>
                <select id="coach_name" name="coach_name" class="form-select" required>
                    <option value="">Select a Coach</option>
                    <?php while ($coach = mysqli_fetch_assoc($coaches_result)): ?>
                        <option value="<?php
                        echo $coach['team_coach_id']; ?>" <?php echo ($coach_name == $coach['team_coach_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($coach['team_coach_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="team-name">Team Name</label>
                <input type="text" id="team-name" name="teamName" value="<?php echo htmlspecialchars($team_name); ?>"
                    placeholder="Enter team name" required>

                <label for="member-1">Member 1 Name</label>
                <input type="text" id="member-1" name="member1" value="<?php echo htmlspecialchars($member1); ?>"
                    placeholder="Enter member 1 name" required>

                <label for="member-2">Member 2 Name</label>
                <input type="text" id="member-2" name="member2" value="<?php echo htmlspecialchars($member2); ?>"
                    placeholder="Enter member 2 name" required>

                <label for="member-3">Member 3 Name</label>
                <input type="text" id="member-3" name="member3" value="<?php echo htmlspecialchars($member3); ?>"
                    placeholder="Enter member 3 name" required>

                <label for="drive">Drive to ID's</label>
                <input type="text" id="drive" name="drive" value="<?php echo htmlspecialchars($drive); ?>"
                    placeholder="Drive to ID's (3 ids for team)" required>

                <button type="submit" name="submit" value="submit">Create Team</button>
            </div>
        </form>
    </div>

</body>

</html>