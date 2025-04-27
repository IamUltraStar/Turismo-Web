<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Turismo</title>
    <link rel="icon" href="<?= base_url("../../assets/img/enterprise_logo.png") ?>">
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url("admin") ?>">Admin Turismo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $activeLinkDestination ?? '' ?>"
                            href="<?= base_url("admin/destinations") ?>">Destinos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeLinkCategory ?? '' ?>"
                            href="<?= base_url('admin/categories') ?>">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeLinkProgrammedTrip ?? '' ?>"
                            href="<?= base_url("admin/programmed-trips"); ?>">Viajes Programados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeLinkActivity ?? '' ?>"
                            href="<?= base_url("admin/activities"); ?>">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeLinkPaymentMethod ?? '' ?>"
                            href="<?= base_url("admin/payment-methods"); ?>">Métodos de Pago</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Panel de Administración</h1>
        <div>
            <?= $content ?? ''; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>