<?PHP

// Variable que guarda la conexión con la base de datos
$conexion;
// Establecer el número de filas por página y la fila inicial
$num = 8; // número de filas por página
// La variable comienzo será un número, que se utiliza para el paginado
$comienzo;

// Si la variable $_REQUEST['comienzo'] existe, el número que contenga
//  lo almacena en comienzo para luego trabajar con él
if (isset($_REQUEST['comienzo'])) {
    $comienzo = $_REQUEST['comienzo'];
} else {
    $comienzo = 0;
}

// Conectar con el servidor de base de datos
function abrirBD() {
    global $conexion;
    //mysqli_connect( Ruta, NombreUsuario, Contraseña, BasedeDatos) or die significa que no pudo acceder a la base por cualquier motivo
    $conexion = mysqli_connect("localhost", "root", "", "recetas") or die("No se puede conectar con el servidor");
    $conexion->set_charset("utf8");
}

// Calcular el número total de filas de la tabla
function calcNumFilas() {
    global $conexion;
    global $num;
    global $comienzo;

    $instruccion = "select * from receta";
    $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta de calcular filas");
    $nfilas = mysqli_num_rows($consulta);
    // Si el número de filas es mayor que 0
    if ($nfilas > 0) {
        // Mostrar números inicial y final de las filas a mostrar
        print ("<P>Mostrando Recetas " . ($comienzo + 1) . " a ");
        // Si 1 + 8 es menor que el número de filas que en este caso las filas devueltas son 16
        if (($comienzo + $num) < $nfilas) {
            // Lo que muestra por pantalla
            //Mostrando Recetas 1 a 8 de un total de 16. [ Anterior | Siguiente ]
            // El 8 es lo que indica este print
            print ($comienzo + $num);
        } else {
            // Lo que muestra por pantalla cuando ya no hay más siguiente que pulsar
            //Mostrando Recetas 9 a 16 de un total de 16. [ Anterior | Siguiente ]
            // El 16 es lo que indica este print
            print ($nfilas);
        }
        print (" de un total de $nfilas.\n");

        // Mostrar botones anterior y siguiente
        // El valor de $_SERVER['PHP_SELF'] en un script ejecutado en la dirección http://example.com/foo/bar.php será /foo/bar.php
        // En nuestro caso Boletin6/listadoRecetas.php
        $estapagina = $_SERVER['PHP_SELF'];
        // Condición que sí comienzo en mayor que cero haga enlace a la palabra anterior para que se pueda pulsar y volver atras
        // $comienzo aun sigue valiendo 0, pues el $_REQUEST aun no se inicio
        if ($comienzo > 0) {
            // Aqui se setea la $_REQUEST a negativo, que en nuestro caso solo hay 2 páginas el valor de $_REQUEST acaba en 0
            // cuándo pulsas el botón anterior
            print ("[ <A HREF='$estapagina?comienzo=" . ($comienzo - $num) . "'>Anterior</A> | ");
            // El valor aparece en la URL
            // Página 1
            // http://localhost/Servidor/Boletin6/listadoRecetas.php?comienzo=0
        } else {
            // si no que pinte la palabra anterior, como texto plano
            print ("[ Anterior | ");
        }
        // Condición que sí $nfilas(16) en mayor que ($comienzo(0)+$num(8) haga enlace a la palabra siguiente para que se pueda pulsar y continuar viendo las recetas
        if ($nfilas > ($comienzo + $num)) {
            // Aqui se setea la $_REQUEST a positivo, que en nuestro caso solo hay 2 páginas el valor de $_REQUEST acaba en 8
            // cuándo pulsas el botón anterior
            print ("<A HREF='$estapagina?comienzo=" . ($comienzo + $num) . "'>Siguiente</A> ]\n");
            // El valor aparece en la URL
            // Página 2
            // http://localhost/Servidor/Boletin6/listadoRecetas.php?comienzo=8
        } else {
            print ("Siguiente ]\n");
        }

        print ("</P>\n");
    }
}

