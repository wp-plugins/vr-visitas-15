=== VR-Visitas 1.7 ===
Author: Vicen&ccedil; Ruiz http://www.vruiz.net (webmaster@vruiz.net)
Tags: visits, stats, counter
Requires at least: 2.0.x
Tested up to: 2.3
Stable tag: 1.7

Allows you to take a record of the visits to your page and shows it with the author Copyright and the update date of page.

== Description ==

Allows you to take a record of the visits to your page and shows it with the author Copyright and the update date of page.
Registra las visitas a tu p&aacute;gina y lo muestra junto al Copyright y la fecha de actualizaci&oacute;n de tu p&aacute;gina.

* Al instalar el plugin, se crean dos bases de datos vr_visitas y vr_spam que te permiten llevar un registro de las visitas a tu p&aacute;gina.
* Los resultados se muestran como: Visitas totales y &uacute;ltimas 24 horas.
* Tambien muestra datos del Copyright del autor y la fecha de actualizaci&oacute;n de la p&aacute;gina.
* A traves del panel de administraci&oacute;n puedes consultar unas sencillas estad&iacute;sticas y gestionar la base de datos.



== Installation ==

Instalaci&oacute;n Nueva:

1. Descomprimir los archivos en la carpeta: wp-content/plugins/visitas/
2. Activar el plugin en el Panel de Administraci&oacute;n de WordPress.
3. En el panel de administraci&oacute;n Visitas/Opciones, actualizar los valores iniciales.
4. Seguir las instrucciones de uso en COMO USARLO.



Actualizaci&oacute;n:

1. Desactivar el plugin en el Panel de Administraci&oacute;n de WordPress.
2. Descomprimir y sobreescribir los archivos en la carpeta: wp-content/plugins/visitas/
3. Activar nuevamente el plugin en el Panel de Administraci&oacute;n de WordPress.



== Changelog ==

Versi&oacute;n 1.7 *(12/10/2007)*
* Corregido - Error al crear tablas en nueva instalaci&oacute;n.
* A&ntilde;adido - Control de borrado autom&aacute;tico de las entradas a trav&eacute;s de WP-Cron
* Compatible con versiones anteriores: desde WP2.0 hasta WP2.3
  
Versi&oacute;n 1.6 *(16/09/2007)*
* Actualizado para compatibilidad con WordPress 2.3.x.
  
Versi&oacute;n 1.5a *(16/09/2007)*
* Ahora, antes de borrar las entradas de SPAM, comprueba si Akismet est&aacute; activo y te avisa, si tienes comentarios marcados como SPAM para que los borres usando Akismet. Si no est&aacute; activo, los elimina directamente.
  
Versi&oacute;n 1.5 *(05/09/2007)*
* No es una actualizaci&oacute;n, pero se ha modificado el fichero visitas_lang.php para incluir la traducci&oacute;n al italiano de Mariachiara Pezzotti. 
* Ahora la opci&oacute;n para cambio de idioma es (es [Spanish], en [English], it [Italiano]). 
   
Versi&oacute;n 1.5 *(02/10/2006)*
* A&ntilde;adida una nueva opci&oacute;n que delimita el n&uacute;mero de registros guardados.
* Al borrar entradas de la tabla, se eliminar&aacute;n tambi&eacute;n los registros antiguos, evitando as&iacute;    que la tabla crezca indefinidamente.

Versi&oacute;n 1.4 *(30/09/2006)*
* Corregido un error al mostrar los listados de visitas y estad&iacute;sticas. Ahora muestra un mensaje de alerta cuando no hay registros para mostrar.
* Actualizado el fichero visitas_lang con los nuevos mensajes.
* A&ntilde;adidos 2 nuevos res&uacute;menes de estad&iacute;sticas: Por cadena de B&uacute;squeda y por Host. Tambi&eacute;n est&aacute;n delimitados por las correspondientes opciones.
* La tabla vr_visitas de la base de datos se actualiza autom&aacute;ticamente al reiniciar el plugin con dos nuevos campos: 'search' VARCHAR(100) NOT NULL y 'host' VARCHAR(100) NOT NULL
* Nueva depuraci&oacute;n del c&oacute;digo, simplificando algunas funciones.
 
