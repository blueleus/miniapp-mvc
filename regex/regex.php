<?php

//$html = file_get_contents("https://www.nexura.com/");
$html = file_get_contents("nexura.html");

//href=[\"\'][^h]([\?\/]){0,1}[\w\d-]+

preg_match_all("/<a[\n\r\w\d\s\"\'_.=-]+(https?:\/\/[\w\d.\/\?-]+)/", $html, $matches, PREG_PATTERN_ORDER);
print_r($matches[1]);