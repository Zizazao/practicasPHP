select * from articulos where ciudad = 'caceres'; 
-- 1
select p from envios where t = 't1';
-- 2
select distinct color, ciudad from componentes;
-- 3
select t, ciudad from articulos where ciudad like '%e%' or ciudad like '%d';
-- 4 pattern!!!
select p from envios where t = 't1' and c = 'c1';
-- 5
select tnombre from articulos 
inner join envios 
on articulos.t = envios.t
where envios.p = 'p1' order by tnombre;
-- 6
select distinct c from envios inner join articulos on 
articulos.t = envios.t 
where articulos.ciudad ='madrid';
-- 7 corregiiiir!!!!
use tienda;
select c from componentes where peso = (select min(peso) from componentes);
-- 8
select distinct table1.p from 
(select p from envios where t = 't1') as table1
join 
(select p from envios where t = 't2') as table2 
where table1.p = table2.p;
-- 9 union, interesante, pero no sirve
select distinct p from envios
where p in(select p from envios where t='t1') and
p in(select p from envios where t='t2');
-- 9.1
select p from componentes inner join envios on
componentes.c = envios.c
inner join articulos on  articulos.t = envios.t
where componentes.color = 'rojo' and
(articulos.ciudad = 'madrid' or articulos.ciudad = 'sevilla') ; 
-- 10 repasar
select c  from envios 
where (envios.t) in (select t from articulos where ciudad = 'sevilla')
and (envios.p) in (select p from proveedores where ciudad = 'sevilla')group by envios.c;
-- 11 c6
select t from envios where p = 'p1';
-- 12 t1 t4
select proveedores.ciudad, componentes.c, articulos.ciudad 
from proveedores inner join componentes 
on (proveedores.ciudad = componentes.ciudad)
inner join articulos on (componentes.ciudad = articulos.ciudad);
-- 13 23 filas
select proveedores.ciudad, componentes.c, articulos.ciudad 
from proveedores inner join componentes 
on (proveedores.ciudad = componentes.ciudad)
inner join articulos on 
(componentes.ciudad = articulos.ciudad);
-- 14 15 filas
select count(c), count(distinct(t)), sum(cantidad) from envios where p = 'p2';
-- 15

-- A PARTIR DE AQUI TRABAJO EN GIT
select c, t, sum(cantidad) from envios
group by c, t;
-- 16 21 filas BIEN!
select t1.t from envios as t1 
inner join proveedores on (proveedores.ciudad <> 'madrid')
inner join articulos as t2 on (proveedores.ciudad <> t2.ciudad)
group by t1.t;
-- 17 todos menos t6
select distinct envios.p from envios inner join componentes where color = 'rojo';
-- 18 p1 p2 p3 p4 p5
select c from envios group by c having avg(cantidad) > 320;
-- 19 todos menos t7
select p, avg(cantidad) as a1 from envios where a1 = (select );
-- 20 p1 p2 p5
select c from envios where t = 't2' and p = 'p2';
-- 21
select * from envios 
inner join componentes where (color != 'rojo') 
group by componentes.c;
-- 22

-- 23

