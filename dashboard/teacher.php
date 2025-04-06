<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <h2>Welcome, <?php echo $_SESSION['user']['name']; ?></h2>
    <div class="dashboard-content">
        <section class="gradebook">
            <h3>Gradebook</h3>
            <table>
                <tr>
                    <th>Student</th>
                    <th>Research Paper</th>
                    <th>Grade</th>
                </tr>
                <tr>
                    <td>Student 1</td>
                    <td>Climate Change Research</td>
                    <td><input type="text" value="88"></td>
                </tr>
            </table>
        </section>
        <section class="research-approval">
            <h3>Research Approval Queue</h3>
            <ul>
                <li>New Research: "AI in Education" - <a href="#">Review</a></li>
            </ul>
        </section>
    </div>
    <?php include '../components/footer.php'; ?>
</body>
</html>