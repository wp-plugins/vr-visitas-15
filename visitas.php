<?php
/*
Plugin Name: VR-Visitas
Plugin URI: http://www.vruiz.net/2007/09/16/vr-visitas-2/
Description: Registra las visitas a tu p&aacute;gina y lo muestra junto al Copyright.<br />Allow you to take a record of the visits to your page and it shows information of the author Copyright and the update date of page. 
Version: 1.6
Author: Vicen&ccedil; Ruiz
Author URI: http://www.vruiz.net
*/

/*  Copyright 2006  Vicen&ccedil; Ruiz (email : webmaster@vruiz.net) */

// Crea la Bases de datos para el contador de visitas y registro de filtros
// ------------------------------------------------------------------------

add_action('activate_visitas/visitas.php','vr_install');

function vr_install () {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $table_prefix, $wpdb;

	$tbl_visitas = $table_prefix."vr_visitas";
	if($wpdb->get_var("show tables like '$tbl_visitas'") != $tbl_visitas) {
		$sql = "CREATE TABLE $tbl_visitas (
			ip varchar(15) NOT NULL default '',
			fecha int(14) unsigned NOT NULL default '0',
			referer varchar(255) NOT NULL default '',
			browser varchar(100) NOT NULL default '',
			os varchar(100) NOT NULL default '',
			search varchar(100) NOT NULL default '',
			host VARCHAR(100) NOT NULL default '',
			KEY ip (ip)
		);";
		dbDelta($sql);
	} else {
		$sql = "ALTER TABLE $tbl_visitas 
			ADD search VARCHAR(100) NOT NULL, 
			ADD host VARCHAR(100) NOT NULL
		";
		$wpdb->query($sql);
	}		 

	$tbl_spam = $table_prefix."vr_spam";
	if($wpdb->get_var("show tables like '$tbl_spam'") != $tbl_spam) {
		$sql = "CREATE TABLE $tbl_spam (
			idSpam int(6) NOT NULL auto_increment,
			palabra tinytext NOT NULL,
			PRIMARY KEY  (idSpam)
		);";
		dbDelta($sql);
	}

	add_option('vr_old', 0, 'Contador', 'yes');
	add_option('vr_self_IP', "0.0.0.0", 'IP propia', 'yes'); // AQUI DEBES INDICAR TU IP //
	add_option('vr_delay', 3600, 'Retardo', 'yes'); // EN SEGUNDOS
	add_option('vr_days', 3, 'Periodo', 'yes'); // EN DIAS
	add_option('vr_year', "0000-0000", 'Fecha', 'yes'); // TEXTO
	add_option('vr_contact', "emailto:yourname@yourdomain.com", 'Contacto', 'yes'); // TEXTO
	add_option('vr_name', "Your Name", 'Nombre', 'yes'); // TEXTO
	add_option('vr_update', "file", 'Actualizado', 'yes'); // TEXTO
	add_option('vr_lang', "es", 'Idioma', 'yes'); // TEXTO
	add_option('vr_display', "3", 'Mostrar', 'yes'); // NUM
	add_option('vr_numof', "25", 'IP Visits', 'yes'); // NUM
	add_option('vr_incom', "10", 'Referer visits', 'yes'); // NUM
	add_option('vr_search', "10", 'Search visits', 'yes'); // NUM
	add_option('vr_host', "25", 'Host Visits', 'yes'); // NUM
	add_option('vr_datelimit', "all", 'Database Time Limit', 'yes'); // NUM
}



// VR Menu - Crea los menus en el Panel de Administracion
// ------------------------------------------------------
require_once("visitas_lang.php");
add_action('admin_menu', 'vr_menu');
add_action('plugins_loaded', 'widget_visitas_init');

if (function_exists('wp_cron_init')) {
	add_action('wp_cron_daily', 'vr_cron_visitas');
}

function vr_cron_visitas() {
		borrarSpam();
}

function vr_menu() {
global $vr_lang;
	if (function_exists('add_menu_page')) {
		add_menu_page(__($vr_lang['mnu_main']), __($vr_lang['mnu_main']), 8, 'visitas/visitas.php', 'vr_visitas');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('visitas/visitas.php', __($vr_lang['mnu_add']), __($vr_lang['mnu_add']), 8, 'words', 'vr_words');
		add_submenu_page('visitas/visitas.php', __($vr_lang['mnu_remove']), __($vr_lang['mnu_remove']), 8, 'filtro', 'vr_filtro');
		add_submenu_page('visitas/visitas.php', __($vr_lang['mnu_spam']), __($vr_lang['mnu_spam']), 8, 'borrar', 'vr_borrar');
		add_submenu_page('visitas/visitas.php', __($vr_lang['mnu_stats']), __($vr_lang['mnu_stats']), 8, 'stats', 'vr_stats');
		add_submenu_page('visitas/visitas.php', __($vr_lang['mnu_options']), __($vr_lang['mnu_options']), 8, 'options', 'vr_options');
	}
}



