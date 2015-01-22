<?php
require_once(dirname(__FILE__)."/application.class.php");

class DataApplication extends Application {
    function __construct() {
	parent::__construct();
    }
    
    function run() {
	$arr = $this->getBilInfo($this->session->getUserId());
	
	$this->assign("ABONENT", $arr);
    
	return $this->render();
    }
    
    function render() {
	return $this->fetch("info.html");
    }
}
?>