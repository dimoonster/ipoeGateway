<?php
require_once(dirname(__FILE__)."/application.class.php");
require_once(dirname(__FILE__)."/mytarif.class.php");
require_once(dirname(__FILE__)."/sms/smsc_api.php");

class DataApplication extends Application {
    private $page;
    private $mytarif;

    function __construct() {
	parent::__construct();
	
	$this->mytarif = new MyTarif($this->db);
	
	$this->page = "services_index.html";
	$this->assign('CURRENT_MAIN_MENU_POSITION', "services");
    }

//------------------------------ MY TARIFF SECTION START -----------------------------------
    function createTarif_processPost() {
	$arr[0]		= $_POST["samount0"];
	$arr[1]		= $_POST["samount1"];
	$arr[2]		= $_POST["samount2"];
	$arr[3]		= $_POST["samount3"];
	$arr[4]		= $_POST["samount4"];
	$arr[5]		= $_POST["samount5"];
	$arr[6]		= $_POST["samount6"];
	$arr[7]		= $_POST["samount7"];
	$arr[8]		= $_POST["samount8"];
	$arr[9]		= $_POST["samount9"];
	$arr[10]	= $_POST["samount10"];
	$arr[11]	= $_POST["samount11"];
	$arr[12]	= $_POST["samount12"];
	$arr[13]	= $_POST["samount13"];
	$arr[14]	= $_POST["samount14"];
	$arr[15]	= $_POST["samount15"];
	$arr[16]	= $_POST["samount16"];
	$arr[17]	= $_POST["samount17"];
	$arr[18]	= $_POST["samount18"];
	$arr[19]	= $_POST["samount19"];
	$arr[20]	= $_POST["samount20"];
	$arr[21]	= $_POST["samount21"];
	$arr[22]	= $_POST["samount22"];
	$arr[23]	= $_POST["samount23"];
	
	return $arr;
    }
    
    function createTarif_p1arr($speeds, $costarr) {
	$p1arr=array();
	$m_speed = 0;
	$m_cost = $this->mytarif->getMinimalCost();
	for($i=0;$i<24;$i++) {
	    $p1arr[$i]["time"] = sprintf("%02d", $i)."-".sprintf("%02d", $i+1);
	    $p1arr[$i]["speed"] = $speeds[$i];
	    $p1arr[$i]["cost"] = round($costarr[$i]*$speeds[$i]*100)/100;
	    
	    $m_speed += $speeds[$i];
	    $m_cost += $p1arr[$i]["cost"];
	}
	
	
	$this->assign("TOTAL_SPEED", round(($m_speed/24)*100)/100);
	$this->assign("TOTAL_COST", $m_cost);
	
	$this->assign("P1ARR", $p1arr);
    }
    
