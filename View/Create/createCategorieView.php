<?php
$return = "";
$id = "";

if (isset($_GET['error'])) {
    $id = "error";
    switch ($_GET['error']) {
        case '0':
            $return = "Le titre ne doit pas dépassé 20 caractères !";
            break;
        case '1':
            $return = "L'email n'est pas valide !";
            break;
        case '2' :
            $return = "Tous les champs ne sont pas complétés !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
        <h1 class="center">Ajouter une catégorie</h1>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" maxlength="20" required>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
            <label for="picture">Insérer le lien d'une image</label>
            <input type="text" name="picture" id="picture" required>
            <input type="hidden" value="<?=$_SESSION['id']?>" id="user_fk" name="user_fk">
            <input type="submit" name="submit" value="Créer" class="button">
        </form>
    </main>
