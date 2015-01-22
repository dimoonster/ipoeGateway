<?php
date_default_timezone_set('Europe/Moscow');

setlocale(LC_ALL, "ru_RU.UTF-8");

$mobile_codes = array(901, 903, 905, 906, 909, 911, 921, 931, 952, 960, 961, 963);

$operator_trfs = array (
    134=> array("name"=>"Безлимитный 200", "mspeed"=>2,   "cost"=>200,  "descr"=>"", "id"=>134, "simg"=>"/operator/_oper200.small.png", "bimg"=>"/operator/_oper200.big.png"),
    115=> array("name"=>"Безлимитный 400", "mspeed"=>6,   "cost"=>400,  "descr"=>"", "id"=>115, "simg"=>"/operator/_oper400.small.png", "bimg"=>"/operator/_oper400.big.png"),
    116=> array("name"=>"Безлимитный 600", "mspeed"=>12,  "cost"=>600,  "descr"=>"", "id"=>116, "simg"=>"/operator/_oper600.small.png", "bimg"=>"/operator/_oper600.big.png"),
    117=> array("name"=>"Безлимитный 800", "mspeed"=>18,  "cost"=>800,  "descr"=>"", "id"=>117, "simg"=>"/operator/_oper800.small.png", "bimg"=>"/operator/_oper800.big.png"),
    118=> array("name"=>"Безлимитный 1000", "mspeed"=>24, "cost"=>1000, "descr"=>"", "id"=>118, "simg"=>"/operator/_oper1000.small.png", "bimg"=>"/operator/_oper1000.big.png"),
);

define("TGROUPS", serialize(array(19)));

define("BASE_URL", "/cabinet/");
define("SMARTY_DIR", dirname(__FILE__)."/lib/smarty/");

define("MY_TARIFF", 138);
define("BIL_OPERATOR", "SA_PE");

define("MYTRF_MINSPEED", 2);
define("MYTRF_MAXSPEED", 30);

$main_menu["info"]	= "Личные данные";
$main_menu["pay"]	= "Платежи";
$main_menu["services"]	= "Услуги и тарифы";
$main_menu["quit"]	= "Выход";

$radius["host"] = "aaa.bbb.ccc.ddd";
$radius["key"] = "testing";
$radius["port"] = 1645;

$db["host"] = "1.1.1.1";
$db["user"] = "sa";
$db["pass"] = "sa";
$db["name"] = "BILLING-DB";

// SMSC Config
define("SMSC_LOGIN", "comp_center");
define("SMSC_PASSWORD", "VbpQ51z8");
define("SMSC_POST", 0);
define("SMSC_HTTPS", 0);
define("SMSC_CHARSET", "utf-8");
define("SMSC_DEBUG", 0);
define("SMTP_FROM", "admin@luga.ru");

// ----------------------------------------------------------------------------------
define("MAIN_MENU", serialize($main_menu));
define("RADIUS", serialize($radius));
define("OPERATOR_TARIFFS", serialize($operator_trfs));
define("MOBILE_CODES", serialize($mobile_codes));

?>
