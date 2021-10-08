<?php
namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Categorie\CategorieManager;
use Forum\Subject\SubjectManager;

class SubjectController {

    use ReturnViewTrait;

    public function subjects(int $categorie_fk) {
        $manager = new SubjectManager();
        $manager2 = new CategorieManager();
        $this->return("subjectsView", "Forum : Sujets", ['subjects' => $manager->getSubjects($categorie_fk), 'categorie' => $manager2->getCategorieId($categorie_fk)]);
    }
}