<?php
$current_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<header>
    <div class="logo">
        <h1>Becuran National High School</h1>
    </div>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../research/search.php">Research Repository</a>
        <?php if($current_user): ?>
            <?php if($current_user['role'] === 'student'): ?>
                <a href="../research/submit.php">Submit Research</a>
            <?php endif; ?>
            <a href="../dashboard/<?php echo $current_user['role']; ?>.php">Dashboard</a>
            <a href="../scripts/logout.php">Logout</a>
        <?php else: ?>
            <a href="../login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>