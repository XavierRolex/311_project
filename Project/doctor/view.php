<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Doctor</h2>
        <table>
            <thead>
                <tr>
                    <th>Doctor ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Working Days</th>
                    <th>Specialization</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT doctor_id, name, address, working_days, specialization FROM Doctor";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['doctor_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['working_days']}</td>
                        <td>{$row['specialization']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No Doctor found</td></tr>";
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