// Actualiza las opciones a traves del panel de administracion de WordPress
// ------------------------------------------------------------------------
function vr_options() {
global $vr_lang;
	if ($_POST["validar"] == "opciones") {
		foreach($_POST as $key => $value) {
			if ($value == "" ) $no .= "NO";
		}
		if (!isset($no) && ($_POST['vr_days'] > 0) && ($_POST['vr_delay'] > 0) && ($_POST['vr_numof'] > 0) 
			&& ($_POST['vr_incom'] > 0) && ($_POST['vr_search'] > 0) && ($_POST['vr_host'] > 0)) {
			foreach($_POST as $key => $value) {
				if ($key != "validar") {
					update_option($key, $value);
				}
			}
			if (!mysql_error())	{
				$msg .= $vr_lang['opt_msg_ok'];
			} else	{
				$msg = "<span style='color: #FF0000'>".$vr_lang['opt_msg_err']."</span> ";
				$msg .= $vr_lang['msg_err_sql'] . mysql_error();
			}
		} else	{	
			$msg = "<span style='color: #FF0000'>".$vr_lang['opt_msg_err']."</span> ";
			$msg .= $vr_lang['opt_msg_null'];
		}
	}
	if ($msg!='') : ?>
		<div id="message" class="updated fade"><p><strong><?php print $msg; ?></strong></p></div>
	<?php endif; ?>	
	<div class="wrap">		
		<h2><?php echo $vr_lang['opt_frm_title']; ?></h2>
		<fieldset class="options">
			<legend><?php echo $vr_lang['opt_frm_sub']; ?></legend><br />
			<form method="post" name="validar_opciones" action="?page=options">
				<input name="validar" type="hidden" value="opciones" />
				<table width="100%" cellspacing="3" cellpadding="3">
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_old']; ?></td>
						<td style='text-align: left'><input style='text-align: right' type="text" name="vr_old" size="7" value="<?php echo get_option('vr_old'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_old']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_self_IP']; ?></td>
						<td style='text-align: left'><input style='text-align: center' type="text" name="vr_self_IP" size="12" value="<?php echo get_option('vr_self_IP'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_self_IP']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_delay']; ?></td>
						<td style='text-align: left'><input style='text-align: right' type="text" name="vr_delay" size="4" value="<?php echo get_option('vr_delay'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_delay']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_days']; ?></td>
						<td style='text-align: left'><input style='text-align: right' type="text" name="vr_days" size="2" value="<?php echo get_option('vr_days'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_days']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_year']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_year" size="10" value="<?php echo get_option('vr_year'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_year']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_contact']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_contact" size="60" value="<?php echo get_option('vr_contact'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_contact']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_name']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_name" size="48" value="<?php echo get_option('vr_name'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_name']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_update']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_update" size="10" value="<?php echo get_option('vr_update'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_update']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_lang']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_lang" size="4" value="<?php echo get_option('vr_lang'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_lang']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_display']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_display" size="4" value="<?php echo get_option('vr_display'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_display']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_visits']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_numof" size="4" value="<?php echo get_option('vr_numof'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_numof']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_visits']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_incom" size="4" value="<?php echo get_option('vr_incom'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_incom']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_visits']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_search" size="4" value="<?php echo get_option('vr_search'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_search']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_visits']; ?></td>
						<td style='text-align: left'><input style='text-align: left' type="text" name="vr_host" size="4" value="<?php echo get_option('vr_host'); ?>" />
						<br />(<?php echo $vr_lang['opt_msg_host']; ?>)</td>
					</tr>
					<tr>
						<td style='text-align: left'><?php echo $vr_lang['opt_lbl_datelimit']; ?></td>
						<td style='text-align: left'>
						<select size="1" name="vr_datelimit">
						<?php
							$date_limits = array('opt_limit_all' => "all", 
								'opt_limit_day' => 1, 'opt_limit_week' => 7, 
								'opt_limit_month' => 30, 'opt_limit_three' => 90,
								'opt_limit_six' => 180, 'opt_limit_year' => 365 
							);
							foreach($date_limits as $caption => $value) {
								if ($value != get_option('vr_datelimit')) {
									echo '<option value="'.$value.'">'.$vr_lang[$caption].'</option>';
								} else {
									echo '<option selected="selected" value="'.$value.'">'.$vr_lang[$caption].'</option>';
								}
							}
						?>
						</select>
						<br />(<?php echo $vr_lang['opt_msg_datelimit']; ?>)</td>
					</tr>
					<tr>
						<td colspan="3" style='text-align: center'><input type="submit" value="<?php echo $vr_lang['opt_btn_submit']; ?>" name="" /></td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>
<?php
}



