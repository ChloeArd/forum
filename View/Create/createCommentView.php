<main>
    <h1 class="center">Ajouter un commentaire</h1>
    <form method="post" action="" class="flexColumn flexCenter auto">
        <label for="comment">Commentaire</label>
        <textarea name="comment" id="comment" required></textarea>
        <input type="hidden" value="<?=date("Y-m-d")?>" name="date">
        <input type="hidden" value="<?=$_GET['id3']?>" name="categorie_fk">
        <input type="hidden" value="<?=$_GET['id2']?>" name="subject_fk">
        <input type="hidden" value="<?=$_SESSION['id']?>" name="user_fk">
        <input type="submit" name="submit" value="Ajouter" class="button">
    </form>
</main>