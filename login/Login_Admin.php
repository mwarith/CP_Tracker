<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Admin Login</title>
    <?php
    session_start();
    $_SESSION['sid'] = session_id();
    $password = $email = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $check = false;
        $email = $_POST['user_email'] ?? '';
        $password = $_POST['user_password'] ?? '';

        $conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "cp-tracker"
        );
        if (!$conn) {
            echo mysqli_connect_error();
        } else {
            $check = false;
            $stmt = $conn->prepare("SELECT * 
                                            FROM `user` 
                                            WHERE user_email = ?
                                            AND user_password = ? 
                                            AND is_admin = 1");
            $stmt->bind_param("ss", $email, $password);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_username'] = $user['user_username'];
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_password'] = $user['user_password'];
                    $_SESSION['user_level'] = $user['user_level'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    $_SESSION['check'] = false;

                    header("Location: ../admin/admin_home/home_admin.php");
                    exit();
                } else {
                    $_SESSION['check'] = true;
                }
            } else {
                echo "Error executing query.";
            }
        }
    }
    ?>

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <div class="login-container">
        <div class="switch-buttons">
            <a href="login.php"> <button id="user-login-btn">User Login</button></a>
            <button id="admin-login-btn" class="active">Admin Login</button>
        </div>
        <form id="user-login-form" class="active" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="user_email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="user_password" required />

            <?php
            if (isset($_SESSION['check']) && $_SESSION['check'] == true) {
                echo "<p style='color:red;'>Invalid email or password.</p>";
                unset($_SESSION['check']); // Reset after showing the error
            }
            ?>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>

</html>