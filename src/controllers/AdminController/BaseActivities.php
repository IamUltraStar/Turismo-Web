<?php

require_once(ROOT_PATH . "/models/Activity.php");

class BaseActivities
{
    private $activityModel;

    public function __construct()
    {
        $this->activityModel = new Activity();
    }

    public function index()
    {
        if (isset($_GET['act'])) {
            $title_action_activity = "Editar actividad:";

            $editActivity = $this->activityModel->getActivity($_GET['act']);

            if (!isset($editActivity)) {
                return view("admin/activities");
            }
        }

        $arrayActivities = $this->activityModel->listActivity();

        include(ROOT_PATH . '/views/admin/activities.php');
    }

    public function create()
    {
        $name = isset($_POST['act']) ? $_POST['act'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;

        if ($name && $description && $price) {
            $result = $this->activityModel->createActivity($name, $description, $price);

            if ($result) {
                echo "La actividad se creó correctamente";
            } else {
                echo "Error al crear la actividad";
            }
        } else {
            echo "Todos los campos son obligatorios";
        }

        return view("admin/activities");
    }

    public function update()
    {
        $idActiv = isset($_POST['act']) ? $_POST['act'] : null;
        $name = $_POST['activity_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if ($idActiv && $name && $description && $price) {
            $result = $this->activityModel->updateActivity($idActiv, $name, $description, $price);
            $message = $result ? "Actividad actualizada con éxito" : "Error al actualizar la actividad";
            echo $message;
        }

        return view("admin/activities");
    }

    public function delete()
    {
        $idActiv = isset($_POST['act']) ? $_POST['act'] : null;

        if ($idActiv) {
            $result = $this->activityModel->deleteActivity($idActiv);

            if ($result) {
                echo "Actividad eliminada con éxito";
            } else {
                echo "Error al eliminar la actividad";
            }
        } else {
            echo "ID de actividad requerido";
        }

        return view("admin/activities");
    }
}