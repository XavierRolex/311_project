<?php
include("../connection.php"); // Include the database configuration file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../login/style.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                // Retrieve user input
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                    // Insert user into database
                    $insert_query = "insert into `users` (name,email,password) values( '$username', '$email','$password')";
                    $result= mysqli_query($conn,$insert_query);
                    if($result){
                        echo "Registration successful!";
                        header("Location: ../login/login.php");
                    } 
                    else{   
                        echo "Failed!";
                    }

                }
            ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field">
                    <button type="submit" name="submit" class="btn">Register</button>
                </div>
                <div class="links">
                    Already a member? <a href="../login/login.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>