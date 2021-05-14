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
					<a href="index.html">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
					</a>
				</li>
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
						Basic Configuration
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="organization.html">
								<i class="fa fa-bullhorn"></i>
								Organization
							</a>
						</li>
						<li>
							<a href="ecommerce_orders.html">
								<i class="fa fa-shopping-cart"></i>
								Coaching
							</a>
						</li>
						<li>
							<a href="ecommerce_orders_view.html">
								<i class="fa fa-tags"></i>
								Coaching/Organization Session
							</a>
						</li>
						<li>
							<a href="ecommerce_products.html">
								<i class="fa fa-sitemap"></i>
								Coaching/Organization Global Config
							</a>
						</li>
						<li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Holiday Config
							</a>
						</li>
                        <li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Class
							</a>
						</li>
                        <li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Section
							</a>
						</li>
                        <li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Grade
							</a>
						</li>
                        <li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Subject/Skill/Formative
							</a>
						</li>
                        <li>
							<a href="ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Allocate Subject
							</a>
						</li>
					</ul>
				</li>
			
            	<li>
					<a href="javascript:;">
						<i class="fa fa-gift"></i>
						<span class="title">
							Coaching
						</span>
						<span class="arrow">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete E-Commerce Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_ecommerce" target="_blank">
								<span class="title">
									Manage
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Feature
								</span>
							</a>
						</li>
                        <li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Report
								</span>
							</a>
						</li>
					</ul>
				</li>
				
               	<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Management
						</span>
						<span class="arrow ">
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
										<i class="fa fa-user"></i> Add/Edit Teacher Type
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-external-link"></i> Add/Edit Teacher Designation
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-bell"></i>	Add/Edit Teacher
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>	Reset Teacher ID & Password
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>	Assign Reporting Hierarchy
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>	Assign Subjects by Faculty
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>	Assign Faculties by Subject
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>	Assign Teacher Workload
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Upload Teacher Image(s)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>View/Update Self Profile
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
										<i class="fa fa-user"></i> Update Teacher Information
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
										<i class="fa fa-user"></i>Teacher Details Record
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-external-link"></i>Teacher Reporting List
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-bell"></i>Teacher ID Card(s)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Teacher Birthday List
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Print Teacher Detail
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Teacher Anniversary List
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Teacher Workload Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Faculties Assigned Subject Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Institution Reporting Hierarchy
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Institution Head Count Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Teacher Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Designation / Category Wise Head Count
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Staff Type Wise Head Counts
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Age Wise Head Count
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Experience Wise Head Count
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Gender Wise Head Count
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-bell"></i>Salary Wise Head Count
									</a>
								</li>
							</ul>
						</li>
						
						
					</ul>
                   				</li>
                
                <li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Attendance
						</span>
						<span class="arrow ">
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
										<i class="fa fa-user"></i>Teacher-Wise Attendance Configuration
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
										<i class="fa fa-user"></i> Teacher OD Tour/Visit Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i> Teacher Manual Attendance Entry
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
										<i class="fa fa-user"></i>Teacher OD Tour/Visit Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Daily Attendance Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Monthly Attendance Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Late Attendance Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Attendance Config Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Date Range Attendance Record (List)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Date Range Attendance Record (Grid
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Attendance Percentage Record
									</a>
								</li>
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Leave Manager
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
										<i class="fa fa-user"></i>Teacher Leave Rule Configuration
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Teacher Leave Type
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Assign Teacher Leave Type
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Leave-Carry-Forward Configuration
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
										<i class="fa fa-user"></i> Apply Teacher Leave
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Approve/Reject Applied Teacher Leaves
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Update Teacher Short Leaves
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
										<i class="fa fa-user"></i>Types of Teacher Leaves
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Leave
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Yearly Leave Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Monthly Consolidated Leave Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Short Leave Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Attendance and Leave Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Leave Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Attendance Percentage Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Leaves for Approval
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Approved Leaves
									</a>
								</li>
                             </ul>
						</li>
						
						
					</ul>
                   				</li>

				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Payroll
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
										<i class="fa fa-user"></i>Payroll Config Master
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Salary Heads
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Income Tax Slab Editor
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
										<i class="fa fa-user"></i>Teacher Payroll Info Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Head Relation
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Salary Entry (Add/Increment)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Monthly Salaried Days
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Salary Calculation (Monthly)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Monthly Salary Dispatch
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Advance Payment Config
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
										<i class="fa fa-user"></i>Teacher Salary Details (Monthly)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Monthly Advance Payment Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Teacher Pay slip (Monthly)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Monthly Pay Slip
									</a>
								</li>
                               
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Release Manager
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
										<i class="fa fa-user"></i>Release Teacher
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
										<i class="fa fa-user"></i>Release Teacher Report
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student
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
										<i class="fa fa-user"></i>Add New Student
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit/Delete Student
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit Students Class/Section
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Update Old/New Student
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit Students Registration No./User Id and Password
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit Students Date of Admission
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit Students Date of Birth
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>	Edit Students Address
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Edit Students Roll Number
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Update Students Status (Manually)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Move Students to Next Session
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Move Students to Previous Session
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
										<i class="fa fa-user"></i>Demo
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
										<i class="fa fa-user"></i>Students Detailed Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Head Count Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Students Statistics
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Students Birthday Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Age Calculate
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Students Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Parents Anniversary Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Statistics Report Date Wise(BVPS)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Personal Deatil Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Communication Details Reoprt
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Students Country Wise Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Uploaded Document Record
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Attendance Manager
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
										<i class="fa fa-user"></i>Class Timing Configuration
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
										<i class="fa fa-user"></i>Take Past Attendance
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Take Today's Attendance
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Take Monthly Attendance
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Absent Student SMS
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
										<i class="fa fa-user"></i>Attendance Taken Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Today's Attendance Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Date Range Attendance Summary Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Absent Students Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Monthly Attendance Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Monthly Attendance Shortage Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Complete Attendance Details
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                                
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
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Certificates
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
										<i class="fa fa-user"></i>Add/Edit Event Certificates
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
										<i class="fa fa-user"></i>Upload Event Certificates
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Issue/Print Student Certificates
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
										<i class="fa fa-user"></i>Event Certificate Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>TC Cancel Report
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Class Note, Assignment & Homework
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
										<i class="fa fa-user"></i>Add/Edit Assignments
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Class Notes
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Assign Homework
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
										<i class="fa fa-user"></i>Demo
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
										<i class="fa fa-user"></i>View Assignment
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View Class Notes
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View Homework
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>                                                                                                                               		                                                                                                                                                                                 		
			</ul>
			<?php
			}else{?>
		<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="../temp/extra_search.html" method="POST">
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
				
				<?php
				foreach($userinfo as $uservalue)
				{
					$orgrole = $uservalue->org_role;
								
				?>
				
				<?php
				if($orgrole==1)
				{
				?>
				<li class="start ">
					<a href="<?php echo base_url()?>admin/dashboard">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
					</a>
				</li>
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
						Basic Configuration
						</span>						
					</a>
					
					<ul class="sub-menu">
						<li>
							<a href="<?php echo base_url();?>admin/organization">
								<i class="fa fa-bullhorn"></i>
								Organization
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_orders.html">
								<i class="fa fa-shopping-cart"></i>
								Coaching
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_orders_view.html">
								<i class="fa fa-tags"></i>
								Coaching/Organization Session
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_products.html">
								<i class="fa fa-sitemap"></i>
								Coaching/Organization Global Config
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Holiday Config
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Class
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Section
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Grade
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Subject/Skill/Formative
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Allocate Subject
							</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/globalpermission">
								<i class="fa fa-sitemap"></i>
								Global Menu Permission
							</a>
						</li>
					</ul>
					
				</li>
				<?php
				}?>			
			
           		<?php
				if($orgrole==3||$orgrole==2||$orgrole==1)
				{
				?>
           		<!--Coaching Management-->
            	<li>
					<a href="javascript:;">
						<i class="fa fa-gift"></i>
						<span class="title">
							Coaching Management
						</span>
						<span class="arrow">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete E-Commerce Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_ecommerce" target="_blank">
								<span class="title">
									Manage
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Feature
								</span>
							</a>
						</li>
                        <li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Report
								</span>
							</a>
						</li>
					</ul>
				</li>
				<?php
				}?>
				
				<?php
				if($orgrole==4||$orgrole==2||$orgrole==1)
				{
				?>
				<!--Teacher Management-->				
               	<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Management
						</span>
						<span class="arrow ">
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
								<?php
								foreach($menu_teacher_manage as $teacher_manage_val)
								{
									echo $view_teacher_manage = $teacher_manage_val->menu_name;
								}
								?>                                
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_report as $teacher_report_val)
								{
									echo $view_teacher_report = $teacher_report_val->menu_name;
								}
								?>
							</ul>
						</li>
						
						<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Attendance
						</span>
						<span class="arrow ">
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
							<?php
								foreach($menu_teacher_attendance_manage as $teacher_attendance_manage_val)
								{
									echo $view_teacher_attendance_manage = $teacher_attendance_manage_val->menu_name;
								}
								?>	
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_attendance_Feature as $teacher_attendance_Feature_val)
								{
									echo $view_teacher_attendance_Feature = $teacher_attendance_Feature_val->menu_name;
								}
								?>
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_attendance_Report as $teacher_attendance_Report_val)
								{
									echo $view_teacher_attendance_Report = $teacher_attendance_Report_val->menu_name;
								}
								?>                    
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Leave Manager
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
								<?php
								foreach($menu_teacher_leave_manage as $teacher_leave_manage_val)
								{
									echo $view_teacher_leave_manage = $teacher_leave_manage_val->menu_name;
								}
								?>  
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_leave_feature as $teacher_leave_feature_val)
								{
									echo $view_teacher_leave_feature = $teacher_leave_feature_val->menu_name;
								}
								?>
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">								
                                <?php
								foreach($menu_teacher_leave_report as $teacher_leave_report_val)
								{
									echo $view_teacher_leave_report = $teacher_leave_report_val->menu_name;
								}
								?>
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Payroll
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
								<?php
								foreach($menu_teacher_payroll_manage as $teacher_payroll_manage_val)
								{
									echo $view_teacher_payroll_manage = $teacher_payroll_manage_val->menu_name;
								}
								?>                                 
                           	</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_payroll_feature as $teacher_payroll_feature_val)
								{
									echo $view_teacher_payroll_feature = $teacher_payroll_feature_val->menu_name;
								}
								?> 
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								 <?php
								foreach($menu_teacher_payroll_report as $teacher_payroll_report_val)
								{
									echo $view_teacher_payroll_report = $teacher_payroll_report_val->menu_name;
								}
								?>                               
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Release Manager
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
								<?php
								foreach($menu_teacher_release_manage as $teacher_release_manage_val)
								{
									echo $view_teacher_release_manage = $teacher_release_manage_val->menu_name;
								}
								?>  
                            </ul>
						</li>
                                                
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_release_report as $teacher_release_report_val)
								{
									echo $view_teacher_release_report = $teacher_release_report_val->menu_name;
								}
								?>  
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                   				
                   		
						
					</ul>
                   				</li>
                <?php
				}?>
               
                <?php
				if($orgrole==5||$orgrole==2||$orgrole==1)
				{
				?>                               
                <!--Student Management-->                                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Management
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
								<?php
								foreach($menu_student_manage as $student_manage_val)
								{
									echo $view_student_manage = $student_manage_val->menu_name;
								}
								?> 
                            </ul>
						</li>
                                       
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_report as $student_report_val)
								{
									echo $view_student_report = $student_report_val->menu_name;
								}
								?> 
							</ul>
						</li>
                        
						<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Attendance Manager
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
								<?php
								foreach($menu_student_attendance_manage as $student_attendance_manage_val)
								{
									echo $view_student_attendance_manage = $student_attendance_manage_val->menu_name;
								}
								?>                                 
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_attendance_feature as $student_attendance_feature_val)
								{
									echo $view_student_attendance_feature = $student_attendance_feature_val->menu_name;
								}
								?> 
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_attendance_report as $student_attendance_report_val)
								{
									echo $view_student_attendance_report = $student_attendance_report_val->menu_name;
								}
								?> 
							</ul>
						</li>
						
					</ul>
                 	
                 	<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Certificates
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
								<?php
								foreach($menu_student_certificate_manage as $student_certificate_manage_val)
								{
									echo $view_student_certificate_manage = $student_certificate_manage_val->menu_name;
								}
								?> 
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_certificate_feature as $student_certificate_feature_val)
								{
									echo $view_student_certificate_feature = $student_certificate_feature_val->menu_name;
								}
								?> 
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_certificate_report as $student_certificate_report_val)
								{
									echo $view_student_certificate_report = $student_certificate_report_val->menu_name;
								}
								?>
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                  	
                   	</li>
                   	
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Class Note, Assignment & Homework
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
								<?php
								foreach($menu_student_class_manage as $student_class_manage_val)
								{
									echo $view_student_class_manage = $student_class_manage_val->menu_name;
								}
								?>
                            </ul>
						</li>
                       
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_student_class_report as $student_class_report_val)
								{
									echo $view_student_class_report = $student_class_report_val->menu_name;
								}
								?>
							</ul>
						</li>						

					</ul>
                 </li>	
						
					</ul>                  				
                  	
                   	</li>    
				<?php
				}?>
               
                <!--Fee Manager-->
                                
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
                               
                <!--Admission Manager-->
                                
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
                               
                <!--Notification Manager-->
                                
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
                               
                <!--TimeTable Manager-->
                                
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
                               
                <!--Examination Manager-->
                                
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
               <?php
				}?>
				
			</ul>
			<?php
				}?>