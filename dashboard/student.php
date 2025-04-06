<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'student') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <h2>Welcome, <?php echo $_SESSION['user']['name']; ?></h2>
    <div class="dashboard-content">
        <section class="upcoming-deadlines">
            <h3>Upcoming Deadlines</h3>
            <ul>
                <li>Research Paper Submission - June 15</li>
                <li>Math Quiz - June 18</li>
            </ul>
        </section>
        <section class="quick-links">
            <h3>Quick Access</h3>
            <a href="../research/search.php" class="btn">Research Repository</a>
            <a href="#" class="btn">Submit Assignment</a>
        </section>
    </div>
    <?php include '../components/footer.php'; ?>
</body>
</html>