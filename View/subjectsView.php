<?php
$return = "";
$id = "";

if (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Vous avez crée un sujet !";
            break;
        case '1':
            $return = "Vous avez bien modifié un sujet !";
            break;
        case '2':
            $return = "Vous avez bien supprimé un sujet !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>

<main>
    <?php
    if (isset($var['categorie'])) {
        foreach ($var['categorie'] as $categorie) {?>
            <h1 class="center"><?=$categorie->getTitle()?></h1>
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['role_fk'] === "1") { ?>
                    <div class="height">
                        <a href="../index.php?controller=categories&action=update&id=<?=$categorie->getId()?>" class="button buttonAbsolute1"><i class="fas fa-edit"></i></a>
                    </div>
                    <div class="height">
                        <a href="#" class="button buttonAbsolute1"><i class="fas fa-archive"></i></a>
                    </div>
                    <div class="height">
                        <a href="../index.php?controller=categories&action=delete&id=<?=$categorie->getId()?>" class="button buttonAbsolute1"><i class="fas fa-trash-alt"></i></a>
                    </div>
                <?php
                }
            }
            ?>
            <div class="flexCenter">
                <img class="imageCategorie" src="<?=$categorie->getPicture()?>" alt="<?=$categorie->getTitle()?>">
            </div>

            <?php
            if (isset($_SESSION['id'])) {?>
                <div class="height">
                    <a href="../index.php?controller=subjects&action=new&id=<?=$categorie->getId()?>" class="button buttonAbsolute1"><i class="fas fa-plus"></i> Ajouter un sujet</a>
                </div>
                <?php
            }
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
                <a id="subjects" href="../index.php?controller=subjects&action=viewOnly&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="border1 flexRow">
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