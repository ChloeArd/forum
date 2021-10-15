<?php
$return = "";
$id = "";

if (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Vous avez bien modifié vos informations !";
            break;
        case '1':
            $return = "Votre mot de passe a bien était changé !";
            break;
    }
}
?>

<div id='<?= $id?>' class='modal2 center colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
<main>
    <h1 class="center">Bienvenue <span class="salmon"><?=$_SESSION['pseudo']?></span> !</h1>
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
            <div class="width80 border flexCenter flexColumn">
                <p class="info1 width_100">Pseudo : <span><?=$_SESSION['pseudo']?></span></p>
                <p class="info1 width_100">Email : <span><?=$_SESSION['email']?></span></p>
                <a href="../index.php?controller=user&action=updateAccount&id=<?=$_SESSION['id']?>" class="flexCenter button width40 margTop15">Modifier <i class="far fa-edit margL"></i></a>
                <a href="../index.php?controller=user&action=updatePass&id=<?=$_SESSION['id']?>" class="flexCenter button center width40 margTop15">Changer mon mot de passe<i class="far fa-edit margL"></i></a>
                <a href="../index.php?controller=user&action=delete&id=<?=$_SESSION['id']?>" class="flexCenter button center width40 margTop15">Supprimer mon compte</a>
            </div>
        </div>
    </div>
</main>