<?php
namespace Forum\Categorie;

use Forum\DB;
use Forum\Entity\Categorie;
use Forum\User\UserManager;
use Forum\Manager\Traits\ManagerTrait;

class AdFindManager {

    use ManagerTrait;

    private UserManager $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
    }

    /**
     * returns all categories
     * @return array
     */
    public function getCategories(): array {
        $ads = [];
        $request = DB::getInstance()->prepare("SELECT * FROM categorie ORDER by id DESC");
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $ads[] = new Categorie($info['id'], $info['title'], $info['description'], $info['picture'],$user);
                }
            }
        }
        return $ads;
    }

    /**
     * Return a categorie based on id.
     * @param $id
     * @return Categorie
     */
    public function getCategorie($id) {
        $request = DB::getInstance()->prepare("SELECT * FROM categorie WHERE id = :id");
        $request->bindParam(":id", $id);
        $request->execute();
        $data = $request->fetch();
        $categorie = new Categorie();
        if ($data) {
            $categorie->setId($data['id']);
            $categorie->setTitle($data['title']);
            $categorie->setDescription($data['description']);
            $categorie->setPicture($data['picture']);
            $user = $this->userManager->getUser(['user_fk']);
            $categorie->setUserFk($user);
        }
        return $categorie;
    }

    /**
     * Allows you to display an ad based on its ID.
     * @param int $id
     * @return array
     */
    public function getAd2(int $id): array {
        $ad = [];
        $request = DB::getInstance()->prepare("SELECT * FROM adfind WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $ad[] = new AdFind($info['id'], $info['animal'], $info['sex'], $info['size'],
                        $info['fur'], $info['color'], $info['dress'], $info['race'], $info['number'], $info['description'],
                        $info['date_find'], $info['date'], $info['city'], $info['picture'] ,$user);
                }
            }
        }
        return $ad;
    }

    /**
     * View all the announcements that a user has created.
     * @param int $user_fk
     * @return array
     */
    public function adsByUser(int $user_fk): array {
        $ads = [];
        $request = DB::getInstance()->prepare("SELECT * FROM adfind WHERE user_fk = :user_fk ORDER by id DESC ");
        $request->bindParam(":user_fk", $user_fk);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($user_fk);
                if($user->getId()) {
                    $ads[] = new AdFind($info['id'], $info['animal'], $info['sex'], $info['size'],
                        $info['fur'], $info['color'], $info['dress'], $info['race'], $info['number'], $info['description'],
                        $info['date_find'], $info['date'], $info['city'], $info['picture'] ,$user);
                }
            }
        }
        return $ads;
    }

    /**
     * add a find dogs and cats ad
     * @param AdFind $adFind
     * @return bool
     */
    public function add (AdFind $adFind): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO adfind (animal, sex, size, fur, color, dress, race, number, description, date_find, date, city, picture, user_fk)
                VALUES (:animal, :sex, :size, :fur, :color, :dress, :race, :number, :description, :date_find, :date, :city, :picture, :user_fk) 
        ");

        $request->bindValue(':animal', $adFind->getAnimal());
        $request->bindValue(':sex', $adFind->getSex());
        $request->bindValue(':size', $adFind->getSize());
        $request->bindValue(':fur', $adFind->getFur());
        $request->bindValue(':color', $adFind->getColor());
        $request->bindValue(':dress', $adFind->getDress());
        $request->bindValue(':race', $adFind->getRace());
        $request->bindValue(':number', $adFind->getNumber());
        $request->bindValue(':description', $adFind->getDescription());
        $request->bindValue(':date_find', $adFind->getDateFind());
        $request->bindValue(':date', $adFind->getDate());
        $request->bindValue(':city', $adFind->getCity());
        $request->bindValue(':picture', $adFind->getPicture());
        $request->bindValue(':user_fk', $adFind->getUserFk()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a add
     * @param AdFind $adFind
     * @return bool
     */
    public function update (AdFind $adFind): bool {
        $request = DB::getInstance()->prepare("UPDATE adfind SET animal = :animal, sex = :sex, size = :size, fur = :fur,
                  color = :color, dress = :dress, race = :race, number = :number, description = :description, date_find = :date_find,
                  date= :date, city = :city, picture = :picture WHERE id = :id");

        $request->bindValue(':id', $adFind->getId());
        $request->bindValue(':animal', $adFind->setAnimal($adFind->getAnimal()));
        $request->bindValue(':sex', $adFind->setSex($adFind->getSex()));
        $request->bindValue(':size', $adFind->setSize($adFind->getSize()));
        $request->bindValue(':fur', $adFind->setFur($adFind->getFur()));
        $request->bindValue(':color', $adFind->setColor($adFind->getColor()));
        $request->bindValue(':dress', $adFind->setDress($adFind->getDress()));
        $request->bindValue(':race', $adFind->setRace($adFind->getRace()));
        $request->bindValue(':number', $adFind->setNumber($adFind->getNumber()));
        $request->bindValue(':description', $adFind->setDescription($adFind->getDescription()));
        $request->bindValue(':date_find', $adFind->setDateFind($adFind->getDateFind()));
        $request->bindValue(':date', $adFind->setDate($adFind->getDate()));
        $request->bindValue(':city', $adFind->setCity($adFind->getCity()));
        $request->bindValue(':picture', $adFind->setPicture($adFind->getPicture()));

        return $request->execute();
    }

    /**
     * Delete a ad find
     * @param AdFind $adFind
     * @return bool
     */
    public function delete (AdFind $adFind): bool {
        $request = DB::getInstance()->prepare("DELETE FROM comment_find WHERE adFind_fk = :adFind_fk");
        $request->bindValue(":adFind_fk", $adFind->getId());
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM favorite_find WHERE adFind_fk = :adFind_fk");
        $request->bindValue(":adFind_fk", $adFind->getId());
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM adfind WHERE id = :id");
        $request->bindValue(":id", $adFind->getId());
        return $request->execute();
    }

    /**
     * I retrieve the last 4 IDs, to have 4 recent announcements.
     * @return array
     */
    public function recentAdFind(): array {
        $recent = [];
        $request = DB::getInstance()->prepare("SELECT * FROM adfind ORDER by id DESC LIMIT 0,4");
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $recent[] = new AdFind($info['id'], $info['animal'], $info['sex'], $info['size'],
                        $info['fur'], $info['color'], $info['dress'], $info['race'], $info['number'], $info['description'],
                        $info['date_find'], $info['date'], $info['city'], $info['picture'] ,$user);
                }
            }
        }
        return $recent;
    }
}