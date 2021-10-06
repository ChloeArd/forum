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
            <a href="#">Accueil</a>
            <a href="#">Forum</a>
            <a href="#">Connexion</a>
            <a href="#">Inscription</a>
            <a href="#">Compte</a>
        </div>
    </header>

    <?= $html ?>

    <footer class="flexCenter flexColumn">

    </footer>
</div>
<script src="/assets/js/app.js"></script>

</body>
</html>