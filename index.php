<?php
/* Aqui vamos a comprobar si el formulario fue enviado */
$errores = '';
$enviado = '';
/* isset detemina si una variable esta efinida  y no es null */
if (isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    /*  empty nos ayuda a saber si hay contenido en una variable
        y con el signo ! le decimos si no hay o ( SI ES DIFERENTE )

        trim: quita los espacios que fueron guardos en una vaiable al inico o final
        filter_var()    Nos permite sanear, osea eliminar caracteres que no nos sirven HTML
    */
    if (!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }  else {
        /*  el simbolo .= le estamos diciento que la variable $errores  
            nos concatene el texto siguiente con el salto de linea
        */
        $errores .= 'Porfavor ingresa un nombre <br />';
    }

    /* ------------------------------------------------------------- */
    /* Vaidacion de correo */
    if (!empty($correo)) {
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

        /*  Esta funcion con este parametro nos regresa verdadero o falso */
        /*  En !filter_var estamos pregundo si encuentras un texto que
            no es un correo entonces, queremos que hagas lo siguiente
        */
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $errores .= 'Por favor ingresa un correo valido <br />';
        } 
        
    } else {
            $errores .= 'Por favor ingresa un correo <br />';
    }
    /* ------------------------------------------------------------- */
    /* Validacion de mensaje */
    if (!empty($mensaje)) {
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje);
        $mensaje = stripslashes($mensaje);
    } else {
        $errores .= 'Por favor ingresa el mensaje <br />'; 
    }
    /* ------------------------------------------------------------- */
    /* Vamos a preguntar si hay errores */

    if (!$errores) {
        $enviar_a = '1510.lalo.51@gmail.com';
        $asunto = 'Correo enviado desde MiPagina.com';
        $mensaje_preprarado = "De: $nombre \n";
        $mensaje_preprarado .= "Correo: $correo \n";
        $mensaje_preprarado .= "Mensaje: " . $mensaje;

        mail($enviar_a, $asunto, $mensaje_preprarado);
        $enviado = 'true';
    }


}

require 'contacto.php';
?>