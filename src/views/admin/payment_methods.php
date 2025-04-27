<?php ob_start(); ?>

<section id="payments">
    <h2>Métodos de Pago</h2>
    <h3><?php echo $title_action_paymentMethod ?? 'Crear método de pago:'; ?></h3>
    <!-- Formulario para agregar un método de pago -->
    <form action="<?= base_url("admin/payment-methods/" . (isset($editpaymentMethod) ? 'update' : 'create')); ?>"
        method="POST" class="mb-3">
        <?php if (isset($editpaymentMethod)): ?>
            <input type="hidden" name="payment_method" value='<?php echo $editpaymentMethod['PaymentMethodID']; ?>'>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="payment_method_name" class="form-control" placeholder="Nombre del Método"
                    value="<?php echo isset($editpaymentMethod) ? $editpaymentMethod['Name'] : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="description" class="form-control" placeholder="Descripción"
                    value="<?php echo isset($editpaymentMethod) ? $editpaymentMethod['Description'] : ''; ?>" required>
            </div>
            <div class="col-md-1">
                <button type="submit"
                    name="<?php echo isset($editpaymentMethod) ? 'update_paymentMethod' : 'add_paymentMethod'; ?>"
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
        <tbody id="paymentMethod_table">
            <?php if (isset($arrayPaymentMethods) && !empty($arrayPaymentMethods)): ?>
                <?php foreach ($arrayPaymentMethods as $paymentMethod): ?>
                    <tr>
                        <td><?php echo $paymentMethod['PaymentMethodID']; ?></td>
                        <td><?php echo $paymentMethod['Name']; ?></td>
                        <td><?php echo $paymentMethod['Description']; ?></td>
                        <td>

                            <a href="<?= base_url("admin/payment-methods/?payment_method={$paymentMethod['PaymentMethodID']}") ?>"
                                class="btn btn-warning mb-2">Editar</a>
                            <form action="<?= base_url("admin/payment-methods/delete") ?>" method="POST">
                                <input type="hidden" name="payment_method" value="<?= $paymentMethod['PaymentMethodID']; ?>">
                                <button class="btn btn-danger">Eliminar</button>

                            </form>


                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No hay métodos de pago disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();

$activeLinkPaymentMethod = 'active';

include ROOT_PATH . '/views/viewAdmin.php';
?>