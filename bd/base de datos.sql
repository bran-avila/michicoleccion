CREATE database ecommercemichicoleccion;
use ecommercemichicoleccion;

/*tablas para la login*/
create table usuarios(
    id int primary key AUTO_INCREMENT,
    contrasenia varchar(200),
    nombre varchar(200),
    apellidos varchar (200),
    correo varchar(200)
);
ALTER TABLE `usuarios` ADD `fecha` DATETIME NULL DEFAULT NULL AFTER `correo`;

create table roles(
    id int primary key AUTO_INCREMENT,
    rol varchar(50)
);

insert into roles(rol) values('usuario');
insert into roles(rol) values('administrador');

create table roles_usuarios(
    idroles int,
    idusuarios int,
    PRIMARY KEY (idroles,idusuarios)
);

alter table roles_usuarios add constraint FK_rol foreign key (idroles)   
references roles(id) on delete cascade on update cascade;

alter table roles_usuarios add constraint FK_user foreign key (idusuarios)   
references usuarios(id) on delete cascade on update cascade;

/*tablas de producto con foto y galeria*/
create table categoria(
    id int primary key AUTO_INCREMENT,
    categoria varchar(150)
);

insert into categoria(categoria) values('heroclix');
insert into categoria(categoria) values('video juegos');
insert into categoria(categoria) values('digimon');
insert into categoria(categoria) values('comics y libros');
insert into categoria(categoria) values('piezas unicas');

create table estado_producto(
    id int primary key AUTO_INCREMENT,
    estado varchar(150)
);

insert into estado_producto(estado) values('nuevo');
insert into estado_producto(estado) values('semi nuevo');
insert into estado_producto(estado) values('nuevo con detalle blister');
insert into estado_producto(estado) values('usado pero bien cuidado');
insert into estado_producto(estado) values('usado');
insert into estado_producto(estado) values('matratado');

create table marca(
    id int primary key AUTO_INCREMENT,
    marca varchar(150)
);

insert into marca(marca) values('BANDAI');
insert into marca(marca) values('N/S');
insert into marca(marca) values('MATTEL');
insert into marca(marca) values('KONAMI');
insert into marca(marca) values('CAPCOM');
insert into marca(marca) values('SONY');
insert into marca(marca) values('SEGA');



create table foto(
    id int primary key AUTO_INCREMENT,
    nombre varchar(200)
);

insert into foto(nombre) values('monterhunter4portada.jpg');
insert into foto(nombre) values('munterhunterps4.jpg');
insert into foto(nombre) values('sonic3genesis.jpg');
insert into foto(nombre) values('monterhunterfreedompsp.jpg');
insert into foto(nombre) values('soulsacrificepsvita.jpg');



create table producto(
    id int primary key AUTO_INCREMENT,
    idcategoria int,
    idestadoproducto int,
    idmarca int,
    idfoto int,
    nombre varchar(200),
    descripcion text,
    anio int,
    cantidad int,
    precio decimal(10,2),
    disponible BIT
);


alter table producto add constraint FK_idcategoria foreign key (idcategoria)   
references categoria(id) on delete cascade on update cascade;

alter table producto add constraint FK_idestadoproducto foreign key (idestadoproducto)   
references estado_producto(id) on delete cascade on update cascade;

alter table producto add constraint FK_idmarca foreign key (idmarca)   
references marca(id) on delete cascade on update cascade;

alter table producto add constraint FK_idfoto foreign key (idfoto)   
references foto(id) on delete cascade on update cascade;

insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
values(2,2,5,1,"monster hunter 4 3ds","videojuego de rpg y aventura de la cosola 3ds, una experencia unica",2014,5,1000,1);

insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
values(2,1,5,2,"Monster Hunter World: Iceborne Master Edition Capcom Ps4","videojuego de rpg y aventura de la cosola ps4, una experencia unica",2019,3,650,1);

insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
values(2,2,7,3,"Sonic The Hedgehog 3 Sega Genesis","videojuego de aventura de la cosola genesis, una experencia unica",1994,1,1200,1);

insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
values(2,2,5,4,"Monster Hunter Freedom Unite Para Psp","videojuego de rpg y aventura de la cosola PSP, una experencia unica",2008,2,399,1);

insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
values(2,4,6,5,"Soul Sacrifice Ps Vita","videojuego de rpg y aventura de la cosola PS VITA, una experencia unica",2013,3,487,1);

/*pediente*/