    function my_tariff() {
	$this->assign('SERVICE_URL', "?services&my.tariff");
	$this->page = "services/my.tariff/index.html";
	
	$costarr = $this->mytarif->getStrCostPerHour();
	$this->assign('COST_PER_HOUR', $costarr);
	$this->assign('SPEED_PER_HOUR', $this->mytarif->getDefaultSpeed());
	$this->assign('MINIMAL_COST', $this->mytarif->getMinimalCost());
	
	$this->assign('MIN_SPEED', $this->mytarif->getMinSpeed());
	$this->assign('MAX_SPEED', $this->mytarif->getMaxSpeed());
	
	$this->assign('TRF_NAME', "");
	$this->assign('TRF_DESCR', "");
	$this->assign('TRF_SHARED', 0);
	$this->assign('TRF_DATA', serialize($this->mytarif->getDefaultSpeed()));
	
	$this->assign('ERR_STR', "");

	$this->assign('AJAX', '&ajax');
//	$this->assign('AJAX', '');
	
	if(isset($_GET['createForm'])) {
	    if(isset($_GET['base'])) {
		$trf = $this->mytarif->getTariff($_GET['base']);
		if($trf != 0) {
		    $this->assign('SPEED_PER_HOUR', $trf["speed"]);
		}
		
	    }
	
	    if(isset($_GET['page1'])) {
		$this->page = "services/my.tariff/createForm_page1.html";
		
		$speeds = $this->createTarif_processPost();
		$this->assign('SPEED_PER_HOUR', $speeds);
		$this->assign('TRF_DATA', serialize($speeds));
		$this->createTarif_p1arr($speeds, $costarr);
		
		$this->session->saveVar("createForm_speeds", $speeds);
		
//		print_r($speeds);
//		print_r($_POST); exit();
		return;
	    }
	    if(isset($_GET['page2'])) {
		$this->page = "services/my.tariff/createForm_page1.html";
		
		$speeds = $this->session->getVar("createForm_speeds");
		$this->assign('SPEED_PER_HOUR', $speeds);

		$this->createTarif_p1arr($speeds, $costarr);
		
		if($_POST['tname']=="") $_POST['tname']="тариф.".$this->session->getUserId()." (".date("d-M-Y H:i:s").")";
		if($_POST['tdescr']=="") $_POST['tdescr']=$_POST['tname'];
		if(!isset($_POST['tshare'])) $_POST['tshare'] = 0;
		
		$this->assign("TRF_DATA", serialize($speeds));
		$this->assign("TRF_NAME", $_POST['tname']);
		$this->assign("TRF_DESCR", $_POST['tdescr']);
		$this->assign("TRF_SHARED", $_POST['tshare']);
		
		$err = $this->mytarif->createTarif($speeds, $_POST['tname'], $_POST['tdescr'], @$_POST['tshare'], $this->session);
		if($err) {
		    $this->assign('ERR_STR', $this->mytarif->errstr);
		    return;
		}

		$this->page = "services/my.tariff/createForm_page2.html";
		
		return;
	    }
	    $this->page = "services/my.tariff/createForm.html";
	    return;
	}
	
	if(isset($_GET['getlist'])) {
	    $this->page = "services/my.tariff/listTariffs.html";
	    
	    $trflist = array();
	    
	    switch(strtolower($_GET['getlist'])) {
		case 'my': { $trflist = $this->mytarif->listTariffs($this->session->getUserId(), $this->session->getUserId()); }; break;
		case 'shared': $trflist = $this->mytarif->listTariffs(0, $this->session->getUserId()); break;
		case 'operator': { $trflist = unserialize(OPERATOR_TARIFFS); $this->page = "services/my.tariff/listTariffs_operator.html"; }; break;
	    }
	    
	    $this->assign("TRF_LIST", $trflist);
//	    print_r($trflist);
	    return;
	}
	
	$tariffs = $this->getAccountTarifs($this->session->getUserId(), $this->session->getAccId());
	
	$next_tariff_change = 0;

	// Текущий тариф
	foreach($tariffs as $tarif) {
	    if($tarif["DateOn"] < time()) {
		if($tarif["TarifID"] == MY_TARIFF) {
		    $tarif["TarifDescr"] .= ": ".$this->mytarif->getNameCurrent($this->session->getAccId());
		    $tarif["TarifRate"] = $this->mytarif->getRateCurrent($this->session->getAccId());
		}
	    
		$this->assign('CURRENT_TARIFF_TITLE', $tarif["TarifDescr"]);
		$this->assign('CURRENT_TARIFF_COST', $tarif["TarifRate"]);
		$this->assign('CURRENT_TARIFF_DATE', $tarif["AbonentDate"]);

		$next_tariff_change = $tarif["AbonentDate"];

		$this->assign('NEXT_TARIFF_TITLE', $tarif["TarifDescr"]);
		$this->assign('NEXT_TARIFF_COST', $tarif["TarifRate"]);

		break;
	    }
	}
	
	// next tariff
	foreach($tariffs as $tarif) {
	    if($tarif["AbonentDate"] >= $next_tariff_change) {
		if($tarif["TarifID"] == MY_TARIFF) {
		    $tarif["TarifDescr"] .= ": ".$this->mytarif->getNameNext($this->session->getAccId());
		    $tarif["TarifRate"] = $this->mytarif->getRateNext($this->session->getAccId());
		}
		$this->assign('NEXT_TARIFF_TITLE', $tarif["TarifDescr"]);
		$this->assign('NEXT_TARIFF_COST', $tarif["TarifRate"]);
		break;
	    }
	}

	if(isset($_GET['choose'])) {
	    $this->page = "services/my.tariff/chooseTariff.html";
	    
	    $this->assign("OPERATOR", "");
	    $tariffid = (int)$_GET['choose'];
	    
	    if(isset($_GET['operator'])) {
		$this->assign("OPERATOR", "&operator");
		
		$trflist = unserialize(OPERATOR_TARIFFS);
		$tariff = $trflist[$tariffid];
		
		$speed = array();
		for($i=0;$i<24;$i++) {
		    $speed[$i] = $tariff["mspeed"];
		}
		
		$tariff["speed"] = $speed;
	    } else {	    
		$tariff = $this->mytarif->getTariff($tariffid);
	    };
	    
	    $this->assign("TARIFF", $tariff);
	    $this->createTarif_p1arr($tariff["speed"], $costarr);
	    
	    if(isset($_GET['confirm'])) {
		$this->page = "services/my.tariff/chooseTariff_result.html";
		
		if(isset($_GET['operator'])) {
		    $this->mytarif->setUserOperatorTariff($tariff, $this);
		    $this->assign("RESULT", $this->mytarif->errstr);
		} else {		
		    if($this->mytarif->setUserTariff($tariff, $this)) {
			$this->assign("RESULT", $this->mytarif->errstr);
		    } else {
			$this->assign("RESULT", $this->mytarif->errstr);
		    };
		};
	    }

	    return;
	}

    }
//------------------------------ MY TARIFF SECTION END  -----------------------------------

//------------------------------- START.STOP SECTION START ---------------------------------------
    function start_stop() {
	$this->page = "services/start.stop/index.html";
	
	$this->assign("SW_ERR", 0);
	$this->assign("ERR_STR", "");
	$this->assign("STATUS_TEXT", "Услуга не заказана");
	$this->assign("ACC_STAT_ONOFF", "off");

	$accid = $this->session->getAccId();
	$userid = $this->session->getUserId();
	
	if(isset($_GET['start'])) {
	    // Заказать услугу
	    $this->page = "services/start.stop/start.html";
	    
	    $sql = "select top 1 date from ipoe2_start_stop where accid=$accid order by date desc;";
	    $sth = $this->db->query($sql);
	    if($fa=$this->db->fetch_array($sth)) {
		// Проверим, не заказывалась ли услуга в этом месяце
		$t_date = strftime("%m%Y", $fa["date"]);
		$c_date = strftime("%m%Y", time());
		
		
		if($t_date==$c_date) {
		    // Услуга уже заказывалась
		    $this->assign("SW_ERR", 1);
		    $this->assign("ERR_STR", "Отказ в активации услуги: Услуга в этом месяце уже заказывалсь");
		    return;
		}
		
	    }
	    
	    $sql = "update Accounts set Disabled=1, AutoOnOff=0 where Number=$accid and UserId=$userid";
	    $this->db->query($sql);
	    
	    $sql = "select top 1 AbonentDate from AccountsAdm where UserID=$userid and AccountID=$accid order by AbonentDay desc;";
	    $sth = $this->db->query($sql);
	    $fa = $this->db->fetch_array($sth);
	    
	    $oldbildate = $fa["AbonentDate"];
	    $olddate = $this->bilTimeToTime($fa["AbonentDate"]);
	    
//	    echo strftime("%D 00:00:00", $olddate)."<br>";
	    
	    $ostalos = round(($olddate-time())/60/60/24)+1;
	    
	    $time = strtotime(strftime("%D 00:00:00", time()));
	    
//	    echo $ostalos;
	    
	    $sql = "insert into ipoe2_start_stop(accid, date, ostavalos, oldbildate) values($accid, $time, $ostalos, $oldbildate)";
	    $this->db->query($sql);
	    
	    
	    $this->assign("SERVICE_DATE", time());
	    
	    return;
	}
	
	if(isset($_GET['stop'])) {
	    $this->page = "services/start.stop/stop.html";
	    // Остановить действие услуги
	    $sql = "select id, date, ostavalos, oldbildate from ipoe2_start_stop where accid=$accid and active=1";
	    $sth = $this->db->query($sql);
	    if($fa=$this->db->fetch_array($sth)) {
		$ssid = $fa["id"];
		
		$c_date = strtotime(strftime("%D 00:00:00", time()));
		$db_date = strtotime(strftime("%D 00:00:00"), $fa["date"]);
		$cur_day = 0;

		$sql = "update Accounts set Disabled=0, AutoOnOff=1 where Number=$accid and UserId=$userid";
		$this->db->query($sql);

		$sql = "update ipoe2_start_stop set active=0 where id=$ssid";
		$this->db->query($sql);
		
		if($c_date != $db_date) {
		    $day_past = round((time() - $fa["date"])/60/60/24);
		    $day_to_add = $day_past + $fa["ostavalos"];
		    $new_date = strtotime(strftime("%D 01:00:00", time()));
		    
//		    echo $day_to_add."<br>";
		    
		    $new_bil_date = $this->timeToBilTime($new_date) + $day_to_add - 1;
		    $new_bil_day = strftime("%d", $this->bilTimeToTime($new_bil_date));
		    $old_bil_date = $fa["oldbildate"];
		    
		    $sql = "update AccountsAdm set AbonentDate=$new_bil_date, AbonentDay=$new_bil_day where AbonentDate=$old_bil_date and AccountID=$accid and UserID=$userid;";
		    $this->db->query($sql);
		    
		    
//		    echo $sql;
		}
	    }
	}
	
	$sql = "select date from ipoe2_start_stop where accid=$accid and active=1";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    $t_date = $fa["date"];

	    $this->assign("STATUS_TEXT", "Услуга заказана c ".strftime("%d %b %Y", $t_date));
	    $this->assign("ACC_STAT_ONOFF", "on");
	}
	
	
    }
