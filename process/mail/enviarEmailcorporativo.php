<?php

namespace mail\enviarEmailcorporativo;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpMailer/src/Exception.php';
require_once 'phpMailer/src/PHPMailer.php';
require_once 'phpMailer/src/SMTP.php';



class enviarEmailcorporativo
{

    const REMITENTE = "webmaster@apunidos.com";
    const HOST = "mail.apunidos.com";
    const MY_PASSWORD = "S1st3m4s*";
    const PORT = 465;

    public $fullname;
    public $destinatario;
    public $remitente;
    public $telefono;
    public $infoadd;
    public $idform;
    //public $body;

    public function __construct($fullname, $correoDestinatario, $telefono = "Sin Telefono", $infoadd = "Sin Info Adicional", $idform)
    {
        $this->fullname = $fullname;
        $this->destinatario = $correoDestinatario;
        $this->remitente = self::REMITENTE;
        $this->telefono = $telefono;
        $this->infoadd = $infoadd;
        $this->idform = $idform;
        //$this->body =  file_get_contents('single-news.html');
    }

    public function returnData()
    {
        return ($this->telefono);
    }

    public function sendEmail()
    {

        $mail = new PHPMailer(true);

        try {
            //Server settings

            $mail->isSMTP();
            $mail->Host = self::HOST;
            $mail->SMTPAuth = true;
            $mail->Username = self::REMITENTE;
            $mail->Password = SELF::MY_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = self::PORT;

            //Recipients
            $mail->setFrom(self::REMITENTE, 'WebMaster');
            //$mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('webmaster@apunidos.com', 'Representante de ventas');
            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('aryeteinc@hotmail.com');
            //$mail->addBCC('bcc@example.com');
            //$mail->addEmbeddedImage(dirname(__FILE__) . '/imagesemail/LOGO-TRANSP-APUNIDOS-768x432.png', 'logo');
            //$mail->addEmbeddedImage(dirname(__FILE__) . '/imagesemail/pngocean.png', 'instagram');
            //$mail->addEmbeddedImage(dirname(__FILE__) . '/imagesemail/pngocean2.png', 'facebook');
            //$mail->addEmbeddedImage(dirname(__FILE__) . '/imagesemail/pngocean3.png', 'youtube');

            // Attachments
            //$mail->addAttachment('/Applications/MAMP/htdocs/apunidos/assets/img/LOGO-TRANSP-APUNIDOS-768x432.png');         // Add attachments
            //Applications/MAMP/htdocs/apunidos/assets/img/LOGO-TRANSP-APUNIDOS-768x432.png
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Solicitud Informacion de proyectos APUnidos..' . $this->fullname;

            $mail->Body    = $this->fullname . " acaba de solicitar informacion de uno de nuestros proyectos, lo hizo atravez del formulario de la pagina <b>" . $this->idform . "</b><br>";
            $mail->Body    .=  "dejo como telefono de contacto => " . $this->telefono . "<br>";
            $mail->Body    .=  "el email de contacto es  => " . $this->destinatario . "<br>";
            $mail->Body    .=  "El o Ella esta solicitando Informacion relacionada a lo siguiente  => " . $this->infoadd . "<br>";

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->send();
            echo '1';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
