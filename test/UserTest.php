<?php
namespace test\UserManager;

use Chloe\Forum\Model\Entity\Role;
use Chloe\Forum\Model\Entity\User;
use PHPUnit\Framework\TestCase;

require_once "../Model/Entity/User.php";
require_once "../Model/Entity/Role.php";

class UserTest extends TestCase{

    // Test the method getPseudo of user class
    public function testGetPseudo() {
        $role = new Role(2);
        $user = new User(null, "Marine", "marine@hotmail.fr", "Bonjour123", $role, null, null);
        $user->setPseudo("Marina");
        $this->assertEquals($user->getPseudo(), "Marina");
    }

    // Test the method getEmail of user class
    public function testGetEmail() {
        $role = new Role(2);
        $user = new User(null, "Marine", "marine@hotmail.fr", "Bonjour123", $role, null, null);
        $this->assertEquals($user->getEmail(), "marine@hotmail.fr");
    }

    // Test the method getPassword of user class
    public function testGetPassword() {
        $role = new Role(2);
        $user = new User(null, "Marine", "marine@hotmail.fr", "Bonjour123", $role, null, null);
        $this->assertEquals($user->getPassword(), "Bonjour123");
    }
}