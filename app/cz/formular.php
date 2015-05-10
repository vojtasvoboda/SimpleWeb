<?php

$data["title"] = "Order";
$data["keywords"] = "Order";
$data["description"] = "Order form";
$smarty->assign('data', $data);

/*---- CONTACT FORM -----*/
use Nette\Forms\Form;

// contact form settings
$email = "info@your-domain.com";
$subject = "Message from site " . $_SERVER["SERVER_NAME"];

// select box types
$type = array(
	"option 1" => "option one",
	"option 2" => "option two",
	"option 3" => "option three",
	"option 4" => "option four",
	"option 5" => "option five",
);

// build form
$form = new Form();
$form->addText("jmeno", "Your name:", 60, 240)
		->setRequired('Please fill your name');
$form->addText("telefon", "Phone:", 60, 240);
$form->addText("email", "E-mail:", 60, 240)
		->addRule(Form::EMAIL, "E-mail have wrong format.")
		->setRequired('Please fill your e-mail.');
$form->addText("mesto", "Town:", 60, 240);
$form->addSelect("typ", "Type:", $type);
$form->addTextArea("poznamka", "Note:");
$form->addSubmit('submit', 'Send order')->
		setAttribute("class", "btn btn-primary");
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
		header("Location: /formular/?sent=1", TRUE, 303);
		exit;
	}
}

// display template
display_all($request_url[0]);