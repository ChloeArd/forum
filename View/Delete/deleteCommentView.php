<?php
$id = $_GET['id'];
$manager = new \Forum\Comment\CommentManager();
$comment = $manager->getCommentId($id);

foreach ($comment as $com) { ?>
<main>
    <h1 class="center">Supprimer le commentaire de : <span class="salmon"><?=$com->getUserFk()->getPseudo()?></span></h1>
    <h2 class="center margTop40">Voulez vous vraiment supprimer ce commentaire ?</h2>
    <p class="gray center margTop15">Si oui, le commentaire sera définitivement supprimé !</p>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <input type="hidden" value="<?=$com->getId()?>" name="id">
        <input type="submit" name="submit" value="Oui" class="button margTop15">
        <a href="../subjectView.php" class="button2">Non</a>
    </form>
</main>
<?php
}