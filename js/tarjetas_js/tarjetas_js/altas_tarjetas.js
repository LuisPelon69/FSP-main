    document.addEventListener('DOMContentLoaded', function() {
        const NombreClien = document.getElementById('NombreClien');
        const ApellidoP = document.getElementById('ApellidoP');
        const ApellidoM = document.getElementById('ApellidoM');
        const Telefono = document.getElementById('Telefono');
        const Correo = document.getElementById('Correo');
        const passwClien = document.getElementById('passwClien');
        const confirmPassword = document.getElementById('confirm-passwClien');
        const modal = document.getElementById('modal');
        const saveButton = document.getElementById('save');
        const closeButton = document.querySelector('.close');
        const tableBody = document.querySelector('table tbody');

        function validarNombres(value) {
            const regex = /^[a-zA-Z\s]+$/;
            return regex.test(value);
        }

        function validarTelefono(value) {
            const regex = /^\d{10}$/;
            return regex.test(value);
        }

        function validarCorreo(value) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value);
        }

        function validarContrasena(value) {
            const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+={}\[\]:;<>,.?~\-]).{8,}$/;
            return regex.test(value);
        }

        function mostrarError(elemento, mensaje) {
            const errorElemento = document.getElementById('error-' + elemento.id);
            errorElemento.textContent = mensaje;
            errorElemento.style.color = 'red';
        }

        function limpiarError(elemento) {
            const errorElemento = document.getElementById('error-' + elemento.id);
            errorElemento.textContent = '';
        }

        function abrirModal() {
            modal.style.display = 'block';
        }

        function cerrarModal() {
            modal.style.display = 'none';
        }

        function fetchClientes() {
            fetch('../FSP-main-2/controller/cliente_controller.php', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = ''; // Limpiar la tabla antes de agregar filas nuevas
                data.forEach(cliente => {
                    let row = tableBody.insertRow();
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

        NombreClien.addEventListener('input', function() {
            if (!validarNombres(NombreClien.value.trim())) {
                mostrarError(NombreClien, 'Ingrese un nombre válido (solo letras y espacios)');
            } else {
                limpiarError(NombreClien);
            }
        });

        ApellidoP.addEventListener('input', function() {
            if (!validarNombres(ApellidoP.value.trim())) {
                mostrarError(ApellidoP, 'Ingrese un apellido paterno válido (solo letras y espacios)');
            } else {
                limpiarError(ApellidoP);
            }
        });

        ApellidoM.addEventListener('input', function() {
            if (!validarNombres(ApellidoM.value.trim())) {
                mostrarError(ApellidoM, 'Ingrese un apellido materno válido (solo letras y espacios)');
            } else {
                limpiarError(ApellidoM);
            }
        });

        Telefono.addEventListener('input', function() {
            if (!validarTelefono(Telefono.value.trim())) {
                mostrarError(Telefono, 'Ingrese un número de teléfono válido (10 dígitos numéricos)');
            } else {
                limpiarError(Telefono);
            }
        });

        Correo.addEventListener('input', function() {
            if (!validarCorreo(Correo.value.trim())) {
                mostrarError(Correo, 'Ingrese un correo electrónico válido');
            } else {
                limpiarError(Correo);
            }
        });

        passwClien.addEventListener('input', function() {
            if (!validarContrasena(passwClien.value.trim())) {
                mostrarError(passwClien, 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un carácter especial y un número');
            } else {
                limpiarError(passwClien);
            }
        });

        confirmPassword.addEventListener('input', function() {
            const passwordValue = passwClien.value.trim();
            const confirmPasswordValue = confirmPassword.value.trim();
            if (passwordValue !== confirmPasswordValue) {
                mostrarError(confirmPassword, 'Las contraseñas no coinciden');
            } else {
                limpiarError(confirmPassword);
            }
        });

        document.getElementById('add-card').addEventListener('click', abrirModal);

        closeButton.addEventListener('click', cerrarModal);

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                cerrarModal();
            }
        });

        saveButton.addEventListener('click', function(event) {
            event.preventDefault();

            if (!validarNombres(NombreClien.value.trim()) ||
                !validarNombres(ApellidoP.value.trim()) ||
                !validarNombres(ApellidoM.value.trim()) ||
                !validarTelefono(Telefono.value.trim()) ||
                !validarCorreo(Correo.value.trim()) ||
                !validarContrasena(passwClien.value.trim()) ||
                passwClien.value.trim() !== confirmPassword.value.trim()) {
                alert('Por favor corrija los campos antes de guardar.');
                return;
            }

            const form = document.getElementById('clienteForm');
            const data = {
                NombreClien: form.elements['NombreClien'].value,
                ApellidoP: form.elements['ApellidoP'].value,
                ApellidoM: form.elements['ApellidoM'].value,
                Telefono: form.elements['Telefono'].value,
                Correo: form.elements['Correo'].value,
                passwClien: form.elements['passwClien'].value
            };

            fetch('../FSP-main-2/controller/cliente_controller.php', {
                method: 'POST',
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
                    alert('Cliente creado exitosamente');
                    form.reset();
                    fetchClientes();
                    cerrarModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error: ' + error.message);
            });
        });

        // Cargar la lista de clientes al cargar la página
        fetchClientes();
    });
