/**
*@author Ricardo Santiago Tomé - RicardoSantom en Github <https://github.com/RicardoSantom>
*@since noviembre 2022
*@version 1.0
*@description Este archivo es un script sql que crea una base de datos, la pone en uso,
* crea dos tablas dentro de ella. Crea un usuario con todos los privilegios sobre esta DB.
*/
/*Creación base de datos*/
create database if not exists DB208DWESLoginLogoffTema5;
/*Puesta en uso de la base de datos*/
use DB208DWESLoginLogoffTema5;
/*Cración tabla T02_Departamento*/
create table T02_Departamento(T02_CodDepartamento char(3) primary key,
    T02_DescDepartamento varchar(255) not null, T02_FechaCreacionDepartamento int not null,
    T02_VolumenNegocio float not null,T02_FechaBajaDepartamento int null)
    engine=Innodb;
/*Creación de la tabla T01_Usuario.*/
create table if not exists T01_Usuario(
    T01_CodUsuario varchar(8) primary key not null,
    T01_Password varchar(255) not null,
    T01_DescUsuario varchar(255) not null,
    T01_NumConexiones int not null default 1,
    T01_FechaHoraUltimaConexion datetime not null,
    T01_Perfil enum('administrador','usuario') default 'usuario',
    T01_ImagenUsuario MEDIUMBLOB null
)engine=Innodb;
/*Creación usuario para conectarse desde cualquier ip y adjudicación de password*/
create user if not exists 'user208DWESLoginLogoffTema5'@'%' identified by 'paso';
/*Dotación de todos los privilegios para el usuario crado en esta base de datos*/
grant all on DB208DWESLoginLogoffTema5.* to 'user208DWESLoginLogoffTema5'@'%';
/*Recarga de privilegios*/
FLUSH PRIVILEGES;