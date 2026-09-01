<style>

hr.style1{
	border-top: 1px solid #8c8b8b;
}


hr.style2 {
	border-top: 3px double #8c8b8b;
}

hr.style3 {
	border-top: 1px dashed #8c8b8b;
}

@media print {
	table, table tr, table td {
		border-top: #000 solid 1px;
		border-bottom: #000 solid 1px;
		border-left: #000 solid 1px;
		border-right: #000 solid 1px;
		border-collapse: collapse;
	}
	.pagebreak {page-break-before:always;}
} 


</style>
<div class="row">
  <div class="col-sm-12">
  	<div class="panel"> 
  		<div class="table-responsive ">
		
		<div class="printableArea">
		<div class="print" style="border:1px solid #000; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px;">
		
    <?php
	$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
    $select_student_from_model = $this->db->get_where('student', array('student_id'   => $student_id))->result_array();
    foreach($select_student_from_model as $key => $student_selected):

        $student_id = $student_selected['student_id'];
        $student_roll = $student_selected['roll'];
        $student_sex = $student_selected['sex'];
        $student_name = $student_selected['name'];
		$number_class = $this->db->get_where('student', array('class_id' =>$class_id))->num_rows();
		$ReturnTeacherSub = $this->db->get_where('subject', array('class_id' => $class_id))->row_array();
		
		$term =  get_settings('term');
		$session =  get_settings('session');
		$select = $this->db->get_where('prekg', array('student_id' => $student_selected['student_id'], 'session' => $session, 'term' => $term))->row();


        $total_marks        =   0;
        $total_class_score  =   0;
        $total_grade_point  =   0;
    ?>
	
			
			<?php if($term == 1) : ?>
				<table width="100%">
				  <tr>
					<td class="pull-left"><img src="<?php echo base_url()?>uploads/logo.png"  height="150" width="150"></td>
					<td>
						<h2 align="center"><?php echo get_settings('system_name')?></h2>
						<p align="center"><?php echo get_settings('address')?> <br/>
						<i class="fa fa-envelope"></i> <?php echo get_settings('system_email')?> : <i class="fa fa-phone"></i> <?php echo get_settings('phone')?></p>	
					</td>
					<td class="pull-right"><img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="150" width="150"></td>
				  </tr>		
				</table>
				
								
				<table width="100%" height="100" border="1">
				  <tr>
					<td width="150"><strong>PUPIL'S NAME:</strong></td>
					<td width="204"><?=$student_selected['name'];?></td>
					<td width="78"><strong>CLASS:</strong></td>
					<td width="168"><?=$class_name;?></td>
					<td><strong>TERM:</strong></td>
					<td><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
				  </tr>
				  <tr>
					<td><strong>ADMISSION NO:</strong></td>
					<td><?=$student_selected['roll'];?></td>
					<td><strong>SEX:</strong></td>
					<td><?=ucwords($student_selected['sex']);?></td>
					<td width="154"><strong>SESSION:</strong></td>
					<td width="198"><?=get_settings('session')?></td>
				  </tr>
				  <tr>
					<td><strong>NEXT TERM BEGINS:</strong></td>
					<td><?=get_settings('next_term_begin')?></td>
					<td><strong>ATTENDANCE:</strong></td>
					<td></td>
					<td><strong>TIME PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				
				<div class="row">
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
							<table width="100%"  border="1">
							<tr>
							<!--<td width="" valign="top"><strong>ID</strong></td>  -->
							<td width="61%" valign="top"><strong><?php echo $subject['name'];?></strong></td>          
							<td width="13%" valign="top">T1</td>
							<td width="13%" valign="top">T2</td>
							<td width="13%" valign="top">T3</td>
							</tr>
							<?php 
								$sele_prekg = $this->db->get_where('prekg', array('subject_id' => $subject['subject_id'], 'class_id' => $class_id, 'term' => 1, 'student_id' => $student_id, 'exam_id' => $exam_id))->result_array();
								foreach ($sele_prekg as $key => $sele):
							?>
							<?php
							$results    = json_decode($sele['results']);
							$i = 1; foreach ($results as $result) { ?>
							
							<tr>
							<!--<td width="" valign="top"><?php echo $i++; ?></td> -->  
							<td width="61%" valign="top"><?php echo $result->score_name; ?></td>          
							<td width="13%" valign="top"><?php echo $result->score_grade; ?></td>
							<td width="13%" valign="top">&nbsp;</td>
							<td width="13%" valign="top">&nbsp;</td>
							</tr>
							
						   
									   
													
							<?php } ?>
							<?php endforeach;?>
							</table>
                          </div>
                      </div>
				  </div>
					<?php endforeach;?>
                </div>
				
				<table width="100%" height="100" border="1" style="font-size:12px">
				  <tr>
					<td colspan="3" bgcolor="#CCCCCC"><strong>COMMENTS</strong></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>ABBREVIATIONS</strong></td>
			      </tr>
				  <tr>
					<td width="169"><strong>CLASS TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->class_teacher_comment;?></td>
					<td colspan="2">I.C.T - Information &amp; Communication Technology.</td>
				  </tr>
				  <tr>
					<td><strong>HEAD TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->head_teacher_comment;?></td>
					<td colspan="2">EPL - Exercises on Practical Life. </td>
				  </tr>
				  <tr>
				    <td colspan="3" bgcolor="#CCCCCC"><strong>BEHAVIOUR/SPECIAL AREA MARKING KEY (5) </strong></td>
				    <td colspan="2">ITS - Introduction to Sensory </td>
			      </tr>
				  <tr>
				    <td colspan="2">C</td>
				    <td width="565">&nbsp;<?=$select->consistently;?></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>STANDARD BASED GRADING SKILLS </strong></td>
			      </tr>
				  <tr>
				    <td colspan="2">M</td>
				    <td>&nbsp;<?=$select->most_of_the_time;?></td>
				    <td width="64">LEVEL 4 </td>
				    <td width="460">Exceeds Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="2">N</td>
				    <td>&nbsp;<?=$select->needs_improvement;?></td>
				    <td>LEVEL 3 </td>
				    <td>Meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="3" rowspan="3">&nbsp;</td>
				    <td>LEVEL 2 </td>
				    <td>Partially meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>LEVEL 1 </td>
				    <td>Does not  meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>SP</td>
				    <td>Satisfactory progress but below grade level. </td>
			      </tr>
				</table>
				
				<?php endif;?>
				<div class="pagebreak"> </div>
				
				
				<?php if($term == 2) : ?>
				<table width="100%">
				  <tr>
					<td class="pull-left"><img src="<?php echo base_url()?>uploads/logo.png"  height="150" width="150"></td>
					<td>
						<h2 align="center"><?php echo get_settings('system_name')?></h2>
						<p align="center"><?php echo get_settings('address')?> <br/>
						<i class="fa fa-envelope"></i> <?php echo get_settings('system_email')?> : <i class="fa fa-phone"></i> <?php echo get_settings('phone')?></p>	
					</td>
					<td class="pull-right"><img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="150" width="150"></td>
				  </tr>		
				</table>
				
								
				<table width="100%" height="100" border="1">
				  <tr>
					<td width="150"><strong>PUPIL'S NAME:</strong></td>
					<td width="204"><?=$student_selected['name'];?></td>
					<td width="78"><strong>CLASS:</strong></td>
					<td width="168"><?=$class_name;?></td>
					<td><strong>TERM:</strong></td>
					<td><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
				  </tr>
				  <tr>
					<td><strong>ADMISSION NO:</strong></td>
					<td><?=$student_selected['roll'];?></td>
					<td><strong>SEX:</strong></td>
					<td><?=ucwords($student_selected['sex']);?></td>
					<td width="154"><strong>SESSION:</strong></td>
					<td width="198"><?=get_settings('session')?></td>
				  </tr>
				  <tr>
					<td><strong>NEXT TERM BEGINS:</strong></td>
					<td><?=get_settings('next_term_begin')?></td>
					<td><strong>ATTENDANCE:</strong></td>
					<td></td>
					<td><strong>TIME PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				
				<div class="row">
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					
					<div class="col-md-6">
						<div class="card">
							<table width="100%"  border="1">
							<tr>
							<!--<td width="" valign="top"><strong>ID</strong></td>  -->
							<td width="61%" valign="top"><strong><?php echo $subject['name'];?></strong></td>          
							<td width="13%" valign="top">T1</td>
							<td width="13%" valign="top">T2</td>
							<td width="13%" valign="top">T3</td>
							</tr>
							<?php 
								$sele_prekg = $this->db->get_where('prekg', array('subject_id' => $subject['subject_id'], 'class_id' => $class_id, 'term' => 2, 'student_id' => $student_id, 'exam_id' => $exam_id))->result_array();
								foreach ($sele_prekg as $key => $sele):
							?>
							<?php
							$results    = json_decode($sele['results']);
							$i = 1; foreach ($results as $result) { ?>
							
							<tr>
							<!--<td width="" valign="top"><?php echo $i++; ?></td> -->  
							<td width="61%" valign="top"><?php echo $result->score_name; ?></td>          
							<td width="13%" valign="top">&nbsp;</td>
							<td width="13%" valign="top"><?php echo $result->score_grade; ?></td>
							<td width="13%" valign="top">&nbsp;</td>
							</tr>
							
						   
									   
													
							<?php } ?>
							<?php endforeach;?>
							</table>
                          </div>
				  </div>
					<?php endforeach;?>
                </div>
				
				<table width="100%" height="100" border="1" style="font-size:12px">
				  <tr>
					<td colspan="3" bgcolor="#CCCCCC"><strong>COMMENTS</strong></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>ABBREVIATIONS</strong></td>
			      </tr>
				  <tr>
					<td width="169"><strong>CLASS TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->class_teacher_comment;?></td>
					<td colspan="2">I.C.T - Information &amp; Communication Technology.</td>
				  </tr>
				  <tr>
					<td><strong>HEAD TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->head_teacher_comment;?></td>
					<td colspan="2">EPL - Exercises on Practical Life. </td>
				  </tr>
				  <tr>
				    <td colspan="3" bgcolor="#CCCCCC"><strong>BEHAVIOUR/SPECIAL AREA MARKING KEY (5) </strong></td>
				    <td colspan="2">ITS - Introduction to Sensory </td>
			      </tr>
				  <tr>
				    <td colspan="2">C</td>
				    <td width="565">&nbsp;<?=$select->consistently;?></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>STANDARD BASED GRADING SKILLS </strong></td>
			      </tr>
				  <tr>
				    <td colspan="2">M</td>
				    <td>&nbsp;<?=$select->most_of_the_time;?></td>
				    <td width="64">LEVEL 4 </td>
				    <td width="460">Exceeds Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="2">N</td>
				    <td>&nbsp;<?=$select->needs_improvement;?></td>
				    <td>LEVEL 3 </td>
				    <td>Meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="3" rowspan="3">&nbsp;</td>
				    <td>LEVEL 2 </td>
				    <td>Partially meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>LEVEL 1 </td>
				    <td>Does not  meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>SP</td>
				    <td>Satisfactory progress but below grade level. </td>
			      </tr>
				</table>
				
				
				<?php endif;?>
				<div class="pagebreak"> </div>
				
				
				<?php if($term == 3) : ?>
				<table width="100%">
				  <tr>
					<td class="pull-left"><img src="<?php echo base_url()?>uploads/logo.png"  height="150" width="150"></td>
					<td>
						<h2 align="center"><?php echo get_settings('system_name')?></h2>
						<p align="center"><?php echo get_settings('address')?> <br/>
						<i class="fa fa-envelope"></i> <?php echo get_settings('system_email')?> : <i class="fa fa-phone"></i> <?php echo get_settings('phone')?></p>	
					</td>
					<td class="pull-right"><img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="150" width="150"></td>
				  </tr>		
				</table>
				
								
				<table width="100%" height="100" border="1">
				  <tr>
					<td width="150"><strong>PUPIL'S NAME:</strong></td>
					<td width="204"><?=$student_selected['name'];?></td>
					<td width="78"><strong>CLASS:</strong></td>
					<td width="168"><?=$class_name;?></td>
					<td><strong>TERM:</strong></td>
					<td><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
				  </tr>
				  <tr>
					<td><strong>ADMISSION NO:</strong></td>
					<td><?=$student_selected['roll'];?></td>
					<td><strong>SEX:</strong></td>
					<td><?=ucwords($student_selected['sex']);?></td>
					<td width="154"><strong>SESSION:</strong></td>
					<td width="198"><?=get_settings('session')?></td>
				  </tr>
				  <tr>
					<td><strong>NEXT TERM BEGINS:</strong></td>
					<td><?=get_settings('next_term_begin')?></td>
					<td><strong>ATTENDANCE:</strong></td>
					<td></td>
					<td><strong>TIME PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				
				<div class="row">
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					
					<div class="col-md-6">
						<div class="card">
							<div class="card-block">
							<table width="100%"  border="1">
							<tr>
							<!--<td width="" valign="top"><strong>ID</strong></td>  -->
							<td width="61%" valign="top"><strong><?php echo $subject['name'];?></strong></td>          
							<td width="13%" valign="top">T1</td>
							<td width="13%" valign="top">T2</td>
							<td width="13%" valign="top">T3</td>
							</tr>
							<?php 
								$sele_prekg = $this->db->get_where('prekg', array('subject_id' => $subject['subject_id'], 'class_id' => $class_id, 'term' => 3, 'student_id' => $student_id, 'exam_id' => $exam_id))->result_array();
								foreach ($sele_prekg as $key => $sele):
							?>
							<?php
							$results    = json_decode($sele['results']);
							$i = 1; foreach ($results as $result) { ?>
							
							<tr>
							<!--<td width="" valign="top"><?php echo $i++; ?></td> -->  
							<td width="61%" valign="top"><?php echo $result->score_name; ?></td>          
							<td width="13%" valign="top">&nbsp;</td>
							<td width="13%" valign="top">&nbsp;</td>
							<td width="13%" valign="top"><?php echo $result->score_grade; ?></td>
							</tr>
							
						   
									   
													
							<?php } ?>
							<?php endforeach;?>
							</table>
                          </div>
                      </div>
				  </div>
					<?php endforeach;?>
                </div>
				<table width="100%" height="100" border="1" style="font-size:12px">
				  <tr>
					<td colspan="3" bgcolor="#CCCCCC"><strong>COMMENTS</strong></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>ABBREVIATIONS</strong></td>
			      </tr>
				  <tr>
					<td width="169"><strong>CLASS TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->class_teacher_comment;?></td>
					<td colspan="2">I.C.T - Information &amp; Communication Technology.</td>
				  </tr>
				  <tr>
					<td><strong>HEAD TEACHER :</strong></td>
					<td colspan="2">&nbsp;<?=$select->head_teacher_comment;?></td>
					<td colspan="2">EPL - Exercises on Practical Life. </td>
				  </tr>
				  <tr>
				    <td colspan="3" bgcolor="#CCCCCC"><strong>BEHAVIOUR/SPECIAL AREA MARKING KEY (5) </strong></td>
				    <td colspan="2">ITS - Introduction to Sensory </td>
			      </tr>
				  <tr>
				    <td colspan="2">C</td>
				    <td width="565">&nbsp;<?=$select->consistently;?></td>
				    <td colspan="2" bgcolor="#CCCCCC"><strong>STANDARD BASED GRADING SKILLS </strong></td>
			      </tr>
				  <tr>
				    <td colspan="2">M</td>
				    <td>&nbsp;<?=$select->most_of_the_time;?></td>
				    <td width="64">LEVEL 4 </td>
				    <td width="460">Exceeds Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="2">N</td>
				    <td>&nbsp;<?=$select->needs_improvement;?></td>
				    <td>LEVEL 3 </td>
				    <td>Meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td colspan="3" rowspan="3">&nbsp;</td>
				    <td>LEVEL 2 </td>
				    <td>Partially meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>LEVEL 1 </td>
				    <td>Does not  meets Montitute / Tolmid Learning Standards.</td>
			      </tr>
				  <tr>
				    <td>SP</td>
				    <td>Satisfactory progress but below grade level. </td>
			      </tr>
				</table>
				<?php endif;?>
				<div class="pagebreak"> </div><hr>
				
				
  
					<?php endforeach;?>
						
					
		  </div>
				</div>
				
			</div>
		</div>
		
		<button id="print" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button"> <span><i class="fa fa-print"></i>Print</span> </button>
	</div>
</div>