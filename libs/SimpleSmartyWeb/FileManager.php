<?php

namespace SimpleSmartyWeb;

/**
 * FileManaer class for working with files
 * 
 * @author Vojta Svoboda <www.vojtasvoboda.cz>
 */
class FileManager {

	/**
	 * Vrátí všechny soubory ve složce
	 * @param unknown_type $folder
	 */
	function getFolderFiles($folder, $onlyImages = false) {
		// return empty if is not a dir
		if (!is_dir($folder)) return false;
		// read files
		$files = array();
		$dir = opendir($folder);
		$skip = array(".", "..");
		if ($dir) {
			while ($filename = readdir($dir)) {
				if (!in_array($filename, $skip) AND
						!is_dir($folder . "/" . $filename)) {
					// only images
					if ($onlyImages && $this->isImage($folder . $filename)) {
						$files[] = $filename;
					}
				}
			}
		}
		closedir($dir);
		sort($files);
		return $files;
	}

	/**
	 * Vrati vsechny slozky
	 * @param unknown_type $folder
	 */
	function getFolders($folder) {
		// return empty if is not a dir
		if (!is_dir($folder)) return array();
		// read directories
		$slozky = array();
		$adresar = opendir($folder);
		$skip_soubory = array(".", "..");
		if ($adresar) {
			while ($jmenosouboru = readdir($adresar)) {
				if (is_dir($folder . "/" . $jmenosouboru) AND
						( strlen($jmenosouboru) > 2)) {
					$slozky[] = $jmenosouboru;
				}
			}
		}
		closedir($adresar);
		return $slozky;
	}

	/**
	 * Funkce overi, ze je soubor obrazek
	 */
	public function isImage($image) {
		$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
		$pathinfo = pathinfo($image);
		$ext = $pathinfo['extension'];
		return in_array(strtolower($ext), $allowedExtensions);
	}

	/**
	 * Save content to file
	 * @param Url $path
	 * @param String $content
	 */
	public function saveToFile($path, $content, $mode = "w") {
		// $content = iconv("UTF-8", "Windows-1250//IGNORE", $content);
		$soubor = fopen($path, $mode);
		if ($soubor) {
			fwrite($soubor, $content);
			fclose($soubor);
		} else {
			echo "Nepodařilo se uložit soubor " . $path;
			// log_to_file("File", "saveToFile", "Nepodařilo se uložit soubor " . $path);
			return false;
		}
		return true;
	}

}
