<?php
session_start();
// Only allow logged-in users to submit research
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Research</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    
    <main class="submit-research">
        <h1>Submit Research Paper</h1>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="success">Research submitted successfully!</div>
        <?php endif; ?>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Research Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="abstract">Abstract</label>
                <textarea id="abstract" name="abstract" rows="5" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="keywords">Keywords (comma separated)</label>
                <input type="text" id="keywords" name="keywords" required>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <select id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <option value="Science">Science</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Social Studies">Social Studies</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="file">Research Paper (PDF only, max 5MB)</label>
                <input type="file" id="file" name="file" accept=".pdf" required>
            </div>
            
            <button type="submit">Submit Research</button>
        </form>
    </main>
    
    <?php include '../components/footer.php'; ?>
</body>
</html>