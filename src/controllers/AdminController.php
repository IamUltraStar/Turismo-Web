<?php

class AdminController
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! Acceso Necesario',
                'message' => 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.'
            ];

            header("Location: ./");
            exit();
        }

        $objUser = new User();
        $data = $objUser->getDataUserByID($_SESSION['UserID']);

        if ($data["Rol"] != "administrador") {
            $_SESSION['modal'] = [
                'title' => 'Acceso Restringido',
                'message' => 'Lo sentimos, esta sección está disponible solo para administradores. Si crees que esto es un error, por favor contacta con el soporte.'
            ];

            header("Location: ./");
            exit();
        }

        include('../views/viewAdmin.php');
    }

    public function listUsers()
    {
        include('../views/viewAdminUsersPage.php');
    }

    public function listDestinations()
    {
        include('../views/viewAdminDestinationsPage.php');
    }

    public function listActivities()
    {
        include('../views/viewAdminActivitiesPage.php');
    }
}