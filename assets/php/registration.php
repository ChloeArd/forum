<?php

use Chloe\Forum\Model\DB;
require "../../source/Model/DB.php";

if (isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST['passwordR'])) {
    $bdd = DB::getInstance();

    $pseudo = htmlentities(trim($_POST["pseudo"]));
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
            header("Location: ../../index.php?controller=home&page=registration&error=0");
        }
        // The pseudo must contain a maximum of 20 characters
        elseif (strlen($pseudo) > 20) {
            header("Location: ../../index.php?controller=home&page=registration&error=1");
        }
        // Check if the email address is valid.
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $maj = preg_match('@[A-Z]@', $password);
            $min = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);

            // Check if the 2 entered passwords are identical
            if ($password === $passwordR) {
                // Checks if the password contains upper case, lower case, number and at least 8 characters.
                if ($maj && $min && $number && strlen($password) >= 8) {
                    $lengthKey = 12;
                    $key = "";

                    // Create a key
                    for ($i = 1; $i < $lengthKey; $i++) {
                        $key.= mt_rand(0,9);
                    }

                    $sql = $bdd->prepare("INSERT INTO user (pseudo, email, password, role_fk, confirmkey) 
                        VALUES (:pseudo, :email, :password, :role_fk, :confirmkey)");

                    $sql->bindValue(':pseudo', $pseudo);
                    $sql->bindValue(':email', $email);
                    $sql->bindValue(':password', $encryptedPassword);
                    // People who register automatically have role 2 : user.
                    $sql->bindValue(':role_fk', 2);
                    $sql->bindValue(':confirmkey', $key);
                    $sql->execute();

                    // send a mail for confirmation
                    $pseudo = urlencode($pseudo);
                    $to = $email;
                    $subject = "Confirmation de compte.";
                    $message = "
                            <html lang='fr'>
                                <body>
                                    <h1>Bienvenue $pseudo, sur le Forum Salmon !</h1>
                                    <br><br>
                                    <p>Pour confirmer votre compte, cliquez sur le <a href='http://localhost:8000/assets/php/confirmation.php?pseudo=$pseudo&key=$key?>'>lien</a>.</p>
                                </body>
                            </html>
                            ";
                    $message = wordwrap($message, 70, "\r\n");
                    $headers = [
                        'Reply-To' => 'chloe.ardoise@gmail.com',
                        'X-mailer' => 'PHP/' . phpversion()
                    ];
                    // Send account verification email
                    mail($to, $subject, $message, $headers, "-f chloe.ardoise@gmail.com");

                    header("Location: ../../index.php?controller=home&page=registration&success=0");
                }
                else {
                    header("Location: ../../index.php?controller=home&page=registration&error=2");
                }
            }
            else {
                header("Location: ../../index.php?controller=home&page=registration&error=3");
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