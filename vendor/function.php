<?php
//error_reporting(0);
require_once("config.php");
if(($_COOKIE['lang_id']=='English')||($_COOKIE['lang_id']=='')){
require_once("../language/English.php");
}
if($_COOKIE['lang_id']=='Spanish'){
require_once("../language/Spanish.php");
}
function doInsert($field=array(),$table){
	 global $conn;
	$dbdata=array();
	$set=" SET ";
	if(!empty($field)){
		foreach($field as $k=>$v){
			array_push($dbdata,"`".$k."`='".mysqli_real_escape_string($conn,$v)."'");
		}
	}
	$set.=implode(",",$dbdata);
	$query="INSERT INTO ".$table.$set;
	//echo $query;
	return mysqli_query($conn,$query);
}

function newly_insert_id(){
	global $conn;
	return mysqli_insert_id($conn);
}

function doSelect($select,$table,$condition=array(),$orderBy=""){
	global $conn;
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($condition)){
		foreach($condition as $k=>$v){
		array_push($condition1,$k."='".mysqli_real_escape_string($conn,$v)."'");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="SELECT ".$select." FROM ".$table.$where.$orderBy;
	//echo $query;
	return mysqli_query($conn,$query);
}
function doSelect1($select,$table,$condition=array(),$orderBy=""){
	global $conn;
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($condition)){
		foreach($condition as $k=>$v){
		array_push($condition1,$k."=".mysqli_real_escape_string($conn,$v)."");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="SELECT ".$select." FROM ".$table.$where.$orderBy;
	//echo $query;
	return mysqli_query($conn,$query);
}
function doSelect2($select,$table,$condition=array(),$orderBy=""){
	global $conn;
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($condition)){
		foreach($condition as $k=>$v){
		array_push($condition1,$k."=".mysqli_real_escape_string($conn,$v)."");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="SELECT ".$select." FROM ".$table.$where.$orderBy;
	// echo $query;
	//return mysql_query($query);
	return $query;
}
function doSelect3($query){
	global $conn;
	//echo $query;
	return mysqli_query($conn,$query);
}

function loginCheck($query){
	$dbdata=array();
	$rows=mysqli_num_rows($query);
	if($rows==1){
		while($data=mysqli_fetch_assoc($query)){
			array_push($dbdata, $data);
		}
	}
	return $dbdata;
}

function session_chk_login($field=array()){
	if(empty($field)){
		return false;
	}
	$query=getDetails(doSelect("*","customer",$field));
	if(count($query)==1){
		return true;
	}else{
		return false;
	}
}

function getDetails($query){

	$dbdata=array();
	$rows=mysqli_num_rows($query);
	if($rows >= 1){
		while($data=mysqli_fetch_assoc($query)){
			array_push($dbdata, $data);
		}
	}
	return $dbdata;
}

function doUpdate($table,$field=array(),$condition=array()){
	global $conn;
	$dbdata=array();
	$set=" SET ";
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($field)){
		foreach($field as $k=>$v){
			array_push($dbdata,"`".$k."`='".mysqli_real_escape_string($conn,$v)."'");
		}
	$set.=implode(",",$dbdata);
	}
	if(!empty($condition)){
		foreach($condition as $k=>$v){
		array_push($condition1,"`".$k."`='".mysqli_real_escape_string($conn,$v)."'");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="UPDATE ".$table.$set.$where;
	//echo $query;
	return mysqli_query($conn,$query);
}

function doUpdate1($table,$field=array(),$condition=array()){
	global $conn;
	$dbdata=array();
	$set=" SET ";
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($field)){
		foreach($field as $k=>$v){
			array_push($dbdata,"`".$k."`='".mysqli_real_escape_string($conn,$v)."'");
		}
	$set.=implode(",",$dbdata);
	}
	if(!empty($condition)){
		foreach($condition as $k=>$v){
		array_push($condition1,$k."='".mysqli_real_escape_string($conn,$v)."'");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="UPDATE ".$table.$set.$where;
	//echo $query;
	return mysqli_query($conn,$query);
}

function doDelete($table,$condition=array()){
	global $conn;
	$condition1=array();
	$where=" WHERE 1 ";
	if(!empty($condition)){
		foreach($condition as $k=>$v){
			array_push($condition1,"`".$k."`='".mysqli_real_escape_string($conn,$v)."'");	
		}
	$where.=" AND ".implode(" AND ",$condition1);
	}
	$query="DELETE FROM ".$table.$where;
	//echo $query;
	return mysqli_query($conn,$query);
}

function rating($rate){

			//$rate=getDetails(doSelect1("count(*) as count,SUM(rate) as sum","rating",array("rating_ho_id"=>$ho_id)));
			//$rate=getDetails(mysql_query("SELECT count(*) as count,SUM(rate) as sum FROM rating WHERE rating_ho_idin('$ho_id')"));
			if($rate[0]["count"] !=0){
			$member=$rate[0]["count"];
			$rate=$rate[0]["sum"];
			$cal=($rate/$member);
			$half=0;
			$full=0;
			$no_star=0;
			if(is_int($cal)){
				if(round($cal) < 5){
				$no_star=5-round($cal);
			}	
			return '0||'.$cal.'||'.$no_star;	
			}
			$rem=explode(".",$cal)[1];
			if($rem[0]==5){
			$half_full=1+floor($cal);
			if($half_full < 5){
				$no_star=5-$half_full;
			}
			return '1||'.floor($cal).'||'.$no_star;
			}else{
			if(round($cal) < 5){
				$no_star=5-round($cal);
			}	
				return '0||'.round($cal).'||'.$no_star;
			}
		}else{
			return '0||0||5';
		}
	}

function get_site_settings($id=""){
	$result=getDetails(doSelect1("st_value","site_settings",array("st_id"=>$id)));
	return $result[0]["st_value"];
}

function get_mail_settings($id=""){
	$result=getDetails(doSelect1("body","mail_body_settings",array("mbs_id"=>$id)));
	return $result[0]["body"];
}

function seeMoreDetails($select,$from,$where){
	$result=getDetails(doSelect1($select,$from,$where));
	if(!empty($result)){
	return $result[0][$select];
	}
}

function seeMoreDtls($select,$from,$where){
	$result=getDetails(doSelect($select,$from,$where));
	if(!empty($result)){
	return $result[0][$select];
	}
}

function new_msg(){	
$select="at_usr_scrn_name,am_id,time,am_subject,am_message";
$from="ambit_mail,ambit_user_details";
$where=array('am_from_id'=>'at_usr_signup_id','am_to_id'=>$_SESSION["dt_su_id"],"t_st"=>0);
$new_msg=mysqli_num_rows(doselect1($select,$from,$where));
return $new_msg;
}


function count_days($new_date){
$now = time();
$date = strtotime($new_date);
$datediff = $now - $date;
$day=floor($datediff / (60 * 60 * 24));
if($day==0){
	return 'Today';
}else{
	return $day." day's ago";
}
}

function get_pkg($id){
$check=getDetails(doSelect("abp_p_id","ambit_buy_package",array("abp_u_id"=>$id,"status"=>"pass","expire >"=>date('Y-m-d h:i:s'))));
if(!empty($check)){
	return $check[0]['abp_p_id'];
	}else{
		return 1;
	}
}
function access_features($id,$features){
$check=getDetails(doSelect("abp_p_id","ambit_buy_package",array("abp_u_id"=>$id,"status"=>"pass","expire >"=>date('Y-m-d h:i:s'))));
if(!empty($check)){
	$pkg_id=$check[0]['abp_p_id'];
	}else{
		$pkg_id=1;
	}
$status=getDetails(doSelect($features,"ambit_package_description",array("package_id"=>$pkg_id)));
if(!empty($status)){
if($status[0][$features]==1){
	return 1;
}else{
	return 0;
}
}
}

function access($pkg_id,$features){
$status=getDetails(doSelect($features,"ambit_package_description",array("package_id"=>$pkg_id)));
if(!empty($status)){
if($status[0][$features]==1){
	return 1;
}else{
	return 0;
}
}
}

function pro_featurs($apfe_aap_id,$field){
	return seeMoreDetails($field,"ambit_properties_features",array("apfe_aap_id"=>$apfe_aap_id));
}
function pro_area($apa_aap_id,$field){
	return seeMoreDetails($field,"ambit_properties_area",array("apa_aap_id"=>$apa_aap_id));
}
function pro_avlbilty($apav_aap_id,$field){
	return seeMoreDetails($field,"ambit_properties_avlbilty",array("apav_aap_id"=>$apav_aap_id));
}
function pro_price($app_aap_id,$field){
	return seeMoreDetails($field,"ambit_properties_price",array("app_aap_id"=>$app_aap_id));
}

function unit($aau_id){
return seeMoreDetails("aau_unit_name","ambit_area_unit",array("aau_id"=>$aau_id));
}

function getVendorName($id){
	$name=getDetails(doSelect1("fname,lname","vendor_registration",array("vr_id"=>$id)));
	$name=$name[0]["fname"].' '.$name[0]["lname"];
	return $name;
}

function getVendorId($id){
	$name=getDetails(doSelect1("apa_vr_id","ambit_product_add",array("apa_id"=>$id)));
	$name=$name[0]["apa_vr_id"];
	return $name;
}

function getCustomerName($id){
	$name=getDetails(doSelect1("name","ambit_customer",array("ac_id"=>$id)));
	$name=$name[0]["name"];
	return $name;
}

function getExactPrice($apa_id){
	$price=getPrice($apa_id);
	$discount=getDiscount($apa_id);
	$exact=$price + $discount;
	return $exact;
}

function getPrice($apa_id){
	$priceDetails=getDetails(doSelect1("price,posting_type, reserve_price","ambit_product_add",array("apa_id"=>$apa_id)));
	if(!empty($priceDetails)){
		$price=explode("||",$priceDetails[0]["price"]);
		if($priceDetails[0]["posting_type"] == 1 && $priceDetails[0]["reserve_price"] > $price[0]){
			return round($priceDetails[0]["reserve_price"] * 1.1025, 2);
		}else{
			//return $price[0];	
			return $price[0] + $price[1];	
		}
		
	}else{
		return 0;
	}
}

function getDiscount($apa_id){
	$priceDetails=getDetails(doSelect1("price","ambit_product_add",array("apa_id"=>$apa_id)));
	if(!empty($priceDetails)){
	$price=explode("||",$priceDetails[0]["price"]);
	return $price[2];
	}else{
		return 0;
	}
}



function getTax($apa_id){
	//$priceDetails=getDetails(doSelect1("price","ambit_product_add",array("apa_id"=>$apa_id)));
	$priceDetails=getDetails(doSelect1("price, posting_type, reserve_price","ambit_product_add",array("apa_id"=>$apa_id)));
	if(!empty($priceDetails)){
		$price=explode("||",$priceDetails[0]["price"]);
		if($priceDetails[0]["posting_type"] == 1 && $priceDetails[0]["reserve_price"] > $price[0]){
			return round($priceDetails[0]["reserve_price"] * 0.1025, 2);
		}else{
			return $price[1];	
		}
		
	}else{
		return 0;
	}
}
function getShippingCost($apa_id){
	$priceDetails=getDetails(doSelect1("price","ambit_product_add",array("apa_id"=>$apa_id)));
	if(!empty($priceDetails)){
	$price=explode("||",$priceDetails[0]["price"]);
	return $price[3];
	}else{
		return 0;
	}
}

function getCustomerAddr($ac_id){
	$details=getDetails(doSelect1("address,cn_name,ct_name","ambit_customer,ambit_country,ambit_city",array("ac_id"=>$ac_id,"country"=>"cn_id","city"=>"ct_id")));
	return $details[0]["address"].'<br/>'.$details[0]["ct_name"].'<br/>'.$details[0]["cn_name"];						
}

function getProductName($apa_id){
	$name=seeMoreDetails("name","ambit_product_add",array("apa_id"=>$apa_id));
	return $name;
}
function getDescription($apa_id){
	$description=seeMoreDetails("description","ambit_product_add",array("apa_id"=>$apa_id));
	return $description;
}
function getFeature($apa_id){
	$feature=seeMoreDetails("features","ambit_product_add",array("apa_id"=>$apa_id));
	return $feature;
}

function getProductPhoto($id){
	$image=getDetails(doSelect1('image',"ambit_product_image",array("api_apa_id"=>$id),' LIMIT 0,1'));
	if(!empty($image)){
		return $image[0]["image"];
	}else{
		return '';
	}
}

function getImage($apa_id){
	$image=seeMoreDetails("image","ambit_product_image",array("api_apa_id"=>$apa_id));
	return $image;
}
function getBrand($apa_id){
	$ab_id=seeMoreDetails("brand","ambit_product_add",array("apa_id"=>$apa_id));
	$brand=seeMoreDetails("ab_name","ambit_brand",array("ab_id"=>$ab_id));
	return $brand;
}
function getWeight($apa_id){
	$weight=seeMoreDetails("weight","ambit_product_add",array("apa_id"=>$apa_id));
	if(trim($weight) != ""){
		$weights=explode(":",$weight);
		$unit=seeMoreDetails("awu_unit","ambit_weight_unit",array("awu_id"=>$weights[1]));
		return $weights[0].$unit;
	}else{
		return '<font color="red">Unknown</font>';
	}
}
function getAvailability($apa_id){
	$stock=seeMoreDetails("stock","ambit_product_add",array("apa_id"=>$apa_id));
	if(trim($stock) > 0 ){
		return 'In Stock';
	}else{
		return '<font color="red">Out Of Stock</font>';
	}
}
function baseOnReview($apa_id){
	$count=seeMoreDetails("count(*)","ambit_product_review",array("apr_apa_id"=>$apa_id));
	if(trim($count) > 0 ){
		return 'Based On '.trim($count).' Review (s)';
			}else{
				return '';
			}
}
function currency(){
	return '$ ';
}

function base_currency(){
	//return trim(seeMoreDetails("acu_id","ambit_currency",array("unit_price"=>1)));
	return trim(seeMoreDetails("acu_id","ambit_currency",array("acu_id"=>1)))." ";
}

function get_currency(){
	if(isset($_COOKIE['acu_id']) && $_COOKIE['acu_id']!=''){
	return trim(seeMoreDetails("currency","ambit_currency",array("acu_id"=>$_COOKIE['acu_id'])))." ";
	}else{
	//	return trim(seeMoreDetails("currency","ambit_currency",array("unit_price"=>1)));	
		return trim(seeMoreDetails("currency","ambit_currency",array("acu_id"=>1)))." ";	
	}
}

function currency1($currency,$price){
	$currency=trim($currency);
	$price=trim($price);
	$prev_price=trim(seeMoreDetails("unit_price","ambit_currency",array("acu_id"=>$currency)));
	if(isset($_COOKIE['acu_id']) && $_COOKIE['acu_id']!=''){
		$con_price=trim(seeMoreDetails("unit_price","ambit_currency",array("acu_id"=>$_COOKIE['acu_id'])));
	}else{
		//$con_price=trim(seeMoreDetails("unit_price","ambit_currency",array("unit_price"=>1)));	
		$con_price=trim(seeMoreDetails("unit_price","ambit_currency",array("acu_id"=>1)));		
	}
	//$cal=number_format(($con_price/$prev_price)*$price,2);
	if ($prev_price != "" && $prev_price != 0)
		$cal=number_format(($con_price/$prev_price)*$price,2);
	else
		$cal=0;	
	$return=get_currency().$cal;
	return $return;
}

function unit_currency(){
	//return trim(seeMoreDetails("acu_id","ambit_currency",array("unit_price"=>1)));	
	if(isset($_COOKIE['acu_id']) && $_COOKIE['acu_id']!=''){
		$con_price=trim(seeMoreDetails("acu_id","ambit_currency",array("acu_id"=>$_COOKIE['acu_id'])));
	}else{
		//$con_price=trim(seeMoreDetails("unit_price","ambit_currency",array("unit_price"=>1)));	
		$con_price=trim(seeMoreDetails("acu_id","ambit_currency",array("acu_id"=>1)));		
	}
	return $con_price;
}

function get_date_str($date){
	echo date("jS F, Y",strtotime($date));
}
function getRatingStar($id){
	
				$rate=getDetails(doSelect1("count(*) as count,SUM(rating) as sum","ambit_product_review",array("apr_apa_id"=>$id)));
				$a=explode("||",rating($rate));
				$half_star=$a[0];
				$full_star=$a[1];
				$no_star=$a[2];
				for($i=1;$i<=$full_star;$i++){
				echo '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
				}
				for($i=1;$i<=$half_star;$i++){
				echo '<span class="fa fa-stack"><i class="fa fa-star-half-o"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
				}
				for($i=1;$i<=$no_star;$i++){
				echo '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>';
				}
				
}


function get_sub_sub_cat_id($pssc_name){
	return seeMoreDtls('pssc_id',"product_sub_sub_cat",array("pssc_name"=>trim($pssc_name)));
	//return $pssc_name;
}

function get_sub_cat_id($pssc_name){
	return seeMoreDtls('pssc_psc_id',"product_sub_sub_cat",array("pssc_name"=>trim($pssc_name)));
}

function get_cat_id($pssc_name){
	$psc_id=get_sub_cat_id($pssc_name);
	return seeMoreDtls('psc_pc_id',"product_sub_category",array("psc_id"=>trim($psc_id)));
}

function get_weight_unit_id($awu_unit){
	return seeMoreDtls('awu_id',"ambit_weight_unit",array("awu_unit"=>trim($awu_unit)));
}

function get_color_id($apc_name){
	return seeMoreDtls('apc_id',"ambit_product_color",array("apc_name"=>trim($apc_name)));
}

function get_size_unit_id($asu_name){
	return seeMoreDtls('asu_id',"ambit_size_unit",array("asu_name"=>trim($asu_name)));
}

function get_brand_id($ab_name){
	return seeMoreDtls('ab_id',"ambit_brand",array("ab_name"=>trim($ab_name)));
}

function get_vendor_id_by_email($email){
	return seeMoreDtls('vr_id',"vendor_registration",array("email"=>trim($email)));
}
?>