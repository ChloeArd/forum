<?php

namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Categorie\CategorieManager;
use Forum\Entity\Categorie;
use Forum\User\UserManager;

class CategorieController {

    use ReturnViewTrait;

    /**
     * add a categorie
     * @param $categorie
     */
    public function add($categorie) {
        if (isset($_SESSION["id"])) {
            if (isset($ad['title'], $ad['description'], $ad['picture'], $ad['user_fk'])) {
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();

                $title = htmlentities(trim(ucfirst($ad['title'])));
                $description = htmlentities(trim(ucfirst($ad['description'])));
                $picture = htmlentities(trim($ad['picture']));
                $user_fk = $ad['user_fk'];

                if (strlen($title) <= 20 ) {
                    header("Location: ../index.php?controller=categories&action=new&error=0");
                }
                elseif (filter_var($picture, FILTER_VALIDATE_URL)) {
                    header("Location: ../index.php?controller=categories&action=new&error=1");
                }
                else {
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        $categorie = new Categorie(null, $title, $description, $picture, $user_fk);
                        $categorieManager->add($categorie);
                        header("Location: ../index.php?success=2");
                    }
                }
            }
            $this->return("Create/createCategorieView", "Forum : Créer une catégorie");
        }
    }

    /**
     * update a ad
     * @param $ad
     * @param $files
     */
    public function updateAd($ad, $files) {
        if (isset($_SESSION["id"])) {
            if (isset($ad['id'], $ad['animal'], $ad['name'], $ad['sex'], $ad['size'], $ad['fur'], $ad['dress'], $ad['race'],
                $ad['number'], $ad['description'], $ad['date_lost'], $ad['date'], $ad['city'], $files['picture'], $ad['picture2'], $ad['user_fk'])) {

                $userManager = new UserManager();
                $adlostManager = new AdLostManager();

                $id = intval($ad['id']);
                $animal = $ad['animal'];
                $name = htmlentities(ucfirst($ad['name']));
                $sex = $ad['sex'];
                $size = $ad['size'];
                $fur = $ad['fur'];
                $dress = $ad['dress'];
                $race = htmlentities(ucfirst($ad['race']));
                $number = htmlentities(strtoupper($ad['number']));
                $description = htmlentities(ucfirst($ad['description']));
                $date_lost = $ad['date_lost'];
                $date = $ad['date'];
                $city = $ad['city'];
                $picture = htmlentities($ad['picture2']);
                $user_fk = intval($ad['user_fk']);

                if (isset($ad['color'])) {
                    if (count($ad['color']) === 1) {
                        $color = $ad['color'][0];
                    }
                    elseif (count($ad['color']) === 2) {
                        $color = $ad['color'][0] . ", " . $ad['color'][1];
                    }
                    elseif (count($ad['color']) === 3) {
                        $color = $ad['color'][0] . ", " . $ad['color'][1] . ", " . $ad['color'][2];
                    }
                    elseif (count($ad['color']) === 4) {
                        $color = $ad['color'][0] . ", " . $ad['color'][1] . ", " . $ad['color'][2] . ", " . $ad['color'][3];
                    }
                    elseif (count($ad['color']) === 5) {
                        $color = $ad['color'][0] . ", " . $ad['color'][1] . ", " . $ad['color'][2] . ", " . $ad['color'][3] . ", " . $ad['color'][4];
                    }
                    else {
                        $color = $ad['color'][0] . ", " . $ad['color'][1] . ", " . $ad['color'][2] . ", " . $ad['color'][3] . ", " . $ad['color'][4] . ", " . $ad['color'][5];
                    }
                }
                else {
                    header("Location: ../index.php?controller=adlost&action=update&id=$id&error=2");
                }

                if (!empty($files['picture']['name'])) {
                    if (in_array($files['picture']['type'], ['image/jpg', 'image/jpeg', 'image/png', ".jpg"])) {
                        $maxSize = 6 * 1024 * 1024; // = 6 Mo

                        if ($files['picture']['size'] <= $maxSize) {
                            $tmpName = $files['picture']['tmp_name'];
                            $namePicture = getRandomName($files['picture']['name']);

                            move_uploaded_file($tmpName, "./assets/img/adLost/" . $namePicture);
                            unlink("./assets/img/adLost/" . $picture);

                            $user_fk = $userManager->getUser($user_fk);
                            if ($user_fk->getId()) {
                                $ad = new AdLost($id, $animal, $name, $sex, $size, $fur, $color, $dress, $race, $number, $description, $date_lost, $date, $city, $namePicture, $user_fk);
                                $adlostManager->update($ad);
                                header("Location: ../index.php?controller=adlost&action=view&success=1");
                            }
                        }
                        else {
                            header("Location: ../index.php?controller=adlost&action=update&id=$id&error=1");
                        }
                    }
                    else {
                        header("Location: ../index.php?controller=adlost&action=update&id=$id&error=0");
                    }

                }
                else {
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        $ad = new AdLost($id, $animal, $name, $sex, $size, $fur, $color, $dress, $race, $number, $description, $date_lost, $date, $city, $picture, $user_fk);
                        $adlostManager->update($ad);
                        header("Location: ../index.php?controller=adlost&action=view&success=1");
                    }
                }
            }
            $this->return("update/updateLostView", "Anim'Nord : Modifier une annonce");
        }
    }

    /**
     * delete an ad using its id
     * @param $ad
     */
    public function deleteAd($ad) {
        if (isset($_SESSION["id"])) {
            if (isset($ad['id'], $ad['user_fk'], $ad['picture'])) {
                $userManager = new UserManager();
                $adlostManager = new AdLostManager();

                $id = intval($ad['id']);
                $user_fk = intval($ad['user_fk']);
                $picture = htmlentities($ad['picture']);

                $user_fk = $userManager->getUser($user_fk);
                if ($picture === "" || $picture === null) {
                    if ($user_fk->getId()) {
                        $adlost = new AdLost($id);
                        $adlostManager->delete($adlost);
                        header("Location: ../index.php?controller=adlost&action=view&success=2");
                    }
                }
                else {
                    if ($user_fk->getId()) {
                        unlink("./assets/img/adLost/" . $picture);
                        $adlost = new AdLost($id);
                        $adlostManager->delete($adlost);
                        header("Location: ../index.php?controller=adlost&action=view&success=2");
                    }
                }
            }
            $this->return("delete/deleteLostView", "Anim'Nord : Supprimer une annonce");
        }
    }
}