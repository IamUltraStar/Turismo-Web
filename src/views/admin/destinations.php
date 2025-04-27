<?php ob_start(); ?>

<section id="destinations">
    <h2>Destinos</h2>
    <h3><?php echo $title_action_destination ?? 'Crear destino:'; ?></h3>
    <!-- Formulario para agregar un destino -->
    <form action="<?= base_url("admin/destinations/" . (isset($editDestination) ? 'update' : 'create')); ?>"
        method="POST" class="mb-3" enctype="multipart/form-data">
        <div class="row">
            <?php if (isset($editDestination)): ?>
                <input type="hidden" name="dest"
                    value='<?php echo isset($editDestination) ? $editDestination['DestinationID'] : ''; ?>'>
            <?php endif; ?>
            <div class="col-md-3">
                <input type="text" name="destination_name" class="form-control" placeholder="Nombre del Destino"
                    value='<?php echo isset($editDestination) ? $editDestination['DestinationName'] : ''; ?>' required>
            </div>
            <div class="col-md-3">
                <input type="text" name="description" class="form-control" placeholder="Descripcion del Destino"
                    value='<?php echo isset($editDestination) ? $editDestination['Description'] : ''; ?>' required>
            </div>
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Ubicación"
                    value="<?php echo isset($editDestination) ? $editDestination['Location'] : ''; ?>" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio"
                    value="<?php echo isset($editDestination) ? $editDestination['Price'] : ''; ?>" required>
            </div>
            <div class="col-md-5">
                <input type="file" name="image" class="form-control" accept="">
                <?php if (isset($editDestination) && $editDestination['Image']): ?>
                    <img src='<?= base_url($editDestination['Image']) ?>' alt='<?= $editDestination['DestinationName'] ?>'
                        width='200' class='border mt-2 rounded'>
                    <input type='hidden' name='image-path' class='form-control' value='<?= $editDestination['Image'] ?>'>
                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-select" id="category_select"
                    data-selected-category="<?php echo isset($editDestination) ? $editDestination['CategoryID'] : ''; ?>"
                    required>
                    <option value="" disabled <?= !isset($editDestination['CategoryName']) ? 'selected' : ''; ?>>
                        Seleccione Categoría</option>
                    <?php foreach ($arrayCategories as $category): ?>
                        <option value="<?php echo $category['CategoryID']; ?>" <?php echo isset($editDestination) && $editDestination['CategoryID'] == $category['CategoryID'] ? 'selected' : ''; ?>>
                            <?php echo $category['Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit"
                    name="<?php echo isset($editDestination) ? 'update_destination' : 'add_destination'; ?>"
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
                <th class="text-center">ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Precio</th>
                <th class="text-center">Image</th>
                <th>Categoría</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody id="destination_table">
            <?php foreach ($arrayDestinations as $destination): ?>
                <tr>
                    <td class="text-center"><?php echo $destination['DestinationID']; ?></td>
                    <td><?php echo $destination['Name']; ?></td>
                    <td><?php echo $destination['Location']; ?></td>
                    <td><?php echo $destination['Price']; ?></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="<?= base_url($destination['Image']); ?>" alt="<?php echo $destination['Name']; ?>"
                                width="100">
                        </div>
                    </td>
                    <td><?php echo $destination['CategoryID']; ?></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <form action="<?= base_url("admin/destinations"); ?>" class="d-inline">
                                <input type="hidden" name="dest" value="<?php echo $destination['DestinationID']; ?>">
                                <button type="submit" class="btn btn-info btn-sm">Editar</button>
                            </form>
                            <form action="<?= base_url("admin/destinations/delete") ?>" method="POST" class="d-inline">
                                <input type="hidden" name="dest" value="<?php echo $destination['DestinationID']; ?>">
                                <button type="submit" name="delete_destination"
                                    class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();

$activeLinkDestination = 'active';

include ROOT_PATH . '/views/viewAdmin.php';
?>