		<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="extra_search.html" method="POST">
						<div class="form-container">
							<div class="input-box">
								<a href="javascript:;" class="remove">
								</a>
								<input type="text" placeholder="Search..."/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
             
				<li class="start ">
					<a href="<?php echo base_url()?>admin/dashboard">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
					</a>
				</li>
                <?php  
	
				foreach($data as $key=>$value)
				{
					?>
		        <li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
					    <?php echo $value['menu_name']; ?>		
						</span>
						<span class="arrow ">
						</span>
					</a>
                         <?php 
						 if($value['childcount']>0)
						 { 
						 ?>
                         <ul class="sub-menu">
                         <?php
						 foreach($value['child'] as $key1=>$value1){?>
                         <li>
							<a href="<?php if($value1['menu_link']){echo base_url().$value1['menu_link'];} ?>">
								<?php echo $value1['menu_icon']; ?> 
                                <?php echo $value1['menu_name']; ?>	
								<?php if(empty($value1['menu_link'])){?><span class="arrow">
								</span>
								<?php 
								} 
								?>
							</a>
                          <?php
                          if($value1['subchildcount']>0)
						      { 
							  ?>
                              <ul class="sub-menu">
                              <?php
						      foreach($value1['subchild'] as $key2=>$value2)
							  {
								  ?>
								<li>
									<a href="<?php if($value2['menu_link']){echo base_url().$value2['menu_link'];} ?>">
										<?php echo $value2['menu_icon']; ?> 
                                        <?php echo $value2['menu_name']; ?>	
                                       <?php if($value2['menu_link']){?><span class="arrow">
								</span><?php } ?>
									</a>
                                   
                                  
                              
                            <?php
                            if($value2['subsubchildcount']>0)
						      { 
							  ?>
                              <ul class="sub-menu">
                              <?php
						      foreach($value2['subsubchild'] as $key3=>$value3)
							  {
								  ?>
								<li>
								<a href="<?php if($value3['menu_link']){echo base_url().$value3['menu_link'];}?>">
								<?php echo $value3['menu_icon']; ?> 
                                <?php echo $value3['menu_name']; ?>	
								</a>
								</li>
                                <?php }
								?>
                                 </ul>
                                <?php
								} 
								?>
							   
								</li>
                                <?php 
								}
								?>
                                </ul>
                                <?php
								} 
								?>
							
                            </li>
                            <?php 
							}
							?>
                            </ul>
                            <?php
							} ?>			
                 </li>
                <?php } ?>
                
                <!--Feemanager Menu Start -->
                <li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Fee Manager V2(16-17)
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Fee Type
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Fee Rule
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Generic Fee Amount
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Specific Fee Amount
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Rebate Fee Amount
									</a>
								</li>
                                
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Entry (Multiple Students)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Update Cheque Status
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Challan
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Print/View/Cancel Fee Receipt
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Receipt Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>	Fee Collection/Outstanding Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Day Book
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Defaulter Student Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Cancellation Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Day Book
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Rebate Details
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Cheque Deposited Details
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                <!--Feemanager Menu End -->
                
                <!--Admission Menu Start -->
                <li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Admission Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Prospectus Configuration
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Related Student Document
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Admission Criteria
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Stages Configuration
									</a>
								</li>
                               
                                
                            </ul>
						</li>
                  
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>

							<ul class="sub-menu">
								<li>
									<a href="#">

										<i class="fa fa-user"></i>Admission Process
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Entry
									</a>
								</li>
                              
                               
                                
								
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Count Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Admission History
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Criteria Wise Student Admission Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Date Wise Summary Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Student Fee Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Receipt Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Collection Outstanding Record
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Collection Day Book
									</a>
								</li>
                                 
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
				<!--Admission Menu End -->                   				
               
               <!--Notification Menu Start -->
               <li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Notification Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>SMS Configurator
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Email Configurator
									</a>
								</li>
                               
                             </ul>
						</li>
                    
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>SMS Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Email Delivery Report
									</a>
								</li>
                            </ul>
						</li>
                        
						
						
					</ul>
                   				</li>
               <!--Notification Menu End --> 
               
               <!--TimeTable Manager Menu Start-->
               <li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Timetable Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Class Timing
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Class Timing Relation
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Timetable
									</a>
								</li>
                                
                                
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Timetable
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View Timetable by Subjects
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>	View Timetable by Faculty
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Complete Timetable
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View My Timetable
									</a>
								</li>
                                
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
				<!--TimeTable Manager Menu End-->                   				   				
               
              <!--Examination Manager Menu Start-->
               <li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Examination Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Template Configuration
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Syllabus
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Marksheet Heading
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Allocation
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Assign Optional Paper
									</a>
								</li>
                                
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Test
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Multiple Exam Test
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Online Exams Question Bank
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Online Exams Paper Config
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Multiple Exam Test Grade (SEABA)
									</a>
								</li>
                                
                                
                                
                            </ul>
						</li>
                   
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Examination Marks Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Physical Health
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Comments
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Mark Sheets 
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Scholastic Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Cross List
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Consolidated Report (CBSE)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Test Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Report of Marks Entry
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Assigned Optional Papers
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Result Summary
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
             <!--Examination Manager Menu End-->
                </ul>
		