// función que hace todas las consultas para devolver lo que se quiere mostrar
function consulta() {
    global $conexion;
    global $num;
    global $comienzo;

    // Enviar consulta
    // R.*(tabla recetas.todo), C.nombre(tabla chef.nombre) AS nombrechef ( aplico pseudonimo, quiero decir que esto C.nombre(tabla chef.nombre) lo voy a poder llamar con nombrechef
    // FROM chef C ( que la tabla en la consulta para acortar y difenciar la voy a llamar C) y lo mismo para receta R order by ordeno la lista por receta.nombre
    // limit $comienzo, $num ( de 0, a 8)
    $instruccion = "SELECT R.*, C.nombre  AS nombreChef, C.apellido1 FROM chef C, receta R WHERE R.cod_chef = C.codigo  order by  R.nombre asc limit $comienzo, $num";
    $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta de datos");
    print("<h2> Listado de recetas </h2>");

    // Mostrar resultados de la consulta devuelve 8 filas por el limit
    $nfilas = mysqli_num_rows($consulta);

    // Condición para comprobar que devuelve filas
    if ($nfilas > 0) {
        print ("<TABLE>\n");
        print ("<TR>\n");
        print ("<TH>Receta</TH>\n");
        print ("<TH>Chef</TH>\n");
        print ("<TH></TH>\n");

        print ("</TR>\n");

        for ($i = 0; $i < $nfilas; $i++) {
            // mysqli_fetch_array devuelve todos los resultados en un array
            $resultado = mysqli_fetch_array($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado["nombre"] . "</TD>\n");
            print ("<TD>" . $resultado['nombreChef'] . " " . $resultado['apellido1'] . "</TD>\n");
            $a = $resultado['codigo']; // Guardo el código de la receta en una variable para pasarla por la URL
                            // URL con el código para el enlace Más información
                            // Lo que se ve por pantalla en la URL
                            // http://localhost/Servidor/Boletin6/fichareceta.php?a=3
            print ("<TD>" . "<a HREF='fichareceta.php?a=$a'>" . 'Más información' . "</a>" . "</TD>\n");
            print ("</TR>\n");
        }

        print ("</TABLE>\n");
    } else {
        print ("No hay recetas disponibles");
    }
}

// función cerrar conexión
function cerrarConexion() {
    global $conexion;
    mysqli_close($conexion);
}

// Funciones para FichaRecetas los parametros de las funciones salen de fichaReceta.php
// Busqueda de la receta
function busquedaReceta($a) {
    global $conexion;
    $instruccion = "SELECT * FROM receta R WHERE codigo =$a";
    $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta");
    $resultado = mysqli_fetch_array($consulta);
    return $resultado;
}

// Busqueda del nombre del chef
function busquedaNombreChef($resultado) {
    global $conexion;
    $instruccion2 = "SELECT nombre AS nombreChef, apellido1 FROM chef WHERE codigo = " . $resultado['cod_chef'] . " ";
    $consulta2 = mysqli_query($conexion, $instruccion2) or die("Fallo en la consulta");
    $resultado2 = mysqli_fetch_array($consulta2);
    return $resultado2;
}

// Busqueda del nombre del grupo
function busquedaNombreGrupo($resultado) {
    global $conexion;
    $instruccion3 = "SELECT nombre AS nombreGrupo FROM grupo WHERE codigo = " . $resultado['cod_grupo'] . " ";
    $consulta3 = mysqli_query($conexion, $instruccion3) or die("Fallo en la consulta");
    $resultado3 = mysqli_fetch_array($consulta3);
    return $resultado3;
}

// Busqueda del número de ingredientes
function busquedaNumIngredientes($a) {
    global $conexion;
    $instruccionIngredientes = "SELECT * FROM receta_ingrediente WHERE cod_receta= $a ";
    $consultaIngredientes = mysqli_query($conexion, $instruccionIngredientes) or die("Fallo en la consulta");
    $nfilasIngredientes = mysqli_num_rows($consultaIngredientes);
    return $nfilasIngredientes;
}

// Busqueda de ingredientes
function busquedaIngredientes($a) {
    global $conexion;
    $instruccionIngredientes = "SELECT * FROM receta_ingrediente WHERE cod_receta= $a ";
    $consultaIngredientes = mysqli_query($conexion, $instruccionIngredientes) or die("Fallo en la consulta");
    return $consultaIngredientes;
}

// Busqueda de ingrediente
function busquedaIngrediente($fila) {
    global $conexion;
    $nombreIngrediente = "SELECT nombre AS nombreIngrediente FROM ingrediente WHERE codigo= " . $fila['cod_ingrediente'] . "";
    $consultaNombreIngrediente = mysqli_query($conexion, $nombreIngrediente) or die("Fallo en la consulta");
    $resultnombreIngrediente = mysqli_fetch_array($consultaNombreIngrediente);
    return $resultnombreIngrediente;
}
