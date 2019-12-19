
<link rel="stylesheet" type="text/css" href="css/micss.css">
<?PHP
include_once 'conectarBD.php';

abrirBD();

$a = $_GET['a'];

// Busqueda de la receta
$resultado = busquedaReceta($a);

// Busqueda del nombre del chef
$resultado2 = busquedaNombreChef($resultado);

// Busqueda del nombre del grupo
$resultado3 = busquedaNombreGrupo($resultado);

print ("<TABLE>\n");

print ("<TR>\n");
print ("<TD>" . $resultado['nombre'] . "</TD>\n");
print ("<TD>CHEF: " . $resultado2['nombreChef'] . " " . $resultado2['apellido1'] . " </TD>\n");
print ("<TD></TD>\n");
print ("</TR>\n");

print ("<TR>\n");
print ("<TD>GRUPO: " . $resultado3['nombreGrupo'] . "</TD>\n");
print ("<TD>DIFICULTAD :" . $resultado['dificultad'] . "</TD>\n");
print ("<TD>TIEMPO: " . $resultado['tiempo'] . " minutos </TD>\n");
print ("</TR>\n");

print ("<TR>\n");
print ("<TD>ELABORACIÓN: " . $resultado['elaboración'] . " </TD>\n");
print ("<TD></TD>\n");
print ("<TD></TD>\n");
print ("</TR>\n");

print ("</TABLE>\n");

// Busqueda del número de ingredientes
$nfilasIngredientes = busquedaNumIngredientes($a);

print("<h3> NECESITAREMOS $nfilasIngredientes INGREDIENTES </h3>");

// Busqueda de ingredientes
$consultaIngredientes = busquedaIngredientes($a);
while ($fila = mysqli_fetch_array($consultaIngredientes)) {

    // Busqueda de ingrediente    
    $resultnombreIngrediente = busquedaIngrediente($fila);
    print ("<p class=ingredientes>" . $resultnombreIngrediente["nombreIngrediente"] . " " . $fila["cantidad"] . " " . $fila["medida"] . "</p>\n");
}



mysqli_close($conexion);
