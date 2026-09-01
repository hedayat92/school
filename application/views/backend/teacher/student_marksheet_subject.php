
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-mortar-board"></i>&nbsp;&nbsp;<?php echo get_phrase('select_exam,_class_and_subject');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'teacher/student_marksheet_subject' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Exam');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_examination');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_subjects(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Subject');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <select name="<?php if($class_id == $row['class_id']) echo 'subject_id'; else echo 'temp';?>" id="subject_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
                                        <option value="">Subject of: <?php echo $row['name'] ;?></option>

                                        <?php $select_subject_from_model = $this->crud_model->get_subjects_by_class($row['class_id']);
                                        foreach ($select_subject_from_model as $key => $subject_selected_from_model): ?>
                                        <option value="<?php echo $subject_selected_from_model['subject_id'];?>"<?php if(isset($subject_id) && $subject_id == $subject_selected_from_model['subject_id']) echo 'selected="selected"';?>><?php echo $subject_selected_from_model['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="subject_id_0" style="display:<?php if(isset($subject_id) && $subject_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Select Class First');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Details');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
	
	
	
    <!--
	<div class="col-sm-6">
		<div class="panel panel-info">
            
              <div class="panel-body table-responsive">
				
			<div class="alert alert-info">Select class and click on download EMS button below. This will download excel file containing all the students in the selected class</div>
			
                    		
							<?php echo form_open(base_url() . 'teacher/student_marksheet_subject' , array('enctype' => 'multipart/form-data'));?>
                      
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_class');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control" onchange="return get_class_subject1(this.value)" / required>
                                        <option value="">Select class to download EMS</option>
                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>">Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                	</select>

                                </div>
                            </div>
							
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('subject');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select name="subject_id" class="form-control" id="subject_selector_holder1" / required>
										<option value=""><?php echo get_phrase('select_class_first');?></option>
									</select>
					  			</div>
								
						</div>
						
							
                            <input class="" type="hidden" value="download" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-upload"></i>&nbsp;<?php echo get_phrase('download');?> EMS</button>
                        </div>
		
                    </form>    
					
					<div class="alert alert-info">If you have downloaded EMS and type all the students scores. Please click on the link below to upload your student scores
					<i class="fa fa-arrow-down"></i></div>
						<span class="pull-right">
						<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/upload_score/');">
							<i class="fa fa-arrow-right"></i> CLICK HERE TO UPLOAD SCORE
						</a>
						</span>
					<br>
					
					
					
					            
            </div>                
		</div>
	</div>
	-->
	
	
</div>


	<style>
		.alert-red{
			background-color: red;
			color:white;
		}
	</style>

