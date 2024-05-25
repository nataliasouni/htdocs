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

        if (empty($productos)) {
            echo "No hay alertas que mostrar";
        } else {

        
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
    }
    
    public function cantidadProductosControlador() {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadProductos = notificacionesModelo::cantidadProductosModelo();

        // Devuelve la cantidad de registros
        return $cantidadProductos;
    }

    public function insumosTaller() {

    // Obtener las notificaciones del taller
    $notificaciones = self::obtenerNotificacionesTallerModelo();
    
    if (empty($notificaciones)) {
        echo "No hay alertas que mostrar";
    } else {


    foreach ($notificaciones as $notificacion) {
        $id = $notificacion['id'];
        $nombre = $notificacion['nombre_usuario'];
        $insumos = $notificacion['insumos'];
        $fecha = $notificacion['fecha'];
        $hora = $notificacion['hora'];
    
        echo '<div class="card">';
        echo '<div class="card-content">';
        echo '<div class="content-img">';
        echo '<img class="card-image" src="' . SERVERURL . 'vistas/img/Advertencia.png" alt="Notificaciones"> ';
        echo '</div>';
        echo '<div class="card-details">';
        echo '<h2 class="card-title">' . $nombre . '</h2>'; 
        echo '<p class="card-description">Se ha solicitado: ' . $insumos . '</p>';
        echo '<p class="card-description">Fecha de alerta: ' . $fecha . '</p>';
        echo '<p class="card-description">Hora de alerta: ' . $hora . '</p>';

        // Agregar el botón "Atendido" como un botón normal
        echo '<form method="POST" action="">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<button id="atendido" type="submit" name="atendido">Atendido</button>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
        echo '</div>';



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                require_once "./controladores/talleresControlador.php";
                $talleresControlador = new talleresControlador();
                echo $talleresControlador->modificarEstadoInsumosControlador();
            }
        }
        


    }

    }
    

    }


    public function cantidadInsumosTallerControlador() {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadInsumosTaller = notificacionesModelo::cantidadInsumosTallerModelo();

        // Devuelve la cantidad de registros
        return $cantidadInsumosTaller;
    }


    public function cantidadAlertasControlador() {
        // Llama al método del modelo que obtiene la cantidad de registros en la tabla produccion
        $cantidadAlertas = notificacionesModelo::cantidadInsumosTallerModelo();

        // Devuelve la cantidad de registros
        return $cantidadAlertas;
    }
}