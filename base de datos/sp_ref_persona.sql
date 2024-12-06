-- Function: public.sp_ref_persona(integer, integer, integer, character varying, character varying, date, character varying, character varying, character varying, character varying)

-- DROP FUNCTION public.sp_ref_persona(integer, integer, integer, character varying, character varying, date, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.sp_ref_persona(
    operacion integer,
    vidpersona integer,
    vidciudad integer,
    vpernombre character varying,
    vperapellido character varying,
    vfechanac date,
    vci character varying,
    vruc character varying,
    vtelefono character varying,
    vcorreo character varying)
  RETURNS character varying AS
$BODY$
	DECLARE 
		mensaje VARCHAR; ultimo_per INTEGER; anioactual INTEGER; aniopersona INTEGER; edad INTEGER;
	BEGIN
		anioactual = (select extract(year from current_date));
		aniopersona = (select extract(year from vfechanac));
		edad = anioactual - aniopersona;
		IF edad > 18 THEN
			IF operacion = 1 THEN
				PERFORM * FROM ref_persona  WHERE per_ci=upper(vci);
				IF FOUND THEN
					mensaje = 'ERROR_/_YA HAY UNA PERSONA CON ESE NUMERO DE CI*persona/per_index';
				ELSE
					SELECT COALESCE(MAX(id_persona),0)+1 INTO ultimo_per FROM ref_persona;
					INSERT INTO ref_persona(id_persona, id_ciudad, per_nombre, per_apellido, per_fnacimiento, per_ci, per_ruc, per_telefono, per_email, per_estado)
					VALUES(ultimo_per, vidciudad, upper(vpernombre), upper(vperapellido), vfechanac, vci, vruc, vtelefono, vcorreo, 'ACTIVO');
					mensaje = 'NOTICIA_/_AGREGADO CON EXITO*persona/per_index';
				END IF;  
			END IF;
			IF operacion = 2 THEN
				PERFORM * FROM ref_persona WHERE per_ci=vci AND per_nombre=vpernombre AND id_persona!=vidpersona;
				IF FOUND THEN
					mensaje = 'ERROR_/_YA HAY UNA PERSONA CON ESE NUMERO DE CI Y ESE NOMBRE*persona/per_index';
				ELSE
					UPDATE ref_persona SET id_ciudad=vidciudad, per_nombre=upper(vpernombre), per_apellido=upper(vperapellido),
					per_ci=vci, per_ruc=vruc, per_telefono=vtelefono, per_email=vcorreo, per_fnacimiento=vfechanac
					WHERE id_persona = vidpersona;
					mensaje = 'NOTICIA_/_SE HAN MODIFICADOS LOS DATOS CON EXITO*persona/per_index';
				END IF;
			END IF;
		ELSE 
			mensaje = 'ERROR_/_LA PERSONA DEBE SER MAYOR DE EDAD*persona/per_index';
		END IF;
		
		IF operacion = 3 THEN
			UPDATE ref_persona SET per_estado='INACTIVO' WHERE id_persona = vidpersona AND per_ci=vci;
			mensaje = 'NOTICIA_/_SE HA DESACTIVADO CON EXITO*persona/per_index';
		END IF;
		IF operacion = 4 THEN
			UPDATE ref_persona SET per_estado='ACTIVO' WHERE id_persona = vidpersona AND per_ci=vci;
			mensaje = 'NOTICIA_/_SE HA REACTIVADO CON EXITO*persona/per_index';
		END IF;
		RETURN mensaje;
	END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.sp_ref_persona(integer, integer, integer, character varying, character varying, date, character varying, character varying, character varying, character varying)
  OWNER TO postgres;
