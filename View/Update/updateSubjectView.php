<?php

use Chloe\Forum\Model\Manager\SubjectManager;

$return = "";
$id = "";

if (isset($_GET['error'])) {
    $id = "error";
    switch ($_GET['error']) {
        case '0':
            $return = " Le titre est supérieur à 40 caractères !";
            break;
        case '1':
            $return = "L'URL de l'image n'est pas valide !";
            break;
    }
}

$id = $_GET['id'];
$categorie_fk = $_GET['id2'];
$manager = new SubjectManager();
$subject = $manager->getSubjectId($id, $categorie_fk);

foreach ($subject as $sub) { ?>
    <div id='<?=$id?>' class='modal2 center colorWhite'><?=$return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
    <main>
        <h1 class="center">Modifier le sujet : <span class="salmon"><?=$sub->getTitle()?></span></h1>
        <form method="post" action="" class="flexColumn flexCenter auto" enctype="multipart/form-data">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" maxlength="40" value="<?=$sub->getTitle()?>" required>
            <label for="picture">Modifier le lien d'une image</label>
            <input type="text" name="picture" id="picture" value="<?=$sub->getPicture()?>" required>
            <img class="imageUpdate" src="<?=$sub->getPicture()?>" alt="<?=$sub->getTitle()?>">
            <label for="description">Description</label>
            <textarea name="description" id="description" required><?=$sub->getDescription()?></textarea>
            <label for="content">Contenu</label>
            <textarea name="text" id="content" required><?=$sub->getText()?></textarea>
            <input type="hidden" value="<?=$sub->getId()?>" name="id">
            <input type="hidden" value="<?= date('Y-m-d')?>" name="date">
            <input type="hidden" value="<?=$sub->getCategorieFk()->getId()?>" name="categorie_fk">
            <input type="hidden" value="<?=$sub->getUserFk()->GetId()?>" name="user_fk">
            <input type="submit" name="submit" value="Modifier" class="button">
        </form>
    </main>
<?php
}