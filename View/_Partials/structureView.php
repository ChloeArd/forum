<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div id="wrap">
    <header>
        <div id="menu" class="flexCenter flexRow">
            <a href="../../index.php">Accueil</a>
            <?php
            if (isset($_SESSION['id'])) {?>
                <a href="../../View/accountView.php?id=<?=$_SESSION['id']?>"><i class="fas fa-user-circle margR"></i><?=$_SESSION['pseudo'] ?></a>
                <?php
            }
            else { ?>
                <a href="../../index.php?controller=home&page=connection">Connexion</a>
                <a href="../../index.php?controller=home&page=registration">Inscription</a>
            <?php
            }
            ?>
        </div>
    </header>

    <?= $html ?>

    <footer class="flexCenter">
        <a href="">Mentions légales</a>
        <a href="">Contact</a>
    </footer>
</div>
<script src="/assets/js/app.js"></script>

</body>
</html>