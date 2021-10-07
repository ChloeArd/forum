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
                <a href="../index.php">Accueil</a>
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="../View/accountView.php?id=<?=$_SESSION['id']?>"><i class="fas fa-user-circle margR"></i><?=$_SESSION['pseudo'] ?></a>
                    <?php
                }
                else { ?>
                    <a href="../View/connectionView.php">Connexion</a>
                    <a href="../View/registrationView.php">Inscription</a>
                    <?php
                }
                ?>


            </div>
        </header>

        <main>
            <h1 class="center">Bienvenue <span class="salmon"><?=$_SESSION['pseudo']?></span> !</h1>
            <div id="containerCategories" class="flexCenter flexRow wrap">
                <div class="width20">
                    <div class="border1"
                        <a href="#">Mes informations</a>
                    </div>
                    <div class="border1">
                        <a href="#">Mes sujets</a>
                    </div>
                </div>
                <div class="width80 flexCenter">
                    <div class="width80 border flexCenter flexColumn">
                        <p class="info1 width_100">Pseudo : <span><?=$_SESSION['pseudo']?></span></p>
                        <p class="info1 width_100">Email : <span><?=$_SESSION['email']?></span></p>
                        <a href="Update/updateAccountView.php" class="flexCenter button width40 margTop15">Modifier <i class="far fa-edit margL"></i></a>
                        <a href="Update/updatePasswordView.php" class="flexCenter button center width40 margTop15">Changer mon mot de passe<i class="far fa-edit margL"></i></a>
                        <a href="Delete/deleteAccountView.php" class="flexCenter button center width40 margTop15">Supprimer mon compte</a>
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
