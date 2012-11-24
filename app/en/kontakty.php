<?php

$data["title"] = "Contacts";
$data["keywords"] = "Contacts";
$data["description"] = "Contacts";
$smarty->assign('data', $data);

/* Text ktery bude v predmetu odeslaneho emailu */
$predmet = "Message from pages " . $_SERVER["SERVER_NAME"];

/* Message recipient */
$adresat = "vojtasvoboda.cz@gmail.com";

// kontaktni formular
$error = false;
$error_email = false;
$error_empty = false;
$ok = false;

if (!empty($_POST["submit"])) {

	// kontrola emailu
	if (!check_email($_POST["email"])) {
		$error = true;
		$error_email = true;
	}

	// kontrola povinnych
	$povinne = array("jmeno", "email");
	foreach ($povinne as $item) {
		if (empty($_POST[$item])) {
			$error = true;
			$error_empty = true;
		}
	}

	// pokud nebyla chyba
	if (!$error) {
		// sestavime text
		$text = "Dobrý den,\n";
		$text .= "z webových stránek " . $_SERVER["SERVER_NAME"] . " Vám byla zaslána tato zpráva:\n\n";
		foreach ($_POST as $key => $value) {
			$value = htmlspecialchars($value);
			$text .= $key . ": " . $value . "\n";
		}

		// odesleme email
		send_mail($predmet, $text, $adresat);
		$ok = true;
	}
}

$smarty->assign("error", $error);
$smarty->assign("ok", $ok);
$smarty->assign("error_email", $error_email);
$smarty->assign("error_empty", $error_empty);

// zobrazíme šablonu
display_all($request_url[0]);
