<?php
/**
 * @author Ricardo Santiago Tomé RicardoSantom en GitHub<https://github.com/RicardoSantom>
 * @version 1.0
 * @since 02/12/2022
 * Description Control de acceso en función header() a una aplicación.
 */
//Inicio de sesión
session_start();
/* Con la superglobal $_SESSION compruebo si tiene un valor nulo, es decir,
 * el usuario no se la logado o lo ha hecho incorréctamente, en tal caso, 
 * lo redirijo a login.php
 */
if (is_null($_SESSION['usuario208DWESLoginLogoffTema5'])) {
    header('Location: login.php');
    exit;
}
/* El usuario tiene un botón de salir, en caso de pulsarlo, borro los datos de la superglobal
 * $_SESSION, destruyo la session previamente iniciada y lo redirijo a login.php  */
if (isset($_REQUEST['salir'])) {
    $_SESSION['usuario208DWESLoginLogoffTema5'] = null;
    $_SESSION['FechaHoraUltimaConexionAnterior'] = null;
    session_destroy();
    header('Location: login.php');
    exit;
}
//Si el usuario pulsa el botón de detalle, redirijo a detalle.php
if (isset($_REQUEST['detalle'])) {
    header('Location: detalle.php');
    exit;
}
//Array para cambiar idioma del header.
$aIdiomaHeader = [
    'es' => [
        'login' => 'Acceso a la aplicación',
        'programa' => 'Proyecto Login-Logout',
        'detalle' => 'Variables superglobales y phpinfo()'
    ],
    'en' => [
        'login' => 'Application access',
        'programa' => 'Login-Logout Project',
        'detalle' => 'Superglobal variables and phpinfo()'
    ],
    'pt' => [
        'login' => 'Acesso à aplicação',
        'programa' => 'Projeto Login-Logout',
        'detalle' => 'Variáveis superglobais e phpinfo()'
    ],
];
?>
<!DOCTYPE html>
<html lang="<?php echo $_COOKIE['idiomaPreferido'] ?>">
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
        <title>LoginLogoff programa.php</title>
        <style>
            main{text-align: center;}
        </style>
    </head>
    <body>
        <header>
            <h1>Aplicación LoginLogoffTema5</h1>
            <h2>programa.php</h2>
        </header>
        <main>
            <article>
                <h3>Enunciado: Login Correcto, bienvenida a usuario e información.</h3>
                <form name="ejercicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php
                        //Damos la bienvenida al usuario haciendo uso de la cookie y el valor en ella recojido para idioma
                        switch ($_COOKIE['idioma']) {
                            case "es":
                                echo"<h5>Bienvenido " . $_SESSION['usuario208DWESLoginLogoffTema5']->T01_DescUsuario."</h5>";
                                break;
                            case "en":
                                echo"<h5>Welcome " . $_SESSION['usuario208DWESLoginLogoffTema5']->T01_DescUsuario."</h5>";
                                break;
                            case "pt":
                                echo"<h5>Bem-vido " . $_SESSION['usuario208DWESLoginLogoffTema5']->T01_DescUsuario."</h5>";
                                break;
                            default:
                                echo"<h5>Bienvenido " . $_SESSION['usuario208DWESLoginLogoffTema5']->T01_DescUsuario."</h5>";
                                break;
                        }
                        //comprobamos el numero de conexiones si es mayor a 1 tambien mostramos la fecha y hora de la ultima conexion
                        if ($_SESSION['usuario208DWESLoginLogoffTema5']->T01_NumConexiones > 1) {
                            echo"<p>Ultimo inicio de sesión: " . $_SESSION['FechaHoraUltimaConexionAnterior'] . "</p>";
                            echo"<p>Te has conectado " . $_SESSION['usuario208DWESLoginLogoffTema5']->T01_NumConexiones . " veces</p>";
                        } else {
                            echo '<p>Es la primera vez que te conectas</p><br>';
                        }
                        $oFechaActual = new DateTime('now', new DateTimeZone("Europe/Madrid"));
                        $sFechaFormateada = $oFechaActual -> format('d-m-Y H:i:s');
                        echo "<p> Fecha y hora actuales en Madrid(España) ".$sFechaFormateada;
                        ?>
                        </p><br>
                        <div class="botones"><input type="submit" id="detalle" value="Detalle" name="detalle"></div>
                        <div class="botones2"><input type="submit" id="salir" value="Salir" name="salir"></div>                 
                </form>
            </article>
        </main>
        <?php include_once './footer.php'; ?>
    </body>
</html>