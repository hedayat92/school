<div class="row">	
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;</div>
				<div class="panel-body table-responsive">
<table id="example" class="table display">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('Image');?></div></th>
                            <th><div><?php echo get_phrase('admission_no');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('sex');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('parent');?></div></th>
                    		<th><div><?php echo get_phrase('actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $students =  $this->db->get('quarantine')->result_array();
                    foreach($students as $key => $student):?>         
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('quarantine', $student['quarantine_id']);?>" class="img-circle" width="30"></td>
                            <td><?php echo $student['roll'];?></td>
                            <td><?php echo $student['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $student['class_id']);?></td>
							<td><?php echo ucfirst($student['sex']);?></td>
                            <td><?php echo $student['email'];?></td>
                            <td><?php echo $student['phone'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('parent', $student['parent_id']);?></td>
							<td>
							
							
							<a href="<?php echo base_url(); ?>admin/view_student/<?php echo $student['quarantine_id'];?>/"> 
								<button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-link"></i></button>
							</a>	
					 
			
							<!--
							<a href="#" onclick="quarantine_modal('<?php echo base_url();?>admin/undo_quarantine/<?php echo $student['student_id'];?>');">
								<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-mail-reply"></i> Undo Quarantine</button>
							</a>	
							-->	
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>


			</div>
		</div>
	</div>
</div>


