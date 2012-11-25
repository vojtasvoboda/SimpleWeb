<?php

$data["nazev"] = "Homepage";
$data["title"] = "Homepage";
$data["keywords"] = "Homepage";
$data["description"] = "Homepage";
$smarty->assign('data', $data);

display_all($request_url[0]);
