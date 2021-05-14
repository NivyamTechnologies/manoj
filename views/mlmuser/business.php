<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>
<div class="page-content-wrapper">
<div class="page-content">
						<div class="table-toolbar">
						<div class="btn-group">
	                    <form name="serach" action="<?php echo base_url() ?>login/businessgroup" method="POST">
						<table>
						<tr>
                        <td style="padding-right: 25px;">
						<?php
						if($month)
						{
						$mon = $month;	
						}
						else
						{
						$mon = date('m');
						}
						if($year)
						{
						$yer = $year;	
						}
						else
						{
						$yer = date('Y');
						}
						?>
						<select  class="form-control" id="month" name="month">
						<?php for($i=1;$i<=12;$i++){  ?>
						<option value="<?php echo $i; ?>" <?php if($i==$mon) {?>selected<?php } ?>><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
						<?php } ?>
						</select>
						</td>  
						<td style="padding-right: 25px;">
						<select  class="form-control" id="year" name="year">
						<?php for($i1=2016;$i1<=date('Y');$i1++){  ?>
						<option value="<?php echo $i1; ?>" <?php if($i1==$yer) {?>selected<?php } ?>><?php echo $i1; ?></option>
						<?php } ?>
						</select>
						</td> 
						<td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"/></td>
						</tr>
						  
						  </table>
                          </form>
						 	
							</div>								
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>								
								<th>
							    Applicant No
								</th>
								<th>
							    Applicant Name
								</th>
								<th>
							    Sponser No
								</th>									
								<th>
							    Current Month
								</th>
								<th>
							    Total BV
								</th>
								
							</tr>
							</thead>
							<tbody>
							<tr>	
                                <td>
								<?php echo "1";?>
								</td>							
								<td>
								<?php echo $parentdata[0]['applicant_no'];  ?>
								</td>
                                
								<td>
								<?php echo $parentdata[0]['applicant_name'];  ?>
								</td>
                                <td>
								<?php echo $parentdata[0]['sponser_no'];  ?>
								</td>
                                <td>
								<?php 
								echo $this->base_model->currentbv($parentdata[0]['applicant_no'],$month,$year);  ?>
								</td>
                                <td>
								<?php echo $this->base_model->getuserarray($parentdata[0]['applicant_no'],array());  ?>
								</td>
                               								
							</tr>
							
							</tbody>
							</table>
							
							
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>								
								<th>
							   Applicant No
								</th>
								<th>
							     Applicant Name
								</th>
								<th>
							    Sponser No
								</th>									
								<th>
							    Current Month
								</th>
								<th>
							    Total BV
								</th>
								<!-- <th>
							    Downline
								</th> -->
							</tr>
							</thead>
							<tbody>
							<?php 
							$sn = 1;
							foreach($userdata as $val){ ?>
							<tr>	     
							    <td>
								<?php echo $sn++;?>
								</td>
								<td>
								<?php echo $val['applicant_no'];  ?>
								</td>

								<td>
								<?php echo $val['applicant_name'];  ?>
								</td>
                                <td>
								<?php echo $val['sponser_no'];  ?>
								</td>
								<td>
								<?php   
								echo $this->base_model->currentbv($val['applicant_no'],$month,$year);  ?>
								</td>
                                <td>
								<?php echo $this->base_model->getuserarray($val['applicant_no'],array());  ?>
								</td>	
                                <!-- <td><a href="<?php echo base_url() ?>login/businessgroup/<?php echo $val['applicant_no'];  ?>/<?php echo $mon; ?>/<?php echo $yer; ?>">Downline</a></td>								 -->
							</tr>
							<?php  } ?>
							</tbody>
							</table>
							
		</div>					
	
</div>
