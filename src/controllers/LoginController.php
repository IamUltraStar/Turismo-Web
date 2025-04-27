<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../models/User.php");
require ROOT_PATH . '/services/PHPMailer/src/Exception.php';
require ROOT_PATH . '/services/PHPMailer/src/PHPMailer.php';
require ROOT_PATH . '/services/PHPMailer/src/SMTP.php';

class LoginController
{
    private $userModel;

    public function __construct()
    {
        session_start();
        $this->userModel = new User();
    }

    public function viewLogin()
    {
        if (isset($_SESSION['UserID'])) {
            return view("");
        }

        $titleTab = 'Login';
        $visibleFormLogin = '';
        $visibleFormRegister = 'hidden';

        include('../views/viewLogin.php');
    }

    public function viewRegister()
    {
        if (isset($_SESSION['UserID'])) {
            return view("");
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
            $token = bin2hex(random_bytes(20)); // Generate a random token for email confirmation
            $userID = $this->userModel->executeRegister($name, $email, $username, $password, $token);

            $mail = new PHPMailer(true);

            try {
                //Recipients
                $mail->setFrom('jhordan.jkjm@gmail.com', 'Turismo Piesco');
                $mail->addAddress($email, $name);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Activacion de cuenta - PIESCO';
                $mail->CharSet = 'UTF-8';
                $body = '<div style="font-family: sans-serif; font-size: 14px; color: #333;">';
                $body .= '<h1 style="color: #000;">Confirmar Registro</h1>';
                $body .= '<p style="margin: 0;">Hola, ' . $name . '</p>';
                $body .= '<p style="margin: 0;">Gracias por registrarte en Turismo Piesco. Por favor, confirma tu registro haciendo clic en el siguiente enlace:</p>';
                $body .= '<form style="margin: 0;" action="' . APP_URL . '/register/activate?token=' . $token . '&id=' . $userID . '" method="POST">';
                $body .= '<input type="hidden" name="id" value="' . $userID . '">';
                $body .= '<input type="hidden" name="token" value="' . $token . '">';
                $body .= '<button type="submit" style="background-color: #000; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 10px; cursor: pointer; border-radius: 8px;">Confirmar Registro</button>';
                $body .= '</form>';
                $body .= '<p style="margin: 0;">Si no te has registrado, ignora este correo.</p>';
                $body .= '<p style="margin: 0;">Saludos,</p>';
                $body .= '<p style="margin: 0;">El equipo de Turismo Piesco</p>';
                $body .= '</div>';
                $mail->Body = $body;

                $mail->send();

                echo '-2';
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                exit();
            }
        }

        echo $type_error;
    }

    public function activate()
    {
        $id = $_POST['id'] ?? null;
        $token = $_POST['token'] ?? null;

        if ($id && $token) {
            $valid = $this->userModel->activateUser($id, $token);

            if ($valid) {
                $_SESSION['modal'] = [
                    'title' => '¡Éxito! Cuenta activada',
                    'message' => 'Tu cuenta ha sido activada exitosamente. Ahora puedes iniciar sesión.'
                ];
            } else {
                $_SESSION['modal'] = [
                    'title' => '¡Error! Token inválido',
                    'message' => 'El token de activación es inválido o ya ha sido utilizado.'
                ];
            }

            return view("login");
        }
    }

    public function forgotPassword()
    {
        $_SESSION['view_forgotPassword'] = true;
        $this->viewLogin();
    }

