<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('view_student_scores');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/tabulation_sheet' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
					
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('Running Session');?></label>
							<div class="col-sm-12">
								<?php $session = get_settings('session')?>
								<select name="session" class="form-control select2" >
									  <?php for($i = 0; $i < 10; $i++):?>
										  <option value="<?php echo (2020+$i);?>-<?php echo (2020+$i+1);?>"
											<?php if($session == (2020+$i).'-'.(2020+$i+1)) echo 'selected';?>>
											  <?php echo (2020+$i);?>-<?php echo (2020+$i+1);?>
										  </option>
									  <?php endfor;?>
								 </select>
							</div>
						</div>
						
						<?php
							if($term == '')
							$term = get_settings('term');
							else
							$term  = $term;
						?>
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('select_current_term');?></label>
							<div class="col-sm-12">
								<select name="term" class="form-control">
									<option value="1" <?php if ($term == '1') echo 'selected';?>> First Term</option>
									<option value="2" <?php if ($term == '2') echo 'selected';?>> Second Term</option>
									<option value="3" <?php if ($term == '3') echo 'selected';?>> Third Term</option>
								</select>
							</div>
						</div>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_exam');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <?php 
										$this->db->order_by('exam_id', 'desc');  
										$exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>>
										<?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>
                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>
										Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
                            <div class="form-group">
								<label class="col-md-12" for="example-text"><?php echo get_phrase('select_student');?></label>
                                	<div class="col-sm-12">
									<?php $classes = $this->crud_model->get_classes();
											foreach ($classes as $key => $row): ?>
										<select name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>"
										 style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
											<option value="">Select student in <?php echo $row['name'] ;?></option>
											<?php $students = $this->crud_model->get_students($row['class_id']);
											foreach ($students as $key => $student): ?>
											<option value="<?php echo $student['student_id'];?>"
											<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?>>
											<?php echo $student['name'];?></option>
											<?php endforeach;?>
										</select>
									<?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    </select>
                                </div>
                            </div>
							
							
                            <div class="form-group">
								<label class="col-md-12" for="example-text"><?php echo get_phrase('class_section');?></label>
                                <div class="col-sm-12">
									<select name="section_id" class="form-control" id="section_selector_holder" / required>
										<option value=""><?php echo get_phrase('select_section');?></option>
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
</div>


