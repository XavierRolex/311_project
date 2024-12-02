<?php
// Start session and include database connection
session_start();
include('../connection.php'); // Ensure you have a `connection.php` file with $conn defined for the DB connection

// Check if form is submitted
if (isset($_POST["sub"])) {
    // Retrieve form data
    $d_name = $_POST['dname'];  // Doctor's name
    $d_address = $_POST['daddress'];  // Doctor's address
    $d_specialization = $_POST['dspecialization'];  // Doctor's specialization
    $d_working_days = $_POST['dworking_days'];  // Doctor's working days

    // Insert query to insert doctor data into the Doctor table
    $insert_query = "INSERT INTO `Doctor` (name, address, specialization, working_days) 
                     VALUES ('$d_name', '$d_address', '$d_specialization', '$d_working_days')";
    $result = mysqli_query($conn, $insert_query);

    // Handle the result
    if ($result) {
        echo "<script>alert('Doctor has been added successfully');</script>";
        header("Location: ../admin/dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Failed to add doctor');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Doctor</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="dname" class="form-label">Name</label>
                <input type="text" class="form-control" id="dname" name="dname" placeholder="Enter doctor's name" required>
            </div>
            <div class="mb-3">
                <label for="daddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="daddress" name="daddress" placeholder="Enter doctor's address" required>
            </div>
            <div class="mb-3">
                <label for="dspecialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" id="dspecialization" name="dspecialization" placeholder="Enter doctor's specialization" required>
            </div>
            <div class="mb-3">
                <label for="dworking_days" class="form-label">Working Days</label>
                <input type="text" class="form-control" id="dworking_days" name="dworking_days" placeholder="Enter doctor's working days" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Add Doctor</button>
        </form>
    </div>
</body>
</html>