    public function sendResetLink()
    {
        $email = $_POST['email'] ?? null;

        if ($email) {
            $user = $this->userModel->getDataUserByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(20)); // Generate a random token for password reset

                $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration time for the token

                $this->userModel->storeResetToken($user['UserID'], $token, $expiration);

                $mail = new PHPMailer(true);

                try {
                    //Recipients
                    $mail->setFrom('jhordan.jkjm@gmail.com', 'Turismo Piesco');
                    $mail->addAddress($email, $user['FullName']);

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Restablecer mi contraseña - PIESCO';
                    $mail->CharSet = 'UTF-8';
                    $body = '<div style="font-family: sans-serif; font-size: 14px; color: #333;">';
                    $body .= '<h1 style="color: #000;">Restablecer mi contraseña</h1>';
                    $body .= '<p style="margin: 0;">Hola, ' . $user['FullName'] . '</p>';
                    $body .= '<p style="margin: 0;">Recibiste este correo porque solicitaste restablecer tu contraseña. Haz clic en el siguiente botón para restablecerla:</p>';
                    $body .= '<a href="' . APP_URL . '/login/reset-password?token=' . $token . '&id=' . $user['UserID'] . '" type="submit" style="background-color: #000; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 10px; cursor: pointer; border-radius: 8px;">Restablecer tu contraseña</a>';
                    $body .= '<p style="margin: 0;">Si no solicitaste este cambio, ignora este correo.</p>';
                    $body .= '<p style="margin: 0;">Saludos,</p>';
                    $body .= '<p style="margin: 0;">El equipo de Turismo Piesco</p>';
                    $body .= '</div>';
                    $mail->Body = $body;

                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $_SESSION['modal'] = [
                    'title' => '¡Éxito! Correo enviado',
                    'message' => 'Se ha enviado un enlace para restablecer tu contraseña a tu correo electrónico.'
                ];
            } else {
                $_SESSION['modal'] = [
                    'title' => '¡Error! No existe el correo',
                    'message' => 'El correo electrónico ingresado no está registrado o activo.'
                ];
            }
        } else {
            $_SESSION['modal'] = [
                'title' => '¡Error!',
                'message' => 'Por favor, ingrese un correo electrónico válido.'
            ];
        }

        return view("login");
    }

    public function resetPassword()
    {
        if (isset($_GET['token']) && isset($_GET['id'])) {

            $valid = $this->userModel->checkToken($_GET['id'], $_GET['token']);

            if (!$valid) {
                $_SESSION['modal'] = [
                    'title' => '¡Error! Token inválido',
                    'message' => 'El token de restablecimiento de contraseña es inválido o ha expirado.'
                ];
                return view("login");
            }

            include(ROOT_PATH . '/views/viewResetPassword.php');
        }
    }

    public function updatePassword()
    {
        $id = $_POST['id'] ?? null;
        $token = $_POST['token'] ?? null;
        $new_password = $_POST['new_password'] ?? null;
        $confirm_password = $_POST['confirm_password'] ?? null;

        if ($id && $token && $new_password && $confirm_password) {
            if ($new_password === $confirm_password) {
                $valid = $this->userModel->updatePassword($id, $token, $new_password);

                if ($valid) {
                    $_SESSION['modal'] = [
                        'title' => '¡Éxito! Contraseña actualizada',
                        'message' => 'Tu contraseña ha sido actualizada exitosamente.'
                    ];

                    return view("login");
                } else {
                    $_SESSION['modal'] = [
                        'title' => '¡Error! Token inválido',
                        'message' => 'El token de restablecimiento de contraseña es inválido o ha expirado.'
                    ];
                }
            } else {
                $_SESSION['modal'] = [
                    'title' => '¡Error! Contraseñas no coinciden',
                    'message' => 'Las contraseñas ingresadas no coinciden. Por favor, inténtalo de nuevo.'
                ];
            }
        } else {
            $_SESSION['modal'] = [
                'title' => '¡Error!',
                'message' => 'Por favor, completa todos los campos.'
            ];
        }

        $params = [
            'token' => $token,
            'id' => $id
        ];
        $query_string = http_build_query($params);
        return view("login/reset-password?" . $query_string);
    }

    public function logout()
    {
        if (isset($_SESSION['UserID'])) {
            session_destroy();
        }
        return view("");
    }

}