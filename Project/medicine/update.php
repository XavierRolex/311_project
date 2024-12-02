<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine Price</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Medicine Price</h2>
        <form action="" method="POST">
            <label for="medicine_id">Select Medicine:</label>
            <select name="medicine_id" id="medicine_id" required>
                <option value="">--Select Medicine--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch medicine IDs and names for the dropdown
                $sql = "SELECT medicine_id, name FROM Medicine";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['medicine_id']}'>{$row['medicine_id']} - {$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No medicines available</option>";
                }
                ?>
            </select>
            <br><br>
            <label for="new_price">New Price:</label>
            <input type="number" name="new_price" id="new_price" step="0.01" required>
            <br><br>
            <button type="submit" name="update_price">Update Price</button>
        </form>

        <?php
        if (isset($_POST['update_price'])) {
            $medicine_id = $_POST['medicine_id'];
            $new_price = $_POST['new_price'];

            // Update query to set the new price
            $update_sql = "UPDATE Medicine SET price = ? WHERE medicine_id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("di", $new_price, $medicine_id);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Price updated successfully for Medicine ID: {$medicine_id}</p>";
            } else {
                echo "<p style='color: red;'>Failed to update price. Error: " . $conn->error . "</p>";
            }

            $stmt->close();
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
