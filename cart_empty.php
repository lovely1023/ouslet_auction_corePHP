<?php
session_start();
require_once("function.php");

if(isset($_SESSION["ac_id"])){
  $where=array("aad_cart_ac_id"=>$_SESSION["ac_id"]);
  $status=doDelete("ambit_add2cart", $where);
}else{
	unset($_SESSION['add2cart']);
}
?>