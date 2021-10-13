<?php
namespace Forum\Controller;

use Forum\Controller\Traits\ReturnViewTrait;
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
     * @param int $user_fk
     */
    public function subjectsByUser(int $user_fk) {
        $manager = new SubjectManager();
        $this->return("accountSubjectView", "Forum : Mes sujets", ['subjects' => $manager->getSubjectIdUser($user_fk)]);
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

                // the title size must be less than or equal to 40
                if (strlen($title) <= 40) {
                    // We check if the URL is valid
                    if (filter_var($picture, FILTER_VALIDATE_URL)) {
                        $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                        $user_fk = $userManager->getUser($user_fk);
                        if ($user_fk->getId()) {
                            $subject = new Subject(null, $title, $description, $date, $text, $picture, $categorie_fk, $user_fk);
                            $subjectManager->add($subject);
                            header("Location: ../index.php?controller=subjects&action=view&id=$id&success=0");
                        }
                    }
                    else {
                        header("Location: ../index.php?controller=subjects&action=new&error=1");
                    }
                }
                else {
                    header("Location: ../index.php?controller=subjects&action=new&error=0");
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

                // the title size must be less than or equal to 40
                if (strlen($title) <= 40) {
                    // We check if the URL is valid
                    if (filter_var($picture, FILTER_VALIDATE_URL)) {
                        $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                        $user_fk = $userManager->getUser($user_fk);
                        if ($user_fk->getId()) {
                            $subject = new Subject($id, $title, $description, $date, $text, $picture, $categorie_fk, $user_fk);
                            $subjectManager->update($subject);
                            header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id&id2=$id2&success=1");
                        }
                    }
                    else {
                        header("Location: ../index.php?controller=subjects&action=update&error=1");
                    }
                }
                else {
                    header("Location: ../index.php?controller=subjects&action=update&error=0");
                }
            }
            $this->return("Update/updateSubjectView", "Forum : Modifier un sujet");
        }
    }

    /**
     * Archive a subject
     * @param $subject
     */
    public function archive($subject) {
        if (isset($_SESSION['id'])) {
            if (isset($subject['id'], $subject['categorie_fk'], $subject['user_fk'])) {
                $subjectManager = new SubjectManager();
                $userManager = new UserManager();
                $categorieManager = new CategorieManager();

                $id = intval($subject['id']);
                $categorie_fk = intval($subject['categorie_fk']);
                $id2 = $categorie_fk;
                $user_fk = intval($subject['user_fk']);

                $categorie_fk = $categorieManager->getCategorie($categorie_fk);
                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    // 1 means the category is archived.
                    $subject = new Subject($id, '', '', '', '','', $categorie_fk, $user_fk, 1 );
                    $subjectManager->archive($subject);
                    header("Location: ../index.php?controller=subjects&action=viewOnly&id=$id&id2=$id2&success=3");
                }
            }
        }
        $this->return("Archive/archiveSubjectView", "Forum : Archiver un sujet");
    }

    /**
     * delete a subject
     * @param $subject
     */
    public function delete($subject) {
        if (isset($_SESSION["id"])) {
            if (isset($subject['id'], $subject['categorie_fk'])) {
                $subjectManager = new SubjectManager();
                $categrorie = intval($subject['categorie_fk']);
                $id = intval($subject['id']);
                $subjectManager->delete($id);
                header("Location: ../index.php?controller=subjects&action=view&id=$categrorie&success=2");
            }
            $this->return('delete/deleteSubjectView', "Forum : Supprimer un sujet");
        }
    }
}