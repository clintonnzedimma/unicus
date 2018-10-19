<?php 
/**
* @author Clinton Nzedimma
* @controller for tpanel dashboard
*/
Admin::protectPage();
$room = new Room(); //room factory
$user = new User(); //user factory 
$hall = new Hall(); //hall factory


?>