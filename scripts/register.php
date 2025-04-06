<?php
session_start();

// Load existing users
$users = json_decode(file_get_contents('../data/users.json'), true);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../register.php?error=Invalid request');
    exit();
}

// Validate inputs
$required = ['name', 'email', 'password', 'role'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        header('Location: ../register.php?error=All fields are required');
        exit();
    }
}

// Check for existing email
$email = $_POST['email'];
foreach ($users as $user) {
    if ($user['email'] === $email) {
        header('Location: ../register.php?error=Email already exists');
        exit();
    }
}

// Create new user
$newUser = [
    'id' => count($users) + 1,
    'name' => $_POST['name'],
    'email' => $email,
    'password' => $_POST['password'], // Note: Passwords should be hashed in production
    'role' => $_POST['role']
];

// Add new user to the users array
$users[] = $newUser;

// Save updated users data
file_put_contents('../data/users.json', json_encode($users, JSON_PRETTY_PRINT));

// Redirect to login page with success message
header('Location: ../login.php?success=Registration successful. Please log in.');
exit();
?>