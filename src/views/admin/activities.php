<?php ob_start(); ?>

<section id="activities">
    <h2>Actividades</h2>
    <h3><?php echo $title_action_activity ?? 'Crear actividad:'; ?></h3>
    <!-- Formulario para agregar o editar una actividad -->
    <form action="<?= base_url("admin/activities/" . (isset($editActivity) ? 'update' : 'create')); ?>" method="POST"
        class="mb-3">
        <?php if (isset($editActivity)): ?>
            <input type="hidden" name="act" value="<?php echo $editActivity['ActivityID']; ?>">
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="activity_name" class="form-control" placeholder="Nombre de la Actividad"
                    value="<?php echo isset($editActivity) ? $editActivity['Name'] : ''; ?>" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="description" class="form-control" placeholder="Descripción"
                    value="<?php echo isset($editActivity) ? $editActivity['Description'] : ''; ?>">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio"
                    value="<?php echo isset($editActivity) ? $editActivity['Price'] : ''; ?>" required>
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
        <tbody id="activity_table">
            <?php if (isset($arrayActivities) && !empty($arrayActivities)): ?>
                <?php foreach ($arrayActivities as $activity): ?>
                    <tr>
                        <td><?= $activity["ActivityID"] ?></td>
                        <td><?= $activity["Name"] ?></td>
                        <td><?= $activity["Description"] ?></td>
                        <td><?= $activity["Price"] ?></td>
                        <td>
                            <form action=<?= base_url('admin/activities') ?> class="d-inline">
                                <input type="hidden" name="act" value="<?= $activity["ActivityID"] ?>">
                                <button type="submit" class="btn btn-info btn-sm mb-2">Editar</button>
                            </form>
                            <form action=<?= base_url('admin/activities/delete') ?> method="POST" class="d-inline">
                                <input type="hidden" name="act" value="<?= $activity["ActivityID"] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay actividades disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();

$activeLinkActivity = 'active';

include ROOT_PATH . '/views/viewAdmin.php';
?>