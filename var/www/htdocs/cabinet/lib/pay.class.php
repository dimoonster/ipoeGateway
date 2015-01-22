<?php
require_once(dirname(__FILE__)."/application.class.php");

class DataApplication extends Application {
    function __construct() {
	parent::__construct();
    }
    
    public function getPayList($userid) {
        $sql = "SELECT     Credits.PayDate, Credits.SumInRubles, Credits.Cashe, PayTypes.PaySource
                FROM         Credits INNER JOIN
                PayTypes ON Credits.Cashe = PayTypes.PayID
                WHERE     (Credits.UserID = ".$userid.")
                ORDER BY Credits.PayDate DESC;";
        $sth = $this->db->query($sql);

        $arr = null;
        $i = 0;
        while($fa=$this->db->fetch_array($sth)) {
            $arr[$i]["PayDate"] = $this->BilTimeTotime($fa[0]);
            $arr[$i]["SumInRubles"] = $fa[1];
            $arr[$i]["PaySource"] = iconv("CP1251", "UTF-8", $fa[3]);

            $i++;
        }

        return $arr;
    }
    
    public function getDebetsList($userid) {
	$sql = "SELECT     Debets.DebetID, Debets.UserID, Debets.AccountID, Debets.OperTime, Debets.TariffID, Debets.Rate, Debets.Quantity, 
		Debets.Cost, Debets.PayedCost, 
		Tariffs.Description, Accounts.AccountName
	        FROM         Debets INNER JOIN
	        Tariffs ON Debets.TariffID = Tariffs.TariffID INNER JOIN
	        Accounts ON Debets.AccountID = Accounts.Number
	        WHERE     (Debets.UserID = $userid) order by Debets.DebetID desc;";
	$sth = $this->db->query($sql);
	
	$arr = null;
	for($i=0;$fa=$this->db->fetch_array($sth);$i++) {
	    $arr[$i]["Account"] = iconv("CP1251", "UTF-8", $fa[10]);
	    $arr[$i]["Tariff"] = iconv("CP1251", "UTF-8", $fa[9]);
	    $arr[$i]["Cost"] = $fa[7];
	    $arr[$i]["Date"] = $this->BilTimeTotime($fa[3]);
	}
	
	return $arr;
    }
    
    function run() {
	$pays = $this->getPayList($this->session->getUserId());
	$debets = $this->getDebetsList($this->session->getUserId());
	
	$this->assign("PAYLIST", $pays);
	$this->assign("DEBETS", $debets);
    
	return $this->render();
    }
    
    function render() {
	return $this->fetch("pay.html");
    }
}
?>