<?php

header("HTTP/1.0 404 Not Found");

$data['title'] = "Chyba 404";
$data['nadpis'] = "Chyba 404";

// data pro stranku
$smarty->assign('data', $result);

display_all($request_url[0]);
