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

//(Hay un pedo con los modales login y registro)

// Código para mostrar el logo al hacer scroll
const logo = document.querySelector('.Logo');

const showLogoOnScroll = () => {
    const scrollTop = window.scrollY;
    const windowHeight = window.innerHeight;
    const logoTop = logo.offsetTop;

    if (scrollTop + windowHeight > logoTop) {
        logo.classList.add('show');
    } else {
        logo.classList.remove('show');
    }
};

// Evento de scroll para mostrar el logo
window.addEventListener('scroll', showLogoOnScroll);

// Ejecutar al cargar la página
showLogoOnScroll();


//Efecto de la imagen en el contenedor 3 (Mision)

const imageContainers = document.querySelectorAll('.custom-image-container');

    function checkVisibility() {
        imageContainers.forEach(imageContainer => {
            const rect = imageContainer.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom >= 0) {
                imageContainer.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', checkVisibility);
    checkVisibility();
;

/*Efecto scroll para el titulo "Nosotros"*/

const title = document.querySelector('.title');

const showTitleOnScroll = () => {
    const scrollTop = window.scrollY;
    const windowHeight = window.innerHeight;
    const titleTop = title.offsetTop;

    if (scrollTop + windowHeight > titleTop) {
        title.classList.add('show');
    } else {
        title.classList.remove('show');
    }
};

// Evento de scroll para mostrar el título
window.addEventListener('scroll', showTitleOnScroll);

// Ejecutar al cargar la página
showTitleOnScroll();


    document.addEventListener("DOMContentLoaded", () => {
        document.body.classList.add('fade-in');
    });

    document.querySelectorAll('a').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                event.preventDefault();
                document.body.classList.add('fade-out');
                setTimeout(() => {
                    window.location.href = href;
                }, 300); // tiempo de la animación en ms
            }
        });
    });



