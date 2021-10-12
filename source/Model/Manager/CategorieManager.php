<?php
namespace Chloe\Forum\Categorie;

use Chloe\Forum\DB;
use Chloe\Forum\Entity\Categorie;
use Chloe\Forum\User\UserManager;
use Chloe\Forum\Manager\Traits\ManagerTrait;

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
        $id = intval($id);
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
     * update a categorie
     * @param Categorie $categorie
     * @return bool
     */
    public function update (Categorie $categorie): bool {
        $request = DB::getInstance()->prepare("UPDATE categorie SET title = :title, description = :description, picture = :picture WHERE id = :id");

        $request->bindValue(':id', $categorie->getId());
        $request->bindValue(':title', $categorie->setTitle($categorie->getTitle()));
        $request->bindValue(':description', $categorie->setDescription($categorie->getDescription()));
        $request->bindValue(':picture', $categorie->setPicture($categorie->getPicture()));

        return $request->execute();
    }

    /**
     * Delete a categorie with subject, comments
     * @param int $id
     * @return bool
     */
    public function delete (int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM subject WHERE categorie_fk = :categorie_fk");
        $request->bindValue(":categorie_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE categorie_fk = :categorie_fk");
        $request->bindValue(":categorie_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM categorie WHERE id = :id");
        $request->bindValue(":id", $id);
        return $request->execute();
    }
}