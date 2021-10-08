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
require_once './Controller/SubjectController.php';
require_once './Controller/CommentController.php';

use Controller\CategorieController;
use Controller\HomeController;
use Controller\SubjectController;

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
                        $controllerCategories->update($_POST);
                        break;
                    case 'delete' :
                        $controllerCategories->delete($_POST);
                        break;
                }
            }
            break;
        case 'subjects' :
            $controllerSubjects = new SubjectController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'view' :
                        $controllerSubjects->subjects($_GET['id']);
                        break;
                    case 'viewOnly' :
                        $controllerSubjects->subject($_GET['id'], $_GET['id2']);
                        break;
                    case 'new' :
                        $controllerSubjects->add($_POST);
                        break;
                    case 'update' :
                        $controllerSubjects->update($_POST);
                        break;
                    case 'delete' :
                        $controllerSubjects->delete($_POST);
                        break;
                }
            }
            break;
        case 'comments' :
            $commentSubjects = new CommentController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'view' :
                        $controllerSubjects->subjects($_GET['id']);
                        break;
                    case 'viewOnly' :
                        $controllerSubjects->subject($_GET['id'], $_GET['id2']);
                        break;
                    case 'new' :
                        $controllerSubjects->add($_POST);
                        break;
                    case 'update' :
                        $controllerSubjects->update($_POST);
                        break;
                    case 'delete' :
                        $controllerSubjects->delete($_POST);
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