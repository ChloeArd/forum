<?php
namespace Forum\Subject;

use Forum\DB;
use Forum\Entity\Subject;
use Forum\User\UserManager;
use Forum\Categorie\CategorieManager;
use Forum\Manager\Traits\ManagerTrait;

class SubjectManager {

    use ManagerTrait;

    private UserManager $userManager;
    private CategorieManager $categorieManager;

    public function __construct() {
        $this->userManager = new UserManager();
        $this->categorieManager = new CategorieManager();
    }

    /**
     * Return a subject based on id
     * @param $id
     * @return Subject
     */
    public function getSubject($id) {
        $request = DB::getInstance()->prepare("SELECT * FROM subject WHERE id = :id");
        $request->bindParam(":id", $id);
        $request->execute();
        $data = $request->fetch();
        $subject = new Subject();
        if ($data) {
            $subject->setId($data['id']);
            $subject->setTitle($data['title']);
            $subject->setDescription($data['description']);
            $subject->setDate($data['date']);
            $subject->setText($data['text']);
            $subject->setPicture($data['picture']);
            $categorie = $this->categorieManager->getCategorie(['categorie_fk']);
            $subject->setCategorieFk($categorie);
            $user = $this->userManager->getUser(['user_fk']);
            $subject->setUserFk($user);
        }
        return $subject;
    }

    /**
     * Allows you to display a subject based on its ID.
     * @param int $id
     * @param int $categorie_fk
     * @return array
     */
    public function getSubjectId(int $id, int $categorie_fk): array {
        $subject = [];
        $request = DB::getInstance()->prepare("SELECT * FROM subject WHERE id = :id AND categorie_fk = :categorie_fk");
        $request->bindParam(":id", $id);
        $request->bindParam(":categorie_fk", $categorie_fk);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $categorie = CategorieManager::getManager()->getCategorie($info['categorie_fk']);
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $subject[] = new Subject($info['id'], $info['title'], $info['description'], $info['date'], $info['text'], $info['picture'], $categorie, $user);
                }
            }
        }
        return $subject;
    }

    /**
     * Display a subject based on its ID of categorie
     * @param int $id
     * @return array
     */
    public function getSubjects(int $categorie_fk): array {
        $subject = [];
        $request = DB::getInstance()->prepare("SELECT * FROM subject WHERE categorie_fk = :categorie_fk ORDER by id DESC");
        $request->bindParam(":categorie_fk", $categorie_fk);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $categorie = CategorieManager::getManager()->getCategorie($categorie_fk);
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $subject[] = new Subject($info['id'], $info['title'], $info['description'], $info['date'], $info['text'], $info['picture'], $categorie, $user);
                }
            }
        }
        return $subject;
    }

    /**
     * add a subject
     * @param Subject $subject
     * @return bool
     */
    public function add (Subject $subject): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO subject (title, description, date, text, picture, categorie_fk, user_fk)
                VALUES (:title, :description, :date, :text, :picture, :categorie_fk, :user_fk) 
        ");

        $request->bindValue(':title', $subject->getTitle());
        $request->bindValue(':description', $subject->getDescription());
        $request->bindValue(':date', $subject->getDate());
        $request->bindValue(':text', $subject->getText());
        $request->bindValue(':picture', $subject->getPicture());
        $request->bindValue(':categorie_fk', $subject->getCategorieFk()->getId());
        $request->bindValue(':user_fk', $subject->getUserFk()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a subject
     * @param Subject $subject
     * @return bool
     */
    public function update (Subject $subject): bool {
        $request = DB::getInstance()->prepare("UPDATE subject SET title = :title, description = :description, date = :date,
                   text = :text, picture = :picture WHERE id = :id");

        $request->bindValue(':id', $subject->getId());
        $request->bindValue(':title', $subject->getTitle());
        $request->bindValue(':description', $subject->setDescription($subject->getDescription()));
        $request->bindValue(':date', $subject->getDate());
        $request->bindValue(':text', $subject->getText());
        $request->bindValue(':picture', $subject->getPicture());

        return $request->execute();
    }

    /**
     * Delete a subject with comments
     * @param Subject $subject
     * @return bool
     */
    public function delete (Subject $subject): bool {
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE subject_fk = :subject_fk");
        $request->bindValue(":subject_fk", $subject->getId());
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM subject WHERE id = :id");
        $request->bindValue(":id", $subject->getId());
        return $request->execute();
    }
}