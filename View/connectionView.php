<?php
$return = "";
$id = "";

if (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Votre compte est confirmé !";
            break;
    }
}
elseif (isset($_GET['error'])) {
    $id = "error";
    switch ($_GET['error']) {
        case '0':
            $return = "Le mot de passe est incorrect !";
            break;
        case '1':
            $return = "Tous les champs ne sont pas remplis !";
            break;
        case '2':
            $return = "Votre compte n'a pas été confirmé, veuillez vérifier votre boite mail !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>

<main>
    <h1 class="center">Connexion</h1>
    <form method="post" action="../assets/php/connection.php" class="flexColumn flexCenter width80 auto">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" name="submit" value="Me connecter" class="button">
    </form>
</main>