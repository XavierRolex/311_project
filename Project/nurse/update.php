<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Nurse Shift</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Update Nurse Duty Shift</h2>
        <form action="" method="POST">
            <!-- Select Nurse -->
            <label for="nurse_id">Select Nurse:</label>
            <select name="nurse_id" id="nurse_id" required>
                <option value="">--Select Nurse--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch nurse IDs and names for the dropdown
                $sql = "SELECT nurse_id, name FROM Nurse";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['nurse_id']}'>Nurse ID: {$row['nurse_id']} - Name: {$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No nurses available</option>";
                }
                ?>
            </select>
            <br><br>

            <!-- Update Duty Shift -->
            <label for="duty_shift">New Duty Shift:</label>
            <select name="duty_shift" id="duty_shift" required>
                <option value="">--Select Shift--</option>
                <option value="Morning">Morning</option>
                <option value="Evening">Evening</option>
                <option value="Night">Night</option>
            </select>
            <br><br>

            <button type="submit" name="update_nurse_shift">Update Shift</button>
        </form>

        <?php
        if (isset($_POST['update_nurse_shift'])) {
            $nurse_id = $_POST['nurse_id'];
            $duty_shift = $_POST['duty_shift'];

            if (!empty($nurse_id) && !empty($duty_shift)) {
                // Update query to change the nurse's duty shift
                $update_sql = "UPDATE Nurse SET duty_shift = ? WHERE nurse_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $duty_shift, $nurse_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Nurse duty shift updated successfully for Nurse ID: {$nurse_id}</p>";
                } else {
                    echo "<p style='color: red;'>Failed to update duty shift. Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color: red;'>Please select a Nurse ID and a new shift.</p>";
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
