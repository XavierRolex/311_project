<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Supplies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Medical Supplies</h2>
        <table>
            <thead>
                <tr>
                    <th>Supply ID</th>
                    <th>Name</th>
                    <th>Supplier</th>
                    <th>Admin</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT Medical_Supplies.supply_id AS supply_id, Medical_Supplies.name AS supply_name, Medical_Supplies.supplier AS supplier, Medical_Supplies.price AS price, Medical_Supplies.quantity AS quantity, Administrator.name AS admin_name FROM Medical_Supplies INNER JOIN Administrator ON Medical_Supplies.admin_id = Administrator.admin_id;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['supply_id']}</td>
                        <td>{$row['supply_name']}</td>
                        <td>{$row['supplier']}</td>
                        <td>{$row['admin_name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['quantity']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No Supplies found</td></tr>";
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
