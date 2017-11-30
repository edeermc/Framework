<?php

require_once "vendor/autoload.php";
require_once 'app/Lib/FPDF/fpdf.php';
#INCLUIR CONSTANTES.
include 'app/Config/constant_vars.php';

use App\Router\Router;

$r = new Router();

echo $r->run();