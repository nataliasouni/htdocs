<?php
  if ($peticionAjax) {
    require_once "../config/SERVER.php";
  } else {
    require_once "./config/SERVER.php";
  }

class mainModel
{
  /* ------ Funcion conectar a la BD ------ */
  protected static function conectarBD()
  {
    $conexion = new PDO(SGBD, USER, PASSWORD);
    $conexion->exec('SET CHARACTER SET utf8');
    return $conexion;
  }

  /* ------ Funcion de consulta simple ------ */
  protected static function consultaSimple($consulta)
  {
    $sql = self::conectarBD()->prepare($consulta);
    $sql->execute();
    return $sql;
  }

  /* ------ Encriptar cadenas por hash ------ */
  public function encryption($string)
  {
    $output = FALSE;
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
  }

  /* ------ Desencriptar cadenas por hash ------ */
  protected static function decryption($string)
  {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
  }

  /* ------ Funcion para limpiar cadenas ------ */
  protected static function limpiarCadena($cadena)
  {
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace(">", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    $cadena = str_ireplace("::", "", $cadena);
    $cadena = stripslashes($cadena);
    $cadena = trim($cadena);

    return $cadena;
  }

  /* ------ Funcion para verficar datos ------ */
  protected static function verificarDatos($filtro, $cadena)
  {
    if (preg_match("/^" . $filtro . "$/", $cadena)) {
      return false;
    } else {
      return true;
    }
  }

  /* ------ Funcion para verficar fechas ------ */
  protected static function verificarFechas($fecha)
  {
    $valores = explode("-", $fecha);

    if (count($valores) == 3 && checkdate($valores['1'], $valores['2'], $valores['0'])) {
      return false;
    } else {
      return true;
    }
  }

}
