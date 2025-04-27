<?php ob_start(); ?>

<section id="trips">
    <h2>Viajes Programados</h2>
    <h3><?php echo $title_action_programmedTrip ?? 'Crear viaje programado:'; ?></h3>
    <!-- Formulario para agregar un viaje programado -->
    <form action="<?= base_url("admin/programmed-trips/" . (isset($editprogrammedTrip) ? 'update' : 'create')); ?>"
        method="POST" class="mb-3">
        <div class="row">
            <?php if (isset($editprogrammedTrip)): ?>
                <input type="hidden" name="trip" value='<?php echo $editprogrammedTrip['ProgrammedTripID']; ?>'>
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
                    value="<?php echo isset($editprogrammedTrip) ? implode('-', array_reverse(explode('-', $editprogrammedTrip['StartDate']))) : ''; ?>"
                    required>
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" placeholder="Fecha de Fin"
                    value="<?php echo isset($editprogrammedTrip) ? implode('-', array_reverse(explode('-', $editprogrammedTrip['EndDate']))) : ''; ?>"
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
                    value="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['Price'] : ''; ?>" required>
            </div>
            <div class="col-md-3">
                <select name="destination_id" id="destination_select" class="form-select"
                    data-selected-destination="<?php echo isset($editprogrammedTrip) ? $editprogrammedTrip['DestinationID'] : ''; ?>"
                    required>
                    <option value="" disabled <?= !isset($editprogrammedTrip['Name']) ? 'selected' : ''; ?>>
                        Seleccione destino</option>
                    <?php foreach ($arrayDestinations as $destination): ?>
                        <option value="<?php echo $destination['DestinationID']; ?>" <?php echo isset($editprogrammedTrip) && $editprogrammedTrip['DestinationID'] == $destination['DestinationID'] ? 'selected' : ''; ?>>
                            <?php echo $destination['Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit"
                    name="<?php echo isset($editprogrammedTrip) ? 'update_programmedTrip' : 'add_programmedTrip'; ?>"
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
        <tbody id="programmedTrip_table">
            <?php if (isset($arrayProgrammedTrip) && count($arrayProgrammedTrip) > 0): ?>
                <?php foreach ($arrayProgrammedTrip as $trip): ?>
                    <tr>
                        <td><?php echo $trip['ProgrammedTripID']; ?></td>
                        <td><?php echo $trip['Name']; ?></td>
                        <td><?php echo $trip['Description']; ?></td>
                        <td><?php echo $trip['StartDate']; ?></td>
                        <td><?php echo $trip['EndDate']; ?></td>
                        <td><?php echo $trip['MaxCapacity']; ?></td>
                        <td><?php echo $trip['Price']; ?></td>
                        <td><?php echo $trip['DestinationID']; ?></td>
                        <td>
                            <a href="<?= base_url("admin/programmed-trips?trip={$trip['ProgrammedTripID']}") ?>"
                                class="btn btn-warning mb-2">Editar</a>
                            <form action="<?= base_url("admin/programmed-trips/delete") ?>" method="POST">
                                <input type="hidden" name="trip" value="<?= $trip['ProgrammedTripID']; ?>">
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">No hay viajes programados disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();

$activeLinkProgrammedTrip = 'active';

include ROOT_PATH . '/views/viewAdmin.php';
?>