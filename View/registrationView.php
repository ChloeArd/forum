<main>
    <h1 class="center">Inscription</h1>
    <form method="post" action="../assets/php/registration.php" class="flexColumn flexCenter width80 auto">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" max="20" name="pseudo" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Mot de passe</label>
        <p class="gray size12">Le mot de passe doit contenir : majuscule, minuscule, chiffre et min 8 carcatères</p>
        <input type="password" id="password" min="8" name="password" required>
        <label for="passwordR">Répet du mot de passe</label>
        <input type="password" id="passwordR" min="8" name="passwordR" required>
        <input type="submit" name="submit" value="M'inscrire" class="button">
    </form>
</main>
