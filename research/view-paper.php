<?php
// Get paper ID from URL
$paperId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Load research data
$papers = json_decode(file_get_contents('../data/research.json'), true);
$paper = null;

foreach ($papers as $p) {
    if ($p['id'] === $paperId) {
        $paper = $p;
        break;
    }
}

if (!$paper) {
    header('Location: search.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($paper['title']); ?></title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    
    <main class="paper-view">
        <h1><?php echo htmlspecialchars($paper['title']); ?></h1>
        <div class="paper-meta">
            <span>Author: <?php echo htmlspecialchars($paper['author']); ?></span>
            <span>Year: <?php echo htmlspecialchars($paper['year']); ?></span>
            <span>Subject: <?php echo htmlspecialchars($paper['subject']); ?></span>
        </div>
        
        <div class="paper-content">
            <h2>Abstract</h2>
            <p><?php echo htmlspecialchars($paper['abstract']); ?></p>
            
            <h2>Keywords</h2>
            <div class="keywords">
                <?php foreach ($paper['keywords'] as $keyword): ?>
                    <span class="keyword"><?php echo htmlspecialchars($keyword); ?></span>
                <?php endforeach; ?>
            </div>
            
            <a href="<?php echo htmlspecialchars($paper['file_url']); ?>" class="download-btn" download>
                Download Full Paper
            </a>
        </div>
    </main>
    
    <?php include '../components/footer.php'; ?>
</body>
</html>