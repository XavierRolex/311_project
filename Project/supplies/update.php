<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medical Supplies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Medical Supplies</h2>
        <form action="" method="POST">
            <label for="supply_id">Select Supply:</label>
            <select name="supply_id" id="supply_id" required>
                <option value="">--Select Supply--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch supply IDs and names for the dropdown
                $sql = "SELECT supply_id, name FROM Medical_Supplies";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['supply_id']}'>Supply ID: {$row['supply_id']} - Name: {$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No supplies available</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="price">New Price:</label>
            <input type="number" step="0.01" name="price" id="price" placeholder="Leave blank if no change">
            <br><br>

            <label for="quantity">New Quantity:</label>
            <input type="number" name="quantity" id="quantity" placeholder="Leave blank if no change">
            <br><br>

            <button type="submit" name="update_supply">Update Supply</button>
        </form>

        <?php
        if (isset($_POST['update_supply'])) {
            $supply_id = $_POST['supply_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            if (!empty($supply_id)) {
                // Prepare the update query dynamically based on inputs
                $fields = [];
                $params = [];
                $types = "";

                if (!empty($price)) {
                    $fields[] = "price = ?";
                    $params[] = $price;
                    $types .= "d";
                }

                if (!empty($quantity)) {
                    $fields[] = "quantity = ?";
                    $params[] = $quantity;
                    $types .= "i";
                }

                if (!empty($fields)) {
                    $params[] = $supply_id;
                    $types .= "i";

                    $update_sql = "UPDATE Medical_Supplies SET " . implode(", ", $fields) . " WHERE supply_id = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param($types, ...$params);

                    if ($stmt->execute()) {
                        // Redirect to dashboard after success
                        echo "<p style='color: green;'>Supply details updated successfully for Supply ID: {$supply_id}</p>";
                        echo "<script>
                                setTimeout(() => {
                                    window.location.href = '../admin/dashboard.php';
                                }, 2000);
                              </script>";
                    } else {
                        echo "<p style='color: red;'>Failed to update supply. Error: " . $conn->error . "</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p style='color: orange;'>No changes made to Supply ID: {$supply_id}</p>";
                }
            } else {
                echo "<p style='color: red;'>Please select a valid Supply ID.</p>";
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
