<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$errores = '';
$enviado = '';

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    if(!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }else {
        $errores .= 'Por favor ingresa un nombre <br />';
    }

    if(!empty($correo)){
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $errores .= 'Por favor ingresa un correo valido <br />';
        }
    }else{
        $errores .= 'Por favor ingresa un correo <br />';
    }

    if(!empty($mensaje)){
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje);
        $mensaje = stripslashes($mensaje); #con estos 3 comandos se evita que el usuario inyecte codigo 
    }else{
        $errores .= 'Porfavor Ingrese el mensaje';
    }

    if(!$errores){
        $enviar_a = 'tunombre@tuempresa.com';
        $asunto = 'Correo enviado desde miPAgina.com';
        $mensaje_preparado = 'De: '. $nombre.'\n';
        $mensaje_preparado .= 'Correo: '. $correo . '\n';
        $mensaje_preparado .= 'Mensaje: '. $mensaje . '\n';

        mail($enviar_a, $asunto, $mensaje_preparado);
        $enviado = 'true';
    }
}

require 'index.view.php';

?>