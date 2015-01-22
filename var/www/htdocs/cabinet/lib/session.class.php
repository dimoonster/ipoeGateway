<?php

class Session {
    private $app;

    function __construct($app) {
        @session_start();
        
        $this->app = $app;
        
        if(!$this->loggedIn()) {
    	    // Пользователь не в системе
    	    
    	    $check_access = 0;
    	    
    	    // Проверим по IP (если абонент подключен по IPoE)
    	    $ip = $_SERVER["REMOTE_ADDR"];
    	    
    	    $sql = "SELECT ipoe2_inttoacc.accid, Accounts.UserID
        	    FROM ipoe2_inttoacc INNER JOIN
        	    Accounts ON ipoe2_inttoacc.accid = Accounts.Number
	            WHERE (ipoe2_inttoacc.ipaddr LIKE '".$ip."')";
	    $sth = $this->app->db->query($sql);
	    
	    if($fa=$this->app->db->fetch_array($sth)) {
		// клиент пришёл по IPoE
		$this->setLoggedIn(1);
		$this->setUserId($fa[1]);
		$this->setAccId($fa[0]);
	    }
        }
    }
    
    public function logout() {
        $this->setLoggedIn(0);
	$this->setUserId(-1);
	$this->setAccId(-1);
    }
    
    public function loggedIn() {
	if(!isset($_SESSION["loggedIn"])) return false;
	if($_SESSION["loggedIn"]==0) return false;
	return true;
    }
    
    public function getUserId() {
	return $_SESSION["userId"];
    }
    
    public function getAccId() {
	return $_SESSION["accId"];
    }
    
    public function setUserId($userid) {
	$_SESSION["userId"] = $userid;
    }
    
    public function setAccId($accid) {
	$_SESSION["accId"] = $accid;
    }
    
    public function setLoggedIn($log) {
	$_SESSION["loggedIn"] = $log;
    }
    
    public function updateUsersCache($user, $pass) {
	$sql = "update ipoe2_users_cache set Password = '$pass' where AccountName = '$user';";
	$s = $this->app->db->query($sql);
	
	echo "Num: ".$this->app->db->affected_rows();
	
	if($this->app->db->affected_rows()==0) {
	    $accid = $this->app->getAccountId($user);
	    $sql = "insert into ipoe2_users_cache(AccountName, Password, AccountID) values('$user', '$pass', $accid)";
	    $this->app->db->query($sql);
	}
    }
    
    public function checkAuth($user, $pass) {
	// Сначала проверим по радиусу
	$radius = unserialize(RADIUS);
	
	$radh = radius_auth_open();
	radius_add_server($radh, $radius["host"], $radius["port"], $radius["key"], 1, 5);
	radius_create_request($radh, RADIUS_ACCESS_REQUEST);
	
	radius_put_attr($radh, 1, $user);
	radius_put_attr($radh, 2, $pass);
	
	$radresult = radius_send_request($radh);
	
	if($radresult == 2) {
	    // Радиус - успешно. Обновим пароль в кэше
	    $this->updateUsersCache(addslashes($user), addslashes($pass));
	    
	    $this->setLoggedIn(1);
	    $this->setAccId($this->app->getAccountId(addslashes($user)));
	    $this->setUserId($this->app->getUserId($this->getAccId()));
	    
	    return 1;
	}
	
	// Аутентификация по радиусу не прошла. Возможно аккаунт отключен за не уплату
	// Проведём идентификацию по кэшу
	$sql = "select Password, AccountID from ipoe2_users_cache where AccountName = '".addslashes($user)."';";
	$sth = $this->app->db->query($sql);
	if($fa=$this->app->db->fetch_array($sth)) {
	    if($fa[0] == $pass) {
		$this->setLoggedIn(1);
		$this->setAccId($fa[1]);
		$this->setUserId($this->app->getUserId($fa[1]));
		
		return 1;
	    }
	}
	
	// Аутентификация не удалась
	return -1;
    }
    
    public function changeAccId($newaccid) {
	$sql = "select UserID from Accounts where Number = ".$newaccid;
	$sth = $this->app->db->query($sql);
	if($fa=$this->app->db->fetch_array($sth)) {
	    $sesUserId = $this->getUserId();
	    $dbUserId = $fa[0];
	    
	    if($sesUserId == $dbUserId) {
		$this->setAccId($newaccid);
		return 1;
	    }
	};
	return 0;
    }
    
    public function saveVar($var, $value) {
	$_SESSION[$var] = $value;
    }
    
    public function getVar($var) {
	return $_SESSION[$var];
    }
}
?>