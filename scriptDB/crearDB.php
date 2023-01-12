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
        <title>Script creación DB + usuario</title>
    </head>
    <body>
        <header>
            <h1>Scripts proyecto Login Logoff tema 5</h1>
            <h2>Script creación DB + usuario</h2>
        </header>
        <main>
            <article>
                <h3>Scripts de creación entorno de explotación</h3>
                <?php
                require_once '../core/validacionFormularios.php';
                require_once '../config/confDB.php';
                try {
                    //Establecimiento de la conexión 
                    $DB208DWESLoginLogoffTema5 = new PDO(DSN, NOMBREUSUARIO, PASSWORD);
                    $creacion = $DB208DWESLoginLogoffTema5->prepare(<<<SQL
                            create table T02_DepartamentoTema5(T02_CodDepartamento char(3) primary key,
                            T02_DescDepartamento varchar(255) not null, T02_FechaCreacionDepartamento int not null,
                            T02_VolumenNegocio float not null,T02_FechaBajaDepartamento int null)
                            engine=Innodb;
                            create table if not exists T01_UsuarioTema5(
                            T01_CodUsuario varchar(8) primary key not null,
                            T01_Password varchar(255) not null,
                            T01_DescUsuario varchar(255) not null,
                            T01_NumConexiones int not null default 1,
                            T01_FechaHoraUltimaConexion int not null,
                            T01_Perfil enum('administrador','usuario') default 'usuario',
                            T01_ImagenUsuario MEDIUMBLOB null
                            )engine=Innodb;
                            SQL);
                    $creacion->execute(); //Ejecuto la consulta
                    if ($creacion) {
                        echo "<h3>Creacion ejecutada con exito</<h3>";
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
                    unset($mydb);
                }
                ?>
                <a href="../indexProyectoTema4.php"><img src="../webroot/volver.png" alt="volver" class="volver2" /></a>
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