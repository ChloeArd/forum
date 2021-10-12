<?php

namespace Chloe\Forum\Controller;

use Chloe\Forum\Controller\Traits\ReturnViewTrait;
use Chloe\Forum\Categorie\CategorieManager;
use Chloe\Forum\Entity\Categorie;
use Chloe\Forum\User\UserManager;

class CategorieController {

    use ReturnViewTrait;

    /**
     * add a categorie
     * @param $categorie
     */
    public function add($categorie) {
        if (isset($_SESSION["id"])) {
            if ($_SESSION['role_fk'] === "1") {
                if (isset($categorie['title'], $categorie['description'], $categorie['picture'], $categorie['user_fk'])) {
                    $userManager = new UserManager();
                    $categorieManager = new CategorieManager();

                    $title = htmlentities(trim(ucfirst($categorie['title'])));
                    $description = htmlentities(trim(ucfirst($categorie['description'])));
                    $picture = trim($categorie['picture']);
                    $user_fk = $categorie['user_fk'];

                    // the title size must be less than or equal to 20
                    if (strlen($title) <= 20) {
                        // We check if the URL is valid
                        if (filter_var($picture, FILTER_VALIDATE_URL)) {
                            $user_fk = $userManager->getUser($user_fk);
                            if ($user_fk->getId()) {
                                $categorie = new Categorie(null, $title, $description, $picture, $user_fk);
                                $categorieManager->add($categorie);
                                header("Location: ../index.php?success=2");
                            }
                        } else {
                            header("Location: ../index.php?controller=categories&action=new&error=1");
                        }
                    }
                    else {
                        header("Location: ../index.php?controller=categories&action=new&error=0");
                    }
                }
                else {
                    header("Location: ../index.php?controller=categories&action=new&error=2");
                }
            }
            $this->return("Create/createCategorieView", "Forum : Créer une catégorie");
        }
    }

    /**
     * Update a categorie
     * @param $categorie
     */
    public function update($categorie) {
        if (isset($_SESSION["id"])) {
            if ($_SESSION['role_fk'] === "1") {
                $id = intval($categorie['id']);
                if (isset($categorie['id'], $categorie['title'], $categorie['description'], $categorie['picture'], $categorie['user_fk'])) {
                    $userManager = new UserManager();
                    $categorieManager = new CategorieManager();

                    $title = htmlentities(trim(ucfirst($categorie['title'])));
                    $description = htmlentities(trim(ucfirst($categorie['description'])));
                    $picture = trim($categorie['picture']);
                    $user_fk = $categorie['user_fk'];

                    // the title size must be less than or equal to 20
                    if (strlen($title) <= 20) {
                        // We check if the URL is valid
                        if (filter_var($picture, FILTER_VALIDATE_URL)) {
                            $user_fk = $userManager->getUser($user_fk);
                            if ($user_fk->getId()) {
                                $categorie = new Categorie($id, $title, $description, $picture, $user_fk);
                                $categorieManager->update($categorie);
                                header("Location: ../index.php?success=3");
                            }
                        } else {
                            header("Location: ../index.php?controller=categories&action=update&id=$id&error=1");
                        }
                    }
                    else {
                        header("Location: ../index.php?controller=categories&action=update&id=$id&error=0");
                    }
                }
                else {
                    header("Location: ../index.php?controller=categories&action=update&id=$id&error=2");
                }
            }
            $this->return("Update/updateCategorieView", "Forum : Modifier une catégorie");
        }
    }

    /**
     * delete a categorie
     * @param $categorie
     */
    public function delete($categorie) {
        if (isset($_SESSION["id"])) {
            if ($_SESSION['role_fk'] === "1") {
                if (isset($categorie['id'])) {
                    $categorieManager = new CategorieManager();
                    $id = intval($categorie['id']);
                    $categorieManager->delete($id);
                    header("Location: ../index.php?&success=4");
                }
                $this->return('delete/deleteCategorieView', "Forum : Supprimer une catégorie");
            }
        }
    }
}