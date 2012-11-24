<?php

/**
 * Přesměrování na stránku /404/
 */
function redirect404() {
	$odkaz_rewrite = $GLOBALS["odkaz_rewrite"];
	header("Location: $odkaz_rewrite/404/");
	exit;
}

/**
 * Preformatuje datum
 * @param unknown_type $datum
 * @param unknown_type $extra
 */
function print_date($datum, $extra = false) {
	if (!preg_match('~^([0-9]+)-([0-9]+)-([0-9]+) ([0-9]+):([0-9]+):([0-9]+)~', $datum, $arr)) {
		$pouze_datum = true;
		if (!preg_match('~^([0-9]+)-([0-9]+)-([0-9]+)~', $datum, $arr)) {
			return false;
		}
	}
	if ($extra) {
		if (!empty($pouze_datum)) {
			$datum = "$arr[3].$arr[2].$arr[1]";
		} else {
			$datum = "$arr[3].$arr[2].$arr[1] v $arr[4]:$arr[5]:$arr[6]";
		}
	} else {
		if (!empty($pouze_datum)) {
			$datum = "$arr[3].$arr[2].$arr[1]";
		} else {
			$datum = "$arr[3].$arr[2].$arr[1] $arr[4]:$arr[5]:$arr[6]";
		}
	}
	return $datum;
}

/**
 * Kontrola emailu
 * @param unknown_type $addres
 */
function check_email($addres) {
	// preg pattern for user name
	// http://tools.ietf.org/html/rfc2822#section-3.2.4
	$atext = "[a-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~]";
	$atom = "$atext+(\.$atext+)*";

	// preg pattern for domain
	// http://tools.ietf.org/html/rfc1034#section-3.5
	$dtext = "[a-z0-9]";
	$dpart = "$dtext+(-$dtext+)*";
	$domain = "$dpart+(\.$dpart+)+";

	if (preg_match("/^$atom@$domain$/i", $addres)) {
		list($username, $host) = @split('@', $addres);
		if (checkdnsrr($host, 'MX')) {
			return TRUE;
		}
	}
	return FALSE;
}

/**
 * Zobrazi sablonu
 * @param unknown_type $template - zvolená šablona
 */
function display_all($template) {
	$smarty = $GLOBALS["smarty"];
	if ($GLOBALS["odkaz_rewrite"]) {
		$smarty->register_outputfilter('odkaz_rewrite');
	}
	$smarty->display('include/header.tpl');
	$smarty->display($template . '.tpl');
	$smarty->display('include/footer.tpl');
}

/**
 * Vraci promennou, ktera je na localhostu potreba
 * @param unknown_type $tpl_source
 * @param unknown_type $smarty
 */
function odkaz_rewrite($tpl_source, &$smarty) {
	$nahrada = $GLOBALS["odkaz_rewrite"] . "/";
	$vyrazy = array(
		'~<(img)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i',
		'~<(a)( [^>]*)? (href)="/([^"]+)?"([^>]*)>~i',
		'~<(link)( [^>]*)? (href)="/([^"]+)"([^>]*)>~i',
		'~<(script)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i',
		'~<(form)( [^>]*)? (action)="/([^"]+)"([^>]*)>~i',
		'~<(input)( [^>]*)? (src)="/([^"]+)"([^>]*)>~i'
	);
	foreach ($vyrazy as $key => $vyraz) {
		$tpl_source = preg_replace($vyraz, "<\\1\\2 \\3=\"$nahrada\\4\"\\5>", $tpl_source);
	}
	return $tpl_source;
}

/**
 * Funkce odesle email
 * @param unknown_type $predmet
 * @param unknown_type $text
 * @param unknown_type $komu
 */
function send_mail($predmet, $text, $komu = "vojta@freshservices.cz") {
	$odkaz_rewrite = $GLOBALS["odkaz_rewrite"];
	$cfg = $GLOBALS["cfg"];
	// připravíme e-mail
	$headers = "MIME-Versin: 1.0\r\n" .
			"Content-type: text/plain; charset=utf-8; format=flowed\r\n" .
			"Content-Transfer-Encoding: 8bit\r\n" .
			"From: info@" . $cfg["url"];
	$predmet = "=?utf-8?B?" . base64_encode($predmet) . "?=";

	// pokud jsme na localhostu, tak pouze zobrazíme e-mail, neodešleme
	if (!$odkaz_rewrite) {
		mail($komu, $predmet, $text, $headers);
	} else {
		echo "$komu" . "\n" . $predmet . "\n" . $text;
	}
}

/**
 * Funkce zaloguje udalost do souboru
 * @param unknown_type $stranka
 * @param unknown_type $pozadavek
 * @param unknown_type $message
 */
function log_to_file($stranka, $pozadavek = "", $message = "", $echo = true) {
	if ($echo) echo "$stranka: $pozadavek: $message <br />";
	$path = "./log/";
	$referer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "";
	// existuje soubor s timto datem?
	$datum = new DateTime();
	$datumcas = $datum->format("Y-m-d H:i");
	$datum = $datum->format("Y-m-d");
	$log = fopen($path . $datum . ".log", "a");
	if ($log) {
		$text = $datumcas . ";" . $stranka . ";" . $pozadavek . ";" . $message . ";" . ";" . $referer . "\n";
		fwrite($log, $text);
		fclose($log);
	}
}
