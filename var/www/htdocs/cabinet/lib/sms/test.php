<?php


//define("SMSC_DEBUG", 1);

require_once("smsc_api.php");

define("SMSC_LOGIN", "comp_center");
define("SMSC_PASSWORD", "VbpQ51z8");
define("SMSC_POST", 0);
define("SMSC_HTTPS", 0);
define("SMSC_CHARSET", "utf-8");
define("SMSC_DEBUG", 0);
define("SMTP_FROM", "admin@luga.ru");


//$arr = send_sms_mail("79052880071;79633164363;79046456105;79217460342", "Проверочная СМС", 0);
$arr = send_sms_mail("79219459441", "Проверочная СМС", 0);
print_r($arr);
?>