create table galeria(
    idproducto int ,
    idfoto int,
    PRIMARY KEY (idproducto,idfoto)
);

alter table galeria add constraint FK_gproducto foreign key (idproducto)   
references producto(id) on delete cascade on update cascade;

alter table galeria add constraint FK_gfoto foreign key (idfoto)   
references foto(id) on delete cascade on update cascade;

insert into galeria(idproducto,idfoto) value(1,1);
insert into galeria(idproducto,idfoto) value(2,2);
insert into galeria(idproducto,idfoto) value(3,3);
insert into galeria(idproducto,idfoto) value(4,4);
insert into galeria(idproducto,idfoto) value(5,5);




/*consutas*/

/*select * from producto as p,foto as f,
select p.nombre as nombre,p.precio as precio, f.nombre as urlfoto from producto p,foto f, categoria c  where p.idcategoria =c.id and p.idfoto = f.id and c.categoria = 'video juegos' order by p.nombre;*/

/*tablas de detalle pedidos*/

create table pedido(
    id int primary key AUTO_INCREMENT,
    iddireccion int,
    idmetodoenvio int,
    idtipoPago int,
    total decimal(10,2),
    fecha  DATETIME,
    estatusVenta varchar(200),
    correo varchar(200)
);

create table direccion(
    id int primary key AUTO_INCREMENT,
     nombre varchar(200),
     apellidos varchar(200),
     pais varchar(200),
     callenum varchar(200),
     colonia varchar(200),
     cp varchar(200),
    ciudad varchar(200),
    estado varchar(200),
    telefono varchar(200)
);

create table metodoEnvio(
    id int primary key AUTO_INCREMENT,
    tipoenvio varchar(200),
    precio decimal(10,2)
    
);

insert into metodoEnvio(tipoenvio,precio) values('economico',60);
insert into metodoEnvio(tipoenvio,precio) values('normal',120);
insert into metodoEnvio(tipoenvio,precio) values('express',180);

create table tipopago(
    id int primary key AUTO_INCREMENT,
    idtransancion varchar(200),
    cantidad decimal(10,2),
    fecha date,
    estatus varchar(50)
    
);

alter table pedido add constraint FK_enviop foreign key (iddireccion)   
references direccion(id) on delete cascade on update cascade;

alter table pedido add constraint FK_direccionp foreign key (idmetodoenvio)   
references metodoEnvio(id) on delete cascade on update cascade;

alter table pedido add constraint FK_tipoPago foreign key (idtipoPago)   
references tipopago(id) on delete cascade on update cascade;

create table usuario_pedido(
    idpedido int,
    idusuarios int,
    PRIMARY KEY (idpedido,idusuarios)
);

alter table usuario_pedido add constraint FK_pedidoid foreign key (idpedido)   
references pedido(id) on delete cascade on update cascade;

alter table usuario_pedido add constraint FK_usuariopid foreign key (idusuarios)   
references usuarios(id) on delete cascade on update cascade;

create table detalle_producto(
    id int primary key AUTO_INCREMENT,
    idpedido int,
    idproducto int,
    cantidad int,
    precio decimal(10,2),
    subtotal decimal(10,2),
    nombre varchar(200)
);


alter table detalle_producto add constraint FK_pedidodetalle foreign key (idpedido)   
references pedido(id) on delete cascade on update cascade;

alter table detalle_producto add constraint FK_productodetalle foreign key (idproducto)   
references producto(id) on delete cascade on update cascade;

/*select pe.correo as correo,dic.nombre as  nombre,dic.apellidos as  apellidos,dic.pais as  pais,dic.callenum as calle,dic.colonia as  colonia,dic.cp as  cp,dic.ciudad as  ciudad,dic.estado as  estado,dic.telefono as  telefono,pe.estatusVenta as estatus,pe.total as cantidad,me.tipoenvio as envio
 from pedido pe,direccion dic,metodoenvio me,tipopago tp 
 where pe.iddireccion = dic.id and pe.idmetodoenvio = me.id and pe.idtipoPago = tp.id and pe.id = 20;

 select f.nombre as foto,dp.nombre as nombre,dp.cantidad as cantidad,dp.precio as precio,dp.subtotal as total  from detalle_producto dp, producto p, foto f where dp.idproducto = p.id and p.idfoto = f.id and dp.idpedido = 16; 
select p.id as id,p.fecha as fecha, p.total as total,p.estatusVenta as etatus from usuario_pedido up, pedido p where up.idpedido = p.id and up.idusuarios = 7;*/