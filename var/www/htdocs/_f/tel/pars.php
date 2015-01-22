<?php
$str = "8-961-802_31 22";
$str = "+".preg_replace("/(\W)|([A-Za-z])|(\_)/", "", $str);
$str = preg_replace("/^\+8/", "+7", $str);
$out = array();
preg_match("/(\+7)(\d{3})(\d{7})/", $str, $out);



//$text = 'Мой номер телефона '.$str;

//preg_match('/(?:8|\+7)? ?\(?(\d{3})\)? ?(\d{3})[ -]?(\d{2})[ -]?(\d{2})/', $text, $out);

print_r($out);
?>