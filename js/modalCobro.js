$(document).ready(function() {
    // Evento para abrir el modal de registro desde el modal de login
    $('#linkRegistro').on('click', function(event) {
        event.preventDefault();

        // Cerrar el modal de login
        $('#loginModal').modal('hide');

        // Abrir el modal de registro después de que el modal de login se haya cerrado
        $('#loginModal').on('hidden.bs.modal', function () {
            $('#ModalRegistro').modal('show');
            // Remover el evento de cierre del modal de registro
            $('#ModalRegistro').off('hidden.bs.modal');
        });
    });

    // Evento para limpiar el formulario del modal de registro cuando se cierra
    $('#ModalRegistro').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
});





// Esto es para el boton de reiniciar 

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar el botón "Reiniciar cobro"
    const resetButton = document.getElementById('reset-payment');

    // Agregar un event listener al botón
    resetButton.addEventListener('click', function () {
        // Limpiar todas las filas de la tabla
        const tableBody = document.querySelector('.table tbody');
        tableBody.innerHTML = '';

        // Limpiar los campos de texto para Cliente y Saldo
        document.getElementById('cliente').value = '';
        document.getElementById('saldo').value = '';

        // Limpiar el campo de texto al lado del signo de peso
        document.getElementById('amount').value = '';

        // Opcionalmente, puedes restablecer el select de Duplex al valor por defecto
        document.getElementById('duplex').value = '';

        // Opcionalmente, puedes restablecer el campo de texto para Cantidad de hojas
        document.getElementById('hojas').value = '';
    });

    // Seleccionar todas las filas de la tabla que tienen el botón de eliminar
    document.querySelectorAll('.delete-row').forEach(button => {
        button.addEventListener('click', function () {
            // Eliminar la fila que contiene el botón de eliminar
            this.closest('tr').remove();
        });
    });
});






document.addEventListener('DOMContentLoaded', function () {
        // Validar el campo de cantidad de hojas
        document.getElementById('hojas').addEventListener('input', function () {
            const value = this.value;
            if (value < 1) {
                this.value = 1;
            }
        });

    // Seleccionar el botón "Nuevo Lote"
    const newBatchButton = document.getElementById('new-batch');

    // Agregar un event listener al botón
    newBatchButton.addEventListener('click', function () {
        // Obtener los valores seleccionados en el modal
        const tamañoPapel = document.getElementById('clb_TamañoPapel').value;
        const tipoPapel = document.getElementById('clb_TipoPapel').value;
        const tipoImpresion = document.getElementById('clb_TipoImpresion').value;
        const cantidadHojas = document.getElementById('hojas').value;
        const duplex = document.getElementById('duplex').value;

        // Verificar si los campos del modal tienen valores
        if (tamañoPapel && tipoPapel && tipoImpresion && cantidadHojas && duplex) {
            // Obtener el último número de lote
            const tableBody = document.querySelector('.table tbody');
            const lastRow = tableBody.querySelector('tr:last-child');
            const lastBatchNumber = lastRow ? parseInt(lastRow.children[0].textContent) : 0;
            const nextBatchNumber = lastBatchNumber + 1;

            // Crear una nueva fila para la tabla
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${nextBatchNumber}</td>
                <td>${cantidadHojas}</td>
                <td>${duplex === 'si' ? 'Sí' : 'No'}</td>
                <td>${tamañoPapel}</td>
                <td>${tipoPapel}</td>
                <td>${tipoImpresion}</td>
                <td>--</td>
                <td><button class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button></td>
            `;

            // Añadir la nueva fila a la tabla
            tableBody.appendChild(newRow);

            // Agregar el event listener al nuevo botón de eliminar
            newRow.querySelector('.delete-row').addEventListener('click', function () {
                this.closest('tr').remove();
            });

            // Cerrar el modal después de agregar la fila
            const modal = bootstrap.Modal.getInstance(document.getElementById('propiedadesPapelModal'));
            modal.hide();
        } else {
            alert('Por favor, completa todos los campos en el modal.');
        }
    });

    // Inicializar el event listener para los botones de eliminar existentes
    document.querySelectorAll('.delete-row').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('tr').remove();
        });
    });

    // Configurar el evento para el botón de agregar en el modal
    document.querySelector('#propiedadesPapelModal form').addEventListener('submit', function (e) {
        e.preventDefault();
        newBatchButton.click(); // Simula el clic en el botón de nuevo lote
    });
});





//_________________________________________________

document.addEventListener('DOMContentLoaded', function () {
    // Función para calcular la suma de los totales
    function updateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('.table tbody tr').forEach(row => {
            const totalCell = row.cells[6]; // La columna "Total" es la séptima (índice 6)
            const totalText = totalCell.textContent.trim();
            // Extraer el valor numérico del texto (suponiendo que siempre empieza con $)
            const totalValue = parseFloat(totalText.replace('$', '').replace(',', ''));
            if (!isNaN(totalValue)) {
                totalAmount += totalValue;
            }
        });
        // Actualiza el campo de monto
        document.getElementById('amount').value = `$${totalAmount.toFixed(2)}`;
    }

    // Llama a la función para establecer el monto inicial
    updateTotalAmount();

    // Actualiza el monto cuando se elimina una fila
    document.querySelectorAll('.delete-row').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('tr').remove();
            updateTotalAmount();
        });
    });
});



//______________________________________---


document.addEventListener('DOMContentLoaded', function () {
    // Función para calcular la suma de los totales
    function updateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('.table tbody tr').forEach(row => {
            const totalCell = row.cells[6]; // La columna "Total" es la séptima (índice 6)
            const totalText = totalCell.textContent.trim();
            // Extraer el valor numérico del texto (suponiendo que siempre empieza con $)
            const totalValue = parseFloat(totalText.replace('$', '').replace(',', ''));
            if (!isNaN(totalValue)) {
                totalAmount += totalValue;
            }
        });
        // Actualiza el campo de monto
        document.getElementById('amount').value = `$${totalAmount.toFixed(2)}`;
    }

    // Llama a la función para establecer el monto inicial
    updateTotalAmount();

    // Actualiza el monto cuando se elimina una fila
    document.querySelectorAll('.delete-row').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('tr').remove();
            updateTotalAmount();
        });
    });

    // Maneja el clic en el botón "Cobrar"
    document.getElementById('charge').addEventListener('click', () => {
        // Obtiene el saldo actual
        const saldoField = document.getElementById('saldo');
        let saldo = parseFloat(saldoField.value.replace('$', '').replace(',', ''));
        
        // Obtiene el monto total a cobrar
        let totalAmount = parseFloat(document.getElementById('amount').value.replace('$', '').replace(',', ''));

        if (!isNaN(saldo) && !isNaN(totalAmount)) {
            // Resta el monto total del saldo
            saldo -= totalAmount;
            
            // Actualiza el campo de saldo
            saldoField.value = `$${saldo.toFixed(2)}`;
            
            // Limpia el campo de monto
            document.getElementById('amount').value = '$0.00';

            // Muestra una alerta de éxito (opcional)
            alert('El saldo ha sido actualizado exitosamente.');
        } else {
            alert('No hay monto total para cobrar o saldo no válido.');
        }
    });
});









