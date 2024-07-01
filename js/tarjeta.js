document.getElementById('add-card').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'block';
});

document.getElementsByClassName('close')[0].addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});

document.getElementById('cancel').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});

document.getElementById('save').addEventListener('click', function() {
    // Aquí iría la lógica para guardar la nueva tarjeta
    document.getElementById('modal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('modal')) {
        document.getElementById('modal').style.display = 'none';
    }
});
