
    <main>
        <h1 class="center">Ajouter une catégorie</h1>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" maxlength="20" required>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
            <label for="picture">Insérer le lien d'une image</label>
            <input type="text" name="picture" id="picture" required>
            <input type="hidden" value="<?=$_SESSION['id']?>" id="user_fk" name="user_fk">
            <input type="submit" name="submit" value="Créer" class="button">
        </form>
    </main>
