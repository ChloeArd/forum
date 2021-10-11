 <main>
    <h1 class="center">Ajouter un sujet</h1>
    <form method="post" action="" class="flexColumn flexCenter auto" enctype="multipart/form-data">
        <label for="title">Titre</label>
        <input type="text" id="title" maxlength="40" name="title" required>
        <label for="picture">Insérer le lien d'une image</label>
        <input type="text" name="picture" id="picture" required>
        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea>
        <label for="content">Contenu</label>
        <textarea name="text" id="content" required></textarea>
        <input type="hidden" value="<?= date('Y-m-d')?>" name="date">
        <input type="hidden" value="<?= $_GET['id']?>" name="categorie_fk">
        <input type="hidden" value="<?= $_SESSION['id']?>" name="user_fk">
        <input type="submit" name="submit" value="Créer" class="button">
    </form>
</main>