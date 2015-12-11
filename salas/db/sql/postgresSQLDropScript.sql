

ALTER TABLE objeto_en_inventario DROP CONSTRAINT inventario_salon;

ALTER TABLE objeto_en_inventario DROP CONSTRAINT objeto_en_inventario_computadora;





ALTER TABLE computadora_software DROP CONSTRAINT computadora;

ALTER TABLE computadora_software DROP CONSTRAINT software;



ALTER TABLE objeto_perdido DROP CONSTRAINT objeto_perdido_salon;

ALTER TABLE objeto_perdido DROP CONSTRAINT objeto_perdido_estudiante;



ALTER TABLE tarea DROP CONSTRAINT tarea_monitor;





ALTER TABLE prestamo DROP CONSTRAINT prestamo_estudiante;

ALTER TABLE prestamo DROP CONSTRAINT prestamo_computadora;



ALTER TABLE monitor_salon DROP CONSTRAINT monitor;

ALTER TABLE monitor_salon DROP CONSTRAINT salon;



ALTER TABLE impresion DROP CONSTRAINT impresion_estudiante;



ALTER TABLE monitor DROP CONSTRAINT monitor_estudiante;



ALTER TABLE reserva DROP CONSTRAINT reserva_responsable;

ALTER TABLE reserva DROP CONSTRAINT reserva_salon;



ALTER TABLE responsable DROP CONSTRAINT responsable_persona;



ALTER TABLE estudiante DROP CONSTRAINT estudiante_persona;




DROP TRIGGER cuando_elimine_computadora ON computadora;


DROP TABLE software;



DROP TABLE objeto_en_inventario;



DROP TABLE computadora;



DROP TABLE computadora_software;



DROP TABLE objeto_perdido;



DROP TABLE tarea;



DROP TABLE salon;



DROP TABLE prestamo;



DROP TABLE monitor_salon;



DROP TABLE impresion;



DROP TABLE monitor;



DROP TABLE reserva;



DROP TABLE responsable;



DROP TABLE estudiante;



DROP TABLE persona;



DROP TABLE usuario;
