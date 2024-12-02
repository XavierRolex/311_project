<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ward</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Ward</h2>
        <table>
            <thead>
                <tr>
                    <th>Ward ID</th>
                    <th>Ward Type</th>
                    <th>Bed Number</th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT ward_id, ward_type, bed_no, availability FROM Ward";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['ward_id']}</td>
                        <td>{$row['ward_type']}</td>
                        <td>{$row['bed_no']}</td>
                        <td>{$row['availability']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No ward found</td></tr>";
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
