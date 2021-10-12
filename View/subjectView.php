<?php
$return = "";
$id = "";

if (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Votre commentaire a été ajouté !";
            break;
        case '1':
            $return = "Le commentaire a bien été modifié !";
            break;
        case '2' :
            $return = "Le commentaire a bien été supprimé !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
    <?php
    if (isset($var['subject'])) {
        foreach ($var['subject'] as $subject) { ?>
            <h1 class="center"><?=$subject->getTitle()?></h1>
            <p class="center gray">Par <?=$subject->getUserFk()->getPseudo()?></p>
            <?php
            if (isset($_SESSION['id'])) {
                // Admin and moderator can edit and the user who created the topic too
                if ($_SESSION['role_fk'] !== "2" || $subject->getUserFk()->getId() == $_SESSION['id']) { ?>
                    <div class="height">
                        <a href="../index.php?controller=subjects&action=update&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="button buttonAbsolute1"><i class="fas fa-edit"></i></a>
                    </div>
                <?php
                }
                // That the admin and the moderator who can archive
                if ($_SESSION['role_fk'] !== "2") { ?>
                    <div class="height">
                        <a href="#" class="button buttonAbsolute1"><i class="fas fa-archive"></i></a>
                    </div>
                <?php
                }
                // That the admin who can delete
                if ($_SESSION['role_fk'] === "1") { ?>
                    <div class="height">
                        <a href="../index.php?controller=subjects&action=delete&id=<?=$subject->getId()?>" class="button buttonAbsolute1"><i class="fas fa-trash-alt"></i></a>
                    </div>
                <?php
                }
            }
                ?>
            <div class="flexCenter">
                <img class="imageCategorie" src="<?=$subject->getPicture()?>" alt="<?=$subject->getTitle()?>">
            </div>
            <h2 class="center"><?=$subject->getDescription()?></h2>
            <p class="text"><?=$subject->getText()?></p>

            <div class="lineHorizontal"></div>
            <div class="flexRow flexCenter">
                <h2 class="gray">Commentaires</h2>
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="../index.php?controller=comments&action=new&id=<?=$_SESSION['id']?>&id2=<?=$subject->getId()?>&id3=<?=$subject->getCategorieFk()->getId()?>" id="buttonAdCom" class="button buttonAbsolute1"><i class="fas fa-plus"></i> Ajouter un commentaire</a>
                    <?php
                }
                    ?>
            </div>
        <?php
        }
    }
    ?>

    <?php
    if (isset($var['comments'])) {
        foreach ($var['comments'] as $comment) { ?>
            <div class="comments flexColumn">
                <div class="pseudo gray flexRow align">
                    <p><?=$comment->getUserFk()->getPseudo()?> / <?=$comment->getDate()?></p>
                    <?php
                    if (isset($_SESSION['id'])) {
                        // Admin and moderator can edit and the user who created the topic too
                        if ($_SESSION['role_fk'] !== "2" || $comment->getUserFk()->getId() == $_SESSION['id']) { ?>
                            <a href="../index.php?controller=comments&action=update&id=<?=$comment->getId()?>" class="button3"><i class="fas fa-edit"></i></a>
                        <?php
                        }
                        // That the admin who can delete
                        if ($_SESSION['role_fk'] === "1") { ?>
                            <a href="../index.php?controller=comments&action=delete&id=<?=$comment->getId()?>" class="button3 buttonPos3"><i class="fas fa-trash-alt"></i></a>
                        <?php
                        }
                        // That the admin and the moderator who can archive
                        if ($_SESSION['role_fk'] !== "2") { ?>
                            <a href="#" class="button3 buttonPos4"><i class="fas fa-archive"></i></a>
                        <?php
                        }
                    }?>
                </div>
                <div class="comment">
                    <p><?=$comment->getComment()?></p>
                </div>
            </div>
        <?php
        }
    }
    ?>
</main>