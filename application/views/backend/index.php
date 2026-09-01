    <?php 
        $system_name    = get_settings('system_name');
        $system_address = get_settings('address'); 
        $footer         = get_settings('footer');
        $text_align     = get_settings('text_align');
        $loginType      = $this->session->userdata('login_type');
        $running_year   = get_settings('session');
        $system_currency= get_settings('currency');
		$report_template= get_settings('report_template');
    ?>
<?php include 'css.php'; ?>

     <!-- Preloader css -->
		<style>
			#load{
				width:100%;
				height:100%;
				position:fixed;
				z-index:9999;
				background:url("<?php echo base_url();?>assets/images/loader.svg") no-repeat center center rgba(0,0,0,0.25)
			}
		</style>
		
    <div id="wrapper">
	<div id="load"></div>
    

	<?php include 'header.php'; ?>
	<?php include $loginType.'/navigation.php';?>
	<?php include 'page_info.php';?>
	<?php include $loginType.'/'.$page_name.'.php';?>
		
       			
	<?php // include 'dashboard.php'; ?>
				
				
                
				
               <!-- .right-sidebar -->
                <div class="right-sidebar" style="background:url(<?php echo base_url(); ?>assets/images/10.png); opacity: 0.9;">
                    <div class="slimscrollright">
                        <div class="rpanel-title">Current Mesage Thread<span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                          
                            <ul class="m-t-20 chatonline">
					<?php
					$account_type	=	$this->session->userdata('login_type');
					$current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
					$this->db->where('sender', $current_user);
					$this->db->or_where('reciever', $current_user);
					$message_threads = $this->db->get('message_thread')->result_array();
					foreach ($message_threads as $row):

                	// defining the user to show
                	if ($row['sender'] == $current_user)
                    $user_to_show = explode('-', $row['reciever']);
                	if ($row['reciever'] == $current_user)
                    $user_to_show = explode('-', $row['sender']);

                	$user_to_show_type = $user_to_show[0];
                	$user_to_show_id = $user_to_show[1];
                	$unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
							
<li>
<?php if ($account_type != 'parent'): ?>
<a href="<?php echo base_url(); ?><?php echo $this->session->userdata('login_type');?>/message/message_read/<?php echo $row['message_thread_code']; ?>"><img src="<?php echo $this->crud_model->get_image_url($user_to_show_type, $user_to_show_id); ?>" class="img-circle" draggable="false"/> <span><?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>&nbsp;<input value="<?php $checkStatus =  $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->login_status; ?>" type="hidden" />
			<span class="pull-right"><?php if ($checkStatus == 1):?>
			<?php echo '<i class="fa fa-circle" style="color:green"></i>'?>
			<?php endif;?>
			<?php if ($checkStatus == 0):?>
			<?php echo '<i class="fa fa-circle" style="color:red"></i>'?>
			<?php endif;?>
			</span>

			<small class="text-success">
									 <?php if ($unread_message_number > 0): ?>
											<?php echo $unread_message_number . '&nbsp;'. 'Message(s)'; ?>
									<?php endif; ?> 
									<?php if ($unread_message_number == 0): ?>
											<?php echo $unread_message_number . '&nbsp;'. 'Message(s)'. '&nbsp;'.'<i class="fa fa-check"></i>'; ?>
									<?php endif; ?>
			</small>
			<?php endif; ?>
							<?php if ($account_type == 'parent'): ?>
							<a href="<?php echo base_url(); ?>parents/message/message_read/<?php echo $row['message_thread_code']; ?>"><img src="<?php echo $this->crud_model->get_image_url($user_to_show_type, $user_to_show_id); ?>" class="img-circle" draggable="false"/> <span><?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
							<span class="pull-right"><?php if ($checkStatus == 1):?>
										<?php echo '<i class="fa fa-circle" style="color:green"></i>'?>
										<?php endif;?>
										<?php if ($checkStatus == 0):?>
										<?php echo '<i class="fa fa-circle" style="color:red"></i>'?>
										<?php endif;?>
										</span>
							<small class="text-success">
													 <?php if ($unread_message_number > 0): ?>
															<?php echo $unread_message_number . '&nbsp;'. 'Message(s)'; ?>
													<?php endif; ?> 
													<?php if ($unread_message_number == 0): ?>
															<?php echo $unread_message_number . '&nbsp;'. 'Message(s)'. '&nbsp;'.'<i class="fa fa-check"></i>'; ?>
													<?php endif; ?>
							</small>
							<?php endif; ?>


				</span>
			</a> 


                                </li>
								
								 <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
			
			


		
        </div>
        <!-- /#page-wrapper -->
    </div>
	<script>
 		document.onreadystatechange = function () {
		  var state = document.readyState
		  if (state == 'interactive') {
			   document.getElementById('contents').style.visibility="hidden";
		  } else if (state == 'complete') {
			  setTimeout(function(){
				 document.getElementById('interactive');
				 document.getElementById('load').style.visibility="hidden";
				 document.getElementById('contents').style.visibility="visible";
			  },100);
		  }
		}
  	</script>
<?php include 'modal.php'; ?>
<?php include 'footer.php'; ?>
<?php include 'js.php'; ?>