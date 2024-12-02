<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Equipment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Medical Equipment</h2>
        <table>
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
                session_start();
                include('../connection.php');
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
