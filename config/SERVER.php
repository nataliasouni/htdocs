<?php
/* Parametros de conexion a la BD */
define('SERVER', 'localhost');
define('DB', 'amu');
define('USER', 'root');
define('PASSWORD', '');

define('SGBD', 'mysql:host='.SERVER.';dbname='.DB);

/* Metodo de encryptacion de contraseñas */
define('METHOD','AES-256-CBC');
define('SECRET_KEY', '$AMU@2024');
define('SECRET_IV', '946025');


