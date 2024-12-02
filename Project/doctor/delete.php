<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Doctor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Delete Doctor</h2>
        
        <!-- Form to Select Doctor to Delete -->
        <form action="" method="POST">
            <label for="doctor_id">Select Doctor to Delete:</label>
            <select name="doctor_id" id="doctor_id" required>
                <option value="">--Select Doctor--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch doctor IDs and names for dropdown
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

            <button type="submit" name="delete_doctor">Delete Doctor</button>
        </form>

        <?php
        if (isset($_POST['delete_doctor'])) {
            $doctor_id = $_POST['doctor_id'];

            if (!empty($doctor_id)) {
                // Delete query
                $delete_sql = "DELETE FROM Doctor WHERE doctor_id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $doctor_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Doctor ID: {$doctor_id} has been deleted successfully.</p>";
                } else {
                    echo "<p style='color: red;'>Failed to delete doctor. Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color: red;'>Please select a doctor to delete.</p>";
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
