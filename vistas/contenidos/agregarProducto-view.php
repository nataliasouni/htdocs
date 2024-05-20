<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-producto/productos.css">

<main class="full-box main-container">
    <!-- Incluir la barra lateral -->
    <?php include "./vistas/inc/NavLateral.php"; ?>

    <?php include "./vistas/inc/header.php"; ?>

    <section class="full-box page-content">

        <div class="page-content">

            <!-- Content -->
            <div class="tile-container">

                <div class="choose-option">
                    <h2 style='color: #0053A9'> Agregar producto</h2>
                </div>

                <form class="formularioAjax content styled-form" action="<?php echo SERVERURL; ?>ajax/productosAjax.php"
                    method="POST" data-form="save" enctype="multipart/form-data">
                    <input type="hidden" name="variable" value="<?php echo isset($_GET['variable']) ? htmlspecialchars($_GET['variable']) : ''; ?>">
                    <div class="añadir_producto-form">
                        <div class="form-group">
                            <label for="idNormal" class="titulos_form">Id</label>
                            <input type="number" id="idNormal" name="idNormal" class="producto_id" required>
                        </div>
                        <div class="form-group">
                            <label for="Nombre" class="titulos_form">Nombre</label>
                            <input type="text" id="Nombre" name="Nombre" class="producto_nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="Descripcion" class="titulos_form">Descripción</label>
                            <textarea id="Descripcion" name="Descripcion" class="producto_descripcion"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Categoria" class="titulos_form">Categoría</label>
                            <select id="Categoria" name="Categoria" class="selectform categoria" required>
                                <option value="" selected>Seleccionar categoría</option>
                                <option value="Movilidad y Recuperación">Movilidad y Recuperación</option>
                                <option value="Muebles Hospitalarios">Muebles Hospitalarios</option>
                                <option value="Línea Respiratoria">Línea Respiratoria</option>
                                <option value="Colchones y Colchonetas">Colchones y Colchonetas</option>
                                <option value="Prendas Quirurgicas">Prendas Quirurgicas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Cantidad" class="titulos_form">Cantidad</label>
                            <input type="number" id="Cantidad" name="Cantidad" class="producto_cantidad" required>
                        </div>
                        <div class="form-group">
                            <label for="Imagen" class="titulos_form">Imagen</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="Imagen" name="imagen" accept="image/*"
                                    lang="es" required>
                                <label class="custom-file-label" id="customFileLabel" for="Imagen">Seleccionar
                                    archivo...</label>
                            </div>
                        </div>
                        <div class="botones">
                            <button class="estado-enviar styled-button" type="submit" title="Enviar"
                                name="Enviar">Agregar</button>
                            <button id="botonCancelar" type="button" class="estado-cancelar styled-button"
                                title="Cancelar" name="Cancelar">Cancelar</button>
                        </div>
                    </div>
                </form>

            </div>
    </section>
</main>

<script>
    document.getElementById('Imagen').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var label = document.getElementById('customFileLabel');
        label.innerHTML = fileName;
    });
</script>

<script src="<?php echo SERVERURL; ?>vistas/js/producto-script/producto.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/producto-script/cancelarBtn.js" type="module"></script>