<main>
    <h1 class="center">Changer mon mot de passe</h1>
    <div id="containerCategories" class=" flexRow wrap">
        <div id="menuAccount" class="width20">
            <a href="../../index.php?controller=user&action=view&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes informations</p>
            </a>
            <a href="../../index.php?controller=user&action=sujects&id=<?=$_SESSION['id']?>">
                <p class="border1">Mes sujets</p>
            </a>
            <div class="border1">
                <form class="disconnection" method="post" action="../../assets/php/disconnection.php">
                    <input type="submit" value="Me déconnecter">
                </form>
            </div>
        </div>
        </div>
        <div id="containerAccount" class="width80 flexCenter">
            <div class="width80 border flexCenter flexColumn">
                <form method="post" action="" class="flexColumn flexCenter auto" enctype="multipart/form-data">
                    <label for="passNow">Mot de passe actuel</label>
                    <input type="password" id="passNow" name="passwordNow" required>
                    <label for="passNew">Nouveau mot de passe</label>
                    <input type="password" id="passNew" name="passwordNew" required>
                    <label for="passNewR">Répet du nouveau mot de passe</label>
                    <input type="password" id="passNewR" name="passwordNewR" required>
                    <input type="hidden" value="<?=$_SESSION['id']?>" name="id">
                    <input type="submit" name="submit" value="Confirmer" class="button">
                </form>
            </div>
        </div>
    </div>
</main>
