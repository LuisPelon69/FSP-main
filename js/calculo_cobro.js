$(document).ready(function() {
    // Calcular costo total al presionar el botón "shopping-cart"
    $('#shopping-cart').click(function() {
        var detalles = [];

        $('.table tbody tr').each(function() {
            var lote = $(this).find('td').eq(0).text();
            var hojas = $(this).find('td').eq(1).text();
            var duplex = $(this).find('td').eq(2).text();
            var tamaño = $(this).find('td').eq(3).text();
            var tipoPapel = $(this).find('td').eq(4).text();
            var tipoImpresion = $(this).find('td').eq(5).text();

            detalles.push({
                lote: lote,
                hojas: hojas,
                duplex: duplex,
                tamaño: tamaño,
                tipoPapel: tipoPapel,
                tipoImpresion: tipoImpresion
            });
        });

        $.ajax({
            url: 'Cobros_sub.php?action=getPrices',
            method: 'POST',
            data: {
                detalles: JSON.stringify(detalles)
            },
            dataType: 'json',
            success: function(response) {
                var totalCost = 0;
                $('.table tbody tr').each(function(index) {
                    var hojas = $(this).find('td').eq(1).text();
                    var duplex = $(this).find('td').eq(2).text();
                    var tamaño = $(this).find('td').eq(3).text();
                    var tipoPapel = $(this).find('td').eq(4).text();
                    var tipoImpresion = $(this).find('td').eq(5).text();

                    var precioTamaño = response.prices.tamañosPapel[tamaño] || 0;
                    var precioTipoPapel = response.prices.tiposPapel[tipoPapel] || 0;
                    var precioTipoImpresion = response.prices.tiposImpresion[tipoImpresion] || 0;

                    var lote = new CalcularLote();
                    lote.setX(parseFloat(precioTamaño));
                    lote.setY(parseFloat(precioTipoPapel));
                    lote.setZ(parseFloat(precioTipoImpresion));
                    lote.setH(parseInt(hojas));

                    var costo;
                    if (duplex === 'si') {
                        costo = lote.calcularConDuplex();
                    } else {
                        costo = lote.calcularSinDuplex();
                    }

                    $(this).find('td').eq(6).text(costo.toFixed(2));
                    totalCost += costo;
                });

                $('#amount').val('$' + totalCost.toFixed(2));
            },
            error: function() {
                mostrarMensaje('Error al calcular los costos.', 'error');
            }
        });
    });

    // Realizar cobro al presionar el botón "Cobrar"
    $('#charge').click(function() {
        var cliente = $('#cliente').val();
        var total = parseFloat($('#amount').val().replace('$', ''));
        var saldo = parseFloat($('#saldo').val().replace('$', ''));

        if (saldo < total) {
            mostrarMensaje('Saldo insuficiente para realizar el cobro.', 'error');
            return;
        }

        var detalles = [];

        $('.table tbody tr').each(function() {
            var lote = $(this).find('td').eq(0).text();
            var hojas = $(this).find('td').eq(1).text();
            var duplex = $(this).find('td').eq(2).text();
            var tamaño = $(this).find('td').eq(3).text();
            var tipoPapel = $(this).find('td').eq(4).text();
            var tipoImpresion = $(this).find('td').eq(5).text();
            var totalFila = $(this).find('td').eq(6).text();

            detalles.push({
                lote: lote,
                hojas: hojas,
                duplex: duplex,
                tamaño: tamaño,
                tipoPapel: tipoPapel,
                tipoImpresion: tipoImpresion,
                total: totalFila
            });
        });

        $.ajax({
            url: 'realizar_cobro.php',
            method: 'POST',
            data: {
                cliente: cliente,
                total: total,
                detalles: JSON.stringify(detalles)
            },
            success: function(response) {
                mostrarMensaje('Cobro realizado exitosamente.', 'success');
                $('#saldo').val('$' + (saldo - total).toFixed(2));
            },
            error: function() {
                mostrarMensaje('Error al realizar el cobro.', 'error');
            }
        });
    });

    // Clase CalcularLote
    class CalcularLote {
        constructor() {
            this.x = 0;
            this.y = 0;
            this.z = 0;
            this.g = 0;
            this.total = 0;
            this.h = 0;
        }

        setX(x) {
            this.x = x;
        }

        setY(y) {
            this.y = y;
        }

        setZ(z) {
            this.z = z;
        }

        setH(h) {
            this.h = h;
        }

        calcularConDuplex() {
            this.g = 2;
            this.total = (this.x + this.y + this.z) * this.g * this.h;
            return this.total;
        }

        calcularSinDuplex() {
            this.g = 2;
            this.total = ((this.x + this.y + this.z) * this.g * this.h) + ((this.x + this.y + this.z) * this.g * this.h * 0.1);
            return this.total;
        }
    }
});
