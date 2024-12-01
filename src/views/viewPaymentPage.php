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
            <img src="../../assets/img/enterprise_logo.png" alt="logo de la empresa">
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
                            <td id="trip-name"></td>
                        </tr>
                        <tr>
                            <td>Cantidad de personas</td>
                            <td id="num-people"></td>
                        </tr>
                        <tr>
                            <td>Fecha del viaje</td>
                            <td id="trip-date"></td>
                        </tr>
                        <tr>
                            <td>Precio del viaje x persona</td>
                            <td id="trip-price"></td>
                        </tr>
                        <tr>
                            <td class="separator-row" colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td id="subtotal"></td>
                        </tr>
                        <tr>
                            <td>IGV</td>
                            <td id="igv"></td>
                        </tr>
                        <tr>
                            <td class="separator-row" colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td id="total"></td>
                        </tr>
                    </table>
                </div>
                <form class="column" action="authentication.php?action=execute-pay" method="POST">
                    <h3 class="title">Pago</h3>
                    <input type="hidden" name="ProgrammedTripID" value="<?php echo $ProgrammedTripID; ?>">
                    <input type="hidden" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>">
                    <input type="hidden" name="NumberPeople" value="<?php echo $NumberPeople; ?>">
                    <input id="total_input_hidden" type="hidden" name="TotalAmount" value="">
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
    <script>
        const ProgrammedTripID = <?php echo $ProgrammedTripID; ?>;

        fetch("data.php?action=get-programmed-trip", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `ProgrammedTripID=${ProgrammedTripID}`
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById("trip-name").innerText = data.ProgrammedTripName || "--";
            document.getElementById("num-people").innerText = <?php echo $NumberPeople; ?>;
            document.getElementById("trip-date").innerText = data.StartDate || "--";
            document.getElementById("trip-price").innerText = `S/${data.Price || "--.--"}`;

            let numPeople = parseFloat(<?php echo $NumberPeople; ?>);
            let pricePerPerson = parseFloat(data.Price || 0);
            let subtotal = numPeople * pricePerPerson;
            let igv = subtotal * 0.18;
            let total = subtotal + igv;

            document.getElementById("subtotal").innerText = `S/${subtotal.toFixed(2)}`;
            document.getElementById("igv").innerText = `S/${igv.toFixed(2)}`;
            document.getElementById("total").innerText = `S/${total.toFixed(2)}`;
            document.getElementById("total_input_hidden").value = total;
        })
        .catch(error => {
            console.error("Error al cargar los destinos:", error);
        });
    </script>
</body>
</html>