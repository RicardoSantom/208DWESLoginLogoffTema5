use DB208DWESLoginLogoffTema5;
-- Inserción de datos en la tabla Departamento.
insert into T02_Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio) 
values("DAW","Despliegue Aplcaciones Web",UNIX_TIMESTAMP(),2000);
insert into T02_Departamento  (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio) 
values("DWC","Desarrollo Web Entorno Cliente",UNIX_TIMESTAMP(),1000);
insert into T02_Departamento  (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio)
 values("DWS","Desarrollo Web Entorno Servidor",UNIX_TIMESTAMP(),3000);
insert into T02_Departamento  (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio)
 values("DIW","Diseño Interfaces Web",UNIX_TIMESTAMP(),4000);
insert into T02_Departamento  (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenNegocio)
 values("EIE","Empresa e Iniciativa Emprendedora",UNIX_TIMESTAMP(),2);
-- Inserción de datos en la tabla Usuario.
insert into T01_Usuario(T01_CodUsuario,T01_Password,T01_DescUsuario,T01_FechaHoraUltimaConexion) values
('heraclio',sha2(concat('heraclio','paso'),256),'Heraclio', UNIX_TIMESTAMP()),
('alberto',sha2(concat('alberto','paso'),256),'Alberto', UNIX_TIMESTAMP()),
('amor',sha2(concat('amor','paso'),256),'Amor', UNIX_TIMESTAMP()),
('antonio',sha2(concat('antonio','paso'),256),'Antonio', UNIX_TIMESTAMP()),
('carmen',sha2(concat('carmen','paso'),256),'Carmen', UNIX_TIMESTAMP()),
('ricardo',sha2(concat('ricardo','paso'),256),'Ricardo', UNIX_TIMESTAMP()),
('david',sha2(concat('david','paso'),256),'David', UNIX_TIMESTAMP()),
('luis',sha2(concat('luis','paso'),256),'Luis', UNIX_TIMESTAMP()),
('otalvaro',sha2(concat('otalvaro','paso'),256),'Alejandro', UNIX_TIMESTAMP()),
('josue',sha2(concat('josue','paso'),256),'Josue', UNIX_TIMESTAMP()),
('manuel',sha2(concat('manuel','paso'),256),'Manuel', UNIX_TIMESTAMP()),
('admin',sha2(concat('admin','paso'),256),'Administrador', UNIX_TIMESTAMP());