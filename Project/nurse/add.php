<?php

session_start();
include('../connection.php');

if (isset($_POST["sub"])) {
    // Retrieve form data
    $n_name = $_POST['nname'];  
    $n_address = $_POST['naddress'];  
    $n_shift = $_POST['nshift'];  
    // Insert query to insert nurse data into the Nurse table
    $insert_query = "INSERT INTO `Nurse` (name, address, duty_shift) VALUES ('$n_name', '$n_address', '$n_shift')";
    $result = mysqli_query($conn, $insert_query);

    // Handle the result
    if ($result) {
        echo "<script>alert('Nurse has been added successfully');</script>";
        header("Location: ../admin/dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Failed to add nurse');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Nurse</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Nurse</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nname" class="form-label">Name</label>
                <input type="text" class="form-control" id="nname" name="nname" placeholder="Enter nurse's name" required>
            </div>
            <div class="mb-3">
                <label for="naddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="naddress" name="naddress" placeholder="Enter nurse's address" required>
            </div>
            <div class="mb-3">
                <label for="nshift" class="form-label">Shift</label>
                <input type="text" class="form-control" id="nshift" name="nshift" placeholder="Enter nurse's shift" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Add Nurse</button>
        </form>
    </div>
</body>
</html>
