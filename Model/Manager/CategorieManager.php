<?php
namespace Forum\Categorie;

use Forum\DB;
use Forum\Entity\Categorie;
use Forum\User\UserManager;
use Forum\Manager\Traits\ManagerTrait;

class CategorieManager {

    use ManagerTrait;

    private UserManager $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
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
     * returns all categories
     * @return array
     */
    public function getCategories(): array {
        $categorie = [];
        $request = DB::getInstance()->prepare("SELECT * FROM categorie ORDER by id DESC");
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $categorie[] = new Categorie($info['id'], $info['title'], $info['description'], $info['picture'],$user);
                }
            }
        }
        return $categorie;
    }

    /**
     * returns categorie by id
     * @return array
     */
    public function getCategorieId(int $id): array {
        $categorie = [];
        $request = DB::getInstance()->prepare("SELECT * FROM categorie WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $categorie[] = new Categorie($info['id'], $info['title'], $info['description'], $info['picture'],$user);
                }
            }
        }
        return $categorie;
    }

    /**
     * add a categories
     * @param Categorie $categorie
     * @return bool
     */
    public function add (Categorie $categorie): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO categorie (title, description, picture, user_fk)
                VALUES (:title, :description, :picture, :user_fk) 
        ");

        $request->bindValue(':title', $categorie->getTitle());
        $request->bindValue(':description', $categorie->getDescription());
        $request->bindValue(':picture', $categorie->getPicture());
        $request->bindValue(':user_fk', $categorie->getUserFk()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a description of categorie
     * @param Categorie $categorie
     * @return bool
     */
    public function update (Categorie $categorie): bool {
        $request = DB::getInstance()->prepare("UPDATE adfind SET description = :description WHERE id = :id");

        $request->bindValue(':id', $categorie->getId());
        $request->bindValue(':description', $categorie->setDescription($categorie->getDescription()));

        return $request->execute();
    }

    /**
     * Delete a categorie with subject, comments
     * @param Categorie $categorie
     * @return bool
     */
    public function delete (Categorie $categorie): bool {
        $request = DB::getInstance()->prepare("DELETE FROM subject WHERE categorie_fk = :categorie_fk");
        $request->bindValue(":categorie_fk", $categorie->getId());
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE subject_fk = :subject_fk");
        $request->bindValue(":subject_fk", $categorie->getId());
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM categorie WHERE id = :id");
        $request->bindValue(":id", $categorie->getId());
        return $request->execute();
    }
}