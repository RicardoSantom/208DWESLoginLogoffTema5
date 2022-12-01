<?php
if (isset($_REQUEST['detalle'])) {
    header('Location: detalle.php');
    exit;
}
if (isset($_REQUEST['salir'])) {
    header('Location: login.php');
    exit;
}
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
        <title>LoginLogoff programa.php</title>
    </head>
    <body>
        <header>
            <h1>Aplicación LoginLogoffTema5</h1>
            <h2>programa.php</h2>
        </header>
        <main>
            <article>
                <h3>Enunciado: Programa</h3>
                    <form name="ejercicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="submit" id="detalle" value="Detalle" name="detalle">
                        <input type="submit" id="salir" value="Salir" name="salir">
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