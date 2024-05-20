<?php
if ($peticionAjax) {
    require_once "../modelos/notificacionesModelo.php";
} else {
    require_once "./modelos/notificacionesModelo.php";
}

class notificacionesControlador extends notificacionesModelo {

    public function cargarProductosModelo() {
        $productosModelo = new notificacionesModelo();
        $productos = $productosModelo->obtenerProductosModelo();
        
        foreach ($productos as $producto) {
            $id = $producto['id'];
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];
            $fecha = $producto['fecha'];
            $hora = $producto['hora'];
    
            echo '<a onclick="window.location.href = \'' . SERVERURL . 'editarProducto/' . mainModel::encryption($id) . '\';"';
            echo '<div class="card">';
            echo '<div class="card-content">';
            echo '<div class="content-img">';
            echo '<img class="card-image" src="' . SERVERURL . 'vistas/img/Advertencia.png" alt="Notificaciones"> ';
            echo '</div>';
            echo '<div class="card-details">';
            echo '<h2 class="card-title" >' . $nombre . '</h2>'; 
            echo '<p class="card-description">Se agota este producto la cantidad disponible es: '. $cantidad .'</p>';
            echo '<p class="card-description">Fecha de alerta: ' . $fecha . '</p>';
            echo '<p class="card-description">Hora de alerta: '. $hora . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';


        }
    }
    
    public function cantidadProductosControlador() {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadProductos = notificacionesControlador::cantidadProductosModelo();

        // Devuelve la cantidad de registros
        return $cantidadProductos;
    }


}