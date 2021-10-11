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

    /**
     * display the connection page
     */
    public function connection() {
        $this->return("connectionView", "Forum : Connexion");
    }

    /**
     * display the registration page
     */
    public function registration() {
        $this->return("registrationView", "Forum : Inscription");
    }
}