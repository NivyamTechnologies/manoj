<!DOCTYPE html>

 <html lang="en" class="no-js"> 

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title>Online CMS</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->        

	<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/font-awesome/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/uniform/css/uniform.default.css';?>" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link href="<?php echo base_url().'assets/plugins/gritter/css/jquery.gritter.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar/fullcalendar.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/jqvmap.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css';?>" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="<?php echo base_url().'assets/css/style-metronic.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/css/style.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/css/style-responsive.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/css/plugins.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/css/pages/tasks.css';?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url().'assets/css/themes/default.css';?>" rel="stylesheet" type="text/css" id="style_color"/>

<link href="<?php echo base_url().'assets/css/print.css';?>" rel="stylesheet" type="text/css" media="print"/>

<link href="<?php echo base_url().'assets/css/custom.css';?>" rel="stylesheet" type="text/css"/>

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'?>" />

</head>

<!-- END HEAD -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->

<?php require_once('adminheader.php'); ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<div class="page-sidebar-wrapper">

		<div class="page-sidebar navbar-collapse collapse">

			<!-- BEGIN SIDEBAR MENU -->
			<?php require_once('adminsidebar.php'); ?>
			<!-- END SIDEBAR MENU -->

		</div>

	</div>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">

		<div class="page-content">

		<style>

        .tree, .tree ul {

    margin:0;

    padding:0;

    list-style:none

}

.tree ul {

    margin-left:1em;

    position:relative

}

.tree ul ul {

    margin-left:.5em

}

.tree ul:before {

    content:"";

    display:block;

    width:0;

    position:absolute;

    top:0;

    bottom:0;

    left:0;

    border-left:1px solid

}

.tree li {

    margin:7px;

    padding:3px 1em;

    line-height:2em;

    color:#369;

    font-weight:700;

    position:relative

}

.tree ul li:before {

    content:"";

    display:block;

    width:10px;

    height:0;

    border-top:1px solid;

    margin-top:-1px;

    position:absolute;

    top:1em;

    left:0

}

.tree ul li:last-child:before {

    background:#fff;

    height:auto;

    top:1em;

    bottom:0

}

.indicator {

    margin-right:5px;

}

.tree li a {

    text-decoration: none;

    color:#369;

}

.tree li button, .tree li button:active, .tree li button:focus {

    text-decoration: none;

    color:#369;

    border:none;

    background:transparent;

    margin:0px 0px 0px 0px;

    padding:0px 0px 0px 0px;

    outline: 0;

}

[draggable] {
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
  /* Required to make elements draggable in old WebKit */
  -khtml-user-drag: element;
  -webkit-user-drag: element;
}

#columns {
  list-style-type: none;
}

.column {
  width: 222px;
  padding-bottom: 5px;
  padding-top: 5px;
  text-align: center;
  cursor: move;
  border:1px solid;
}
.column header {
  height: 20px;
  width: 150px;
  color: black;
  background-color: #ccc;
  padding: 5px;
  border-bottom: 1px solid #ddd;
  border-radius: 10px;
  border: 2px solid #666666;
}

.column.dragElem {
  opacity: 0.4;
}
.column.over {
  //border: 2px dashed #000;
  border-top: 2px solid blue;
}

        </style>

	

		<div class="container" style="margin-top:30px;">

   <?php
				foreach($userinfo as $uservalue)
				{
					$orgrole = $uservalue->org_role;
				}
				?>
				<?php
				if($orgrole==1)
				{
				?>
    <div class="row">

        <div class="col-md-4" id="list">
    <div id="response"> </div>

            <ul id="tree1">

            <?php  foreach($data1 as $key=>$value)

				 { 

				 ?>

                <li class="column" style="width: 364px;" id="arrayorder_<?php echo $value['id']; ?>"><a href="#"><?php echo $value['menu_name']; ?></a>

                    <ul>

                      <?php

                         if(count($value['child'])!=0)

						 { 

						 foreach($value['child'] as $key1=>$value1)

						 {

							 ?>

                        <li class="column" style="width: 304px;" id="arrayorder_<?php echo $value1['id']; ?>"><a href="#"><input  type="checkbox" id="<?php echo $value1['id'] ?>" <?php if($value1['menu_status']=='active'){?> checked <?php } ?> onClick="checks(<?php echo $value1['id'] ?>)"><?php echo $value1['menu_name']; ?></a>

                            <ul>

                             <?php

                            if(count($value1['subchild'])!=0)

						      { 

						      foreach($value1['subchild'] as $key2=>$value2)

							  {

							  ?>

                                <li class="column" id="arrayorder_<?php echo $value2['id']; ?>"><a href="#"><input type="checkbox"  id="<?php echo $value2['id']; ?>" <?php if($value2['menu_status']=='active'){?>checked<?php } ?> onClick="checks(<?php echo $value2['id'] ?>)"><?php echo $value2['menu_name']; ?></a>

                                    <ul>

                                    <?php

                                    if(count($value2['subsubchild'])!=0)

						             { 

						            foreach($value2['subsubchild'] as $key3=>$value3)

							         {

							         ?>

                                     <li class="column" id="arrayorder_<?php echo $value3['id']; ?>"><a href="#"><input  type="checkbox" id="<?php echo $value3['id'] ?>" <?php if($value3['menu_status']=='active'){?> checked <?php } ?> onClick="checks(<?php echo $value3['id'] ?>)"><?php echo $value3['menu_name']; ?></a></li>

                                     <?php 

									 } 

									 }

									 ?> 

                                    </ul>

                                </li>

                            <?php } }?>

                            </ul>

                        </li>

                         <?php } }?> 

                    </ul>

                </li>

               <?php } ?> 

            </ul>

        </div>	

	

    

				</div>

			    </div>
			<?php }?>    

				</div>

				<!-- END PORTLET-->

				</div>

			</div>

		</div>

	</div>

	<!-- END CONTENT -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

	



	

	<script src=<?php echo base_url().'assets/plugins/jquery-1.10.2.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery-migrate-1.2.1.min.js';?> type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src=<?php echo base_url().'assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery.blockui.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery.cokie.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/uniform/jquery.uniform.js';?> type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/jquery.vmap.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.resize.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.categories.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery.pulsate.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/moment.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/gritter/js/jquery.gritter.js';?> type="text/javascript"></script>

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->

