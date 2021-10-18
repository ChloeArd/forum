<?php
session_start();

require 'vendor/autoload.php';

require_once 'source/Controller/Traits/ReturnViewTrait.php';

use Chloe\Forum\Controller\CategorieController;
use Chloe\Forum\Controller\CommentController;
use Chloe\Forum\Controller\HomeController;
use Chloe\Forum\Controller\SubjectController;
use Chloe\Forum\Controller\UserController;

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