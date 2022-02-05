<?php
session_start();
require_once("function.php");
include("include/header.php");

?>
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
<script type="text/javascript"> 
	function send_mail(){
		//alert("siddhartha");
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var name=$("#name").val();
	var email=$("#email").val();

	var enquiry=$("#enquiry").val();
	if(name.trim()==""){
		alert("Name Required");
		$("#name").focus();
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
	if(enquiry.trim()==""){
		alert("Enquiry Required");
		$("#enquiry").focus();
		return false;
	}
	$.post(
		"send_mail.php",
		{name:name,email:email,enquiry:enquiry, name:name},
		function(r){
			if(r==1){
				$("#name").val("");
				$("#email").val("");
				$("#enquiry").val("");
				$("#msg").html('<font color="blue">Mail Send Successfully</font>');
			}
			if(r==0){
				$("#msg").html('<font color="red">Sending Failed</font>');
			}
		}
		);

	}

</script>
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
			<li><a href="contact.php"><?php echo $lang_57; ?></a></li>			
		</ul>
		
		<div class="row">
			<div id="content" class="col-sm-12">
				<div class="page-title">
					<h2><?php echo $lang_57; ?></h2>
				</div>
				
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.859523775563!2d-87.6788127!3d41.8958781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2df9f2ac972d%3A0xa3bf13668a205acf!2sOuslet!5e0!3m2!1sen!2sus!4v1609110426046!5m2!1sen!2sus" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
				<div class="info-contact clearfix">
					<div class="col-lg-4 col-sm-4 col-xs-12 info-store">
						<div class="row">
							<div class="name-store">
								<h3><?php echo $lang_58; ?></h3>
							</div>
							<address>
							<div class="address clearfix form-group">
									<div class="icon">
										<i class="fa fa-building-o"></i>
									</div>
									<div class="text"><?php  echo get_site_settings(26); ?></div>
								</div>
								<div class="address clearfix form-group">
									<div class="icon">
										<i class="fa fa-home"></i>
									</div>
									<div class="text"><?php  echo get_site_settings(28); ?></div>
								</div>
								<div class="phone form-group">
									<div class="icon">
										<i class="fa fa-phone"></i>
									</div>
									<div class="text"><?php echo $lang_59; ?> :<?php  echo get_site_settings(22); ?></div>
								</div>
								<div class="comment">             
								<?php  echo get_site_settings(27); ?>
								</div>
							</address>
						</div>
					</div>
					<div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
						<form action="javascript:void(0);" method="post" enctype="multipart/form-data" class="form-horizontal">
							<fieldset>
								<legend><?php echo $lang_60; ?></legend>
								<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-name"><?php echo $lang_61; ?></label>
							<div class="col-sm-10">
								<input type="text" name="name" value="" id="name" class="form-control">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email"><?php echo $lang_62; ?></label>
								<div class="col-sm-10">
									<input type="text" name="email" value="" id="email" class="form-control">
									</div>
								</div>
								<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-enquiry"><?php echo $lang_63; ?></label>
									<div class="col-sm-10">
										<textarea name="enquiry" rows="10" id="enquiry" class="form-control"></textarea>
									</div>
								</div>
							</fieldset>
							<div class="buttons">

				<div class="pull-right"><span id="msg"></span> &nbsp &nbsp
									<button class="btn btn-default buttonGray" type="submit" onclick="send_mail();">
										<span><?php echo $lang_64; ?></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
	

	<!-- Footer Container -->
<?php
	include("include/footer.php");
?>