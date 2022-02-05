<?php
session_start();
if(!isset($_SESSION["ac_id"])){
require_once("function.php");
include("include/header.php");

?>
<script type="text/javascript">
	function fetch_city(){
    var cn_id=$("#country").val();
    $.ajax({
      url:'fetch_state.php?cn_id='+cn_id,
      type:'post',
      dataType:'text',
      cache:false,
      contentType:false,
      processData:false,
      success:function(response){
      //alert(response);
       $("#city").html(response); 
      }
    });
  }

  function onShowPassword(){
	  	  	if('password' == $('#cpassword').attr('type')){
		         $('#cpassword').prop('type', 'text');
		         $('#password').prop('type', 'text');
		    }else{
		         $('#cpassword').prop('type', 'password');
		         $('#password').prop('type', 'password');
		    }
	  }


$(document).ready(function() {
	$("#ajax_des").on('submit',(function(e){  
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var fname=$("#fname").val();
var lname=$("#lname").val();
var email=$("#email").val();

// var address=$("#address").val();
// var landmark=$("#landmark").val();
// var country=$("#country").val();
// var city=$("#city").val();
// var phone=$("#phone").val();
// var post_code=$("#post_code").val();
var password=$("#password").val();
var cpassword=$("#cpassword").val();
if(fname.trim()==""){
	alert("First Name Required");
	$("#fname").focus();
	return false;
}
if(lname.trim()==""){
	alert("Last Name Required");
	$("#lname").focus();
	return false;
}
if(email.trim()==""){
	alert("Email Required");
	$("#email").focus();
	return false;
}
if(!regex.test(email)){
      alert("email invalid");
      $("#email").val("");
      $("#email").focus();
      return false;
    }
// if(address.trim()==""){
// 	alert("Address Required");
// 	$("#address").focus();
// 	return false;
// }
// if(landmark.trim()==""){
// 	alert("Landmark Required");
// 	$("#landmark").focus();
// 	return false;
// }
// if(country.trim()=="0"){
// 	alert("Country Required");
// 	$("#country").focus();
// 	return false;
// }
// if(city.trim()=="0"){
// 	alert("City Required");
// 	$("#city").focus();
// 	return false;
// }
// if(phone.trim()==""){
// 	alert("Phone Required");
// 	$("#phone").focus();
// 	return false;
// }

// if(isNaN(phone)){
// 	alert("Phone Invalid");
//     $("#phone").val("");
//     $("#phone").focus();
// 	return false;
// }



// if(post_code.trim()==""){
// 	alert("Post Code Required");
// 	$("#post_code").focus();
// 	return false;
// }

if(password.trim()==""){
	alert("Password Required");
	$("#password").focus();
	return false;
}

if(cpassword.trim()==""){
	alert("Confirm Password Required");
	$("#cpassword").focus();
	return false;
}

if(password != cpassword){
	alert("Password Mismatch");
	$("#cpassword").val("");
	$("#cpassword").focus();
	return false;
}
		
if(password.length < 8){
	alert("Password must be at least 8 characters.");
	$("#password").focus();
	return false;	
}
		
if (!$('#check_id').is(":checked"))
{
	alert("You Have to agree with terms & condition");
  return false;
}



	
	$.ajax({
        	url: "ajax_registration.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {

			//alert(data);
			if(data==1){
				alert("Registration Successfull");
				window.location="index.php";
			}
			if(data==0){
				alert("Registration Failed");
			}
			if(data == 2){
				alert("The email address has already been registered.\nPlease sign in.");
				window.location="login.php";
			}
			
		    },
		    error: function() 
	    	{
	    	}	        
	   });
	
	}));
		  
	  });
	  
	  
	
</script>
<!-- //Header Top -->

<!-- Header center -->
<?php
include("include/header_center.php");
?>
<!-- //Header center -->

<!-- Header Bottom -->
<div class="header-bottom">
	<div class="container">
		<div class="row">
			
		<?php
			include("include/side_menu_close.php");
			?>
			
			<!-- Main menu -->
<?php
include("include/main_menu.php");
?>
			<!-- //end Main menu -->
			
		</div>
	</div>

</div>

<!-- Navbar switcher -->
<!-- //end Navbar switcher -->
	</header>
	<!-- //Header Container  -->
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
		
			<li><a href="register.php"><?php echo $lang_104; ?></a></li>
		</ul>
		
		<div class="row">
			<div id="content" class="col-sm-12">
				<h2 class="title"><?php echo $lang_105; ?></h2>
				<p><?php echo $lang_106; ?> <a href="login.php"><?php echo $lang_107; ?></a>.</p>
				<form action="javascript:void(0);" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix" id="ajax_des">
					<fieldset id="account">
						<legend><?php echo $lang_108; ?></legend>
						<div class="form-group required" style="display: none;">
							<label class="col-sm-2 control-label"><?php echo $lang_109; ?></label>
							<div class="col-sm-10">
								<div class="radio">
									<label>
										<input type="radio" id="customer_group_id" value="1" checked="checked"> <?php echo $lang_110; ?>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-firstname"><?php echo $lang_111; ?></label>
							<div class="col-sm-10">
								<input type="text" name="fname" id="fname" value="" placeholder="First Name" id="input-firstname" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-lastname"><?php echo $lang_112; ?></label>
							<div class="col-sm-10">
								<input type="text" name="lname" id="lname" value="" placeholder="Last Name" id="input-lastname" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-email"><?php echo $lang_113; ?></label>
							<div class="col-sm-10">
								<input type="email" name="email" id="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
							</div>
						</div>
					</fieldset>

				
					<fieldset>
						<legend><?php echo $lang_120; ?></legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-password"><?php echo $lang_76; ?></label>
							<div class="col-sm-10">
								<input type="password" name="password" id="password" value="" placeholder="Password" id="input-password" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-confirm"><?php echo $lang_121; ?></label>
							<div class="col-sm-10 input-group" style="padding-right: 15px; padding-left: 15px;">
								<input type="password" name="cpassword" id="cpassword" value="" placeholder="Password Confirm" id="input-confirm" class="form-control">
								<div class="input-group-btn">
						          <a class="btn btn-primary" onclick="onShowPassword()">
						            <span class="fa fa-eye"></span>
						          </a>
						        </div>
							</div>
														
						</div>
						  
					</fieldset>
					
					<div class="buttons">
						<div class="pull-right"><?php echo $lang_122; ?><a href="terms_condition.php" class="agree"><b><?php echo $lang_123; ?></b></a>
							<input class="box-checkbox" type="checkbox" id="check_id" name="terms_agree" value="1" checked> &nbsp;
							<input type="submit" value="Continue" class="btn btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
	

	<!-- Footer Container -->
	<?php
	include("include/footer.php");
}else{
	echo '<script>alert("You have allready login");window.location="index.php";</script>';
}
	?>