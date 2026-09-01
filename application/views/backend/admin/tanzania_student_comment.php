	<?php 
		$session = get_settings('session');
		$term = get_settings('term');
		$explode	= explode('-', $param2);
		$class_id 	= $explode[0];
		$exam_id 	= $explode[1];
		$student_id = $explode[2];
		
	?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_remarks_for'); ?> : <?=$this->crud_model->get_type_name_by_id('student', $student_id);?></div>
			
			
				<?php

				 $select = $this->db->get_where('tanzania_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();
				 if($select->student_id == "") : 
				 
				 ?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/tanzania_stu_rem/save/' , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('percentage');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="percentage" type="text" class="form-control" value="" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('average');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="average" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="description" type="text"  class="form-control" value="" / required>
                            </div>
                     </div>	
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_percentage');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_percentage" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_average');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_average" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_description');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_description" type="text"  class="form-control" value="" / required>
                            </div>
                     </div>	 
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				<?php endif;?>
				
				
				
				<?php 
					  $select = $this->db->get_where('tanzania_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();
				 	  if($select->student_id != "") : 
				?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/tanzania_stu_rem/save/'. $select->id , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
										
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('descipline_percentage');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="percentage" type="text" class="form-control" value="<?=$select->percentage;?>" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('descipline_average');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="average" type="text" class="form-control" value="<?=$select->average;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('descipline_description');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="description" type="text"  class="form-control" value="<?=$select->description;?>" / required>
                            </div>
                     </div>	
					 
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_percentage');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_percentage" type="text" class="form-control" value="<?=$select->atten_percentage;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_average');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_average" type="text" class="form-control" value="<?=$select->atten_average;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('attendance_description');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="atten_description" type="text"  class="form-control" value="<?=$select->atten_description;?>" / required>
                            </div>
                     </div>	
							
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				<?php endif;?>
				
				
				
				
				
			</div>                
		</div>
	</div>
</div>