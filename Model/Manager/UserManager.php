<?php
namespace Forum\User;

use Forum\DB;
use Forum\Entity\User;
use Forum\Role\RoleManager;
use Forum\Manager\Traits\ManagerTrait;

class UserManager {

    use ManagerTrait;

    private RoleManager $roleManager;

    public function __construct() {
        $this->roleManager = new RoleManager();
    }

    /**
     * Return all users.
     * @return array
     */
    public function getUsers(): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $result = $request->execute();
        if($result) {
            foreach($request->fetchAll() as $info) {
                $role = RoleManager::getManager()->getRole($info['role_fk']);
                if ($role->getId()) {
                    $users[] = new User($info['id'], $info['pseudo'], $info['email'],'', $role);
                }
            }
        }
        return $users;
    }

    /**
     * Return a user based on id.
     * @param $id
     * @return User
     */
    public function getUser( $id): User {
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
        $id = intval($id);
        $request->bindParam(":id", $id);
        $request->execute();
        $info = $request->fetch();
        $user = new User();
        if ($info) {
            $user->setId($info['id']);
            $user->setPseudo($info['pseudo']);
            $user->setEmail($info['email']);
            $user->setPassword(''); // We do not display the password
            $role = $this->roleManager->getRole($info['role_fk']);
            $user->setRoleFk($role);
        }
        return $user;
    }

    /**
     * Display a user based on id.
     * @param int $id
     * @return array
     */
    public function getUserID(int $id): array {
        $user = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach($request->fetchAll() as $info) {
                $role = RoleManager::getManager()->getRole($info['role_fk']);
                if ($role->getId()) {
                    $user[] = new User($info['id'], $info['pseudo'] ,$info['email'],'', $role);
                }
            }
        }
        return $user;
    }

    /**
     * Change the user's password.
     * @param User $user
     * @return bool
     */
    public function updatePasswordUser(User $user): bool {
        $request = DB::getInstance()->prepare("UPDATE user SET password = :password WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        // We update the superglobal session to be able to put the new password of the user.
        $_SESSION['password'] = $user->setPassword($user->getPassword());
        // The password is encrypted in the database.
        $password = password_hash($user->setPassword($user->getPassword()), PASSWORD_BCRYPT);
        $request->bindValue(':password', $password);
        return $request->execute();

    }

    /**
     * Modifies the user's personal information.
     * @param User $user
     * @return bool
     */
    public function updateUser(User $user): bool {
        $request = DB::getInstance()->prepare("UPDATE user SET pseudo = :pseudo, email = :email WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $_SESSION['pseudo'] = $user->setPseudo($user->getPseudo());
        $request->bindValue(':pseudo', $user->setPseudo($user->getPseudo()));
        $_SESSION['email'] = $user->setEmail($user->getEmail());
        $request->bindValue(':email', $user->setEmail($user->getEmail()));

        return $request->execute();
    }

    /**
     * Change a user's role.
     * @param User $user
     * @return bool
     */
    public function updateRoleUser(User $user): bool {
        $request = DB::getInstance()->prepare("UPDATE user SET role_fk = :role_fk WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $request->bindValue(':role_fk', $user->setRoleFk($user->getRoleFk())->getId());

        return $request->execute();
    }

    /**
     * Deletes a user but also deletes the categories, subjects, comments
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM categorie WHERE user_fk = :user_fk");
        $request->bindParam(":user_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM subject WHERE user_fk = :user_fk");
        $request->bindParam(":user_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE user_fk = :user_fk");
        $request->bindParam(":user_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM user WHERE id = :id");
        $request->bindParam(":id", $id);

        session_start();
        session_unset();
        session_destroy();

        return $request->execute();
    }
}