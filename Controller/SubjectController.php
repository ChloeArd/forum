<?php
namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\Categorie\CategorieManager;
use Forum\Comment\CommentManager;
use Forum\Entity\Subject;
use Forum\Subject\SubjectManager;
use Forum\User\UserManager;

class SubjectController {

    use ReturnViewTrait;

    /**
     * @param int $categorie_fk
     */
    public function subjects(int $categorie_fk) {
        $manager = new SubjectManager();
        $manager2 = new CategorieManager();
        $this->return("subjectsView", "Forum : Sujets", ['subjects' => $manager->getSubjects($categorie_fk), 'categorie' => $manager2->getCategorieId($categorie_fk)]);
    }

    /**
     * @param int $id
     * @param int $id2
     */
    public function subject(int $id, int $categorie_fk) {
        $manager = new SubjectManager();
        $manager2 = new CommentManager();
        $this->return("subjectView", "Forum : Sujet", ['subject' => $manager->getSubjectId($id, $categorie_fk), 'comments' => $manager2->getComments($id)]);
    }

    /**
     * add a subject
     * @param $subject
     */
    public function add($subject) {
        if (isset($_SESSION["id"])) {
            if (isset($subject['title'], $subject['description'], $subject['date'], $subject['text'], $subject['picture'], $subject['categorie_fk'], $subject['user_fk'])) {
                $subjectManager = new SubjectManager();
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();

                $title = htmlentities(trim(ucfirst($subject['title'])));
                $description = htmlentities(trim(ucfirst($subject['description'])));
                $date = $subject['date'];
                $text = htmlentities(trim(ucfirst($subject['text'])));
                $picture = trim($subject['picture']);
                $categorie_fk = $subject['categorie_fk'];
                $id = $subject['categorie_fk'];
                $user_fk = $subject['user_fk'];

                if (strlen($title) >= 40) {
                    header("Location: ../index.php?controller=subjects&action=new&error=0");
                }
                if (filter_var($picture, FILTER_VALIDATE_URL)) {
                    $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        $subject = new Subject(null, $title, $description, $date, $text, $picture, $categorie_fk, $user_fk);
                        $subjectManager->add($subject);
                        header("Location: ../index.php?controller=subjects&action=view&id=$id&success=0");
                    }
                } else {
                    header("Location: ../index.php?controller=subjects&action=new&error=1");
                }
            }
            $this->return("Create/createSubjectView", "Forum : Créer un sujet");
        }
    }

    /**
     * add a subject
     * @param $subject
     */
    public function update($subject) {
        if (isset($_SESSION["id"])) {
            if (isset($subject['id'], $subject['title'], $subject['description'], $subject['date'], $subject['text'], $subject['picture'], $subject['categorie_fk'], $subject['user_fk'])) {
                $subjectManager = new SubjectManager();
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();

                $id = intval($subject['id']);
                $title = htmlentities(trim(ucfirst($subject['title'])));
                $description = htmlentities(trim(ucfirst($subject['description'])));
                $date = $subject['date'];
                $text = htmlentities(trim(ucfirst($subject['text'])));
                $picture = trim($subject['picture']);
                $categorie_fk = $subject['categorie_fk'];
                $id2 = $subject['categorie_fk'];
                $user_fk = $subject['user_fk'];

                if (strlen($title) >= 40) {
                    header("Location: ../index.php?controller=subjects&action=update&error=0");
                }
                if (filter_var($picture, FILTER_VALIDATE_URL)) {
                    $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        $subject = new Subject($id, $title, $description, $date, $text, $picture, $categorie_fk, $user_fk);
                        $subjectManager->update($subject);
                        header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id&id2=$id2&success=0");
                    }
                } else {
                    header("Location: ../index.php?controller=subjects&action=update&error=1");
                }
            }
            $this->return("Update/updateSubjectView", "Forum : Modifier un sujet");
        }
    }

    /**
     * delete a subject
     * @param $subject
     */
    public function delete($subject) {
        if (isset($_SESSION["id"])) {
            if (isset($subject['id'])) {
                $subjectManager = new SubjectManager();
                $id = intval($subject['id']);
                $subjectManager->delete($id);
                header("Location: ../index.php?&success=4");
            }
            $this->return('delete/deleteSubjectView', "Forum : Supprimer un sujet");
        }
    }
}