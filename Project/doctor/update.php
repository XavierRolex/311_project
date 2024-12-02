<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor Working Days</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Doctor Working Days</h2>
        <form action="" method="POST">
            <!-- Select Doctor -->
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" id="doctor_id" required>
                <option value="">--Select Doctor--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch doctor IDs and names for the dropdown
                $sql = "SELECT doctor_id, name FROM Doctor";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['doctor_id']}'>Doctor ID: {$row['doctor_id']} - Name: {$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No doctors available</option>";
                }
                ?>
            </select>
            <br><br>

            <!-- Update Working Days -->
            <label for="working_days">New Working Days:</label>
            <select name="working_days" id="working_days" required>
                <option value="">--Select Days--</option>
                <option value="Monday to Friday">Monday to Friday</option>
                <option value="Monday to Saturday">Monday to Saturday</option>
                <option value="Monday to Sunday">Monday to Sunday</option>
                <option value="Off Days">Off Days</option>
            </select>
            <br><br>

            <button type="submit" name="update_doctor_days">Update Working Days</button>
        </form>

        <?php
        if (isset($_POST['update_doctor_days'])) {
            $doctor_id = $_POST['doctor_id'];
            $working_days = $_POST['working_days'];

            if (!empty($doctor_id) && !empty($working_days)) {
                // Update query to change the doctor's working days
                $update_sql = "UPDATE Doctor SET working_days = ? WHERE doctor_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $working_days, $doctor_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Doctor's working days updated successfully for Doctor ID: {$doctor_id}</p>";
                } else {
                    echo "<p style='color: red;'>Failed to update working days. Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color: red;'>Please select a Doctor ID and a new working days schedule.</p>";
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
