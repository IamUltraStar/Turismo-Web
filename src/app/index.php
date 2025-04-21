<?php
require_once('../controllers/LoginController.php');
require_once('../controllers/HomeController.php');
require_once('../controllers/DestinationsController.php');
require_once('../controllers/PlanningTripController.php');
require_once('../controllers/AdminController.php');
require_once('../controllers/PaymentController.php');

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $uri);
$offset = array_search('app', $segments);

$route = '';
if ($offset !== false) {
    $realSegments = array_slice($segments, $offset + 1);
    $route = implode('/', $realSegments);
}

switch ($route) {
    // Home
    case "":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new HomeController();
            $controller->index();
        }
        break;

    case "index.php":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new HomeController();
            $controller->index();
        }
        break;

    case "verifyExistSession":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new LoginController();
            $controller->verifyExistSession();
        }
        break;

    // Destinations
    case "destinations":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new DestinationsController();
            $controller->index();
        }
        break;

    case "listDestinations":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new DestinationsController();
            $controller->listDestinations();
        }
        break;

    case "listPopularDestinations":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new DestinationsController();
            $controller->listPopularDestinations();
        }
        break;

    case "listActivityByDestination":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new DestinationsController();
            $controller->listActivityByDestination();
        }
        break;

    // Trip
    case "formPlanningTrip":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new PlanningTripController();
            $controller->index();
        }
        break;

    case "getProgrammedTripByDestination":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new PlanningTripController();
            $controller->getProgrammedTripByDestination();
        }
        break;

    case "listProgrammedTripAvailable":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new PlanningTripController();
            $controller->listProgrammedTripAvailable();
        }
        break;

    case "getProgrammedTrip":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new PlanningTripController();
            $controller->getProgrammedTrip();
        }
        break;

    // Payment
    case "payment":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new PaymentController();
            $controller->index();
        }
        break;

    case "payment/execute-payment":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new PaymentController();
            $controller->executePayment();
        }
        break;

    // Login
    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new LoginController();
            $controller->viewLogin();
        }
        break;

    case "register":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new LoginController();
            $controller->viewRegister();
        }
        break;

    case "login/execute-login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new LoginController();
            $controller->login();
        }
        break;

    case "login/execute-register":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new LoginController();
            $controller->register();
        }
        break;

    case "logout":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new LoginController();
            $controller->logout();
        }
        break;

    // Admin
    case "admin":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new AdminController();
            $controller->index();
        }
        break;

    default:
        echo "<h1>404 Not Found</h1>";
        break;
}
