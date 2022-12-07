<?php
/**
 * @author David Aparicio Sir davidas02 en GitHub <https://github.com/davidas02>, Ricardo Santiago Tomé RicardoSantom en GitHub<https://github.com/RicardoSantom>
 * @version 1.0
 * @since 02/12/2022
 * Description Control de acceso en función header() a una aplicación.
 */
//Inclusión librería validación y fichero configuración base de datos.
require_once '../core/validacionFormularios.php';
require_once '../config/confDB.php';
//Booleano para comprobar si los datos introducidos son correctos
$entradaOK = true;
//Constantes para funciones de validación de formularios
define("MAX_TAMANYO", 8);
define("MIN_TAMANYO", 4);
define("OBLIGATORIO", 1);
define("OPCIONAL",0);
//Array de respuestas para guardar los valores de los input.
/* $aRespuestas = [
  'usuario' => "",
  'password' => ""
  ]; */
//Array de errores para guardar los valores de los input.
$aErrores = [
    'usuario' => "",
    'password' => ""
];
$sQuerySeleccion = <<< query
    SELECT * FROM T01_Usuario WHERE T01_CodUsuario=:codUsuario;
query;
//Comentado para posterior trabajo con fecha y hora de última conexión.
/* $sQueryActualizacion = <<< query
  UPDATE T01_Usuario SET T01_NumConexiones=T01_NumConexiones+1,T01_FechaHoraUltimaConexion=now() WHERE T01_CodUsuario=:codUsuario;
  query;
  $ultimaConexion = null; */

//Comprobamos si ha pulsado el botón de Iniciar Sesion
try {
    if (isset($_REQUEST['iniciarSesion'])) {
        //Crear un objeto PDO pasándole las constantes definidas como parametros.
        $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
        $aErrores['usuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'], MAX_TAMANYO,MIN_TAMANYO, OBLIGATORIO);
        $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'],MAX_TAMANYO, MIN_TAMANYO, OBLIGATORIO);
        foreach ($aErrores as $claveError => $mensajeError) {
            if ($mensajeError != null) {
                $entradaOK = false;
            }
        }
        if ($entradaOK) {
            $queryConsultaPorCodigo = $DB208DWESLoginLogoffTema5->prepare($sQuerySeleccion);
            $queryConsultaPorCodigo->bindParam(':codUsuario', $_REQUEST['usuario']);
            $queryConsultaPorCodigo->execute();
            $oUsuario = $queryConsultaPorCodigo->fetchObject();
            //Comprobación de contraseña correcta o incorrecta
            if (!$oUsuario || $oUsuario->T01_Password != hash('sha256', ($_REQUEST['usuario'] . $_REQUEST['password']))) {
                $entradaOK = false;
            }
        }
    } else {
        $entradaOK = false;
    }
} catch (PDOException $excepcion) {
    echo 'Error: ' . $excepcion->getMessage() . "<br>";
    echo 'Código de error: ' . $excepcion->getCode() . "<br>";
} finally {
    unset($DB208DWESLoginLogoffTema5);
}
if ($entradaOK) {
    try {
        //Comentado para posterior trabajo con fecha y hora e última conexión.
        /* $ultimaConexion=$oUsuario->T01_FechaHoraUltimaConexion;
          $_SESSION['UltimaConexionDAW201AppLoginLogoff'] = $ultimaConexion;
          $queryActualizacion = $DB208DWESLoginLogoffTema5->prepare($actualizacionConexiones); */
        $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
        $queryActualizacion->bindParam(":codUsuario", $oUsuario->T01_CodUsuario);
        $queryActualizacion->execute();
        $queryConsultaPorCodigo = $DB208DWESLoginLogoffTema5->prepare($buscaUsuarioPorCodigo);
        $queryConsultaPorCodigo->bindParam(':codUsuario', $_REQUEST['usuario']);
        $queryConsultaPorCodigo->execute();
        $oUsuario = $queryConsultaPorCodigo->fetchObject();
    } catch (PDOException $excepcion) {
        echo $excepcion->getMessage();
    } finally {
        unset($DB208DWESLoginLogoffTema5);
    }
    session_start();
    $_SESSION['usuarioDAW208LoginLogoffTema5'] = $_REQUEST['usuario'];
    header('Location: ./programa.php');
    die();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="robots" content="index, follow">
            <meta name="author" content="Ricardo Santiago Tomé">
            <link rel="stylesheet" href="../webroot/css/estilos.css"/>
            <link href="../webroot/css/estilosPlantilla.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="icon" type="image/png" sizes="96x96" href="../../webroot/images/favicon-96x96.png">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <title>LoginLogoff login.php</title>
        </head>
        <body>
            <header>
                <h1>Aplicación LoginLogoffTema5</h1>
                <h2>login.php</h2>
            </header>
            <main>
                <article>
                    <h3>Enunciado: Login Variables superglobales y phpinfo()</h3>
                    <form name="ejercicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset>
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" class="entradadatos"/>
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="entradadatos" />
                            <input type="submit" id="iniciarSesion" value="Iniciar Sesion" name="iniciarSesion">
                        </fieldset>
                    </form>
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
<?php } ?>