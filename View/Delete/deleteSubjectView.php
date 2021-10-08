<?php
$id = $_GET['id'];
$manager = new \Forum\Subject\SubjectManager();
$subject = $manager->getSubjectId2($id);

foreach ($subject as $sub) { ?>
    <main>
        <h1 class="center">Supprimer le sujet : <span class="salmon"><?=$sub->getTitle()?>></span></h1>
        <h2 class="center margTop40">Voulez vous vraiment supprimer ce sujet ?</h2>
        <p class="gray center margTop15">Si oui, tous le contenu et les commentaires seront définitivement supprimés !</p>
        <form method="post" action="" class="flexColumn flexCenter width80 auto">
            <input type="hidden" value="<?=$sub->getId()?>" name="id">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../subjectView.php" class="button2">Non</a>
        </form>
    </main>
<?php
}