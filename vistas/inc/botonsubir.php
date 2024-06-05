<button onclick="scrollTopFunction()" id="scrollBtn" title="Volver arriba">↑</button>

<style>
    #scrollBtn {
    display: none; /* Ocultar el botón por defecto */
    position: fixed; /* Fijar el botón en la ventana del navegador */
    bottom: 20px; /* Distancia desde la parte inferior de la ventana */
    right: 20px; /* Distancia desde el lado derecho de la ventana */
    z-index: 99; /* Asegurar que el botón esté por encima de otros elementos */
    border: none; /* Quitar el borde */
    background-color: #00a783; /* Color de fondo del botón */
    color: white; /* Color del texto del botón */
    cursor: pointer; /* Cambiar el cursor al pasar sobre el botón */
    padding: 5px; /* Espaciado interno */
    font-size: 16px; /* Tamaño del texto */
    transition: background-color 0.3s; /* Efecto de transición al cambiar el color de fondo */
}

#scrollBtn:hover {
    background-color: #007148; /* Cambiar el color de fondo al pasar el cursor sobre el botón */
}
</style>
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