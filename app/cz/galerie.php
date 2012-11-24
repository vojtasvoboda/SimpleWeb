<?php

$data["nazev"] = "Galerie";
$data["title"] = "Galerie";
$data["keywords"] = "Galerie";
$data["description"] = "Galerie";
$smarty->assign('data', $data);

// read images
$files = new SimpleSmartyWeb\FileManager();
$folder = "./assets/img/colorbox";
$onlyImages = true;
$images = $files->getFolderFiles($folder, $onlyImages);
$smarty->assign("images", $images);

// display template
display_all($request_url[0]);
