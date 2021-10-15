<?php

use Chloe\Forum\Model\Manager\CategorieManager;

$id = $_GET['id'];
$manager = new CategorieManager();
$categorie = $manager->getCategorieId($id);

foreach ($categorie as $cat) { ?>
    <main>
        <h1 class="center">Supprimer la catégorie : <span class="salmon"><?=$cat->getTitle()?></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment supprimer cette catégorie ?</h2>
        <p class="gray center margTop15">Si oui, tous les sujets et commentaires seront définitivement supprimés !</p>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <input type="hidden" value="<?=$cat->getId()?>" name="id">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../index.php?controller=subjects&action=view&id=<?=$id?>" class="button2">Non</a>
        </form>
    </main>
<?php
}