<?php
$id = $_GET['id'];
$manager = new \Forum\Categorie\CategorieManager();
$categorie = $manager->getCategorieId($id);

foreach ($categorie as $cat) { ?>
    <main>
        <h1 class="center">Modifier la catégorie : <span class="salmon"><?=$cat->getTitle()?></span></h1>
        <form method="post" action="#" class="flexColumn flexCenter width80 auto" enctype="multipart/form-data">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?=$cat->getTitle()?>">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?=$cat->getDescription()?></textarea>
            <label for="picture">Modifier le lien d'une image</label>
            <input type="text" name="picture" id="picture" value="<?=$cat->getPicture()?>">
            <img class="imageUpdate" src="<?=$cat->getPicture()?>" alt="<?=$cat->getTitle()?>">
            <input type="hidden" value="id" name="id">
            <input type="hidden" value="user_fk" name="user_fk">
            <input type="submit" name="submit" value="Modifier" class="button">
        </form>
    </main>
<?php
}
