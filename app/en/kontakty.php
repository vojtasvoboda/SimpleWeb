<?php

$data["title"] = "Contacts";
$data["keywords"] = "Contacts";
$data["description"] = "Contacts";
$smarty->assign('data', $data);

/*---- CONTACT FORM -----*/
use Nette\Forms\Form;

/* contact form settings */
$email = "info@your-domain.com";
$subject = "Zpráva ze stránek " . $_SERVER["SERVER_NAME"];

/* build form */
$form = new Form();
$form->addText("jmeno", "Your name:", 60, 240)
		->setRequired('Please fill your name');
$form->addText("telefon", "Phone:", 60, 240);
$form->addText("email", "E-mail:", 60, 240)
		->addRule(Form::EMAIL, "E-mail have wrong format.")
		->setRequired('Please fill your e-mail.');
$form->addTextArea("poznamka", "Note:");
$form->addSubmit('submit', 'Send message')
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
		header("Location: /en/kontakty/?sent=1", TRUE, 303);
		exit;
	}
}

// display template
display_all($request_url[0]);
