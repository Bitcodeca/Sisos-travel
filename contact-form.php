<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '/home2/paginasw/public_html/sisostravel.com.ve/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['message'])) {

    //check if any of the inputs are empty
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['telefono']) || empty($_POST['message'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->From = $_POST['email'];
    $mail->FromName = $_POST['nombre'];
    $mail->AddAddress('sisotravel@gmail.com');
    $mail->Subject = 'Contacto sisostravel.com';
    $mail->Body = "Nombre: " . $_POST['nombre'] . "\r\n\r\nEmail: " . $_POST['email'] . "\r\n\r\nMensaje: " . stripslashes($_POST['message']);
    
    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'enviado');
    echo json_encode($data);

} else {
    $data = array('success' => false, 'message' => 'Por favor, termine de llenar el formulario.');
    echo json_encode($data);
}