// Formulario para agregar filtros a la base de datos
// --------------------------------------------------
function vr_words() {
	global $table_prefix, $wpdb, $vr_lang;
	$tbl_spam = $table_prefix."vr_spam";

	if ($_POST["validar"] == "palabra") {
		if (!empty($_POST['palabra']))	{
			$wpdb->query("INSERT INTO $tbl_spam ( palabra ) VALUES ( '$_POST[palabra]' )");
			if (!mysql_error())	{
				$msg = "Introducida nueva palabra: ".$_POST[palabra];
			} else {
				$msg = "<span style='color: #FF0000'>".$vr_lang['spm_msg_err']."</span> ";
				$msg .= $vr_lang['msg_err_sql'] . mysql_error();
			}
		} else {	
			$msg = "<span style='color: #FF0000'>".$vr_lang['spm_msg_err']."</span> ".$vr_lang['del_msg_null'];
		}
	}
	?>
	<?php
		if ($msg!='') : ?>
			<div id="message" class="updated fade"><p><strong><?php print $msg; ?></strong></p></div>
	<?php endif; ?>	
	<div class="wrap">		
		<h2><?php echo $vr_lang['add_frm_title']; ?></h2>
		<fieldset class="options">
			<legend><?php echo $vr_lang['add_frm_sub']; ?></legend><br />
			<table width="100%" cellspacing="3" cellpadding="3">
				<tr>
					<td>
						<form method='post' action='?page=words'>
							<input name="validar" type="hidden" value="palabra" />
							<table cellspacing="3" cellpadding="3">
								<tr>
									<td style='text-align: right'><?php echo $vr_lang['add_lbl_spm']; ?></td>
									<td style='text-align: left'><input type='text' name='palabra' size='50' /></td>
									<td style='text-align: left'><input type='submit' value="<?php echo $vr_lang['add_btn_submit']; ?>" /></td>
								</tr>
							</table>
						</form>
					</td>
					<td style='text-align: right'>
						<form method='post' action='?page=borrar'>
							<table cellspacing="3" cellpadding="3">
							<tr>
								<td style='text-align: right'><input type="submit" value="<?php echo $vr_lang['add_btn_spm']; ?>" /></td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</fieldset>	
	</div>
<?php
}


// Borra de la base de datos las entradas que coincidan con las palabras de filtro
// -------------------------------------------------------------------------------
function vr_borrar() {
global $vr_lang;
?>
<div class="wrap">
	<h2><?php echo $vr_lang['spam_frm_title']; ?></h2>

	<?php 
		list($msg1, $msg2, $msg3, $msg4) = explode("@",borrarSpam());
	?>

	<fieldset class="options">
		<legend><?php echo $vr_lang['spam_frm_sub']; ?></legend>
			<ul>
				<li><?php echo $msg1; ?></li>
				<li><?php echo $msg2; ?></li>
				<li><?php echo $msg3; ?></li>
			</ul>
		<legend><?php echo $vr_lang['spam_frm_count']; ?></legend>
		<div id="message" class="updated fade"><p><?php echo $msg4; ?></p></div>
	</fieldset>	
</div>
<?php
}

function borrarSpam() {
	// crea la lista de palabras a borrar y ejecuta la consulta
	// --------------------------------------------------------
	global $table_prefix, $wpdb, $vr_lang;
	$tbl_spam = $table_prefix . "vr_spam";
	$tbl_visitas = $table_prefix."vr_visitas";
	$now = time();
	$datelimit = (get_option('vr_datelimit') != "all") ? ($now - (get_option('vr_datelimit')*60*60*24)) : 0;

	$contador = $wpdb->get_var("SELECT COUNT(*) AS count FROM $wpdb->comments WHERE comment_approved = 'SPAM'");
	if ( !function_exists('akismet_delete_old') ) {
		$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'SPAM'");
		$wpdb->query("OPTIMIZE TABLE $wpdb->comments");
		if (!mysql_error())	{
			$msg1 = $vr_lang['spam_msg_ok'] . $contador . $vr_lang['spam_msg_blog'];
		} else {
			$msg1 = $vr_lang['msg_err_sql'] . mysql_error();
		}
	} else {
		$msg1 = $vr_lang['spam_msg_akismet1'] . $contador . $vr_lang['spam_msg_akismet2'];
	}
		
	$spam =" referer LIKE '%poker%'";
	$results = $wpdb->get_results("SELECT * FROM $tbl_spam"); 
	foreach ($results as $result) {
		$spam .= " OR referer LIKE '%".$result->palabra."%'";
	} 
	$spam .= " OR browser LIKE '%yahoo%'";
	$spam .= " OR browser LIKE '%some feed monger%'";
	$spam .= " OR browser LIKE '%bot%'";
	$spam .= " OR browser LIKE '%otro%'";
	$spam .= " OR os LIKE '%desconocido%'";
	$spam .= " OR ip LIKE '%unknow%'";
		
	$spamcount = $wpdb->get_var("SELECT COUNT(*) AS count FROM $tbl_visitas WHERE ".$spam);
	$timecount = $wpdb->get_var("SELECT COUNT(*) AS count FROM $tbl_visitas WHERE fecha < ".$datelimit);
	$wpdb->query("DELETE FROM $tbl_visitas WHERE".$spam." OR fecha < ".$datelimit);
	$wpdb->query("OPTIMIZE TABLE $tbl_visitas");
	
	$valor = get_option('vr_old');
	$valor = $valor + $spamcount + $timecount;
	update_option('vr_old', $valor);
				
	if (!mysql_error())	{
		$msg2 = $vr_lang['spam_msg_ok'] . $spamcount . $vr_lang['spam_msg_stats'];
		$msg3 = $vr_lang['spam_msg_ok'] . $timecount . $vr_lang['spam_msg_time'];
		$msg4 = $vr_lang['spam_msg_count'] . $valor . ".";
	} else {
		$msg2 = $vr_lang['msg_err_sql'] . mysql_error();
	}
	
	$msgs = "$msg1@$msg2@$msg3@$msg4";
	return $msgs;
}



