<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<section class="bg-gray-50 dark:bg-gray-900">
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen">

<div class="w-full bg-white rounded-lg shadow sm:max-w-md p-6">

<h1 class="text-xl font-bold mb-4">Register</h1>

<!-- ERRORS -->
<?php if (isset($_GET['error'])): ?>
    <p class="text-red-500 text-sm mb-3">
        <?php
        if ($_GET['error'] == "empty") echo "Tous les champs sont obligatoires";
        if ($_GET['error'] == "email") echo "Email invalide";
        if ($_GET['error'] == "password") echo "Les mots de passe ne correspondent pas";
        ?>
    </p>
<?php endif; ?>

<form  action="../scripts/authprocess.php" method="POST">

<input type="text" name="nom" placeholder="Nom" class=" w-full mb-3 p-2 border rounded" >

<input type="text" name="prenom" placeholder="Prénom" class="w-full mb-3 p-2 border rounded" >

<input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" >

<input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" >

<input type="password" name="passwordRepeat" placeholder="Repeat Password" class="w-full mb-3 p-2 border rounded" >

<button type="submit" name="register" class="w-full bg-green-600 text-white p-2 rounded">
    Sign up
</button>

</form>

</div>
</div>
</section>
</body>
</html>