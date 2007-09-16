<?php
/* Version: 1.5a (14/09/2007) */

$sel_lang = get_option('vr_lang');

switch ($sel_lang) {

case "en": // English

$vr_lang['mnu_main'] 		= "Visits";
$vr_lang['mnu_add'] 		= "Add filter";
$vr_lang['mnu_remove'] 		= "Delete filter";
$vr_lang['mnu_spam'] 		= "Delete SPAM";
$vr_lang['mnu_stats'] 		= "Stats";
$vr_lang['mnu_options'] 	= "Options";

$vr_lang['opt_old'] 		= "Counter";
$vr_lang['opt_self_IP'] 	= "Self IP";
$vr_lang['opt_delay'] 		= "Delay";
$vr_lang['opt_days'] 		= "Range";
$vr_lang['opt_year'] 		= "Date";
$vr_lang['opt_contact'] 	= "Contact";
$vr_lang['opt_name'] 		= "Name";
$vr_lang['opt_lang'] 		= "Language";
$vr_lang['opt_display'] 	= "Display";

$vr_lang['opt_frm_title']		= "Options";
$vr_lang['opt_frm_sub']			= "Stored values";

$vr_lang['opt_lbl_old'] 		= "Old counter visits:";
$vr_lang['opt_lbl_self_IP'] 	= "Self IP:";
$vr_lang['opt_lbl_delay'] 		= "Register delay:";
$vr_lang['opt_lbl_days'] 		= "Visits Report:";
$vr_lang['opt_lbl_year'] 		= "Copyright date:";
$vr_lang['opt_lbl_contact'] 	= "Contact data:";
$vr_lang['opt_lbl_name'] 		= "Contact Name:";
$vr_lang['opt_lbl_update'] 		= "Updated:";
$vr_lang['opt_lbl_lang'] 		= "Language:";
$vr_lang['opt_lbl_display'] 	= "Display:";
$vr_lang['opt_lbl_visits'] 		= "Number of visits:";
$vr_lang['opt_lbl_datelimit'] 	= "Data base limit:";

$vr_lang['opt_msg_old'] 		= "when erasing the entrances of Robots, Spam, etc., the number of accumulated Hits is recorded";
$vr_lang['opt_msg_self_IP'] 	= "visits from this IP will be excluded";
$vr_lang['opt_msg_delay'] 		= "time, in seconds, to register a new visit with the same IP";
$vr_lang['opt_msg_days'] 		= "number of days to show in last visits. Display max. 1000 results.";
$vr_lang['opt_msg_year'] 		= "date to show after the symbol of &copy;";
$vr_lang['opt_msg_contact'] 	= "e-mail address or URL to page of contact form";
$vr_lang['opt_msg_name'] 		= "Name to show";
$vr_lang['opt_msg_update'] 		= "set to 'file' for use archivo.html or set manually date of web update";
$vr_lang['opt_msg_lang'] 		= "en [English] - es [Spanish] - it [Italian]";
$vr_lang['opt_msg_display'] 	= "1 [Copyright only] - 2 [Counter Only] - 3 [Copyright &amp; Counter]";
$vr_lang['opt_msg_numof'] 		= "Minimum number of hits to show results in stats page (for IP visits)";
$vr_lang['opt_msg_incom'] 		= "Minimum number of hits to show results in stats page (for Referer visits)";
$vr_lang['opt_msg_search'] 		= "Minimum number of hits to show results in stats page (for Search string visits)";
$vr_lang['opt_msg_host'] 		= "Minimum number of hits to show results in stats page (for Host visits)";
$vr_lang['opt_msg_datelimit'] 	= "Maximum days to preserve hits in data base. Old entries are deleted when cleaning SPAM.";

$vr_lang['opt_limit_all']		= "ALL";
$vr_lang['opt_limit_day']		= "1 day";
$vr_lang['opt_limit_week']		= "1 week";
$vr_lang['opt_limit_month']		= "1 month";
$vr_lang['opt_limit_three']		= "3 months";
$vr_lang['opt_limit_six']		= "6 months";
$vr_lang['opt_limit_year']		= "1 year";

$vr_lang['opt_btn_submit']		= "Update";

$vr_lang['add_frm_title']		= "Add no-SPAM filter";
$vr_lang['add_frm_sub']			= "Put new word to filter the data base";

$vr_lang['add_lbl_spm'] 		= "Word:";
$vr_lang['add_btn_submit']		= "Save";
$vr_lang['add_btn_spm']			= "Delete SPAM";

$vr_lang['del_frm_title']		= "Delete Words";
$vr_lang['del_frm_sub']			= "Registered words";

$vr_lang['del_btn_submit']		= "Delete";
$vr_lang['del_msg_submit']		= "WARNING: Checked elements will erase definitively.";

$vr_lang['spam_frm_title']		= "Delete SPAM";
$vr_lang['spam_frm_sub']		= "Deleted data";
$vr_lang['spam_frm_count']		= "Updated Counter visits";

$vr_lang['sta_frm_last']		= "Last registered visits ";
$vr_lang['sta_frm_nav']			= "Browser Stats";
$vr_lang['sta_frm_sys']			= "O.S. Stats";
$vr_lang['sta_frm_numof']		= "Visits Stats";
$vr_lang['sta_frm_incom']		= "Referer Stats by String";
$vr_lang['sta_frm_search']		= "Search Stats";
$vr_lang['sta_frm_host']		= "Referer Stats by Host";
$vr_lang['sta_frm_oneday']		= "24 hours";
$vr_lang['sta_frm_days']		= " days";

$vr_lang['sta_frm_sub']			= "Stats for ";
$vr_lang['sta_frm_visits']		= " visits. ";
$vr_lang['sta_frm_regs']		= " found records.";
$vr_lang['sta_frm_warning']		= "WARNING: Only show 1000 results. You must try to reduce number of days in options.";
$vr_lang['sta_frm_voidresult']	= "WARNING: No results to show yet.";
$vr_lang['sta_frm_average']		= "Average by day: ";

$vr_lang['sta_frm_date']		= "Date";
$vr_lang['sta_frm_referer']		= "Referer";
$vr_lang['sta_frm_browser']		= "Browser";
$vr_lang['sta_frm_os']			= "O.S.";
$vr_lang['sta_frm_num']			= "N&uacute;mero de Visitas";
$vr_lang['sta_frm_percent']		= "Percent";
$vr_lang['sta_frm_ip']			= "Visitor IP";
$vr_lang['sta_frm_terms']		= "Search Terms";
$vr_lang['sta_frm_hostref']		= "Host Name";
$vr_lang['sta_frm_morethan']	= "More than ";

$vr_lang['cpy_msg_updated']		= "Updated: ";
$vr_lang['cpy_msg_total']		= " - Total visits: ";
$vr_lang['cpy_msg_last']		= " - Last 24 hours: ";

$vr_lang['opt_msg_ok'] 			= "Updated options.";
$vr_lang['opt_msg_err'] 		= "Error processing OPTIONS.";
$vr_lang['opt_msg_null'] 		= "Fields cannot be void.";

$vr_lang['add_msg_ok'] 			= "Introducida nueva palabra: ";
$vr_lang['add_msg_err'] 		= "Error processing WORDS.";
$vr_lang['add_msg_null'] 		= "Fields cannot be void or negative.";

$vr_lang['del_msg_ok'] 			= "Deleted: ";
$vr_lang['del_msg_err'] 		= "Error borrando PALABRAS.";
$vr_lang['del_msg_null'] 		= "Fields cannot be void";
$vr_lang['del_msg_cnf'] 		= "Are you sure you want to delete this words?";

$vr_lang['spam_msg_akismet1'] 	= "Verify the SPAM comments with Akismet, you have ";
$vr_lang['spam_msg_akismet2'] 	= " to delete.";
$vr_lang['spam_msg_ok'] 		= "";
$vr_lang['spam_msg_blog'] 		= " SPAM comments in WordPress have been deleted.";
$vr_lang['spam_msg_stats'] 		= " SPAM records in Visits counter have been deleted.";
$vr_lang['spam_msg_count'] 		= "New data stored in old counter: ";
$vr_lang['spam_msg_time'] 		= " old records in Visits counter have been deleted.";

$vr_lang['msg_err_sql'] 		= "mysql Error: ";

break;

case "it": // Italiano - Traduzzione: Mariachiara Pezzotti

$vr_lang['mnu_main'] 		= "Visite";
$vr_lang['mnu_add'] 		= "Aggiungi filtro";
$vr_lang['mnu_remove'] 		= "Cancella filtro";
$vr_lang['mnu_spam'] 		= "Cancella SPAM";
$vr_lang['mnu_stats'] 		= "Statistiche";
$vr_lang['mnu_options'] 	= "Opzioni";

$vr_lang['opt_old'] 		= "Contatore";
$vr_lang['opt_self_IP'] 	= "Self IP";
$vr_lang['opt_delay'] 		= "Ritardo";
$vr_lang['opt_days'] 		= "Range";
$vr_lang['opt_year'] 		= "Data";
$vr_lang['opt_contact'] 	= "Contatti";
$vr_lang['opt_name'] 		= "Nome";
$vr_lang['opt_lang'] 		= "Lingua";
$vr_lang['opt_display'] 	= "Mostra";

$vr_lang['opt_frm_title']		= "Opzioni";
$vr_lang['opt_frm_sub']			= "Valori salvati";

$vr_lang['opt_lbl_old'] 		= "Visite dal vecchio contatore:";
$vr_lang['opt_lbl_self_IP'] 	= "Self IP:";
$vr_lang['opt_lbl_delay'] 		= "Ritardo registrato:";
$vr_lang['opt_lbl_days'] 		= "Report delle visite:";
$vr_lang['opt_lbl_year'] 		= "Data del copyright:";
$vr_lang['opt_lbl_contact'] 	= "Data del contatto:";
$vr_lang['opt_lbl_name'] 		= "Nome contatto:";
$vr_lang['opt_lbl_update'] 		= "Aggiorna:";
$vr_lang['opt_lbl_lang'] 		= "Lingua:";
$vr_lang['opt_lbl_display'] 	= "Mostra:";
$vr_lang['opt_lbl_visits'] 		= "Numero di visite:";
$vr_lang['opt_lbl_datelimit'] 	= "Data di base:";

$vr_lang['opt_msg_old'] 		= "quando si cancellano le visite di Robot, Spam etc... il numero accumulato delle Hits viene registrato.";
$vr_lang['opt_msg_self_IP'] 	= "Visite dagli Ip esclusi";
$vr_lang['opt_msg_delay'] 		= "tempo, in secondi, necessario a registrare una nuova visita con lo stesso IP";
$vr_lang['opt_msg_days'] 		= "Numero di giorni per vedere l'ultima visita. Si possono visualizzare al massimo 1000 risultati.";
$vr_lang['opt_msg_year'] 		= "data da mostrare dopo il simbolo &copy;";
$vr_lang['opt_msg_contact'] 	= "e-mail o URL della pagina da contattare";
$vr_lang['opt_msg_name'] 		= "Nome da mostrare";
$vr_lang['opt_msg_update'] 		= "settare 'file' per usare archivo.html o impostarlo manualmente.";
$vr_lang['opt_msg_lang'] 		= "en [Ingelse] - es [Spagnolo] - it [Italiano]";
$vr_lang['opt_msg_display'] 	= "1 [Mostra solo Copyright] - 2 [Mostra solo il contatore] - 3 [Mostra sia il Copyright che il contatore]";
$vr_lang['opt_msg_numof'] 		= "Numero minimo di hits da mostrare nella pagina delle statistiche(per le visite da IP)";
$vr_lang['opt_msg_incom'] 		= "Numero minimo di hits da mostrare nella pagina delle statistiche(Per le visite referenziate)";
$vr_lang['opt_msg_search'] 		= "Numero minimo di hits da mostrare nella pagina delle statistiche(per le  visite da stringhe di ricerca)";
$vr_lang['opt_msg_host'] 		= "Numero minimo di hits da mostrare nella pagina delle statistiche(per le visite da host)";
$vr_lang['opt_msg_datelimit'] 	= "Numero massimo di giorni per mantenere le Hits sul data base. I vecchi inserimenti verranno cancellati insieme allo SPAM.";

$vr_lang['opt_limit_all']		= "Tutti";
$vr_lang['opt_limit_day']		= "1 giorno";
$vr_lang['opt_limit_week']		= "1 settimana";
$vr_lang['opt_limit_month']		= "1 mese";
$vr_lang['opt_limit_three']		= "3 mesi";
$vr_lang['opt_limit_six']		= "6 mesi";
$vr_lang['opt_limit_year']		= "1 anno";

$vr_lang['opt_btn_submit']		= "Aggiorna";

$vr_lang['add_frm_title']		= "Aggiungi un filtro anti-SPAM";
$vr_lang['add_frm_sub']			= "Aggiungi una nuova parola filtro nel data base";

$vr_lang['add_lbl_spm'] 		= "Parola:";
$vr_lang['add_btn_submit']		= "Salva";
$vr_lang['add_btn_spm']			= "Cancella SPAM";

$vr_lang['del_frm_title']		= "Cancella Parole";
$vr_lang['del_frm_sub']			= "Parole registrate";

$vr_lang['del_btn_submit']		= "Cancella";
$vr_lang['del_msg_submit']		= "ATTENZIONE: gli elementi selezionati verranno cancellati definitivamente.";

$vr_lang['spam_frm_title']		= "Cancella SPAM";
$vr_lang['spam_frm_sub']		= "Canella dati";
$vr_lang['spam_frm_count']		= "Aggiorna il contatore delle visite";

$vr_lang['sta_frm_last']		= "Ultima visita registrata";
$vr_lang['sta_frm_nav']			= "Naviga le statistiche";
$vr_lang['sta_frm_sys']			= "O.S. statistiche";
$vr_lang['sta_frm_numof']		= "Statistiche di visita";
$vr_lang['sta_frm_incom']		= "Referer Stats di String";
$vr_lang['sta_frm_search']		= "Statistiche di ricerca";
$vr_lang['sta_frm_host']		= "Referer Stats da Host";
$vr_lang['sta_frm_oneday']		= "24 ore";
$vr_lang['sta_frm_days']		= " giorni";

$vr_lang['sta_frm_sub']			= "Statistiche per ";
$vr_lang['sta_frm_visits']		= " visite. ";
$vr_lang['sta_frm_regs']		= " record trovati.";
$vr_lang['sta_frm_warning']		= "ATTENZIONE: Verranno mostrati solo 1000 risultati. Ridurre il numero dei giorni nelle opzioni.";
$vr_lang['sta_frm_voidresult']	= "ATTENZIONE: Non sono stati trovati risultati.";
$vr_lang['sta_frm_average']		= "Media per giorno: ";

$vr_lang['sta_frm_date']		= "Data";
$vr_lang['sta_frm_referer']		= "Referer";
$vr_lang['sta_frm_browser']		= "Browser";
$vr_lang['sta_frm_os']			= "O.S.";
$vr_lang['sta_frm_num']			= "Numero di visite";
$vr_lang['sta_frm_percent']		= "Percentuale";
$vr_lang['sta_frm_ip']			= "Visitatori IP";
$vr_lang['sta_frm_terms']		= "Termini cercati";
$vr_lang['sta_frm_hostref']		= "Nome Host";
$vr_lang['sta_frm_morethan']	= "Pi&ugrave; di ";

$vr_lang['cpy_msg_updated']		= "Aggiorna: ";
$vr_lang['cpy_msg_total']		= " Visite: ";
$vr_lang['cpy_msg_last']		= " Oggi: ";

$vr_lang['opt_msg_ok'] 			= "Aggiorna le opzioni.";
$vr_lang['opt_msg_err'] 		= "Errore nel processare le opzioni.";
$vr_lang['opt_msg_null'] 		= "Il campo non pu&ograve; essere vuoto.";

$vr_lang['add_msg_ok'] 			= "Inserisci nuova parola: ";
$vr_lang['add_msg_err'] 		= "Errore nel processare le Parole.";
$vr_lang['add_msg_null'] 		= "Il campo non pu&ograve; essere vuoto o negativo.";

$vr_lang['del_msg_ok'] 			= "Cancellazione di: ";
$vr_lang['del_msg_err'] 		= "Errore nell'inserimento delle parole.";
$vr_lang['del_msg_null'] 		= "Il campo non pu&ograve; essere lasciato vuoto";
$vr_lang['del_msg_cnf'] 		= "Sei sicuro di voler cancellare queste parole?";

$vr_lang['spam_msg_akismet1'] 	= "Verificare le comenti dello SPAM con Akismet, voi hanno";
$vr_lang['spam_msg_akismet2'] 	= " per cancellare.";
$vr_lang['spam_msg_ok'] 		= "";
$vr_lang['spam_msg_blog'] 		= " SPAM commenti in WordPress &egrave; stato cancellato.";
$vr_lang['spam_msg_stats'] 		= " SPAM registrato nel contatore delle visite &egrave; stato cancellato.";
$vr_lang['spam_msg_count'] 		= "Nuovi dati salvati nel vecchio counter: ";
$vr_lang['spam_msg_time'] 		= " I vecchi record nel contatore delle visite sono stati cancellati.";

$vr_lang['msg_err_sql'] 		= "Errore di mysql: ";

break;

default: // Spanish

$vr_lang['mnu_main'] 		= "Visitas";
$vr_lang['mnu_add'] 		= "A&ntilde;adir filtro";
$vr_lang['mnu_remove'] 		= "Borrar filtro";
$vr_lang['mnu_spam'] 		= "Borrar SPAM";
$vr_lang['mnu_stats'] 		= "Estad&iacute;sticas";
$vr_lang['mnu_options'] 	= "Opciones";

$vr_lang['opt_old'] 		= "Contador";
$vr_lang['opt_self_IP'] 	= "IP propia";
$vr_lang['opt_delay'] 		= "Retardo";
$vr_lang['opt_days'] 		= "Periodo";
$vr_lang['opt_year'] 		= "Fecha";
$vr_lang['opt_contact'] 	= "Contacto";
$vr_lang['opt_name'] 		= "Nombre";
$vr_lang['opt_lang'] 		= "Idioma";
$vr_lang['opt_display'] 	= "Mostrar";

$vr_lang['opt_frm_title']		= "Opciones";
$vr_lang['opt_frm_sub']			= "Valores guardados";

$vr_lang['opt_lbl_old'] 		= "Contador de visitas antiguo:";
$vr_lang['opt_lbl_self_IP'] 	= "IP propia:";
$vr_lang['opt_lbl_delay'] 		= "Retardo entre visitas:";
$vr_lang['opt_lbl_days'] 		= "Resumen de visitas:";
$vr_lang['opt_lbl_year'] 		= "Fecha del Copyright:";
$vr_lang['opt_lbl_contact'] 	= "Datos de contacto:";
$vr_lang['opt_lbl_name'] 		= "Nombre de contacto:";
$vr_lang['opt_lbl_update'] 		= "Actualizado:";
$vr_lang['opt_lbl_lang'] 		= "Idioma:";
$vr_lang['opt_lbl_display'] 	= "Mostrar:";
$vr_lang['opt_lbl_visits'] 		= "N&uacute;mero de visitas:";
$vr_lang['opt_lbl_datelimit'] 	= "L&iacute;mite de la base de datos:";

$vr_lang['opt_msg_old'] 		= "al borrar las entradas de Robots, SPAM, etc., se guarda el n&uacute;mero de Hits acumulados";
$vr_lang['opt_msg_self_IP'] 	= "se excluir&aacute;n las visitas desde esta direcci&oacute;n IP";
$vr_lang['opt_msg_delay'] 		= "tiempo, en segundos, para registrar una nueva visita con la misma IP";
$vr_lang['opt_msg_days'] 		= "periodo, en d&iacute;as, para mostrar en el listado de visitas. Muestra m&aacute;x. 1000 registros.";
$vr_lang['opt_msg_year'] 		= "fecha a mostrar despues del s&iacute;mbolo del &copy;";
$vr_lang['opt_msg_contact'] 	= "direcci&oacute;n de e-mail o URL de la p&aacute;gina del formulario de contacto";
$vr_lang['opt_msg_name'] 		= "Nombre para mostrar en el contacto";
$vr_lang['opt_msg_update'] 		= "valor 'archivo' usar&aacute; el fichero actualizado.html, o bien introduce a mano la fecha de actualizaci&oacute;n de la WEB";
$vr_lang['opt_msg_lang'] 		= "en [English] - es [Spanish] - it [Italian]";
$vr_lang['opt_msg_display'] 	= "1 [S&oacute;lo Copyright] - 2 [S&oacute;lo Contador] - 3 [Copyright y Contador]";
$vr_lang['opt_msg_numof'] 		= "N&uacute;mero m&iacute;nimo de visitas para mostrar resultados en la p&aacute;gina de estad&iacute;sticas (por IP)";
$vr_lang['opt_msg_incom'] 		= "N&uacute;mero m&iacute;nimo de visitas para mostrar resultados en la p&aacute;gina de estad&iacute;sticas (por Referente)";
$vr_lang['opt_msg_search'] 		= "N&uacute;mero m&iacute;nimo de visitas para mostrar resultados en la p&aacute;gina de estad&iacute;sticas (por Cadena de B&uacute;squeda)";
$vr_lang['opt_msg_host'] 		= "N&uacute;mero m&iacute;nimo de visitas para mostrar resultados en la p&aacute;gina de estad&iacute;sticas (por Anfitri&oacute;n (Host)";
$vr_lang['opt_msg_datelimit'] 	= "N&uacute;mero m&aacute;ximo de d&iacute;as para conservar los registros en la base de datos. Las entradas antiguas se borran al limpiar el SPAM.";

$vr_lang['opt_limit_all']		= "TODAS";
$vr_lang['opt_limit_day']		= "1 d&iacute;a";
$vr_lang['opt_limit_week']		= "1 semana";
$vr_lang['opt_limit_month']		= "1 mes";
$vr_lang['opt_limit_three']		= "3 meses";
$vr_lang['opt_limit_six']		= "6 meses";
$vr_lang['opt_limit_year']		= "1 a&ntilde;o";

$vr_lang['opt_btn_submit']		= "Actualizar";

$vr_lang['add_frm_title']		= "A&ntilde;adir filtro anti-SPAM";
$vr_lang['add_frm_sub']			= "Introducir nueva palabra para filtrar la base de datos";

$vr_lang['add_lbl_spm'] 		= "Palabra:";
$vr_lang['add_btn_submit']		= "Guardar";
$vr_lang['add_btn_spm']			= "Borrar SPAM";

$vr_lang['del_frm_title']		= "Borrar Palabras";
$vr_lang['del_frm_sub']			= "Palabras registradas";

$vr_lang['del_btn_submit']		= "Borrar";
$vr_lang['del_msg_submit']		= "NOTA: Los elementos marcados se borrar&aacute;n definitivamente.";

$vr_lang['spam_frm_title']		= "Borrar SPAM";
$vr_lang['spam_frm_sub']		= "Datos Borrados";
$vr_lang['spam_frm_count']		= "Actualizaci&oacute;n del contador de visitas";

$vr_lang['sta_frm_last']		= "&Uacute;ltimas visitas registradas ";
$vr_lang['sta_frm_nav']			= "Estad&iacute;sticas por Navegador";
$vr_lang['sta_frm_sys']			= "Estad&iacute;sticas por Sistema Operativo";
$vr_lang['sta_frm_numof']		= "Estad&iacute;sticas por N&uacute;mero de Visitas";
$vr_lang['sta_frm_incom']		= "Estad&iacute;sticas por Referente";
$vr_lang['sta_frm_search']		= "Estad&iacute;sticas por Cadena de B&uacute;squeda";
$vr_lang['sta_frm_host']		= "Estad&iacute;sticas por Anfitri&oacute;n (host)";
$vr_lang['sta_frm_oneday']		= "24 horas";
$vr_lang['sta_frm_days']		= " d&iacute;as";

$vr_lang['sta_frm_sub']			= "Estad&iacute;sticas  sobre ";
$vr_lang['sta_frm_visits']		= " visitas. ";
$vr_lang['sta_frm_regs']		= " registros encontrados.";
$vr_lang['sta_frm_warning']		= "ATENCI&Oacute;N: S&oacute;lo se muestran 1000 registros. Prueba a reducir el n&uacute;mero de d&iacute;as en las opciones.";
$vr_lang['sta_frm_voidresult']	= "ATENCI&Oacute;N: No hay resultados para mostrar todav&iacute;a.";
$vr_lang['sta_frm_average']		= "Promedio por d&iacute;a: ";

$vr_lang['sta_frm_date']		= "Fecha";
$vr_lang['sta_frm_referer']		= "Referente";
$vr_lang['sta_frm_browser']		= "Navegador";
$vr_lang['sta_frm_os']			= "S. O.";
$vr_lang['sta_frm_num']			= "N&uacute;mero de Visitas";
$vr_lang['sta_frm_percent']		= "Porcentaje";
$vr_lang['sta_frm_ip']			= "IP Visitante";
$vr_lang['sta_frm_terms']		= "Cadena de B&uacute;squeda";
$vr_lang['sta_frm_hostref']		= "Anfitri&oacute;n";
$vr_lang['sta_frm_morethan']	= "M&aacute;s de ";

$vr_lang['cpy_msg_updated']		= "Actualizado: ";
$vr_lang['cpy_msg_total']		= " - Visitas totales: ";
$vr_lang['cpy_msg_last']		= " - &Uacute;ltimas 24 horas: ";

$vr_lang['opt_msg_ok'] 			= "Opciones actualizadas.";
$vr_lang['opt_msg_err'] 		= "Error procesando OPCIONES.";
$vr_lang['opt_msg_null'] 		= "No puede ser nulo ni negativo.";

$vr_lang['add_msg_ok'] 			= "Introducida nueva palabra: ";
$vr_lang['add_msg_err'] 		= "Error procesando PALABRA.";
$vr_lang['add_msg_null'] 		= "Debes completar la ficha...";

$vr_lang['del_msg_ok'] 			= "Se ha borrado: ";
$vr_lang['del_msg_err'] 		= "Error borrando PALABRAS.";
$vr_lang['del_msg_null'] 		= "No puede ser nulo";
$vr_lang['del_msg_cnf'] 		= "Est&aacute;s seguro de querer borrar estas palabras?";

$vr_lang['spam_msg_akismet1'] 	= "Verifica el SPAM con Akismet, tienes ";
$vr_lang['spam_msg_akismet2'] 	= " comentarios de SPAM en el WEBlog.";
$vr_lang['spam_msg_ok'] 		= "Se han borrado ";
$vr_lang['spam_msg_blog'] 		= " comentarios de SPAM en el WEBlog.";
$vr_lang['spam_msg_stats'] 		= " registros de SPAM en el contador de Visitas.";
$vr_lang['spam_msg_count'] 		= "Nuevo dato almacenado en contador antiguo: ";
$vr_lang['spam_msg_time'] 		= " registros antiguos en el contador de Visitas.";

$vr_lang['msg_err_sql'] 		= "Se ha producido un error de mysql: ";

break;

}

?>