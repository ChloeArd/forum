<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum : Accueil</title>
    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div id="wrap">
    <header>
        <div id="menu" class="flexCenter flexRow">
            <a href="../../index.php">Accueil</a>
            <a href="../connectionView.php">Connexion</a>
            <a href="../registrationView.php">Inscription</a>
            <a href="#">Compte</a>
        </div>
    </header>

    <main>
        <h1 class="center">Supprimer la catégorie : <span class="salmon">titre</span></h1>
        <h2 class="center margTop40">Voulez vous vraiment supprimer cette catégorie ?</h2>
        <p class="gray center margTop15">Si oui, tous les sujets et commentaires seront définitivement supprimés !</p>
        <form method="post" action="#" class="flexColumn flexCenter width80 auto">
            <input type="hidden" value="id" name="id">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../subjectsView.php" class="button2">Non</a>
        </form>
    </main>

    <footer class="flexCenter">
        <a href="">Mentions légales</a>
        <a href="">Contact</a>
    </footer>
</div>
<script src="/assets/js/app.js"></script>

</body>
</html>