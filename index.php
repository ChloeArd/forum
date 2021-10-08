<?php
session_start();

require_once './Model/DB.php';
require_once './Model/Manager/Traits/ManagerTrait.php';
require_once './Controller/Traits/ReturnViewTrait.php';

require_once './Model/Entity/Role.php';
require_once './Model/Entity/User.php';
require_once './Model/Entity/Categorie.php';
require_once './Model/Entity/Subject.php';
require_once './Model/Entity/Comment.php';

require_once './Model/Manager/RoleManager.php';
require_once './Model/Manager/UserManager.php';
require_once './Model/Manager/CategorieManager.php';
require_once './Model/Manager/SubjectManager.php';
require_once './Model/Manager/CommentManager.php';

require_once './Controller/HomeController.php';
require_once './Controller/CategorieController.php';

use Controller\CategorieController;
use Controller\HomeController;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'categories' :
            $controllerCategories = new CategorieController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'new' :
                        $controllerCategories->add($_POST);
                        break;
                    case 'update' :
                        //$controllerCategories->update($_POST);
                        break;
                    case 'delete' :
                        //$controllerCategories->delete($_POST);
                        break;
                }
            }
            break;
        default:
            break;
    }
}
else {
    $controller = new HomeController();
    $controller->homePage();
}