// Muestra las ultimas visitas registradas. El periodo se selecciona como una opcion
// ---------------------------------------------------------------------------------
function vr_visitas() {
	global $table_prefix, $wpdb, $vr_lang;
	$tbl_visitas = $table_prefix."vr_visitas";
	$dias = get_option('vr_days');
	$periodo = ($dias == 1) ? $vr_lang['sta_frm_oneday'] : $periodo = $dias.$vr_lang['sta_frm_days'];
	$limite = time() - (86400 * $dias);
	$visitas = $wpdb->get_var("SELECT COUNT(*) AS count FROM $tbl_visitas");
?>
<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_last']." (".$periodo.")"; ?></h2>
	<fieldset class="options">
		<?php 
			$registros = $wpdb->get_var("SELECT COUNT(*) AS count FROM $tbl_visitas WHERE fecha > " . $limite);
			$promedio = ceil($registros/$dias);
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $registros
			. $vr_lang['sta_frm_regs'] . " (" . $vr_lang['sta_frm_average'] . $promedio . ")</legend>";
			if ($registros < 1001) {
		?>
		<table cellspacing="3" cellpadding="3" border="0" width="100%">
			<tr>
				<th><?php echo $vr_lang['sta_frm_date']; ?></th>
				<th><?php echo $vr_lang['sta_frm_referer']; ?></th>
				<th><?php echo $vr_lang['sta_frm_browser']; ?></th>
				<th><?php echo $vr_lang['sta_frm_os']; ?></th>
			</tr>
			<?php
				$results = $wpdb->get_results("SELECT * FROM $tbl_visitas WHERE fecha > $limite ORDER BY fecha DESC"); 
					foreach ($results as $result) {
						$reflink = "<a target='_blank' href='".$result->referer."'>".substr($result->referer, 0, 50)."</a>";
						$_date = date("d\/m\/y - H:i",$result->fecha);
						$class = ('alternate' == $class) ? '' : 'alternate';
						echo "<tr class=" . $class . "><td align='center'>$_date</td><td>$reflink</td>";
						echo "<td align='center'>$result->browser</td><td align='center'>$result->os</td></tr>";
					}
				} else if ($registros == 0) {
					echo "<div id='message' class='updated fade'><p>".$vr_lang['sta_frm_voidresult']."</p></div>";
				} else {
					echo "<div id='message' class='updated fade'><p>".$vr_lang['sta_frm_warning']."</p></div>";
				}
			?>
		</table>
	</fieldset>
</div>
<?php
}



// Muestra diversas estadisticas de la base de datos
// -------------------------------------------------
function vr_stats() {
	global $table_prefix, $wpdb, $vr_lang;
	$tbl_visitas = $table_prefix."vr_visitas";
	$visitas = $wpdb->get_var("SELECT COUNT(*) AS count FROM $tbl_visitas");
?>
<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_nav']; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT browser, COUNT(browser) AS count FROM $tbl_visitas GROUP BY browser ORDER BY count DESC";
			$registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_browser'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>

<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_sys']; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT os, COUNT(os) AS count FROM $tbl_visitas GROUP BY os ORDER BY count DESC";
			$total_registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $total_registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_os'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>

<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_numof']." (".$vr_lang['sta_frm_morethan'].get_option('vr_numof').$vr_lang['sta_frm_visits'].")"; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT ip, COUNT(ip) AS count FROM $tbl_visitas GROUP BY ip HAVING count >= ".get_option('vr_numof')." ORDER BY count DESC, ip ASC";
			$total_registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $total_registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_ip'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>

<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_incom']." (".$vr_lang['sta_frm_morethan'].get_option('vr_incom').$vr_lang['sta_frm_visits'].")"; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT referer, COUNT(referer) AS count FROM $tbl_visitas WHERE referer != '' GROUP BY referer HAVING count >= ".get_option('vr_incom')." ORDER BY count DESC, referer ASC";
			$total_registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $total_registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_referer'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>

<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_search']." (".$vr_lang['sta_frm_morethan'].get_option('vr_search').$vr_lang['sta_frm_visits'].")"; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT search, COUNT(search) AS count FROM $tbl_visitas WHERE search != '' GROUP BY search HAVING count >= ".get_option('vr_search')." ORDER BY count DESC";
			$total_registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $total_registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_terms'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>

<div class="wrap">
	<h2><?php echo $vr_lang['sta_frm_host']." (".$vr_lang['sta_frm_morethan'].get_option('vr_host').$vr_lang['sta_frm_visits'].")"; ?></h2>
	<fieldset class="options">
		<?php 
			$query = "SELECT host, COUNT(host) AS count FROM $tbl_visitas WHERE host != '' GROUP BY host HAVING count >= ".get_option('vr_host')." ORDER BY count DESC, host ASC";
			$total_registros = mysql_num_rows(mysql_query($query));
			echo "<legend>".$vr_lang['sta_frm_sub'] . $visitas . $vr_lang['sta_frm_visits'] . $total_registros . $vr_lang['sta_frm_regs']."</legend>";
			$col1 = $vr_lang['sta_frm_hostref'];
			$col2 = $vr_lang['sta_frm_num'];
			$col3 = $vr_lang['sta_frm_percent'];
			vr_list_stats($query,$visitas,$col1,$col2,$col3);
		?>
	</fieldset>
</div>
<?php 
}

