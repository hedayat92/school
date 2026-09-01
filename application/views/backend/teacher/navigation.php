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



    <li> <a href="<?php echo base_url();?>teacher/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>
	

			
				<?php 
					$selectZoomFromAddonTable = $this->db->get_where('addons',array('unique_key'=> 'zoom', 'addon_key' => 'live_streaming', 'status' => 'installed'))->row();
					if($selectZoomFromAddonTable != "") : 
				?>
				 <li class="<?php if ($page_name == 'live_class') echo 'active'; ?>">
					<a href="<?php echo base_url(); ?>teacher/live_class">
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
                <a href="<?php echo base_url(); ?>teacher/jitsi">
                <i class="fa fa-laptop p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('jitsi_live_class'); ?></span>
                </a>
    		</li>
			<?php endif;?>  
			
			
			
			
	
			 <li class="<?php if ($page_name == 'video_class') echo 'active'; ?>">
						<a href="<?php echo base_url(); ?>teacher/video_class">
						<i class="fa fa-laptop p-r-10"></i>
							  <span class="hide-menu"><?php echo get_phrase('video_classroom'); ?></span>
						</a>
			</li>
	
	

    <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-download p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('download_page');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'assignment' ||
                    $page_name == 'study_material')
                echo 'opened active';
            ?> ">
                                     

            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>assignment/assignment">
                <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('assignments'); ?></span>
                </a>
            </li>

   

            <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>studymaterial/study_material">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('study_materials'); ?></span>
                </a>
            </li>
			
			 <li class="<?php if ($page_name == 'done_assignment') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>assignment/done_assignment">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('done_assignment'); ?></span>
                </a>
            </li>
			

     
                 </ul>
        </li>

    <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_attendance');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'manage_attendance' || $page_name == 'staff_attendance' ||
                $page_name == 'attendance_report')
            echo 'opened active';
            ?>">
                    

                <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>teacher/manage_attendance/<?php echo date("d/m/Y"); ?>">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('mark_attendance'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>teacher/attendance_report">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('view_attendance'); ?></span>
                    </a>
                </li>


        </ul>
    </li>

    <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('enter_student_score');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'marks' ||
                    $page_name == 'exam_marks_sms'||
                    $page_name == 'tabulation_sheet')
                echo 'opened active';
            ?>">

        <?php $select_role = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->row()->role;?>
        <?php if($select_role == '1'):?>
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>teacher/marks">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('enter_student_score'); ?></span>
                        </a>
                    </li>
        <?php endif;?>
        
        <?php $select_role = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->row()->role;?>
        <?php if($select_role == '2'):?>
                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>teacher/student_marksheet_subject">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('enter_student_score'); ?></span>
                        </a>
                    </li>
        <?php endif;?>
     
        </ul>
    </li>
	
	 <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-credit-card p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Human Resources');?><span class="fa arrow"></span></span></a>
        
                    <ul class=" nav nav-second-level<?php if ($page_name == 'leave' || $page_name == 'payroll_list' || $page_name == 'award') echo 'opened active';?>">

                        <li class="<?php if ($page_name == 'leave') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>teacher/leave/">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('Leave Application'); ?></span>
                            </a>
                        </li>


                        <li class="<?php if ($page_name == 'award') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>teacher/award">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                <span class="hide-menu"><?php echo get_phrase('List Award'); ?></span>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                        
                                
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>teacher/manage_profile">
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