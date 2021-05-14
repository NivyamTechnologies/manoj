		<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<!--BEGIN RESPONSIVE QUICK SEARCH FORM -->
				<!--<li class="sidebar-search-wrapper">
					 
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
					 
				</li>-->
             
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
						<span class="arrow">
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
							<a href="<?php if($value1['menu_link']){echo base_url().$value1['menu_link'];} ?>"><span class="arrow">
								</span>
								<?php echo $value1['menu_icon']; ?> 
                                <?php echo $value1['menu_name']; ?>	
								<?php if(empty($value1['menu_link'])){?>
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
									<a href="<?php if($value2['menu_link']){echo base_url().$value2['menu_link']; } ?>">
										<?php echo $value2['menu_icon']; ?> 
                                        <?php echo $value2['menu_name']; ?>	
                                       <?php if($value2['menu_link']){?><!--<span class="arrow">
								</span>--><?php } ?>
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
                
                
                </ul>
		