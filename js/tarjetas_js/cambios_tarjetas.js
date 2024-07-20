// Variable global para almacenar el ID seleccionado
let selectedId = null;

document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editNombre = document.getElementById('editNombre');
    const editApellidoP = document.getElementById('editApellidoP');
    const editApellidoM = document.getElementById('editApellidoM');
    const editTelefono = document.getElementById('editTelefono');
    const editCorreo = document.getElementById('editCorreo');
    const editSaveButton = document.getElementById('editSave');
    const editCloseButton = editModal.querySelector('.close');
    
    // Función para abrir el modal de edición
    function abrirEditModal() {
        if (!selectedId) {
            console.error('No se ha seleccionado ningún cliente para editar.');
            return;
        }
    
        // Realizar solicitud fetch para obtener los datos del cliente con el ID dado
        fetch(`../FSP-main-2/controller/cliente_controller.php?idClien=${selectedId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Llenar el formulario con los datos del cliente
                editId.value = data.idClien;  // Asegúrate de que el campo ID en el formulario tenga el ID correcto
                editNombre.value = data.NombreClien;
                editApellidoP.value = data.ApellidoP;
                editApellidoM.value = data.ApellidoM;
                editTelefono.value = data.Telefono;
                editCorreo.value = data.Correo;
                
                // Mostrar el modal de edición
                editModal.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al obtener los datos del cliente.');
            });
    }
    
    
    // Evento para cerrar el modal de edición
    editCloseButton.addEventListener('click', function() {
        editModal.style.display = 'none';
    });
    
    // Evento para guardar los cambios del formulario de edición
    editSaveButton.addEventListener('click', function(event) {
        event.preventDefault();
        
        // Validar los campos antes de enviar la solicitud
        // Aquí puedes reutilizar las funciones de validación existentes
        
        // Construir el objeto con los datos actualizados
        const formData = {
            idClien: editId.value,
            NombreClien: editNombre.value,
            ApellidoP: editApellidoP.value,
            ApellidoM: editApellidoM.value,
            Telefono: editTelefono.value,
            Correo: editCorreo.value
        };
        
        // Enviar la solicitud para actualizar los datos del cliente
        fetch(`../FSP-main-2/controller/cliente_controller.php?idClien=${formData.idClien}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Cliente actualizado exitosamente');
                editForm.reset();
                editModal.style.display = 'none';
                // Aquí podrías agregar lógica adicional después de guardar los cambios
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al actualizar los datos del cliente.');
        });
    });
    
    // Evento para abrir el modal de edición al hacer clic en el botón Editar
    document.querySelector('.edit-button').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.select-checkbox:checked');
        if (checkboxes.length !== 1) {
            alert('Por favor selecciona solo un cliente para editar.');
            return;
        }
        
        // Asignar el ID seleccionado globalmente
        selectedId = checkboxes[0].value;
        
        // Abrir el modal de edición
        abrirEditModal();
    });
});
