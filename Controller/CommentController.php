<?php
namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Comment\CommentManager;
use Forum\Entity\Comment;
use Forum\Categorie\CategorieManager;
use Forum\Entity\Subject;
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
                $subject_fk = $comment['subject_fk'];
                $id = $comment['subject_fk'];
                $categorie_fk = $comment['categorie_fk'];
                $id2 = $comment['categorie_fk'];
                $user_fk = $comment['user_fk'];

                $subject_fk = $subjectManager->getSubject($subject_fk);
                $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $comment = new Comment(null, $date, $comment1, $categorie_fk, $subject_fk, $user_fk);
                    $commentManager->add($comment);
                    header("Location: ../index.php?controller=subjects&action=view&id=$id&id2=$id2&success=0");
                }

            }
            $this->return("Create/createSubjectView", "Forum : Créer un sujet");
        }
    }

}