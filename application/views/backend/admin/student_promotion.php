<?php $session = get_settings('session'); ?>
<?php if($from_class != "" && $to_class != "") : ?>
<form method="post" action="<?php echo base_url();?>admin/manage_enrollment" class="form">
				<div class="alert alert-info">
					Selected students will be promoted to <strong style="color:yellow"><?= $this->db->get_where('class' , array('class_id' => $to_class))->row()->name;?>*</strong><br>
					Section <strong style="color:yellow"><?= $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?>*</strong>
				
				
				</div>
<table id="example" class="table display">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('image');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
							<th><div><?php echo get_phrase('sex');?></div></th>
                    		<th><div><?php echo get_phrase('promote_from_class');?></div></th>
                    		
                            <!--<th><div><?php echo get_phrase('status');?></div></th>-->
                    		<th><div><?php echo get_phrase('promote_to_class');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php 	$students =  $this->db->get_where('student', array('class_id' => $from_class))->result_array();
                    		foreach($students as $key => $student):
					?>         
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30"></td>
                            <td>
							<input type="text" name="enroll_<?php echo $student['student_id'];?>" value="<?php echo $student['student_id'];?>" style="display: none;">
							<?php echo $student['name'];?> (<strong><?php echo $student['roll'];?></strong>)
							</td>
							<td><?php echo ucfirst($student['sex']);?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $student['class_id']);?></td>
							
                            <!--
							<td>
							
								<?php /*
										$select = $this->db->get_where('promote_status', array('student_id' => $student['student_id'], 'session' => $session));
										if($select->num_rows() > 0){
											if($select->row()->status == 'on_trial'){
												echo '<span class="label label-warning">Promoted on Trial</span>';
											}
											
											if($select->row()->status == 'repeat'){
												echo '<span class="label label-danger">To Repeat '.$this->crud_model->get_type_name_by_id('class', $student['class_id']).'</span>';
											}
										}else{
											echo '<span class="label label-success">Promoted</span>';
										}
									*/
								?>
							
							</td>
							-->
							<td> 
								
								<select name="to_class_<?php echo $student['student_id'];?>"  class="custom-select">
									
									<?php 
										$select = $this->crud_model->get_classes(); 
										foreach($select as $row) : 
										if($row['class_id'] != $to_class && $row['class_id'] != $from_class) continue;
									?>
									<option value="<?=$row['class_id']?>"<?php if($row['class_id'] == $to_class) echo 'selected="selected"';?>><?=$row['name']?> 
									<?php if($row['class_id'] == $from_class) echo '- select if student not promoted';?></option>
									<?php endforeach;?>
								
									<!--
										<option value="<?php echo $to_class;?>">Promote To - <?=$this->crud_model->get_type_name_by_id('class', $to_class);?></option>
                                    	<option value="<?php echo $from_class;?>">Promote To - <?=$this->crud_model->get_type_name_by_id('class', $from_class);?></option>
									-->
								</select>
								
                           
        					</td> 
                        </tr> 
    <?php endforeach;?>
                    </tbody> 
                </table>
                        <input type="text" name="from_class" value="<?php echo $from_class;?>" style="display: none;">
                        <input type="text" name="section_id" value="<?php echo $section_id;?>" style="display: none;">
                        
						<?php if($from_class != "" && $to_class != "") { ?>
                        <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Promote Student</button>
						<?php } ?>
</form>
<?php endif;?>



<?php if($from_class == "" && $to_class == "") : ?>
					<div class="alert alert-info" style="background-color:red; border:none; color:#fff" align="center">
						<h5 class="mt-2">No Student Found</h5>
						<p>Please select promote <strong>from</strong> which class, promote <strong>to</strong> which class and <strong>section</strong> of the new class.</p>
													
					</div>	
<?php endif;?>
