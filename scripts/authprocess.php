<?php
session_start();
require_once(__DIR__ . '/../includes/db.php');
require_once "../includes/functions.php";

if (isset($_POST['register'])) {

    $nom = cleanInput($_POST['nom']);
    $prenom = cleanInput($_POST['prenom']);
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        header("Location: ../public/register.php?error=empty");
        exit();
    }

    if (!isValidEmail($email)) {
        header("Location: ../public/register.php?error=email");
        exit();
    }
    if ($password !== $_POST['passwordRepeat']) {
    header("Location: ../public/register.php?error=password");
    exit();
}
    // Hash password 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // check if user was created ?
    $sql = "SELECT id_user FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // email déjà kayn
        header("Location: ../public/login.php?error=exists");
        exit();
   }
    // Insert DB
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $hashedPassword]);

    header("Location: ../public/login.php?success=1");
}

if (isset($_POST['login'])) {

    $email = cleanInput($_POST['email']);
    $password =cleanInput($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = [
            'nom' => $user['nom'],
            'role' => $user['role']
        ];

        header("Location: ../public/dashboard.php");
    } else {
        header("Location: ../public/regester.php?error=invalid");
    }
}