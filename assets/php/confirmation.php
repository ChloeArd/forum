<?php
use Forum\DB;
require "../../Model/DB.php";

if (isset($_GET['pseudo'], $_GET['key'])) {
    $bdd = DB::getInstance();

    $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
    $key = htmlspecialchars($_GET['key']);

    $requete = $bdd->prepare("SELECT * FROM user WHERE pseudo = :pseudo AND confirmkey = :confirmkey");
    $requete->bindValue(":pseudo", $pseudo);
    $requete->bindValue(":confirmkey", $key);
    $requete->execute();

    $existe = $requete->rowCount();

    // if the user exists
    if ($existe == 1) {
        $user = $requete->fetch();
        if ($user['confirme'] != 1) {
            $update = $bdd->prepare("UPDATE user SET confirme = :confirme WHERE pseudo = :pseudo AND confirmkey = :confirmkey");
            $update->bindValue(":confirme", 1);
            $update->bindValue(":pseudo", $pseudo);
            $update->bindValue(":confirmkey", $key);
            $update->execute();

            echo "Votre compte a bien été confirmé !";
        }
        else {
            echo "Votre compte a déjà été confirmé !";
        }
    }
    else {
        echo "L'utilisateur n'existe pas !";
    }
}
