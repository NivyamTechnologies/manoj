<div class="page-content-wrapper">
	<div class="page-content">
		<div style="font-size:32px;">
		Change Password
		</div>
		<div class="table-toolbar">
			<div class="container">
						<?php if ($this->session->flashdata('msg')) { ?>
					<div class="alert alert-success" style="width:940px;"> <?= $this->session->flashdata('msg') ?>
					
					</div>
				<?php } ?> 

				<div class="row">

					 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px;">
					  
						<div class="panel panel-info">
						<form method="post" action="">
							<table class="table table-user-information">
								<tbody>
									<tr>
										<td>Applicant No:</td>
										<td>
											<input type="text" class="form-control" id="applicant_no" name="applicant_no" value="<?php echo $this->session->userdata("applicant_no"); ?>" readonly>
										</td>
									</tr>
									<tr>
										<td>Old Password:</td>
										<td>
										 <input type="text" class="form-control" name="old_password" >
										</td>
									</tr>
									<tr>
										<td>New Password:</td>
										<td>
										 <input type="text" class="form-control" name="new_password" >
										</td>
									</tr>
									<tr>
										<td><input type="submit" class="btn btn-primary" value="Update Password" name="update"/></td>
									</tr>
								</tbody>	
							</table>
						</form>
						</div>
					</div>						
				</div>
			</div>
		</div>
	</div>
</div>
