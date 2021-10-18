<?php

namespace Chloe\Forum\Controller;

use Chloe\Forum\Model\Controller\Traits\ReturnViewTrait;
use Chloe\Forum\Model\Manager\CategorieManager;

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

    /**
     * display the premium page
     */
    public function premium() {
        $this->return("memberPremiumView", "Forum : Devenir premium");
    }
}