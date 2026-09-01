<?php 
$this->db->select_sum('due');
$this->db->from('invoice');
$this->db->where('student_id', $this->session->userdata('student_id'));
$query = $this->db->get();
$due_amount = $query->row()->due;
?>



<?php if($due_amount > 0) : ?>


			<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-danger">
                            <div class="panel-heading"> <i class="fa fa-times"></i>&nbsp;NOTIFICATION</div>
                                <div class="panel-body table-responsive">
								
								<h2 align="center">DEAR <strong><?=$this->db->get_where('student' , array('student_id' => $this->session->userdata('login_user_id')))->row()->name;?></strong> YOU HAVE PENDING INVOICE(S). PLEASE PAY ALL YOUR PENDING INVOICE(S) TO VIEW AND PRINT YOUR REPORT CARD</h2>
								
								
								</div>
							</div>
						</div>
					</div>
				

<?php endif;?>

<?php if($due_amount == 0) : ?>

<?php 
   /* 
		$student_info  = $this->db->get_where('student' , array('student_id' => $this->session->userdata('login_user_id')))->result_array();
		$exams         = $this->crud_model->get_exams();
		foreach ($student_info as $row1):
		foreach ($exams as $row2):
	*/
?>
  
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
				<div class="panel-body table-responsive">
				
                	<?php echo form_open(base_url() . 'student/student_marksheet' , array('class' => 'form-horizontal','enctype' => 'multipart/form-data'));?>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" style="margin-bottom: 5px;">
									<?php echo get_phrase('select_session'); ?>
								</label>
								<?php $session = get_settings('session')?>
									<select name="session" class="form-control" >
										<?php for($i = 0; $i < 5; $i++):?>
											<option value="<?php echo (2020+$i);?>-<?php echo (2020+$i+1);?>"
												<?php if($session == (2020+$i).'-'.(2020+$i+1)) echo 'selected';?>><?php echo (2020+$i);?>-<?php echo (2020+$i+1);?>
											</option>
										<?php endfor;?>
									</select>
							 </div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label" style="margin-bottom: 5px;">
									<?php echo get_phrase('select_term'); ?>
								</label>
								<?php
									if($term == '')
									$term = get_settings('term');
									else
									$term  = $term;
								?>
									<select name="term" class="form-control">
										<option value=""><?php echo get_phrase('select_term');?></option>
										<option value="1" <?php if ($term == '1') echo 'selected';?>> First Term</option>
										<option value="2" <?php if ($term == '2') echo 'selected';?>> Second Term</option>
										<option value="3" <?php if ($term == '3') echo 'selected';?>> Third Term</option>
									</select>
							 </div>
						</div>
						
						
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" style="margin-bottom: 5px;">
									<?php echo get_phrase('select_exam'); ?>
								</label>
                                <select name="exam_id" class="form-control">
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
						
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('select_class'); ?></label>
                                 <select name="class_id"  class="form-control">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>
										Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>
							 </div>
						</div>

					<div class="col-md-2" style="margin-top: 30px;">
						<button type="submit" class="btn btn-info btn-sm btn-rounded" style="width: 100%;">
						<i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('get_exam'); ?></button>
					</div>	
				<input class="" type="hidden" value="selection" name="operation">
			</form>
			
			<?php if ($exam_id != '' && $class_id != '' && $student_id != '' && $session != '' && $term != ''):?>						
								
					
							<?php if($report_template == 'udemy') : ?>
						   
								   <table class="table table-bordered">
									   <thead>
										<tr>
											<td style="text-align: center;">SUBJECT</td>
											<td style="text-align: center;">CA1(20%)</td>
											<td style="text-align: center;">CA2(20%)</td>
											<td style="text-align: center;">EXAM SCORE(60%)</td>
											<td style="text-align: center;">TOTAL SCORE(100%)</td>
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
									  		<?php echo ($obtained_class_score + $obtained_class_score2 + $obtained_exam_score);?>
											</td>
											
											<td style="text-align: center;"><?php echo $row4['comment'];?></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							   </table>
					
					<?php endif;?> 
					
				  	<?php if($exam_id != "") : ?>
						<a href="<?php echo base_url(). 'student/printResultSheet/' . $class_id . '/' . $exam_id . '/' .$session . '/' . $term . '/' . $student_id; ?>"
							class="btn btn-success btn-rounded btn-sm pull-right" style="color:white">
							<i class="fa fa-print"></i>&nbsp;<?php echo get_phrase('print_report_card');?>
						</a>
					<?php endif;?> 
					
					
				<?php endif;?> 	
					
					
							
		
			</div>
		</div>
	</div>
</div>

<?php //endforeach; endforeach; ?>
<?php endif;?> 
