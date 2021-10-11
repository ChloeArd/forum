<?php
use Forum\DB;

require "../../Model/DB.php";

if (isset($_POST["pseudo"], $_POST["password"])) {
    $bdd = DB::getInstance();

    $pseudo = htmlentities(trim($_POST['pseudo']));
    $password = htmlentities(trim($_POST['password']));

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
    $stmt->bindParam(":pseudo", $pseudo);
    $stmt->execute();

    $user = $stmt->fetch();
    // I check that the password encrypted on my database that I retrieved using the '$ user [' password ']' loop corresponds to the password entered by the user
    if (password_verify($password, $user['password'])) {
        // If the 2 password correspond then we open the session and we store the user's data in a session.
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $password;
        $_SESSION['role_fk'] = $user['role_fk'];
        $id = $_SESSION['id'];

        header("Location: ../../index.php?success=0&id=$id");
    }
    else {
        header("Location: ../../index.php?controller=home&page=connection&error=1");
    }
}
else {
    header("Location: ../../index.php?controller=home&page=connection&error=2");
}