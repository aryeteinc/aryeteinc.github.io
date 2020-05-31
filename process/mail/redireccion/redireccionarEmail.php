<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use mail\enviarEmail\enviarEmail;
use mail\enviarEmailcorporativo\enviarEmailcorporativo;

require '../mail/enviarEmail.php';
require '../mail/enviarEmailcorporativo.php';



if ($_POST) {
    $proyectos = array(
        1 => "Formulario Pagina Principal",
        2 => "Balboa Campestre",
        3 => "Riviera del Mar",
        4 => "Campoflores"
    );


    $fullname = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $infoadd = $_POST["infoad"];
    $bandera = $_POST['bandera'];
    $idform = $_POST['idform'];
    if ($bandera === 'enviarEmail') {
        $enviar = new enviarEmail($fullname, $correo, $telefono, $infoadd);
        $enviar->sendEmail();
    } else {
        $enviarcorporativo = new enviarEmailcorporativo($fullname, $correo, $telefono, $infoadd);
        $enviarcorporativo->sendEmail();
    }
    //echo "****Hola $fullname desde test.php";
    //echo json_encode("Formulario enviado");
} else {
    echo "BAD PAGE...";
}
