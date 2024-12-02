<?php
// Start session and include database connection
session_start();
include('../connection.php'); // Ensure you have a `connection.php` file with $conn defined for the DB connection

// Check if form is submitted to add equipment
if (isset($_POST["sub"])) {
    // Retrieve form data
    $equipment_name = $_POST['ename'];
    $equipment_status = $_POST['estatus'];
    $purchase_price = $_POST['epurchase_price'];
    $maintenance_cost = $_POST['emaintenance_cost'];

    // Insert query
    $insert_query = "INSERT INTO `Medical_Equipment` (name, status, purchase_price, maintenance_cost) 
                     VALUES ('$equipment_name', '$equipment_status', '$purchase_price', '$maintenance_cost')";
    $result = mysqli_query($conn, $insert_query);

    // Handle the result
    if ($result) {
        echo "<script>alert('Equipment has been added successfully');</script>";
        header("Location: ../admin/dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Failed to add equipment');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medical Equipment</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Medical Equipment</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="ename" class="form-label">Equipment Name</label>
                <input type="text" class="form-control" id="ename" name="ename" placeholder="Enter equipment name" required>
            </div>
            <div class="mb-3">
                <label for="estatus" class="form-label">Status</label>
                <select name="estatus" id="estatus" class="form-control" required>
                    <option value="Operational">Operational</option>
                    <option value="Under Maintenance">Under Maintenance</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="epurchase_price" class="form-label">Purchase Price</label>
                <input type="number" class="form-control" id="epurchase_price" name="epurchase_price" placeholder="Enter purchase price" required>
            </div>
            <div class="mb-3">
                <label for="emaintenance_cost" class="form-label">Maintenance Cost</label>
                <input type="number" class="form-control" id="emaintenance_cost" name="emaintenance_cost" placeholder="Enter maintenance cost" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Add Equipment</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Medical Equipment List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Equipment ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Purchase Price</th>
                    <th>Maintenance Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all equipment details to display in the table
                $sql = "SELECT equipment_id, name, status, purchase_price, maintenance_cost FROM Medical_Equipment";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['equipment_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['purchase_price']}</td>
                            <td>{$row['maintenance_cost']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No equipment found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Back to Dashboard Button -->
        <div style="margin-top: 20px; text-align: center;">
            <a href="../admin/dashboard.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back to Dashboard</a>
        </div>
    </div>

</body>

</html>
