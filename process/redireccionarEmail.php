<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use mail\enviarEmail\enviarEmail;
use mail\enviarEmailcorporativo\enviarEmailcorporativo;

require 'mail/enviarEmail.php';
require 'mail/enviarEmailcorporativo.php';



if ($_POST) {
    $proyectos = array(
        1 => "Principal",
        2 => "Balboa Campestre",
        3 => "Riviera del Mar",
        4 => "Monteflores"
    );


    $fullname = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $infoadd = $_POST["infoad"];
    //$bandera = $_POST['bandera'];
    $idform = $proyectos[$_POST['idform']];
    $enviar = new enviarEmail($fullname, $correo, $telefono, $infoadd);
    if ($enviar->sendEmail() === '1') {
        $enviarcorporativo = new enviarEmailcorporativo($fullname, $correo, $telefono, $infoadd, $idform);
        $enviarcorporativo->sendEmail();
    }
    //echo "****Hola $fullname desde test.php";
    //echo json_encode("Formulario enviado");
} else {
    echo "BAD PAGE...";
}
