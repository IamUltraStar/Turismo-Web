<?php

require_once(ROOT_PATH . "/models/CategoryDestination.php");

class BaseCategories
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryDestination();
    }

    public function index()
    {
        if (isset($_GET['cat'])) {
            $title_action_category = "Editar categoria:";

            $editCategory = $this->categoryModel->getCategoryDestination($_GET['cat']);

            if (!isset($editCategory)) {
                return view("admin/categories");
            }
        }

        $arrayCategories = $this->categoryModel->listCategoryDestination();

        include(ROOT_PATH . '/views/admin/categories_destinations.php');
    }

    public function create()
    {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

        if ($name && $description) {
            $result = $this->categoryModel->createCategoryDestination($name, $description);

            if ($result === 1) {
                echo "Categoría creada correctamente";
            } else {
                echo "Error al crear la categoría";
            }
        } else {
            echo "Todos los campos son requeridos";
        }

        return view("admin/categories");
    }

    public function update()
    {
        $idCategory = isset($_POST['cat']) ? $_POST['cat'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

        if ($idCategory && $name && $description) {
            $result = $this->categoryModel->updateCategoryDestination($idCategory, $name, $description);

            $message = $result ? "Categoría actualizada con éxito" : "Error al actualizar la categoría";
            echo $message;
        }

        return view("admin/categories");
    }

    public function delete()
    {
        $idCategory = isset($_POST['cat']) ? $_POST['cat'] : null;

        if ($idCategory) {
            $result = $this->categoryModel->deleteCategoryDestination($idCategory);

            if ($result) {
                echo "Categoría eliminada con éxito";
            } else {
                echo "Error al eliminar la categoria";

            }
        } else {
            echo "ID de actividad requerido";
        }

        return view("admin/categories");
    }
}