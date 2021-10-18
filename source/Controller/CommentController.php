<?php
namespace Chloe\Forum\Controller;

use Chloe\Forum\Model\Controller\Traits\ReturnViewTrait;
use Chloe\Forum\Model\Manager\CommentManager;
use Chloe\Forum\Model\Entity\Comment;
use Chloe\Forum\Model\Manager\CategorieManager;
use Chloe\Forum\Model\Manager\SubjectManager;
use Chloe\Forum\Model\Manager\UserManager;

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
                $subjectManager = new SubjectManager();
                $categorieManager = new CategorieManager();

                $id = intval($comment['id']);
                $date = trim($comment['date']);
                $comment1 = htmlentities(trim(ucfirst($comment['comment'])));
                $id1 = intval($comment['subject_fk']);
                $id2 = intval($comment['categorie_fk']);
                $user_fk = intval($comment['user_fk']);

                $user_fk = $userManager->getUser($user_fk);
                $subject_fk = $subjectManager->getSubject($id1);
                $categorie_fk = $categorieManager->getCategorie($id2);
                if ($user_fk->getId()) {
                    $comment = new Comment($id, $date, $comment1,$categorie_fk, $subject_fk, $user_fk);
                    $commentManager->update($comment);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id1&id2=$id2&success=1");
                }
            }
            $this->return("Update/updateCommentView", "Forum : Modifier un commentaire");
        }
    }

    /**
     * report comment
     * @param $comment
     */
    public function report($comment) {
        if (isset($_SESSION["id"])) {
            if (isset($comment['id'], $comment['categorie_fk'], $comment['subject_fk'], $comment['user_fk'])) {
                $commentManager = new CommentManager();
                $userManager = new UserManager();

                $id = intval($comment['id']);
                $id1 = $comment['subject_fk'];
                $id2 = $comment['categorie_fk'];
                $user_fk = intval($comment['user_fk']);

                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $comment = new Comment($id);
                    $commentManager->report($comment);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id1&id2=$id2&success=5");
                }
            }
            $this->return("Update/updateCommentReportView", "Forum : Signaler un commentaire");
        }
    }

    /**
     * display a report
     */
    public function reportAdmin() {
        $manager = new CommentManager();
        $this->return("reportView", "Forum : Sujets", ['comments' => $manager->getCommentReport()]);
    }

    /**
     * Archive a comment
     * @param $comment
     */
    public function archive($comment) {
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role_fk'] !== "2") {
                if (isset($comment['id'], $comment['categorie_fk'], $comment['subject_fk'], $comment['user_fk'])) {
                    $subjectManager = new SubjectManager();
                    $commentManager = new CommentManager();
                    $userManager = new UserManager();
                    $categorieManager = new CategorieManager();

                    $id = intval($comment['id']);
                    $categorie_fk = intval($comment['categorie_fk']);
                    $id2 = $categorie_fk;
                    $subject_fk = intval($comment['subject_fk']);
                    $id1 = $subject_fk;
                    $user_fk = intval($comment['user_fk']);

                    $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                    $subject_fk = $subjectManager->getSubject($subject_fk);
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        // 1 means the category is archived.
                        $comment = new Comment($id, '', '', $categorie_fk, $subject_fk, $user_fk, 1);
                        $commentManager->archive($comment);
                        header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id1&id2=$id2&success=4");
                    }
                }
            }
        }
        $this->return("Archive/archiveCommentView", "Forum : Archiver un commentaire");
    }

    /**
     * delete a comment
     * @param $comment
     */
    public function delete($comment) {
        if (isset($_SESSION["id"])) {
            if (isset($comment['id'], $comment['comment'], $comment['date'], $comment['user_fk'], $comment['categorie_fk'], $comment['subject_fk'])) {
                $commentManager = new CommentManager();
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();
                $subjectManager = new SubjectManager();

                $id = intval($comment['id']);
                $commentUser = htmlentities($comment['comment']);
                $date = htmlentities($comment['date']);
                $user_fk = intval($comment['user_fk']);
                $categorie = intval($comment['categorie_fk']);
                $subject = intval($comment['subject_fk']);

                $user_fk = $userManager->getUser($user_fk);
                $categorie_fk = $categorieManager->getCategorie($categorie);
                $subject_fk = $subjectManager->getSubject($subject);
                if ($user_fk->getId()) {
                    $comment = new Comment($id, $date, $commentUser, $categorie_fk, $subject_fk, $user_fk);
                    $commentManager->delete($comment);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$subject&id2=$categorie&success=2");
                }
            }
            $this->return('delete/deleteCommentView', "Forum : Supprimer un commentaire");
        }
    }
}