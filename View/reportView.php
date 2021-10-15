<main>
    <h1 class="center">Les commentaires signalés <i class="fas fa-exclamation-triangle orange"></i></h1>
    <div id="containerCategories" class=" flexRow wrap">
        <div id="menuAccount" class="width20">
            <a href="../index.php?controller=user&action=view&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes informations</p>
            </a>
            <a href="../index.php?controller=user&action=sujects&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes sujets</p>
            </a>
            <a href="../index.php?controller=comments&action=reportAdmin&id=<?=$_SESSION['id']?>">
                <p class="border1">Les signalements</p>
            </a>
            <div class="border1">
                <form class="disconnection" method="post" action="../assets/php/disconnection.php">
                    <input type="submit" value="Me déconnecter">
                </form>
            </div>
        </div>
        <div id="containerAccount" class="width80 flexCenter">
            <div class="width80 border flexCenter flexRow wrap containerReport">
                <?php
                if (isset($var['comments'])) {
                    foreach ($var['comments'] as $comment) {?>
                        <div class="comments borderOrange flexColumn width80">
                            <div class="pseudo gray flexRow align">
                                <p class="comPseudo"><?=$comment->getUserFk()->getPseudo()?> / <?=$comment->getDate()?></p>
                                <a href="../index.php?controller=comments&action=update&id=<?=$comment->getId()?>" class="button3 buttonPos6"><i class="fas fa-edit"></i></a>
                                <a href="../index.php?controller=comments&action=delete&id=<?=$comment->getId()?>" class="button3 buttonPos7"><i class="fas fa-trash-alt"></i></a>
                                <a href="../index.php?controller=comments&action=archive&id=<?=$comment->getId()?>" class="button3 buttonPos8"><i class="fas fa-archive"></i></a>
                            </div>
                            <div class="comment">
                                <p class="black"><?=$comment->getComment()?></p>
                            </div>
                        </div>
                        <?php
                    }
                }?>
            </div>
        </div>
    </div>
</main>
