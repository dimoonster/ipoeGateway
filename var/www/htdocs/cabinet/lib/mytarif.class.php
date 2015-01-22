<?php

require_once(dirname(__FILE__)."/pChart/pData.class.php");
require_once(dirname(__FILE__)."/pChart/pDraw.class.php");
require_once(dirname(__FILE__)."/pChart/pImage.class.php");

class MyTarif {
    private $db;
    private $time;
    
    public $errstr;
    
    function __construct($dbh) {
	$this->db = $dbh;
	$this->time = time();
    }
    
    function genSmallImage($name, $data) {
	$DataSet = new pData;
	$DataSet->AddPoints($data, "Serie1");
//	$DataSet->setAxisName(0,"Скорость (Mbit/s)");
//	$DataSet->setAbscissaName("Время суток");

	$myPicture = new pImage(220, 65, $DataSet);
	$myPicture->Antialias = FALSE;
	$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>dirname(__FILE__)."/../images/ttf/tahoma.ttf","FontSize"=>5));
	$myPicture->setGraphArea(15,5,210,50);
	$scaleSettings = array("XMargin"=>1,"YMargin"=>1,"Floating"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>100,"GridG"=>100,"GridB"=>100,"GridAlpha"=>15);
	$myPicture->drawScale($scaleSettings);
	$myPicture->Antialias = TRUE;
	$myPicture->drawBarChart(array("DisplayValues"=>FALSE,"Interleave"=>0,"Gradient"=>TRUE,"DisplayColor"=>DISPLAY_AUTO));
	$myPicture->Antialias = FALSE;
	
	$myPicture->Render(dirname(__FILE__)."/../images/tariffs/".$name.".small.png");
    }

    function genBigImage($name, $data) {
	$DataSet = new pData;
	$DataSet->AddPoints($data, "Serie1");
	$DataSet->setAxisName(0,"Скорость (Mbit/s)");
	$DataSet->setAbscissaName("Время суток");

	$myPicture = new pImage(610, 180, $DataSet);
	$myPicture->Antialias = FALSE;
	$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>dirname(__FILE__)."/../images/ttf/tahoma.ttf","FontSize"=>10));
	$myPicture->setGraphArea(35,7,580,150);
	$scaleSettings = array("XMargin"=>1,"YMargin"=>1,"Floating"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>100,"GridG"=>100,"GridB"=>100,"GridAlpha"=>15);
	$myPicture->drawScale($scaleSettings);
	$myPicture->Antialias = TRUE;
	$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"Interleave"=>0,"Gradient"=>TRUE));
	$myPicture->Antialias = FALSE;
	
	$myPicture->Render(dirname(__FILE__)."/../images/tariffs/".$name.".big.png");
    }
    
    function getTariff($id) {
	$arr = array();
	$id = (int)$id;
	$sql = "select id,trf_name,trf_descr,trf_autor,trf_public, simg, bimg,
		speed0,speed1,speed2,speed3,speed4,speed5,speed6,speed7,speed8,speed9,
		speed10,speed11,speed12,speed13,speed14,speed15,speed16,speed17,speed18,speed19,
		speed20,speed21,speed22,speed23 from ipoe2_mytariff where id=$id";
		
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    $arr["id"] 	= $fa[0];
	    $arr["name"] 	= $fa[1];
	    $arr["descr"]	= $fa[2];
	    $arr["autor"]	= $fa[3];
	    $arr["public"]	= $fa[4];
	    $arr["simg"]	= $fa[5];
	    $arr["bimg"]	= $fa[6];
	    
	    $spd = array();
	    $spd[0] = $fa["speed0"];
	    $spd[1] = $fa["speed1"];
	    $spd[2] = $fa["speed2"];
	    $spd[3] = $fa["speed3"];
	    $spd[4] = $fa["speed4"];
	    $spd[5] = $fa["speed5"];
	    $spd[6] = $fa["speed6"];
	    $spd[7] = $fa["speed7"];
	    $spd[8] = $fa["speed8"];
	    $spd[9] = $fa["speed9"];
	    $spd[10] = $fa["speed10"];
	    $spd[11] = $fa["speed11"];
	    $spd[12] = $fa["speed12"];
	    $spd[13] = $fa["speed13"];
	    $spd[14] = $fa["speed14"];
	    $spd[15] = $fa["speed15"];
	    $spd[16] = $fa["speed16"];
	    $spd[17] = $fa["speed17"];
	    $spd[18] = $fa["speed18"];
	    $spd[19] = $fa["speed19"];
	    $spd[20] = $fa["speed20"];
	    $spd[21] = $fa["speed21"];
	    $spd[22] = $fa["speed22"];
	    $spd[23] = $fa["speed23"];
	    
	    $arr["speed"] = $spd;

	    $price = $this->getCostPerHour();
	    $minprice = $this->getMinimalCost();
	    $arr["cost"] = $this->calcPrice($spd, $price, $minprice);
	    $arr["mspeed"] = $this->calcMSpeed($spd);
	    
	    return $arr;
	}
	
	return 0;
    }
    
    function listTariffs($autor, $userid) {
	$where = "";
	$arr = array();
	if($autor==$userid) $where=" where trf_autor=$userid";
	if($autor!=$userid) $where=" where trf_autor<>$userid and trf_public=1";

	$price = $this->getCostPerHour();
	$minprice = $this->getMinimalCost();

	$sql = "select id,trf_name,trf_descr,trf_autor,trf_public, simg, bimg,
		speed0,speed1,speed2,speed3,speed4,speed5,speed6,speed7,speed8,speed9,
		speed10,speed11,speed12,speed13,speed14,speed15,speed16,speed17,speed18,speed19,
		speed20,speed21,speed22,speed23 from ipoe2_mytariff ".$where." order by rating desc;";
		
//	echo $sql;
		
	$sth = $this->db->query($sql);
	for($i=0;$fa=$this->db->fetch_array($sth);$i++) {
	    $arr[$i]["id"] 	= $fa[0];
	    $arr[$i]["name"] 	= $fa[1];
	    $arr[$i]["descr"]	= $fa[2];
	    $arr[$i]["autor"]	= $fa[3];
	    $arr[$i]["public"]	= $fa[4];
	    $arr[$i]["simg"]	= $fa[5];
	    $arr[$i]["bimg"]	= $fa[6];
	    
	    $spd = array();
	    $spd[0] = $fa["speed0"];
	    $spd[1] = $fa["speed1"];
	    $spd[2] = $fa["speed2"];
	    $spd[3] = $fa["speed3"];
	    $spd[4] = $fa["speed4"];
	    $spd[5] = $fa["speed5"];
	    $spd[6] = $fa["speed6"];
	    $spd[7] = $fa["speed7"];
	    $spd[8] = $fa["speed8"];
	    $spd[9] = $fa["speed9"];
	    $spd[10] = $fa["speed10"];
	    $spd[11] = $fa["speed11"];
	    $spd[12] = $fa["speed12"];
	    $spd[13] = $fa["speed13"];
	    $spd[14] = $fa["speed14"];
	    $spd[15] = $fa["speed15"];
	    $spd[16] = $fa["speed16"];
	    $spd[17] = $fa["speed17"];
	    $spd[18] = $fa["speed18"];
	    $spd[19] = $fa["speed19"];
	    $spd[20] = $fa["speed20"];
	    $spd[21] = $fa["speed21"];
	    $spd[22] = $fa["speed22"];
	    $spd[23] = $fa["speed23"];
	    
	    $arr[$i]["speed"] = $spd;
	    
	    $arr[$i]["cost"] = $this->calcPrice($spd, $price, $minprice);
	    $arr[$i]["mspeed"] = $this->calcMSpeed($spd);
	}
	
	return $arr;
    }
    
    function calcPrice($speed, $prices, $minprice) {
	$tprice = $minprice;
	for($i=0;$i<24;$i++) {
	    $tprice += round(($speed[$i]*$prices[$i])*100)/100;
	}
	
	return $tprice;
    }
    
    function calcMSpeed($speed) {
	$mspeed = 0;
	for($i=0;$i<24;$i++) {
	    $mspeed += $speed[$i];
	}
	return round(($mspeed/24)*100)/100;
    }
    
    function createTarif($speeds, $tname, $tdescr, $tshare, $ses) {
	if($tshare=="") $tshare=0;
	
	$tname = trim($tname);

	if($this->findTarif($tname, $ses->getUserId())) {
	    $this->errstr = "Тариф с таким именем уже существует.";
	    return 1;
	}
	
	$tname = addslashes($tname);
	$tdescr = addslashes($tdescr);
	
	$imgname = md5($tname);
	
	$sql = "insert into ipoe2_mytariff(trf_name, trf_descr, trf_autor, simg, bimg, trf_public, 
	speed0,speed1,speed2,speed3,speed4,speed5,speed6,speed7,speed8,speed9,speed10,
	speed11,speed12,speed13,speed14,speed15,speed16,speed17,speed18,speed19,speed20,
	speed21,speed22,speed23) values('$tname', '$tdescr', ".$ses->getUserId().", '$imgname.small.png', '$imgname.big.png', $tshare, ";
	
	for($i=0;$i<23;$i++) {
	    $sql .= $speeds[$i].", ";
	}
	
	$sql .= $speeds[23].");";
	
//	echo $sql;
	$this->db->query($sql);
	
	$this->genSmallImage($imgname, $speeds);
	$this->genBigImage($imgname, $speeds);
	
	return 0;
    }
    
    function findTarif($tname, $userid) {
	$tname = addslashes($tname);
	$sql = "select id from ipoe2_mytariff where trf_name='$tname' and trf_autor=$userid;";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return $fa[0];
	}
	
	return 0;
    }
    
    function getNameNext($accid) {
	$sql = "SELECT ipoe2_mytariff_users.trf_template, ipoe2_mytariff.trf_name
		FROM ipoe2_mytariff_users INNER JOIN
		    ipoe2_mytariff ON ipoe2_mytariff_users.trf_template = ipoe2_mytariff.id
                WHERE     (ipoe2_mytariff_users.accid = $accid) order by ipoe2_mytariff_users.startdate desc;";
        $sth = $this->db->query($sql);
        if($fa=$this->db->fetch_array($sth)) {
    	    return $fa[1];
        }
        
        return "n/a";
    }
    
    function getNameCurrent($accid) {
	$sql = "SELECT ipoe2_mytariff_users.trf_template, ipoe2_mytariff.trf_name
		FROM ipoe2_mytariff_users INNER JOIN
		    ipoe2_mytariff ON ipoe2_mytariff_users.trf_template = ipoe2_mytariff.id
                WHERE     (ipoe2_mytariff_users.startdate <= ".time().") and (ipoe2_mytariff_users.accid = $accid) order by ipoe2_mytariff_users.startdate desc;";

        $sth = $this->db->query($sql);
        if($fa=$this->db->fetch_array($sth)) {
    	    return $fa[1];
        }
        
        return "n/a";
    }
    
    function getRateNext($accid) {
	$sql = "SELECT ipoe2_mytariff_users.trf_template, ipoe2_mytariff.trf_name,
		ipoe2_mytariff.speed0, ipoe2_mytariff.speed1, ipoe2_mytariff.speed2, ipoe2_mytariff.speed3, ipoe2_mytariff.speed4, ipoe2_mytariff.speed5, ipoe2_mytariff.speed6, ipoe2_mytariff.speed7, ipoe2_mytariff.speed8, ipoe2_mytariff.speed9,
		ipoe2_mytariff.speed10, ipoe2_mytariff.speed11, ipoe2_mytariff.speed12, ipoe2_mytariff.speed13, ipoe2_mytariff.speed14, ipoe2_mytariff.speed15, ipoe2_mytariff.speed16, ipoe2_mytariff.speed17, ipoe2_mytariff.speed18, ipoe2_mytariff.speed19, 
		ipoe2_mytariff.speed20, ipoe2_mytariff.speed21, ipoe2_mytariff.speed22, ipoe2_mytariff.speed23
		FROM ipoe2_mytariff_users INNER JOIN
		    ipoe2_mytariff ON ipoe2_mytariff_users.trf_template = ipoe2_mytariff.id
                WHERE (ipoe2_mytariff_users.accid = $accid) order by ipoe2_mytariff_users.startdate desc;";

        $sth = $this->db->query($sql);
        
        $carr = $this->getCostPerHour();
        $cost = 0;
        
        if($fa=$this->db->fetch_array($sth)) {
    	    for($i=0;$i<24;$i++) {
    		$speed = $fa["speed".$i];
    		$cost += round(($carr[$i]*$speed)*100)/100;
    	    };
    	    
    	    $cost += $this->getMinimalCost();
    	    
    	    return $cost;
        }
        
        return "n/a";
    }

    function getRateCurrent($accid) {
	$sql = "SELECT ipoe2_mytariff_users.trf_template, ipoe2_mytariff.trf_name,
		ipoe2_mytariff.speed0, ipoe2_mytariff.speed1, ipoe2_mytariff.speed2, ipoe2_mytariff.speed3, ipoe2_mytariff.speed4, ipoe2_mytariff.speed5, ipoe2_mytariff.speed6, ipoe2_mytariff.speed7, ipoe2_mytariff.speed8, ipoe2_mytariff.speed9,
		ipoe2_mytariff.speed10, ipoe2_mytariff.speed11, ipoe2_mytariff.speed12, ipoe2_mytariff.speed13, ipoe2_mytariff.speed14, ipoe2_mytariff.speed15, ipoe2_mytariff.speed16, ipoe2_mytariff.speed17, ipoe2_mytariff.speed18, ipoe2_mytariff.speed19, 
		ipoe2_mytariff.speed20, ipoe2_mytariff.speed21, ipoe2_mytariff.speed22, ipoe2_mytariff.speed23
		FROM ipoe2_mytariff_users INNER JOIN
		    ipoe2_mytariff ON ipoe2_mytariff_users.trf_template = ipoe2_mytariff.id
                WHERE (ipoe2_mytariff_users.startdate <= ".time().") and  (ipoe2_mytariff_users.accid = $accid) order by ipoe2_mytariff_users.startdate desc;";

        $sth = $this->db->query($sql);
        
        $carr = $this->getCostPerHour();
        $cost = 0;
        
        if($fa=$this->db->fetch_array($sth)) {
    	    for($i=0;$i<24;$i++) {
    		$speed = $fa["speed".$i];
    		$cost += round(($carr[$i]*$speed)*100)/100;
    	    };
    	    
    	    $cost += $this->getMinimalCost();
    	    
    	    return $cost;
        }
        
        return "n/a";
    }
    
    function getMinimalCost() {
	$sql = "select top 1 AbonentRate from Tariffs where GroupID=".MY_TARIFF." order by TariffID desc;";
	
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return $fa[0];
	}
	
	echo "FATAL ERROR: myTariff::getMinimalCost()";
	
	exit();
    }
    
    function getMinSpeed() {
	return MYTRF_MINSPEED;
    }
    
    function getMaxSpeed() {
	return MYTRF_MAXSPEED;
    }
    
    function getCostPerHour() {
	$arr[0] = 2.73;
	$arr[1] = 0.66;
	$arr[2] = 0.66;
	$arr[3] = 0.66;
	$arr[4] = 0.66;
	$arr[5] = 0.66;
	$arr[6] = 0.66;
	$arr[7] = 0.66;
	$arr[8] = 0.96;
	$arr[9] = 0.96;
	$arr[10] = 0.96;
	$arr[11] = 0.96;
	$arr[12] = 0.96;
	$arr[13] = 0.96;
	$arr[14] = 0.96;
	$arr[15] = 0.96;
	$arr[16] = 0.96;
	$arr[17] = 0.96;
	$arr[18] = 2.73;
	$arr[19] = 2.73;
	$arr[20] = 2.73;
	$arr[21] = 2.73;
	$arr[22] = 2.73;
	$arr[23] = 2.73;
	
	return $arr;
    }
    
    function getStrCostPerHour() {
	$p = $this->getCostPerHour();
	$arr[0] = number_format($p[0], 2, '.', '');
	$arr[1] = number_format($p[1], 2, '.', '');
	$arr[2] = number_format($p[2], 2, '.', '');
	$arr[3] = number_format($p[3], 2, '.', '');
	$arr[4] = number_format($p[4], 2, '.', '');
	$arr[5] = number_format($p[5], 2, '.', '');
	$arr[6] = number_format($p[6], 2, '.', '');
	$arr[7] = number_format($p[7], 2, '.', '');
	$arr[8] = number_format($p[8], 2, '.', '');
	$arr[9] = number_format($p[9], 2, '.', '');
	$arr[10] = number_format($p[10], 2, '.', '');
	$arr[11] = number_format($p[11], 2, '.', '');
	$arr[12] = number_format($p[12], 2, '.', '');
	$arr[13] = number_format($p[13], 2, '.', '');
	$arr[14] = number_format($p[14], 2, '.', '');
	$arr[15] = number_format($p[15], 2, '.', '');
	$arr[16] = number_format($p[16], 2, '.', '');
	$arr[17] = number_format($p[17], 2, '.', '');
	$arr[18] = number_format($p[18], 2, '.', '');
	$arr[19] = number_format($p[19], 2, '.', '');
	$arr[20] = number_format($p[20], 2, '.', '');
	$arr[21] = number_format($p[21], 2, '.', '');
	$arr[22] = number_format($p[22], 2, '.', '');
	$arr[23] = number_format($p[23], 2, '.', '');
	
	return $arr;
    }
    
    function getDefaultSpeed() {
	$defSpeed = 6;
    
	$arr[0] = $defSpeed;
	$arr[1] = $defSpeed;
	$arr[2] = $defSpeed;
	$arr[3] = $defSpeed;
	$arr[4] = $defSpeed;
	$arr[5] = $defSpeed;
	$arr[6] = $defSpeed;
	$arr[7] = $defSpeed;
	$arr[8] = $defSpeed;
	$arr[9] = $defSpeed;
	$arr[10] = $defSpeed;
	$arr[11] = $defSpeed;
	$arr[12] = $defSpeed;
	$arr[13] = $defSpeed;
	$arr[14] = $defSpeed;
	$arr[15] = $defSpeed;
	$arr[16] = $defSpeed;
	$arr[17] = $defSpeed;
	$arr[18] = $defSpeed;
	$arr[19] = $defSpeed;
	$arr[20] = $defSpeed;
	$arr[21] = $defSpeed;
	$arr[22] = $defSpeed;
	$arr[23] = $defSpeed;
	
	return $arr;
    }
    
    function checkAccount($acc, $tgroups) {
	$sql = "select TechGroupID from Accounts where Number=$acc";
	$sth=$this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    $tgrp = $fa[0];
	    
	    foreach($tgroups as $grp) {
		if($tgrp == $grp) return true;
	    }
	}
	
	return false;
    }
    
    function setUserOperatorTariff($tariff, $app) {
	$userid = $app->session->getUserId();
	$accid = $app->session->getAccId();
	
	if(!$this->checkAccount($accid, unserialize(TGROUPS))) {
	    $this->errstr = "К выбранной учётной записи нельзя применить этот тариф.";
	    return 0;
	};

	// Проверим, не выставлени ли у абонента уже смена тарифа
	$sql = "select top 1 AccountAdmID,AdmGroupID,AbonentDate,AccountedDate from AccountsAdm 
		WHERE (UserID = $userid) AND (AccountID = $accid) AND (AbonentDate >= ".str_replace(',', '.', $app->timeToBilTime(strtotime(strftime("%D 01:00:00", time())))).")
		ORDER BY AccountedDate";
	$sth = $this->db->query($sql);
	
	$date = 0;
	$ctrf = 0;
	$admId = 0;
	$accDate = 0;
	
	if($fa=$this->db->fetch_array($sth)) {
	    // Есть тариф с установленной абоненткой в будущем
	    $date = $app->bilTimeToTime($fa["AbonentDate"]-1);
	    $ctrf = $fa["AdmGroupID"];
	    $admId = $fa["AccountAdmID"];
	    $accDate = $fa["AccountedDate"];
	};
	
	if($ctrf!=$tariff["id"]) {
	    if($accDate=="") {
		// установленный тариф в будущем еще ни разу не списывался, удалим его из базы
		$sql = "delete from AccountsAdm where AccountAdmID=".$admId;
		$this->db->query($sql);
	    }

	    if($date < time()) {
		// если дата абонентки в прошлом, то она будет с сегодняшнего дня
		$date = strtotime(strftime("%D 01:00:00", time()));
	    };
            $day = strftime("%e", $date+60*60*24);
            $date = str_replace(',', '.', $app->timeToBilTime($date));

	    $sql = "insert into AccountsAdm(UserID, AccountID, AdmGroupID, DateOn, AbonentType, 
		    AbonentSkipFirst, AbonentDate, AbonentDay, Operator) values(
		    $userid, $accid, ".$tariff["id"].", $date, 0, 0, $date, $day, '".BIL_OPERATOR."'
		    )";
	    $this->db->query($sql);
	}

	$this->errstr = "Тариф успешно установлен";
    }
    
    function setUserTariff($tariff, $app) {
	$userid = $app->session->getUserId();
	$accid = $app->session->getAccId();
	
	if(!$this->checkAccount($accid, unserialize(TGROUPS))) {
	    $this->errstr = "К выбранной учётной записи нельзя применить этот тариф.";
	    return 0;
	};
	
	// Проверим, не выставлени ли у абонента уже Мой.Тариф в базе биллинга
	$sql = "select top 1 AdmGroupID,AbonentDate,DateOn,AccountAdmID from AccountsAdm
		WHERE (UserID = $userid) AND (AccountID = $accid) AND (AbonentDate >= ".str_replace(',', '.', $app->timeToBilTime(strtotime(strftime("%D 01:00:00", time())))).")
		ORDER BY AccountedDate";
		
	$sth = $this->db->query($sql);
//	echo $sql;
	
	$date = 0;
	$ctrf = 0;
	$dateon = 0;
	$aaid = 0;
	$date1 = 0;
	
	if($fa=$this->db->fetch_array($sth)) {
	    $date = $app->bilTimeToTime($fa[1]-1);
	    $date1 = $fa[1];
	    $ctrf = $fa[0];
	    $dateon = $fa["DateOn"];
	    $aaid = $fa["AccountAdmID"];
	};
	
        if($ctrf!=MY_TARIFF) {
            // Текущий тариф не Мой.Тариф
	    if($date < time()) {
		$date = strtotime(strftime("%D 01:00:00", time()));
	    };
	    $day = strftime("%e", $date+60*60*24);
	    $date = str_replace(',', '.', $app->timeToBilTime($date));
	    
//	    echo "$date1 = $dateon"; exit();
	    
	    if($date1==$dateon) {
		$sql = "delete from AccountsAdm where AccountAdmID=$aaid";
//		echo $sql;
		$this->db->query($sql);
	    }
	    
	    $sql = "insert into AccountsAdm(UserID, AccountID, AdmGroupID, DateOn, AbonentType, 
		    AbonentSkipFirst, AbonentDate, AbonentDay, Operator) values(
		    $userid, $accid, ".MY_TARIFF.", $date, 0, 0, $date, $day, '".BIL_OPERATOR."'
		    )";
	    $this->db->query($sql);
	    $date = $app->bilTimeToTime($date-1);
	}

	$date += 60*60*24;

	// Теперь пропишем в нашу базу, как из Моих.Тарифов будет действовать
	$sql = "delete from ipoe2_mytariff_users where accid=$accid and startdate >= $date";
	$this->db->query($sql);
	    
	$sql = "insert into ipoe2_mytariff_users(accid, trf_template, startdate) values($accid, ".$tariff["id"].", $date)";
	$this->db->query($sql);
	
	$this->errstr = "Тариф успешно установлен";
	
	return 1;
    }
}
?>