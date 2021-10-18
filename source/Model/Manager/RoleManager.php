<?php
namespace Chloe\Forum\Model\Manager;

use Chloe\Forum\Model\DB;
use Chloe\Forum\Model\Entity\Role;
use Chloe\Forum\Model\Manager\Traits\ManagerTrait;

require_once "Traits/ManagerTrait.php";

class RoleManager {

    use ManagerTrait;

    /**
     * Return a role based on id.
     * @param int $id
     */
    public function getRole(int $id) {
        $request = DB::getInstance()->prepare("SELECT * FROM role WHERE id = $id");
        $request->execute();
        $info = $request->fetch();
        $role = new Role();
        if ($info) {
            $role->setId($info['id']);
            $role->setRole($info['role']);
        }
        return $role;
    }

    /**
     * Return all roles
     * @return array
     */
    public function getRoles(): array {
        $roles = [];
        $request = DB::getInstance()->prepare("SELECT * FROM role");
        $request->execute();
        $roles_response = $request->fetchAll();
        if($roles_response) {
            foreach($roles_response as $info) {
                $roles[] = new Role($info['id'], $info['role']);
            }
        }
        return $roles;
    }
}