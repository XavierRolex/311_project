<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Employees List</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Joining Date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT employee_id, name, joining_date, salary FROM Employee";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['employee_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['joining_date']}</td>
                        <td>{$row['salary']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No employees found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Back to Dashboard Button -->
        <div style="margin-top: 20px; text-align: center;">
            <a href="../admin/dashboard.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>
