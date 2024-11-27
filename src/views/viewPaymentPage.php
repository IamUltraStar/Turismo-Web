<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del pago</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/stylePaymentPage.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body>
    <section class="payment_page_section">
        <header class="payment_page_section__header">
            <img src="../../assets/img/enterprise_logo.png" alt="">
        </header>
        <div class="container">
            <header>
                <i class="fi fi-rr-shopping-cart"></i>
                <h2 class="title">Información del pago</h2>
            </header>
            <div class="row">
                <div class="summary-container column">
                    <h3 class="title">Resumen</h3>
                    <hr>
                    <table>
                        <tr>
                            <td>Nombre del viaje</td>
                            <td><?php echo $arrayProgrammedTrip['Name']; ?></td>
                        </tr>
                        <tr>
                            <td>Cantidad de personas</td>
                            <td><?php echo $NumberPeople; ?></td>
                        </tr>
                        <tr>
                            <td>Fecha del viaje</td>
                            <td><?php echo $arrayProgrammedTrip['StartDate']; ?></td>
                        </tr>
                        <tr>
                            <td>Precio del viaje x persona</td>
                            <td>S/<?php echo $arrayProgrammedTrip['Price']; ?></td>
                        </tr>
                        <tr>
                            <td class="separator-row" colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td>S/<?php echo floatval($NumberPeople) * floatval($arrayProgrammedTrip['Price']); ?></td>
                        </tr>
                        <tr>
                            <td>IGV</td>
                            <td>S/<?php echo 0.18 * (floatval($NumberPeople) * floatval($arrayProgrammedTrip['Price'])); ?></td>
                        </tr>
                        <tr>
                            <td class="separator-row" colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>S/<?php echo (floatval($NumberPeople) * floatval($arrayProgrammedTrip['Price'])) + (0.18 * (floatval($NumberPeople) * floatval($arrayProgrammedTrip['Price']))); ?></td>
                        </tr>
                    </table>
                </div>
                <form class="column" action="authentication.php?action=execute-pay" method="POST">
                    <h3 class="title">Pago</h3>
                    <div class="input-box">
                        <span>Tarjetas aceptadas :</span>
                        <img src="../../assets/img/imgcards.png" alt="">
                    </div>
                    <div class="input-box">
                        <span>Número de Tarjeta de Crédito :</span>
                        <input type="number" placeholder="1111 2222 3333 4444">
                    </div>
                    <div class="input-box">
                        <span>Mes de caducidad :</span>
                        <input type="text" placeholder="Agosto">
                    </div>
                
                    <div class="flex">
                        <div class="input-box">
                            <span>Año de cad. :</span>
                            <input type="number" placeholder="2025">
                        </div>
                        <div class="input-box">
                            <span>CVV :</span>
                            <input type="number" placeholder="123">
                        </div>
                    </div>
                    <button type="submit" class="btn">Pagar</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>