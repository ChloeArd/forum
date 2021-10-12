<?php
$return = "";
$id = "";

if (isset($_GET['error'])) {
    $id = "error";
    switch ($_GET['error']) {
        case '0':
            $return = "L'email ou le pseudo est déjà utilisé !";
            break;
        case '1':
            $return = "Le pseudo contient plus de 20 caractères !";
            break;
        case '2' :
            $return = "Le mot de passe ne contient pas une majuscule ou une une minuscule ou un chiffre ou est inférieure à 8 caractères";
            break;
        case '3' :
            $return = "Les 2 mots de passes ne correspondent pas";
            break;
        case '4' :
            $return = "L'email n'est pas valide";
            break;
        case '5' :
            $return = "Tous les champs ne sont pas entrées";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
    <h1 class="center">Inscription</h1>
    <form method="post" action="../assets/php/registration.php" class="flexColumn flexCenter width80 auto">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" max="20" name="pseudo" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Mot de passe</label>
        <p class="gray size12">Le mot de passe doit contenir : majuscule, minuscule, chiffre et min 8 carcatères</p>
        <input type="password" id="password" min="8" name="password" required>
        <label for="passwordR">Répet du mot de passe</label>
        <input type="password" id="passwordR" min="8" name="passwordR" required>
        <input type="submit" name="submit" value="M'inscrire" class="button">
    </form>
</main>
