<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-homepage/homepage.css">

<?php include "./vistas/inc/headerInicio.php"; ?>

<main class="full-box main-container">

    <!-- Slider o Banner Principal -->
    <section class="banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Bienvenido a AMU</h1>
            <p>Tu mejor opción para comprar tus productos de ayudas y movilidad.</p>
            <a href="" class="cta">Explora nuestros productos</a>
        </div>
    </section>

    <!-- Sección de Categoria-->
    <section id="categorias" class="categorias">
        <div class="container-categoria">
            <div class="categoria">
                <img src="<?php echo SERVERURL; ?>vistas/img/imgCatalogo1.png" alt="Categoría 1">
                <p>Descripción breve de la categoría 1.</p>
                <a href="#">Ver más</a>
            </div>
            <div class="categoria">
                <img src="<?php echo SERVERURL; ?>vistas/img/imgCatalogo2.png" alt="Categoría 2">
                <p>Descripción breve de la categoría 2.</p>
                <a href="#">Ver más</a>
            </div>
            <div class="categoria">
                <img src="<?php echo SERVERURL; ?>vistas/img/imgCatalogo3.png" alt="Categoría 3">
                <p>Descripción breve de la categoría 3.</p>
                <a href="#">Ver más</a>
            </div>
            <div class="categoria">
                <img src="<?php echo SERVERURL; ?>vistas/img/imgCatalogo4.png" alt="Categoría 4">
                <p>Descripción breve de la categoría 4.</p>
                <a href="#">Ver más</a>
            </div>
        </div>
    </section>

    <!-- Sección de Productos -->
    <section id="productos" class="productos">
        <div class="container" id="container">
            <?php
            require_once "./controladores/productoControlador.php";
            $insProducto = new productoControlador();
            echo $insProducto->enlistarProductoHomeControlador();
            ?>
        </div>
        <div class="buttons-container">
            <button id="prevBtn" class="prev">&#10094; Anterior</button>
            <button id="nextBtn" class="next">Siguiente &#10095;</button>
        </div>
    </section>

    <!-- Sección de Servicios de Agendamiento de Citas -->
    <section id="servicios" class="servicios">
        <div class="container-servicios">
            <div class="servicios-info">
                <h2>Agendamiento de Citas para Fonondología</h2>
                <p></p>
                <p>Soy Diana Carolina Rodriguez Calle y me complace presentarme como fonoaudióloga especializada en la
                    creación de moldes para protectores de oído en AMU (ayudas medicas universales). Con una sólida
                    formación académica obtenida en la Universidad del Valle y años de experiencia en el campo de la
                    fonoaudiología, me comprometo a proporcionarle servicios de la más alta calidad y atención
                    personalizada a cada uno de mis pacientes Mi enfoque se centra en brindar soluciones adaptadas a las
                    necesidades individuales de cada cliente, utilizando tecnología de vanguardia y técnicas
                    especializadas en la toma de impresiones para garantizar la máxima comodidad y eficacia de los
                    protectores de oído.
                </p>
                <p>Agende su cita con nuestra especialista en fonodilogía, la Dra. Diana Carolina Rodriguez, quien
                    cuenta con años de
                    experiencia y un trato humano excepcional para ayudarlo con sus necesidades auditivas.</p>
                <div class="gallery">
                    <img src="<?php echo SERVERURL; ?>vistas/img/imgProtector1.jpg" alt="Imagen 1">
                    <img src="<?php echo SERVERURL; ?>vistas/img/imgProtector2.jpg" alt="Imagen 2">
                    <img src="<?php echo SERVERURL; ?>vistas/img/imgProtector3.jpg" alt="Imagen 3">
                    <img src="<?php echo SERVERURL; ?>vistas/img/imgProtector4.jpg" alt="Imagen 4">
                </div>
                <a href="#agendar-cita" class="cta">Agendar Cita</a>
            </div>
            <div class="servicios-images">
                <img src="<?php echo SERVERURL; ?>vistas/img/diana.jpg" alt="Foto de la Fonodilogo">
            </div>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section id="contacto" class="contacto">
        <div class="container-contacto">
            <h2>Contacto</h2>
            <p>Estamos aquí para ayudarte. Contáctanos.</p>
            <form action="enviar.php" method="post">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <textarea name="mensaje" placeholder="Mensaje" required></textarea>
                <button type="submit">Enviar Mensaje</button>
            </form>
            <div class="informacion-contacto">
                <p>Dirección: Carrera 27 No.23-11</p>
                <p>Teléfono: 300 6137041</p>
                <p>Correo electrónico: info@amu.com</p>
            </div>
        </div>
    </section>
</main>

<?php include "./vistas/inc/footerHome.php"; ?>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById("container");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let scrollAmount = 0;
        const cardWidth = container.firstElementChild.offsetWidth + 20; // Ancho de la tarjeta + margen
        const autoScrollSpeed = 6000; // Tiempo en milisegundos entre cada desplazamiento automático

        // Función para desplazar hacia la derecha
        function scrollToRight() {
            scrollAmount += cardWidth;
            container.scroll({
                top: 0,
                left: scrollAmount,
                behavior: "smooth"
            });
            // Si llegamos al final del contenedor, regresamos al inicio con un pequeño retraso
            if (scrollAmount >= container.scrollWidth - container.offsetWidth) {
                setTimeout(() => {
                    scrollAmount = 0;
                    container.scroll({
                        top: 0,
                        left: scrollAmount,
                        behavior: "auto"
                    });
                }, 500); // Retraso de 500 milisegundos antes de restablecer el desplazamiento
            }
        }

        // Función para desplazar hacia la izquierda
        function scrollToLeft() {
            scrollAmount -= cardWidth;
            container.scroll({
                top: 0,
                left: scrollAmount,
                behavior: "smooth"
            });
            // Si estamos al inicio del contenedor y hacemos clic en "Prev", nos desplazamos al final
            if (scrollAmount < 0) {
                setTimeout(() => {
                    scrollAmount = container.scrollWidth - container.offsetWidth;
                    container.scroll({
                        top: 0,
                        left: scrollAmount,
                        behavior: "auto"
                    });
                }, 500); // Retraso de 500 milisegundos antes de restablecer el desplazamiento
            }
        }

        // Iniciar el desplazamiento automático hacia la derecha
        const autoScrollInterval = setInterval(scrollToRight, autoScrollSpeed);

        // Detener el desplazamiento automático cuando el cursor se posa sobre el contenedor
        container.addEventListener("mouseenter", function () {
            clearInterval(autoScrollInterval);
        });

        // Reanudar el desplazamiento automático cuando el cursor sale del contenedor
        container.addEventListener("mouseleave", function () {
            autoScrollInterval = setInterval(scrollToRight, autoScrollSpeed);
        });

        // Desplazamiento hacia la izquierda cuando se presiona el botón "Prev"
        prevBtn.addEventListener("click", function () {
            scrollToLeft();
        });

        // Desplazamiento hacia la derecha cuando se presiona el botón "Next"
        nextBtn.addEventListener("click", function () {
            scrollToRight();
        });
    });

</script>