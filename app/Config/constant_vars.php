<?php
/**
 * User: Equipo de desarrollo SICE México.
 * Date: 19/09/2017
 * Time: 10:27 AM
 * Funcion: Definir de forma organizada y global todas las constantes de configuracion utilizadas en el proyecto.
 *          Al definir un controlador de BD considerar los drivers de PDO.
 */

//CONFIGURACION DE BASE DE DATOS.
/*define("DB_HOST", "127.0.0.1");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "SIMCOTBD");
define("DB_DRIVER", "odbc");
define("DB_CHARSET", "UTF8");*/

define("DB_HOST", "127.0.0.1");
define("DB_USER", "db_user");
define("DB_PASS", "db_pass");
define("DB_NAME", "db_name");
define("DB_DRIVER", "pgsql");
define("DB_CHARSET", "UTF8");

//CONFIGURACION DE LA RUTA ROOT DE LA APLICACION
define("APPLICATION_ROOT", "http://localhost/framework_v2");

//CONFIGURACION DE LA ZONA HORARIA
date_default_timezone_set('America/Mexico_City');
