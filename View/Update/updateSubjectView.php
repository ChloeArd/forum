<?php
$id = $_GET['id'];
$categorie_fk = $_GET['id2'];
$manager = new \Forum\Subject\SubjectManager();
$subject = $manager->getSubjectId($id, $categorie_fk);

foreach ($subject as $sub) { ?>
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