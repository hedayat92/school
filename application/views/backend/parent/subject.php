<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_subject');?></div>
                                <div class="panel-body table-responsive">

                                
                    <table id="example23" class="table display">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                        <?php $counter = 1;

                        	$subject_tracker = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                        	foreach ($subject_tracker as $tracker) {  
						  
    					  $loading_subject = $this->db->get_where('subject', array('class_id' => $tracker['class_id']))->result_array();
                		  foreach($loading_subject as $key => $class_subject):
						?>
                    
                    
                    
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $class_subject['class_id']);?></td>
							<td><?php echo $class_subject['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('teacher', $class_subject['teacher_id']);?></td>
							
                        </tr>
                        <?php endforeach;?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
			




            