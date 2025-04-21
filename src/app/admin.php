<?php
include("../models/Activity.php");
include("../models/CategoryDestination.php");
include("../models/Destination.php");
include("../models/PaymentMethod.php");
include("../models/ProgrammedTrip.php");

$action = isset($_GET['action']) ? $_GET['action'] : null;
switch ($action) {
    case 'list-category':
        $categoryModel = new CategoryDestination();
        $arrayCategoryDestination = $categoryModel->listCategoryDestination();
        if (is_array($arrayCategoryDestination) && count($arrayCategoryDestination) > 0) {
            echo json_encode($arrayCategoryDestination);
        } else {
            echo "No se encuentran las actividades";
        }
        break;

    case 'get-category':
        if (isset($_POST['get_category'])) {
            $idCategory = $_POST['category_id'];
            $title_action_category = "Editar categoria:";

            $categoryModel = new CategoryDestination();
            $editCategory = $categoryModel->getCategoryDestination($idCategory);

            if ($editCategory) {
                include '../views/viewAdmin.php';
            } else {
                echo "No se encuentra la categoría.";
            }
        }
        break;

    case 'create-category':
        if (isset($_POST['add_category'])) {
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            if ($name && $description) {
                $categoryModel = new CategoryDestination();

                $result = $categoryModel->createCategoryDestination($name, $description);

                if ($result === 1) {
                    echo "Categoría creada correctamente";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al crear la categoría";
                }
            } else {
                echo "Todos los campos son requeridos";
            }
        }
        include '../views/viewAdmin.php';
        break;

    case 'update-category':
        if (isset($_POST['update_category'])) {
            $idCategory = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            $categoryModel = new CategoryDestination();

            if ($idCategory) {
                $result = $categoryModel->updateCategoryDestination($idCategory, $name, $description);
                $message = $result ? "Categoría actualizada con éxito" : "Error al actualizar la categoría";

            }

            header("Location: ../controllers/view.php?view=view-admin");
        }
        break;

    case 'delete-category':
        if (isset($_POST['delete_category'])) {
            $idCategory = isset($_POST['category_id']) ? $_POST['category_id'] : null;

            if ($idCategory) {
                $categoryModel = new CategoryDestination();
                $result = $categoryModel->deleteCategoryDestination($idCategory);

                if ($result) {
                    echo "Categoría eliminada con éxito";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al eliminar la categoria";

                }
            } else {
                echo "ID de actividad requerido";
            }
        }
        break;

    case 'list-destination':
        $descriptionModel = new Destination();
        $arrayDestinations = $descriptionModel->listDestination();
        if (is_array($arrayDestinations) && count($arrayDestinations) > 0) {
            echo json_encode($arrayDestinations);
        } else {
            echo "No se encuentran destinos";
        }
        break;

    case 'get-destination':
        if (isset($_POST['get_destination'])) {
            $idDest = $_POST['destination_id'];
            $title_action_destination = "Editar destino:";

            $destinationModel = new Destination();
            $editDestination = $destinationModel->getDestination($idDest);

            if ($editDestination) {
                include '../views/viewAdmin.php';
            } else {
                echo "No se encuentra el destino.";
            }
        }
        break;

    case 'create-destination':
        if (isset($_POST['add_destination'])) {
            $name = isset($_POST['destination_name']) ? $_POST['destination_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $location = isset($_POST['location']) ? $_POST['location'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $image = isset($_FILES['image']) ? $_FILES['image']['name'] : null;
            $categoryID = isset($_POST['category_id']) ? $_POST['category_id'] : null;

            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "Error al subir el archivo. Código de error: " . $_FILES['image']['error'];
                exit;
            }

            if (!$image) {
                $imagepath = '';
            } else {
                $imagepath = '../../assets/img/';
                $imagepath .= basename($image);
            }

            if ($name && $description && $location && $price && $image && $categoryID) {
                $destinationModel = new Destination();
                $result = $destinationModel->createDestination($name, $description, $location, $price, $imagepath, $categoryID);
                if ($result) {
                    echo "El destino se creó correctamente";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al crear el destino";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
        include '../views/viewAdmin.php';
        break;

    case 'update-destination':
        if (isset($_POST['update_destination'])) {
            $idDest = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;
            $name = isset($_POST['destination_name']) ? $_POST['destination_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $location = isset($_POST['location']) ? $_POST['location'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $image = isset($_FILES['image']) ? $_FILES['image']['name'] : null;
            $categoryID = isset($_POST['category_id']) ? $_POST['category_id'] : null;

            if (!$image) {
                $imagepath = $_POST['image-path'];
            } else {
                $imagepath = '../../assets/img/';
                $imagepath .= basename($image);
            }

            $destinationModel = new Destination();

            if ($idDest) {
                $result = $destinationModel->updateDestination($idDest, $name, $description, $location, $price, $imagepath, $categoryID);
                $message = $result ? "Destino actualizado con éxito" : "Error al actualizar el destino";
            }
            header("Location: ../controllers/view.php?view=view-admin");
        }
        break;

    case 'delete-destination':
        if (isset($_POST['delete_destination'])) {
            $idDest = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;

            if ($idDest) {
                $destinationModel = new Destination();
                $result = $destinationModel->deleteDestination($idDest);

                if ($result) {
                    echo "Destino eliminada con éxito";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al eliminar la destino";
                }
            } else {
                echo "ID de destino requerido";
            }
        }
        break;

    case 'list-programmed-trip':
        $programmedTripModel = new ProgrammedTrip();
        $arrayProgrammedTrips = $programmedTripModel->listProgrammedTrip();

        if (is_array($arrayProgrammedTrips) && count($arrayProgrammedTrips) > 0) {
            echo json_encode($arrayProgrammedTrips);
        } else {
            echo "No se encuentra la programación de viajes";
        }
        break;

    case 'get-programmed-trip':
        if (isset($_POST['get_programmedTrip'])) {
            $programmedTripID = $_POST['programmedTrip_id'];
            $title_action_programmedTrip = "Editar viaje programado:";

            $programmedTripModel = new ProgrammedTrip();
            $editprogrammedTrip = $programmedTripModel->getProgrammedTrip($programmedTripID);

            if ($editprogrammedTrip) {
                include '../views/viewAdmin.php';
            } else {
                echo "No se encuentra programacion de viajes.";
            }
        }
        break;

    case 'create-programmed-trip':
        if (isset($_POST['add_programmedTrip'])) {
            $name = isset($_POST['trip_name']) ? $_POST['trip_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
            $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
            $maxCapacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $destinationID = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;

            if ($name && $description && $startDate && $endDate && $maxCapacity && $price && $destinationID) {
                $programmedTripModel = new ProgrammedTrip();
                $result = $programmedTripModel->createProgrammedTrip($name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID);

                if ($result) {
                    echo "La actividad se creó correctamente";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al crear la programacion de viajes";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
        include '../views/viewAdmin.php';
        break;

    case 'update-programmed-trip':
        if (isset($_POST['update_programmedTrip'])) {
            $programmedTripID = isset($_POST['programmedTrip_id']) ? $_POST['programmedTrip_id'] : null;
            $name = isset($_POST['trip_name']) ? $_POST['trip_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
            $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
            $maxCapacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $destinationID = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;

            $programmedTripModel = new ProgrammedTrip();

            if ($programmedTripID) {
                $result = $programmedTripModel->updateProgrammedTrip($programmedTripID, $name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID);
                $message = $result ? "programacion de viaje actualizado con éxito" : "Error al actualizar programacion de viaje";
            }

            header("Location: ./admin");
        }
        break;

    case 'delete-programmed-trip':
        if (isset($_POST['delete_programmedTrip'])) {
            $programmedTripID = isset($_POST['programmedTrip_id']) ? $_POST['programmedTrip_id'] : null;

            if ($programmedTripID) {
                $programmedTripModel = new ProgrammedTrip();
                $result = $programmedTripModel->deleteProgrammedTrip($programmedTripID);

                if ($result) {
                    echo "programacion de viajes eliminada con éxito";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al eliminar la programacion de viajes";
                }
            } else {
                echo "ID de la progracion de actividades es requerido";
            }
        }
        break;

    case 'list-payment-method':
        $paymentMethodModel = new PaymentMethod();
        $arraypaymentMethods = $paymentMethodModel->listPaymentMethod();

        if (is_array($arraypaymentMethods) && count($arraypaymentMethods) > 0) {
            echo json_encode($arraypaymentMethods);
        } else {
            echo "No se encuentra método de pagos";
        }
        break;

    case 'get-payment-method':
        if (isset($_POST['get_paymentMethod'])) {
            $idPymt = $_POST['paymentMethod_id'];
            $title_action_paymentMethod = "Editar método de pago:";

            $paymentMethodModel = new PaymentMethod();
            $editpaymentMethod = $paymentMethodModel->getPaymentMethod($idPymt);

            if ($editpaymentMethod) {
                include '../views/viewAdmin.php';
            } else {
                echo "No se encuentra los metodos de pago.";
            }
        }
        break;

    case 'create-payment-method':
        if (isset($_POST['add_paymentMethod'])) {
            $name = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            if ($name && $description) {
                $paymentMethodModel = new PaymentMethod();
                $result = $paymentMethodModel->createPaymentMethod($name, $description);
                if ($result) {
                    echo "Método de pago creado correctamente";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al crear el método de pag";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
        include '../views/viewAdmin.php';
        break;

    case 'update-payment-method':
        if (isset($_POST['update_paymentMethod'])) {
            $idPaymentMethod = isset($_POST['paymentMethod_id']) ? $_POST['paymentMethod_id'] : null;
            $name = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;

            $paymentMethodModel = new PaymentMethod();

            if ($idPaymentMethod) {
                $result = $paymentMethodModel->updatePaymentMethod($idPaymentMethod, $name, $description);
                $message = $result ? "metodo de pago actualizada con éxito" : "Error al actualizar el metodo de pago";
            }
            header("Location: ../controllers/view.php?view=view-admin");
        }
        break;

    case 'delete-payment-method':
        if (isset($_POST['delete_paymentMethod'])) {
            $idPaymentMethod = isset($_POST['paymentMethod_id']) ? $_POST['paymentMethod_id'] : null;

            if ($idPaymentMethod) {
                $paymentMethodModel = new PaymentMethod();
                $result = $paymentMethodModel->deletePaymentMethod($idPaymentMethod);

                if ($result) {
                    echo "metodo de pago eliminada con éxito";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al eliminar el metodo de pago";
                }
            } else {
                echo "ID de metodo de pago requerido";
            }
        }
        break;

    case 'list-activity':
        $activityModel = new Activity();
        $arrayActivities = $activityModel->listActivity();

        if (is_array($arrayActivities) && count($arrayActivities) > 0) {
            echo json_encode($arrayActivities);
        } else {
            echo "No se encuentran las actividades";
        }
        break;

    case 'get-activity':
        if (isset($_POST['get_activity'])) {
            $idActiv = $_POST['activity_id'];
            $title_action_activity = "Editar actividad:";

            $activityModel = new Activity();
            $editActivity = $activityModel->getActivity($idActiv);

            if ($editActivity) {
                include '../views/viewAdmin.php';
            } else {
                echo "No se encuentra la actividad.";
            }
        }
        break;

    case 'create-activity':
        if (isset($_POST['add_activity'])) {
            $name = isset($_POST['activity_name']) ? $_POST['activity_name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;

            if ($name && $description && $price) {
                $activityModel = new Activity();
                $result = $activityModel->createActivity($name, $description, $price);

                if ($result) {
                    echo "La actividad se creó correctamente";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al crear la actividad";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
        include '../views/viewAdmin.php';
        break;

    case 'update-activity':
        if (isset($_POST['update_activity'])) {

            $idActiv = isset($_POST['activity_id']) ? $_POST['activity_id'] : null;
            $name = $_POST['activity_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $title_action_activity = "Editar actividad:";

            $activityModel = new Activity();

            if ($idActiv) {
                // Actualizar la actividad
                $result = $activityModel->updateActivity($idActiv, $name, $description, $price);
                $message = $result ? "Actividad actualizada con éxito" : "Error al actualizar la actividad";
            }

            header("Location: ../controllers/view.php?view=view-admin");
        }
        break;

    case 'delete-activity':
        if (isset($_POST['delete_activity'])) {
            $idActiv = isset($_POST['activity_id']) ? $_POST['activity_id'] : null;

            if ($idActiv) {
                $activityModel = new Activity();
                $result = $activityModel->deleteActivity($idActiv);

                if ($result) {
                    echo "Actividad eliminada con éxito";
                    header("Location: ../controllers/view.php?view=view-admin");
                    exit;
                } else {
                    echo "Error al eliminar la actividad";
                }
            } else {
                echo "ID de actividad requerido";
            }
        }
        break;

    default:
        echo "opcion invalida";
        break;
}