// Crea la lista de resultados para los cuadros de estadsticas
// ------------------------------------------------------------
function vr_list_stats($query,$visitas,$col1,$col2,$col3) {
	global $wpdb, $vr_lang;
	
	$results = $wpdb->get_results($query,ARRAY_N);
	if ($results) {
	echo '<table cellspacing="3" cellpadding="3" border="0" width="100%">';
	echo '<tr><th>'.$col1.'</th><th>'.$col2.'</th><th>'.$col3.'</th></tr>';

	foreach ($results as $result) {
		$percent = bcdiv($result[1]*100, $visitas, 2)."%";
		if ($col1 == $vr_lang['sta_frm_referer']) {
			$result[0] = "<a target='_blank' href='".$result[0]."'>".substr($result[0], 0, 70)."</a>";
		}
		if ($col1 == $vr_lang['sta_frm_hostref']) {
			$result[0] = "<a target='_blank' href='http://".$result[0]."'>".$result[0]."</a>";
		}
		$class = ('alternate' == $class) ? '' : 'alternate';
		echo "<tr class=" . $class . "><td>$result[0]</td><td align='center'>$result[1]</td><td align='center'>$percent</td></tr>";
	}
	echo '</table>';
	} else if (!$results) {
		echo "<div id='message' class='updated fade'><p>".$vr_lang['sta_frm_voidresult']."</p></div>";
	} else {
		echo "<div id='message' class='updated fade'><p>".$vr_lang['sta_frm_warning']."</p></div>";
	}
}


// Registra los datos del visitante - Basado en el script de Angel Ruiz
// --------------------------------------------------------------------
function vr_userinfo() {
	$ip = vr_GetIPAddress();
	$browser = vr_GetBrowser($_SERVER['HTTP_USER_AGENT']);
	$os = vr_GetOS($_SERVER['HTTP_USER_AGENT']);
	$referer = $_SERVER['HTTP_REFERER'];
	$host = parse_url($referer);	
	$search = vr_search_imgs($referer);
	if ($search == "") {
		$term = vr_search_terms($referer);
	}
	return "$ip@$browser@$os@$referer@$search@$host[host]";
}

