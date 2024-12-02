<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Room</h2>
        <table>
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Bed Number</th>
                    <th>Bed Type</th>
                    <th>Room Type</th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT room_id, bed_no, bed_type, room_type, availability FROM Room";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['room_id']}</td>
                        <td>{$row['bed_no']}</td>
                        <td>{$row['bed_type']}</td>
                        <td>{$row['room_type']}</td>
                        <td>{$row['availability']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No room found</td></tr>";
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