<?php if ($class_id != '' && $exam_id != '' && $student_id != ''):?>
    <div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
            
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('student_score_for'); ?> : 
			<?php echo $this->crud_model->get_type_name_by_id('student', $student_id);?>
				
				<?php if(get_settings('report_template') == 1):?>	
				<span class="pull-right">
                        <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/student_comment/<?=$student_id;?>')"
						 class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-plus"></i> <?=get_phrase('enter_remarks_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></a>
				</span>
				<?php endif;?>
				
				<?php if(get_settings('report_template') == 'udemy'):?>	
				<span class="pull-right">
                        <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/student_comment_udemy/<?=$class_id.'-'.$exam_id.'-'.$student_id;?>')"
						 class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-plus"></i> <?=get_phrase('enter_remarks_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></a>
				</span>
				<?php endif;?>
				
				<?php if(get_settings('report_template') == 'gate'):?>	
				<span class="pull-right">
                        <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/student_comment_gate/<?=$class_id.'-'.$exam_id.'-'.$student_id;?>')"
						 class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-plus"></i> <?=get_phrase('enter_remarks_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></a>
				</span>
				<?php endif;?>
				
				<?php if(get_settings('report_template') == 'diamond'):?>	
				<span class="pull-right">
                        <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/diamond_stu_comment/<?=$class_id.'-'.$exam_id.'-'.$student_id;?>')"
						 class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-plus"></i> <?=get_phrase('enter_remarks_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></a>
				</span>
				<?php endif;?>
				
				
				
				
				<?php if(get_settings('report_template') == 'tanzania'):?>	
				<span class="pull-right">
                        <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/tanzania_student_comment/<?=$class_id.'-'.$exam_id.'-'.$student_id;?>')"
						 class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-plus"></i> <?=get_phrase('enter_remarks_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></a>
				</span>
				<?php endif;?>
			</div>
                <div class="panel-body table-responsive">
				
				
				<?php if($report_template == 'tanzania' || $report_template == 1 || $report_template == 2) : ?>
	   
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td><?php echo get_phrase('continous_assessment');?></td>
										<td><?php echo get_phrase('exam score');?></td>
                                        <td><?php echo get_phrase('total_score');?></td>
										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

										<?php $select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
											foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student): 
								
												$verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 
												'student_id' 	=> $student_id, 
												'session' 		=> $session,
												'term' 			=> $term,
												'subject_id' 	=> $class_subject_exam_student['subject_id']);
												
												$query = $this->db->get_where('mark', $verify_data);
												$update_subject_marks = $query->result_array();
								
												foreach ($update_subject_marks as $key => $general_select):
								
													$sum_all_classes_and_exam_score = $general_select['class_score1'] + $general_select['exam_score'];
										   ?>
										   
										<tr>
											<td><?php echo $class_subject_exam_student['name'];?></td>
											<td><?php echo $general_select['class_score1'];?></td>
											<td><?php echo $general_select['exam_score'];?></td>
											<td><?php echo $sum_all_classes_and_exam_score;?></td>
											<td><?php echo $general_select['comment'];?></td>
										</tr>

								<?php endforeach;endforeach;?>                 	
                    	</tbody>
               	</table>  
				<?php endif;?>
				
				
				
				<?php if($report_template == 'udemy') : ?>
				
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td>CA 1 (20%)</td>
										<td>CA 2 (20%)</td>
										<td><?php echo get_phrase('exam_score');?> (60%)</td>
										<td><?php echo get_phrase('total_score');?></td>
										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

										<?php $select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
											foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student): 
								
												$verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 
												'student_id' 	=> $student_id, 
												'session' 		=> $session,
												'term' 			=> $term,
												'subject_id' 	=> $class_subject_exam_student['subject_id']);
												
												$query = $this->db->get_where('mark', $verify_data);
												$update_subject_marks = $query->result_array();
								
												foreach ($update_subject_marks as $key => $general_select):
								
													$sum_all_classes_and_exam_score = $general_select['class_score1'] + $general_select['exam_score'];
										   ?>
										   
										<tr>
											<td><?php echo $class_subject_exam_student['name'];?></td>
											<td><?php echo $general_select['class_score1'];?></td>
											<td><?php echo $general_select['class_score2'];?></td>
											<td><?php echo $general_select['exam_score'];?></td>
											<td><?php echo $sum_all_classes_and_exam_score;?></td>
											<td><?php echo $general_select['comment'];?></td>
										</tr>

								<?php endforeach;endforeach;?>                 	
                    	</tbody>
               	</table> 
				<?php endif;?>
				
				
				
				
							<?php if($report_template == 'gate') : ?>
						   
								   <table class="table table-bordered">
									   <thead>
										<tr>
											<td style="text-align: center;">SUBJECT</td>
											<td style="text-align: center;">CA1(20%)</td>
											<td style="text-align: center;">CA2(20%)</td>
											<td style="text-align: center;">CA3(20%)</td>
											<td style="text-align: center;">EXAM(40%)</td>
											<td style="text-align: center;">TOTAL SCORE</td>
											<td style="text-align: center;">AVERAGE</td>
											<td style="text-align: center;">COMMENT</td>
										</tr>
									</thead>
									<tbody>
										<?php 
											$total_marks = 0;
											$total_grade_point = 0;
											$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
											foreach ($subjects as $row3):
										?>
										<tr>
											<td style="text-align: center;"><?php echo $row3['name'];?></td>
											<td style="text-align: center;">
											
											<?php
													$obtained_mark_query = $this->db->get_where('mark' , array(
																'subject_id' => $row3['subject_id'],
																	'exam_id' => $exam_id,
																		'class_id' => $class_id,
																			'session' => $session,
																				'term' => $term,
																					'student_id' => $student_id));
													if ( $obtained_mark_query->num_rows() > 0) {
														$marks = $obtained_mark_query->result_array();
														foreach ($marks as $row4) {
														
															$obtained_class_score = $row4['class_score1'];												
														echo $obtained_class_score;
														}
													}
												?>
											
											</td>
											<td style="text-align: center;">
											
											
											<?php
													$obtained_mark_query = $this->db->get_where('mark' , array(
																'subject_id' => $row3['subject_id'],
																	'exam_id' => $exam_id,
																		'class_id' => $class_id,
																			'session' => $session,
																				'term' => $term,
																					'student_id' => $student_id));
													if ( $obtained_mark_query->num_rows() > 0) {
														$marks = $obtained_mark_query->result_array();
														foreach ($marks as $row4) {
															
															$obtained_class_score2 = $row4['class_score2'];												
														echo $obtained_class_score2;
															
														}
													}
												?>
											
											
											</td>
											
											<td style="text-align: center;">
											
											
											<?php
													$obtained_mark_query = $this->db->get_where('mark' , array(
																'subject_id' => $row3['subject_id'],
																	'exam_id' => $exam_id,
																		'class_id' => $class_id,
																			'session' => $session,
																				'term' => $term,
																					'student_id' => $student_id));
													if ( $obtained_mark_query->num_rows() > 0) {
														$marks = $obtained_mark_query->result_array();
														foreach ($marks as $row4) {
															
															$obtained_class_score3 = $row4['class_score3'];												
														echo $obtained_class_score3;
															
														}
													}
												?>
											
											
											</td>
											
											
											
											<td style="text-align: center;">
											
											<?php
													$exam_score_query = $this->db->get_where('mark' , array(
																'subject_id' => $row3['subject_id'],
																	'exam_id' => $exam_id,
																		'class_id' => $class_id,
																			'session' => $session,
																				'term' => $term,
																					'student_id' => $student_id));
													if ( $exam_score_query->num_rows() > 0) {
														$marks = $exam_score_query->result_array();
														foreach ($marks as $row4) {
														
														$obtained_exam_score = $row4['exam_score'];												
														echo $obtained_exam_score;
															
														}
													}
												?>
											
											
											</td>
										   
											<td style="text-align: center;">
									  <?php echo ($obtained_class_score + $obtained_class_score2 + $obtained_class_score3 + $obtained_exam_score);?>
											</td>
											<td style="text-align: center;">
												
												<?php 
													$a = $obtained_class_score;
													$b = $obtained_class_score2;
													$c = $obtained_class_score3;
													$d = $obtained_exam_score;
													
													$sum = $a + $b + $c + $d;
													$average = $sum/4;
													
													echo $average; 
												?>
											</td>
											<td style="text-align: center;"><?php echo $row4['comment'];?></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							   </table>
					
					<?php endif;?> 	
				
				
				
				
					<?php if($report_template == 'diamond') : ?>
					

				
    					<table cellpadding="0" cellspacing="0" border="1" class="table">
								<thead>
									<tr bordercolordark="#000000; 1px solid">
										<td>&nbsp;</td>
										<td colspan="5"><div align="center"><strong>CA 1</strong></div></td>
										<td colspan="7"><div align="center"><strong>CA 2 </strong></div></td>
										<td colspan="7"><div align="center"><strong>EXAM </strong></div></td>
									</tr>
									<tr>
										<td>SUBJECT</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Class Works (2 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Home Work (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Classnote (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Project (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Test1 (15 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">CA1 Comment</td>
										
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Class Work (2 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Home Work (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Classnote (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Project (1 Mark)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Test2 (15 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">CA2 Comment</td>
										
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Exam Score (60 Marks)</td>
										<td style="writing-mode:vertical-lr;transform:rotate(180deg)">Exam Comment</td>
									</tr>
								</thead>
                    				<tbody>

										<?php $select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
											foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student): 
								
												$verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 
												'student_id' 	=> $student_id, 
												'session' 		=> $session,
												'term' 			=> $term,
												'subject_id' 	=> $class_subject_exam_student['subject_id']);
												
												$query = $this->db->get_where('mark', $verify_data);
												$update_subject_marks = $query->result_array();
								
												foreach ($update_subject_marks as $key => $general_select):
								
													$sum_all_classes_and_exam_score = $general_select['class_score1'] + $general_select['exam_score'];
										   ?>
										   
										<tr>
											<td><?php echo $class_subject_exam_student['name'];?></td>
											<td align="right"><?php echo $general_select['class_score1'];?></td>
											<td align="right"><?php echo $general_select['class_score2'];?></td>
											<td align="right"><?php echo $general_select['class_score3'];?></td>
											<td align="right"><?php echo $general_select['class_score4'];?></td>
											<td align="right"><?php echo $general_select['class_score5'];?></td>
											<td align="right"><?php echo $general_select['ca1_comment'];?></td>
											
											<td align="right"><?php echo $general_select['class_score11'];?></td>
											<td align="right"><?php echo $general_select['class_score22'];?></td>
											<td align="right"><?php echo $general_select['class_score33'];?></td>
											<td align="right"><?php echo $general_select['class_score44'];?></td>
											<td align="right"><?php echo $general_select['class_score55'];?></td>
											<td align="right"><?php echo $general_select['ca2_comment'];?></td>
											
											<td align="right"><?php echo $general_select['exam_score'];?></td>
											<td align="right"><?php echo $general_select['comment'];?></td>
										</tr>

								<?php endforeach;endforeach;?>                 	
                    	</tbody>
               	</table> 
				<?php endif;?>
				

			
	<style>
		.alert-red{
			background-color: red;
			color:white;
		}
	</style>
			
			<!--
			<div class="alert alert-red">Note that, if you click on generate mass report card button below, it will display students' report cards based on the term selected in system settings 
				<a href="<?php echo base_url()?>systemsetting/system_settings" style="color:white"><i class="fa fa-arrow-right"></i> HERE</a>
			</div>
			-->
			<br>
				
				<div align="right">
				<?php if(get_settings('report_template') == 1):?>	
               <a href="<?php echo base_url(). 'admin/printResultSheet/' . $student_id . '/' . $exam_id; ?>" >
			   		<button class="btn btn-info btn-rounded btn-sm"><i class="fa fa-print"></i> <?=get_phrase('print_report_card_for') .' '. $this->crud_model->get_type_name_by_id('student', $student_id); ?></button>
			   </a>
			   <?php endif;?>
			   
			   <?php if($report_template == 'tanzania' || $report_template == 1 || $report_template == 2) : ?>
			   <?php if($general_select['class_score1'] != "") : ?>
               <a href="<?php echo base_url(). 'admin/print_mass_report_card/' . $class_id . '/' . $exam_id . '/' .$session . '/' . $term . '/' . $section_id; ?>" >
			   		<button class="btn btn-success btn-rounded btn-sm"><i class="fa fa-print"></i> <?php echo get_phrase('generate_mass_report_card');?></button>
			   </a>
			   <?php endif;?>
			   <?php endif;?>
			   
               <a href="<?php echo base_url(). 'admin/print_mass_report_card/' . $class_id . '/' . $exam_id . '/' .$session . '/' . $term . '/' . $section_id; ?>" >
			   		<button class="btn btn-success btn-rounded btn-sm"><i class="fa fa-print"></i> <?php echo get_phrase('generate_mass_report_card');?></button>
			   </a>
			   
			   </div>
			   
			   
			</div>
        </div>
	</div>
 </div>

<?php endif;?>


<script type="text/javascript">
    function show_students(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('student_id_'+i).style.display = 'none' ;
                    document.getElementById('student_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('student_id_'+class_id).style.display = 'block' ;
        document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
        var student_id = $(".student_id");
        for(var i = 0; i < student_id.length; i++)
            student_id[i].selected = "";
			
			
			
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_section/' + class_id,
        success:    function(response){
            jQuery('#section_selector_holder').html(response);
        } 

    });			
			
			
			
    }
</script>


