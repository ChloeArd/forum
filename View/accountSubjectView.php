<main>
    <h1 class="center">Mes sujets</h1>
    <div id="containerCategories" class=" flexRow wrap">
        <div id="menuAccount" class="width20">
            <a href="../index.php?controller=user&action=view&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes informations</p>
            </a>
            <a href="../index.php?controller=user&action=sujects&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes sujets</p>
            </a>
            <?php
            if ($_SESSION['role_fk'] === "1") {?>
                <a href="../index.php?controller=comments&action=reportAdmin&id=<?=$_SESSION['id']?>">
                    <p class="border1">Les signalements</p>
                </a>
                <?php
            }
            ?>
            <div class="border1">
                <form class="disconnection" method="post" action="../assets/php/disconnection.php">
                    <input type="submit" value="Me déconnecter">
                </form>
            </div>
        </div>
        <div id="containerAccount" class="width80 flexCenter">
            <div class="width80 border flexCenter flexRow wrap">
                <?php
                if (isset($var['subjects'])) {
                    foreach ($var['subjects'] as $subject) {
                        if ($_SESSION['id'] == $subject->getUserFk()->getId()) {?>
                            <a href="../index.php?controller=subjects&action=viewOnly&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="flexColumn flexCenter categories marg20 white">
                                <img class="imageHome" src="<?=$subject->getPicture()?>">
                                <p class="size20 center"><?=$subject->getTitle()?></p>
                                <p class="margTop15 center">Catégorie : <?=$subject->getCategorieFk()->getTitle()?></p>
                                <?php
                                if ($subject->getArchive() === 1 || $subject->getCategorieFk()->getArchive() === 1) { ?>
                                    <p class="red">(Archivé)</p>
                                    <?php
                                }
                                ?>
                            </a>
                        <?php
                        }
                    }
                }?>
            </div>
        </div>
    </div>
</main>
