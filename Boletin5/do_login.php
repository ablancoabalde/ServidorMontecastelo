<?php

session_start();
//require_once('funciones.php');
require_once('usuario.php');

$usuario = new Usuario();



if (!empty($_POST)) {
    if (!empty($_POST['contrasenha2'])) {
        // Novo rexistro
        $usuario->registrar($_POST['nombreusuario'], $_POST['contrasenha'], $_POST['contrasenha2']);
    } else if (!empty($_POST['nombreusuario'])) {
        // Log in
        if ($usuario->login($_POST['nombreusuario'], $_POST['contrasenha'])) {
            $_SESSION['nombre_usuario'] = $_POST['nombreusuario'];
            // Comprobamos si se definió un tiempo de caducidad de la sesión
            if (!empty($_POST['tiempo_caducidad'])) {
                if ($_POST['tiempo_caducidad'] > 0)
                    $_SESSION['tiempo_caducidad'] = $_POST['tiempo_caducidad'];
                else
                    unset($_SESSION['tiempo_caducidad']);
            }
            // Comprobamos si se definió la creación de una sesión permanente
            if (!empty($_POST['mantener_registrado']) && $_POST['mantener_registrado'] == true) {
                    $usuario->mantenerLogin();
//                $texto = $_SESSION['nombre_usuario'] . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'];
//                setcookie("login", $_SESSION['nombre_usuario'], time() + 3600 * 24 * 14);
//                setcookie("hash", crypt($texto, $salt), time() + 3600 * 24 * 14);
            }
            $_SESSION['mantener_registrado'] = $_POST['mantener_registrado'];
        }
    }


    if (!empty($_POST['logout'])) {
        $usuario->logout();
    }
}
header('Location: login.php');
?>