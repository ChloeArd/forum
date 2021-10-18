<?php
namespace Chloe\Forum\Controller;

use Chloe\Forum\Model\Controller\Traits\ReturnViewTrait;
use Chloe\Forum\Model\Manager\UserManager;
use Chloe\Forum\Model\Entity\User;

class UserController {

    use ReturnViewTrait;

    /**
     * Account page
     * @param int $id
     */
    public function account() {
        $this->return("accountView", "Forum : Mon compte");
    }

    /** update info of user
     * @param $user
     */
    public function updateInfo($user) {
        if (isset($_SESSION['id'])) {
            if (isset($user['id'], $user['pseudo'], $user['email'])) {
                $id1 = $_SESSION['id'];
                if ($user['id'] == $_SESSION['id']) {
                    $userManager = new UserManager();

                    $id = intval($user['id']);
                    $pseudo = trim(htmlentities($user['pseudo']));
                    $email = trim(htmlentities($user['email']));

                    // the pseudo size must be less than or equal to 20
                    if (strlen($pseudo) <= 20) {
                        // We check if the EMAIL is valid
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $user = new User($id, $pseudo, $email);
                            $userManager->updateUser($user);
                            header("Location: ../index.php?controller=user&action=view&id=$id&success=0");
                        }
                        else {
                            header("Location: ../../index.php?controller=user&action=updateAccount&id=$id&error=0");
                        }
                    }
                    else {
                        header("Location: ../../index.php?controller=user&action=updateAccount&id=$id&error=1");
                    }
                }
                else {
                    header("Location: ../../index.php?controller=user&action=updateAccount&id=$id1&error=3");
                }
            }
            $this->return("Update/updateAccountView", "Forum : Modifier mon profil");
        }
    }

    /** update password of user
     * @param $user
     */
    public function updatePass($user) {
        if (isset($_SESSION['id'])) {
            if (isset($user['id'], $user['passwordNow'], $user['passwordNew'], $user['passwordNewR'])) {
                $id1 = $_SESSION['id'];
                if ($user['id'] == $_SESSION['id']) {
                    $userManager = new UserManager();

                    $id = intval($user['id']);
                    $passwordNow = trim(htmlentities($user['passwordNow']));
                    $passwordNew = trim(htmlentities($user['passwordNew']));
                    $passwordNewR = trim(htmlentities($user['passwordNewR']));

                    // Check if the password is the current one
                    if ($passwordNow === $_SESSION['password']) {
                        $maj = preg_match('@[A-Z]@', $passwordNew);
                        $min = preg_match('@[a-z]@', $passwordNew);
                        $number = preg_match('@[0-9]@', $passwordNew);
                        // Checks if the new password contains an uppercase, a lowercase, a number and that it has a length greater than or equal to 8.
                        if ($maj && $min && $number && strlen($passwordNew) >= 8) {
                            if ($passwordNew === $passwordNewR) {
                                $user = new User($id, '', '', $passwordNew);
                                $userManager->updatePasswordUser($user);
                                header("Location: ../index.php?controller=user&action=view&id=$id&success=1");
                            }
                            else {
                                header("Location: ../../index.php?controller=user&action=updatePass&id=$id1&error=0");
                            }
                        }
                        else {
                            header("Location: ../../index.php?controller=user&action=updatePass&id=$id1&error=1");
                        }
                    }
                    else {
                        header("Location: ../../index.php?controller=user&action=updatePass&id=$id1&error=2");
                    }
                }
                else {
                    header("Location: ../../index.php?controller=user&action=updatePass&id=$id1&error=3");
                }
            }
            $this->return("Update/updatePasswordView", "Forum : Modifier mon mot de passe");
        }
    }

    /**
     * delete a user
     * @param $user
     */
    public function delete($user) {
        if (isset($_SESSION["id"])) {
            if (isset($user['id'])) {
                $userManager = new UserManager();
                $id = intval($user['id']);
                $userManager->deleteUser($id);
                header("Location: ../index.php?&success=5");
            }
            $this->return('delete/deleteAccountView', "Forum : Supprimer mon compte");
        }
    }
}
