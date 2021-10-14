<?php
namespace test\UserManager;

use Forum\Entity\User;
use Forum\User\UserManager;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase{

    public function testUpdateUser() {
        $user = new User(null, "Babouche", "babouche@hotmail.fr", "Babouche123", 2);
        $userManager = new UserManager();
    }
}