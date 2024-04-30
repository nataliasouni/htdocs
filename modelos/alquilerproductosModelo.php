<?php
require_once "mainModel.php";

class alquilerProductosModelo extends mainModel
{


    //Modelo para obtener datos 
    protected static function datosalquilerproductoModelo($id)
    {   
        $sql = mainModel::conectarBD()->prepare("SELECT * FROM  productos WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;

    } //Fin del modelo


}