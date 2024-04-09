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
                    <h2 style='color: #0053A9'>Agregar Insumo</h2>
                </div>

                <form class="formularioAjax content styled-form" action="<?php echo SERVERURL; ?>ajax/insumosAjax.php"
                    method="POST" data-form="save" enctype="multipart/form-data">
                    <div class="añadir_producto-form">
                        <div class="form-group">
                            <label for="idNormal" class="titulos_form">Id</label>
                            <input type="text" id="idInsumo" name="idInsumo" class="producto_id" required>
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
                            <label for="Cantidad" class="titulos_form">Cantidad</label>
                            <input type="number" id="Cantidad" name="Cantidad" class="producto_cantidad" required>
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

<script src="<?php echo SERVERURL; ?>vistas/js/producto-script/producto.js"></script>

<script src="<?php echo SERVERURL; ?>vistas/js/producto-script/cancelarBtn.js" type="module"></script>