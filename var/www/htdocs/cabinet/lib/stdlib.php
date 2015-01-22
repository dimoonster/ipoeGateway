<?php

function topMenuArray($title, $link, $active) {
    $arr["title"] = $title;
    $arr["link"] = $link;
    $arr["active"] = $active;
    
    return $arr;
}

function strToHex($string) {
    $hex='';
    for ($i=0; $i < strlen($string); $i++) {
	$hex .= dechex(ord($string[$i])). " ";
    }
    return $hex;
};

function check_auth($smarty, $db) {
    require(dirname(__FILE__)."/../config.php");

    $check_access = 0;

    // Проверим по ИП адресу (вдруг клиент пришёл по ipoe с активной сессией)
    $ip = $_SERVER["REMOTE_ADDR"];
//    $ip = "10.3.34.18";
    $sql = "SELECT     id, ipv4, ipv6, vlan, mac, speed, UserID, startdate, brasid, syscmd, tarifid, AccountName
	FROM         ipoe_current_sessions
	WHERE     (ipv4 LIKE '".$ip.chr(10)."')";
	
#    echo $sql;

    $sth = $db->query($sql);

    if($db->num_rows($sth) > 0) {
#	echo "!~!!!!!!!!!!!!!@@@@@@@@@2";
	$fa = $db->fetch_array($sth);
	$check_access = 1;
	$_SESSION["userid"] = $fa[6];
	$_SESSION["auth"] = 1;
	$_SESSION["ipoe"] = 1;
    };

    if(@$_POST["login"]&&@$_POST["password"]) {
	// По пост-запросу пришли логин и пароль
	
	// Проверим по кэш-базе
	$sql = "select UserID from ipoe_users_cache where AccountName like '".addslashes($_POST["login"])."' and Password like '".addslashes($_POST['password'])."' order by id desc;";
//	echo $sql;
	$sth = $db->query($sql);
	
	if($db->num_rows($sth)>0) {
	    $fa = $db->fetch_array($sth);
	    $check_access = 1;
	    $_SESSION["userid"] = $fa[0];
	    $_SESSION["auth"] = 1;
	    $_SESSION["ipoe"] = 0;
//	    echo "auth by cache";
	};
	
	
	// В самом конце проверим по радиусу
	if(!$check_access) {
	    $radh = radius_auth_open();
	    radius_add_server($radh, $radius_host, $radius_port, $radius_key, 1, 5);
	    radius_create_request($radh, RADIUS_ACCESS_REQUEST);
	
	    radius_put_attr($radh, 1, $_POST["login"]);
	    radius_put_attr($radh, 2, $_POST["password"]);
	
	    $radresult = radius_send_request($radh);
	    
###	    echo "wwerwerwer".$radresult;
	
	    if($radresult == 2) {
		$check_access = 1;
		$sql = "select UserID from Accounts where AccountName like '".addslashes($_POST["login"])."';";
//	echo $sql;
		$sth = $db->query($sql);
		
		if($db->num_rows($sth)>0) {
		    $fa = $db->fetch_array($sth);
		    $_SESSION["userid"] = $fa[0];
		    $_SESSION["auth"] = 1;
		    $_SESSION["ipoe"] = 0;
		    // Логин с паролем положим в кэш
		    $sql = "insert into ipoe_users_cache(UserID, AccountName, Password) values(".$fa[0].", '".addslashes($_POST['login'])."', '".$_POST['password']."')";
//	echo $sql;
		    $db->query($sql);
		    
//		    echo "auth by radius";
		} else {
		    // Произошла какя-то хня. Радиус ответил утвердительно, однако UserID получить из базы не удалось
		    $check_access = 0;
		}
	    };
	};
	
	$smarty->assign('login_incorrect', 1);
    };

    // Проверка прошла успешно
    if($check_access==1) return;
    
    $smarty->assign('login_login', @$_POST["login"]);
    $smarty->assign('loggedin', 0);
    $smarty->assign('content', '');
    
    $smarty->display('index.html');
    exit();
};

?>