<script src=<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/jquery.sparkline.min.js';?> type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src=<?php echo base_url().'assets/scripts/core/app.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/scripts/custom/index.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/scripts/custom/tasks.js';?> type="text/javascript"></script>    

 <script>

//////////////////////////////////////////////////////////////menu

    $.fn.extend({

    treed: function (o) {

      

      var openedClass = 'glyphicon-minus-sign';

      var closedClass = 'glyphicon-plus-sign';

      

      if (typeof o != 'undefined'){

        if (typeof o.openedClass != 'undefined'){

        openedClass = o.openedClass;

        }

        if (typeof o.closedClass != 'undefined'){

        closedClass = o.closedClass;

        }

      };

      

        //initialize each of the top levels

        var tree = $(this);

        tree.addClass("tree");

        tree.find('li').has("ul").each(function () {

            var branch = $(this); //li with children ul

            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");

            branch.addClass('branch');

            branch.on('click', function (e) {

			

                if (this == e.target) {

                    var icon = $(this).children('i:first');

                    icon.toggleClass(openedClass);

                    $(this).children().children().toggle();

                }

            })

            branch.children().children().toggle();

        });

        //fire event from the dynamically added icon

      tree.find('.branch .indicator').each(function(){

        $(this).on('click', function () {

		

            $(this).closest('li').click();

        });

      });

       

        tree.find('.branch>').each(function () {

            $(this).on('click', function (e) {

					

                $(this).closest('li').click();

				$(".checker").show();

				$(".checker").children('span').show();

                e.preventDefault();

            });

        });

		

	

        //fire event to open branch if the li contains a button instead of text

        tree.find('.branch>button').each(function () {

            $(this).on('click', function (e) {

                $(this).closest('li').click();

                e.preventDefault();

            });

        });

		



    }

});



//Initialization of treeviews



$('#tree1').treed();

//////////////////////////////////////////////////////////////active deactive menu

	function checks(str)
		{
		if($("#"+str).parent("span").attr("class")=='checked')
		{
		$("#"+str).uniform();
        var two = $("#"+str).attr("checked",false).uniform();
		$.post("<?php echo base_url(); ?>index.php/admin/getdata",{value:str},function(data)
        {
        $(".page-sidebar-menu").load(location.href + " .page-sidebar-menu");
        });
		}
		else
		{
	    $("#"+str).uniform();
        var two = $("#"+str).attr("checked",true).uniform();;
        //$.uniform.update(two);
		$.post("<?php echo base_url(); ?>index.php/admin/getdata",{devalue:str},function(data)
        {
        $(".page-sidebar-menu").load(location.href + " .page-sidebar-menu");
        });
		}
		}

//////////////////////////////////////////////////////////////active deactive menu

    </script>

        

	<script>

		jQuery(document).ready(function() {    

		   App.init(); // initlayout and core plugins

		   Index.init();

		   Index.initJQVMAP(); // init index page's custom scripts

		   Index.initCalendar(); // init index page's custom scripts

		   Index.initCharts(); // init index page's custom scripts		   

		   Index.initMiniCharts();

		   Index.initDashboardDaterange();

		   Index.initIntro();

		   Tasks.initDashboardWidget();

		});

		
		
	</script>
<!-- END JAVASCRIPTS -->

<script type="text/javascript">
$(document).ready(function(){ 	
//hide message after 3 seconds
function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });    
}, 3000);}
	
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&update=update'; 
			$.post("<?php echo base_url(); ?>admin/update_seq_menu", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>
</body>

<!-- END BODY -->

</html>