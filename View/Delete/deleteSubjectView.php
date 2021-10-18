<?php

use Chloe\Forum\Model\Manager\SubjectManager;

$id = $_GET['id'];
$manager = new SubjectManager();
$subject = $manager->getSubjectId2($id);

foreach ($subject as $sub) { ?>
    <main>
        <h1 class="center">Supprimer le sujet : <span class="salmon"><?=$sub->getTitle()?></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment supprimer ce sujet ?</h2>
        <p class="gray center margTop15">Si oui, tous le contenu et les commentaires seront définitivement supprimés !</p>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <input type="hidden" value="<?=$sub->getId()?>" name="id">
            <input type="hidden" value="<?=$sub->getTitle()?>" name="title">
            <input type="hidden" value="<?=$sub->getDescription()?>" name="description">
            <input type="hidden" value="<?=$sub->getDate()?>" name="date">
            <input type="hidden" value="<?=$sub->getText()?>" name="text">
            <input type="hidden" value="<?=$sub->getPicture()?>" name="picture">
            <input type="hidden" value="<?=$sub->getCategorieFk()->getId()?>" name="categorie_fk">
            <input type="hidden" value="<?=$sub->getUserFk()->getId()?>" name="user_fk">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../index.php?controller=subjects&action=viewOnly&id=<?=$sub->getId()?>&id2=<?=$sub->getCategorieFk()->getId()?>" class="button2">Non</a>
        </form>
    </main>
<?php
}