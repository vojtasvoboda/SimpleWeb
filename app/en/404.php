<?php

header("HTTP/1.0 404 Not Found");

$data['title'] = "Error 404";
$data['nadpis'] = "Error 404";
$smarty->assign('data', $data);

display_all($request_url[0]);
