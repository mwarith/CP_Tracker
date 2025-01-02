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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="standings_styles.css">
  <title>Home</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CP Traker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../home/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../topics/topics.php">Training</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../standings/standings.php">Standing</a>
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

  <?php
  session_start();
  $user_level = $_SESSION['user_level'];// changessssssssssssssssss
  
  $sql = "SELECT `topic_name`, `topic_id`
          FROM `topics`
          WHERE `topic_level` = $user_level";

  $result = $conn->query($sql);

  $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'overallProgress';
  ?>
  <div class="standings-container">
    <h2>Standing</h2>
    <form method="GET" action="">
      <select name="sort_by" id="sort-by" onchange="this.form.submit()">
        <option value="overallProgress" <?= ($sort_by == 'overallProgress' ? 'selected' : '') ?>> Overall Progress</option>
        <?php
        while ($row = $result->fetch_assoc()) {
          $topic_name = $row['topic_name'];
          $topic_id = $row['topic_id'];
          ?>
          <option value="<?= $topic_id ?>" <?= ($sort_by == $topic_id ? 'selected' : '') ?>> <?= $topic_name ?> </option>

          <?php
        }
        ?>
      </select>
    </form>


    <table class="standings-table">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Handle</th>
          <th>Total Progress</th>
        </tr>
      </thead>
      <tbody id="table-body">

        <?php
        $sql = "SELECT COUNT(*)
                FROM `topics`
                WHERE `topic_level` = $user_level";
        $topic_num = $conn->query($sql)->fetch_row()[0];

        $sql = "SELECT COUNT(*)
                FROM `user`
                WHERE `user_level` = $user_level
                AND `is_admin` = 0";
        $user_num = $conn->query($sql)->fetch_row()[0];

        $sql = "SELECT `user_id`
                FROM `user`
                WHERE `user_level` = $user_level
                AND `is_admin` = 0";
        $user_sql = $conn->query($sql);

        $sql = "SELECT `topic_id`
                FROM `topics`
                WHERE `topic_level` = $user_level";
        $topic_sql = $conn->query($sql);
        $topics = $topic_sql->fetch_all(MYSQLI_ASSOC);

        $dp = [];
        $mp = [];
        while ($user_id = $user_sql->fetch_assoc()) {
          $overall = 0;
          $id = intval($user_id['user_id']);
          foreach ($topics as $topic) {
            $sum_topic = 0;
            $topic_id = $topic['topic_id'];
            $sql = "SELECT COUNT(*)
                    FROM `problem`
                    WHERE `topic_id` = $topic_id";
            $problem_num = $conn->query($sql)->fetch_row()[0];

            $sql = "SELECT `problem_id`
                    FROM `problem`
                    WHERE `topic_id` = $topic_id";
            $problem_sql = $conn->query($sql);

            while ($problem_id = $problem_sql->fetch_assoc()) {
              $problem_id = $problem_id['problem_id'];
              $sql = "SELECT solved_flag 
                      FROM `solved` 
                      WHERE `problem_id` = $problem_id
                      AND `user_id` = $id";

              $solve = $conn->query($sql)->fetch_row()[0] ?? null; // Use null coalescing to handle missing data
              if ($solve !== null) {
                $sum_topic += (($solve == 1 || $solve == 2) ? 1 : 0);
              }
            }
            if ($problem_num == 0) {
              $dp[$id][$topic_id] = 0;
            } else {
              $dp[$id][$topic_id] = intval(($sum_topic / $problem_num) * 100);
            }
            $overall += $dp[$id][$topic_id];
          }
          $mp[$id] = intval(($overall / $topic_num) * 1000 / 1000);
        }

        $arr = [];
        if ($sort_by != 'overallProgress') {
          foreach ($dp as $userid => $t) {
            foreach ($t as $topicid => $progress) {
              if ($topicid == $sort_by) {
                $arr[] = [$userid, $progress];
              }
            }
          }
        } else {
          foreach ($mp as $userid => $progress) {
            $arr[] = [$userid, $progress];
          }
        }

        usort($arr, function ($a, $b) {
          return $b[1] <=> $a[1];
        });

        $index = 1;
        foreach ($arr as $row) {
          $user_id = $row[0];
          $prog = $row[1];
          $sql = "SELECT `user_username`
                  FROM `user`
                  WHERE `user_id` = $user_id";
          $username = $conn->query($sql)->fetch_row()[0];
          ?>
          <tr>
            <td>
              <?= $index++ ?>
            </td>
            <td>
              <?= $username ?>
            </td>
            <td>
              <div class='progress-bar' style='width: <?= $prog ?>%;'></div>
              <?= $prog ?>%
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