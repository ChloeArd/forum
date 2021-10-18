<?php

use Chloe\Forum\Model\Manager\CategorieManager;

$id = $_GET['id'];
$manager = new CategorieManager();
$categorie = $manager->getCategorieId($id);

foreach ($categorie as $cat) { ?>
    <main>
        <h1 class="center">Archiver la catégorie : <span class="salmon"><?=$cat->getTitle()?></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment archiver cette catégorie ?</h2>
        <p class="gray center margTop15">Si oui, tous les sujets et commentaires ne seront plus editable et modifiable de même pour la catégorie !</p>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <input type="hidden" value="<?=$cat->getId()?>" name="id">
            <input type="hidden" value="<?=$cat->getUserFk()->getId()?>" name="user_fk">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../index.php?controller=subjects&action=view&id=<?=$id?>" class="button2">Non</a>
        </form>
    </main>
    <?php
}