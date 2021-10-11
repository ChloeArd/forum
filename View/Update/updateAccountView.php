 <main>
    <h1 class="center">Modifier mes informations</h1>
    <div id="containerCategories" class=" flexRow wrap">
        <div class="width20">
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
        <div class="width80 flexCenter">
            <div class="width80 border flexCenter flexColumn">
                <form method="post" action="" class="flexColumn flexCenter width80 auto" enctype="multipart/form-data">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" value="<?=$_SESSION['pseudo']?>" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?=$_SESSION['email']?>" required>
                    <input type="hidden" value="<?=$_SESSION['id']?>" name="id">
                    <input type="submit" name="submit" value="Modifier" class="button">
                </form>
            </div>
        </div>
    </div>
</main>
