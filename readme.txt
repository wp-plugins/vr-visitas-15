*** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***

VR-Visitas 1.4 para WordPress 2.0.3
===================================
Por: Vicenç Ruiz http://www.vruiz.net (webmaster@vruiz.net)



FUNCIONALIDAD
-------------
- Al instalar el plugin, se crean dos bases de datos vr_visitas y vr_spam que te permiten llevar
  un registro de las visitas a tu página.
- Los resultados se muestran como: Visitas totales y Últimas 24 horas.
- Tambien muestra datos del Copyright del autor y la fecha de actualización de la página.
- A traves del panel de administración puedes consultar unas sencillas estadísticas y gestionar
  la base de datos.


CHANGELOG
---------
Versión 1.4 (30/09/2006)
 - Corregido un error al mostrar los listados de visitas y estadísticas.
   Ahora muestra un mensaje de alerta cuando no hay registros para mostrar.
 - Actualizado el fichero visitas_lang con los nuevos mensajes.
 - Añadidos 2 nuevos resúmenes de estadísticas: Por cadena de Búsqueda y por Host.
   También están delimitados por las correspondientes opciones.
   La tabla vr_visitas de la base de datos se actualiza automáticamente al reiniciar el plugin con
   dos nuevos campos: 'search' VARCHAR(100) NOT NULL y 'host' VARCHAR(100) NOT NULL
 - Nueva depuración del código, simplificando algunas funciones.
 
Versión 1.3 (25/09/2006)
 - Corregido un error al mostrar el listado de visitas. Ahora limitado a 1000 registros.
 - Actualizado el fichero visitas_lang con los nuevos mensajes.
 - Ahora muestra el promedio de visitas por día en el listado de visitas.
 
Versión 1.2 (23/09/2006)
 - Añadida nueva opción que permite mostrar sólo el Copyright, sólo el Contador o ambos; se elimina
   la necesidad de la función vr_contador() que se mantiene sólo a efectos de compatibilidad.
 - Ahora incluye la opción de mostrar un "widget" en la barra lateral si el tema permite esta función.
   Se activa automáticamente al instalar el plugin. Sólo tendrás que arrastrarlo dentro de la barra en
   el panel de administración para que funcione.
 - Cambiado el tipo de valor del campo 'idSpam' que mostraba un error cuando se superaban los 127
   registros en la tabla. Ahora es: int(6) NOT NULL auto_increment.

Versión 1.1 (02/09/2006)
 - Añadida opción para cambio de idioma (es [Spanish], en [English])
 - Añadida opción para establecer manualmente la fecha de actualización.
 - Optimización del código.

Versión 1.0 (28/08/2006)
 -	First release
	Se ha verificado el uso en WordPress a partir de la versión 2.03, NO en versiones anteriores.


INSTALACIÓN
-----------
1. - Descomprimir los archivos en la carpeta: wp-content/visitas/
2. - Activar el plugin en el Panel de Administración de WordPress.
3. - En el panel de adeministarción Visitas/Opciones, actualizar los valores iniciales.
4. - Seguir las instrucciones de uso en COMO USARLO.


ACTUALIZACIÓN
-------------
1. - Desactivar el plugin en el Panel de Administración de WordPress.
2. - Descomprimir y sobreescribir los archivos en la carpeta: wp-content/visitas/
3. - Activar nuevamente el plugin en el Panel de Administración de WordPress.


COMO USARLO
-----------
Dentro del menú de Administración de WordPress, se instala una nueva opción: Visitas,
con distintas ventanas para el manejo del plugin.

- Visitas:			Muestra una lista de las últimas visitas registradas.
- Añadir filtro:	Permite añadir palabras que se usarán como filtro para borrar entradas
					de la base de datos.
- Borrar filtro:	Borra las palabras de la tabla de filtros.
- Borrar SPAM:		Elimina los registros de la base de datos correspondientes a las visitas de Robots
					y de los referentes que coincidan con tu lista de filtros.
- Estadísticas:		Muestra un resumen (en %) de las entradas registradas: por navegador,
					por sistema operativo, por número de visitas y por referente.
- Opciones:			Actualiza los valores de las opciones usadas en el plugin.
					Se explican en la propia página.

Para comenzar a registrar las visitas inserta el siguiente código en la plantilla footer.php
dentro del <div id="footer"> [ ... ] </div> como se indica a continuación:

		<?php if (function_exists('vr_copyright')) { vr_copyright(); } ?>
		
Resultado => © YYYY (Your name) - Actualizado: dd/mm/yy - Visitas totales: 1 - Últimas 24 horas: 1

	* Puedes seleccionar la información mostrada a través de una nueva opción.
	* También puedes ver los resultados en la barra lateral usando el widget 'visitas' si tu tema lo permite.
	
El fichero actualizado.html, contiene un webbot que se actualiza cada vez que se guarda el archivo;
este webbot almacena la fecha de actualización del fichero que se utiliza para mostrar la fecha de 
actualización de tu página.

*** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***
//end//