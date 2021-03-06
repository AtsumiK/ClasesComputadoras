CREATE TABLE software (
    software_id SERIAL NOT NULL,
    software_numero_serie CHARACTER VARYING(50) NOT NULL,
    software_nombre CHARACTER VARYING(250) NOT NULL,
    software_version CHARACTER VARYING(20) NOT NULL,
    software_fecha_caducidad TIMESTAMP WITHOUT TIME ZONE ,
    software_fecha_aquisicion TIMESTAMP WITHOUT TIME ZONE ,
    software_equipos_permitidos INTEGER NOT NULL,
    software_comentarios CHARACTER VARYING(500) ,
    CONSTRAINT software_pkey PRIMARY KEY (software_id),
    CONSTRAINT software_software_numero_serie_key UNIQUE (software_numero_serie)
);



CREATE TABLE objeto_en_inventario (
    objeto_en_inventario_id SERIAL NOT NULL,
    inventario_elemento CHARACTER VARYING(250) NOT NULL,
    inventario_numero_serie CHARACTER VARYING(50) NOT NULL,
    inventario_salon BIGINT NOT NULL,
    computadora_id BIGINT ,
    CONSTRAINT objeto_en_inventario_pkey PRIMARY KEY (objeto_en_inventario_id),
    CONSTRAINT objeto_en_inventario_inventario_numero_serie_key UNIQUE (inventario_numero_serie)
);



CREATE TABLE computadora (
    computadora_id SERIAL NOT NULL,
    computadora_nombre CHARACTER VARYING(10) NOT NULL,
    computadora_ram CHARACTER VARYING(60) NOT NULL,
    computadora_procesador CHARACTER VARYING(60) NOT NULL,
    computadora_disco_duro CHARACTER VARYING(60) NOT NULL,
    computadora_dir_ip CHARACTER VARYING(16) ,
    computadora_dir_mac CHARACTER VARYING(20) ,
    CONSTRAINT computadora_pkey PRIMARY KEY (computadora_id)
);



CREATE TABLE computadora_software (
    computadora_software_id SERIAL NOT NULL,
    numero_serie_programa CHARACTER VARYING(25) NOT NULL,
    comp_soft_fecha_instalacion CHARACTER VARYING(60) ,
    computadora BIGINT NOT NULL,
    software BIGINT NOT NULL,
    CONSTRAINT computadora_software_pkey PRIMARY KEY (computadora_software_id)
);



CREATE TABLE objeto_perdido (
    objeto_perdido_id SERIAL NOT NULL,
    objeto_perdido_elemento CHARACTER VARYING(250) NOT NULL,
    objeto_perdido_fecha TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    objeto_perdido_correo CHARACTER VARYING(250) NOT NULL,
    objeto_perdido_fecha_devolucion TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    objeto_perdido_comentarios CHARACTER VARYING(5000) ,
    objeto_perdido_salon BIGINT NOT NULL,
    objeto_perdido_estudiante BIGINT ,
    CONSTRAINT objeto_perdido_pkey PRIMARY KEY (objeto_perdido_id)
);



CREATE TABLE tarea (
    tarea_id SERIAL NOT NULL,
    tarea_descripcion CHARACTER VARYING(5000) NOT NULL,
    tarea_comentarios CHARACTER VARYING(5000) NOT NULL,
    tarea_fecha_inicio TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    tarea_fecha_fin TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    tarea_monitor BIGINT NOT NULL,
    CONSTRAINT tarea_pkey PRIMARY KEY (tarea_id)
);



CREATE TABLE salon (
    salon_id SERIAL NOT NULL,
    salon_nombre CHARACTER VARYING(250) NOT NULL,
    CONSTRAINT salon_pkey PRIMARY KEY (salon_id)
);



CREATE TABLE prestamo (
    prestamo_id SERIAL NOT NULL,
    prestamo_entrada TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    prestamo_salida TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    prestamo_comentarios CHARACTER VARYING(5000) ,
    prestamo_estudiante BIGINT NOT NULL,
    prestamo_computadora BIGINT NOT NULL,
    CONSTRAINT prestamo_pkey PRIMARY KEY (prestamo_id)
);



CREATE TABLE monitor_salon (
    monitor_salon_id SERIAL NOT NULL,
    monitor_salon_entrada TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    monitor_salon_salida TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    monitor_salon_comentarios CHARACTER VARYING(5000) ,
    monitor BIGINT NOT NULL,
    salon BIGINT NOT NULL,
    CONSTRAINT monitor_salon_pkey PRIMARY KEY (monitor_salon_id)
);



