<?php ob_start(); ?>

<section id="categories">
    <h2>Categorías</h2>
    <h3><?php echo $title_action_category ?? 'Crear categoria:'; ?></h3>
    <!-- Formulario para agregar una categoria -->
    <form action="<?= base_url('admin/categories/' . (isset($editCategory) ? 'update' : 'create')) ?>" method="POST"
        class="mb-3">
        <div class="row">
            <?php if (isset($editCategory)): ?>
                <input type="hidden" name="cat" value='<?php echo $editCategory['CategoryID']; ?>'>
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
        <tbody id="category_table">
            <?php if (isset($arrayCategories) && !empty($arrayCategories)): ?>
                <?php foreach ($arrayCategories as $category): ?>
                    <tr>
                        <td><?= $category["CategoryID"] ?></td>
                        <td><?= $category["Name"] ?></td>
                        <td><?= $category["Description"] ?></td>
                        <td>
                            <form action=<?= base_url('admin/categories') ?> class="d-inline">
                                <input type="hidden" name="cat" value="<?= $category["CategoryID"] ?>">
                                <button type="submit" class="btn btn-info btn-sm mb-2">Editar</button>
                            </form>
                            <form action=<?= base_url('admin/categories/delete') ?> method="POST" class="d-inline">
                                <input type="hidden" name="cat" value="<?= $category["CategoryID"] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay categorías disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();

$activeLinkCategory = 'active';

include ROOT_PATH . '/views/viewAdmin.php';
?>