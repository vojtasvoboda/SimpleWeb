<?php

namespace SimpleWeb;

/**
 * Class for working with Forms
 *
 * @author Vojta Svoboda <www.vojtasvoboda.cz>
 */
class Form {

	private $error = false;

	private $errors = array();

	/**
	 * Zpracujeme formular. Vystupem je asociativni pole
	 * @param unknown_type $form
	 * @param unknown_type $post
	 */
	public function getItems($form, $post) {
		// polozky a hodnoty pro DB dotaz
		$values = array();
		// projdeme vsechny polozky formulare
		foreach ($form AS $pole => &$prvek) {
	      if (!empty($post[$pole])) $post[$pole] = stripslashes($post[$pole]);
	      if (!empty($post[$pole])) $post[$pole] = htmlspecialchars($post[$pole]);
	      if ( isset($prvek['required']) AND ($prvek['required'] == true) ) {
	        if ( empty($post[$pole]) ) {
	          $this->error = true;
	          $this->errors[] = $prvek["jmeno"];
	        } else {
	          $values[$pole] = $post[$pole];
	        }
	      } else {
	        if ( !empty($post[$pole]) ) {
	          if ($prvek['type'] == "text") {
	            $values[$pole] = $post[$pole];
	          } elseif ($prvek['type'] == "checkbox") {
	            $values[$pole] = "1";
	          }
	        } else {
	          if ($prvek['type'] == "checkbox") {
	            $values[$pole] = "0";
	    	  }
	        }
	      }
		}
		return $values;
	}
	
	/**
	 * Zpracujeme kontaktni formular. Vystupem je pole hodnot, polozek a chyb
	 * @param unknown_type $form
	 * @param unknown_type $post
	 */
	public function getTextItems($form, $post) {

		// text pro email, polozky a hodnoty pro DB dotaz
		$text = ""; $polozky = ""; $hodnoty = "";

		// projdeme vsechny polozky formulare
		foreach ($form AS $pole => &$prvek) {

	      if (!empty($post[$pole])) $post[$pole] = stripslashes($post[$pole]);
	      if (!empty($post[$pole])) $post[$pole] = htmlspecialchars($post[$pole]);

	      if ( $prvek['required'] == true ) {
	        if (empty($post[$pole])) {
	          $this->error = true;
	          $this->errors[] = $prvek["jmeno"];
	        } else {
	          $prvek['hodnota'] = $post[$pole];
	          @$text .= "$prvek[nazev]: " . $prvek[hodnota] . "\n";
	        }

	      } else {
	        if (!empty($post[$pole])) {
	          if ($prvek['type'] == "text") {
	            $prvek['hodnota'] = $post[$pole];
	            @$text .= "$prvek[nazev]: " . $prvek[hodnota] . "\n";

	          } elseif ($prvek['type'] == "checkbox") {
	            $prvek['check'] = true;
	            $prvek['hodnota'] = "ano";
	            @$text .= "$prvek[nazev]: " . $prvek[hodnota] . "\n";
	          }

	        } else {
	          if ($prvek['type'] == "checkbox") {
	            $prvek['check'] = false;
	            $prvek['hodnota'] = "ne";
	            @$text .= "$prvek[nazev]: " . $prvek[hodnota] . "\n";
	    }}}
	    	$polozky .= $pole . ",";
			$hodnoty .= "'" . $post[$pole] . "',";
		}

		$polozky = rtrim($polozky, ",");
	  	$hodnoty = rtrim($hodnoty, ",");
	  	$return = array(
	  		"polozky" => $polozky,
	  		"hodnoty" => $hodnoty,
	  		"text" => $text
	  	);
		return $return;
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getErrors() {
		return $this->errors;
	}

}