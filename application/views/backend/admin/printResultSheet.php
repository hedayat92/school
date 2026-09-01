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
					<td><strong>NO. OF TIMES PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				<table width="100%" border="0">
				  <tr>
					<td style="background:black; color:white" align="center">TERMINAL REPORT CARD</td>
				  </tr>
				</table>
				
				<table width="100%"  border="1">
				  <tr>
					<td valign="top"><strong>SUBJECTS</strong></td>
					
					<td valign="top"><strong>C.A (40)</strong> </td>
					<td valign="top"><strong>EXAM (60)</strong> </td>
					<td valign="top"><strong>TOTAL (100)</strong> </td>
					<td valign="top"><strong>AVG.(%) </strong></td>
					<td valign="top"><strong>HIGHEST SCORE</strong> </td>
					<td valign="top"><strong>LOWEST SCORE </strong></td>
					<td valign="top"><strong>GRADE</strong></td>
					<td valign="top"><strong>SUBJECT COMMENT</strong> </td>
				  </tr>
				  
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					<tr>
					<td valign="top"><?php echo $subject['name'];?></td>
					
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 1));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            //$class_score_two    = $obtained_mark_query->row()->class_score2;
                                            //$class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one;// + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $exam_score;// + $class_score_three + $exam_score;
											
											if($total_score == ""){
												$total_score = 0;
											}else{
												$total_score = $total_score;	
											}
                                        
										
											$update['sum_first'] = $total_score;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
										} 
                                        ?>
					
					<td valign="top"><?php if($total_CA == 0)echo '';else echo $total_CA;?></td>
					<td valign="top"><?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
					<td valign="top"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
					<td valign="top">
					
					<?php 
					
								$set = get_settings('session');
                                $this->db->select_sum('sum_first');
                                $this->db->from('mark');
                                $this->db->where('subject_id', $subject['subject_id']);
								$this->db->where('term', 1);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfFirstScore = $query->row()->sum_first;
								
									if($sumTotalOfFirstScore == ""){
										$sumTotalOfFirstScore = 0;
									}else{
										$sumTotalOfFirstScore = $sumTotalOfFirstScore;	
									}
								
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 1, 
									'subject_id' => $subject['subject_id'], 'exam_score !=' => 0))->num_rows();
									
									
									
									$updatePercetangeFirst = round($sumTotalOfFirstScore/$getSubjectNumbered,2);
									if(is_nan($updatePercetangeFirst)){
										echo $updatePercetangeFirst = "";
									}
									if(!is_nan($updatePercetangeFirst)){
										echo $updatePercetangeFirst = $updatePercetangeFirst;
									}
									
									$average['class_position_first'] = $updatePercetangeFirst;
									$this->db->where('subject_id' , $subject['subject_id']);
									$this->db->where('student_id' , $student_id);
									$this->db->update('mark', $average);		
									
					?>
					
					
					</td>
					<td valign="top">

                                            <?php
                                                echo $highest_mark = $this->crud_model->get_highest_marks_first( $exam_id , $class_id , $subject['subject_id'], 1 );
                                                
                                            ?>
											
					</td>
					<td valign="top">
                                            <?php
                                                echo $lowest_mark = $this->crud_model->get_lowest_marks_first( $exam_id , $class_id , $subject['subject_id'], 1 );
                                            ?>
					</td>
					<td valign="top">
								<?php if ($total_score <= '100' && $total_score >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($total_score <= '79' && $total_score >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($total_score <= '69' && $total_score >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($total_score <= "59" && $total_score >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($total_score <= "49" && $total_score >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($total_score <= "39" && $total_score >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					<td valign="top"><?php echo $obtained_mark_query->row()->comment;?></td>
				  </tr>
				  <?php endforeach;?>
				</table>
				<table width="100%" height="254" border="1">
				  <tr>
					<td width="254" height="48"><strong>TOTAL SCORE OBTAINABLE :</strong></td>
					<td width="294">
					<?php $session =  get_settings('session');?>
					<?=$this->db->get_where('mark', array('class_id' => $class_id, 'term' => 1, 'session' => $session,  'student_id' => $student_id, 'exam_score !=' => 0))->num_rows() * 100;	
			
					?>					
					</td>
					
					<td width="261"><strong>OVERALL PERCENTAGE: </strong></td>
					<td width="130">
					
					<?php 
					
								$set = get_settings('session');
                                $this->db->select_sum('sum_first');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 1);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfFirstScore = $query->row()->sum_first;
								
									if($sumTotalOfFirstScore == ""){
										$sumTotalOfFirstScore = 0;
									}else{
										$sumTotalOfFirstScore = $sumTotalOfFirstScore;	
									}
								
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 1, 
									'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();		
					?>
					
					<?=round($sumTotalOfFirstScore /$getSubjectNumbered,2)?> %
					</td>
					
					<td colspan="2"><strong>Personal Development (5mks) :</strong></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>TOTAL SCORE OBTAINED :</strong></td>
					<td rowspan="2">
								<?php
								$set = get_settings('session');
                                $this->db->select_sum('sum_first');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 1);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfFirstScore = $query->row()->sum_first;
								
									if($sumTotalOfFirstScore == ""){
										echo $sumTotalOfFirstScore = 0;
									}else{
										echo $sumTotalOfFirstScore = $sumTotalOfFirstScore;	
									}
							?>					
					</td>
					
					
					<td rowspan="2"><strong>OVERALL GRADE:</strong> </td>
					<td rowspan="2">
								<?php $FindGrade = round($sumTotalOfFirstScore /$getSubjectNumbered,2);?>
								<?php if ($FindGrade <= '100' && $FindGrade >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '79.9' && $FindGrade >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '69.9' && $FindGrade >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "59.9" && $FindGrade >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "49.9" && $FindGrade >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "39.9" && $FindGrade >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					
					<?php 
					$session = get_settings('session');
					$select = $this->db->get_where('stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
					<td width="210">Mental Alertness </td>
					<td width="111"><?=$select->ma;?></td>
				  </tr>
				  <tr>
				    <td>Physical Development</td>
			        <td width="111"><?=$select->pd;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>CLASS TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->class_comment;?></td>
					<td width="210">Relating  with Teacher&rsquo;s</td>
					<td width="111"><?=$select->rt;?></td>
				  </tr>
				  <tr>
				    <td>Relating with mates</td>
			        <td width="111"><?=$select->rm;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>HEAD TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->head_comment;?></td>
					<td width="210">General Habit &amp; Attitude</td>
					<td width="111"><?=$select->gha;?></td>
				  </tr>
				  <tr>
				    <td>Punctuality</td>
			        <td width="111"><?=$select->p;?></td>
				  </tr> 
				  
				  <tr>
					<td colspan="4" rowspan="2"></td>
					<td width="210">Neatness</td>
					<td width="111"><?=$select->n;?></td>
				  </tr>
				  <tr>
				    <td>Leadership Traits</td>
			        <td width="111"><?=$select->lt;?></td>
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
					<td><strong>NO. OF TIMES PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				<table width="100%" border="0">
				  <tr>
					<td style="background:black; color:white" align="center">TERMINAL REPORT CARD</td>
				  </tr>
				</table>
				
				<table width="100%"  border="1">
				  <tr>
					<td valign="top"><strong>SUBJECTS</strong></td>
					
					<td valign="top"><strong>C.A (40)</strong> </td>
					<td valign="top"><strong>EXAM (60)</strong> </td>
					<td valign="top"><strong>TOTAL (100)</strong> </td>
					<td valign="top"><strong>AVG.(%) </strong></td>
					<td valign="top"><strong>HIGHEST SCORE</strong> </td>
					<td valign="top"><strong>LOWEST SCORE </strong></td>
					<td valign="top"><strong>GRADE</strong></td>
					<td valign="top"><strong>SUBJECT COMMENT</strong> </td>
				  </tr>
				  
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					<tr>
					<td valign="top"><?php echo $subject['name'];?></td>
					
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 2));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            //$class_score_two    = $obtained_mark_query->row()->class_score2;
                                            //$class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one;// + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $exam_score;// + $class_score_three + $exam_score;
											
											if($total_score == ""){
												$total_score = 0;
											}else{
												$total_score = $total_score;	
											}
                                        
										
											$update['sum_second'] = $total_score;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
										} 
                                        ?>
					
					<td valign="top"><?php if($total_CA == 0)echo '';else echo $total_CA;?></td>
					<td valign="top"><?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
					<td valign="top"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
					<td valign="top">
					
					<?php 
					
								$set = get_settings('session');
                                $this->db->select_sum('sum_second');
                                $this->db->from('mark');
                                $this->db->where('subject_id', $subject['subject_id']);
								$this->db->where('term', 2);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfSecondScore = $query->row()->sum_second;
								
									if($sumTotalOfSecondScore == ""){
										$sumTotalOfSecondScore = 0;
									}else{
										$sumTotalOfSecondScore = $sumTotalOfSecondScore;	
									}
								
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 2, 
									'subject_id' => $subject['subject_id'], 'exam_score !=' => 0))->num_rows();
									
									
									
									$updatePercetangeSecond = round($sumTotalOfSecondScore/$getSubjectNumbered,2);
									if(is_nan($updatePercetangeSecond)){
										echo $updatePercetangeSecond = "";
									}
									if(!is_nan($updatePercetangeSecond)){
										echo $updatePercetangeSecond = $updatePercetangeSecond;
									}
									
									$average['class_position_second'] = $updatePercetangeSecond;
									$this->db->where('subject_id' , $subject['subject_id']);
									$this->db->where('student_id' , $student_id);
									$this->db->update('mark', $average);
					?>
					
					
					</td>
					<td valign="top">

                                            <?php
                                                echo $highest_mark = $this->crud_model->get_highest_marks_second( $exam_id , $class_id , $subject['subject_id'], 2 );
                                                
                                            ?>
											
					</td>
					<td valign="top">
                                            <?php
                                                echo $lowest_mark = $this->crud_model->get_lowest_marks_second( $exam_id , $class_id , $subject['subject_id'], 2 );
                                            ?>
					</td>
					<td valign="top">
								<?php if ($total_score <= '100' && $total_score >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($total_score <= '79' && $total_score >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($total_score <= '69' && $total_score >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($total_score <= "59" && $total_score >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($total_score <= "49" && $total_score >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($total_score <= "39" && $total_score >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					<td valign="top"><?php echo $obtained_mark_query->row()->comment;?></td>
				  </tr>
				  <?php endforeach;?>
				</table>
				<table width="100%" height="254" border="1">
				  <tr>
					<td width="247" height="48"><strong>TOTAL SCORE OBTAINABLE :</strong></td>
					<td width="305">
					<?php $session =  get_settings('session');?>
					<?=$this->db->get_where('mark', array('class_id' => $class_id, 'term' => 2, 'session' => $session,  'student_id' => $student_id, 'exam_score !=' => 0))->num_rows() * 100;	
			
					?>					</td>
					
					
					
					
					
					
					<td width="262"><strong>OVERALL PERCENTAGE: </strong></td>
					<td width="135">
					
					<?php 
					
								$set = get_settings('session');
                                $this->db->select_sum('sum_second');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 2);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfSecondScore = $query->row()->sum_second;
								
									if($sumTotalOfSecondScore == ""){
										$sumTotalOfSecondScore = 0;
									}else{
										$sumTotalOfSecondScore = $sumTotalOfSecondScore;	
									}
								
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 2, 
									'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();		
					?>
					
					<?=round($sumTotalOfSecondScore /$getSubjectNumbered,2)?> %					</td>
					<td colspan="2"><strong>Personal Development (5mks) :</strong></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>TOTAL SCORE OBTAINED :</strong></td>
					<td rowspan="2">
								<?php
								$set = get_settings('session');
                                $this->db->select_sum('sum_second');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 2);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfSecondScore = $query->row()->sum_second;
								
									if($sumTotalOfSecondScore == ""){
										echo $sumTotalOfSecondScore = 0;
									}else{
										echo $sumTotalOfSecondScore = $sumTotalOfSecondScore;	
									}
							?>					</td>
					
					
					
					
					<td rowspan="2"><strong>OVERALL GRADE:</strong> </td>
					<td rowspan="2">
								<?php $FindGrade = round($sumTotalOfSecondScore /$getSubjectNumbered,2);?>
								<?php if ($FindGrade <= '100' && $FindGrade >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '79.9' && $FindGrade >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '69.9' && $FindGrade >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "59.9" && $FindGrade >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "49.9" && $FindGrade >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "39.9" && $FindGrade >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					<?php 
					$session = get_settings('session');
					$select = $this->db->get_where('stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
					<td width="210">Mental Alertness </td>
					<td width="111"><?=$select->ma;?></td>
				  </tr>
				  <tr>
				    <td>Physical Development</td>
			        <td width="111"><?=$select->pd;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>CLASS TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->class_comment;?></td>
					<td width="210">Relating  with Teacher&rsquo;s</td>
					<td width="111"><?=$select->rt;?></td>
				  </tr>
				  <tr>
				    <td>Relating with mates</td>
			        <td width="111"><?=$select->rm;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>HEAD TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->head_comment;?></td>
					<td width="210">General Habit &amp; Attitude</td>
					<td width="111"><?=$select->gha;?></td>
				  </tr>
				  <tr>
				    <td>Punctuality</td>
			        <td width="111"><?=$select->p;?></td>
				  </tr> 
				  
				  <tr>
					<td colspan="4" rowspan="2"></td>
					<td width="210">Neatness</td>
					<td width="111"><?=$select->n;?></td>
				  </tr>
				  <tr>
				    <td>Leadership Traits</td>
			        <td width="111"><?=$select->lt;?></td>
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
					<td><strong>NO. OF TIMES PRESENT:</strong></td>
					<td></td>
				  </tr>
				</table>
				
				<table width="100%" border="0">
				  <tr>
					<td style="background:black; color:white" align="center">TERMINAL REPORT CARD</td>
				  </tr>
				</table>
				
				<table width="100%"  border="1">
				  <tr>
					<td valign="top"><strong>SUBJECTS</strong></td>
					<td valign="top"><strong>1st Term</strong> </td>
					<td valign="top"><strong>2nd Term</strong> </td>
					<td valign="top"><strong>C.A (40)</strong> </td>
					<td valign="top"><strong>EXAM (60)</strong> </td>
					<td valign="top"><strong>TOTAL (100)</strong> </td>
					<td valign="top"><strong>AVG.(%) </strong></td>
					<td valign="top"><strong>HIGHEST SCORE</strong> </td>
					<td valign="top"><strong>LOWEST SCORE </strong></td>
					<td valign="top"><strong>GRADE</strong></td>
					<td valign="top"><strong>SUBJECT COMMENT</strong> </td>
				  </tr>
				  
                    <?php 
						$select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
						foreach ($select_subject as $key => $subject):
					?>
					<tr>
					<td valign="top"><?php echo $subject['name'];?></td>
					
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 3));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            //$class_score_two    = $obtained_mark_query->row()->class_score2;
                                            //$class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one;// + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $exam_score;// + $class_score_three + $exam_score;
											
											if($total_score == ""){
												$total_score = 0;
											}else{
												$total_score = $total_score;	
											}
                                        
										
											$update['sum_third'] = $total_score;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
										} 
                                        ?>
					<td valign="top"><?php if ($obtained_mark_query->row()->sum_first == 0) echo '';else echo $obtained_mark_query->row()->sum_first; ?></td>
					<td valign="top"><?php if ($obtained_mark_query->row()->sum_second == 0)echo '';else echo $obtained_mark_query->row()->sum_second;?></td>
					
					<td valign="top"><?php if($total_CA == 0)echo '';else echo $total_CA;?></td>
					<td valign="top"><?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
					<td valign="top"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
					<td valign="top">
					
					<?php 
					
									$set = get_settings('session');
									$this->db->select_sum('sum_third');
									$this->db->from('mark');
									$this->db->where('subject_id' , $subject['subject_id']);
									$this->db->where('student_id', $student_id);
									$this->db->where('term', 3);
									$this->db->where('session', $set);
									
									$query = $this->db->get();									
									$sumTotalOfThirdScore = $query->row()->sum_third;
				
									
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 3,'subject_id' => $subject['subject_id'], 
									'exam_score !=' => 0))->num_rows();
					
					
									$updatePercetangeThird = round($sumTotalOfThirdScore/$getSubjectNumbered,2);
									if(is_nan($updatePercetangeThird)){
										$updatePercetangeThird = 0;
									}
									if(!is_nan($updatePercetangeThird)){
										$updatePercetangeThird = $updatePercetangeThird;
									}
									
											$average['class_position_third'] = $updatePercetangeThird;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $average);	
					
					
					
					
					$AnnualSum = $obtained_mark_query->row()->class_position_first + $obtained_mark_query->row()->class_position_second + $obtained_mark_query->row()->class_position_third;
						  $AnnualAverage = $AnnualSum / 3;
						  if($AnnualAverage == 0)
						  echo "";
						  else
						  echo round($AnnualAverage, 2);
					?>
					
					
					</td>
					<td valign="top">

                                            <?php
                                                echo $highest_mark = $this->crud_model->get_highest_marks_third( $exam_id , $class_id , $subject['subject_id'], 3 );
                                                
                                            ?>
											
					</td>
					<td valign="top">
                                            <?php
                                                echo $lowest_mark = $this->crud_model->get_lowest_marks_third( $exam_id , $class_id , $subject['subject_id'], 3 );
                                            ?>
					</td>
					<td valign="top">
								<?php if ($AnnualAverage <= '100' && $AnnualAverage >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($AnnualAverage <= '79.9' && $AnnualAverage >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($AnnualAverage <= '69.9' && $AnnualAverage >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($AnnualAverage <= "59.9" && $AnnualAverage >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($AnnualAverage <= "49.9" && $AnnualAverage >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($AnnualAverage <= "39.9" && $AnnualAverage >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					<td valign="top"><?php echo $obtained_mark_query->row()->comment;?></td>
				  </tr>
				  <?php endforeach;?>
				</table>
				<table width="100%" height="254" border="1">
				  <tr>
					<td width="243" height="48"><strong>TOTAL SCORE OBTAINABLE :</strong></td>
					<td width="289">
					<?php $session =  get_settings('session');?>
					<?=$this->db->get_where('mark', array('class_id' => $class_id, 'term' => 3, 'session' => $session,  'student_id' => $student_id, 'exam_score !=' => 0))->num_rows() * 100;	
			
					?>					</td>
					
					
					
					
					<td width="342"><strong>OVERALL PERCENTAGE: </strong></td>
					<td width="75">
					
					<?php 
					
								$set = get_settings('session');
                                $this->db->select_sum('sum_third');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 3);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfThirdScore = $query->row()->sum_third;
								
									if($sumTotalOfThirdScore == ""){
										$sumTotalOfThirdScore = 0;
									}else{
										$sumTotalOfThirdScore = $sumTotalOfThirdScore;	
									}
								
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 3, 
									'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();		
					?>
					
					<?=round($sumTotalOfThirdScore /$getSubjectNumbered,2)?> %					</td>
					
					<td colspan="2"><strong>Personal Development (5mks) :</strong></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>TOTAL SCORE OBTAINED :</strong></td>
					<td rowspan="2">
								<?php
								$set = get_settings('session');
                                $this->db->select_sum('sum_third');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 3);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								$sumTotalOfThirdScore = $query->row()->sum_third;
								
									if($sumTotalOfThirdScore == ""){
										echo $sumTotalOfThirdScore = 0;
									}else{
										echo $sumTotalOfThirdScore = $sumTotalOfThirdScore;	
									}
							?>					</td>
					<td rowspan="2"><strong>OVERALL GRADE:</strong> </td>
					<td rowspan="2">
								<?php $FindGrade = round($sumTotalOfThirdScore /$getSubjectNumbered,2);?>
								<?php if ($FindGrade <= '100' && $FindGrade >= '80'):?>
								<?php echo 'A';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '79.9' && $FindGrade >= '70'):?>
								<?php echo 'B';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= '69.9' && $FindGrade >= '60'):?>
								<?php echo 'C';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "59.9" && $FindGrade >= '50'):?>
								<?php echo 'D';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "49.9" && $FindGrade >= '40'):?>
								<?php echo 'E';?>
								<?php endif;?>
								
								<?php if ($FindGrade <= "39.9" && $FindGrade >= '30'):?>
								<?php echo 'F';?>
								<?php endif;?>
					</td>
					<?php 
					$session = get_settings('session');
					$select = $this->db->get_where('stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
					<td width="210">Mental Alertness </td>
					<td width="111"><?=$select->ma;?></td>
				  </tr>
				  <tr>
				    <td>Physical Development</td>
			        <td width="111"><?=$select->pd;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>CLASS TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->class_comment;?></td>
					<td width="210">Relating  with Teacher&rsquo;s</td>
					<td width="111"><?=$select->rt;?></td>
				  </tr>
				  <tr>
				    <td>Relating with mates</td>
			        <td width="111"><?=$select->rm;?></td>
				  </tr>
				  
				  
				  <tr>
					<td rowspan="2"><strong>HEAD TEACHER'S REMARKS :</strong></td>
					<td colspan="3" rowspan="2"><?=$select->head_comment;?></td>
					<td width="210">General Habit &amp; Attitude</td>
					<td width="111"><?=$select->gha;?></td>
				  </tr>
				  <tr>
				    <td>Punctuality</td>
			        <td width="111"><?=$select->p;?></td>
				  </tr> 
				  
				  <tr>
					<td colspan="4" rowspan="2"></td>
					<td width="210">Neatness</td>
					<td width="111"><?=$select->n;?></td>
				  </tr>
				  <tr>
				    <td>Leadership Traits</td>
			        <td width="111"><?=$select->lt;?></td>
				  </tr>
				</table>
				



				<?php endif;?>	
				<div class="pagebreak"> </div><hr>
  
					<?php endforeach;?>
						
					
					</div>
				</div>
				
			</div>
		</div>
		
		<button id="print" class="btn btn-info btn-sm" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
		<?php echo form_open(base_url() . 'admin/generate_student_pdf/' . $student_id.'/'.$exam_id);?>
			<button type="submit" class="btn btn-success btn-sm"> <span><i class="fa fa-print"></i> Generate PDF</span> </button>
		<?php echo form_close();?>
	</div>
</div>