<?php
$id = $_GET['id'];
$manager = new \Forum\Subject\SubjectManager();
$subject = $manager->getSubjectId2($id);

foreach ($subject as $sub) { ?>
    <main>
        <h1 class="center">Archiver le sujet : <span class="salmon"><?=$sub->getTitle()?></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment archiver ce sujet ?</h2>
        <p class="gray center margTop15">Si oui, le sujet et ses commentaires ne seront plus éditable et modifiable !</p>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <input type="hidden" value="<?=$sub->getId()?>" name="id">
            <input type="hidden" value="<?=$sub->getCategorieFk()->getId()?>" name="categorie_fk">
            <input type="hidden" value="<?=$sub->getUserFk()->getId()?>" name="user_fk">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../index.php?controller=subjects&action=viewOnly&id=<?=$sub->getId()?>&id2=<?=$sub->getCategorieFk()->getId()?>" class="button2">Non</a>
        </form>
    </main>
    <?php
}
