<?php
session_start();
if ($_GET['id'] === $_SESSION['id']) { ?>
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
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="../../View/accountView.php?id=<?=$_SESSION['id']?>"><i class="fas fa-user-circle margR"></i><?=$_SESSION['pseudo'] ?></a>
                    <?php
                }
                else { ?>
                    <a href="../../View/connectionView.php">Connexion</a>
                    <a href="../../View/registrationView.php">Inscription</a>
                    <?php
                }
                ?>
            </div>
        </header>

        <main>
            <h1 class="center">Changer mon mot de passe</h1>
            <div id="containerCategories" class=" flexRow wrap">
                <div class="width20">
                    <a href="../accountView.php?id=<?=$_SESSION['id']?>">
                        <p class="border1">Mes informations</p>
                    </a>
                    <a href=../accountSubjectView.php?id=<?=$_SESSION['id']?>">
                        <p class="border1">Mes sujets</p>
                    </a>
                    <div class="border1">
                        <form class="disconnection" method="post" action="../../assets/php/disconnection.php">
                            <input type="submit" value="Me déconnecter">
                        </form>
                    </div>
                </div>
                <div class="width80 flexCenter">
                    <div class="width80 border flexCenter flexColumn">
                        <form method="post" action="#" class="flexColumn flexCenter width80 auto" enctype="multipart/form-data">
                            <label for="passNow">Mot de passe actuel</label>
                            <input type="password" id="passNow" name="passNow" required>
                            <label for="passNew">Nouveau mot de passe</label>
                            <input type="password" id="passNew" name="passNew" required>
                            <label for="passNewR">Répet du nouveau mot de passe</label>
                            <input type="password" id="passNewR" name="passNewR" required>
                            <input type="hidden" value="id" name="id">
                            <input type="submit" name="submit" value="Confirmer" class="button">
                        </form>
                    </div>
                </div>
            </div>

    </div>
    </main>

    <footer class="flexCenter">
        <a href="">Mentions légales</a>
        <a href="">Contact</a>
    </footer>
    </div>
    <script src="/assets/js/app.js"></script>

    </body>
    </html>
    <?php
}
