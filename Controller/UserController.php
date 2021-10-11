<?php
namespace Controller;

use Controller\Traits\ReturnViewTrait;
use Forum\User\UserManager;
use Forum\Entity\User;

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

                    if (strlen($pseudo) > 20) {
                        header("Location: ../../index.php?controller=user&action=updateAccount&id=$id&error=1");
                    }
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $user = new User($id, $pseudo, $email);
                        $userManager->updateUser($user);
                        header("Location: ../index.php?controller=user&action=view&id=$id&success=0");
                    }
                }
                else {
                    header("Location: ../../index.php?controller=user&action=updateAccount&id=$id1&error=2");
                }
            }
            $this->return("Update/updateAccountView", "Forum : Modifier mon profil");
        }
    }
}
