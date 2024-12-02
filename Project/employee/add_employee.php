<?php
// Start session and include database connection
session_start();
include('../connection.php'); // Ensure you have a `connection.php` file with $conn defined for the DB connection

// Check if form is submitted
if (isset($_POST["sub"])) {
    // Retrieve form data
    $e_name = $_POST['ename'];
    $e_date = $_POST['edate'];
    $e_salary = $_POST['esalary'];

    // Insert query
    $insert_query = "INSERT INTO `Employee` (name, joining_date, salary) VALUES ('$e_name', '$e_date', '$e_salary')";
    $result = mysqli_query($conn, $insert_query);

    // Handle the result
    if ($result) {
        echo "<script>alert('Employee has been added successfully');</script>";
        header("Location: ../admin/dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Failed to add employee');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Employee</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="ename" class="form-label">Name</label>
                <input type="text" class="form-control" id="ename" name="ename" placeholder="Enter employee name" required>
            </div>
            <div class="mb-3">
                <label for="edate" class="form-label">Joining Date</label>
                <input type="date" class="form-control" id="edate" name="edate" required>
            </div>
            <div class="mb-3">
                <label for="esalary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="esalary" name="esalary" placeholder="Enter salary" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
</body>
</html>
