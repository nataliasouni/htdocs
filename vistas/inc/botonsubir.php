<button onclick="scrollTopFunction()" id="scrollBtn" title="Volver arriba">↑</button>

<script>
    // Función para mostrar u ocultar el botón de desplazamiento
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollBtn").style.display = "block";
        } else {
            document.getElementById("scrollBtn").style.display = "none";
        }
    }

    // Función para desplazar al inicio de la página cuando se hace clic en el botón
    function scrollTopFunction() {
        document.body.scrollTop = 0; // Para navegadores que no soportan document.documentElement.scrollTop
        document.documentElement.scrollTop = 0; // Para navegadores que sí soportan document.documentElement.scrollTop
    }

</script>