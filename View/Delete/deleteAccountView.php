<main>
    <h1 class="center">Supprimer mon compte </h1>
    <h2 class="center margTop40">Voulez vous vraiment supprimer votre compte ?</h2>
    <p class="gray center margTop15">Si oui, votre compte et tous les sujets et commentaires que vous avez créé seront définitivement supprimés !</p>
    <form method="post" action="" class="flexColumn flexCenter auto">
        <input type="hidden" value="<?=$_SESSION['id']?>" name="id">
        <input type="submit" name="submit" value="Oui" class="button margTop15">
        <a href="../../index.php?controller=user&action=view&id=<?=$_SESSION['id']?>" class="button2">Non</a>
    </form>
</main>
