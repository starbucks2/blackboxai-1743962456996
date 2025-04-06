<?php
session_start();
require_once '../scripts/auth.php';

// Only allow logged-in users
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: submit.php?error=Invalid request');
    exit();
}

// Validate inputs
$required = ['title', 'abstract', 'keywords', 'subject', 'file'];
foreach ($required as $field) {
    if (empty($_POST[$field]) && $field !== 'file') {
        header('Location: submit.php?error=All fields are required');
        exit();
    }
}

// Handle file upload
$uploadDir = '../uploads/research/';
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['application/pdf'];

// Create upload directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Validate file
$file = $_FILES['file'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    header('Location: submit.php?error=File upload error');
    exit();
}

if ($file['size'] > $maxFileSize) {
    header('Location: submit.php?error=File too large (max 5MB)');
    exit();
}

if (!in_array($file['type'], $allowedTypes)) {
    header('Location: submit.php?error=Only PDF files are allowed');
    exit();
}

// Generate unique filename
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid() . '.' . $extension;
$destination = $uploadDir . $filename;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $destination)) {
    header('Location: submit.php?error=Failed to save file');
    exit();
}

// Add to research database
$researchData = json_decode(file_get_contents('../data/research.json'), true);
$newResearch = [
    'id' => count($researchData) + 1,
    'title' => $_POST['title'],
    'author' => $_SESSION['user']['name'],
    'year' => date('Y'),
    'subject' => $_POST['subject'],
    'abstract' => $_POST['abstract'],
    'keywords' => array_map('trim', explode(',', $_POST['keywords'])),
    'file_url' => $destination,
    'approved' => false,
    'grade_level' => '11-12'
];

$researchData[] = $newResearch;
file_put_contents('../data/research.json', json_encode($researchData, JSON_PRETTY_PRINT));

header('Location: submit.php?success=1');
exit();
?>