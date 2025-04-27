<?php
require_once("../db/ConexionSQL.php");

class User
{
    function executeLogin($username, $password)
    {
        $valueLogin = false;
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT UserID, Username, Password FROM Users WHERE Username = ? AND Active = 1";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['Password'])) {
                    $valueLogin = $row['UserID'];
                }
            }
            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $valueLogin;
    }

    function executeRegister($name, $email, $username, $password, $token)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO Users (Username, Password, FullName, Email, ActivationToken) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('sssss', $username, $hashed_password, $name, $email, $token);
            $stmt->execute();
            $UserID = $connection->insert_id;

            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $UserID;
    }

    function getDataUserByID($UserID)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = 'SELECT Username, FullName, Email, Rol FROM Users WHERE UserID = ?';
            $stmt = $connection->prepare($query);
            $stmt->bind_param('i', $UserID);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();
            $connection->close();

            if ($row = $result->fetch_assoc()) {
                return $row;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function updateDataUser($id, $fullname, $currentPassword, $newPassword)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            if (empty($currentPassword) || empty($newPassword)) {
                $query = "UPDATE Users SET FullName = ? WHERE UserID = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('si', $fullname, $id);
                $stmt->execute();
                $stmt->close();
                $connection->close();

                return '1';
            } else {
                $query = "SELECT Password FROM Users WHERE UserID = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    if (password_verify($currentPassword, $row['Password'])) {
                        $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);
                        $query = "UPDATE Users SET FullName = ?, Password = ? WHERE UserID = ?";
                        $stmt = $connection->prepare($query);
                        $stmt->bind_param('ssi', $fullname, $hashed_password, $id);
                        $stmt->execute();
                        $stmt->close();
                        $connection->close();
                        return '1';
                    }

                    $stmt->close();
                    $connection->close();
                    return '0';
                }
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function activateUser($id, $token)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT UserID FROM Users WHERE UserID = ? AND ActivationToken = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('is', $id, $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $query = "UPDATE Users SET Active = 1, ActivationToken = NULL WHERE UserID = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();

                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $stmt->close();
            $connection->close();
        }
    }

    function getDataUserByEmail($email)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = 'SELECT UserID, Username, FullName, Email FROM Users WHERE Email = ? AND Active = TRUE';
            $stmt = $connection->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                return $row;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function storeResetToken($id, $token, $expiration)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "UPDATE Users SET ResetToken = ?, ResetTokenExpiration = ? WHERE UserID = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('ssi', $token, $expiration, $id);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function checkToken($id, $token)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT ResetTokenExpiration FROM Users WHERE UserID = ? AND ResetToken = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('is', $id, $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if (strtotime($row['ResetTokenExpiration']) > time()) {
                    return true;
                }
            }

            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return false;
    }

    function updatePassword($id, $token, $newPassword)
    {
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT ResetToken FROM Users WHERE UserID = ? AND ResetToken = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('is', $id, $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);

                $query = "UPDATE Users SET Password = ?, ResetToken = NULL, ResetTokenExpiration = NULL WHERE UserID = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('si', $hashed_password, $id);
                $stmt->execute();
                $stmt->close();
                $connection->close();
                return true;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $stmt->close();
        $connection->close();
        return false;
    }

    function checkErrorsLogin($username, $password)
    {
        if ($username == '' || $password == '') {
            return false;
        }
        return true;
    }

    function checkErrorsRegister($name, $email, $username, $password, $password1)
    {
        $domains_allowed = ['@gmail.com', "@hotmail.com", "@outlook.com", "@unac.edu.pe"];

        if ($name == "" || $username == "" || $email == "" || $password == "" || $password1 == "") {
            return '3';
        }

        if ($password != $password1) {
            return '4';
        }

        $domain = substr($email, strpos($email, '@'));
        if (!in_array($domain, $domains_allowed)) {
            return '5';
        }

        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT Email FROM Users WHERE Email = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();

            if ($result->num_rows > 0) {
                $connection->close();
                return '6';
            }

            $query = "SELECT Username FROM Users WHERE Username = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();
            $connection->close();

            if ($result->num_rows > 0) {
                return '7';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return '0';
    }
}