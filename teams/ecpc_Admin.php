<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ecpc_admin_style.css">
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
    $sql2 = "SELECT t.team_name, c.team_coach_name, GROUP_CONCAT(m.team_member_name) 
            AS members, t.team_id
            FROM teams t 
            JOIN team_coach c 
            ON t.coach_id = c.team_coach_id
            JOIN team_member m 
            ON t.team_id = m.team_id
            GROUP BY t.team_id";
    $result = $conn->query($sql2);

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_team_id'])) {
        $team_id = $_POST['delete_team_id'];
        $conn = mysqli_connect("localhost", "root", "", "cp-tracker");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query1 = "DELETE tm FROM team_member tm JOIN teams t ON t.team_id = tm.team_id WHERE t.team_id = ?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("i", $team_id);
        $stmt->execute();

        $query2 = "DELETE tc 
                    FROM team_coach tc 
                    JOIN teams t 
                    ON t.coach_id = tc.team_coach_id 
                    WHERE t.team_id = ?";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param("i", $team_id);
        $stmt->execute();

        $query3 = "DELETE FROM teams WHERE team_id = ?";
        $stmt = $conn->prepare($query3);
        $stmt->bind_param("i", $team_id);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Error deleting team: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        $conn->close();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_coach'])) {
        $coach_name = $_POST['coach_name'];

        if ($coach_name != '') {
            if (!$conn) {
                echo mysqli_connect_error();
            }
            $stmt = $conn->prepare("INSERT INTO `team_coach`(`team_coach_name`) 
                                            VALUES (?)");
            $stmt->bind_param("s", $coach_name);
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<script>alert('Failed to add coach.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Please enter a coach name.');</script>";
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
                        <a class="nav-link " aria-current="page" href="../admin/admin_home/home_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/admin_topics/admin_topics.php">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="ecpc_Admin.php">ECPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile_page/profile.php">Profile</a>
                    </li>
                </ul>
                <a class="nav-link ms-auto" href="../logout.php" style="color:red;font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="team-list">
        <h2>Team List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Coach Name</th>
                    <th>Members</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($team = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($team['team_name']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($team['team_coach_name']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($team['members']); ?>
                        </td>
                        <td class="actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="delete_team_id" value="<?php echo $team['team_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div id="the_whole_page">
        <form action="" class="form-container" method="POST">
            <h1>Create ECPC Team</h1>

            <label for="coach_name" class="form-label">Coach Name</label>
            <select id="coach_name" name="coach_name" class="form-select" required>
                <option value="">Select a Coach</option>
                <?php while ($coach = mysqli_fetch_assoc($coaches_result)): ?>
                    <option value="<?php echo $coach['team_coach_id']; ?>" <?php echo ($coach_name == $coach['team_coach_id']) ? 'selected' : ''; ?>>
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
        </form>
    </div>

    <div class="container mt-5">
        <h2>Add New Coach</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="coach_name" class="form-label">Coach Name</label>
                <input type="text" id="coach_name" name="coach_name" class="form-control" placeholder="Enter coach name"
                    required>
            </div>
            <button type="submit" name="add_coach" class="btn btn-primary">Add Coach</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>