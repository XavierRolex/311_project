<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "Admin") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../login/style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .menu {
            width: 80%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .menu-item {
            margin-bottom: 10px;
        }

        .menu-item > button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: left;
        }

        .menu-item > button:hover {
            background-color: #0056b3;
        }

        .sub-menu {
            display: none;
            margin-top: 10px;
            margin-left: 20px;
            flex-direction: column;
        }

        .sub-menu button {
            background-color: #f4f4f9;
            color: #007bff;
            border: none;
            padding: 5px 10px;
            text-align: left;
            cursor: pointer;
        }

        .sub-menu button:hover {
            text-decoration: underline;
        }

        .sub-sub-menu {
            display: none;
            margin-left: 20px;
            flex-direction: column;
        }

        .sub-sub-menu button {
            font-size: 14px;
        }

        .logout-container {
            margin-top: 20px;
            text-align: center;
        }

        .logout-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin</p>
    </div>
    <div class="container">
        <div class="menu">
            <!-- Employee Management -->
            <div class="menu-item">
                <button onclick="toggleMenu('employeeMenu')">Employee</button>
                <div id="employeeMenu" class="sub-menu">
                    <button onclick="location.href='../employee/employee_list.php'">Employee List</button>
                    <button onclick="location.href='../employee/add_employee.php'">Add Employee</button>
                </div>
            </div>

            <!-- Resource Allocation -->
            <div class="menu-item">
                <button onclick="toggleMenu('resourceMenu')">Resource Allocation</button>
                <div id="resourceMenu" class="sub-menu">
                    <button onclick="toggleMenu('wardMenu')">Ward</button>
                    <div id="wardMenu" class="sub-sub-menu">
                        <button onclick="location.href='../ward/view.php'">View</button>
                        <button onclick="location.href='../ward/update.php'">Update</button>
                    </div>
                    <button onclick="toggleMenu('roomMenu')">Room</button>
                    <div id="roomMenu" class="sub-sub-menu">
                        <button onclick="location.href='../room/view.php'">View</button>
                        <button onclick="location.href='../room/update.php'">Update</button>
                    </div>
                    <button onclick="toggleMenu('equipmentMenu')">Medical Equipment</button>
                    <div id="equipmentMenu" class="sub-sub-menu">
                        <button onclick="location.href='../equipment/view.php'">View</button>
                        <button onclick="location.href='../equipment/update.php'">Update</button>
                        <button onclick="location.href='../equipment/add.php'">Add</button>
                        <button onclick="location.href='../equipment/delete.php'">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Medicine -->
            <div class="menu-item">
                <button onclick="toggleMenu('medicineMenu')">Medicine</button>
                <div id="medicineMenu" class="sub-menu">
                    <button onclick="location.href='../medicine/view.php'">View</button>
                    <button onclick="location.href='../medicine/update.php'">Update</button>
                </div>
            </div>

            <!-- Medical Supplies -->
            <div class="menu-item">
                <button onclick="toggleMenu('suppliesMenu')">Medical Supplies</button>
                <div id="suppliesMenu" class="sub-menu">
                    <button onclick="location.href='../supplies/view.php'">View</button>
                    <button onclick="location.href='../supplies/update.php'">Update</button>
                </div>
            </div>

            <!-- Payment -->
            <div class="menu-item">
                <button onclick="toggleMenu('paymentMenu')">Payment</button>
                <div id="paymentMenu" class="sub-menu">
                    <button onclick="location.href='../Payment/view.php'">Total Payment</button>
                </div>
            </div>

            <!-- Doctor Management -->
            <div class="menu-item">
                <button onclick="toggleMenu('doctorMenu')">Doctor</button>
                <div id="doctorMenu" class="sub-menu">
                    <button onclick="location.href='../doctor/view.php'">View</button>
                    <button onclick="location.href='../doctor/add.php'">Add</button>
                    <button onclick="location.href='../doctor/delete.php'">Delete</button>
                    <button onclick="location.href='../doctor/update.php'">Update</button>
                </div>
            </div>

            <!-- Nurse Management -->
            <div class="menu-item">
                <button onclick="toggleMenu('nurseMenu')">Nurse</button>
                <div id="nurseMenu" class="sub-menu">
                    <button onclick="location.href='../nurse/view.php'">View</button>
                    <button onclick="location.href='../nurse/add.php'">Add</button>
                    <button onclick="location.href='../nurse/delete.php'">Delete</button>
                    <button onclick="location.href='../nurse/update.php'">Update</button>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="logout-container">
            <form action="../index.html" method="post">
                <button type="submit" class="logout-button">Log Out</button>
            </form>
        </div>
    </div>
</body>
</html>
