<?php

require_once ROOT_PATH . "/models/User.php";
require_once ROOT_PATH . "/models/Destination.php";
require_once ROOT_PATH . "/models/CategoryDestination.php";

class AdminController
{
    private $destinationModel;
    private $categoryModel;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->destinationModel = new Destination();
        $this->categoryModel = new CategoryDestination();
        session_start();
    }

    public function index()
    {
        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! Acceso Necesario',
                'message' => 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.'
            ];

            return view("");
        }

        $data = $this->userModel->getDataUserByID($_SESSION['UserID']);

        if ($data["Rol"] != "administrador") {
            $_SESSION['modal'] = [
                'title' => 'Acceso Restringido',
                'message' => 'Lo sentimos, esta sección está disponible solo para administradores. Si crees que esto es un error, por favor contacta con el soporte.'
            ];

            return view("");
        }

        $arrayDestinations = $this->destinationModel->listDestination();
        $arrayCategories = $this->categoryModel->listCategoryDestination();

        include(ROOT_PATH . '/views/admin/destinations.php');
    }

}