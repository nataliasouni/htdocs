<?php
require_once "mainModel.php";

class alquilerModelo extends mainModel
{
    //Modelo para agrega
    protected static function agregarAlquilerModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("INSERT INTO 
        alquiler(numeroalquiler,fechaentrega,fechadevolucion,tiempodias,id,nombrecliente,cedulacliente,
        fotocopiacedula, fotocopiarecibo,direccion,telefono,nombreref1, telefonoref1, nombreref2,telefonoref2,
        contratopagare,totalpagar) 
        VALUES(:numeroAlquiler,:fechaEntrega,:fechaDevolucion,:tiempoDias,:Id,:nombreCliente,:cedulaCliente,:fotocopiaCedula, :fotocopiaRecibo,:Direccion,:Telefono,:nombreRef1,:telefonoRef1, :nombreRef2, :telefonoRef2,:contratoPagare,:totalPagar)");

        $sql->bindParam(":numeroAlquiler", $datos['numeroAlquiler']);
        $sql->bindParam(":fechaEntrega", $datos['fechaentrega']);
        $sql->bindParam(":fechaDevolucion", $datos['fechadevolucion']);
        $sql->bindParam(":tiempoDias", $datos['tiempodias']);
        $sql->bindParam(":Id", $datos['id']);
        $sql->bindParam(":nombreCliente", $datos['nombrecliente']);
        $sql->bindParam(":cedulaCliente", $datos['cedulacliente']);
        $sql->bindParam(":fotocopiaCedula", $datos['fotocopiacedula']);
        $sql->bindParam(":fotocopiaRecibo", $datos['fotocopiarecibo']);
        $sql->bindParam(":Direccion", $datos['direccion']);
        $sql->bindParam(":Telefono", $datos['telefono']);
        $sql->bindParam(":nombreRef1", $datos['nombreref1']);
        $sql->bindParam(":nombreRef2", $datos['nombreref2']);
        $sql->bindParam(":telefonoRef1", $datos['telefonoref1']);
        $sql->bindParam(":telefonoRef2", $datos['telefonoref2']);
        $sql->bindParam(":contratoPagare", $datos['contratopagare']);
        $sql->bindParam(":totalPagar", $datos['totalpagar']);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    //Modelo para obtener datos 
    protected static function datosalquilerModelo($numeroalquiler)
    {
        $sql = mainModel::conectarBD()->prepare("
            SELECT a.numeroalquiler, a.nombrecliente, ap.id AS id, ap.nombreproducto AS nombre_producto,
                   ap.detalles AS detalles_producto, ap.deposito AS deposito_producto, a.fechaentrega,
                   a.fechadevolucion,a.tiempodias,a.totalpagar,a.nombrecliente,a.cedulacliente,a.direccion,a.telefono,a.nombreref1,a.nombreref2,a.telefonoref1,a.telefonoref2,a.fotocopiacedula,a.fotocopiarecibo,a.contratopagare
            FROM alquiler a
            JOIN alquilerproductos ap ON a.id = ap.id
            WHERE a.numeroalquiler = :numeroalquiler
            ORDER BY a.numeroalquiler ASC
        ");
        $sql->bindParam(":numeroalquiler", $numeroalquiler);
        $sql->execute();
        return $sql;
    } //Fin del modelo

    // Modelo para actualizar los datos del usuario
    // Modelo para actualizar los datos del usuario
    protected static function actualizarEstadoModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("UPDATE alquilerproductos SET  estado = :estado  WHERE id = :id");
        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->execute();
        return $sql;
    }

    // Fin del modelo

    // Modelo para actualizar los datos del usuario
    protected static function actualizarEstadoaAlquilerModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("UPDATE alquiler SET  fechaentrega = :fechaEntrega, fechadevolucion = :fechaDevolucion,
        tiempodias = :tiempoDias, id = :Id, nombrecliente = :nombreCliente, cedulacliente = :cedulaCliente, 
        direccion = :Direccion,telefono = :Telefono,nombreref1= :nombreRef1,nombreref2= :nombreRef2,telefonoref1= :telefonoRef1, telefonoref2= :telefonoRef2, 
        totalpagar = :totalPagar,  estado = :estado  WHERE numeroalquiler = :numeroAlquiler");

        $sql->bindParam(":numeroAlquiler", $datos['numeroAlquiler']);
        $sql->bindParam(":fechaEntrega", $datos['fechaentrega']);
        $sql->bindParam(":fechaDevolucion", $datos['fechadevolucion']);
        $sql->bindParam(":tiempoDias", $datos['tiempodias']);
        $sql->bindParam(":Id", $datos['id']);
        $sql->bindParam(":nombreCliente", $datos['nombrecliente']);
        $sql->bindParam(":cedulaCliente", $datos['cedulacliente']);
        $sql->bindParam(":Direccion", $datos['direccion']);
        $sql->bindParam(":Telefono", $datos['telefono']);
        $sql->bindParam(":nombreRef1", $datos['nombreref1']);
        $sql->bindParam(":nombreRef2", $datos['nombreref2']);
        $sql->bindParam(":telefonoRef1", $datos['telefonoref1']);
        $sql->bindParam(":telefonoRef2", $datos['telefonoref2']);
        $sql->bindParam(":totalPagar", $datos['totalpagar']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->execute();
        return $sql;
    }

    // Fin del modelo

    public function cantidadRegistrosModelo() {
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM alquiler WHERE estado = 'Terminado'");
    
        // Ejecutar la consulta
        $sql->execute();
    
        // Obtener el resultado de la consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    
        // Devolver la cantidad de registros
        return $resultado['total'];
    }

    public function cantidadvencidosModelo() {
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM alquiler WHERE estado = 'Vencido'");
    
        // Ejecutar la consulta
        $sql->execute();
    
        // Obtener el resultado de la consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    
        // Devolver la cantidad de registros
        return $resultado['total'];
    }

    public function cantidadvigenteModelo() {
        $sql = mainModel::conectarBD()->prepare("SELECT COUNT(*) AS total FROM alquiler WHERE estado = 'En proceso'");
    
        // Ejecutar la consulta
        $sql->execute();
    
        // Obtener el resultado de la consulta
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    
        // Devolver la cantidad de registros
        return $resultado['total'];
    }
    
}