CREATE TABLE impresion (

    impresion_id SERIAL NOT NULL,

    impresion_fecha TIMESTAMP WITHOUT TIME ZONE NOT NULL,

    impresion_lugar CHARACTER VARYING(50) NOT NULL,

    impresion_estudiante BIGINT NOT NULL,

    CONSTRAINT impresion_pkey PRIMARY KEY (impresion_id),

    CONSTRAINT impresion_impresion_estudiante_key UNIQUE (impresion_estudiante)

);



CREATE TABLE monitor (
    monitor_id SERIAL NOT NULL,
    monitor_tipo CHARACTER VARYING(5) NOT NULL,
    monitor_horario CHARACTER VARYING(100) NOT NULL,
    monitor_estudiante BIGINT NOT NULL,
    CONSTRAINT monitor_pkey PRIMARY KEY (monitor_id),
    CONSTRAINT monitor_monitor_estudiante_key UNIQUE (monitor_estudiante)
);



CREATE TABLE reserva (
    reserva_id SERIAL NOT NULL,
    reserva_clase CHARACTER VARYING(250) NOT NULL,
    reserva_hora_inicio TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    reserva_hora_fin TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    reserva_responsable BIGINT NOT NULL,
    reserva_salon BIGINT NOT NULL,
    CONSTRAINT reserva_pkey PRIMARY KEY (reserva_id)
);



CREATE TABLE responsable (
    responsable_id SERIAL NOT NULL,
    responsable_facultad CHARACTER VARYING(20) NOT NULL,
    responsable_asignatura CHARACTER VARYING(20) NOT NULL,
    responsable_persona BIGINT NOT NULL,
    CONSTRAINT responsable_pkey PRIMARY KEY (responsable_id),
    CONSTRAINT responsable_responsable_persona_key UNIQUE (responsable_persona)
);



CREATE TABLE estudiante (
    estudiante_id SERIAL NOT NULL,
    estudiante_codigo CHARACTER VARYING(20) NOT NULL,
    estudiante_facultad CHARACTER VARYING(20) NOT NULL,
    estudiante_carrerra CHARACTER VARYING(20) NOT NULL,
    estudiante_persona BIGINT NOT NULL,
    CONSTRAINT estudiante_pkey PRIMARY KEY (estudiante_id),
    CONSTRAINT estudiante_estudiante_codigo_key UNIQUE (estudiante_codigo),
    CONSTRAINT estudiante_estudiante_persona_key UNIQUE (estudiante_persona)
);



CREATE TABLE persona (
    persona_id SERIAL NOT NULL,
    persona_documento_identidad CHARACTER VARYING(20) NOT NULL,
    persona_nombres CHARACTER VARYING(250) NOT NULL,
    persona_apellidos CHARACTER VARYING(250) NOT NULL,
    CONSTRAINT persona_pkey PRIMARY KEY (persona_id),
    CONSTRAINT persona_persona_documento_identidad_key UNIQUE (persona_documento_identidad)
);



CREATE TABLE usuario (
    usuario_id SERIAL NOT NULL,
    usuario_login CHARACTER VARYING(20) NOT NULL,
    usuario_clave CHARACTER VARYING(20) NOT NULL,
    usuario_tipo CHARACTER VARYING(3) NOT NULL,
    CONSTRAINT usuario_pkey PRIMARY KEY (usuario_id),
    CONSTRAINT usuario_usuario_login_key UNIQUE (usuario_login)
);



CREATE TABLE software_computadora_backup (
    software_computadora_backup_id SERIAL NOT NULL,
    id_software_computadora BIGINT NOT NULL,
    numero_serie_programa_backup CHARACTER VARYING(25) NOT NULL,
    comp_soft_fecha_instalacion_backup CHARACTER VARYING(60) ,
    computadora_backup BIGINT NOT NULL,
    software_backup BIGINT NOT NULL,
    fecha_backup_s_c TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    CONSTRAINT software_computadora_backup_pkey PRIMARY KEY (software_computadora_backup_id)
);



CREATE TABLE prestamo_backup (
    prestamo_backup_id SERIAL NOT NULL,
    prestamo_id BIGINT NOT NULL,
    prestamo_entrada_backup TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    prestamo_salida_backup TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    prestamo_comentarios_backup CHARACTER VARYING(5000) ,
    prestamo_estudiante_backup BIGINT NOT NULL,
    prestamo_computadora_backup BIGINT NOT NULL,
    prestamo_backup_fecha_backup TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    CONSTRAINT prestamo_backup_pkey PRIMARY KEY (prestamo_backup_id)
);






