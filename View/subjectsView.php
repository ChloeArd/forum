    <main>
        <?php
        if (isset($var['categorie'])) {
            foreach ($var['categorie'] as $categorie) {?>
                <h1 class="center"><?=$categorie->getTitle()?></h1>
                <div class="height">
                    <a href="../index.php?controller=categories&action=update&id=<?=$categorie->getId()?>" class="button buttonAbsolute1"><i class="fas fa-edit"></i></a>
                </div>
                <div class="height">
                    <a href="#" class="button buttonAbsolute1"><i class="fas fa-archive"></i></a>
                </div>
                <div class="height">
                    <a href="Delete/deleteCategorieView.php" class="button buttonAbsolute1"><i class="fas fa-trash-alt"></i></a>
                </div>
                <div class="flexCenter">
                    <img class="imageCategorie" src="<?=$categorie->getPicture()?>" alt="<?=$categorie->getTitle()?>">
                </div>

                <div class="height">
                    <a href="Create/createSubjectView.php" class="button buttonAbsolute1"><i class="fas fa-plus"></i> Ajouter un sujet</a>
                </div>
            <?php
            }
        }?>

        <div id="containerSubjects" class="flexCenter flexRow wrap">
            <div class="border flexRow">
                <div class="width20 flexCenter">
                    <p>Sujets</p>
                </div>
                <div class="width60 flexCenter wrap">
                    <p>Descriptions</p>
                </div>
                <div class="width20 flexCenter">
                    <p>Dates</p>
                </div>
            </div>
            <?php
            if (isset($var['subjects'])) {
                foreach ($var['subjects'] as $subject) {?>
                    <a href="#" class="border1 flexRow">
                        <div class="width20 flexCenter">
                            <p><?=$subject->getTitle()?></p>
                        </div>
                        <div class="width60 flexCenter wrap">
                            <p><?=$subject->getDescription() ?></p>
                        </div>
                        <div class="width20 flexCenter">
                            <p><?=$subject->getDate()?></p>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </main>