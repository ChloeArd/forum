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
        case '3' :
            $return = "Ce sujet est bien archivé !";
            break;
        case '4' :
            $return = "Un commentaire est bien archivé !";
            break;
        case '5' :
            $return = "Le commentaire a été signalé !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
    <?php
    if (isset($var['subject'])) {
        foreach ($var['subject'] as $subject) { ?>
            <?php
            if ($subject->getArchive() === 1 || $subject->getCategorieFk()->getArchive() === 1) {?>
                <p class="center backgroundRed marg20 white">(Archivé)</p>
                <?php
            }
            ?>
            <h1 class="center"><?=$subject->getTitle()?></h1>
            <p class="center gray">Par <?php
                echo $subject->getUserFk()->getPseudo();
                if ($subject->getUserFk()->getPremium() == "1") {?>
                    <i class="fas fa-award salmon"></i>
                    <?php
                }
                ?></p>
            <?php
            if (isset($_SESSION['id'])) {
                // Check if it is an admin or a moderator and that it is not archived
                // Check if this is the person who is connected and who wrote the subject matches and that the subject is not archived
                // Check if it's archived and it's the admin
                if ($_SESSION['role_fk'] !== "2" && $subject->getCategorieFk()->getArchive() !== 1 && $subject->getArchive() !== 1
                    || $subject->getUserFk()->getId() == $_SESSION['id'] && $subject->getCategorieFk()->getArchive() !== 1 && $subject->getArchive() !== 1
                    || $subject->getCategorieFk()->getArchive() === 1 && $_SESSION ['role_fk'] == "1"
                    || $subject->getArchive() === 1 && $_SESSION ['role_fk'] == "1") { ?>
                    <div class="height">
                        <a href="../index.php?controller=subjects&action=update&id=<?=$subject->getId()?>&id2=<?=$subject->getCategorieFk()->getId()?>" class="button buttonAbsolute1"><i class="fas fa-edit"></i></a>
                    </div>
                <?php
                }
                // That the admin and the moderator who can archive
                if ($_SESSION['role_fk'] !== "2" && $subject->getCategorieFk()->getArchive() !== 1 && $subject->getArchive() !== 1) { ?>
                    <div class="height">
                        <a href="../index.php?controller=subjects&action=archive&id=<?=$subject->getId()?>" class="button buttonAbsolute1"><i class="fas fa-archive"></i></a>
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
                if (isset($_SESSION['id'])) {
                    if ($subject->getCategorieFk()->getArchive() !== 1 && $subject->getArchive() !== 1) {?>
                    <a href="../index.php?controller=comments&action=new&id=<?=$_SESSION['id']?>&id2=<?=$subject->getId()?>&id3=<?=$subject->getCategorieFk()->getId()?>" id="buttonAdCom" class="button buttonAbsolute1"><i class="fas fa-plus"></i> Ajouter un commentaire</a>
                    <?php
                    }
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
                    <p class="comPseudo">
                        <?php
                        echo $comment->getUserFk()->getPseudo();
                        if ($comment->getUserFk()->getPremium() == "1") {?>
                            <i class="fas fa-award salmon"></i>
                            <?php
                        }
                    ?>
                        / <?=$comment->getDate()?></p>
                    <?php
                    if (isset($_SESSION['id'])) {
                        // Check if it is an admin or a moderator and that it is not archived
                        // Check if this is the person who is connected and who wrote the comment matches and that the comment is not archived
                        // Check if it's archived and it's the admin
                        if ($_SESSION['role_fk'] !== "2" && $comment->getCategorieFk()->getArchive() !== 1 && $comment->getSubjectFk()->getArchive() !== 1 && $comment->getArchive() !== 1
                            || $comment->getUserFk()->getId() == $_SESSION['id'] && $comment->getCategorieFk()->getArchive() !== 1 && $comment->getSubjectFk()->getArchive() !== 1 && $comment->getArchive() !== 1
                            || $comment->getCategorieFk()->getArchive() === 1 && $_SESSION ['role_fk'] == "1"
                            || $comment->getSubjectFk()->getArchive() === 1 && $_SESSION ['role_fk'] == "1"
                            || $comment->getArchive() === 1 && $_SESSION ['role_fk'] == "1") { ?>
                            <a href="../index.php?controller=comments&action=update&id=<?=$comment->getId()?>" class="button3"><i class="fas fa-edit"></i></a>

                            <?php
                        }
                        if ($_SESSION['role_fk'] === "2") {?>
                            <a href = "../index.php?controller=comments&action=report&id=<?=$comment->getId()?>" class="button3 buttonPos5" ><i class="fas fa-exclamation-triangle" ></i ></a >
                        <?php
                        }
                        // That the admin who can delete
                        if ($_SESSION['role_fk'] === "1") { ?>
                            <a href="../index.php?controller=comments&action=delete&id=<?=$comment->getId()?>" class="button3 buttonPos3"><i class="fas fa-trash-alt"></i></a>
                        <?php
                        }
                        // That the admin and the moderator who can archive
                        if ($_SESSION['role_fk'] !== "2" && $comment->getCategorieFk()->getArchive() !== 1 && $comment->getSubjectFk()->getArchive() !== 1 && $comment->getArchive() !== 1) { ?>
                            <a href="../index.php?controller=comments&action=archive&id=<?=$comment->getId()?>" class="button3 buttonPos4"><i class="fas fa-archive"></i></a>
                        <?php
                        }
                    }?>
                </div>
                <div class="comment">
                    <?php
                    if ($comment->getArchive() === 1 || $comment->getSubjectFk()->getArchive() === 1 || $comment->getCategorieFk()->getArchive() === 1) { ?>
                        <p class="red">(Archivé)</p>
                    <?php
                    }
                    ?>
                    <p><?=$comment->getComment()?></p>
                </div>
            </div>
        <?php
        }
    }
    ?>
</main>