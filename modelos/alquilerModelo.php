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
    protected static function datosalquilerproductoModelo($numeroalquiler)
    {
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM  alquiler WHERE numeroalquiler = :numeroalquiler");
        $sql->bindParam(":numeroalquiler", $numeroalquiler);
        $sql->execute();
        return $sql;

    } //Fin del modelo

    // Modelo para actualizar los datos del usuario
    protected static function actualizarAlquilerModelo($datos)
    {
        $sql = mainModel::conectarBD()->prepare("UPDATE registroentradasalida SET  cedula = :cedula, fecha = :fecha, horaEntrada = :horaEntrada, horaSalida = :horaSalida, horasTrabajadas = :horasTrabajadas  WHERE id = :id");
        $sql->bindParam(":id", $datos['id']);
        $sql->bindParam(":cedula", $datos['cedula']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":horaEntrada", $datos['horaEntrada']);
        $sql->bindParam(":horaSalida", $datos['horaSalida']);
        $sql->bindParam(":horasTrabajadas", $datos['horasTrabajadas']);
        $sql->execute();
        return $sql;
    }
    // Fin del modelo
}