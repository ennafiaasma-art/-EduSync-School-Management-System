<?php

include("./scripts/authprocess.php");

function connectAcount($conn, $email, $password) {
    try {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {

    
        echo $e->getMessage();
    }
}
?>