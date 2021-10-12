<?php
namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Comment\CommentManager;
use Forum\Entity\Comment;
use Forum\Categorie\CategorieManager;
use Forum\Subject\SubjectManager;
use Forum\User\UserManager;

class CommentController {

    use ReturnViewTrait;

    /**
     * add a comment
     * @param $comment
     */
    public function add($comment) {
        if (isset($_SESSION["id"])) {
            if (isset($comment['date'], $comment['comment'], $comment['categorie_fk'], $comment['subject_fk'], $comment['user_fk'])) {
                $commentManager = new CommentManager();
                $subjectManager = new SubjectManager();
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();

                $date = trim($comment['date']);
                $comment1 = htmlentities(trim(ucfirst($comment['comment'])));
                $subject_fk = intval($comment['subject_fk']);
                $id = $comment['subject_fk'];
                $categorie_fk = intval($comment['categorie_fk']);
                $id2 = $comment['categorie_fk'];
                $user_fk = intval($comment['user_fk']);

                $subject_fk = $subjectManager->getSubject($subject_fk);
                $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $comment = new Comment(null, $date, $comment1, $categorie_fk, $subject_fk, $user_fk);
                    $commentManager->add($comment);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id&id2=$id2&success=0");
                }
            }
            $this->return("Create/createCommentView", "Forum : Ajouter un commentaire");
        }
    }

    /**
     * update a comment
     * @param $comment
     */
    public function update($comment) {
        if (isset($_SESSION["id"])) {
            if (isset($comment['id'], $comment['date'], $comment['comment'], $comment['categorie_fk'], $comment['subject_fk'], $comment['user_fk'])) {
                $commentManager = new CommentManager();
                $userManager = new UserManager();

                $id = intval($comment['id']);
                $date = trim($comment['date']);
                $comment1 = htmlentities(trim(ucfirst($comment['comment'])));
                $id1 = $comment['subject_fk'];
                $id2 = $comment['categorie_fk'];
                $user_fk = intval($comment['user_fk']);

                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $comment = new Comment($id, $date, $comment1);
                    $commentManager->update($comment);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id1&id2=$id2&success=1");
                }
            }
            $this->return("Update/updateCommentView", "Forum : Modifier un commentaire");
        }
    }

    /**
     * delete a comment
     * @param $comment
     */
    public function delete($comment) {
        if (isset($_SESSION["id"])) {
            if (isset($comment['id'], $comment['categorie_fk'], $comment['subject_fk'])) {
                $commentManager = new CommentManager();
                $id = intval($comment['id']);
                $categorie = $comment['categorie_fk'];
                $subject = $comment['subject_fk'];
                $commentManager->delete($id);
                header("Location: ../index.php?controller=subjects&action=viewOnly&id=$subject&id2=$categorie&success=2");
            }
            $this->return('delete/deleteCommentView', "Forum : Supprimer un commentaire");
        }
    }

}