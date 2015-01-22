<?php
require_once(dirname(__FILE__)."/../config.php");
require_once(dirname(__FILE__)."/smarty/Smarty.class.php");
require_once(dirname(__FILE__)."/mssql.class.php");
require_once(dirname(__FILE__)."/session.class.php");

class Application extends Smarty {
    public $main_menu;
    public $db;
    
    public $TGROUPS;
    
    public $session;

    public function __construct() {
	parent::__construct();
	
	$this->main_menu = unserialize(MAIN_MENU);
	$this->TGROUPS = unserialize(TGROUPS);
	
	$this->setCompileDir(dirname(__FILE__)."/tmp/templates_c/");
	$this->setCacheDir(dirname(__FILE__)."/tmp/cache/");
	$this->setTemplateDir(dirname(__FILE__)."/../template/");
	$this->setConfigDir(dirname(__FILE__)."/../template/configs/");
	
	$this->assign('BASE_URL', BASE_URL);
	$this->assign('MAIN_MENU', $this->main_menu);
	
	$this->db = new db;
	
	$this->session = new Session($this);

	$this->assign('ACCOUNT_ACTIVE', 0);
	
	if($this->session->loggedIn()) {
//	    echo $this->session->getUserId();
//	    print_r($_SESSION);
//	    print_r($this->getAccounts($this->session->getUserId()));
	
	    $this->assign('ACCOUNTS', $this->getAccounts($this->session->getUserId()));
	    $this->assign('ACCOUNT_ACTIVE', $this->session->getAccId());
	    
	    $this->assign('ACCOUNT_NAME', $this->getAccountName($this->session->getAccId()));
	    $this->assign('ACCOUNT_STATUS', $this->getAccountStatus($this->session->getAccid()));
	}
    }
    
    public function run() {
    }
    
    public function timeToBilTime($time) {
	return ($time + 3*60*60)/24/60/60 + 25569 + 1;
    }
    
    public function bilTimeToTime($time) {
	return ($time-25569)*24*60*60-3*60*60;
    }
    
    public function getAccounts($userid) {
	$sql = "select Number, UserID, AccountName, Disabled, TechGroupID from Accounts where UserID=".$userid;
	$sth = $this->db->query($sql);
	$arr = null;
	$index = 0;
	
	while($fa=$this->db->fetch_array($sth)) {
	    $arr[$index]["Number"] = $fa["Number"];
	    $arr[$index]["AccName"] = iconv("CP1251", "UTF-8", $fa["AccountName"]);
	    $arr[$index]["Disabled"] = $fa["Disabled"];
	    $arr[$index]["TechGroupID"] = $fa["TechGroupID"];
	    $arr[$index]["CanChangeTarif"] = 0;
	    
	    $arr[$index]["TarifInfo"] = $this->getAccountTarifs($userid, $arr[$index]["Number"]);
	    if(in_array($arr[$index]["TechGroupID"], $this->TGROUPS)) $arr[$index]["CanChangeTarif"] = 1;
	    
	    $index++;
	}
	
	return $arr;
    }
    
    public function getAccountTarifs($userid, $accid) {
        $sql = "SELECT AccountsAdm.AccountAdmID, AccountsAdm.UserID, AccountsAdm.AccountID, AccountsAdm.AdmGroupID, AccountsAdm.DateOn,
                AccountsAdm.AbonentType, AccountsAdm.AbonentSkipFirst, AccountsAdm.AbonentDate, AccountsAdm.AbonentDay, AccountsAdm.AccountedDate
                FROM AccountsAdm
                WHERE (AccountsAdm.UserID = ".$userid.") AND (AccountsAdm.AccountID = ".$accid.")
                order by AccountAdmID desc";
        $sth = $this->db->query($sql);
        $arr = null;
        for($i=0; $fa=$this->db->fetch_array($sth); $i++) {
	    $arr[$i]["TarifID"] = $fa[3];
	    $arr[$i]["DateOn"] = $this->bilTimeToTime($fa[4]);
	    $arr[$i]["AbonentDate"] = $this->bilTimeToTime($fa[7]);

            $sql1 = "select Description, AbonentRate, AbonentPeriod from Tariffs where GroupID=".$arr[$i]["TarifID"]." order by TariffID desc;";
            $sth1 = $this->db->query($sql1);
            $fa1 = $this->db->fetch_array($sth1);
            
            $arr[$i]["TarifDescr"] = iconv("CP1251", "UTF-8", $fa1[0]);
            $arr[$i]["TarifRate"] = $fa1[1];
            $arr[$i]["TarifPeriod"] = $fa1[2];
        }
        
        return $arr;
    }
    
