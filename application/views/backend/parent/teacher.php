					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_teachers');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('role');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('sex');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        <?php $counter = 1;

                        	$subject_tracker = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                        	foreach ($subject_tracker as $tracker) {  
						  
    					  $loading_subject = $this->db->get_where('class', array('class_id' => $tracker['class_id']))->result_array();
                		  foreach($loading_subject as $key => $class_teacher) {
                		      
                		  $loading_teacher = $this->db->get_where('teacher', array('teacher_id' => $class_teacher['teacher_id']))->result_array();
                		  foreach($loading_teacher as $key => $teacher) {
						?>
                    
                    
                    
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30px"></td>
                            <td><?php echo $teacher['name'];?></td>
                            <td>
                                
                           <?php if($teacher['role']== 1) echo 'Class Teacher';?>
                           <?php if($teacher['role']== 2) echo 'Subject Teacher';?>
                        
                            </td>
                            <td><?php echo $teacher['email'];?></td>
                            <td><?php echo $teacher['sex'];?></td>

                           
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
						
                    </tbody>
                </table>



                </div>
            </div>
        </div>
    </div>
</div>
