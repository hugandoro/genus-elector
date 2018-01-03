LISTAR RESULTADOS PROYECTOS

SELECT tarjeton1_codigo, COUNT(*) as votos FROM votacion WHERE (puesto_numero >= '4') AND (puesto_numero <= '11')  GROUP BY tarjeton1_codigo ORDER BY votos DESC



LISTAR RESULTADOS DELEGADOS

SELECT tarjeton2_codigo, COUNT(*) as votos FROM votacion WHERE (puesto_numero >= '4') AND (puesto_numero <= '11')  GROUP BY tarjeton2_codigo ORDER BY votos DESC