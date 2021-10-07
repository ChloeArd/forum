<?php

use Forum\DB;
require "../../Model/DB.php";

if (isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST['passwordR'])) {
    $bdd = DB::getInstance();

    $pseudo = htmlentities(trim(ucfirst($_POST["pseudo"])));
    $email = htmlentities(trim($_POST["email"]));
    $password = htmlentities(trim($_POST["password"]));
    $passwordR = htmlentities(trim($_POST['passwordR']));

    // I encrypt the password.
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

    $requete = $bdd->prepare("SELECT * FROM user WHERE email = :email OR pseudo = :pseudo");
    $requete->bindParam(":email", $email);
    $requete->bindParam(":pseudo", $pseudo);
    $state = $requete->execute();

    if ($state) {
        $user = $requete->fetch();
        // Checks if email or pseudo is not in use.
        if ($user['email'] === $email || $user['pseudo'] === $pseudo) {
            header("Location: ../../View/registrationView.php?error=0");
        }
        // The pseudo must contain a maximum of 20 characters
        elseif (strlen($pseudo) > 20) {
            header("Location: ../../View/registrationView.php?error=1");
        }
        // Check if the email address is valid.
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $maj = preg_match('@[A-Z]@', $password);
            $min = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);

            if ($password === $passwordR) {
                // Checks if the password contains upper case, lower case, number and at least 8 characters.
                if ($maj && $min && $number && strlen($password) >= 8) {
                    $sql = $bdd->prepare("INSERT INTO user (pseudo, email, password, role_fk) 
                        VALUES (:pseudo, :email, :password, :role_fk)");

                    $sql->bindValue(':pseudo', $pseudo);
                    $sql->bindValue(':email', $email);
                    $sql->bindValue(':password', $encryptedPassword);
                    // People who register automatically have role 2 : user.
                    $sql->bindValue(':role_fk', 2);
                    $sql->execute();

                    header("Location: ../../View/connectionView.php?success=0");
                } else {
                    header("Location: ../../View/registrationView.php?error=2");
                }
            }
            else {
                header("Location: ../../View/registrationView.php?error=3");
            }
        }
        else {
            header("Location: ../../View/registrationView.php?error=4");
        }
    }
}
else {
    header("Location: ../../View/registrationView.php?error=5");
}