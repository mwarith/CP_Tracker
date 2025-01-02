<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">

    <title>Login</title>

    <?php
    session_start();
    $_SESSION['sid'] = session_id();
    $password = $email = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $email = $_POST['user_email'] ?? '';
        $password = $_POST['user_password'] ?? '';

        $conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "cp-tracker"
        );
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        } else {
            $stmt = $conn->prepare("SELECT * 
                                            FROM `user`
                                            WHERE user_email = ?
                                            AND user_password = ?");
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

                    header("Location: ../home/home.php");
                    
                    exit();
                } else {
                    $_SESSION['check'] = true;
                    header("Location: login.php");
                    exit();
                }
            } else {
                echo "Error executing query.";
            }
            $stmt->close();
        }
        mysqli_close($con);
    }
    ?>

</head>

<body>

    <div class="login-container">
        <div class="switch-buttons">
            <button id="user-login-btn" class="active">User Login</button>
            <a href="Login_Admin.php"><button id="admin-login-btn">Admin Login</button></a>
        </div>
        <form id="user-login-form" class="active" method="POST">
            <label for="username">Email</label>
            <input type="text" id="username" name="user_email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="user_password" required />

            <?php
            if (isset($_SESSION['check']) && $_SESSION['check'] == true) {
                echo "<p style='color:red;'>Invalid email or password.</p>";
                unset($_SESSION['check']); 
            }
            ?>
            <input type="submit" name="submit" value="Login">
            <div class="social-login">
                <a id="create-account" href="../register/register.php">Don't have an account?</a>
            </div>
        </form>
    </div>
</body>

</html>