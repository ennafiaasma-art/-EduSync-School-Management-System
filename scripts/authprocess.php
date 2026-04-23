<?php 

include("./public/login.php");
include("./scripts/authprocess.php"); // contient connectAcount()

$emailErr = "";
$passwordErr = "";
$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  // Si tout est valide
  if (empty($emailErr) && empty($passwordErr)) {

      if (connectAcount($conn, $email, $password)) {
          header("Location: ./public/dashboard.php");
          exit();
      } else {
          $passwordErr = "Email ou mot de passe incorrect";
      }
  }
}

function test_input($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
?>