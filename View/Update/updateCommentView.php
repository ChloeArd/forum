<?php
$id = $_GET['id'];
$manager = new \Forum\Comment\CommentManager();
$comment = $manager->getCommentId($id);

foreach ($comment as $com) { ?>
    <main>
        <h1 class="center">Modifier un commentaire</h1>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment" required><?=$com->getComment()?></textarea>
            <input type="hidden" value="id" name="id">
            <input type="hidden" value="<?=date("Y-m-d")?>" name="date">
            <input type="hidden" value="<?=$com->getId()?>" name="id">
            <input type="hidden" value="<?=$com->getCategorieFk()->getId()?>" name="categorie_fk">
            <input type="hidden" value="<?=$com->getSubjectFk()->getId()?>" name="subject_fk">
            <input type="hidden" value="<?=$com->getUserFk()->getId()?>" name="user_fk">
            <input type="submit" name="submit" value="Modifier" class="button">
        </form>
    </main>
<?php
}