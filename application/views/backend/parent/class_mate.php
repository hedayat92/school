					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Class Mate');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('sex');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                   <?php
                        	$subject_tracker = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                        	foreach ($subject_tracker as $tracker) {  
						  
    					  $loading_subject = $this->db->get_where('student', array('class_id' => $tracker['class_id']))->result_array();
                		  foreach($loading_subject as $key => $student) {
                		      
                		
						?>
                   
                   
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30px"></td>
                            <td><?=$this->db->get_where('class', array('class_id' => $student['class_id']))->row()->name;?></td>
                            <td><?php echo $student['name'];?></td>
                            <td><?php echo $student['email'];?></td>
                            <td><?php echo $student['sex'];?></td>

                           
                        </tr>
                        <?php } ?>
                        <?php } ?>
						
                    </tbody>
                </table>



                </div>
            </div>
        </div>
    </div>
</div>