//-------------------------------- START.STOP SECTION END ----------------------------------------

//----------------------------------- TRIAL.PAY SECTION START ----------------------------------------
    function trial_pay() {
        $this->page = "services/trial.pay/index.html";

    }
//----------------------------------- TRIAL.PAY SECTION END ----------------------------------------

//----------------------------------- SMS SECTION START ----------------------------------------
    function sms_get_status() {
	$rv = 1;
	$uid = $this->session->getUserId();
	
	$sql = "select status from ipoe2_sms where UserID=$uid";
	$sth = $this->db->query($sql);
	
	if($fa=$this->db->fetch_array($sth)) {
	    $rv = $fa[0];
	} else {
	    $sql = "insert into ipoe2_sms(UserID, status) values($uid, $rv)";
	    $this->db->query($sql);
	}
	
	return $rv;
    }
    
    function sms_update_status($status) {
	$uid = $this->session->getUserId();
	$sql = "update ipoe2_sms set status=$status where UserID=$uid;";
	$this->db->query($sql);
    }

    function sms() {
	if(isset($_GET['start'])) {
	    $this->page = "services/sms/start.html";
	    $this->sms_update_status(1);
	    return;
	}

	if(isset($_GET['stop'])) {
	    $this->page = "services/sms/stop.html";
	    $this->sms_update_status(0);
	    return;
	}
	
	if(isset($_GET['phupdate'])) {
	    if(isset($_POST['apr_code'])) {
		$apr_code = $_POST['apr_code'];
		
		if($apr_code == $this->session->getVar("aprcode")) {
        	    $uid = $this->session->getUserId();
        	    $n_phone = $this->session->getVar("phone");
	    
        	    $sql = "update Users set Phone='$n_phone' where UserID=$uid";
        	    $this->db->query($sql);
        	    header("Location: ".BASE_URL."?services&sms");
        	    exit();
		};
		
		$page = "services/sms/apr_err.html";
		return;
		
	    }
	
	    $n_code = (int)$_POST["code"];
	    $n_num = (int)$_POST["number"];

	    $apr_code = $this->generate_password(5);
	    $this->session->saveVar("phone", "+7".$n_code.$n_num);
	    $this->session->saveVar("aprcode", $apr_code);

	    $msg = "Код подтверждения: ".$apr_code;
	    $arr = send_sms_mail("7".$n_code.$n_num, $msg, 0);

	    $this->page = "services/sms/apr.html";
	    return;
	}
    
        $this->page = "services/sms/index.html";
        $this->assign("USER_PHONE_WRONG", 1);
        $this->assign("USER_PHONE_CODE", 0);
        $this->assign("USER_PHONE_NUM", "");
        
        if($this->sms_get_status()) {
    	    $this->assign("STATUS", "on");
    	    $this->assign("STATUS_TEXT", "Услуга заказана");
        } else {
    	    $this->assign("STATUS", "off");
    	    $this->assign("STATUS_TEXT", "Услуга не заказана");
        }
        
        $mobile_codes = unserialize(MOBILE_CODES);
        $this->assign("MOBILE_CODES", $mobile_codes);
        
        $userinfo = $this->getBilInfo($this->session->getUserId());
        $phone = $userinfo["Phone"];
        if(strlen($phone)<5) {
    	    $phone = "Не был указан";
    	};
    	
    	$parsedPhone = $this->parsePhone($phone);
    	if(sizeof($parsedPhone)>0) {
            $p_code = $parsedPhone[2];
            $p_num  = $parsedPhone[3];
            
            $this->assign("USER_PHONE_CODE", $p_code);
            
            if(in_array($p_code, $mobile_codes)) {
        	$this->assign("USER_PHONE_WRONG", 0);
        	$this->assign("USER_PHONE_NUM", $p_num);
    	    };
    	};
    	
        $this->assign("USER_PHONE", $phone);
        $this->assign("USER_PHONE_ARR", $this->parsePhone($phone));

    }
//----------------------------------- SMS SECTION END ----------------------------------------

    
    function run() {
	if(isset($_GET['my_tariff'])) $this->my_tariff();
	if(isset($_GET['start_stop'])) $this->start_stop();
	if(isset($_GET['trial_pay'])) $this->trial_pay();
	if(isset($_GET['sms'])) $this->sms();
	
	return $this->render();
    }
    
    function render() {
	return $this->fetch($this->page);
    }
}
?>