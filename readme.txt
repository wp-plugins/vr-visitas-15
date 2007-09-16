*** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***

VR-Visitas 1.4 para WordPress 2.0.3
===================================
Por: Vicen� Ruiz http://www.vruiz.net (webmaster@vruiz.net)



FUNCIONALIDAD
-------------
- Al instalar el plugin, se crean dos bases de datos vr_visitas y vr_spam que te permiten llevar
  un registro de las visitas a tu p�gina.
- Los resultados se muestran como: Visitas totales y �ltimas 24 horas.
- Tambien muestra datos del Copyright del autor y la fecha de actualizaci�n de la p�gina.
- A traves del panel de administraci�n puedes consultar unas sencillas estad�sticas y gestionar
  la base de datos.


CHANGELOG
---------
Versi�n 1.4 (30/09/2006)
 - Corregido un error al mostrar los listados de visitas y estad�sticas.
   Ahora muestra un mensaje de alerta cuando no hay registros para mostrar.
 - Actualizado el fichero visitas_lang con los nuevos mensajes.
 - A�adidos 2 nuevos res�menes de estad�sticas: Por cadena de B�squeda y por Host.
   Tambi�n est�n delimitados por las correspondientes opciones.
   La tabla vr_visitas de la base de datos se actualiza autom�ticamente al reiniciar el plugin con
   dos nuevos campos: 'search' VARCHAR(100) NOT NULL y 'host' VARCHAR(100) NOT NULL
 - Nueva depuraci�n del c�digo, simplificando algunas funciones.
 
Versi�n 1.3 (25/09/2006)
 - Corregido un error al mostrar el listado de visitas. Ahora limitado a 1000 registros.
 - Actualizado el fichero visitas_lang con los nuevos mensajes.
 - Ahora muestra el promedio de visitas por d�a en el listado de visitas.
 
Versi�n 1.2 (23/09/2006)
 - A�adida nueva opci�n que permite mostrar s�lo el Copyright, s�lo el Contador o ambos; se elimina
   la necesidad de la funci�n vr_contador() que se mantiene s�lo a efectos de compatibilidad.
 - Ahora incluye la opci�n de mostrar un "widget" en la barra lateral si el tema permite esta funci�n.
   Se activa autom�ticamente al instalar el plugin. S�lo tendr�s que arrastrarlo dentro de la barra en
   el panel de administraci�n para que funcione.
 - Cambiado el tipo de valor del campo 'idSpam' que mostraba un error cuando se superaban los 127
   registros en la tabla. Ahora es: int(6) NOT NULL auto_increment.

Versi�n 1.1 (02/09/2006)
 - A�adida opci�n para cambio de idioma (es [Spanish], en [English])
 - A�adida opci�n para establecer manualmente la fecha de actualizaci�n.
 - Optimizaci�n del c�digo.

Versi�n 1.0 (28/08/2006)
 -	First release
	Se ha verificado el uso en WordPress a partir de la versi�n 2.03, NO en versiones anteriores.


INSTALACI�N
-----------
1. - Descomprimir los archivos en la carpeta: wp-content/visitas/
2. - Activar el plugin en el Panel de Administraci�n de WordPress.
3. - En el panel de adeministarci�n Visitas/Opciones, actualizar los valores iniciales.
4. - Seguir las instrucciones de uso en COMO USARLO.


ACTUALIZACI�N
-------------
1. - Desactivar el plugin en el Panel de Administraci�n de WordPress.
2. - Descomprimir y sobreescribir los archivos en la carpeta: wp-content/visitas/
3. - Activar nuevamente el plugin en el Panel de Administraci�n de WordPress.


COMO USARLO
-----------
Dentro del men� de Administraci�n de WordPress, se instala una nueva opci�n: Visitas,
con distintas ventanas para el manejo del plugin.

- Visitas:			Muestra una lista de las �ltimas visitas registradas.
- A�adir filtro:	Permite a�adir palabras que se usar�n como filtro para borrar entradas
					de la base de datos.
- Borrar filtro:	Borra las palabras de la tabla de filtros.
- Borrar SPAM:		Elimina los registros de la base de datos correspondientes a las visitas de Robots
					y de los referentes que coincidan con tu lista de filtros.
- Estad�sticas:		Muestra un resumen (en %) de las entradas registradas: por navegador,
					por sistema operativo, por n�mero de visitas y por referente.
- Opciones:			Actualiza los valores de las opciones usadas en el plugin.
					Se explican en la propia p�gina.

Para comenzar a registrar las visitas inserta el siguiente c�digo en la plantilla footer.php
dentro del <div id="footer"> [ ... ] </div> como se indica a continuaci�n:

		<?php if (function_exists('vr_copyright')) { vr_copyright(); } ?>
		
Resultado => � YYYY (Your name) - Actualizado: dd/mm/yy - Visitas totales: 1 - �ltimas 24 horas: 1

	* Puedes seleccionar la informaci�n mostrada a trav�s de una nueva opci�n.
	* Tambi�n puedes ver los resultados en la barra lateral usando el widget 'visitas' si tu tema lo permite.
	
El fichero actualizado.html, contiene un webbot que se actualiza cada vez que se guarda el archivo;
este webbot almacena la fecha de actualizaci�n del fichero que se utiliza para mostrar la fecha de 
actualizaci�n de tu p�gina.

*** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***
//end//