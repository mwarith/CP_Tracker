<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register_style.css">
    <title>Register</title>
</head>

<body>

    <div id="the_whole_page">
        <div id="Container">
            <h2>Create an Account</h2>
            <form action="create_user.php" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" required>

                <label for="email">Email Address</label>
                <input type="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" required>

                <!-- Slider to select user level -->
                <label for="user-level">Training level</label>
                <input type="range" name="user-level" min="1" max="3" value="2" step="1" required>

                <!-- Labels for the slider -->
                <div class="slider-labels">
                    <span></span>
                    <span>1</span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span><span></span>
                    <span></span>
                    <span></span><span></span>
                    <span></span><span></span>
                    <span></span>
                    <span>2</span>
                    <span></span>
                    <span></span><span></span>
                    <span></span><span></span>
                    <span></span>
                    <span></span>
                    <span></span><span></span>
                    <span></span><span></span>
                    <span></span>
                    <span>3</span>
                </div>

                <input type="submit" value="Register">
            </form>
            <p>Already have an account? <a href="../login/login.php" id="login-link">Log in</a></p>
        </div>
    </div>
</body>

</html>