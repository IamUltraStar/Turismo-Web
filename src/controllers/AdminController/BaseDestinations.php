<?php

require_once(ROOT_PATH . '/models/Destination.php');
require_once(ROOT_PATH . '/models/CategoryDestination.php');

class BaseDestinations
{
    private $destinationModel;
    private $categoryModel;

    public function __construct()
    {
        $this->destinationModel = new Destination();
        $this->categoryModel = new CategoryDestination();
    }

    public function index()
    {
        if (isset($_GET['dest'])) {
            $title_action_destination = "Editar destino:";

            $editDestination = $this->destinationModel->getDestination($_GET['dest']);

            if (!isset($editDestination)) {
                return view("admin/destinations");
            }
        }

        $arrayDestinations = $this->destinationModel->listDestination();
        $arrayCategories = $this->categoryModel->listCategoryDestination();

        include(ROOT_PATH . '/views/admin/destinations.php');
    }

    public function create()
    {
        $name = isset($_POST['destination_name']) ? $_POST['destination_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $location = isset($_POST['location']) ? $_POST['location'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $image = isset($_FILES['image']) ? $_FILES['image']['name'] : null;
        $categoryID = isset($_POST['category_id']) ? $_POST['category_id'] : null;

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo. Código de error: " . $_FILES['image']['error'];
            return view("admin/destinations");
        }

        if (!$image) {
            $imagepath = '';
        } else {
            $imagepath = '../../assets/img/';
            $imagepath .= basename($image);
        }

        if ($name && $description && $location && $price && $categoryID) {
            $result = $this->destinationModel->createDestination($name, $description, $location, $price, $imagepath, $categoryID);
            if ($result) {
                echo "El destino se creó correctamente";
            } else {
                echo "Error al crear el destino";
            }
        } else {
            echo "Todos los campos son obligatorios";
        }

        return view("admin/destinations");
    }

    public function update()
    {
        $idDest = isset($_POST['dest']) ? $_POST['dest'] : null;
        $name = isset($_POST['destination_name']) ? $_POST['destination_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $location = isset($_POST['location']) ? $_POST['location'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $image = isset($_FILES['image']) ? $_FILES['image']['name'] : null;
        $categoryID = isset($_POST['category_id']) ? $_POST['category_id'] : null;

        if (!$image) {
            $imagepath = '';
        } else {
            $imagepath = '../../assets/img/';
            $imagepath .= basename($image);
        }

        if ($idDest && $name && $description && $location && $price && $categoryID) {
            $result = $this->destinationModel->updateDestination($idDest, $name, $description, $location, $price, $imagepath, $categoryID);
            $message = $result ? "Destino actualizado con éxito" : "Error al actualizar el destino";
            echo $message;
        }

        return view("admin/destinations");
    }

    public function delete()
    {
        $idDest = isset($_POST['dest']) ? $_POST['dest'] : null;

        if ($idDest) {
            $result = $this->destinationModel->deleteDestination($idDest);

            if ($result) {
                echo "Destino eliminada con éxito";
            } else {
                echo "Error al eliminar la destino";
            }
        } else {
            echo "ID de destino requerido";
        }

        return view("admin/destinations");
    }

}