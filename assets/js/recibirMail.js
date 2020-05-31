const $fullname = $("#fullname"),
    $email = $("#email"),
    $telefono = $("#telefono"),
    $infoadd = $("#infoadd"),
    $politicas = $("#formCheck"),
    $idform = $("#idForm"),
    $btnEnviar = $("#btnEnviar");

function EmailValidate() {
    //var numericExpression = /^w.+@[a-zA-Z_-]+?.[a-zA-Z]{2,3}$/;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var elem = $("#email").val();
    if (elem.match(mailformat)) return true;
    else return false;
}

var numFieldsRequeried = 3;

$btnEnviar.on("click", function () {
    //Verificamos que los campos que sean requeridos tengan informacion
    var errocounter = 0;
    var errorMessage = "";

    //Validacion para campos fullname
    if ($("#fullname").val().length > 0) {
        $fullname.addClass("is-valid");
        $fullname.removeClass("is-invalid");
    } else {
        $fullname.addClass("is-invalid");
        $fullname.removeClass("is-valid");
        errorMessage +=
            "<small class='d-block'>El Campo Nombre es obligatorio</small>";
        errocounter++;
    }

    //Validaciuon para campo EMAIl
    if ($("#email").val().length > 0) {
        if (!EmailValidate()) {
            errorMessage += "El email invalido";
            $email.addClass("is-invalid");
            $email.removeClass("is-valid");
            errocounter++;
        } else {
            $email.addClass("is-valid");
            $email.removeClass("is-invalid");
        }
    } else {
        $email.addClass("is-invalid");
        $email.removeClass("is-valid");
        errorMessage +=
            "<small class='d-block'>El campo email es obligatorio</small>";
        errocounter++;
    }

    if (!$("#formCheck").is(":checked")) {
        $politicas.addClass("is-invalid");
        $politicas.removeClass("is-valid");
        errorMessage +=
            "<small class='d-block'> Debes aceptar las politicas de Proteccion de Datos <br><a class='text-info' href='politicas.html' target='_blank'>Mas Info aqui</a></small>";
        errocounter++;
        //console.log("Chequeado...");
    } else {
        $politicas.addClass("is-valid");
        $politicas.removeClass("is-invalid");
    }

    if (errorMessage == 0) {
        //Se procede a enviar el Formulario
        $fullname.removeClass("is-valid");
        $email.removeClass("is-valid");
        $politicas.removeClass("is-valid");
        $.post(
            "./process/redireccionarEmail.php", {
                nombre: $fullname.val(),
                correo: $email.val(),
                telefono: $telefono.val(),
                infoad: $infoadd.val(),
                idform: $idform.val(),
                //bandera: 'enviarEmail',
            },
            function (message) {
                $fullname.removeClass("is-valid");
                $email.removeClass("is-valid");
                $politicas.removeClass("is-valid");
                if (message == '1') {
                    Swal.fire({
                        icon: "success",
                        title: "Formulario Enviado",
                        html: "Se ha enviado correctamente",
                        //footer: message,
                    });
                    $fullname.val("");
                    $email.val("");
                    $telefono.val("");
                    $infoadd.val("");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oooops",
                        html: "Algo paso, no hemos podido enviar el Formulario, puedes contactarnos a estos Telefonos: 3095593 - (314)5417743 - (301)7426340",
                        //footer: message,
                    });
                }

            }
        );
    } else {
        //No se envia el formulario
        Swal.fire({
            icon: "error",
            title: "No Se puede Enviar la Informacion del Formulario...",
            html: errorMessage,
            //footer: "<a href>Why do I have this issue?</a>",
        });
    }
});

// $.post("./procesar.php", {
//             nombre: $nombre.val(),
//             correo: $correo.val(),zs
//             edad: $edad.val(),
//         }, function(respuestaComoJson) {
//             // La decodificamos
//             let respuesta = JSON.parse(respuestaComoJson);
//             $respuesta.html(respuesta);
//         })