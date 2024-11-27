<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Turismo</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Turismo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#categories">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#trips">Viajes Programados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#payments">Métodos de Pago</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#activities">Actividades</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Panel de Administración</h1>

        <!-- Gestión de Categorías -->
        <section id="categories">
            <h2>Categorías</h2>
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Nombre de Categoría" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="add_category" class="btn btn-primary w-100">Agregar</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arrayCategoryDestination as $Category): ?>
                        <tr>
                            <td><?php echo $Category['CategoryID']?></td>
                            <td><?php echo $Category['Name']?></td>
                            <td><?php echo $Category['Description']?></td>
                            <td>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='category_id' value="<?php echo $Category['CategoryID'] ?>">
                                    <button type='submit' name='delete_category' class='btn btn-danger btn-sm'>Eliminar</button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Destinos -->
        <section id="destinations">
            <h2>Destinos</h2>
            <!-- Formulario para agregar un destino -->
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="destination_name" class="form-control" placeholder="Nombre del Destino" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control" placeholder="Ubicación" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio" required>
                    </div>
                    <div class="col-md-2">
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione Categoría</option>
                            <?php
                            /* $categories = $this->getCategoryDestination();
                            foreach ($arrayCategoryDestination as $Category): {
                                echo "<option '{$Category['CategoryID']}'> $Category['Name'] </option>";
                            } */
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="add_destination" class="btn btn-primary w-100">Agregar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de destinos -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrayDestinations as $destination): ?>
                        <tr>
                            <td><?php echo $destination['DestinationID']; ?></td>
                            <td><?php echo $destination['Name']; ?></td>
                            <td><?php echo $destination['Location']; ?></td>
                            <td>S/. <?php echo $destination['Price']; ?></td>
                            <td><?php echo $destination['CategoryName']; ?></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="destination_id" value="<?php echo $destination['DestinationID']; ?>">
                                    <button type="submit" name="delete_destination" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Viajes Programados -->
        <section id="trips">
            <h2>Viajes Programados</h2>
            <!-- Formulario para agregar un viaje programado -->
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="trip_name" class="form-control" placeholder="Nombre del Viaje" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="description" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="start_date" class="form-control" placeholder="Fecha de Inicio" required>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="end_date" class="form-control" placeholder="Fecha de Fin" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="max_capacity" class="form-control" placeholder="Capacidad Máxima" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio" required>
                    </div>
                    <div class="col-md-3">
                        <select name="destination_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione Destino</option>
                            <?php
                            /* $destinations = $conn->query("SELECT * FROM Destinations");
                            while ($destination = $destinations->fetch_assoc()) {
                                echo "<option value='{$destination['DestinationID']}'>{$destination['Name']}</option>";
                            } */
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="add_trip" class="btn btn-primary w-100">Agregar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de viajes programados -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Destino</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener los viajes programados junto con los destinos
                    /* $trips = $conn->query("
                        SELECT t.ProgrammedTripID, t.Name, t.Description, t.StartDate, t.EndDate, 
                               t.MaxCapacity, t.Price, d.Name AS DestinationName
                        FROM ProgrammedTrips t
                        JOIN Destinations d ON t.DestinationID = d.DestinationID
                    ");*/?>
                    <?php foreach($arrayProgrammedTrips as $Programeed): ?>
                        <tr>
                            <td><?php echo $Programeed['ProgrammedTripID']; ?></td>
                            <td><?php echo $Programeed['Name']; ?></td>
                            <td><?php echo $Programeed['Description']; ?></td>
                            <td><?php echo $Programeed['StartDate']; ?></td>
                            <td><?php echo $Programeed['EndDate']; ?></td>
                            <td><?php echo $Programeed['MaxCapacity']; ?></td>
                            <td>S/. <? echo $Programmed['Price']; ?></td>
                            <td><?php echo $Programeed['DestinationName']; ?></td>
                            <td>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='trip_id' value="<?php echo $Programeed['ProgrammedTripID']; ?>">
                                    <button type='submit' name='delete_trip' class='btn btn-danger btn-sm'>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    
                </tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Métodos de Pago -->
        <section id="payments">
            <h2>Métodos de Pago</h2>
            <!-- Formulario para agregar un método de pago -->
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="payment_method_name" class="form-control" placeholder="Nombre del Método" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="add_payment_method" class="btn btn-primary w-100">Agregar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de métodos de pago -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arraPaymentMethods as $paymentmethod): ?>
                        <tr>
                            <td><?php echo $paymentmethod['PaymentMethodID']; ?></td>
                            <td><?php echo $paymentmethod['Name']; ?></td>
                            <td><?php echo $paymentmethod['Description']; ?></td>
                            <td>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='payment_method_id' value="<?php echo $paymentmethod['PaymentMethodID']; ?>">
                                    <button type='submit' name='delete_payment_method' class='btn btn-danger btn-sm'>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    
                    
                </tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Actividades -->
        <section id="activities">
            <h2>Actividades</h2>
            <!-- Formulario para agregar una actividad -->
            <form method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="activity_name" class="form-control" placeholder="Nombre de la Actividad" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="description" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="add_activity" class="btn btn-primary w-100">Agregar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de actividades -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrayActivities as $Activities): ?>
                        <tr>
                            <td><?php echo $activities['ActivityID']; ?></td>
                            <td><?php echo $activities['Name']; ?></td>
                            <td><?php echo $activities['Description']; ?></td>
                            <td>S/. <?php echo $activity['Price']; ?></td>
                            <td>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='activity_id' value="<?php echo $activities['ActivityID']; ?>">
                                    <button type='submit' name='delete_activity' class='btn btn-danger btn-sm'>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    // Remover la clase 'active' de todos los enlaces
                    navLinks.forEach(nav => nav.classList.remove("active"));
                    // Agregar la clase 'active' al enlace clicado
                    this.classList.add("active");
                });
            });
        });
    </script>
</body>
</html>