Versi&oacute;n 1.3 *(25/09/2006)*
* Corregido un error al mostrar el listado de visitas. Ahora limitado a 1000 registros.
* Actualizado el fichero visitas_lang con los nuevos mensajes.
* Ahora muestra el promedio de visitas por d&iacute;a en el listado de visitas.
 
Versi&oacute;n 1.2 *(23/09/2006)*
* A&ntilde;adida nueva opci&oacute;n que permite mostrar s&oacute;lo el Copyright, s&oacute;lo el Contador o ambos; se elimina la necesidad de la funci&oacute;n vr_contador() que se mantiene s&oacute;lo a efectos de compatibilidad.
* Ahora incluye la opci&oacute;n de mostrar un "widget" en la barra lateral si el tema permite esta funci&oacute;n. Se activa autom&aacute;ticamente al instalar el plugin. S&oacute;lo tendr&aacute;s que arrastrarlo dentro de la barra en el panel de administraci&oacute;n para que funcione.
* Cambiado el tipo de valor del campo 'idSpam' que mostraba un error cuando se superaban los 127 registros en la tabla. Ahora es: int(6) NOT NULL auto_increment.

Versi&oacute;n 1.1 *(02/09/2006)*
* A&ntilde;adida opci&oacute;n para cambio de idioma (es [Spanish], en [English])
* A&ntilde;adida opci&oacute;n para establecer manualmente la fecha de actualizaci&oacute;n.
* Optimizaci&oacute;n del c&oacute;digo.

Versi&oacute;n 1.0 (*28/08/2006)*
* First release
* Se ha verificado el uso en WordPress a partir de la versi&oacute;n 2.03, NO en versiones anteriores.


== How to use ==

Dentro del men&uacute; de Administraci&oacute;n de WordPress, se instala una nueva opci&oacute;n: Visitas,
con distintas ventanas para el manejo del plugin.

* Visitas: Muestra una lista de las &uacute;ltimas visitas registradas.
* A&ntilde;adir filtro: Permite a&ntilde;adir palabras que se usar&aacute;n como filtro para borrar entradas de la base de datos.
* Borrar filtro: Borra las palabras de la tabla de filtros.
* Borrar SPAM: Elimina los registros de la base de datos correspondientes a las visitas de Robots y de los referentes que coincidan con tu lista de filtros.
* Estad&iacute;sticas: Muestra un resumen (en %) de las entradas registradas: por navegador, por sistema operativo, por n&uacute;mero de visitas y por referente.
* Opciones: Actualiza los valores de las opciones usadas en el plugin. Se explican en la propia p&aacute;gina.

Para comenzar a registrar las visitas inserta el siguiente c&oacute;digo en la plantilla footer.php
dentro del &lt;div id="footer"&gt; [ ... ] &lt;/div&gt; como se indica a continuaci&oacute;n:

&lt;?php if (function_exists('vr_copyright')) { vr_copyright(); } ?&gt;
		
Resultado => &copy; YYYY (Your name) - Actualizado: dd/mm/yy - Visitas totales: 1 - &uacute;ltimas 24 horas: 1

* Puedes seleccionar la informaci&oacute;n mostrada a trav&eacute;s de una nueva opci&oacute;n.
* Tambi&eacute;n puedes ver los resultados en la barra lateral usando el widget 'visitas' si tu tema lo permite.
	
El fichero actualizado.html, contiene un webbot que se actualiza cada vez que se guarda el archivo;
este webbot almacena la fecha de actualizaci&oacute;n del fichero que se utiliza para mostrar la fecha de 
actualizaci&oacute;n de tu p&aacute;gina.



== Help ==

Si necesitas ayuda, visita el [Foro de Soporte](http://www.vruiz.net/foros?forum=6&page=1)
