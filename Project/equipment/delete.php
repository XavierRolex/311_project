<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Medical Equipment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Delete Medical Equipment</h2>

        <!-- Form to Select Equipment to Delete -->
        <form action="" method="POST">
            <label for="equipment_id">Select Equipment to Delete:</label>
            <select name="equipment_id" id="equipment_id" required>
                <option value="">--Select Equipment--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch equipment IDs and names for dropdown
                $sql = "SELECT equipment_id, name FROM Medical_Equipment";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['equipment_id']}'>Equipment ID: {$row['equipment_id']} - Name: {$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No equipment available</option>";
                }
                ?>
            </select>
            <br><br>

            <button type="submit" name="delete_equipment">Delete Equipment</button>
        </form>

        <?php
        if (isset($_POST['delete_equipment'])) {
            $equipment_id = $_POST['equipment_id'];

            if (!empty($equipment_id)) {
                // Delete query
                $delete_sql = "DELETE FROM Medical_Equipment WHERE equipment_id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $equipment_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Equipment ID: {$equipment_id} has been deleted successfully.</p>";
                } else {
                    echo "<p style='color: red;'>Failed to delete equipment. Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color: red;'>Please select equipment to delete.</p>";
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
