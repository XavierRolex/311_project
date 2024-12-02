<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Medicine</h2>
        <table>
            <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Name</th>
                    <th>Mfg Date</th>
                    <th>Exp Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT medicine_id, name, mfg_date, expiry_date, price FROM Medicine";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['medicine_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['mfg_date']}</td>
                        <td>{$row['expiry_date']}</td>
                        <td>{$row['price']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No medicine found</td></tr>";
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
