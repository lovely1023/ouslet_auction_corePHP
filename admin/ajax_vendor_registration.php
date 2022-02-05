<?php
require_once("function.php");
//print_r($_POST);
unset($_POST["cpassword"]);
if(isset($_FILES) && $_FILES["image"]["error"]==0){
	$image=time().$_FILES["image"]["name"];
	$_POST["image"]=$image;
	$tmp_name=$_FILES["image"]["tmp_name"];
	move_uploaded_file($tmp_name,'../vendor/vendor_image/'.$image);
}

$password=$_POST["password"];
$_POST["password"]=md5($_POST["password"]);
$status=doInsert($_POST,"vendor_registration");
$recent_id=newly_insert_id();
if($status){
doInsert(array("avb_vr_id"=>$recent_id,"balance"=>0),"ambit_vendor_balance");


$to = $_POST["email"];
$subject = "Login Link";
$txt = "To login<a href='admin_new/vendor_login.php'>Click Here</a>"."Your password is:". $password;
$headers = "From:".' webmaster@example.com' . "\r\n" ."CC:".$_POST["email"];

mail($to,$subject,$txt,$headers);

	echo 1;
}else{
	echo 0;
}
?>