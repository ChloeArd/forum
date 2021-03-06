<?php
session_start();

require_once "Model/DB.php";
require_once "Controller/Traits/ReturnViewTrait.php";
require_once "Model/Manager/Traits/ManagerTrait.php";

require_once "Controller/CommentController.php";
require_once "Controller/CategorieController.php";
require_once "Controller/HomeController.php";
require_once "Controller/SubjectController.php";
require_once "Controller/UserController.php";

require_once "Model/Entity/Categorie.php";
require_once "Model/Entity/Comment.php";
require_once "Model/Entity/Role.php";
require_once "Model/Entity/Subject.php";
require_once "Model/Entity/User.php";

require_once "Model/Manager/CommentManager.php";
require_once "Model/Manager/CategorieManager.php";
require_once "Model/Manager/RoleManager.php";
require_once "Model/Manager/SubjectManager.php";
require_once "Model/Manager/UserManager.php";

use Forum\Controller\CategorieController;
use Forum\Controller\CommentController;
use Forum\Controller\HomeController;
use Forum\Controller\SubjectController;
use Forum\Controller\UserController;

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
                    case 'archive' :
                        $controllerCategories->archive($_POST);
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
                    case 'archive' :
                        $controllerSubjects->archive($_POST);
                        break;
                    case 'delete' :
                        $controllerSubjects->delete($_POST);
                        break;
                }
            }
            break;
        case 'comments' :
            $controllerComments = new CommentController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'new' :
                        $controllerComments->add($_POST);
                        break;
                    case 'update' :
                        $controllerComments->update($_POST);
                        break;
                    case 'archive' :
                        $controllerComments->archive($_POST);
                        break;
                    case 'report' :
                        $controllerComments->report($_POST);
                        break;
                    case 'reportAdmin' :
                        $controllerComments->reportAdmin($_POST);
                    case 'delete' :
                        $controllerComments->delete($_POST);
                        break;
                }
            }
            break;
        case 'home' :
            $controller = new HomeController();
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'connection' :
                        $controller->connection();
                        break;
                    case 'registration' :
                        $controller->registration();
                        break;
                }
            }
        case 'user' :
            $controller = new UserController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'view' :
                        $controller->account();
                        break;
                    case 'updateAccount' :
                        $controller->updateInfo($_POST);
                        break;
                    case 'updatePass' :
                        $controller->updatePass($_POST);
                        break;
                    case 'delete' :
                        $controller->delete($_POST);
                        break;
                    case 'sujects' :
                        $controller = new SubjectController();
                        $controller->subjectsByUser($_GET['id']);
                        break;
                }
            }
    }
}
else {
    $controller = new HomeController();
    $controller->homePage();
}