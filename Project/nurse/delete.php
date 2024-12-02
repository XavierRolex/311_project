<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Nurse</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Delete Nurse</h2>
        
        <!-- Form to Select Nurse to Delete -->
        <form action="" method="POST">
            <label for="nurse_id">Select Nurse to Delete:</label>
            <select name="nurse_id" id="nurse_id" required>
                <option value="">--Select Nurse--</option>
                <?php
                session_start();
                include('../connection.php');

                // Fetch nurse IDs and names for dropdown
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

            <button type="submit" name="delete_nurse">Delete Nurse</button>
        </form>

        <?php
        if (isset($_POST['delete_nurse'])) {
            $nurse_id = $_POST['nurse_id'];

            if (!empty($nurse_id)) {
                // Delete query
                $delete_sql = "DELETE FROM Nurse WHERE nurse_id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $nurse_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Nurse ID: {$nurse_id} has been deleted successfully.</p>";
                } else {
                    echo "<p style='color: red;'>Failed to delete nurse. Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color: red;'>Please select a nurse to delete.</p>";
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
