    <!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                        <!-- /input-group -->
            </li>
            
            <li class="user-pro">
                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>

                    <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                    </a>
                      
                </li>



            <li> <a href="<?php echo base_url();?>hrm/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>
			
			

                        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-users p-r-10"></i> 
			<span class="hide-menu"><?php echo get_phrase('human_resources');?><span class="fa arrow"></span></span></a>
                <ul class=" nav nav-second-level<?php
                    if ($page_name == 'department' ||
                            $page_name == 'vacancy'|| $page_name == 'award'||
                            $page_name == 'application'||
                            $page_name == 'leave'||
                            $page_name == 'create_payslip'||
							$page_name == 'librarian'||
							$page_name == 'teacher'||
                            $page_name == 'payroll_list')
                        echo 'opened active';
                    ?>">
    
                        <li class="<?php if ($page_name == 'department') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>department/department">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('department'); ?></span>
                            </a>
                        </li>
    
                        
            <li> <a href="#" class="waves-effect"<i data-icon="&#xe006;"></i> <span class="hide-menu"><i class="fa fa-angle-double-right p-r-10"></i><?php echo get_phrase('recruitment');?><span class="fa arrow"></span></span></a>
                    <ul class=" nav nav-second-level">
                
                        <li class="<?php if ($page_name == 'vacancy') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>hrm/vacancy">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('vacancies'); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?php if ($page_name == 'application') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>hrm/application">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('applications'); ?></span>
                            </a>
                        </li>
                    
                    </ul>
                </li>
				
				<li> <a href="#" class="waves-effect"<i data-icon="&#xe006;"></i> <span class="hide-menu"><i class="fa fa-angle-double-right p-r-10"></i>
				<?php echo get_phrase('Manage Employee');?><span class="fa arrow"></span></span></a>
                    <ul class=" nav nav-second-level<?php if ($page_name == 'teacher')echo 'opened active';?>">
                
                        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>hrm/teacher">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('Teaching Staff'); ?></span>
                            </a>
                        </li>
						
				
				<li> <a href="#" class="waves-effect"<i data-icon="&#xe006;"></i> <span class="hide-menu"><i class="fa fa-angle-double-right p-r-10"></i>
					<?php echo get_phrase('Non Teaching Staff');?><span class="fa arrow"></span></span></a>
                    <ul class=" nav nav-second-level<?php
                    		if ($page_name == 'librarian' ||
                            $page_name == 'accountant'|| 
							$page_name == 'hostel'||
                            $page_name == 'hrm'||
                            $page_name == 'leave')echo 'opened active';?>">
                
                         <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>hrm/librarian">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('new_librarians'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>hrm/accountant">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('new_accountants'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>hrm/hostel">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('hostel_manager'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'hrm') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>hrm/hrm">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('human_resources'); ?></span>
                        </a>
                    </li>
						
						
						
                    </ul>
                </li>
				
						
						
                    </ul>
                </li>      
				

          
			
                        <li class="<?php if ($page_name == 'myleave') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>hrm/myleave/">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('Leave Application'); ?></span>
                            </a>
                        </li>

                    

                        <li class="<?php if ($page_name == 'myaward') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>hrm/myaward">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('List Award'); ?></span>
                            </a>
                        </li>
			
			

                    
                

                
                                
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>hrm/manage_profile">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>
                    </a>
            </li>

            <li class="">
                <a href="<?php echo base_url(); ?>login/logout">
                    <i class="fa fa-sign-out p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Logout'); ?></span>
                </a>
            </li>
                  
                  
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->