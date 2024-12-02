<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medical Equipment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Medical Equipment</h2>
        <form action="" method="POST">
            <!-- Select Equipment -->
            <label for="equipment_id">Select Equipment:</label>
            <select name="equipment_id" id="equipment_id" required>
                <option value="">--Select Equipment--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch equipment IDs and names for the dropdown
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

            <!-- Update Fields -->
            <label for="status">New Status:</label>
            <select name="status" id="status">
                <option value="">--Select Status--</option>
                <option value="Operational">Operational</option>
                <option value="Under Maintenance">Under Maintenance</option>
                <option value="Out of Service">Out of Service</option>
            </select>
            <br><br>

            <label for="purchase_price">New Purchase Price:</label>
            <input type="number" step="0.01" name="purchase_price" id="purchase_price" placeholder="Leave blank if no change">
            <br><br>

            <label for="maintenance_cost">New Maintenance Cost:</label>
            <input type="number" step="0.01" name="maintenance_cost" id="maintenance_cost" placeholder="Leave blank if no change">
            <br><br>

            <button type="submit" name="update_equipment">Update Equipment</button>
        </form>

        <?php
        if (isset($_POST['update_equipment'])) {
            $equipment_id = $_POST['equipment_id'];
            $status = $_POST['status'];
            $purchase_price = $_POST['purchase_price'];
            $maintenance_cost = $_POST['maintenance_cost'];

            if (!empty($equipment_id)) {
                // Prepare dynamic update query
                $fields = [];
                $params = [];
                $types = "";

                if (!empty($status)) {
                    $fields[] = "status = ?";
                    $params[] = $status;
                    $types .= "s";
                }

                if (!empty($purchase_price)) {
                    $fields[] = "purchase_price = ?";
                    $params[] = $purchase_price;
                    $types .= "d";
                }

                if (!empty($maintenance_cost)) {
                    $fields[] = "maintenance_cost = ?";
                    $params[] = $maintenance_cost;
                    $types .= "d";
                }

                if (!empty($fields)) {
                    $params[] = $equipment_id;
                    $types .= "i";

                    $update_sql = "UPDATE Medical_Equipment SET " . implode(", ", $fields) . " WHERE equipment_id = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param($types, ...$params);

                    if ($stmt->execute()) {
                        // Successful update
                        echo "<p style='color: green;'>Equipment details updated successfully for Equipment ID: {$equipment_id}</p>";
                        echo "<script>
                                setTimeout(() => {
                                    window.location.href = '../admin/dashboard.php';
                                }, 2000);
                              </script>";
                    } else {
                        echo "<p style='color: red;'>Failed to update equipment. Error: " . $conn->error . "</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p style='color: orange;'>No changes made to Equipment ID: {$equipment_id}</p>";
                }
            } else {
                echo "<p style='color: red;'>Please select a valid Equipment ID.</p>";
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
