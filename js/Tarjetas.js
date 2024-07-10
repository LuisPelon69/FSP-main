document.addEventListener("DOMContentLoaded", function() {
    function fetchClientes() {
        fetch('controller/cliente_controller.php', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            let table = document.querySelector("table tbody");
            table.innerHTML = ''; // Limpiar la tabla antes de llenarla
            data.forEach(cliente => {
                let row = table.insertRow();
                row.setAttribute('data-id', cliente.idClien);

                // Checkbox con la ID del cliente como valor
                let cellCheckbox = row.insertCell(0);
                let checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.classList.add('select-checkbox');
                checkbox.value = cliente.idClien;
                cellCheckbox.appendChild(checkbox);

                // Nombre completo
                let cellNombre = row.insertCell(1);
                cellNombre.textContent = `${cliente.NombreClien} ${cliente.ApellidoP} ${cliente.ApellidoM}`;

                // Saldo
                let cellSaldo = row.insertCell(2);
                cellSaldo.textContent = `$ ${cliente.Saldo}`;

                // Correo
                let cellCorreo = row.insertCell(3);
                cellCorreo.textContent = cliente.Correo;

                // Teléfono
                let cellTelefono = row.insertCell(4);
                cellTelefono.textContent = cliente.Telefono;
            });
            updateButtonState();
        })
        .catch(error => console.error('Error:', error));
    }

    fetchClientes();

    function updateButtonState() {
        const checkboxes = document.querySelectorAll('.select-checkbox:checked');
        const addButton = document.getElementById('add-card');
        const editButton = document.querySelector('.edit-button');
        const deleteButton = document.querySelector('.delete-button');

        if (checkboxes.length === 0) {
            addButton.classList.remove('disabled');
            addButton.disabled = false;

            editButton.classList.add('disabled');
            editButton.disabled = true;

            deleteButton.classList.add('disabled');
            deleteButton.disabled = true;
        } else if (checkboxes.length === 1) {
            addButton.classList.add('disabled');
            addButton.disabled = true;

            editButton.classList.remove('disabled');
            editButton.disabled = false;

            deleteButton.classList.remove('disabled');
            deleteButton.disabled = false;
        } else {
            addButton.classList.add('disabled');
            addButton.disabled = true;

            editButton.classList.add('disabled');
            editButton.disabled = true;

            deleteButton.classList.remove('disabled');
            deleteButton.disabled = false;
        }
    }

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('select-checkbox')) {
            updateButtonState();
        }
    });

    document.getElementById('add-card').addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            // Aquí puedes abrir el modal para agregar una nueva tarjeta
            console.log('Abrir modal para agregar una nueva tarjeta');
        }
    });

    document.querySelector('.edit-button').addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            const selectedId = document.querySelector('.select-checkbox:checked').value;
            // Aquí puedes abrir el modal para editar la tarjeta con el ID seleccionado
            console.log('Abrir modal para editar la tarjeta con ID:', selectedId);
            abrirModalEdicion(selectedId);
        }
    });

    document.querySelector('.delete-button').addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
            // Aquí puedes manejar la eliminación de las tarjetas con los IDs seleccionados
            console.log('Eliminar tarjetas con IDs:', selectedIds);
            abrirModalEliminar(selectedIds);
        }
    });

    function abrirModalEdicion(id) {
        const modal = document.getElementById('edit-modal');
        const form = document.getElementById('editForm');

        // Obtener los datos del cliente seleccionado
        fetch(`controller/cliente_controller.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(cliente => {
            form.elements['id'].value = cliente.idClien;
            form.elements['NombreClien'].value = cliente.NombreClien;
            form.elements['ApellidoP'].value = cliente.ApellidoP;
            form.elements['ApellidoM'].value = cliente.ApellidoM;
            form.elements['Telefono'].value = cliente.Telefono;
            form.elements['Correo'].value = cliente.Correo;

            modal.style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
    }

    document.getElementById('editSave').addEventListener('click', function(event) {
        event.preventDefault();

        const form = document.getElementById('editForm');
        const data = {
            idClien: form.elements['id'].value,
            NombreClien: form.elements['NombreClien'].value,
            ApellidoP: form.elements['ApellidoP'].value,
            ApellidoM: form.elements['ApellidoM'].value,
            Telefono: form.elements['Telefono'].value,
            Correo: form.elements['Correo'].value
        };

        fetch('controller/cliente_controller.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
            } else {
                alert('Cliente actualizado exitosamente');
                form.reset();
                cerrarModalEdicion();
                fetchClientes(); // Actualizar la tabla
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error: ' + error.message);
        });
    });

    function cerrarModalEdicion() {
        const modal = document.getElementById('edit-modal');
        modal.style.display = 'none';
    }

    document.querySelector('#edit-modal .close').addEventListener('click', cerrarModalEdicion);
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('edit-modal')) {
            cerrarModalEdicion();
        }
    });

    document.getElementById('deleteConfirm').addEventListener('click', function(event) {
        event.preventDefault();

        const form = document.getElementById('deleteForm');
        const ids = form.elements['ids'].value.split(',');

        fetch('controller/cliente_controller.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ids: ids })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
            } else {
                alert('Clientes eliminados exitosamente');
                form.reset();
                cerrarModalEliminar();
                fetchClientes(); // Actualizar la tabla
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error: ' + error.message);
        });
    });

    function cerrarModalEliminar() {
        const modal = document.getElementById('delete-modal');
        modal.style.display = 'none';
    }

    document.querySelector('#delete-modal .close').addEventListener('click', cerrarModalEliminar);
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('delete-modal')) {
            cerrarModalEliminar();
        }
    });
});