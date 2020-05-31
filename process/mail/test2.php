<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use League\Plates\Engine;
use League\Plates\Template;

require '../platesPHP/vendor/league/plates/src/Engine.php';

//require "../platesPHP/vendor/autoload.php";
$templates = new Engine('../platesPHP/vendor/league/plates/src/');
echo $templates->render("plantillaEmail", ["dato" => "Valor del dato"]);
