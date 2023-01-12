<!DOCTYPE html>
<html lang="en">
    <!--
            Autor: Ricardo Santiago Tomé.
            Utilidad: Este programa consiste en construir una pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos
                      utilizando una consulta preparada.
            Fecha-última-revisión: 22-11-2022.
    -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Ricardo Santiago Tomé">
        <link rel="stylesheet" href="../webroot/css/estilosPlantilla.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" sizes="96x96" href="../../webroot/images/favicon-96x96.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Script borrado</title>
    </head>
    <body>
        <header>
            <h1>Scripts proyecto tema 5</h1>
            <h2>Script borrado</h2>
        </header>
        <main>
            <article>
                <h3>Scripts de borrado entorno de explotación</h3>
                <?php
                require_once '../core/validacionFormularios.php';
                require_once '../config/confDB.php';
                try {
                    //Establecimiento de la conexión 
                    $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
                    $borrado = $DB208DWESLoginLogoffTema5->prepare(<<<SQL
                    drop table if exists T02_DepartamentoTema5,T01_UsuarioTema5;
                    SQL);
                    $borrado->execute(); //Ejecuto la consulta
                    if ($borrado) {
                        echo "<h3>Borrado ejecutado con exito</<h3>";
                    }
                } catch (PDOException $excepcion) { //Código que se ejecutará si se produce alguna excepción
                    //Almacenamos el código del error de la excepción en la variable $errorExcepcion
                    $errorExcep = $excepcion->getCode();
                    //Almacenamos el mensaje de la excepción en la variable $mensajeExcep
                    $mensajeExcep = $excepcion->getMessage();
                    echo "<span style='color: red;'>Error: </span>" . $mensajeExcep . "<br>"; //Mostramos el mensaje de la excepción
                    echo "<span style='color: red;'>Código del error: </span>" . $errorExcep; //Mostramos el código de la excepción
                } finally {
                    // Cierre de la conexión.
                    unset($DB208DWESLoginLogoffTema5);
                }
                ?>
                <a href="../indexProyectoTema4.php">VOLVER</a>
            </article>
        </main>
        <footer>
            <p>2022-23  IES LOS SAUCES. <a href="../../../index.html" id="enlacePrincipal" title="Enlace a Index Principal">Ricardo Santiago Tomé</a> © Todos los derechos reservados</p>
            <a href="https://github.com/RicardoSantom" target="blank" id="github" title="RicardoSantom en GitHub">
            </a>
            <a href="https://www.linkedin.com/in/ricardo-santiago-tom%C3%A9/" id="linkedin" title="Ricardo Santiago Tomé en Linkedim" target="_blank"></a>
            <a href="../../doc/curriculumRicardo.pdf" class="material-icons" title="Curriculum Vitae Ricardo Santiago Tomé" target="_blank" id="curriculum"><span class="material-icons md-18">face</span></a>
            <a href="../indexProyectoTema5.php" id="enlaceSecundario" title="Enlace a Index Proyecto Tema5">Index Proyecto Tema5</a>
        </footer>
    </body>
</html>