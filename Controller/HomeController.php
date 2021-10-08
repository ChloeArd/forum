<?php

namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Categorie\CategorieManager;

class HomeController {

    use ReturnViewTrait;

    /**
     * display the home page
     */
    public function homePage() {
        $manager = new CategorieManager();
        $categories = $manager->getCategories();

        $this->return("homeView", "Forum : Accueil", ['categories' => $categories]);
    }
}