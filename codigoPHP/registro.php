<?php
session_start();
if (isset($_REQUEST['cancelar'])) {
    header('Location: login.php');
    exit;
}
//Array para cambiar idioma del header.
/*$aIdiomaHTML = [
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
];*/
?>
<!DOCTYPE html>
<html lang="es">
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
        <title>LoginLogoff registro.php</title>
        <style>
            *{
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <header class="headerPropio">
            <h1>Aplicación LoginLogoffTema5</h1>
            <h2>registro.php</h2>
        </header>
        <main>
            <article>
                <h3>Enunciado: Registro</h3>
                <form name="ejercicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" id="cancelar" value="Cancelar" name="cancelar">
                    </tr>
                    </table>
                </form>
                <?php
                /**
                 * @author Ricardo Santiago Tomé - RicardoSantom en Github https://github.com/RicardoSantom
                 * @version 1.0
                 * @since 21/12/2022
                 */

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