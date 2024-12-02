<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ward Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Ward Details</h2>
        <form action="" method="POST">
            <label for="ward_id">Select Ward:</label>
            <select name="ward_id" id="ward_id" required>
                <option value="">--Select Ward--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch ward IDs and types for the dropdown
                $sql = "SELECT ward_id, ward_type FROM Ward";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['ward_id']}'>Ward ID: {$row['ward_id']} - Type: {$row['ward_type']}</option>";
                    }
                } else {
                    echo "<option value=''>No wards available</option>";
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

            <button type="submit" name="update_ward">Update Ward</button>
        </form>

        <?php
        if (isset($_POST['update_ward'])) {
            $ward_id = $_POST['ward_id'];
            $bed_no = $_POST['bed_no'];
            $availability = $_POST['availability'];

            if (!empty($ward_id)) {
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
                    $params[] = $ward_id;
                    $types .= "i";

                    $update_sql = "UPDATE Ward SET " . implode(", ", $fields) . " WHERE ward_id = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param($types, ...$params);

                    if ($stmt->execute()) {
                        // Redirect immediately to the dashboard after a successful update
                        header("Location: ../admin/dashboard.php");
                        exit;
                    } else {
                        echo "<p style='color: red;'>Failed to update ward. Error: " . $conn->error . "</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p style='color: orange;'>No changes made to Ward ID: {$ward_id}</p>";
                }
            } else {
                echo "<p style='color: red;'>Please select a valid Ward ID.</p>";
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
