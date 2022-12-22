<?php
session_start();
if (isset($_REQUEST['volverPrograma'])) {
    header('Location: programa.php');
    exit;
}
//Array para cambiar idioma del header.
$aIdiomaHTML = [
    'es' => [
        'login' => 'Acceso a la aplicación',
        'programa' => 'Proyecto Login-Logoff',
        'detalle' => 'Variables superglobales y phpinfo()'
    ],
    'en' => [
        'login' => 'Application access',
        'programa' => 'Login-Logoff Project',
        'detalle' => 'Superglobal variables and phpinfo()'
    ],
    'pt' => [
        'login' => 'Acesso à aplicação',
        'programa' => 'Projeto Login-Logoff',
        'detalle' => 'Variáveis superglobais e phpinfo()'
    ],
];
?>
<!DOCTYPE html>
<html lang="<?php echo $_COOKIE['idioma'] ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Ricardo Santiago Tomé">
        <link rel="stylesheet" href="../webroot/css/estilosEjercicio00.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" sizes="96x96" href="../../webroot/images/favicon-96x96.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>LoginLogoff detalle.php</title>
        <style>
            *{
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <header class="headerPropio">
            <h1>Aplicación LoginLogoffTema5</h1>
            <h2>detalle.php</h2>
        </header>
        <main>
            <article>
                <h3>Enunciado: Detalle</h3>
                <form name="ejercicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" id="volverPrograma" value="Volver" name="volverPrograma">
                    </tr>
                    </table>
                </form>
                <?php
                /**
                 * @author Ricardo Santiago Tomé - RicardoSantom en Github https://github.com/RicardoSantom
                 * @version 1.0
                 * @since 28/10/2022
                 */

                /**
                 * Esta función recibe dos parámetros, con ellos construye una tabla, evalua si el primer parámetro recibido
                 * es null o está vacío; en caso de que así sea, devuelve un mensaje impreso por pantalla declarando que
                 * no hay nada que mostrar de esta variable superglobal, si no, construye una fila por cada pareja de variable - valor 
                 * imprimiendo el valor de cada una de ellas en una celda diferente.
                 *  Esta impresión la realiza con print_r pasándole como primer parámetro en una ocasión el nombre de la variable 
                 * y en otra el valor de esta, y como segundo parámetro un valor booleano que si está establecido a true no mostrará
                 * el primer parámetro, por contra, si está establecido a false si lo mostrará.
                 * @author Ricardo Santiago Tomé - RicardoSantom en Github https://github.com/RicardoSantom
                 * @version 1.0
                 * @since 05/11/2022
                 * @param array $aVariableSuperglobal array que contiene datos de la variable superglobal. Como parámetro la pasamos con el 
                 *  identificador de dicha variable superglobal.
                 * @param string $sNombreVariableSuperGlobal nombre de la variable superglobal abriendo comillas seguidas por la secuencia
                 * de escape \ y a continuación el identificador de la variable supeglobal y para finalizar, cerramos con comillas.
                 */
                if (!empty($_SESSION)) {
                    echo "<table><caption>\$_SESSION'</caption><tr><th>Clave</th><th>Valor</th></tr>";
                    foreach ($_SESSION as $clave => $valor) {
                        echo "<tr>";
                        echo "<td><strong>$clave</strong></td>";
                        if (is_object($valor)) {
                            echo '<td><table><th>Clave</th><th>valor</th>';
                            foreach ($valor as $c => $v) {
                                echo "<tr><th>$c</th>";
                                echo "<td>$v</td></tr>";
                            }
                            echo"</table></td>";
                        } else {
                            echo "<td>" . $valor . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";

                    echo "</br>";
                } else {
                    printf('<h3>La variable superglobal $_SESSION está vacía</h3>');
                }
                function imprimirTablaVariablesSuperGlobales($aVariableSuperglobal, $sNombreVariableSuperGlobal) {

                    printf('<table class="tablaGlobales"><caption>%s</caption>', $sNombreVariableSuperGlobal);
                    if (is_null($aVariableSuperglobal) || empty($aVariableSuperglobal)) {
                        printf('<thead><th  style="border:none;color:red;text-align:center;">La variable superglobal %s está vacía</th></thead>', $sNombreVariableSuperGlobal);
                    } else {
                        foreach ($aVariableSuperglobal as $nombreSuperglobal => $valorSuperglobal) {
                            if ($nombreSuperglobal == '_SESSION') {
                                echo "<h3>La variable $_SESSION esta vacía.</h3>";
                            } else {
                                if ($nombreSuperglobal == '_SERVER') {
                                    print("<tr>");
                                    print '<td>';
                                    print($sNombreVariableSuperGlobal);
                                    print '</td>';
                                    print '<td>';
                                    echo '<table>';
                                    foreach ($_SERVER as $claveServer => $valorServer) {
                                        echo '<tr>';
                                        print '<td>';
                                        print_r($claveServer);
                                        print '</td>';
                                        print '<td>';
                                        print_r($valorServer);
                                        print '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                    print '</td>';
                                } else {
                                    echo "<tr><th>";
                                    print_r($nombreSuperglobal, $booleanoSuperglobal = false) . "</th>";
                                    echo "<td>";
                                    print_r($valorSuperglobal, $booleanoSuperglobal2 = false) . "</td>";
                                    print "</tr>";
                                }
                            }
                        }
                        echo "</table>";
                    }
                }

                
                imprimirTablaVariablesSuperGlobales($_COOKIE, "\$_COOKIE");
                imprimirTablaVariablesSuperGlobales($_SERVER, "\$_SERVER");
                imprimirTablaVariablesSuperGlobales($_REQUEST, "\$_REQUEST");
                imprimirTablaVariablesSuperGlobales($GLOBALS, "\$_GLOBALS");
                imprimirTablaVariablesSuperGlobales($_FILES, "\$_FILES");
                imprimirTablaVariablesSuperGlobales($_ENV, "\$_ENV");
                imprimirTablaVariablesSuperGlobales($_POST, "\$_POST");
                imprimirTablaVariablesSuperGlobales($_GET, "\$_GET");
                ?>
                <?php phpinfo();
                ?>
            </article>
        </main>
        <footer>
            <p>2022-23  IES LOS SAUCES. <a href="../../../index.html" id="enlacePrincipal" title="Enlace a Index Principal">Ricardo Santiago Tomé</a> © Todos los derechos reservados</p>
            <a href="https://github.com/RicardoSantom/208DWESLoginLogoffTema5" target="blank" id="github" title="RicardoSantom en GitHub">
            </a>
            <a href="https://www.linkedin.com/in/ricardo-santiago-tom%C3%A9/" id="linkedin" title="Ricardo Santiago Tomé en Linkedim" target="_blank"></a>
            <a href="../../doc/curriculumRicardo.pdf" class="material-icons" title="Curriculum Vitae Ricardo Santiago Tomé" target="_blank" id="curriculum"><span class="material-icons md-18">face</span></a>
            <a href="../../208DWESproyectoDWES/index.php" id="enlaceSecundario" title="Enlace a Index DWES">Index DWES</a>
        </footer>
    </body>
</html>