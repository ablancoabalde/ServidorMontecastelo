<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
        <link rel="stylesheet" href="css/myCss.css" type="text/css">
    </head>
    <body>
        <h2>Programa una aplicación sencilla para que los usuarios puedan subir sus propias imágenes al servidor web.
            La aplicación se compone de dos páginas programadas en PHP. La primera
            página, "registro.php", contiene dos formularios:</h2>

        <form action="Ejercicio3_Exist.php" method="get">
            <h4>Usuario existente:</h4>
            <div class="txtsBox">
                <label for="name">Nombre:</label>           
                <input id="name" type="text" name="txtName" minlength="4" maxlength="12" required>
                <label for="password">Contraseña:</label>            
                <input id="password" type="password" name="txtPassword" minlength="6" required>  
            </div>
            <div class="buttonBox">
                <input type="submit" value="Enviar">
            </div>


        </form>
        <form action="Ejercicio3_New.php" method="post">

            <h4>Nuevo usuario:</h4>
            <div class="txtsBox">
                <label for="name">Nombre:</label>           
                <input id="name" type="text" name="txtNewName" minlength="4" maxlength="12" required>
                <label for="password">Contraseña:</label>           
                <input id="password" type="password" name="txtNewPassword" minlength="6" required> 
                <label for="rePassword">Repita la contraseña:</label>           
                <input id="rePassword" type="password" name="txtRePassword" minlength="6" required>  
            </div>
            <div class="buttonBox">
                <input type="submit" value="Enviar">
            </div>

        </form>



    </body>
</html>
