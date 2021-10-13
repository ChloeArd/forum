<?php
namespace Chloe\Forum\Comment;

use Chloe\Forum\DB;
use Chloe\Forum\Entity\Comment;
use Chloe\Forum\Categorie\CategorieManager;
use Chloe\Forum\User\UserManager;
use Chloe\Forum\Subject\SubjectManager;
use Chloe\Forum\Manager\Traits\ManagerTrait;

class CommentManager {

    use ManagerTrait;

    private UserManager $userManager;
    private SubjectManager $subjectManager;
    private CategorieManager $categorieManager;

    public function __construct() {
        $this->userManager = new UserManager();
        $this->subjectManager = new SubjectManager();
        $this->categorieManager = new CategorieManager();
    }

    /**
     * Return a comment by id
     * @param $id
     * @return Comment
     */
    public function getComment($id) {
        $request = DB::getInstance()->prepare("SELECT * FROM comment WHERE id = :id");
        $request->bindParam(":id", $id);
        $request->execute();
        $data = $request->fetch();
        $comment = new Comment();
        if ($data) {
            $comment->setId($data['id']);
            $comment->setDate($data['date']);
            $comment->setComment($data['comment']);
            $categorie = $this->categorieManager->getCategorie(['categorie_fk']);
            $comment->setCategorieFk($categorie);
            $subject = $this->subjectManager->getSubject(['subject_fk']);
            $comment->setSubjectFk($subject);
            $user = $this->userManager->getUser(['user_fk']);
            $comment->setUserFk($user);
            $comment->setArchive($data['archive']);
        }
        return $comment;
    }

    /**
     * Allows you to display a subject based on its ID.
     * @param int $id
     * @return array
     */
    public function getCommentId(int $id): array {
        $comment = [];
        $request = DB::getInstance()->prepare("SELECT * FROM comment WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $categorie = CategorieManager::getManager()->getCategorie($info['categorie_fk']);
                $subject = SubjectManager::getManager()->getSubject($info['subject_fk']);
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $comment[] = new Comment($info['id'], $info['date'], $info['comment'],$categorie, $subject, $user, $info['archive']);
                }
            }
        }
        return $comment;
    }

    /**
     * Display a comment based on its ID of subject.
     * @param int $subject_fk
     * @return array
     */
    public function getComments(int $subject_fk): array {
        $comment = [];
        $request = DB::getInstance()->prepare("SELECT * FROM comment WHERE subject_fk = :subject_fk");
        $request->bindParam(":subject_fk", $subject_fk);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $categorie = CategorieManager::getManager()->getCategorie($info['categorie_fk']);
                $subject = SubjectManager::getManager()->getSubject($info['subject_fk']);
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $comment[] = new Comment($info['id'], $info['date'], $info['comment'],$categorie, $subject, $user, $info['archive']);
                }
            }
        }
        return $comment;
    }

    /**
     * add a comment
     * @param Comment $comment
     * @return bool
     */
    public function add (Comment $comment): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO comment (date, comment, categorie_fk, subject_fk, user_fk)
                VALUES (:date, :comment, :categorie_fk, :subject_fk, :user_fk) 
        ");

        $request->bindValue(':date', $comment->getDate());
        $request->bindValue(':comment', $comment->getComment());
        $request->bindValue(':categorie_fk', $comment->getCategorieFk()->getId());
        $request->bindValue(':subject_fk', $comment->getSubjectFk()->getId());
        $request->bindValue(':user_fk', $comment->getUserFk()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a comment
     * @param Comment $comment
     * @return bool
     */
    public function update (Comment $comment): bool {
        $request = DB::getInstance()->prepare("UPDATE comment SET date = :date, comment = :comment WHERE id = :id");

        $request->bindValue(':id', $comment->getId());
        $request->bindValue(':date', $comment->getDate());
        $request->bindValue(':comment', $comment->getComment());

        return $request->execute();
    }

    /**
     * Delete a comment
     * @param int $id
     * @return bool
     */
    public function delete (int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE id = :id");
        $request->bindValue(":id", $id);
        return $request->execute();
    }
}