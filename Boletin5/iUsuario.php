<?php

interface iUsuario{
    
    function init();
    
    function registrar($nombre,$password,$password2);
    
    function login($nombre,$password,$inactividad=0);
    
    function getNombre();
    
    function getCaducidad();
    
    function esPermanente();
    
    function caduca();
    
    function logout();
    
    function mantenerLogin();    
}
