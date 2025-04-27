<?php

require_once("../models/User.php");

class HomeController
{
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->userModel = new User();
    }

    public function index()
    {
        include(ROOT_PATH . '/views/viewHomePage.php');
    }

    public function verifyExistSession()
    {
        if (isset($_SESSION['UserID'])) {
            $initials = '';

            $data = $this->userModel->getDataUserByID($_SESSION['UserID']);
            $datasplit = explode(" ", $data['FullName']);

            for ($i = 0; $i < 2; $i++) {
                $initials .= $datasplit[$i][0];
            }

            echo $initials;
        }
    }

    public function profile()
    {
        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! No has iniciado sesión',
                'message' => 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.'
            ];

            return view("");
        }

        $_SESSION['view_profile'] = true;
        $userData = $this->userModel->getDataUserByID($_SESSION['UserID']);

        include(ROOT_PATH . "/views/viewHomePage.php");
    }

    public function profileUpdate()
    {
        $fullname = $_POST['fullname'] ?? null;
        $password = $_POST['password'] ?? null;
        $newPassword = $_POST['new_password'] ?? null;
        $passwordConfirm = $_POST['confirm_password'] ?? null;

        if ($fullname) {
            if ($newPassword === $passwordConfirm) {
                $result = $this->userModel->updateDataUser($_SESSION['UserID'], trim($fullname), $password, $newPassword);
                if ($result === '1') {
                    $_SESSION['modal'] = [
                        'title' => '¡Éxito!',
                        'message' => 'Los datos se actualizaron correctamente.'
                    ];
                } elseif ($result === '0') {
                    $_SESSION['modal'] = [
                        'title' => 'Error',
                        'message' => 'La contraseña actual es incorrecta. Por favor, inténtelo de nuevo.'
                    ];
                } else {
                    $_SESSION['modal'] = [
                        'title' => 'Error',
                        'message' => 'Error al actualizar los datos. Por favor, inténtelo de nuevo más tarde.'
                    ];
                }
            } else {
                $_SESSION['modal'] = [
                    'title' => 'Error',
                    'message' => 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.'
                ];
            }
        } else {
            $_SESSION['modal'] = [
                'title' => 'Error',
                'message' => 'LLene todos los campos obligatorios. -> {' . $_POST['new_password']
            ];
        }

        return view("");
    }

}