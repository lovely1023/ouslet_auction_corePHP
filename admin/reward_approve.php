

<?php
   session_start();
   require_once("function.php");
   if(isset($_SESSION["id"]) && $_SESSION["username"]){
   $admin_details=getDetails(doSelect("*","admin",array("id"=>$_SESSION["id"])));
   
   $_SESSION["main_menu"] = "approval";
   $_SESSION["sub_menu"]  = "reward_approve";
   
   include("include/header.php");
   ?>
<script type="text/javascript">
   function add_bestStory(apr_id, apr_apa_id, funney_story){
   	var best_id = $("#best_id_" + apr_apa_id).val();
   	if(best_id == 0){
		alert("Please Select Best Story");
			$("#best_id_" + apr_apa_id).focus();
			return false;
		
	}
   	
   	$.post("ajax_approve_best_story.php",{apr_id:apr_id, apa_id:apr_apa_id, best_id: best_id},function(r){
   		if(r==1){
	   		window.location="reward_approve.php";	
	   }else{
	   		alert("Something went wrong !");
	   	}
	   });
   }
   
   function changeStatus(id){
   	$.post("admin_approved_review.php",{apr_id:id},function(r){
   		if(r==1){
	   		window.location="review_approve.php";	
	   }else{
	   		alert("Something went wrong !");
	   	}
	   });
   }
  
   
     function show_review(id){
     	$.post("view_review.php",
		   	{apr_id:id},
		   	function(r){
		   		$("#full_ajax").html(r);
		   	}
   		);
     }
</script>
<section id="content_wrapper">
   <div id="topbar-dropmenu-wrapper">
      <div class="topbar-menu row">
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-danger">
            <span class="fa fa-music"></span>
            <span class="service-title">Audio</span>
            </a>
         </div>
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-success">
            <span class="fa fa-picture-o"></span>
            <span class="service-title">ImStates</span>
            </a>
         </div>
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-primary">
            <span class="fa fa-video-camera"></span>
            <span class="service-title">Videos</span>
            </a>
         </div>
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-alert">
            <span class="fa fa-envelope"></span>
            <span class="service-title">MessStates</span>
            </a>
         </div>
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-system">
            <span class="fa fa-cog"></span>
            <span class="service-title">Settings</span>
            </a>
         </div>
         <div class="col-xs-4 col-sm-2">
            <a href="#" class="service-box bg-dark">
            <span class="fa fa-user"></span>
            <span class="service-title">Users</span>
            </a>
         </div>
      </div>
   </div>
   <header id="topbar" class="alt">
      <div class="topbar-left">
         <ol class="breadcrumb">
            <li class="breadcrumb-icon">
               <a href="dashboard1.html">
               <span class="fa fa-home"></span>
               </a>
            </li>
            <li class="breadcrumb-active">
               <a href="dashboard1.html">Dashboard</a>
            </li>
            <li class="breadcrumb-link">
               <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-current-item">Data Tables</li>
         </ol>
      </div>
      <div class="topbar-right">
         <div class="ib topbar-dropdown">
            <label for="topbar-multiple" class="control-label">Reporting Period</label>
            <select id="topbar-multiple" class="hidden">
               <optgroup label="Filter By:">
                  <option value="1-1">Last 30 Days</option>
                  <option value="1-2" selected="selected">Last 60 Days</option>
                  <option value="1-3">Last Year</option>
               </optgroup>
            </select>
         </div>
         <div class="ml15 ib va-m" id="sidebar_right_toggle">
            <div class="navbar-btn btn-group btn-group-number mv0">
               <button class="btn btn-sm btn-default btn-bordered prn pln">
               <i class="fa fa-bar-chart fs22 text-default"></i>
               </button>
               <button class="btn btn-primary btn-sm btn-bordered hidden-xs"> 3</button>
            </div>
         </div>
      </div>
   </header>
   <div id="full_ajax">
      <section id="content" class="table-layout animated fadeIn">
         <div class="chute chute-center">
            <div class="row">
               <!--  -->
               <div class="col-md-12">
                  <div class="panel panel-visible" id="spy6">
                     <div class="panel-heading">
                        <div class="panel-title hidden-xs">
                           Reward 
                           <?php
                              //$review=getDetails(doSelect1("apr_id,apr_apa_id,apr_name,comment,rating,date,status","ambit_product_review",array()));
                              $review=getDetails(doSelect3("SELECT apr_id,apr_apa_id,apr_name,comment,rating,date,status,  ROUND(AVG(rating), 1) as avg FROM ambit_product_review GROUP BY apr_apa_id"));
                              
                              ?>
                        </div>
                     </div>
                     <div class="panel-body pn">
                        <div class="table-responsive">
                           <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th class="va-m">Product Name</th>
                                    <th class="va-m">Seller</th>
                                    <th class="va-m">Rating</th>
                                    <th class="va-m">Number Of Comment</th>
                                    <th class="va-m">Number Of Evaluators</th>
                                    <th class="va-m">Date</th>
                                    <th class="va-m">Approve</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    foreach($review as $k=>$v){
                                    
                                    ?>
                                 <tr>
                                    <td class="text-center"><?php echo getProductName($v["apr_apa_id"]);  ?></td>
                                    <td class="text-center">
                                    	<?php
                                    	 $sql = "SELECT a.company FROM vendor_registration AS a ";
										$sql .= " JOIN ambit_product_add AS b ";
										$sql .= " ON a.vr_id=b.apa_vr_id ";
										$sql .= " WHERE b.apa_id =".$v["apr_apa_id"];
										$result = getDetails(doSelect3($sql));
										echo $result[0]["company"];

                                    	 ?>                                    	 	
                                    </td>
                                    <td class="text-center"><?php  echo $v["avg"]; ?></td>
                                    <td class="text-center">
                                    	<?php  
                                    	$comment_cnt = getDetails(doSelect3("SELECT COUNT(comment) as count FROM ambit_product_review WHERE (comment != '' OR comment != NULL) AND apr_apa_id = ".$v['apr_apa_id']." GROUP BY apr_apa_id"));
                                    	echo $comment_cnt[0]['count']; 
                                    	?>
                                    		
                                    </td>
                                    <td class="text-center">
                                    	<?php  
                                    	$evaluator_cnt = getDetails(doSelect3("SELECT COUNT(apr_name) as count FROM ambit_product_review WHERE (apr_name != '' OR apr_name != NULL) AND apr_apa_id = ".$v['apr_apa_id']." GROUP BY apr_apa_id"));
                                    	echo $evaluator_cnt[0]['count']; 
                                    	?>
                                    		
                                   	</td>
                                    <td class="text-center"><?php  echo date("jS F, Y",strtotime($v["date"])); ?></td>
                                    <td class="text-center">
                                    	<?php 
                                    		$best_detail = getDetails(doSelect1("best_id", "best_story", array("apr_id" => $v["apr_id"])));
                                    		if(!empty($best_detail)){
												$best_id = $best_detail[0]["best_id"];
                                    		}else{
												$best_id = 0;
											}										
                                    		?>
                                    	<select class="" id="best_id_<?php echo $v["apr_apa_id"];?>">
					                        <option value="0"></option>
					                        <option value="1" <?php if($best_id == 1) echo "selected";?> >Best story #1</option>
					                        <option value="2" <?php if($best_id == 2) echo "selected";?> >Best story #2</option>
					                        <option value="3" <?php if($best_id == 3) echo "selected";?> >Best story #3</option>					                        
					                     </select>
                                    
                                    	<a href="javascript:void(0);" onclick="add_bestStory('<?php echo $v["apr_id"];  ?>', <?php echo $v["apr_apa_id"];  ?>);" title="Add Best Story"  style="vertical-align: middle;"><i class="fa fa-check" style="color:blue;"></i></a>                                    
                                        <!--<a href="javascript:void(0);" onclick="show_review('<?php echo $v["apr_id"];  ?>');" title="Show Review"  style="vertical-align: middle;"><i class="fa fa-eye" style="color:black;"></i></a>-->
                                    </td>
                                 </tr>
                                 <?php
                                    }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <!-- End Ajax Div -->
</section>
<aside id="sidebar_right" class="nano affix">
   <div class="sidebar-right-wrapper nano-content">
      <div class="sidebar-block br-n p15">
         <h6 class="title-divider text-muted mb20"> Visitors Stats
            <span class="pull-right"> 2015
            <i class="fa fa-caret-down ml5"></i>
            </span>
         </h6>
         <div class="progress mh5">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%">
               <span class="fs11">New visitors</span>
            </div>
         </div>
         <div class="progress mh5">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%">
               <span class="fs11 text-left">Returnig visitors</span>
            </div>
         </div>
         <div class="progress mh5">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
               <span class="fs11 text-left">Orders</span>
            </div>
         </div>
         <h6 class="title-divider text-muted mt30 mb10">New visitors</h6>
         <div class="row">
            <div class="col-xs-5">
               <h3 class="text-primary mn pl5">350</h3>
            </div>
            <div class="col-xs-7 text-right">
               <h3 class="text-warning mn">
                  <i class="fa fa-caret-down"></i> 15.7% 
               </h3>
            </div>
         </div>
         <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>
         <div class="row">
            <div class="col-xs-5">
               <h3 class="text-primary mn pl5">660</h3>
            </div>
            <div class="col-xs-7 text-right">
               <h3 class="text-success-dark mn">
                  <i class="fa fa-caret-up"></i> 20.2% 
               </h3>
            </div>
         </div>
         <h6 class="title-divider text-muted mt25 mb10">Orders</h6>
         <div class="row">
            <div class="col-xs-5">
               <h3 class="text-primary mn pl5">153</h3>
            </div>
            <div class="col-xs-7 text-right">
               <h3 class="text-success mn">
                  <i class="fa fa-caret-up"></i> 5.3% 
               </h3>
            </div>
         </div>
         <h6 class="title-divider text-muted mt40 mb20"> Site Statistics
            <span class="pull-right text-primary fw600">Today</span>
         </h6>
      </div>
   </div>
</aside>
</div>
<script src="assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>
<script src="assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="assets/js/plugins/highcharts/highcharts.js"></script>
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/demo/widgets_sidebar.js"></script>
<script src="assets/js/pages/tables-data.js"></script>
</body>
</html>
<?php
   //require_once("include/footer.php");
   }else{
   	echo '<script>window.location="utility-login.php";</script>';
   }
   ?>

