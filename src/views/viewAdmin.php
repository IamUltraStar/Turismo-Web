<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Turismo</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        section {
            scroll-margin-top: 56px;
        }

        .row {
            row-gap: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="view.php?view=view-admin">Admin Turismo</a>
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
            <h3><?php echo $title_action_category ?? 'Crear categoria:'; ?></h3>
            <!-- Formulario para agregar una categoria -->
            <form action="admin.php?action=<?php echo isset($editCategory) ? 'update-category' : 'create-category'; ?>"
                method="POST" class="mb-3">
                <div class="row">
                    <?php if (isset($editCategory)): ?>
                        <input type="hidden" name="category_id" value='<?php echo $editCategory['CategoryID']; ?>'>
                    <?php endif; ?>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Nombre de Categoría"
                            value="<?php echo isset($editCategory) ? $editCategory['Name'] : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Descripción"
                            value='<?php echo isset($editCategory) ? $editCategory['Description'] : ''; ?>' required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="<?php echo isset($editCategory) ? 'update_category' : 'add_category' ?>"
                            class="btn btn-primary">
                            <?php echo isset($editCategory) ? 'Actualizar' : 'Agregar'; ?>
                        </button>
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
                <tbody id="category_table"></tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Destinos -->
        <section id="destinations">
            <h2>Destinos</h2>
            <h3><?php echo $title_action_destination ?? 'Crear destinos:'; ?></h3>
            <!-- Formulario para agregar un destino -->
            <form action="admin.php?action=<?php echo isset($editDestination) ? 'update-destination' : 'create-destination'; ?>"
                method="POST" class="mb-3" enctype="multipart/form-data">
                <div class="row">
                    <?php if (isset($editDestination)): ?>
                        <input type="hidden" name="destination_id" value='<?php echo isset($editDestination) ? $editDestination['DestinationID'] : ''; ?>'>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <input type="text" name="destination_name" class="form-control" placeholder="Nombre del Destino"
                            value='<?php echo isset($editDestination) ? $editDestination['DestinationName'] : ''; ?>'
                            required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="description" class="form-control" placeholder="Descripcion del Destino"
                            value='<?php echo isset($editDestination) ? $editDestination['Description'] : ''; ?>'
                            required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control" placeholder="Ubicación"
                            value="<?php echo isset($editDestination) ? $editDestination['Location'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio"
                            value="<?php echo isset($editDestination) ? $editDestination['Price'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="image" class="form-control" accept="">
                        <?php
                        if (isset($editDestination) && $editDestination['Image']) {
                            echo "<img src='{$editDestination['Image']}' alt='{$editDestination['DestinationName']}' width='100'>";
                            echo "<input type='hidden' name='image-path' class='form-control' value='{$editDestination['Image']}'>";
                        }
                        ?>
                    </div>
                    <div class="col-md-2" >
                        <select name="category_id" class="form-select" id="category_select" required>
                        <option value="" disabled <?= !isset($editDestination['CategoryName']) ? 'selected' : ''; ?>>Seleccione Categoría</option>
                        <?php
                            foreach ($arrayCategoryDestination as $Category) {
                                $selected = (isset($editDestination) && $editDestination['CategoryID'] == $Category['CategoryID']) ? 'selected' : '';
                                echo "<option value='{$Category['CategoryID']}' {$selected}> {$Category['Name']} </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="<?php echo isset($editDestination) ? 'update_destination' : 'add_destination'; ?>"
                            class="btn btn-primary">
                            <?php echo isset($editDestination) ? 'Actualizar' : 'Agregar'; ?>
                        </button>
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
                        <th>Image</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="destination_table"></tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Viajes Programados -->
        <section id="trips">
            <h2>Viajes Programados</h2>
            <h3><?php echo $title_action_programmedTrip ?? 'Crear viajes programados:'; ?></h3>
            <!-- Formulario para agregar un viaje programado -->
            <form action="admin.php?action=<?php echo isset($editprogrammedTrip) ? 'update-programmed-trip' : 'create-programmed-trip'; ?>" method="POST" class="mb-3">
                <div class="row">
                    <?php if (isset($editprogrammedTrip)): ?>
                        <input type="hidden" name="programmedTrip_id" value='<?php echo $editprogrammedTrip['ProgrammedTripID']; ?>'>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <input type="text" name="trip_name" class="form-control" placeholder="Nombre del Viaje"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['ProgrammedTripName'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="description" class="form-control" placeholder="Descripción"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['Description'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="start_date" class="form-control" placeholder="Fecha de Inicio"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['StartDate'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="end_date" class="form-control" placeholder="Fecha de Fin"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['EndDate'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="max_capacity" class="form-control" placeholder="Capacidad Máxima"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['MaxCapacity'] : ''; ?>"
                            required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio"
                            value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['Price'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-3" >
                        <select name="destination_id" id="destination_select__programmedtrip" class="form-select" required>
                            <option value="" disabled <?= !isset($editprogrammedTrip['DestinationName']) ? 'selected' : ''; ?>>Seleccione destino</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="<?php echo isset($editprogrammedTrip) ? 'update_programmedTrip' : 'add_programmedTrip'; ?>"
                            class="btn btn-primary">
                            <?php echo isset($editprogrammedTrip) ? 'Actualizar' : 'Agregar'; ?>
                        </button>
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
                <tbody id="programmedTrip_table"></tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Métodos de Pago -->
        <section id="payments">
            <h2>Métodos de Pago</h2>
            <h3><?php echo $title_action_paymentMethod ?? 'Crear methodos de pago:'; ?></h3>
            <!-- Formulario para agregar un método de pago -->
            <form action="admin.php?action=<?php echo isset($editpaymentMethod) ? 'update-payment-method' : 'create-payment-method'; ?>" method="POST" class="mb-3">
                <?php if (isset($editpaymentMethod)): ?>
                    <input type="hidden" name="paymentMethod_id" value='<?php echo $editpaymentMethod['PaymentMethodID']; ?>'>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="payment_method_name" class="form-control" placeholder="Nombre del Método"
                            value="<?php echo isset($editpaymentMethod) ? $editpaymentMethod['Name'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Descripción"
                            value="<?php echo isset($editpaymentMethod) ? $editpaymentMethod['Description'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="<?php echo isset($editpaymentMethod) ? 'update_paymentMethod' : 'add_paymentMethod'; ?>"
                            class="btn btn-primary">
                            <?php echo isset($editpaymentMethod) ? 'Actualizar' : 'Agregar'; ?>
                        </button>
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
                <tbody id="paymentMethod_table"></tbody>
            </table>
        </section>

        <hr>

        <!-- Gestión de Actividades -->

        <section id="activities">
            <h2>Actividades</h2>
            <h3><?php echo $title_action_activity ?? 'Crear actividad:'; ?></h3>
            <!-- Formulario para agregar o editar una actividad -->
            <form action="admin.php?action=<?php echo isset($editActivity) ? 'update-activity' : 'create-activity'; ?>" method="POST" class="mb-3">
                <?php if (isset($editActivity)): ?>
                    <input type="hidden" name="activity_id" value="<?php echo $editActivity['ActivityID']; ?>">
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="activity_name" class="form-control"
                            placeholder="Nombre de la Actividad"
                            value="<?php echo isset($editActivity) ? $editActivity['Name'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="description" class="form-control"
                            placeholder="Descripción"
                            value="<?php echo isset($editActivity) ? $editActivity['Description'] : ''; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="price" class="form-control"
                            placeholder="Precio"
                            value="<?php echo isset($editActivity) ? $editActivity['Price'] : ''; ?>"
                            required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="<?php echo isset($editActivity) ? 'update_activity' : 'add_activity'; ?>"
                            class="btn btn-primary">
                            <?php echo isset($editActivity) ? 'Actualizar' : 'Agregar'; ?>
                        </button>
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
                <tbody id="activity_table"></tbody>
            </table>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/scriptAdmin.js"></script>
    <script>
        if (<?php echo isset($editCategory) ? 'true' : 'false'; ?>) {
            let url = new URL(window.location);
            url.hash = "categories";

            window.history.pushState({}, document.title, url);
        }

        if (<?php echo isset($editDestination) ? 'true' : 'false'; ?>) {
            let url = new URL(window.location);
            url.hash = "destinations";

            window.history.pushState({}, document.title, url);
        }

        if (<?php echo isset($editpaymentMethod) ? 'true' : 'false'; ?>) {
            let url = new URL(window.location);
            url.hash = "payments";

            window.history.pushState({}, document.title, url);
        }

        if (<?php echo isset($editprogrammedTrip) ? 'true' : 'false'; ?>) {
            let url = new URL(window.location);
            url.hash = "trips";

            window.history.pushState({}, document.title, url);
        }
        
        if (<?php echo isset($editActivity) ? 'true' : 'false'; ?>) {
            let url = new URL(window.location);
            url.hash = "activities";

            window.history.pushState({}, document.title, url);
        }
    </script>
</body>
</html>