<style>
a{text-decoration:none}
h4{text-align:center;margin:30px 0;color:#444}
.main-timeline{position:relative}
.main-timeline:before{content:"";width:5px;height:100%;border-radius:20px;margin:0 auto;background:#242922;position:absolute;top:0;left:0;right:0}
.main-timeline .timeline{display:inline-block;margin-bottom:50px;position:relative}
.main-timeline .timeline:before{content:"";width:20px;height:20px;border-radius:50%;border:4px solid #fff;background:#ec496e;position:absolute;top:50%;left:50%;z-index:1;transform:translate(-50%,-50%)}
.main-timeline .timeline-icon{display:inline-block;width:130px;height:130px;border-radius:50%;border:3px solid #ec496e;padding:13px;text-align:center;position:absolute;top:50%;left:30%;transform:translateY(-50%)}
.main-timeline .timeline-icon i{display:block;border-radius:50%;background:#ec496e;font-size:64px;color:#fff;line-height:100px;z-index:1;position:relative}
.main-timeline .timeline-icon:after,.main-timeline .timeline-icon:before{content:"";width:100px;height:4px;background:#ec496e;position:absolute;top:50%;right:-100px;transform:translateY(-50%)}
.main-timeline .timeline-icon:after{width:70px;height:50px;background:#fff;top:89px;right:-30px}
.main-timeline .timeline-content{width:50%;padding:0 50px;margin:52px 0 0;float:right;position:relative}
.main-timeline .timeline-content:before{content:"";width:70%;height:100%;border:3px solid #ec496e;border-top:none;border-right:none;position:absolute;bottom:-13px;left:35px}
.main-timeline .timeline-content:after{content:"";width:37px;height:3px;background:#ec496e;position:absolute;top:13px;left:0}
.main-timeline .title{font-size:20px;font-weight:600;color:#ec496e;text-transform:uppercase;margin:0 0 5px}
.main-timeline .description{display:inline-block;font-size:16px;color:#404040;line-height:20px;letter-spacing:1px;margin:0}
.main-timeline .timeline:nth-child(even) .timeline-icon{left:auto;right:30%}
.main-timeline .timeline:nth-child(even) .timeline-icon:before{right:auto;left:-100px}
.main-timeline .timeline:nth-child(even) .timeline-icon:after{right:auto;left:-30px}
.main-timeline .timeline:nth-child(even) .timeline-content{float:left}
.main-timeline .timeline:nth-child(even) .timeline-content:before{left:auto;right:35px;transform:rotateY(180deg)}
.main-timeline .timeline:nth-child(even) .timeline-content:after{left:auto;right:0}
.main-timeline .timeline:nth-child(2n) .timeline-content:after,.main-timeline .timeline:nth-child(2n) .timeline-icon i,.main-timeline .timeline:nth-child(2n) .timeline-icon:before,.main-timeline .timeline:nth-child(2n):before{background:#f9850f}
.main-timeline .timeline:nth-child(2n) .timeline-icon{border-color:#f9850f}
.main-timeline .timeline:nth-child(2n) .title{color:#f9850f}
.main-timeline .timeline:nth-child(2n) .timeline-content:before{border-left-color:#f9850f;border-bottom-color:#f9850f}
.main-timeline .timeline:nth-child(3n) .timeline-content:after,.main-timeline .timeline:nth-child(3n) .timeline-icon i,.main-timeline .timeline:nth-child(3n) .timeline-icon:before,.main-timeline .timeline:nth-child(3n):before{background:#8fb800}
.main-timeline .timeline:nth-child(3n) .timeline-icon{border-color:#8fb800}
.main-timeline .timeline:nth-child(3n) .title{color:#8fb800}
.main-timeline .timeline:nth-child(3n) .timeline-content:before{border-left-color:#8fb800;border-bottom-color:#8fb800}
.main-timeline .timeline:nth-child(4n) .timeline-content:after,.main-timeline .timeline:nth-child(4n) .timeline-icon i,.main-timeline .timeline:nth-child(4n) .timeline-icon:before,.main-timeline .timeline:nth-child(4n):before{background:#2fcea5}
.main-timeline .timeline:nth-child(4n) .timeline-icon{border-color:#2fcea5}
.main-timeline .timeline:nth-child(4n) .title{color:#2fcea5}
.main-timeline .timeline:nth-child(4n) .timeline-content:before{border-left-color:#2fcea5;border-bottom-color:#2fcea5}
@media only screen and (max-width:1200px){.main-timeline .timeline-icon:before{width:50px;right:-50px}
.main-timeline .timeline:nth-child(even) .timeline-icon:before{right:auto;left:-50px}
.main-timeline .timeline-content{margin-top:75px}
}
@media only screen and (max-width:990px){.main-timeline .timeline{margin:0 0 10px}
.main-timeline .timeline-icon{left:25%}
.main-timeline .timeline:nth-child(even) .timeline-icon{right:25%}
.main-timeline .timeline-content{margin-top:115px}
}
@media only screen and (max-width:767px){.main-timeline{padding-top:50px}
.main-timeline:before{left:80px;right:0;margin:0}
.main-timeline .timeline{margin-bottom:70px}
.main-timeline .timeline:before{top:0;left:83px;right:0;margin:0}
.main-timeline .timeline-icon{width:60px;height:60px;line-height:40px;padding:5px;top:0;left:0}
.main-timeline .timeline:nth-child(even) .timeline-icon{left:0;right:auto}
.main-timeline .timeline-icon:before,.main-timeline .timeline:nth-child(even) .timeline-icon:before{width:25px;left:auto;right:-25px}
.main-timeline .timeline-icon:after,.main-timeline .timeline:nth-child(even) .timeline-icon:after{width:25px;height:30px;top:44px;left:auto;right:-5px}
.main-timeline .timeline-icon i{font-size:30px;line-height:45px}
.main-timeline .timeline-content,.main-timeline .timeline:nth-child(even) .timeline-content{width:100%;margin-top:-15px;padding-left:130px;padding-right:5px}
.main-timeline .timeline:nth-child(even) .timeline-content{float:right}
.main-timeline .timeline-content:before,.main-timeline .timeline:nth-child(even) .timeline-content:before{width:50%;left:120px}
.main-timeline .timeline:nth-child(even) .timeline-content:before{right:auto;transform:rotateY(0)}
.main-timeline .timeline-content:after,.main-timeline .timeline:nth-child(even) .timeline-content:after{left:85px}
}
@media only screen and (max-width:479px){.main-timeline .timeline-content,.main-timeline .timeline:nth-child(2n) .timeline-content{padding-left:110px}
.main-timeline .timeline-content:before,.main-timeline .timeline:nth-child(2n) .timeline-content:before{left:99px}
.main-timeline .timeline-content:after,.main-timeline .timeline:nth-child(2n) .timeline-content:after{left:65px}
}



/******************* Timeline Demo - 4 *****************/
.main-timeline4{overflow:hidden;position:relative}
.main-timeline4:before{content:"";width:5px;height:70%;background:#333;position:absolute;top:70px;left:50%;transform:translateX(-50%)}
.main-timeline4 .timeline-content:before,.main-timeline4 .timeline:before{top:50%;transform:translateY(-50%);content:""}
.main-timeline4 .timeline{width:50%;padding-left:100px;float:right;position:relative}
.main-timeline4 .timeline:before{width:20px;height:20px;border-radius:50%;background:#fff;border:5px solid #333;position:absolute;left:-10px}
.main-timeline4 .timeline-content{display:block;padding-left:150px;position:relative}
.main-timeline4 .timeline-content:before{width:90px;height:10px;border-top:7px dotted #333;position:absolute;left:-92px}
.main-timeline4 .year{display:inline-block;width:120px;height:120px;line-height:100px;border-radius:50%;border:10px solid #f54957;font-size:30px;color:#f54957;text-align:center;box-shadow:inset 0 0 10px rgba(0,0,0,.4);position:absolute;top:0;left:0}
.main-timeline4 .timeline_2 .year:before{content:"";border-left:20px solid #dbe600;border-top:10px solid transparent;border-bottom:10px solid transparent;position:absolute;bottom:-13px;right:0;transform:rotate(45deg)}
.main-timeline4 .inner-content{padding:20px 0}
.main-timeline4 .title{font-size:24px;font-weight:600;color:#f54957;text-transform:uppercase;margin:0 0 5px}
.main-timeline4 .description{font-size:14px;color:#6f6f6f;margin:0 0 5px}
.main-timeline4 .timeline:nth-child(2n){padding:0 100px 0 0}
.main-timeline4 .timeline:nth-child(2n) .timeline-content:before,.main-timeline4 .timeline:nth-child(2n) .year,.main-timeline4 .timeline:nth-child(2n):before{left:auto;right:-10px}
.main-timeline4 .timeline:nth-child(2n) .timeline-content{padding:0 150px 0 0}
.main-timeline4 .timeline:nth-child(2n) .timeline-content:before{right:-92px}
.main-timeline4 .timeline:nth-child(2n) .year{right:0}
.main-timeline4 .timeline:nth-child(2n) .year:before{right:auto;left:0;border-left:none;border-right:20px solid #f54957;transform:rotate(-45deg)}
.main-timeline4 .timeline:nth-child(2){margin-top:110px}
.main-timeline4 .timeline:nth-child(odd){margin:-110px 0 0}
.main-timeline4 .timeline:nth-child(even){margin-bottom:80px}
.main-timeline4 .timeline:first-child,.main-timeline4 .timeline:last-child:nth-child(even){margin:0}
.main-timeline4 .timeline_2 .year{border-color:#dbe600;color:#dbe600}
.main-timeline4 .timeline_2 .year:before{border-right-color:#dbe600}
.main-timeline4 .timeline_2 .title{color:#dbe600}
.main-timeline4 .timeline_3 .year{border-color:#7cba01;color:#7cba01}
.main-timeline4 .timeline_3 .year:before{border-left-color:#7cba01}
.main-timeline4 .timeline_3 .title{color:#7cba01}
.main-timeline4 .timeline:nth-child(4) .year:before{border-right-color:#f8781f}
.main-timeline4 .timeline:nth-child(4n) .title{color:#f8781f}
@media only screen and (max-width:1200px){.main-timeline4 .year{top:50%;transform:translateY(-50%)}
}
@media only screen and (max-width:990px){.main-timeline4 .timeline{padding-left:75px}
.main-timeline4 .timeline:nth-child(2n){padding:0 75px 0 0}
.main-timeline4 .timeline-content{padding-left:130px}
.main-timeline4 .timeline:nth-child(2n) .timeline-content{padding:0 130px 0 0}
.main-timeline4 .timeline-content:before{width:68px;left:-68px}
.main-timeline4 .timeline:nth-child(2n) .timeline-content:before{right:-68px}
}
@media only screen and (max-width:767px){.main-timeline4{overflow:visible}
.main-timeline4:before{height:100%;top:0;left:0;transform:translateX(0)}
.main-timeline4 .timeline:before,.main-timeline4 .timeline:nth-child(2n):before{top:60px;left:-9px;transform:translateX(0)}
.main-timeline4 .timeline,.main-timeline4 .timeline:nth-child(even),.main-timeline4 .timeline:nth-child(odd){width:100%;float:none;text-align:center;padding:0;margin:0 0 10px}
.main-timeline4 .timeline-content,.main-timeline4 .timeline:nth-child(2n) .timeline-content{padding:0}
.main-timeline4 .timeline-content:before,.main-timeline4 .timeline:nth-child(2n) .timeline-content:before{display:none}
.main-timeline4 .timeline:nth-child(2n) .year,.main-timeline4 .year{position:relative;transform:translateY(0)}
.main-timeline4 .timeline:nth-child(2n) .year:before,.main-timeline4 .year:before{border:none;border-right:20px solid #f54957;border-top:10px solid transparent;border-bottom:10px solid transparent;top:50%;left:-23px;bottom:auto;right:auto;transform:rotate(0)}
.main-timeline4 .timeline_2 .year:before{border-right-color:#dbe600}
.main-timeline4 .timeline_2 .year:before{border-right-color:#7cba01}
.main-timeline4 .timeline:nth-child(4n) .year:before{border-right-color:#f8781f}
.main-timeline4 .inner-content{padding:10px}

.main-timeline4 .timeline_3 .year {
    border-color: #f31e1e;
    color: #f31e1e;
}

.main-timeline4 .timeline_1 .year {
    border-color: #7cba01;
    color: #7cba01;
}
}
</style>
<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Dashboard 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>login/profile">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>login/profile">
								Timeline
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>login/profile">
								Name <i class="fa fa-angle-right"></i> <?php echo $userview[0]->applicant_name;?>
							</a>
						</li>
						<li class="pull-right">
							
								<!-- <i class="fa fa-calendar"></i>
								<span>
								</span>
								<i class="fa fa-angle-down"></i> -->
								Registration Date: <?php echo $userview[0]->date;?>
							
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
                <div class="col-md-12">
                    <div class="main-timeline4">
						<?php foreach($timeline as $rData){ 
							if($rData->chance==1){
								$color="green";
							}else if($rData->chance==2){
								$color="yellow";
							}else{
								$color="red";
							}
							?>
                        <div class="timeline timeline_<?php echo $rData->chance; ?>">
                            <a href="#" class="timeline-content">
                                <span class="year" style="border:10px solid <?php echo $color; ?>;color:<?php echo $color; ?>;"><?php echo date("M", mktime(0, 0, 0, $rData->current_month, 10)); ?></span>
                                <div class="inner-content">
                                     <h3 class="title" style="color:<?php echo $color; ?>;">Next Target : <?php echo $rData->target; ?></h3>
                                    <p class="description" style="color:<?php echo $color; ?>;">
                                        DP : <?php echo $rData->dp; ?>
                                        <br>
                                        <br>
                                        <br>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>

			<div class="clearfix">
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
<!-- END CONTAINER -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
