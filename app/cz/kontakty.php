<?php

$data["title"] = "Kontakty";
$data["keywords"] = "Kontakty";
$data["description"] = "Kontakty";
$smarty->assign('data', $data);

/*---- CONTACT FORM -----*/
use Nette\Forms\Form;

/* contact form settings */
$email = "info@your-domain.com";
$subject = "Zpráva ze stránek " . $_SERVER["SERVER_NAME"];

/* build form */
$form = new Form();
$form->addText("jmeno", "Vaše jméno:", 60, 240)
	->setRequired('Zadejte prosím Vaše jméno');
$form->addText("telefon", "Telefon:", 60, 240);
$form->addText("email", "E-mail:", 60, 240)
	->addRule(Form::EMAIL, "Špatný formát e-mailu!")
	->setRequired('Zadejte prosím Váš e-mail');
$form->addTextArea("poznamka", "Poznámka:");
$form->addSubmit('submit', 'Odeslat zprávu')
	->setAttribute("class", "btn btn-primary");
$smarty->assign("form", $form);

/* form is submitted */
if ($form->isSubmitted()) {

	// my own validation
	// $form->addError("Moje vlastní kontrola.");
	
	// form is ok
	if ($form->isSuccess()) {

		// get values from form
		$values = $form->getValues($asArray = true);
		$text = "";
		foreach ($values as $key => $value) {
			$text .= $form[$key]->caption . " " . $value . "\n";
		}

		// send e-mail
		send_mail($subject, $text, $email);

		// 303 redirect, prevent multiple send
		header("Location: /kontakty/?sent=1", TRUE, 303);
		exit;
	}
}

// display template
display_all($request_url[0]);