ALTER TABLE objeto_en_inventario ADD CONSTRAINT inventario_salon
    FOREIGN KEY ( inventario_salon) REFERENCES salon(salon_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;
ALTER TABLE objeto_en_inventario ADD CONSTRAINT objeto_en_inventario_computadora
    FOREIGN KEY ( computadora_id) REFERENCES computadora(computadora_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;






ALTER TABLE computadora_software ADD CONSTRAINT computadora
    FOREIGN KEY ( computadora) REFERENCES computadora(computadora_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;ALTER TABLE computadora_software ADD CONSTRAINT software
    FOREIGN KEY ( software) REFERENCES software(software_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE objeto_perdido ADD CONSTRAINT objeto_perdido_salon
    FOREIGN KEY ( objeto_perdido_salon) REFERENCES salon(salon_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;ALTER TABLE objeto_perdido ADD CONSTRAINT objeto_perdido_estudiante
    FOREIGN KEY ( objeto_perdido_estudiante) REFERENCES estudiante(estudiante_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE tarea ADD CONSTRAINT tarea_monitor
    FOREIGN KEY ( tarea_monitor) REFERENCES monitor(monitor_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;





ALTER TABLE prestamo ADD CONSTRAINT prestamo_estudiante
    FOREIGN KEY ( prestamo_estudiante) REFERENCES estudiante(estudiante_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;ALTER TABLE prestamo ADD CONSTRAINT prestamo_computadora
    FOREIGN KEY ( prestamo_computadora) REFERENCES computadora(computadora_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE monitor_salon ADD CONSTRAINT monitor
    FOREIGN KEY ( monitor) REFERENCES monitor(monitor_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;ALTER TABLE monitor_salon ADD CONSTRAINT salon
    FOREIGN KEY ( salon) REFERENCES salon(salon_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


    ALTER TABLE impresion ADD CONSTRAINT impresion_estudiante

        FOREIGN KEY ( impresion_estudiante) REFERENCES estudiante(estudiante_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE monitor ADD CONSTRAINT monitor_estudiante
    FOREIGN KEY ( monitor_estudiante) REFERENCES estudiante(estudiante_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE reserva ADD CONSTRAINT reserva_responsable
    FOREIGN KEY ( reserva_responsable) REFERENCES responsable(responsable_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;ALTER TABLE reserva ADD CONSTRAINT reserva_salon
    FOREIGN KEY ( reserva_salon) REFERENCES salon(salon_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE responsable ADD CONSTRAINT responsable_persona
    FOREIGN KEY ( responsable_persona) REFERENCES persona(persona_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


ALTER TABLE estudiante ADD CONSTRAINT estudiante_persona
    FOREIGN KEY ( estudiante_persona) REFERENCES persona(persona_id) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION ;


    -- TRIGGERS



    -- ESTE TRIGGER SE DISPARA CUANDO SE ELIMINA UNA COMPUTADORA, Y ELIMINA DEL INVENTARIO TODAS LAS PARTES RELACIONADAS CON LA COMPUTADORA PARA QUE NO QUEDEN SUELTAS NI GENERE ERROR.
  -- TRIGGER 1
    CREATE OR REPLACE FUNCTION eliminar_inventarios_computadora()
      RETURNS trigger AS $eic$
    BEGIN
     DELETE FROM objeto_en_inventario WHERE computadora_id = OLD.computadora_id;
     DELETE FROM computadora_software WHERE computadora = OLD.computadora_id;
     DELETE FROM prestamo WHERE prestamo_computadora = OLD.computadora_id;
     RETURN OLD;
    END;
    $eic$ LANGUAGE plpgsql;

    CREATE TRIGGER cuando_elimine_computadora
      BEFORE DELETE
      ON computadora
      FOR EACH ROW
      EXECUTE PROCEDURE eliminar_inventarios_computadora();
  -- TRIGGER 2
    CREATE OR REPLACE FUNCTION backup_instalacion_software()
        RETURNS trigger AS $eic$
      BEGIN
        INSERT INTO software_computadora_backup (id_software_computadora, numero_serie_programa_backup,  comp_soft_fecha_instalacion_backup,  computadora_backup,  software_backup,  fecha_backup_s_c )
        (SELECT *,now() FROM computadora_software);
        RETURN OLD;
      END;
      $eic$ LANGUAGE plpgsql;

      CREATE TRIGGER cuando_elimine_software
        BEFORE DELETE
        ON computadora_software
        FOR EACH ROW
        EXECUTE PROCEDURE backup_instalacion_software();

  -- TRIGGER 3
      CREATE OR REPLACE FUNCTION backup_prestamo()
        RETURNS trigger AS $eic$
      BEGIN
        INSERT INTO prestamo_backup (prestamo_id,prestamo_entrada_backup,prestamo_salida_backup,prestamo_comentarios_backup,prestamo_estudiante_backup,prestamo_computadora_backup,prestamo_backup_fecha_backup)
        (SELECT *,now() FROM prestamo);
        RETURN OLD;
      END;
      $eic$ LANGUAGE plpgsql;

      CREATE TRIGGER cuando_elimine_prestamo
        BEFORE DELETE
        ON prestamo
        FOR EACH ROW
        EXECUTE PROCEDURE backup_prestamo();
