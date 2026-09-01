 <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="#"><b><img src="<?php echo base_url();?>uploads/logo.png" height="30" alt="home" /></b><span class="hidden-xs text-uppercase"><strong><?php echo $this->db->get_where('settings', array('type' => 'short_name'))->row()->description;?></strong>&nbsp;</span></a></div>
                    <ul class="nav navbar-top-links navbar-left hidden-xs">
                        <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                       
				<?php if($this->session->userdata('login_type') == 'admin') : ?>
                    <li>
                    <?php echo form_open(base_url() . 'report/searchStudent' , array('onsubmit' => 'return validate() role="search" class="app-search hidden-xs"')); ?>
                            <input type="text" style="width:500px" id="search_input" name="search_key" placeholder="<?php echo get_phrase('search_student'); ?>..." class="form-control"> <a href="#"><i class="fa fa-search"></i></a> 
                       <?php echo form_close();?>
					<li id="stu_result" style="list-style-type: none;margin-left:35px;z-index: 100;position: absolute;margin-top: 45px; width:495px; padding-left:20px;font-family:Georgia, Times, serif; font-size:1.6em; line-height:2.1em;"></li>     
                    </li>
					 <?php endif; ?>
                       
						
					 <?php if($this->session->userdata('login_type') == 'student' || $this->session->userdata('login_type') == 'parent' || $this->session->userdata('login_type') == 'teacher' || $this->session->userdata('login_type') == 'librarian' || $this->session->userdata('login_type') == 'accountant' || $this->session->userdata('login_type') == 'hostel' ) : ?>
                    <li>
                        <?php echo form_open(base_url() . 'admin/searchStudent' , array('onsubmit' => 'return validate() role="search" class="app-search hidden-xs"')); ?>
                            <input type="text" id="search_input" name="search_key" placeholder="<?php echo get_phrase('search_student'); ?>..." class="form-control" disabled="disabled"> <a href="#"><i class="fa fa-search"></i></a> 
                       <?php echo form_close();?>
                    </li>
					 <?php endif; ?>
						
                    </ul>
					
           <ul class="nav navbar-top-links navbar-right pull-right">
                	<li class="dropdown"> 
				
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-paragraph"></i></a>
		
           					<ul class="dropdown-menu">
							 <style>
								.pointer {cursor: pointer;}
								</style>
								
									<?php
										if ($set_direction = $this->session->userdata('set_direction')) {
										} else {
											$set_direction = get_settings('text_align');
										}
									?>
								
									<li <?php if ($set_direction == 'left-to-right') { ?>class="active"<?php } ?>>
                                        <a class="set_direction pointer" data-href="<?php echo base_url(); ?>admin/set_direction/left-to-right" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Left to Right
                                        </a>
                                    </li>
                          
                                    <li <?php if ($set_direction == 'right-to-left') { ?>class="active"<?php } ?>>
                                        <a class="set_direction pointer" data-href="<?php echo base_url(); ?>admin/set_direction/right-to-left" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Right to Left
                                        </a>
                                    </li>
				
                    		</ul>
                    </li>
		
		 		<ul class="nav navbar-top-links navbar-right pull-right">
                	<li class="dropdown"> 
				
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cube"></i></a>
		
           					<ul class="dropdown-menu">
							 <style>
								.pointer {cursor: pointer;}
								</style>
								

									<?php
										if ($skin_colour = $this->session->userdata('skin_colour')) {
										} else {
											$skin_colour = get_settings('skin_colour');
										}
									?>
									<li <?php if ($skin_colour == 'default') { ?>class="active"<?php } ?>>
                                        <a class="set_colour pointer" data-href="<?php echo base_url(); ?>admin/skin_colour/default" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Default Theme
                                        </a>
                                    </li>
                          
                                   <li <?php if ($skin_colour == 'dark') { ?>class="active"<?php } ?>>
                                        <a class="set_colour pointer" data-href="<?php echo base_url(); ?>admin/skin_colour/dark" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Dark Theme
                                        </a>
                                    </li>
									<li <?php if ($skin_colour == 'green') { ?>class="active"<?php } ?>>
                                        <a class="set_colour pointer" data-href="<?php echo base_url(); ?>admin/skin_colour/green" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Green Theme
                                        </a>
                                    </li>
									
									<li <?php if ($skin_colour == 'purple') { ?>class="active"<?php } ?>>
                                        <a class="set_colour pointer" data-href="<?php echo base_url(); ?>admin/skin_colour/purple" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Purple Theme
                                        </a>
                                    </li>
									
									<li <?php if ($skin_colour == 'magma') { ?>class="active"<?php } ?>>
                                        <a class="set_colour pointer" data-href="<?php echo base_url(); ?>admin/skin_colour/magma" style="color:#96a2b4">
											<i class="fa fa-angle-double-right"></i> Magma Theme
                                        </a>
                                    </li>
                    		</ul>
                    </li>
               
            <li class="dropdown"> 
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    
                    <?php 
                    
                    if($set_language = $this->session->userdata('language')){

                    } else{

                        $set_language = $this->db->get_where('settings', array('type' => 'language'))->row()->description;
                    }

                    $list_image = $this->db->get_where('language_list', array('db_field' => $set_language))->row()->db_field;
                    $list_name =  $this->db->get_where('language_list', array('db_field' => $set_language))->row()->name;
                    
                    ?>

                    <img src="<?php echo base_url();?>optimum/flag/<?php echo $list_image;?>.png" width="20px" height="20px">
                </a>
				<style>
			   #pointer {
			   cursor: pointer;
			   }
			   </style>
                <ul class="dropdown-menu">
                        
                    <?php $select_all_languages_from_laguage_table = $this->db->get_where('language_list', array('status' => 'ok'))->result_array();
                            foreach ($select_all_languages_from_laguage_table as $key => $selected_languages):?>
                        
                            <li <?php if($set_language == $selected_languages['db_field']) { ?> class="active" <?php }?>>
                            <a class="set_langs" id="pointer" onclick="location.reload();" data-href="<?php echo base_url();?>admin/set_language/<?php echo $selected_languages['db_field'];?>">
                              <img src="<?php echo base_url();?>optimum/flag/<?php echo $selected_languages['db_field'];?>.png" width="16px" height="16px">  <?php echo $selected_languages['name'];?>
                            </a>
                        </li>
                            <?php endforeach;?>
                        </ul>
                        
                    </li>


                    
                    <!-- /.dropdown -->
                    <li class="dropdown">


                            <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>

                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url() . $face_file;?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">


                                <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                                ?>


                        </b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                            <?php if($account_type == 'parent'):?>
                            <a href="<?php echo base_url();?>parents/manage_profile"><i class="ti-user"></i> Manage Profile</a>
                            <?php endif;?>
                            <?php if($account_type != 'parent'):?>
                            <a href="<?php echo base_url();?><?php echo $this->session->userdata('login_type'); ?>/manage_profile"><i class="ti-user"></i> Edit Profile</a>
                            <?php endif;?>
                            </li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Account Setting</a></li>
                            <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
		
		
		 <script type="text/javascript">
            $(document).ready(function(){         
                var consulta;          
                    $("#search_input").keyup(function(e){
                    consulta = $("#search_input").val();
                    $("#stu_result").queue(function(n) {                     
                    $("#stu_result").html('<img src="<?php echo base_url();?>assets/images/loader-1.gif" />');            
                        $.ajax({
                              type: "POST",
                              url: '<?php echo base_url();?>admin/ajax_student_search',
                              data: "b="+consulta,
                              dataType: "html",
                              error: function(){
                                    alert("Error");
                              },
                              success: function(data){                                                      
                                    $("#stu_result").html(data);
                                    n();
                              }
                  		});                           
             		});                       
      			});                       
			});
		</script>
    
      