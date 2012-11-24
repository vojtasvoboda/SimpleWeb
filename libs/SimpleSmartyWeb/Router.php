<?php

namespace SimpleSmartyWeb;

/**
 * Router class for parse URL
 * 
 * @author Vojta Svoboda <www.vojtasvoboda.cz>
 */
class Router {

	/** @var $url */
	private $url = "";

	/** @var array $cfg - global config array */
	private $cfg = null;

	/** @var $request_url - URL as array */
	private $request_url = null;

	/** @var $default_language */
	private $default_language = "";

	/** @var $active_language */
	private $active_language = "";

	/**
	 * Constructor
	 * @param String $url
	 * @param array $cfg - global config array
	 */
    public function __construct($url, $cfg) {
		$this->url = $url;
        $this->cfg = $cfg;
		$this->default_language = isset($cfg["languages_default"]) ? $cfg["languages_default"] : "cz";
		$this->request_url = $this->parseUrl($url);
		$this->active_language = $this->parseActiveLanguage($this->request_url);
    }

	/**
	 * Get URL as array
	 * @param type $url
	 * @return type
	 */
	public function getRequestArray() {
		return $this->request_url;
	}

	/**
	 * Return active language
	 * @return type
	 */
	public function getActiveLanguage() {
		return $this->active_language;
	}

	/**
	 * Get active language
	 * @param type $valid_languages
	 * @return type
	 */
	private function parseActiveLanguage($request_url) {
		// pokud je první parametr mutace, tak jí vrátíme
		if ( !empty($request_url) ) {
			if (array_key_exists($request_url[0], $this->cfg["languages"])) {
				array_shift($this->request_url);
				return $request_url[0];
			}
		}
		// jinak vrátíme defaultní mutaci
		return $this->default_language;
	}

	/**
	 * Get array from URL
	 * @return type
	 */
	private function parseUrl($url) {
		// globally :-(
		$odkaz_rewrite = $GLOBALS["odkaz_rewrite"];
		// rozparsujeme URL
		if (preg_match('~(.*)\.php(.*)~i', $url)) redirect404();
		$vyraz = "~^$odkaz_rewrite(.*)~i";
		// odstranění adresáře localhostu
		if ($odkaz_rewrite AND preg_match($vyraz, $url)) $url = preg_replace($vyraz, '\\1', $url);
		$vyraz = '~(.*)\?(.*)~i';
		// odstranění všech parametrů za ? včetně (Přístupné přes $_GET)
		if (preg_match($vyraz, $url)) $url = preg_replace($vyraz, '\\1', $url);
		$vyraz = '~^/(.*)/$~i';
		// odstranění prvního a posledního lomítka
		$url = preg_replace($vyraz, '\\1', $url);
		return explode("/", $url);
	}
	
}