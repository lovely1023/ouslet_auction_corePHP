<section class="so-spotlight1 ">
		<div class="container">
			<div class="row">
				<div id="yt_header_right" class="col-lg-offset-3 col-lg-9 col-md-12">
					<div class="slider-container "> 
							
						<div class="module first-block">
							<div class="modcontent clearfix">
								<div id="custom_popular_search" class="clearfix">
									<h5 class="so-searchbox-popular-title pull-left"><?php echo $lang_234; ?>:</h5>
									<div class="so-searchbox-keyword">
										<ul class="list-inline" style="padding-left:10px;">
											<li><a href="auction_last_minute.php">Last minutes Auction</a></li>
											<li><a href="" data-toggle="modal" data-target="#best_story1">Best story #1</a></li>
											<li><a href="" data-toggle="modal" data-target="#best_story2">Best story #2</a></li>
											<li><a href="" data-toggle="modal" data-target="#best_story3">Best story #3</a></li>
										
										<?php
										//$result=getDetails(doSelect("ab_id,ab_name,top_search_status","ambit_brand",array("top_search_status"=>1),' LIMIT 10'));
										$result=getDetails(doSelect("ab_id,ab_name,top_search_status","ambit_brand",array("top_search_status"=>1),' LIMIT 5'));
										foreach($result as $k=>$v){
										?>
										<li>&nbsp;<a href="search.php?search=<?php echo $v["ab_name"];  ?>"><?php echo $v["ab_name"];  ?></a></li>
										<?php
										}
										?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!--<div id="so-slideshow" class="col-lg-8 col-md-8 col-sm-12 col-xs-12 two-block">-->
						<div id="so-slideshow" class="col-lg-8 col-md-12 col-sm-12 col-xs-12 two-block">
							<div class="module slideshow no-margin">
<?php
$slider=getDetails(doSelect("aas_id,aas_slider,aas_link","ambit_add_slider",array("status"=>1), ' order by aas_id'));
foreach($slider as $k=>$v){							
?>							
								<div class="item">
									<a href="<?php echo $v["aas_link"] ?>"><img src="image/demo/slider/<?php echo $v["aas_slider"] ?>" alt="slider1" class="img-responsive"></a>
								</div>
<?php
}
?>
								
							</div>
							<div class="loadeding"></div>
						</div>

						
						<!--<div class="module col-md-4  hidden-sm hidden-xs three-block ">-->
						<div class="module col-md-4 hidden-md  hidden-sm hidden-xs three-block ">
							<div class="modcontent clearfix">
								<div class="htmlcontent-block">	
									<ul class="htmlcontent-home">	
<?php
$slider=getDetails(doSelect("aab_id,aab_banner,aab_link","ambit_add_banner",array("status"=>1),' LIMIT 3'));
foreach($slider as $k=>$v){							
?>										
										<li>
											<div class="banners">
												<div>
													<a href="<?php echo $v["aab_link"] ?>"><img src="image/demo/cms/<?php echo $v["aab_banner"] ?>" alt="banner1"></a>
												</div>
											</div>
<?php
}
?>										</li>	
										
									</ul>
								</div>
							</div>
						</div>

						<div class="module hidden-xs col-sm-12 four-block">
							<div class="modcontent clearfix">
								<div class="policy-detail">
								<?php
								//echo seeMoreDetails("features","ambit_features",array("id"=>1));
								
								?>
									 <div class="banner-policy">
										<div class="policy policy1"><a href="for_buyers.php"> <span class="ico-policy">&nbsp;</span> 30 days <br> money back </a></div>
										<div class="policy policy2" style="padding: 0 20px;"><a href="for_sellers.php"> <span class="ico-policy">&nbsp;</span> List Your Items For Free</a></div>
										<div class="policy policy3"><a href="how_it_works.php"> <span class="ico-policy">&nbsp;</span> Contactless Payment</a></div>
										<div class="policy policy4"><a href="#"> <span class="ico-policy">&nbsp;</span> shopping guarantee </a></div>
									</div>  
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</section>
	
	
<!-- Modal Best Story #1 -->
<div class="modal fade" id="best_story1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 200px !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h2 class="modal-title" id="myModalLabel" style = "text-align:center; font-weight: bold; font-size:32px;  color:#bd0000;">Best Story #1</h2>
      </div>
      <div class="modal-body" style="min-height: 100px; font-family:serif; font-style: italic; font-weight: bold; font-size: 22px; color: green;">
       <?php
    	 $best_story1 = seeMoreDetails("comment", "best_story", array("best_id" => 1));
    	 if(!empty($best_story1))
    	 	echo $best_story1;
    	 else
    	 	echo "There is no registered story.";
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal Best Story #2 -->
<div class="modal fade" id="best_story2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 200px !important;">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h2 class="modal-title" id="myModalLabel" style = "text-align:center; font-weight: bold; font-size:32px;  color:#bd0000;">Best Story #2</h2>
      </div>
      <div class="modal-body" style="min-height: 100px; font-family:serif; font-style: italic; font-weight: bold; font-size: 22px; color: green;">
       <?php
    	 $best_story2 = seeMoreDetails("comment", "best_story", array("best_id" => 2));
    	 if(!empty($best_story2))
    	 	echo $best_story2;
    	 else
    	 	echo "There is no registered story.";
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal Best Story #3 -->
<div class="modal fade" id="best_story3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 200px !important;">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h2 class="modal-title" id="myModalLabel" style = "text-align:center; font-weight: bold; font-size:32px;  color:#bd0000;">Best Story #3</h2>
      </div>
      <div class="modal-body" style="min-height: 100px; font-family:serif; font-style: italic; font-weight: bold; font-size: 22px; color: green;">
       <?php
    	 $best_story3 = seeMoreDetails("comment", "best_story", array("best_id" => 3));
    	 if(!empty($best_story3))
    	 	echo $best_story3;
    	 else
    	 	echo "There is no registered story.";
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

