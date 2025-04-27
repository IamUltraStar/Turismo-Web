<?php

require_once(ROOT_PATH . "/config/Routing.php");

// Home
$routes->get("", "HomeController::index");
$routes->get("index.php", "HomeController::index");
$routes->get("verifyExistSession", "HomeController::verifyExistSession");
$routes->get("profile", "HomeController::profile");
$routes->post("profile/update", "HomeController::profileUpdate");

// Destinations
$routes->get("destinations", "DestinationsController::index");
$routes->get("listDestinations", "DestinationsController::listDestinations");
$routes->get("listPopularDestinations", "DestinationsController::listPopularDestinations");
$routes->get("listActivityByDestination", "DestinationsController::listActivityByDestination");
$routes->get("listDestinationSearched", "DestinationsController::listDestinationSearched");

// Planning Trip
$routes->get("formPlanningTrip", "PlanningTripController::index");
$routes->get("getProgrammedTripByDestination", "PlanningTripController::getProgrammedTripByDestination");
$routes->get("listProgrammedTripAvailable", "PlanningTripController::listProgrammedTripAvailable");
$routes->get("getProgrammedTrip", "PlanningTripController::getProgrammedTrip");

// Payment
$routes->post("payment", "PaymentController::index");
$routes->post("payment/execute-payment", "PaymentController::executePayment");

// Login
$routes->get("login", "LoginController::viewLogin");
$routes->get("register", "LoginController::viewRegister");
$routes->post("login/execute-login", "LoginController::login");
$routes->post("login/execute-register", "LoginController::register");
$routes->post("register/activate", "LoginController::activate");
$routes->get("login/forgot-password", "LoginController::forgotPassword");
$routes->post("login/send-reset-link", "LoginController::sendResetLink");
$routes->get("login/reset-password", "LoginController::resetPassword");
$routes->post("login/update-password", "LoginController::updatePassword");
$routes->get("logout", "LoginController::logout");

// Admin
$routes->get("admin", "AdminController::index");

// Admin - Destinations
$routes->get("admin/destinations", "BaseDestinations::index");
$routes->post("admin/destinations/create", "BaseDestinations::create");
$routes->post("admin/destinations/update", "BaseDestinations::update");
$routes->post("admin/destinations/delete", "BaseDestinations::delete");

// Admin - Categories
$routes->get("admin/categories", "BaseCategories::index");
$routes->post("admin/categories/create", "BaseCategories::create");
$routes->post("admin/categories/update", "BaseCategories::update");
$routes->post("admin/categories/delete", "BaseCategories::delete");

// Admin - Activities
$routes->get("admin/activities", "BaseActivities::index");
$routes->post("admin/activities/create", "BaseActivities::create");
$routes->post("admin/activities/update", "BaseActivities::update");
$routes->post("admin/activities/delete", "BaseActivities::delete");

// Admin - Payment Methods
$routes->get("admin/payment-methods", "BasePaymentMethods::index");
$routes->post("admin/payment-methods/create", "BasePaymentMethods::create");
$routes->post("admin/payment-methods/update", "BasePaymentMethods::update");
$routes->post("admin/payment-methods/delete", "BasePaymentMethods::delete");

// Admin - Programmed Trips
$routes->get("admin/programmed-trips", "BaseProgrammedTrips::index");
$routes->post("admin/programmed-trips/create", "BaseProgrammedTrips::create");
$routes->post("admin/programmed-trips/update", "BaseProgrammedTrips::update");
$routes->post("admin/programmed-trips/delete", "BaseProgrammedTrips::delete");
