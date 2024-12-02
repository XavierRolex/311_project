<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Payment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Total Payment</h2>
        <table>
            <thead>
                <tr>
                    <th>Admin Name</th>
                    <th>Total Billing</th>
                    <th>Total Payment</th>
                    <th>Total Sum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include('../connection.php');
                $sql = "SELECT 
    Administrator.name AS admin_name,
    CASE 
        WHEN COALESCE(SUM(Billing.total), 0) = 0 THEN NULL
        ELSE COALESCE(SUM(Billing.total), 0)
    END AS total_billing,
    CASE 
        WHEN COALESCE(SUM(Payment.total_payment), 0) = 0 THEN NULL
        ELSE COALESCE(SUM(Payment.total_payment), 0)
    END AS total_payment,
    CASE 
        WHEN (COALESCE(SUM(Billing.total), 0) + COALESCE(SUM(Payment.total_payment), 0)) = 0 THEN NULL
        ELSE COALESCE(SUM(Billing.total), 0) + COALESCE(SUM(Payment.total_payment), 0)
    END AS total_sum
FROM 
    Administrator
LEFT JOIN 
    Billing 
ON 
    Administrator.admin_id = Billing.admin_id
LEFT JOIN 
    Payment 
ON 
    Administrator.admin_id = Payment.admin_id
GROUP BY 
    Administrator.name
HAVING 
    (COALESCE(SUM(Billing.total), 0) + COALESCE(SUM(Payment.total_payment), 0)) > 0;


";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>{$row['admin_name']}</td>
                        <td>{$row['total_billing']}</td>
                        <td>{$row['total_payment']}</td>
                        <td>{$row['total_sum']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No Payment found</td></tr>";
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
