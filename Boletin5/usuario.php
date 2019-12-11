<?php

require_once 'iUsuario.php';
defined('FICH') ? null : define('FICH', __DIR__ . '/usuarios.txt');

class Usuario implements iUsuario {

    private $nombre; // String
    private $permanente; // Boolea
    private $segsInactividad; // Int
    private $fechaCaducidad; // Int
    public static $salt = "supercalifragilistico";

    function __construct() {
        
    }

    function construct($nombre, $permanente, $segsInactividad, $fechaCaducidad) {
        $this->nombre = $nombre;
        $this->permanente = $permanente;
        $this->segsInactividad = $segsInactividad;
        $this->fechaCaducidad = $fechaCaducidad;
    }

    protected static function hash_usuario($nombre) {
        $f = fopen(FICH, 'r');
        if ($f) {
            while (!feof($f)) {
                $txt = trim(fgets($f));
                if ($nombre == $txt) {
                    $hash = trim(fgets($f));
                    fclose($f);
                    return $hash;
                }
                fgets($f);
            }
        }
        return false;
    }

    public function init() {

        if (empty($_SESSION['nombre_usuario'])) {
            // Comprobamos se existen las cookies para recuperar unha sesión anterior
            if (isset($_COOKIE['login']) && isset($_COOKIE['hash'])) {

                $this->recupera_sesion($_COOKIE['login'], $_COOKIE['hash']);
            }
        }

        if (!empty($_SESSION['nombre_usuario'])) {

            // Comprobamos si caducó la sesión
            if (isset($_SESSION['ultima_actividad']) && isset($_SESSION['tiempo_caducidad']) && (time() - $_SESSION['ultima_actividad'] > $_SESSION['tiempo_caducidad'])) {

                session_unset();
                session_destroy();
            }

            $_SESSION['ultima_actividad'] = time();
        }
        // header('Location: login.php');
    }

    public function recupera_sesion($nombre, $hash) {

        $texto = $nombre . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'];

        if ($hash == crypt($texto, self::$salt)) {
            // Recuperamos la sesión del usuario
            $_SESSION['nombre_usuario'] = $nombre;
            $_SESSION['mantener_registrado'] = true;
        }
    }

    public function registrar($nombre, $password, $password2) {
        try {
            // Comprobamos que las contraseñas sean iguales
            if ($password !== $password2) {
                throw new RuntimeException('Las contraseñas no coinciden');
            }

            // Comprobamos que no exista el nombre de usuario
            if ($this::hash_usuario($nombre)) {
                throw new RuntimeException('El nombre de usuario ya existe');
            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
            exit();
        }
        // Registramos al nuevo usuario
        $hash = crypt($password, self::$salt);
        $texto = $nombre . PHP_EOL . $hash . PHP_EOL;
        try {
            $f = fopen(FICH, 'a+');
            if (fwrite($f, $texto)) {
                return true;
            } else {
                return false;
            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function login($nombre, $password, $inactividad = 0) {
        $hash_guardado = $this::hash_usuario($nombre);
        if ($hash_guardado && password_verify($password, $hash_guardado)) {
            return true;
        } else {
            return false;
        }
    }

    public function caduca() {
        if ($this->fechaCaducidad != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function esPermanente() {
        if ($this->permanente == true) {
            return true;
        } else {
            return false;
        }
    }

    public function getCaducidad() {
        return $this->fechaCaducidad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function logout() {
        // Log out
        session_unset();
        session_destroy();
        // Quitamos las cookies para la sesión permanente, si existen
        setcookie("login", '', time() - 3600);
        setcookie("hash", '', time() - 3600);
    }

    public function mantenerLogin() {
        $texto = $_SESSION['nombre_usuario'] . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'];
        setcookie("login", $_SESSION['nombre_usuario'], time() + 3600 * 24 * 14);
        setcookie("hash", crypt($texto, self::$salt), time() + 3600 * 24 * 14);
    }

    public function volver() {
        header('Location: login.php');
    }

}
