<?php
require_once("../models/User.php");

class LoginController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        session_start();
    }

    public function index()
    {
    }

    public function viewLogin()
    {
        if (isset($_SESSION['UserID'])) {
            header("Location: ./");
            exit();
        }

        $titleTab = 'Login';
        $visibleFormLogin = '';
        $visibleFormRegister = 'hidden';

        include('../views/viewLogin.php');
    }

    public function viewRegister()
    {
        if (isset($_SESSION['UserID'])) {
            header("Location: ./");
            exit();
        }

        $titleTab = 'Register';
        $visibleFormLogin = 'hidden';
        $visibleFormRegister = '';

        include('../views/viewLogin.php');
    }

    public function login(): void
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!($this->userModel->checkErrorsLogin($username, $password))) {
            echo "1";
            exit();
        }

        $UserID = $this->userModel->executeLogin($username, $password);

        if ($UserID !== false) {
            $_SESSION['UserID'] = $UserID;
            $data = $this->userModel->getDataUserByID($UserID);

            if ($data["Rol"] == "administrador") {
                echo "-1";
            } else {
                echo "0";
            }
        } else {
            echo "2";
        }
    }

    public function register()
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password1 = $_POST["password1"];

        $type_error = $this->userModel->checkErrorsRegister($name, $email, $username, $password, $password1);

        if ($type_error == '0') {
            $UserID = $this->userModel->executeRegister($name, $email, $username, $password);
            $_SESSION['UserID'] = $UserID;
        }

        echo $type_error;
    }
    public function logout()
    {
        session_destroy();
        header("Location: ./");
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

}