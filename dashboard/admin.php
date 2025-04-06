<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <h2>Welcome, <?php echo $_SESSION['user']['name']; ?></h2>
    <div class="dashboard-content">
        <section class="user-management">
            <h3>User Management</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>Student</td>
                    <td>
                        <button>Edit</button>
                        <button>Suspend</button>
                    </td>
                </tr>
            </table>
        </section>
        <section class="system-settings">
            <h3>System Settings</h3>
            <form>
                <label>School Name:</label>
                <input type="text" value="Becuran National High School">
                <button type="submit">Save Settings</button>
            </form>
        </section>
    </div>
    <?php include '../components/footer.php'; ?>
</body>
</html>