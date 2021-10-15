<?php
$id = $_GET['id'];
$manager = new \Forum\Comment\CommentManager();
$comment = $manager->getCommentId($id);

foreach ($comment as $com) { ?>
    <main>
        <h1 class="center">Signaler le commentaire de : <span class="salmon"><?=$com->getUserFk()->getPseudo()?></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment signaler ce commentaire ?</h2>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <input type="hidden" value="<?=$com->getId()?>" name="id">
            <input type="hidden" value="<?=$com->getCategorieFk()->getId()?>" name="categorie_fk">
            <input type="hidden" value="<?=$com->getSubjectFk()->getId()?>" name="subject_fk">
            <input type="hidden" value="<?=$com->getUserFk()->getId()?>" name="user_fk">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../index.php?controller=subjects&action=viewOnly&id=<?=$com->getSubjectFk()->getId()?>&id2=<?=$com->getCategorieFk()->getId()?>" class="button2">Non</a>
        </form>
    </main>
    <?php
}