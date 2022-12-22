<?php
//Navegación a registro.php
if (isset($_REQUEST['registro'])) {
    header('Location: registro.php');
    exit;
}

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
define("OPCIONAL", 0);
//Array de errores para evaluar si son correctos los valores de los input.
$aErrores = [
    'usuario' => null,
    'password' => null
];
$idioma;
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
$sQuerySeleccion = "SELECT * FROM T01_Usuario WHERE T01_CodUsuario=:codUsuario";
$sQueryActualizacion = <<< query
  UPDATE T01_Usuario SET T01_NumConexiones=T01_NumConexiones+1,
      T01_FechaHoraUltimaConexion= unix_timestamp()
  WHERE T01_CodUsuario=:codUsuario;
  query;
//Comprobamos si ha pulsado el botón de Iniciar Sesion
try {
    if (isset($_REQUEST['iniciarSesion'])) {
        //Crear un objeto PDO pasándole las constantes definidas como parametros.
        $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
        $aErrores['usuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'], MAX_TAMANYO, MIN_TAMANYO, OBLIGATORIO);
        $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], MAX_TAMANYO, MIN_TAMANYO, OBLIGATORIO);
        foreach ($aErrores as $claveError => $mensajeError) {
            if ($mensajeError != null) {
                $entradaOK = false;
            }
        }
        if ($entradaOK) {
            $queryConsultaPorCodigo = $DB208DWESLoginLogoffTema5->prepare($sQuerySeleccion);
            $queryConsultaPorCodigo->bindParam(':codUsuario', $_REQUEST['usuario']);
            $queryConsultaPorCodigo->execute();
            //objeto donde guardar lo devuelto por el select.
            $oUsuario = $queryConsultaPorCodigo->fetchObject();
            //Comprobación de contraseña correcta o incorrecta
            if (!$oUsuario || $oUsuario->T01_Password != hash('sha256', ($_REQUEST['usuario'] . $_REQUEST['password']))) {
                $entradaOK = false;
            }
        }
        // Si no se ha pulsado iniciar sesión, mostramos formulario
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
    //Iniciamos la sesión
    session_start();
    /* Introducimos el usuario en la sesion dándole valor a la superglobal $_SESSION. Esta superglobal
     * será utilizada en los siguientes archivos PHP para comprobar si el usuario tenía sesión abierta, es decir,
     * se ha logado corréctamente. */
    $_SESSION['usuario208DWESLoginLogoffTema5'] = $oUsuario;
    /* Al tener la base de datos el campo FechaHoraUltimaConexion como timestamp, tengo que comprobar que,
     * si no es nulo, construya un objeto datetime con la fecha actual,y... */
    if (!is_null($oUsuario->T01_FechaHoraUltimaConexion)) {
        $oFechaTimesTamp = new DateTime();
        /* ... le establezco la fecha con el valor devuelto al objeto $oUsuario al ejecutar la consulta por codigo
         * y hacer fetchObject sobre el.          */
        $oFechaTimesTamp->setTimestamp($oUsuario->T01_FechaHoraUltimaConexion);
        //Y se guarda en el $_SESSION el valor de la fecha de su última conexió ya formateado
        $_SESSION['FechaHoraUltimaConexionAnterior'] = $oFechaTimesTamp->format('d/m/Y H:i:s T');
    }
    // Si no ha habido conexiones anteriores, pone la fecha de última conexión a null.
    else {
        $_SESSION['FechaHoraUltimaConexionAnterior'] = null;
    }
    try {
        //Conexión a la base de datos
        $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
        //Actualización último usuario
        $queryActualizacion = $DB208DWESLoginLogoffTema5->prepare($sQueryActualizacion);
        $queryActualizacion->bindParam(":codUsuario", $oUsuario->T01_CodUsuario);
        $queryActualizacion->execute();
        //Volvemos a buscar el usuario para actualizar el objeto usuario
        $queryConsultaPorCodigo = $DB208DWESLoginLogoffTema5->prepare($sQuerySeleccion);
        $queryConsultaPorCodigo->bindParam(':codUsuario', $_REQUEST['usuario']);
        $queryConsultaPorCodigo->execute();
        $oUsuario = $queryConsultaPorCodigo->fetchObject();
    } catch (PDOException $excepcion) {
        echo $excepcion->getMessage();
    } finally {
        unset($DB208DWESLoginLogoffTema5);
    }
    //Fecha actual
    $oFechaActual = new DateTime('now');
    //A la que le añado 6 minutos
    $oFechaDentroDeUnaHora = $oFechaActual->add(new DateInterval("PT6M"));
    //Y de esta última obtengo el timestamp
    $enteroFechaDentroDeUnaHora = $oFechaDentroDeUnaHora->getTimestamp();
    //Este timestamp se lo paso como tercer parámetro a la cookie para indicarle su periodo de validez.
    //Los otros dos parámetros son el mombre de la cookie y el campo del formulario del que toma valor,
    //que será el idioma en que recibirá el mensaje de bienvenida en la siguiente página programa.php.
    setcookie('idioma', $_REQUEST['idioma'], $enteroFechaDentroDeUnaHora);
    //Seguimos dentro del supuesto en que la entrada ha sido válida, por lo tanto, redirigimos al usuario a programa.php
    header('Location: programa.php');
    //Finalizamos la ejecución del script por seguridad.
    exit();
} else {
    //Si la entrada no ha sido correcta, imprimo por pantalla el formulario.
    ?>
    <!DOCTYPE html>
    <html lang="<?php echo $_COOKIE['idioma'] ?>">
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
                <h2><?php echo $aIdiomaHTML[$_COOKIE['idioma']]['login'] ?></h2>
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
                            <p>Elija idioma:</p>
                            <select name="idioma" class="idioma">
                                <option value="es">Español</option>
                                <option value="pt">Portugués</option>
                                <option value="en">Inglés</option>
                            </select>
                            <div class="inicarSesion"><input type="submit" id="iniciarSesion" value="Iniciar Sesion" name="iniciarSesion"></div>
                            <div class="inicarSesion"><input type="submit" id="navegarRegistro" value="Registrarse" name="registrarse"></div>
                        </fieldset>
                    </form>
                </article>
            </main>
        <?php } ?>
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