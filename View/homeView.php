<?php
$return = "";
$id = "";

if (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Vous êtes bien connecté(e) !";
            break;
        case '1':
            $return = "Vous êtes bien déconnecté(e) !";
            break;
        case '2' :
            $return = "Votre catégorie est bien crée !";
            break;
        case '3' :
            $return = "Vous avez bien modifié une catégorie !";
            break;
        case '4' :
            $return = "Vous avez bien supprimé une catégorie !";
            break;
        case '5' :
            $return = "Vous avez bien supprimé votre compte";
            break;
        case '6' :
            $return = "Votre catégorie est bien archivé / clôturé";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
    <h1 class="center" id="title">Bienvenue sur le forum <span class="title">S</span><span class="title">a</span><span class="title">l</span><span class="title">m</span><span class="title">o</span><span class="title">n</span>!</h1>
    <div id="containerCategories" class="flexCenter flexRow wrap">
        <?php
        if (isset($var['categories'])) {
            foreach ($var['categories'] as $categorie) { ?>
                <a href="../index.php?controller=subjects&action=view&id=<?=$categorie->getId()?>" class="flexColumn flexCenter categories">
                    <img class="imageHome" src="<?=$categorie->getPicture() ?>" alt="<?=$categorie->getTitle() ?>">
                    <p class="size20 center"><?=$categorie->getTitle() ?></p>
                    <p class="gray center"><?=$categorie->getDescription() ?></p>
                    <?php
                    if ($categorie->getArchive() === 1) { ?>
                        <p class="red">(Archivé)</p>
                        <?php
                    }
                    ?>
                </a>
            <?php
            }
        }
        ?>
        <?php
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role_fk'] === "1") { ?>
                <a href="../index.php?controller=categories&action=new" class="flexColumn flexCenter categories">
                    <img class="imageHome imagePlus" src="data:image/png;base64,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" alt="Ajouter">
                    <p class="size20 center">Ajouter une catégorie</p>
                </a>
                <?php
            }
        }
        ?>
    </div>
</main>