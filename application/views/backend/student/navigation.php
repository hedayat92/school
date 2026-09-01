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

                    <a href="#" class=""><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                    </a>
                       
                </li>



    <li> <a href="<?php echo base_url();?>student/dashboard" class=""><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>

    

    <li> <a href="#" class=""><i data-icon="&#xe006;" class="fa fa-plus p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Academics');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'subject' ||
                    $page_name == 'teacher' ||
                    $page_name == 'class_mate' ||
                    $page_name == 'assignment' || $page_name == 'study_material' )
                echo 'opened active';
            ?>">


            
                <li class="<?php if ($page_name == 'subject') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/subject">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Subject'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/teacher">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Teacher'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'class_mate') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/class_mate">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Class Mate'); ?></span>
                    </a>
                </li>

                    
                <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>assignment/assignment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Assignment'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>studymaterial/study_material">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Study Material'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>student/class_routine">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('class_timetable'); ?></span>
                    </a>
                </li>
 
         </ul>
    </li>

		
			<?php if(get_settings('check_result') == 1) : ?>
				<li class="<?php if ($page_name == 'student_marksheet') echo 'active'; ?> ">
                   <a href="<?php echo base_url(); ?><?php echo $account_type; ?>/student_marksheet">
                        <i class="fa fa-print p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('print_report_card'); ?></span>
                    </a>
                </li>
			<?php endif;?>


			
				<?php 
					$selectZoomFromAddonTable = $this->db->get_where('addons',array('unique_key'=> 'zoom', 'addon_key' => 'live_streaming', 'status' => 'installed'))->row();
					if($selectZoomFromAddonTable != "") : 
				?>
				 <li class="<?php if ($page_name == 'live_class') echo 'active'; ?>">
					<a href="<?php echo base_url(); ?>student/live_class">
					<i class="fa fa-laptop p-r-10"></i>
						  <span class="hide-menu"><?php echo get_phrase('zoom_live_class'); ?></span>
					</a>
				</li>
			<?php endif;?> 
			
				<?php 
					$selectJitsiFromAddonTable = $this->db->get_where('addons',array('unique_key'=> 'jitsi', 'addon_key' => 'live_streaming', 'status' => 'installed'))->row();
					if($selectJitsiFromAddonTable != "") : 
				?>
            <li class="<?php if ($page_name == 'jitsi') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>student/jitsi">
                <i class="fa fa-laptop p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('jitsi_live_class'); ?></span>
                </a>
    		</li>
			<?php endif;?>  
			
			

	
				<li class="<?php if ($page_name == 'video_class') echo 'active'; ?>">
							<a href="<?php echo base_url(); ?>student/video_class">
							<i class="fa fa-laptop p-r-10"></i>
								 <span class="hide-menu"><?php echo get_phrase('video_classroom'); ?></span>
							</a>
				</li>

	

            <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/invoice">
                    <i class="fa fa-paypal p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Invoice'); ?></span>
                </a>
            </li> 

        <li class="<?php if ($page_name == 'payment_history') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/payment_history">
                    <i class="fa fa-credit-card p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Payment History'); ?></span>
                </a>
        </li>         
		    
                                
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/manage_profile">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'studentRequestBook') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>student/studentRequestBook">
                    <i class="fa fa-plus p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Request Book'); ?></span>
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