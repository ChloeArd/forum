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
        <h1 class="center">Modifier un commentaire</h1>
        <form method="post" action="#" class="flexColumn flexCenter width80 auto">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment"></textarea>
            <input type="hidden" value="id" name="id">
            <input type="hidden" value="date" name="date">
            <input type="hidden" value="subject_fk" name="subject_fk">
            <input type="hidden" value="user_fk" name="user_fk">
            <input type="submit" name="submit" value="Ajouter" class="button">
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