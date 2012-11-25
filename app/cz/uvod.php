<?php

$data["nazev"] = "Úvodní stránka";
$data["title"] = "Úvodní stránka";
$data["keywords"] = "Úvodní stránka";
$data["description"] = "Úvodní stránka";
$smarty->assign('data', $data);

display_all($request_url[0]);