<?php if($class_id > 0 && $subject_id > 0 && $exam_id > 0):?>	

  
			
			
    <?php 
			$select_student_with_class_id  =   $this->crud_model->get_students($class_id);
			$select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
            foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student):
			foreach ($select_student_with_class_id as $key => $student_selected_with_class):			

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'subject_id' => $class_subject_exam_student['subject_id'], 'student_id' => $student_selected_with_class['student_id']);
                $query = $this->db->get_where('mark', $verify_data);
				
				$sql = "select * from mark order by mark_id desc limit 1";
				$return_query = $this->db->query($sql)->row()->mark_id + 1;
				$verify_data['mark_id'] = $return_query;
				$verify_data['term'] 	= get_settings('term');
				$verify_data['session']	= get_settings('session');

                if($query->num_rows() < 1)
                    $this->db->insert('mark', $verify_data);
            endforeach;endforeach;?>
			


					
    <div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_subject_score'); ?></div>
                <div class="panel-body table-responsive">
				
						<?php if($report_template == 'tanzania' || $report_template == 1) : ?>
					
						<h5 id="error_message" class="alert alert-red" style="display:none">CA score must not be greater 30 and exam score must not be greater than 70</h5>
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('student');?></td>
										<td><?php echo get_phrase('continous_assessment');?></td>
										<td><?php echo get_phrase('exam score');?></td>
										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

											<?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
												foreach ($select_student_with_class_id as $key => $student_selected_with_class): 
									
													$verify_data = array('exam_id' => $exam_id, 
													'class_id' => $class_id, 'subject_id' => $subject_id, 
													'student_id' => $student_selected_with_class['student_id']);
													
													$query = $this->db->get_where('mark', $verify_data);
													$update_student_marks = $query->result_array();
									
													foreach ($update_student_marks as $key => $general_select):
											   ?>
                    	
										
											<?php echo form_open(base_url() . 'teacher/student_marksheet_subject/'. $exam_id . '/' . $class_id);?>
										<tr>
											<td>
												<?php echo $student_selected_with_class['name'];?>
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score1'];?>" 
												name="class_score1_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											  <td>
												<input type="text" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" 
												name="exam_score_<?php echo $student_selected_with_class['student_id'];?>" onchange="exam_score_change()">
											  </td>
			
											<td>
												<textarea name="comment_<?php echo $student_selected_with_class['student_id'];?>" 
												class="form-control"><?php echo $general_select['comment'];?></textarea>
											</td>
												<input type="hidden" name="mark_id_<?php echo $student_selected_with_class['student_id'] ;?>" 
												value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
										</tr>

										<?php  endforeach; endforeach;?>
									</tbody>
							   </table>
              			
                      	<button type="submit" class="btn btn-sm btn-rounded btn-block  btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
                 
                  <?php echo form_close();?>
				  
					<script>				  
						function class_score_change() {
						  var class_scores = document.getElementsByClassName('class_score');
							for (var i = class_scores.length - 1; i >= 0; i--) {
							  var value = class_scores[i].value;
								if (value > 30) {
									class_scores[i].value = 0;
										$('#error_message').show();
								}
							}
						}
						 
						
						function exam_score_change() {
						  var exam_scores = document.getElementsByClassName('exam_score');
							for (var i = exam_scores.length - 1; i >= 0; i--) {
							  var value = exam_scores[i].value;
								if (value > 70) {
									exam_scores[i].value = 0;
										$('#error_message').show();
								}
							}
						}
					</script>
					<?php endif;?>
					
					
					<?php if($report_template == 'udemy') : ?>
						<h5 id="error_message" class="alert alert-red" style="display:none">CA score must not be greater 20 and exam score must not be greater than 60</h5>
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td>CA 1 (20%)</td>
										<td>CA 2 (20%)</td>
										<td><?php echo get_phrase('exam_score');?> (60%)</td>
										<!-- <td><?php echo get_phrase('comment');?></td>-->
									</tr>
								</thead>
                    				<tbody>

											<?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
												foreach ($select_student_with_class_id as $key => $student_selected_with_class): 
									
													$verify_data = array('exam_id' => $exam_id, 
													'class_id' => $class_id, 'subject_id' => $subject_id, 
													'student_id' => $student_selected_with_class['student_id']);
													
													$query = $this->db->get_where('mark', $verify_data);
													$update_student_marks = $query->result_array();
									
													foreach ($update_student_marks as $key => $general_select):
											   ?>
                    	
										
											<?php echo form_open(base_url() . 'teacher/student_marksheet_subject/'. $exam_id . '/' . $class_id);?>
										<tr>
											<td>
												<?php echo $student_selected_with_class['name'];?>
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score1'];?>" 
												name="class_score1_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score2'];?>" 
												name="class_score2_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											
											  <td>
												<input type="text" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" 
												name="exam_score_<?php echo $student_selected_with_class['student_id'];?>" onchange="exam_score_change()">
											  </td>
			
											<td>
												<textarea name="comment_<?php echo $student_selected_with_class['student_id'];?>" 
												class="form-control"><?php echo $general_select['comment'];?></textarea>
											</td>
												<input type="hidden" name="mark_id_<?php echo $student_selected_with_class['student_id'] ;?>" 
												value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
										</tr>

										<?php  endforeach; endforeach;?>
									</tbody>
							   </table>
							   <button type="submit" class="btn btn-sm btn-rounded btn-block btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
							   <?php echo form_close();?>
							   
								<script>				  
									function class_score_change() {
									  var class_scores = document.getElementsByClassName('class_score');
										for (var i = class_scores.length - 1; i >= 0; i--) {
										  var value = class_scores[i].value;
											if (value > 20) {
												class_scores[i].value = 0;
													$('#error_message').show();
											}
										}
									}
									 
									
									function exam_score_change() {
									  var exam_scores = document.getElementsByClassName('exam_score');
										for (var i = exam_scores.length - 1; i >= 0; i--) {
										  var value = exam_scores[i].value;
											if (value > 60) {
												exam_scores[i].value = 0;
													$('#error_message').show();
											}
										}
									}
								</script>   
							   
					<?php endif;?>
					
					
					
					
					<?php if($report_template == 'gate') : ?>
						<h5 id="error_message" class="alert alert-red" style="display:none">CA score must not be greater 20 and exam score must not be greater than 60</h5>
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td>CA1(20%)</td>
										<td>CA2(20%)</td>
										<td>CA3(20%)</td>
										<td><?php echo get_phrase('exam');?>(40%)</td>
										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

											<?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
												foreach ($select_student_with_class_id as $key => $student_selected_with_class): 
									
													$verify_data = array('exam_id' => $exam_id, 
													'class_id' => $class_id, 'subject_id' => $subject_id, 
													'student_id' => $student_selected_with_class['student_id']);
													
													$query = $this->db->get_where('mark', $verify_data);
													$update_student_marks = $query->result_array();
									
													foreach ($update_student_marks as $key => $general_select):
											   ?>
                    	
										
											<?php echo form_open(base_url() . 'admin/student_marksheet_subject/'. $exam_id . '/' . $class_id);?>
										<tr>
											<td>
												<?php echo $student_selected_with_class['name'];?>
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score1'];?>" 
												name="class_score1_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score2'];?>" 
												name="class_score2_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score3'];?>" 
												name="class_score3_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change()">
											</td>
											
											  <td>
												<input type="text" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" 
												name="exam_score_<?php echo $student_selected_with_class['student_id'];?>" onchange="exam_score_change()">
											  </td>
			
											<td>
												<textarea name="comment_<?php echo $student_selected_with_class['student_id'];?>" 
												class="form-control"><?php echo $general_select['comment'];?></textarea>
											</td>
												<input type="hidden" name="mark_id_<?php echo $student_selected_with_class['student_id'] ;?>" 
												value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
										</tr>

										<?php  endforeach; endforeach;?>
									</tbody>
							   </table>
							   <button type="submit" class="btn btn-sm btn-rounded btn-block btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
							   <?php echo form_close();?>
							   
								<script>				  
									function class_score_change() {
									  var class_scores = document.getElementsByClassName('class_score');
										for (var i = class_scores.length - 1; i >= 0; i--) {
										  var value = class_scores[i].value;
											if (value > 20) {
												class_scores[i].value = 0;
													$('#error_message').show();
											}
										}
									}
									 
									
									function exam_score_change() {
									  var exam_scores = document.getElementsByClassName('exam_score');
										for (var i = exam_scores.length - 1; i >= 0; i--) {
										  var value = exam_scores[i].value;
											if (value > 40) {
												exam_scores[i].value = 0;
													$('#error_message').show();
											}
										}
									}
								</script>   
							   
					<?php endif;?>
					
					
					
					
					
					
					
					
					<?php if($report_template == 'diamond') : ?>
						<h5 id="error_message1" class="alert alert-red" style="display:none">Class Score for CA1 cannot be greater than 2</h5>
						<h5 id="error_message2" class="alert alert-red" style="display:none">Home Work for CA1 cannot be greater than 1</h5>
						<h5 id="error_message3" class="alert alert-red" style="display:none">Classnote Score for CA1 cannot be greater than 1</h5>
						<h5 id="error_message4" class="alert alert-red" style="display:none">Project Score for CA1 cannot be greater than 1</h5>
						<h5 id="error_message5" class="alert alert-red" style="display:none">Test 1 for CA1 cannot be greater than 15</h5>
						
						<h5 id="error_message11" class="alert alert-red" style="display:none">Class Score for CA2 cannot be greater than 2</h5>
						<h5 id="error_message22" class="alert alert-red" style="display:none">Home Work for CA2 cannot be greater than 1</h5>
						<h5 id="error_message33" class="alert alert-red" style="display:none">Classnote Score for CA1 cannot be greater than 1</h5>
						<h5 id="error_message44" class="alert alert-red" style="display:none">Project Score for CA2 cannot be greater than 1</h5>
						<h5 id="error_message55" class="alert alert-red" style="display:none">Test 2 for CA2 cannot be greater than 15</h5>
						<h5 id="exam_score" class="alert alert-red" style="display:none">Exam Score cannot be greater than 60</h5>
    					<table cellpadding="0" cellspacing="0" border="1" class="table">
								<thead>
									<tr bordercolordark="#000000; 1px solid">
										<td>&nbsp;</td>
										<td colspan="5"><div align="center"><strong>CA 1</strong></div></td>
										<td colspan="7"><div align="center"><strong>CA 2 </strong></div></td>
										<td colspan="7"><div align="center"><strong>EXAM </strong></div></td>
									</tr>
									<tr>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">SUBJECT</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Class Works (2 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Home Work (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Clssnote (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Project (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Test1 (15 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">CA1 Comment</td>
										
										
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Class Work (2 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Home Work (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Note (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Project (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Test2 (15 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">CA2 Comment</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Exam Score (60 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Exam Comment</td>
										
									</tr>
								</thead>
                    				<tbody>

											<?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
												foreach ($select_student_with_class_id as $key => $student_selected_with_class): 
									
													$verify_data = array('exam_id' => $exam_id, 
													'class_id' => $class_id, 'subject_id' => $subject_id, 
													'student_id' => $student_selected_with_class['student_id']);
													
													$query = $this->db->get_where('mark', $verify_data);
													$update_student_marks = $query->result_array();
									
													foreach ($update_student_marks as $key => $general_select):
											   ?>
                    	
										
											<?php echo form_open(base_url() . 'teacher/student_marksheet_subject/'. $exam_id . '/' . $class_id);?>
										<tr>
											<td>
												<?php echo $student_selected_with_class['name'];?>
											</td>
											<td>
												<input type="text" class="class_score1 form-control" value="<?php echo $general_select['class_score1'];?>" 
												name="class_score1_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change1()">
											</td>
											<td>
												<input type="text" class="class_score2 form-control" value="<?php echo $general_select['class_score2'];?>" 
												name="class_score2_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change2()">
											</td>
											<td>
												<input type="text" class="class_score3 form-control" value="<?php echo $general_select['class_score3'];?>" 
												name="class_score3_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change3()">
											</td>
											<td>
												<input type="text" class="class_score4 form-control" value="<?php echo $general_select['class_score4'];?>" 
												name="class_score4_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change4()">
											</td>
											<td>
												<input type="text" class="class_score5 form-control" value="<?php echo $general_select['class_score5'];?>" 
												name="class_score5_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change5()">
											</td>
											<td>
												<input type="text" value="<?php echo $general_select['ca1_comment'];?>" 
												name="ca1_comment_<?php echo $student_selected_with_class['subject_id'];?>" class="form-control">																
											</td>
											
											
											
											
											<td>
												<input type="text" class="class_score11 form-control" value="<?php echo $general_select['class_score11'];?>" 
												name="class_score11_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change11()">
											</td>
											<td>
												<input type="text" class="class_score22 form-control" value="<?php echo $general_select['class_score22'];?>" 
												name="class_score22_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change22()">
											</td>
											<td>
												<input type="text" class="class_score33 form-control" value="<?php echo $general_select['class_score33'];?>" 
												name="class_score33_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change33()">
											</td>
											<td>
												<input type="text" class="class_score44 form-control" value="<?php echo $general_select['class_score44'];?>" 
												name="class_score44_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change44()">
											</td>
											<td>
												<input type="text" class="class_score55 form-control" value="<?php echo $general_select['class_score55'];?>" 
												name="class_score55_<?php echo $student_selected_with_class['student_id'];?>" onchange="class_score_change55()">
											</td>
											<td>
												<input type="text" value="<?php echo $general_select['ca2_comment'];?>" 
												name="ca2_comment_<?php echo $student_selected_with_class['subject_id'];?>" class="form-control">																
											</td>
											
											
											
											  <td>
												<input type="text" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" 
												name="exam_score_<?php echo $student_selected_with_class['student_id'];?>" onchange="exam_score_change()">
											  </td>
			
											<td>
												<input type="text" value="<?php echo $general_select['comment'];?>" 
												name="comment_<?php echo $student_selected_with_class['student_id'];?>" class="form-control">
											</td>
												<input type="hidden" name="mark_id_<?php echo $student_selected_with_class['student_id'] ;?>" 
												value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
										</tr>

										<?php  endforeach; endforeach;?>
									</tbody>
							   </table>
							   <button type="submit" class="btn btn-sm btn-rounded btn-block btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
							   <?php echo form_close();?>
							   
						<script>				  
							function class_score_change1() {
							  var class_scores = document.getElementsByClassName('class_score1');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 2) {
										class_scores[i].value = 0;
											$('#error_message1').show();
									}
								}
							}
							
							function class_score_change2() {
							  var class_scores = document.getElementsByClassName('class_score2');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message2').show();
									}
								}
							}
							
							function class_score_change3() {
							  var class_scores = document.getElementsByClassName('class_score3');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message3').show();
									}
								}
							}
							
							function class_score_change4() {
							  var class_scores = document.getElementsByClassName('class_score4');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message4').show();
									}
								}
							}
							
							function class_score_change5() {
							  var class_scores = document.getElementsByClassName('class_score5');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 15) {
										class_scores[i].value = 0;
											$('#error_message5').show();
									}
								}
							}
							
							
							
							
							
							
							function class_score_change11() {
							  var class_scores = document.getElementsByClassName('class_score11');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 2) {
										class_scores[i].value = 0;
											$('#error_message11').show();
									}
								}
							}
							
							function class_score_change22() {
							  var class_scores = document.getElementsByClassName('class_score22');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message22').show();
									}
								}
							}
							
							function class_score_change33() {
							  var class_scores = document.getElementsByClassName('class_score33');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message33').show();
									}
								}
							}
							
							function class_score_change44() {
							  var class_scores = document.getElementsByClassName('class_score44');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 1) {
										class_scores[i].value = 0;
											$('#error_message44').show();
									}
								}
							}
							
							function class_score_change55() {
							  var class_scores = document.getElementsByClassName('class_score55');
								for (var i = class_scores.length - 1; i >= 0; i--) {
								  var value = class_scores[i].value;
									if (value > 15) {
										class_scores[i].value = 0;
											$('#error_message55').show();
									}
								}
							}
							
							
							
							
							
							
							
							 
							
							function exam_score_change() {
							  var exam_scores = document.getElementsByClassName('exam_score');
								for (var i = exam_scores.length - 1; i >= 0; i--) {
								  var value = exam_scores[i].value;
									if (value > 60) {
										exam_scores[i].value = 0;
											$('#exam_score').show();
									}
								}
							}
						</script>
							   
					<?php endif;?>	
					
					
            
			</div>
        </div>
	</div>
 </div>

<?php endif;?>


<script type="text/javascript">
    function show_subjects(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('subject_id_'+i).style.display = 'none' ;
                    document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('subject_id_'+class_id).style.display = 'block' ;
        document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
        var subject_id = $(".subject_id");
        for(var i = 0; i < subject_id.length; i++)
            subject_id[i].selected = "";
    }
	
	
	function get_class_subject1(class_id){
		$.ajax({
			url:        '<?php echo base_url();?>teacher/get_class_subject/' + class_id,
			success:    function(response){
				jQuery('#subject_selector_holder1').html(response);
			} 
	
		});
	}
	
</script>