<?php
session_start();

// Load user data
$users = json_decode(file_get_contents('../data/users.json'), true);

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    foreach ($users as $user) {
        if ($user['email'] === $email && 
            $user['password'] === $password && 
            $user['role'] === $role) {
            
            $_SESSION['user'] = $user;
            header('Location: ../dashboard/' . $role . '.php');
            exit();
        }
    }
    
    // If login fails
    header('Location: ../login.php?error=Invalid credentials');
    exit();
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>