    public function getAccountId($account) {
	$sql = "select Number from Accounts where AccountName = '$account';";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return $fa[0];
	}
	
	return 0;
    }
    
    public function getAccountName($accid) {
	$sql = "select AccountName from Accounts where Number = $accid;";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return iconv("CP1251", "UTF-8", $fa[0]);
	}
	
	return 0;
    }
    
    public function getAccountStatus($accid) {
	$sql = "select Disabled from Accounts where Number = $accid;";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return $fa[0];
	}
	
	return 0;
    }
    
    public function getUserId($accid) {
	$sql = "select UserID from Accounts where Number = $accid";
	$sth = $this->db->query($sql);
	if($fa=$this->db->fetch_array($sth)) {
	    return $fa[0];
	}
	
	return 0;
    }

    public function strToHex($string) {
        $hex='';
        for ($i=0; $i < strlen($string); $i++) {
        	$hex .= dechex(ord($string[$i])). " ";
        }
        return $hex;
    }
    
    public function getBilInfo($userid) {
        $sql = "SELECT     UserID, Title, FullName, PrivateFlag, CreditScheme, ContractNumber, ContractDate, Diler, Email, OfficialAddress, PostAddress, Phone, Fax, Contact,
                Bank, AccNumber, CAccNumber, BIK, INN, OKONX, OKPO, Sex, PassportSerie, PassportNumber, PassportGiven, PassportGivenDate, RealRest,
                CommonRest, SaldoSecs, RestDate, Info, DiscRest, WarnRest, WarnSaldoMins, Commercial, ConnectionType, DiskSN, DiskRegistered, AdminPWD,
                AdvertSrc, ExpirationDate, Notice, SizeLimitAll, KPP
                FROM         Users
                WHERE     (UserID = ".$userid.")";
        $arr = null;

        $sth = $this->db->query($sql);
        if($fa=$this->db->fetch_array($sth)) {
            $arr["Title"] = iconv("CP1251", "UTF-8", $fa["Title"]);
            $arr["FullName"] = iconv("CP1251", "UTF-8", $fa["FullName"]);
            $arr["Email"] = iconv("CP1251", "UTF-8", $fa["Email"]);
            $arr["ContractNumber"] = $fa["ContractNumber"];
            $arr["ContractDate"] = $this->BilTimeTotime($fa["ContractDate"]);
            $arr["OfficialAddress"] = iconv("CP1251", "UTF-8", $fa["OfficialAddress"]);
            $arr["Phone"] = iconv("CP1251", "UTF-8", $fa["Phone"]);
            $arr["Balance"] = round($fa["RealRest"], 2);
            $arr["PrivatePerson"] = $fa["PrivateFlag"];                         // 1 - физик, 0 - юрик
            // Если клиент физик - заполним инфу о нём
            if($arr["PrivatePerson"]) {
                $arr["PassportSerie"]   = $fa["PassportSerie"];
                $arr["PassportNumber"]  = $fa["PassportNumber"];
                $arr["PassportGivenDate"] = $this->BilTimeTotime($fa["PassportGivenDate"]);
                $arr["PassportGiven"] = iconv("CP1251", "UTF-8", $fa["PassportGiven"]);
                $arr["Sex"] = $fa["Sex"];
            } else {
                // Если юрик - то иридическую инфу
                $arr["Bank"]    = iconv("CP1251", "UTF-8", $fa["Bank"]);
                $arr["RS"]      = $fa["AccNumber"];
                $arr["KS"]      = $fa["CAccNumber"];
                $arr["Bik"]     = $fa["BIK"];
                $arr["Inn"]     = $fa["INN"];
                $arr["KPP"]     = $fa["KPP"];
            }
            //          $this->debugArray($arr);
            return $arr;
        }
    }
    
    public function parsePhone($phone) {
        $str = $phone;
        $str = "+".preg_replace("/(\W)|([A-Za-z])|(\_)/", "", $str);
        $str = preg_replace("/^\+8/", "+7", $str);
        $out = array();
        preg_match("/(\+7)(\d{3})(\d{7})/", $str, $out);
        return $out;
    }
    
    function generate_password($number) {
        $arr = array('q','w','e','r','t','y',
                    'u','i','o','p','a','s',
                    'd','f','g','h','j','k',
                    'l','z','x','c','v','b','n','m',
                    '1','2','3','4','5','6',
                    '7','8','9','0');

        $pass = "";
        for($i = 0; $i < $number; $i++) {
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }
};

?>