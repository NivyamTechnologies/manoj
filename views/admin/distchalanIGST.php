<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>ASSURDNESS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css"/>

</head>
<!-- END HEAD -->
<body>
<section>
<?php 

 function getfin($date)
							{
							if(date('m',strtotime($date)) > 3)
							{
                            $fin = date('y',strtotime($date)).'-'.date('y',strtotime($date))+1;
							}
                            else
							{
                            $fin = (date('y',strtotime($date))-1).'-'.date('y',strtotime($date));
							}
                            return $fin;							
							}

function numberTowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 
?>
<div style="    float: right;
    margin-right: 124px;
    margin-top: 27px;"><input type="button" onclick="printDiv('container')" value="print" /></div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<div class="container" id ="container">
<div class="bs-example table-responsive">
    <table class="table table-bordered">
    <h2 class="text-center">INVOICE</h2>
    
        <thead>
        <tr>
               <?php  
		$detail = $this->db->query("select applicant_no,role from mlm_members_login where member_id = '".$productlist[0]->createby."'")->result_array();
		if($detail[0]['role']=='puc')
		{
		$tbl = 'mlm_puc_detail'; 	
		}
		elseif($detail[0]['role']=='branch')
		{
		$tbl = 'mlm_branch_detail'; 	
		}
		
	
		?>
                <td colspan="3">
				<?php  if($detail[0]['role']=='admin')
				{  
			    ?>
				ADARSH NIROG DHAM PRIVATE LIMITED	<br/>
                5/84A,Ground Floor,Sec -5,Rajendra Nagar,Sahibabad	<br/>
                Distt - Ghaziabad (U.P.) 201105, Ph. 0120-6533224	<br/>
                Tin No. - 09988832790,  Date - 29-07-2015	<br/>
                PAN No. AANCA5480E	<br/>
                GSTIN No-  09AANCA5480E1ZH
                <?php }else{ 
				$bpdetail = $this->db->query("select * from $tbl where applicant_no = '".$detail[0]['applicant_no']."'")->result_array();
				?>
                <?php  echo $bpdetail[0]['bvmbranchname']; ?><br/>	
                <?php  echo $bpdetail[0]['address'] ?><br/>	
                <?php  echo $bpdetail[0]['mobno'] ?><br/>	
                <?php } ?>		
				</td>
				<td colspan="10">
				<table class="table">
				<tr>
                <td colspan="3">Serial No.-</th>
                <td colspan="4">BVM/<?php echo getfin($productlist[0]->datetime); ?>/<?php echo $productlist[0]->s_no;  ?></th>
				</tr>
				<tr>
                <td colspan="3">Date of issue.-</th>
                <td colspan="4"><?php echo date('d/m/Y',strtotime($productlist[0]->datetime));  ?></th>
				</tr>
			 
								<tr>
                <td colspan="3">Driver Name-</th>
                <td colspan="4"></th>
				</tr>
			    </table>
				</td>
            </tr>
             <tr>
                <td colspan="3">
				Transfer Details <br/>
                <?php  echo $branchdata[0]->applicant_name; ?>(<?php  echo strtoupper($branchdata[0]->role); ?>)<br/>	
                <?php  echo $branchdata[0]->location ?><br/>	
                Contcat:- <?php  echo $branchdata[0]->mobile_no ?><br/>
				</td>
                <td colspan="10"></td>
            </tr>
        
        
            <tr>
                <th>S.N</th>
                <th>Description of Goods</th>
                <th>HCN Code</th>
                <th width="10%">Batch No</th>
                <th>Mfg.</th>
                <th>Expiry</th>
                <th>Pkg.</th>
                <th>QTY</th>
                <th>Rate</th>
                <th>Amount</th>
				<th>Igst Rate</th>
				<th>Total tax</th>
				<th>Total Amt</th>
            </tr>
        </thead>
		<?php		
		$productdata = $this->base_model->run_query(
		"select mlm_dist_chalan_detail.* from mlm_dist_chalan_detail where chalan_id='".$productlist[0]->chalan_id."'");  
		?>
        <tbody>
		<?php  
		$i=1;
		$totalquan=0;
		$totalrate=0;
		$totaltotal=0;
		$totaltax = 0;
		$totalwithtax = 0;
		foreach($productdata as $pro){   ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $pro->product_name; ?></td>
                <td><?php echo $pro->hcn_no; ?></td>
                <td><?php echo $pro->batch_no; ?></td>
                <td><?php echo $pro->m_date; ?></td>
                <td><?php echo $pro->expire_date; ?></td>
                <td><?php echo $pro->size; ?></td>
                <td><?php echo $pro->quantity; ?></td>
                <td><?php echo $pro->rate; ?></td>
				<td><?php echo $pro->product_total; ?></td>
				<td><?php echo $pro->tax_rate; ?>%</td>
				<td><?php echo $pro->igst; ?></td>
				<td><?php echo $pro->total; ?></td>
            </tr>
		<?php 
		$totalquan = $totalquan+$pro->quantity;
		$totaltotal = $totaltotal+$pro->product_total;
		$totaltax = $totaltax+$pro->igst;
		$totalwithtax= $totalwithtax + $pro->total;
		$i++;} ?>
            
            
            <tr>
                <td colspan="6"></td>
                <td>Total</td>
                <td><?php echo $totalquan; ?></td>
                <td></td>
                <td><?php echo round($totaltotal); ?></td>
				<td></td>
                <td><?php echo $totaltax; ?></td>
                <td><?php echo round($totalwithtax); ?></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:left"></td>
                <td colspan="7">
				<?php		
		        $productdata = $this->base_model->run_query(
		        "select mlm_dist_chalan_detail.* from mlm_dist_chalan_detail where chalan_id='".$productlist[0]->chalan_id."'");  
		        ?>
				<table>
				<tr>
				<td></td>
				<td></td>
				<td></td>
				</tr>
				</table>
				</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:left">Amount in Words :-</td>
                <td colspan="10"><?php echo strtoupper(numberTowords(round($totalwithtax))); ?></td>
            </tr>
            
             <tr>
                <td colspan="5" style="text-align:left">Name : </td>
                <td colspan="4">Grand Total : </td>
                <td colspan="4"><?php echo round($totalwithtax); ?></td>
            </tr>
            
            <tr>
                <td colspan="3" style="text-align:left">Terms & Conditions :-</td>
                <td colspan="3"></td>
                <td colspan="7"></td>
            </tr>
          
            <tr>
           		<td>1</td>
                <td colspan="2" style="text-align:left">100% payment advance with booked order</td>
                <td colspan="3"></td>
                <td colspan="7">For Adarsh Nirog Dham Pvt. Ltd.</td>
            </tr>
            
            <tr>
           		<td>2</td>
                <td colspan="2" style="text-align:left">The risk of loss or destruction of, or damages to, the product shall be on Buyer from and delivery of 
                the product to Buyer or carrier, whichever first occurs.</td>
                <td colspan="3"></td>
                <td colspan="7"></td>
            </tr>
            
            <tr>
           		<td>3</td>
                <td colspan="2" style="text-align:left">This is a only challan related transfer goods.</td>
                <td colspan="3"></td>
                <td colspan="7"></td>
            </tr>
            
            <tr>
                <td colspan="3"></td>
                <td colspan="3"></td>
                <td colspan="7">Authorised Signature</td>
            </tr>
            
            
        </tbody>
    </table>
    </div>
</div>
</section>


</body>
</html>