function vr_GetIPAddress() {
    if(isSet($_SERVER)) {
        if(isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if(isSet($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
            $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
        } else if( getenv( 'HTTP_CLIENT_IP' ) ) {
            $realip = getenv( 'HTTP_CLIENT_IP' );
        } else {
            $realip = getenv( 'REMOTE_ADDR' );
        }
    }
    return $realip;
}

function vr_GetBrowser($ua)	{
	$ua = strtolower($ua);
	if(strpos($ua, "opera") !== false) { return "Opera"; }
	else if(strpos($ua, "msie 6.0") !== false) { return "MSIE 6.0"; }
	else if(strpos($ua, "msie 7.0") !== false) { return "MSIE 7.0"; }
	else if(strpos($ua, "yahoofeedseeker") !== false) { return "Yahoo Feed Seeker"; }
	else if(strpos($ua, "msie 5.5") !== false) {return "MSIE 5.5"; }
	else if(strpos($ua, "msie 5.0") !== false) { return "MSIE 5.0"; }
	else if(strpos($ua, "msie 4.") !== false) { return "MSIE 4.0"; }
	else if(strpos($ua, "gecko") !== false && strpos($ua, "firebird") !== false) { return "Mozilla Firebird"; }
	else if(strpos($ua, "gecko") !== false && strpos($ua, "firefox") !== false) { return "Mozilla Firefox"; }
	else if(strpos($ua, "gecko") !== false && strpos($ua, "safari") !== false) { return "Apple Safari"; }
	else if(strpos($ua, "konqueror") !== false) { return "Konqueror"; }
	else if(strpos($ua, "gecko") !== false) { return "Mozilla"; }
	else if(strpos($ua, "mozilla/4.") !== false) { return "Netscape 4.X"; }
	else if(strpos($ua, "mozilla/3.") !== false) { return "Netscape 3.X"; }
	else if(strpos($ua, "trillianpro") !== false) { return "Trillian Pro"; }
	else if(strpos($ua, "feedster") !== false) { return "Feedster"; }
	else if(strpos($ua, "feedrover")) { return "FeedRover"; }
	else if(strpos($ua, "lmspider") !== false) { return "lmspider"; }
	else if(strpos($ua, "googlebot") !== false) { return "Googlebot"; }
	else if(strpos($ua, "technoratibot") !== false) { return "Technoratibot"; }
	else if(strpos($ua, "blo.gs") !== false) { return "blo.gs"; }
	else if(strpos($ua, "obidos-bot") !== false) { return "obidos-bot"; }
	else if(strpos($ua, "blogsnowbot") !== false) { return "blogsnowbot"; }
	else if(strpos($ua, "fresh search") !== false) { return "Fresh Search"; }
	else if(strpos($ua, "larbin") !== false) { return "Larbin"; }
	else if(strpos($ua, "bloglines") !== false) { return "Bloglines"; }
	else if(strpos($ua, "blogpulse") !== false) { return "BlogPulse"; }
	else if(strpos($ua, "feedsucker") !== false) { return $session_id; }
	else if(strpos($ua, "npbot") !== false) { return "NPBot"; }
	else if(strpos($ua, "almaden") !== false) { return "IBM Research Crawler"; }
	else if(strpos($us, "msnbot") !== false) { return "msnbot"; }
	else if(strpos($ua, "bot") !== false) { return "Bot"; }
	else if(strpos($ua, "feeddemon") !== false) { return "FeedDemon"; }
	else if(strpos($ua, "syndic8") !== false) { return "Syndic8"; }
	else if(strpos($ua, "w3c_validator") !== false) { return "W3C Validator"; }
	else if(strpos($ua, "w3c_css_validator") !== false) { return "W3C CSS Validator"; }
	else if(strpos($ua, "feedfixer") !== false) { return "FeedFixer"; }
	else if(strpos($ua, "feedvalidator") !== false) { return "FeedValidator"; }
	else if((strpos($ua, "slurp/cat") !== false) || (strpos($ua, "yahoo! slurp") !== false)) { return "Inktomi/Yahoo"; }
	else if(strpos($ua, "fast-webcrawler") !== false) { return "Fast WebCrawler"; }
	else if(strpos($ua, "ask jeeves") !== false) { return "Ask Jeeves"; }
	else if(strpos($ua, "feed") !== false) { return "Some Feed Monger"; }
	else if(strpos($ua, "lynx") !== false) { return "Lynx"; }
	else if(strpos($ua, "mozilla/5.0") !== false) { return "Mozilla 5.0"; }
	else { return "OTRO"; }
}

function vr_GetOS($sop) {
	$sop = strtolower($sop);
	if(strpos($sop, "amiga") !== false) { return "Amiga OS"; }
	else if(strpos($sop, "windows 3.1") || strpos($sop, "win16") || (strpos($sop, "win95") && strpos($sop, "16bit")) !== false) { return "Windows 3.1/3.11"; }
	else if(strpos($sop, "nt 3.51") || strpos($sop, "nt3.51") !== false) { return "Windows NT 3.51"; }
	else if(strpos($sop, "windows 95") || strpos($sop, "win95") !== false) { return "Windows 95"; }
	else if(strpos($sop, "windows me") || (strpos($sop, "win") && strpos($sop, "4.90")) !== false) { return "Windows ME"; }
	else if(strpos($sop, "windows 98") || (strpos($sop, "win98") !== false) || (strpos($sop, "win") && strpos($sop, "3.95") !== false)) { return "Windows 98"; }
	else if(strpos($sop, "nt 5.0") || strpos($sop, "windows 2000") !== false) { return "Windows 2000"; }
	else if(strpos($sop, "nt 5.1") || strpos($sop, "windows xp") !== false) { return "Windows XP"; }
	else if(strpos($sop, "nt 5.2") !== false)  { return "Win Server 2003"; }
	else if(strpos($sop, "windows CE") !== false) { return "Windows Pocket PC"; }
	else if(strpos($sop, "nt 4") || strpos($sop, "nt4") || strpos($sop, "winnt") || strpos($sop, "windows nt") !== false) { return "Windows NT 4.0"; }
	else if(strpos($sop, "windows") !== false) { return "Windows"; }
	else if(strpos($sop, "mac os x") !== false) { return "Mac OS X"; }
	else if(strpos($sop, "68k") !== false) { return "Mac 68K"; }
	else if(strpos($sop, "mac_powerpc") || strpos($sop, "ppc") || strpos($sop, "macintosh") !== false) { return "Mac OS 8/9"; }
	else if(strpos($sop, "linux") !== false) { return "Linux"; }
	else if(strpos($sop, "freebsd") !== false) { return "FreeBSD"; }
	else if(strpos($sop, "openbsd") !== false) { return "OpenBSD"; }
	else if(strpos($sop, "netbsd") !== false) { return "NetBSD"; }
	else if(strpos($sop, "beos") !== false) { return "BeOS"; }
	else if(strpos($sop, "sunos") || strpos($sop, "solaris") !== false) { return "Sun Solaris"; }	
	else if(strpos($sop, "qnx") || strpos($sop, "photon") !== false) { return "QNX"; }
	else if(strpos($sop, "hp-ux") !== false) { return "HP-UX"; }
	else if(strpos($sop, "irix") !== false) { return "SGI IRIX"; }
	else if(strpos($sop, "aix") || strpos($sop, "ibm") !== false) { return "IBM AIX"; }
	else if(strpos($sop, "os/2") && strpos($sop, "warp") !== false) { return "OS/2 Warp"; }
	else if(strpos($sop, "os/2") !== false) { return "OS/2"; }
	else if(strpos($sop, "HURD") || (strpos($sop, "GNU") && strpos($sop, "HURD") !== false)) { return "Unix (GNU Hurd)"; }
	else if(strpos($sop, "unix") || strpos($sop, "x11") !== false) { return "Unix"; }
	else if(strpos($sop, "openssl") !== false) { return "openSSL"; }
	else { return "Desconocido"; }
}

function vr_search_terms($url) {
	$search_terms = '';
	$url = parse_url($url);
	parse_str($url['query'],$q);
	
	if (preg_match("/google\./",$url['host']))
		return $q['q'];
	else if (preg_match("/lycos\./",$url['host']))
		return $q['query'];
	else if (preg_match("/need2find\./",$url['host']))
		return $q['searchfor'];
	else if (preg_match("/mywebsearch\./",$url['host']))
		return $q['searchfor'];
	else if (preg_match("/alltheweb\./",$url['host']))
		return $q['q'];
	else if (preg_match("/altavista\./",$url['host']))
		return $q['q'];
	else if (preg_match("/mongenie\./",$url['host']))
		return $q['Keywords'];
	else if (preg_match("/yahoo\./",$url['host']))
		return $q['p'];
	else if (preg_match("/search\.aol\./",$url['host']))
		return $q['query'];
	else if (preg_match("/search\.msn\./",$url['host']))
		return $q['q'];
	else if (preg_match("/prodigy\.msn\./",$url['host']))
		return $q['q'];
	else if (preg_match("/clarin\./",$url['host']))
		return $q['Busqueda'];
}

function vr_search_imgs($url) {
	$search_terms = '';
	$url = parse_url($url);
	parse_str($url['query'],$q);
	
	if (preg_match("/google\./",$url['host']))
		return $q['imgurl'];
	else if (preg_match("/yahoo\./",$url['host']))
		return $q['imgurl'];
}

// Actualiza la Base de datos y cuenta el total de visitas (excluye la IP propia)
// -------------------------------------------- Basado en el script de Angel Ruiz
function vr_usuarios_totales() {
	global $table_prefix, $wpdb;
	$tbl_visitas = $table_prefix."vr_visitas";
	$ip_propia = get_option('vr_self_IP');
	$delay = get_option('vr_delay');

	list($ip, $browser, $os, $referer, $search, $host) = explode("@",vr_userinfo());
	$now = time();
	$limite = $now - $delay;
	if($ip != $ip_propia) {
		$rows = $wpdb->get_row("SELECT COUNT(*) AS count FROM $tbl_visitas WHERE ip = '$ip' AND fecha >". $limite);
		if($rows->count == 0) { 
			$wpdb->query("INSERT INTO $tbl_visitas (ip,fecha,referer,browser,os,search,host) VALUES ('$ip',$now,'$referer','$browser','$os','$search','$host')"); 
		}
	}
	$usuarios = $wpdb->get_row("SELECT COUNT(*) AS count FROM $tbl_visitas");
	return $usuarios->count;
} 



// Selecciona el numero de usuarios dentro del limite (segundos) de la consulta
// ----------------------------------------- Basado en el script de Angel Ruiz
function vr_usuarios_limite ($limit) {
	global $table_prefix, $wpdb;
	$tbl_visitas = $table_prefix."vr_visitas";

	$now = time();
	$limite = $now - $limit;
	$usuarios = $wpdb->get_row("SELECT COUNT(*) AS count FROM $tbl_visitas WHERE fecha >". $limite);
	return $usuarios->count;
} 



// Contadores de visitas - Basados en el script de Angel Ruiz
// ----------------------------------------------------------
function vr_v_totales() {
	$valor = get_option('vr_old');
	$totales = $valor + vr_usuarios_totales();
	return $totales;
}

function vr_v_diarios() {
	$diarios = vr_usuarios_limite(86400);
	return $diarios;
}



// Elimina palabras (filtros) de la base de datos
// ----------------------------------------------
function vr_filtro() {
	global $table_prefix, $wpdb, $vr_lang;
	$tbl_spam = $table_prefix."vr_spam";

	if ($_POST["validar"] == "spam") {
		// Gracias a Angel por su ayuda en esta rutina y a Loli por su paciencia.
		foreach (array_keys($_POST) as $key) {
			if ($key != "validar" && !empty($key)) {
				$palabra = mysql_result(mysql_query("SELECT palabra FROM $tbl_spam WHERE idSpam = $key"), 0, palabra);
				$wpdb->query("DELETE FROM $tbl_spam WHERE idSpam = $key");
				if (!mysql_error()) {
					if (empty($list_palabras)) {
						$list_palabras = $palabra;
					} else {
						$list_palabras .= ", " . $palabra;
					}
				} else {				
					$msg = "<span style='color: #FF0000'>".$vr_lang['del_msg_err']."</span> ";
					$msg .= $vr_lang['msg_err_sql'] . mysql_error();
				}
			}
		}
		if (!empty($list_palabras) && $msg == '') { 
			$msg = $vr_lang['del_msg_ok'].$list_palabras;
		} else {
			$msg = "<span style='color: #FF0000'>".$vr_lang['del_msg_err']."</span> ";
			$msg .= $vr_lang['del_msg_null'];
		}
		$wpdb->query("OPTIMIZE TABLE $tbl_spam");
	}
	if ($msg != '') : ?>
		<div id="message" class="updated fade"><p><strong><?php print $msg; ?></strong></p></div>
	<?php endif; ?>	

<script type="text/javascript">
	<!--
	function checkAll(form)
	{
		for( i = 0, n = form.elements.length; i < n; i++ ) {
			if( form.elements[i].type == "checkbox" ) {
				if( form.elements[i].checked == true )
					form.elements[i].checked = false;
				else
					form.elements[i].checked = true;
			}
		}
	}
	//-->
</script>

	<div class="wrap">
		<h2><?php echo $vr_lang['del_frm_title']; ?></h2>
		<fieldset class="options">
			<legend><?php echo $vr_lang['del_frm_sub']; ?></legend><br />
			<form name="delfilter" id="delfilter" method='post' action='?page=filtro'>
				<input name="validar" type="hidden" value="spam" />
				<table border="0" width="100%">
					<tr>
					<?php
						$registros = $wpdb->get_row("SELECT COUNT(*) as count FROM $tbl_spam");
						$limite = ceil($registros->count / 5);
						for ($i=0; $i<5; $i++) {
							$inicio = $limite * $i;
					?>
						<td valign="top">
							<table cellspacing="3" cellpadding="3" border="0" width="100%">
							<?php
								$rslist = mysql_query("select * from $tbl_spam ORDER by palabra ASC LIMIT $inicio,$limite");
								vr_spam_list($rslist);
							?>
							</table>
						</td>
					<?php } ?>
					</tr>
					<tr>
						<td>
							<a href="javascript:;" onclick="checkAll(document.getElementById('delfilter')); return false; "><?php _e('Invert Checkbox Selection') ?></a>
						</td>
						<td colspan="3" style="text-align: right">
							<?php echo $vr_lang['del_msg_submit']; ?>
						</td>
						<td nowrap="nowrap" style="text-align: center">
							<input class="center" type="submit" value="<?php echo $vr_lang['del_btn_submit']; ?>" name="" onclick="return confirm('<?php echo $vr_lang['del_msg_cnf']; ?>')"/>
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>
<?php
}

// Crea la lista a mostrar en el formulario de borrar filtros
// ----------------------------------------------------------
function vr_spam_list($rslist) {
	// Generates the filter list to manage it
	$list_spam ="";
	while ($fila = mysql_fetch_array($rslist)) { 
		$class = ('alternate' == $class) ? '' : 'alternate';
		$list_spam .= '<tr class="'.$class.'"><td><input type="checkbox" name="'.$fila[idSpam].'" value="'.$fila[palabra].'" /> ' . $fila[palabra]. '</td></tr>';
	}
	echo $list_spam;
}


// Muestra los datos de Copyright y las estadisticas de visitantes.
// Debes actualizar el fichero actualizado.html, cada vez que hagas cambios, 
// para mostrar la fecha correcta.
// ------------------------------------------------------------------------------------
function vr_copyright($init="",$sep="",$end="") {
	// Generates the string $copyrigtt based on user options
	
	global $vr_lang;
	if (get_option('vr_update') == "file" || get_option('vr_update') == "archivo") {
		$fecha = implode('', file(get_settings('siteurl')."/wp-content/plugins/visitas/actualizado.html"));
	} else{
		$fecha = get_option('vr_update');
	}
	$totales = number_format(vr_v_totales());
	$diarios = number_format(vr_v_diarios());
	$copy_year = get_option('vr_year');
	$copy_contact = get_option('vr_contact');
	$copy_name = get_option('vr_name');

	$copyright = "&copy; " .$copy_year . " (<a href='".$copy_contact."'>" . $copy_name . "</a>)";
	$updated .= " - " . $vr_lang['cpy_msg_updated'] . "<b>" . $fecha . "</b>";
	$totalv .= $vr_lang['cpy_msg_total'] . "<b>" . $totales . "</b>";
	$last24 .= $vr_lang['cpy_msg_last'] . "<b>" . $diarios . "</b>";

	switch (get_option('vr_display')) {
		case "1": //copy
			$copyright = $init.$copyright.$sep.$updated.$end;
			break;
		case "2": //count
			$copyright = $init.$totalv.$sep.$last24.$end;
			break;
		default: //all
			$copyright = $init.$copyright.$sep.$updated.$sep.$totalv.$sep.$last24.$end;
			break;
	}

	echo $copyright;
}

// Muestra solo los datos de las visitas recibidas
// -----------------------------------------------
function vr_contador() {
	// Obsolete function. Now select options trough admin panel.
	vr_copyright();
}

function widget_visitas_init() {
	// Add a widget control and enable it
	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_visitas($args) {
		extract($args);
		$options = get_option('widget_visitas');
		$title = $options['title'];
		echo $before_widget . $before_title . $title . $after_title;

		// Add html tags to $copyrigth string for best show in sidebar
		$init = "<ul><li>";
		$sep = "</li><li>";
		$end = "</li></ul>";
		vr_copyright($init,$sep,$end);
		
		echo $after_widget;
	}

	function widget_visitas_control() {
		$options = get_option('widget_visitas');
		if ( !is_array($options) )
			$options = array('title'=>'Copyright');
		if ( $_POST['visitas-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['visitas-title']));
			update_option('widget_visitas', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		echo '<p style="text-align:right;"><label for="visitas-title">Title: <input style="width: 200px;" id="visitas-title" name="visitas-title" type="text" value="'.$title.'" /></label></p>';
		echo '<input type="hidden" id="visitas-submit" name="visitas-submit" value="1" />';
	}
	
	register_sidebar_widget('visitas', 'widget_visitas');
	register_widget_control('visitas', 'widget_visitas_control', 300, 100);
}
?>