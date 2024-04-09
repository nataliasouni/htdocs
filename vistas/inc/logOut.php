<script>
    let btnSalir = document.querySelector(".btn-exit-system");
    if (btnSalir != null) {
        btnSalir.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Quieres salir del sistema?',
                text: "La sesión actual se cerrará y saldrás del sistema",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d9534f',
                confirmButtonText: 'Si, salir',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.value) {
                    let url = '<?= SERVERURL; ?>ajax/loginAjax.php';
                    let token = '<?= $insLoginControlador->encryption($_SESSION['token_amu']); ?>';
                    let usuario = '<?= $insLoginControlador->encryption($_SESSION['nombre_usuario']); ?>';

                    let datos = new FormData();
                    datos.append("token", token);
                    datos.append("usuario", usuario);

                    fetch(url, {
                            method: 'POST',
                            body: datos
                        })
                        .then(respuesta => respuesta.json())
                        .then(respuesta => {
                            return alertasAjax(respuesta);
                        });
                }
            });
        });
    }
</script>