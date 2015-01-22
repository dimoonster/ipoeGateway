<?php
session_start();

require_once(dirname(__FILE__)."/lib/application.class.php");

class CabinetApplication extends Application {

    public function __construct() {
	parent::__construct();
    }
    
    public function run() {
	if(isset($_GET['css'])&&($_GET['css'])!="") {
	    header("Content-type: text/css");

	    $css = strtolower($_GET['css']);
	    switch($css) {
		case 'style.css': $this->display("style.css"); break;
		case 'select.css': $this->display("select.css"); break;
		case 'tablesorter.css': $this->display("tablesorter.css"); break;
	    }
	    
	    return;
	};
	
	if(isset($_GET['quit'])) {
	    $this->session->logout();
	    header("Location: ".BASE_URL);
	    exit();
	};
	
	if(isset($_GET['session'])) {
	    if(isset($_GET['change_accid'])) {
		$newaccid = (int)$_POST['blogin'];
		if($this->session->changeAccId($newaccid)) {
		    header("Location: ".$_SERVER["HTTP_REFERER"]);
		    exit();
		};
	    };
	    $this->session->logout();
	    header("Location: ".BASE_URL);
	    exit();
	};

	$keys = array_keys($this->main_menu);
	$this->assign('CURRENT_MAIN_MENU_POSITION', $keys[0]);
	$this->assign('TITLE', $this->main_menu[$keys[0]]);
	
	$position = $keys[0];
	
	foreach($this->main_menu as $m_addr=>$m_title) {
	    if(isset($_GET[$m_addr])) {
		$this->assign('TITLE', $m_title);
		$this->assign('CURRENT_MAIN_MENU_POSITION', $m_addr);
		$position = $m_addr;
	    }
	};
	
	if($this->session->loggedIn()) {
	    require_once(dirname(__FILE__)."/lib/".$position.".class.php");
	    $app = new DataApplication;
	    $page_data = $app->run();
	    $this->assign("PAGE_DATA", $page_data);
	} else {
	    $check_result = 0;
	
	    if(@$_POST["login"]&&@$_POST["password"]) {
		$check_result = $this->session->checkAuth($_POST["login"], $_POST["password"]);
	    }
	
	    if(!$this->session->loggedIn()) {
		$this->assign("CHECK_AUTH_RESULT", $check_result);
	    
		$this->assign("LOGIN", @$_POST["login"]);
		$this->assign("PAGE_DATA", "");
		$this->display("login_form.html");
		exit();
	    };

	    header("Location: ".BASE_URL);
	    exit();
	};
	
	if(isset($_GET['ajax'])) {
	    echo $this->getTemplateVars("PAGE_DATA");
	} else {
	    $this->display("page.html");
	};
    }
};

$app = new CabinetApplication;
$app->run();
?>