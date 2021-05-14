
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Distributor Chalan CGST List
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>puc/pucchalanviewIGST">
								Distributor Chalan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Chalan
							</div>
							
						</div>
				
				
						<div class="portlet-body">
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
        <?php } ?>  
								
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>								
								<th>
							    Distributor Id
								</th>												
								<th>
								Distributor Name
								</th>
								<th>
							    Transport
								</th>
								<th>
							    Create Datetime
								</th>
                                <th>
							    View
								</th>
                              																
								
							</tr
							</tr>
							</thead>
							<tbody>
							<?php 
							if(count($alluser)>0) 
							{ 
					        $i=1;
					        foreach($alluser as $r)
					        {
						
				            ?>
							
							<tr>								
								<td><?php echo $i++;?></td>
								
								<td>
								<?php echo $r->branch_id;?>
								</td>
                               <td>
								<?php echo $r->branch_name	;?>
								</td>
                                <td>
								<?php echo $r->transport	;?>
								</td>
                                <td>
								<?php echo $r->datetime	;?>
								</td>								
								<td>
								<?php if($r->chalantype == 1) {?>
								<a href="<?php echo base_url();?>branch/distchalanIGST/<?php echo $r->chalan_id;?>" target="_blank">View Chalan</a>
								<?php }elseif($r->chalantype == 2){?>
								<a href="<?php echo base_url();?>branch/distchalanCGST/<?php echo $r->chalan_id;?>" target="_blank">View Chalan</a>
								<?php }
								elseif($r->chalantype == 5){?>
									<a href="<?php echo base_url();?>branch/ticktbillchalanCGST/<?php echo $r->chalan_id;?>" target="_blank">View Chalan</a>
									<?php }
										elseif($r->chalantype == 6){?>
											<a href="<?php echo base_url();?>branch/distchalanCGST/<?php echo $r->chalan_id;?>" target="_blank">View Chalan</a>
											<?php } 
									 ?>
							    </td>
								
								
						<?php
                        echo form_close();
						?>
						
								
								
							</tr>
							
							<?php } } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>
							
							
							
							</tbody>
							</table>
						</div>
				
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
		<div class="footer-inner">
			Copyright &copy; 
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/scripts/core/app.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/table-editable.js"></script>
<script>
jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();
});
</script>
</body>
<!-- END BODY -->
</html>