<main>
    <?php
    if (isset($var['subject'])) {
        foreach ($var['subject'] as $subject) { ?>
            <h1 class="center"><?=$subject->getTitle()?></h1>
            <p class="center gray">Par <?=$subject->getUserFk()->getPseudo()?></p>
            <div class="height">
                <a href="../index.php?controller=subjects&action=update&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="button buttonAbsolute1"><i class="fas fa-edit"></i></a>
            </div>
            <div class="height">
                <a href="#" class="button buttonAbsolute1"><i class="fas fa-archive"></i></a>
            </div>
            <div class="height">
                <a href="../index.php?controller=subjects&action=delete&id=<?=$subject->getId()?>" class="button buttonAbsolute1"><i class="fas fa-trash-alt"></i></a>
            </div>
            <div class="flexCenter">
                <img class="imageCategorie" src="<?=$subject->getPicture()?>">
            </div>
            <h2 class="center"><?=$subject->getDescription()?></h2>
            <p class="text"><?=$subject->getText()?></p>
        <?php
        }
    }
    ?>

    <div class="lineHorizontal"></div>
    <div class="flexRow flexCenter">
        <h2 class="gray">Commentaires</h2>
        <a href="Create/createCommentView.php" class="button buttonAbsolute1"><i class="fas fa-plus"></i> Ajouter un commentaire</a>
    </div>

    <div class="comments flexColumn">
        <div class="pseudo gray flexRow align">
            <p>Pseudo - 00/00/0000</p>
            <a href="Update/updateCommentView.php" class="button3"><i class="fas fa-edit"></i></a>
            <a href="Delete/deleteCommentView.php" class="button3 buttonPos3"><i class="fas fa-trash-alt"></i></a>
            <a href="#" class="button3 buttonPos4"><i class="fas fa-archive"></i></a>
        </div>
        <div class="comment">
            <p>Commentaires blablabla</p>
        </div>
    </div>

    <div class="comments flexColumn">
        <div class="pseudo gray flexRow align">
            <p>Pseudo - 00/00/0000</p>
            <a href="Update/updateCommentView.php" class="button3"><i class="fas fa-edit"></i></a>
            <a href="Delete/deleteCommentView.php" class="button3 buttonPos3"><i class="fas fa-trash-alt"></i></a>
            <a href="#" class="button3 buttonPos4"><i class="fas fa-archive"></i></a>
        </div>
        <div class="comment">
            <p>Commentaires blablabla</p>
        </div>
    </div>
</main>