 <main>
    <h1 class="center">Ajouter un commentaire</h1>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <label for="comment">Commentaire</label>
        <textarea name="comment" id="comment" required></textarea>
        <input type="hidden" value="date" name="date">
        <input type="hidden" value="subject_fk" name="subject_fk">
        <input type="hidden" value="user_fk" name="user_fk">
        <input type="submit" name="submit" value="Ajouter" class="button">
    </form>
</main>