<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Room Details</h2>
        <form action="" method="POST">
            <label for="room_id">Select Room:</label>
            <select name="room_id" id="room_id" required>
                <option value="">--Select Room--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch room IDs for the dropdown
                $sql = "SELECT room_id, room_type FROM Room";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['room_id']}'>Room ID: {$row['room_id']} - Type: {$row['room_type']}</option>";
                    }
                } else {
                    echo "<option value=''>No rooms available</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="bed_no">New Bed Number:</label>
            <input type="number" name="bed_no" id="bed_no" placeholder="Leave blank if no change">
            <br><br>

            <label for="availability">Availability:</label>
            <select name="availability" id="availability">
                <option value="">--No Change--</option>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
            </select>
            <br><br>

            <button type="submit" name="update_room">Update Room</button>
        </form>

        <?php
        if (isset($_POST['update_room'])) {
            $room_id = $_POST['room_id'];
            $bed_no = $_POST['bed_no'];
            $availability = $_POST['availability'];

            if (!empty($room_id)) {
                // Prepare the update query dynamically based on inputs
                $fields = [];
                $params = [];
                $types = "";

                if (!empty($bed_no)) {
                    $fields[] = "bed_no = ?";
                    $params[] = $bed_no;
                    $types .= "i";
                }

                if (!empty($availability)) {
                    $fields[] = "availability = ?";
                    $params[] = $availability;
                    $types .= "s";
                }

                if (!empty($fields)) {
                    $params[] = $room_id;
                    $types .= "i";

                    $update_sql = "UPDATE Room SET " . implode(", ", $fields) . " WHERE room_id = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param($types, ...$params);

                    if ($stmt->execute()) {
                        // Redirect to dashboard after success
                        header("Location: ../admin/dashboard.php");
                        exit;
                    } else {
                        echo "<p style='color: red;'>Failed to update room. Error: " . $conn->error . "</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p style='color: orange;'>No changes made to Room ID: {$room_id}</p>";
                }
            } else {
                echo "<p style='color: red;'>Please select a valid Room ID.</p>";
            }
        }

        $conn->close();
        ?>

        <!-- Back to Dashboard Button -->
        <div style="margin-top: 20px; text-align: center;">
            <a href="../admin/dashboard.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>
