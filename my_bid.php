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
<div class="main-container container">
   <ul class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i></a></li>
      <li><a href="<?php  echo $_SERVER["REQUEST_URI"]; ?>">My Bid Product</a></li>
   </ul>
   <div class="row">
      <!--Middle Part Start-->
      <div id="content" class="col-md-12 col-sm-12">
         <!-- //Product Tabs -->
         <!-- <?php echo $lang_3; ?> -->
         <div class="products-list row grid">
            <?php
               $bid_apa_id=getDetails(doSelect("apa_id","ambit_product_bid",array("cus_id"=>$_SESSION["ac_id"],"auction_status"=>1,"bid_status"=>1),' GROUP BY apa_id'));
               foreach($bid_apa_id as $k9=>$v9){
               if(isset($_COOKIE['vr_id'])){
               $vr_id=trim($_COOKIE['vr_id']);
               }else{
               $vr_id=0;
               }
               $con1=array();
               if($vr_id !=0){
               $con1=array("apa_vr_id"=>$vr_id);	
               }
               
                 date_default_timezone_set("America/Chicago");
			  $curdatetime = date("Y-m-d H:i:s");
			  
               $condition=array("status"=>1,"posting_type"=>1,"apa_id"=>trim($v9["apa_id"]));
               $condition=array_merge($condition,$con1);						
               $select="apa_id,apa_vr_id,name,category,sub_cat,sub_sub_cat,features,description,weight,color,brand,size,currency,price,selling_price,status,stock,posting_type,listing_duration,posting_date";
               $query=doSelect2($select,"ambit_product_add",$condition);
               //$query.=" AND listing_duration >='".date('Y-m-d')."' ORDER BY apa_id DESC";
              //  $query .= " AND listing_duration >=DATE('".$curdatetime."') AND TIME(posting_date)  >= TIME('".$curdatetime."') ORDER BY apa_id DESC";
              $query .= " AND CONCAT(listing_duration, ' ',TIME(posting_date)) >='".$curdatetime."' ORDER BY apa_id DESC";
                    
               
               $result=getDetails(doSelect3($query));
               
               foreach($result as $k=>$v){					
               					?>
            <div class="product-layout col-md-3 col-sm-6 col-xs-12 ">
               <div class="product-item-container">
                  <div class="left-block">
                     <div class="product-image-container  second_img ">
                        <?php
                           $select1="api_id,image,status";
                           //$image=getDetails(doSelect1($select1,"ambit_product_image",array("api_apa_id"=>$v["apa_id"],"status"=>1),' LIMIT 0,1'));
                           $image=getDetails(doSelect1($select1,"ambit_product_image",array("api_apa_id"=>$v["apa_id"]),' LIMIT 0,1'));
                           foreach($image as $k1=>$v1){
                           	$cart_image=$v1["image"];
                           ?>	
                        <img src="vendor/product_photo/<?php echo $v1["image"]; ?>"  alt="Apple Cinema 30&quot;" class="img-responsive" />
                        <?php
                           }
                           //$image=getDetails(doSelect1($select1,"ambit_product_image",array("api_apa_id"=>$v["apa_id"],"status"=>1),' LIMIT 1,1'));
                           $image=getDetails(doSelect1($select1,"ambit_product_image",array("api_apa_id"=>$v["apa_id"]),' LIMIT 1,1'));
                           if(!empty($image)){
                           foreach($image as $k1=>$v1){
                           ?>
                        <img src="vendor/product_photo/<?php echo $v1["image"]; ?>"  alt="Apple Cinema 30&quot;" class="img_0 img-responsive" />
                        <?php
                           }
                           }
                           ?>
                     </div>
                     <!--Sale Label-->
                     <?php
                        if($v["selling_price"] > 0){
                        ?>
                     <span class="label label-sale">Sale</span>
                     <?php
                        }
                        if($v["posting_type"]==1){
                        ?>
                     <span class="label label-new">Auction</span>
                     <?php
                        }
                        ?>
                     <!--countdown box-->
                     <div class="countdown_box">
                        <div class="countdown_inner">
                           <div class="title">This offer ends</div>
                           <div class="defaultCountdown-<?php echo $v["apa_id"]; ?>"></div>
                        </div>
                     </div>
                     <!--end countdown box-->
                     <script>
                        $(function() {
                        	//var austDay = new Date(<?php echo countdown_date($v["listing_duration"]); ?>);
                        	
                    		var listing_duration = '<?php echo $v['listing_duration']; ?>';
                        	var posting_date	 = '<?php echo $v['posting_date']; ?>';
                        	
                        	var tmp1 = listing_duration.split('-');
                        	var tmp2 = posting_date.split(' ');
                        								
							var countDate_str = tmp1[0] + '-' + tmp1[1] + '-' + tmp1[2] + ' ' + tmp2[1];
							var austDay = new Date(countDate_str);
                        	if(listing_duration == tmp2[0]){
                        		 austDay.setDate( austDay.getDate() + 1 );
							}
                        	
                        	$('.defaultCountdown-<?php echo $v["apa_id"]; ?>').countdown(austDay, function(event) {
                        		var $this = $(this).html(event.strftime(''
                        		   + '<div class="time-item time-day"><div class="num-time">%D</div><div class="name-time">Day </div></div>'
                        		   + '<div class="time-item time-hour"><div class="num-time">%H</div><div class="name-time">Hour </div></div>'
                        		   + '<div class="time-item time-min"><div class="num-time">%M</div><div class="name-time">Min </div></div>'
                        		   + '<div class="time-item time-sec"><div class="num-time">%S</div><div class="name-time">Sec </div></div>'));
                        	});
                        
                        });
                     </script>
                     <!--full quick view block-->
                     <a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"  href="quickview.php?id=<?php echo $v["apa_id"]; ?>">  <?php echo $lang_263; ?></a>
                     <!--end full quick view block-->
                  </div>
                  <div class="right-block">
                     <div class="caption">
                        <h4><a href="product.php?id=<?php echo $v["apa_id"]; ?>"><?php echo $v["name"]; ?></a></h4>
                        <div class="ratings">
                           <div class="rating-box">
                              <?php
                                 getRatingStar($v["apa_id"]);
                                 ?>
                           </div>
                        </div>
                        <?php
                           if($v["selling_price"] > 0){
                           ?>					
                        <div class="price">
                           <?php
                              $price_part=explode("||",$v["price"]);
                              if(trim($price_part[0])!=""){
                              ?>
                           <!-- <span class="price-new"><?php echo currency1($v["currency"],$price_part[0]);  ?></span>  -->
                           <span class="price-new"><?php echo currency1($v["currency"],$price_part[0] - $price_part[2]);  ?></span> 
                           <?php
                              }
                              if(trim($price_part[2])!="" && trim($price_part[2])!='0'){
                              ?>
                           <!-- <span class="price-old"><?php echo currency1($v["currency"],$old=$price_part[2]+$price_part[0]);  ?></span> -->
                           <span class="price-old"><?php echo currency1($v["currency"],$old=$price_part[0]);  ?></span>
                           <?php
                              }
                              ?>
                        </div>
                        <?php
                           }
                           ?>
                        <?php 
                           if(higest_bid_amount($v["apa_id"]) != 0){
                           ?>
                        <span class="label label-percent">Last Bid : <?php echo higest_bid($v["apa_id"]); ?></span>  
                        <?php } ?>
                     </div>
                     <?php
                        $stock=trim($v["stock"]);
                        ?>
                     <?php
                        if($v["selling_price"] > 0){
                        ?>
                     <div class="button-group">
                        <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" <?php if($stock > 0){ ?> onclick="cart.add('<?php echo $v["apa_id"]; ?>','<?php echo $cart_image; ?>','<?php $v["name"] = str_replace("'", "@#@#@#@#", $v["name"]); echo $v["name"];?>','1','<?php echo $_SERVER["REQUEST_URI"]; ?>');" <?php }else{ ?> onclick="empty_alert();" <?php } ?>  ><i class="fa fa-shopping-cart"></i> <span class=""><?php echo $lang_264; ?></span></button>
                        <?php
                           if(!isset($_SESSION["ac_id"])){
                           ?>
                        <button class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('<?php echo $v["apa_id"]; ?>','<?php echo $cart_image; ?>','<?php echo $v["name"];?>','1','<?php echo $_SERVER["REQUEST_URI"]; ?>');"><i class="fa fa-heart"></i></button>
                        <?php
                           }else{
                           ?>
                        <button class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist3.add('<?php echo $v["apa_id"]; ?>','<?php echo $cart_image; ?>','<?php echo $v["name"];?>','1','<?php echo $_SERVER["REQUEST_URI"]; ?>');"><i class="fa fa-heart"></i></button>
                        <?php
                           }
                           ?>
                        <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('<?php echo $v["apa_id"]; ?>','<?php echo $cart_image; ?>','<?php echo $v["name"];?>','1','<?php echo $_SERVER["REQUEST_URI"]; ?>');"><i class="fa fa-exchange"></i></button>
                     </div>
                     <?php
                        }
                        ?>
                     <div class="button-group">
                        <button onclick="product_details('<?php echo $v["apa_id"]; ?>');" style="background-color: #3498db;width:100%;" class="addToCart" type="button" data-toggle="tooltip"  ><i class="fa fa-gavel fa-2x"></i> <span class="">Bid Now</span></button>
                     </div>
                  </div>
                  <!-- right block -->
               </div>
            </div>
            <div class="clearfix visible-xs-block"></div>
            <?php
               }
               }
               if(empty($bid_apa_id)){
               
               echo '<div class="product-layout col-md-12 col-sm-6 col-xs-12 "><h2>No data found !</h2></div>';	
               }
               ?>
         </div>
         <!-- end Related  Products-->
      </div>
   </div>
   <!--Middle Part End-->
</div>
<!-- //Main Container -->
<!-- Footer Container -->
<?php
   include("include/footer.php");
   ?>
<script>
   function product_details(id){
   	window.location='product.php?id='+id;
   }
</script>