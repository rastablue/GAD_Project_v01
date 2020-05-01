$(document).ready(function() {
    $('#form-cliente').hide();
})

window.addEventListener('load', function() {
    document.getElementById('cedula').addEventListener('keyup', function() {
        if ((document.getElementById('cedula').value.length) > 9) {
            fetch(`solicituds/buscar?cedula=${document.getElementById('cedula').value}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                    $('#form-cliente').show();
                })
        }

    })
})