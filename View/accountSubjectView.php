<main>
    <h1 class="center">Mes sujets</h1>
    <div id="containerCategories" class=" flexRow wrap">
        <div class="width20">
            <a href="../index.php?controller=user&action=view&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes informations</p>
            </a>
            <a href="../index.php?controller=user&action=sujects&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes sujets</p>
            </a>
            <div class="border1">
                <form class="disconnection" method="post" action="../assets/php/disconnection.php">
                    <input type="submit" value="Me déconnecter">
                </form>
            </div>
        </div>
        <div class="width80 flexCenter">
            <div class="width80 border flexCenter flexRow wrap">
        <?php
        if (isset($var['subjects'])) {
            foreach ($var['subjects'] as $subject) {
                if ($_SESSION['id'] == $subject->getUserFk()->getId()) {?>
                    <a href="../index.php?controller=subjects&action=viewOnly&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="flexColumn flexCenter categories marg20 white">
                        <img class="imageHome" src="<?=$subject->getPicture()?>">
                        <p class="size20"><?=$subject->getTitle()?></p>
                        <p class="margTop15">Catégorie : <?=$subject->getCategorieFk()->getTitle()?></p>
                    </a>
                <?php
                }
            }
        }?>
            </div>
        </div>
    </div>
</main>
