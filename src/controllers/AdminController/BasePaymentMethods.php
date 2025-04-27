<?php

require_once(ROOT_PATH . '/models/PaymentMethod.php');

class BasePaymentMethods
{
    private $paymentMethodModel;

    public function __construct()
    {
        $this->paymentMethodModel = new PaymentMethod();
    }

    public function index()
    {
        if (isset($_GET['payment_method'])) {
            $title_action_paymentMethod = "Editar método de pago:";

            $editpaymentMethod = $this->paymentMethodModel->getPaymentMethod($_GET['payment_method']);

            if (!isset($editpaymentMethod)) {
                return view("admin/payment-methods");
            }
        }

        $arrayPaymentMethods = $this->paymentMethodModel->listPaymentMethod();

        include(ROOT_PATH . '/views/admin/payment_methods.php');
    }

    public function create()
    {
        $name = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

        if ($name && $description) {
            $result = $this->paymentMethodModel->createPaymentMethod($name, $description);
            if ($result) {
                echo "Método de pago creado correctamente";
            } else {
                echo "Error al crear el método de pag";
            }
        } else {
            echo "Todos los campos son obligatorios";
        }

        return view("admin/payment-methods");
    }

    public function update()
    {
        $idPaymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
        $name = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

        if ($idPaymentMethod && $name && $description) {
            $result = $this->paymentMethodModel->updatePaymentMethod($idPaymentMethod, $name, $description);
            $message = $result ? "metodo de pago actualizada con éxito" : "Error al actualizar el metodo de pago";
            echo $message;
        }

        return view("admin/payment-methods");
    }

    public function delete()
    {
        $idPaymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;

        if ($idPaymentMethod) {
            $result = $this->paymentMethodModel->deletePaymentMethod($idPaymentMethod);

            if ($result) {
                echo "metodo de pago eliminada con éxito";
            } else {
                echo "Error al eliminar el metodo de pago";
            }
        } else {
            echo "ID de metodo de pago requerido";
        }

        return view("admin/payment-methods");
    }
}