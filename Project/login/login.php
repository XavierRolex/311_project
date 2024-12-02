<?php
session_start();
include("..connection.php"); // Include database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Admin credentials check
                if ($email === "admin" && $password === "admin123") {
                    $_SESSION['username'] = "Admin";
                    header("Location: ../admin/dashboard.php");
                    exit();
                }

                // Check user credentials in the database
                $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
                echo "Debug: Query is - $query<br>";

                if (!$con) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                $result = mysqli_query($con, $query) or die("Query Failed: " . mysqli_error($con));

                if (mysqli_num_rows($result) == 1) {
                    echo "Debug: Query successful. User found.<br>";
                    header("Location: ../admin/dashboard.php");
                    exit();
                } else {
                    echo "<p class='error'>Invalid Email or Password</p>";
                }
            }
            ?>

            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have an account? <a href="../SignUp/signup.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>