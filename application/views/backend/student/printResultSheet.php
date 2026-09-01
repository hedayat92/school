				
		<style type="text/css">


	.page {
	  width: 1000px;
	  min-height: 29.7cm;
	  padding: 2cm;
	  margin: 1cm auto;
	  border: 1px #D3D3D3 solid;
	  border-radius: 5px;
	  background: white;
	  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}

	@page {
	  size: A3;
	  margin: 0;
	}
	
	@media print {
	  .page {
        html, body {
			width: 216mm;
			min-height: 279mm;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
	  }
	  
		.thead > tr > th,
		.tbody > tr > th,
		.tbody > tr > td{
		    border-color: #000 !important;
		} 
	}

	table {
	    border-collapse: collapse;
	    width: 100%;
	    margin: 0 auto;
	}
        </style>

   <?php
      $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
      $select_student_from_model = $this->db->get_where('student', array('student_id'   => $student_id))->result_array();
      foreach($select_student_from_model as $key => $student_selected):
                          
      $student_id 		= $student_selected['student_id'];
      $student_roll 	= $student_selected['roll'];
      $student_sex 		= $student_selected['sex'];
      $student_name 	= $student_selected['name'];
      $number_class 	= $this->db->get_where('student', array('class_id' =>$class_id))->num_rows();
      $ReturnTeacherSub = $this->db->get_where('subject', array('class_id' => $class_id))->row_array();
                          
                          
      $total_marks        =   0;
      $total_class_score  =   0;
      $total_grade_point  =   0;
      ?>
	  
	  <div class="printableArea page" align="center"> 
	  
   <?php if($term == 1) : ?>
				<table width="100%" border="0" class="mb-3">
				  <tr>
					<td  width="20%"><img class="float-left" src="<?php echo base_url()?>uploads/logo.png" height="150" width="150"></td>
					<td  width="60%" style="padding-left:30px;">
						<small style="font-size:20px;"><strong><?php echo get_settings('system_name')?></strong></small><br>
						<!--<small><strong><?php echo get_settings('footer')?></strong></small><br>-->
						<small><strong><?= get_phrase('address') ?>:</strong> <?php echo get_settings('address')?></small><br>
						<small><strong><?= get_phrase('phone') ?> <?= get_phrase('no') ?>: </strong> <?php echo get_settings('phone')?></small><br>
						<small><strong><?= get_phrase('email') ?>: </strong> <?php echo get_settings('system_email')?></small><br>
					</td>
					<td width="20%"><img class="float-right" src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']); ?>" height="150" width="150"></td>
				  </tr>		
				</table>
   <table width="100%" border="0">
      <tr>
         <td align="center"><strong>REPORT SHEET FOR <?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?> <?=$session?> ACADEMIC SESSION</strong></td>
      </tr>
   </table>
   <table width="100%" height="100" border="1">
      <tr>
         <th width="156">&nbsp;NAME:</th>
         <td width="227" class="text-uppercase">&nbsp;<?=$student_selected['name'];?></td>
         <th width="126">&nbsp;CLASS:</th>
         <td width="99">&nbsp;<?=$class_name;?></td>
         <th width="139">&nbsp;TERM:</th>
         <td width="59">&nbsp;<?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
      </tr>
      <tr>
         <th>&nbsp;ADMISSION NO:</th>
         <td>&nbsp;<?=$student_selected['roll'];?></td>
         <th>&nbsp;SEX:</th>
         <td>&nbsp;<?=ucwords($student_selected['sex']);?></td>
         <th>&nbsp;ACADEMIC YEAR:</th>
         <td>&nbsp;<?=$session?></td>
      </tr>
      <tr>
         <th>&nbsp;DAY(S) SCHOOL OPEN</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term))->num_rows(); ?></td>
         <th width="126">&nbsp;DAY(S) PRESENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 1))->num_rows(); ?></td>
         <th>&nbsp;DAY(S) ABSENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 2))->num_rows(); ?></td>
      </tr>
   </table>
   <table width="100%"  border="1">
      <tr>
         <th valign="top">&nbsp;Subjects</td>
         <th valign="top">&nbsp;CA1 (20%)</th>
         <th valign="top">&nbsp;CA2 (20%)</th>
         <th valign="top">&nbsp;Exam (60%)</th>
         <th valign="top">&nbsp;Total (100%)</th>
         <th valign="top">&nbsp;Grade</th>
         <th valign="top">&nbsp;Remarks</th>
      </tr>
      <?php 
         $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
         foreach ($select_subject as $key => $subject):
       ?>
      <tr>
         <td valign="top">&nbsp;<?php echo $subject['name'];?></td>
         <?php 
            $obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 'student_id' => $student_id, 'term' => $term));
			$class_score_one    = $obtained_mark_query->row()->class_score1;
			$class_score_two    = $obtained_mark_query->row()->class_score2;
			$exam_score         = $obtained_mark_query->row()->exam_score;
			$sum_first          = $obtained_mark_query->row()->sum_first;
			$total_CA        	= $class_score_one; + $class_score_two;
			$total_score        = $class_score_one + $class_score_two + $exam_score;
            	
            if($total_score == ""){
            	$total_score = 0;
            }else{
            	$total_score = $total_score;	
            }
            $getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => $term, 'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
		?>
         <td valign="top">&nbsp;<?php if($class_score_one == 0)echo '';else echo $class_score_one;?></td>
         <td valign="top">&nbsp;<?php if($class_score_two == 0)echo '';else echo $class_score_two;?></td>
         <td valign="top">&nbsp;<?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
         <td valign="top">&nbsp;<?php if($sum_first == 0)echo ''; else echo $sum_first;?></td>
         <td valign="top">&nbsp;
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
            <?php echo 'P';?>
            <?php endif;?>
            <?php if ($total_score <= "49" && $total_score >= '40'):?>
            <?php echo 'E';?>
            <?php endif;?>
            <?php if ($total_score <= "39" && $total_score >= '30'):?>
            <?php echo 'F';?>
            <?php endif;?>
         </td>
         <td valign="top">&nbsp;<?php echo $obtained_mark_query->row()->comment;?></td>
      </tr>
      <?php endforeach;?>
   </table>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black">
		 <span class="pull-left"><strong>GRADE DETAILS:</strong></span>
		 <span class="pull-right"><strong>Number of Subject Offered: <?php echo $getSubjectNumbered?></strong> </span><br>
		 80-100 = A(Excellent) 70-79 = B(V.Good) 60-69 = C(Good) 50-59 = D(Pass) 40-49 = E(Fair) 0-39 = F(Fail)        
		</td>
      </tr>
   </table>
   <table width="100%" border="1">
      <tr>
         <td width="128"><strong>&nbsp;</strong><strong>Total Score:</strong></td>
         <td width="124">&nbsp;
            <?php
			   $this->db->select_sum('sum_first');
			   $this->db->from('mark');
			   $this->db->where('student_id', $student_id);
               $this->db->where('term', $term);
               $this->db->where('session', $session);
               $query = $this->db->get();	
               $sumTotalOfFirstScore = $query->row()->sum_first;
               
               	if($sumTotalOfFirstScore == ""){
               		echo $sumTotalOfFirstScore = 0;
               	}else{
               		echo $sumTotalOfFirstScore = $sumTotalOfFirstScore;	
               	}
               ?>         
		</td>
         <td colspan="2"><strong>&nbsp;<strong>Final Average</strong>:</strong></td>
         <td width="136">&nbsp;
            <?php 
			$this->db->select_sum('sum_first');
			$this->db->from('mark');
			$this->db->where('student_id', $student_id);
			$this->db->where('term', $term);
			$this->db->where('session', $session);
               
			$query = $this->db->get();	
			$sumTotalOfFirstScore = $query->row()->sum_first;
               
               	if($sumTotalOfFirstScore == ""){
               		$sumTotalOfFirstScore = 0;
               	}else{
               		$sumTotalOfFirstScore = $sumTotalOfFirstScore;	
               	}
			?>
            <?=round($sumTotalOfFirstScore / $getSubjectNumbered,2)?> %         
		</td>
         <td width="144">&nbsp;<strong>Final Grade</strong> </td>
         <td width="127">&nbsp;
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
      </tr>
   </table>
   <?php $select = $this->db->get_where('udemy_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
   <table width="100%" border="1">
      <tr>
         <td colspan="2">
            <div align="center"><strong>AFFECTIVE ASSESSMENT </strong></div>
         </td>
         <td colspan="2">
            <div align="center"><strong>PSYCHOMOTOR ASSESSMENT</strong></div>
         </td>
      </tr>
      <tr>
         <th width="24%">&nbsp;AFFECTIVE</th>
         <th width="23%" align="center">&nbsp;SCORES</th>
         <th width="29%">&nbsp;PSYCHOMOTOR</td>
         <th width="24%" align="center">&nbsp;SCORES</th>
      </tr>
      <tr>
         <td>&nbsp;Attentiveness</td>
         <td>
            <div align="center"><?=$select->at;?></div>
         </td>
         <td>&nbsp;Club / Society </td>
         <td>
            <div align="center"><?=$select->cl;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Honesty</td>
         <td>
            <div align="center"><?=$select->ho;?></div>
         </td>
         <td>&nbsp;Drawing and Painting </td>
         <td>
            <div align="center"><?=$select->dr;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Neatness</td>
         <td>
            <div align="center"><?=$select->ne;?></div>
         </td>
         <td>&nbsp;Hand Writting </td>
         <td>
            <div align="center"><?=$select->ha;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Politeness</td>
         <td>
            <div align="center"><?=$select->po;?></div>
         </td>
         <td>&nbsp;Hobies</td>
         <td>
            <div align="center"><?=$select->hob;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Punchuality</td>
         <td>
            <div align="center"><?=$select->pu;?></div>
         </td>
         <td>&nbsp;Speech Fluentcy </td>
         <td>
            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Relationship with Others </td>
         <td>
            <div align="center"><?=$select->re;?></div>
         </td>
         <td>&nbsp;Sport and Game </td>
         <td>
            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
   </table>
   <br>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black" align="center">5 = A(Excellent) 4 = B(V.Good) 3 = C(Good) 2 = D(Pass) 1 = E(Fair) 0 = F(Fail)</td>
      </tr>
   </table>
   
			  <table width="1000" border="1">
					  <tr>
						<td width="22%" style="font-size:12px;"><strong>&nbsp;CLASS TEACHER'S COMMENT: </strong></td>
						<td width="78%" style="font-size:12px;">&nbsp;<strong><?=$select->fmc;?></strong></td>
					  </tr>
					  
					  
					  
					  <tr>
						<td style="font-size:12px;"><strong>&nbsp;HEAD TEACHER'S COMMENT: </strong></td>
						<td style="font-size:12px;">&nbsp;<strong><?=$select->pc;?></strong></td>
					  </tr>
			  </table>
			  
			  <table width="1000" border="1">
					  <tr>
						<td ><br>&nbsp;<?=$select->fma;?><br>
						&nbsp;<strong>CLASS TEACHER'S SIGNATURE </strong></td>
						<td colspan="7"><br>&nbsp;<img src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px"><br>
						&nbsp;<strong>HEAD TEACHER'S SIGNATURE </strong></td>
					  </tr>
					  
			  </table>
   <?php endif;?>	<!-- End Term 1 -->
   
   
   
   <?php if($term == 2) : ?>
				<table width="100%" border="0" class="mb-3">
				  <tr>
					<td  width="20%"><img class="float-left" src="<?php echo base_url()?>uploads/logo.png" height="150" width="150"></td>
					<td  width="60%" style="padding-left:30px;">
						<small style="font-size:20px;"><strong><?php echo get_settings('system_name')?></strong></small><br>
						<!--<small><strong><?php echo get_settings('footer')?></strong></small><br>-->
						<small><strong><?= get_phrase('address') ?>:</strong> <?php echo get_settings('address')?></small><br>
						<small><strong><?= get_phrase('phone') ?> <?= get_phrase('no') ?>: </strong> <?php echo get_settings('phone')?></small><br>
						<small><strong><?= get_phrase('email') ?>: </strong> <?php echo get_settings('system_email')?></small><br>
					</td>
					<td width="20%"><img class="float-right" src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']); ?>" height="150" width="150"></td>
				  </tr>		
				</table>
   <table width="100%" border="0">
      <tr>
         <td align="center"><strong>REPORT SHEET FOR <?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?> <?=$session?> ACADEMIC SESSION</strong></td>
      </tr>
   </table>
   <table width="100%" height="100" border="1">
      <tr>
         <th width="156">&nbsp;NAME:</th>
         <td width="227" class="text-uppercase">&nbsp;<?=$student_selected['name'];?></td>
         <th width="126">&nbsp;CLASS:</th>
         <td width="99">&nbsp;<?=$class_name;?></td>
         <th width="139">&nbsp;TERM:</th>
         <td width="59">&nbsp;<?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
      </tr>
      <tr>
         <th>&nbsp;ADMISSION NO:</th>
         <td>&nbsp;<?=$student_selected['roll'];?></td>
         <th>&nbsp;SEX:</th>
         <td>&nbsp;<?=ucwords($student_selected['sex']);?></td>
         <th>&nbsp;ACADEMIC YEAR:</th>
         <td>&nbsp;<?=$session?></td>
      </tr>
      <tr>
         <th>&nbsp;DAY(S) SCHOOL OPEN</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term))->num_rows(); ?></td>
         <th width="126">&nbsp;DAY(S) PRESENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 1))->num_rows(); ?></td>
         <th>&nbsp;DAY(S) ABSENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 2))->num_rows(); ?></td>
      </tr>
   </table>
   <table width="100%"  border="1">
      <tr>
         <th valign="top">&nbsp;Subjects</td>
         <th valign="top">&nbsp;CA1 (20%)</th>
         <th valign="top">&nbsp;CA2 (20%)</th>
         <th valign="top">&nbsp;Exam (60%)</th>
         <th valign="top">&nbsp;Total (100%)</th>
         <th valign="top">&nbsp;Grade</th>
         <th valign="top">&nbsp;Remarks</th>
      </tr>
      <?php 
         $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
         foreach ($select_subject as $key => $subject):
       ?>
      <tr>
         <td valign="top">&nbsp;<?php echo $subject['name'];?></td>
         <?php 
            $obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 'student_id' => $student_id, 'term' => $term));
			$class_score_one    = $obtained_mark_query->row()->class_score1;
			$class_score_two    = $obtained_mark_query->row()->class_score2;
			$exam_score         = $obtained_mark_query->row()->exam_score;
			$sum_second          = $obtained_mark_query->row()->sum_second;
			$total_CA        	= $class_score_one; + $class_score_two;
			$total_score        = $class_score_one + $class_score_two + $exam_score;
            	
            if($total_score == ""){
            	$total_score = 0;
            }else{
            	$total_score = $total_score;	
            }
            $getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => $term, 'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
		?>
         <td valign="top">&nbsp;<?php if($class_score_one == 0)echo '';else echo $class_score_one;?></td>
         <td valign="top">&nbsp;<?php if($class_score_two == 0)echo '';else echo $class_score_two;?></td>
         <td valign="top">&nbsp;<?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
         <td valign="top">&nbsp;<?php if($sum_second == 0)echo ''; else echo $sum_second;?></td>
         <td valign="top">&nbsp;
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
            <?php echo 'P';?>
            <?php endif;?>
            <?php if ($total_score <= "49" && $total_score >= '40'):?>
            <?php echo 'E';?>
            <?php endif;?>
            <?php if ($total_score <= "39" && $total_score >= '30'):?>
            <?php echo 'F';?>
            <?php endif;?>
         </td>
         <td valign="top">&nbsp;<?php echo $obtained_mark_query->row()->comment;?></td>
      </tr>
      <?php endforeach;?>
   </table>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black">
		 <span class="pull-left"><strong>GRADE DETAILS:</strong></span>
		 <span class="pull-right"><strong>Number of Subject Offered: <?php echo $getSubjectNumbered?></strong> </span><br>
		 80-100 = A(Excellent) 70-79 = B(V.Good) 60-69 = C(Good) 50-59 = D(Pass) 40-49 = E(Fair) 0-39 = F(Fail)        
		</td>
      </tr>
   </table>
   <table width="100%" border="1">
      <tr>
         <td width="128"><strong>&nbsp;</strong><strong>Total Score:</strong></td>
         <td width="124">&nbsp;
            <?php
			   $this->db->select_sum('sum_second');
			   $this->db->from('mark');
			   $this->db->where('student_id', $student_id);
               $this->db->where('term', $term);
               $this->db->where('session', $session);
               $query = $this->db->get();	
               $sum_second = $query->row()->sum_second;
               
               	if($sum_second == ""){
               		echo $sum_second = 0;
               	}else{
               		echo $sum_second = $sum_second;	
               	}
               ?>         
		</td>
         <td colspan="2"><strong>&nbsp;<strong>Final Average</strong>:</strong></td>
         <td width="136">&nbsp;
            <?php 
			$this->db->select_sum('sum_second');
			$this->db->from('mark');
			$this->db->where('student_id', $student_id);
			$this->db->where('term', $term);
			$this->db->where('session', $session);
               
			$query = $this->db->get();	
			$sum_second = $query->row()->sum_second;
               
               	if($sum_second == ""){
               		$sum_second = 0;
               	}else{
               		$sum_second = $sum_second;	
               	}
			?>
            <?=round($sum_second / $getSubjectNumbered,2)?> %         
		</td>
         <td width="144">&nbsp;<strong>Final Grade</strong> </td>
         <td width="127">&nbsp;
            <?php $FindGrade = round($sum_second /$getSubjectNumbered,2);?>
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
      </tr>
   </table>
   <?php $select = $this->db->get_where('udemy_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
   <table width="100%" border="1">
      <tr>
         <td colspan="2">
            <div align="center"><strong>AFFECTIVE ASSESSMENT </strong></div>
         </td>
         <td colspan="2">
            <div align="center"><strong>PSYCHOMOTOR ASSESSMENT</strong></div>
         </td>
      </tr>
      <tr>
         <th width="24%">&nbsp;AFFECTIVE</th>
         <th width="23%" align="center">&nbsp;SCORES</th>
         <th width="29%">&nbsp;PSYCHOMOTOR</td>
         <th width="24%" align="center">&nbsp;SCORES</th>
      </tr>
      <tr>
         <td>&nbsp;Attentiveness</td>
         <td>
            <div align="center"><?=$select->at;?></div>
         </td>
         <td>&nbsp;Club / Society </td>
         <td>
            <div align="center"><?=$select->cl;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Honesty</td>
         <td>
            <div align="center"><?=$select->ho;?></div>
         </td>
         <td>&nbsp;Drawing and Painting </td>
         <td>
            <div align="center"><?=$select->dr;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Neatness</td>
         <td>
            <div align="center"><?=$select->ne;?></div>
         </td>
         <td>&nbsp;Hand Writting </td>
         <td>
            <div align="center"><?=$select->ha;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Politeness</td>
         <td>
            <div align="center"><?=$select->po;?></div>
         </td>
         <td>&nbsp;Hobies</td>
         <td>
            <div align="center"><?=$select->hob;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Punchuality</td>
         <td>
            <div align="center"><?=$select->pu;?></div>
         </td>
         <td>&nbsp;Speech Fluentcy </td>
         <td>

            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Relationship with Others </td>
         <td>
            <div align="center"><?=$select->re;?></div>
         </td>
         <td>&nbsp;Sport and Game </td>
         <td>
            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
   </table>
   <br>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black" align="center">5 = A(Excellent) 4 = B(V.Good) 3 = C(Good) 2 = D(Pass) 1 = E(Fair) 0 = F(Fail)</td>
      </tr>
   </table>
   
			  <table width="1000" border="1">
					  <tr>
						<td width="22%" style="font-size:12px;"><strong>&nbsp;CLASS TEACHER'S COMMENT: </strong></td>
						<td width="78%" style="font-size:12px;">&nbsp;<strong><?=$select->fmc;?></strong></td>
					  </tr>
					  
					  
					  
					  <tr>
						<td style="font-size:12px;"><strong>&nbsp;HEAD TEACHER'S COMMENT: </strong></td>
						<td style="font-size:12px;">&nbsp;<strong><?=$select->pc;?></strong></td>
					  </tr>
			  </table>
			  
			  <table width="1000" border="1">
					  <tr>
						<td ><br>&nbsp;<?=$select->fma;?><br>
						&nbsp;<strong>CLASS TEACHER'S SIGNATURE </strong></td>
						<td colspan="7"><br>&nbsp;<img src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px"><br>
						&nbsp;<strong>HEAD TEACHER'S SIGNATURE </strong></td>
					  </tr>
					  
			  </table>
   <?php endif;?>	<!-- End Term 2 --> 
   
   
   
   
   <?php if($term == 3) : ?>
				<table width="100%" border="0" class="mb-3">
				  <tr>
					<td  width="20%"><img class="float-left" src="<?php echo base_url()?>uploads/logo.png" height="150" width="150"></td>
					<td  width="60%" style="padding-left:30px;">
						<small style="font-size:20px;"><strong><?php echo get_settings('system_name')?></strong></small><br>
						<!--<small><strong><?php echo get_settings('footer')?></strong></small><br>-->
						<small><strong><?= get_phrase('address') ?>:</strong> <?php echo get_settings('address')?></small><br>
						<small><strong><?= get_phrase('phone') ?> <?= get_phrase('no') ?>: </strong> <?php echo get_settings('phone')?></small><br>
						<small><strong><?= get_phrase('email') ?>: </strong> <?php echo get_settings('system_email')?></small><br>
					</td>
					<td width="20%"><img class="float-right" src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']); ?>" height="150" width="150"></td>
				  </tr>		
				</table>
   <table width="100%" border="0">
      <tr>
         <td align="center"><strong>REPORT SHEET FOR <?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?> <?=$session?> ACADEMIC SESSION</strong></td>
      </tr>
   </table>
   <table width="100%" height="100" border="1">
      <tr>
         <th width="156">&nbsp;NAME:</th>
         <td width="227" class="text-uppercase">&nbsp;<?=$student_selected['name'];?></td>
         <th width="126">&nbsp;CLASS:</th>
         <td width="99">&nbsp;<?=$class_name;?></td>
         <th width="139">&nbsp;TERM:</th>
         <td width="59">&nbsp;<?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></td>
      </tr>
      <tr>
         <th>&nbsp;ADMISSION NO:</th>
         <td>&nbsp;<?=$student_selected['roll'];?></td>
         <th>&nbsp;SEX:</th>
         <td>&nbsp;<?=ucwords($student_selected['sex']);?></td>
         <th>&nbsp;ACADEMIC YEAR:</th>
         <td>&nbsp;<?=$session?></td>
      </tr>
      <tr>
         <th>&nbsp;DAY(S) SCHOOL OPEN</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term))->num_rows(); ?></td>
         <th width="126">&nbsp;DAY(S) PRESENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 1))->num_rows(); ?></td>
         <th>&nbsp;DAY(S) ABSENT:</th>
         <td>&nbsp;<?=$this->db->get_where('attendance', array('session' => $session, 'term' => $term, 'student_id' => $student_id, 'status' => 2))->num_rows(); ?></td>
      </tr>
   </table>
   <table width="100%"  border="1">
      <tr>
         <th rowspan="2" valign="top">&nbsp;SUBJECTS</td>
         <th rowspan="2" valign="top">&nbsp;FIRST <br>&nbsp;TERM</th>
         <th rowspan="2" valign="top">&nbsp;SECOND <br>&nbsp;TERM</th>
		 <th colspan="4" valign="top"><div align="center">THIRD TERM </div></th>
		  <th rowspan="2" valign="top">&nbsp;CUM</th>
		   <th rowspan="2" valign="top">&nbsp;CUM<br>&nbsp;AVR</th>
		 <th rowspan="2" valign="top">&nbsp;GRADE</th>
         <th rowspan="2" valign="top">&nbsp;REMARKS</th>
      </tr>
      <tr>
        <th valign="top">&nbsp;CA1</th>
        <th valign="top">&nbsp;CA2</th>
        <th valign="top">&nbsp;Exam</th>
        <th valign="top">Total</th>
      </tr>
      <?php 
         $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
         foreach ($select_subject as $key => $subject):
       ?>
      <tr>
         <td valign="top">&nbsp;<?php echo $subject['name'];?></td>
		 
         <?php 
            $obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 'student_id' => $student_id, 'term' => 1));
			$sum_first          = $obtained_mark_query->row()->sum_first;
            	
            if($sum_first == ""){
            	$sum_first = 0;
            }else{
            	$sum_first = $sum_first;	
            }
		?> 
		
         <?php 
            $obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 'student_id' => $student_id, 'term' => 2));
			$sum_second          = $obtained_mark_query->row()->sum_second;
            	
            if($sum_second == ""){
            	$sum_second = 0;
            }else{
            	$sum_second = $sum_second;	
            }
		?> 
		 
         <?php 
            $obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 'student_id' => $student_id, 'term' => $term));
			$class_score_one    = $obtained_mark_query->row()->class_score1;
			$class_score_two    = $obtained_mark_query->row()->class_score2;
			$exam_score         = $obtained_mark_query->row()->exam_score;
			$sum_third          = $obtained_mark_query->row()->sum_third;
            	
            if($sum_third == ""){
            	$sum_third = 0;
            }else{
            	$sum_third = $sum_third;	
            }
			
			//Sum of all the terms give CUM
			$sumTotal = $sum_first + $sum_second + $sum_third;
			
			//calculating CUM AVR.....			
			if($sum_first != 0 && $sum_second != 0 && $sum_third != 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 3;
												
			if($sum_first == 0 && $sum_second != 0 && $sum_third != 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 2;
												
			if($sum_first != 0 && $sum_second == 0 && $sum_third != 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 2;
												
			if($sum_first != 0 && $sum_second != 0 && $sum_third == 0) 

			$DIVIDE_TERM_SCORES = $sumTotal / 2;
												
			if($sum_first != 0 && $sum_second == 0 && $sum_third == 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 1;
												
			if($sum_first == 0 && $sum_second != 0 && $sum_third == 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 1;
												
			if($sum_first == 0 && $sum_second == 0 && $sum_third != 0) 
			$DIVIDE_TERM_SCORES = $sumTotal / 1;
						
			$CUM_AVR = round($DIVIDE_TERM_SCORES);
			
			
			
				$THIRD_TERM_SUBJECTS_OFFERED = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => $term, 'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
				$FIRST_TERM_SUBJECTS_OFFERED = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 1, 'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
				$SECOND_TERM_SUBJECTS_OFFERED = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 2, 'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
				
				$ALL_TERM_SUBHECTS_OFFERED = $THIRD_TERM_SUBJECTS_OFFERED + $FIRST_TERM_SUBJECTS_OFFERED + $SECOND_TERM_SUBJECTS_OFFERED;
		?>
		
		
		
         <td valign="top">&nbsp;<?php if($sum_first == 0)echo '';else echo $sum_first;?></td>
         <td valign="top">&nbsp;<?php if($sum_second == 0)echo '';else echo $sum_second;?></td>
         <td valign="top">&nbsp;<?php if($class_score_one == 0)echo '';else echo $class_score_one;?></td>
         <td valign="top">&nbsp;<?php if($class_score_two == 0)echo '';else echo $class_score_two;?></td>
         <td valign="top">&nbsp;<?php if($exam_score == 0)echo ''; else echo $exam_score;?></td>
         <td valign="top">&nbsp;<?php if($sum_third == 0)echo ''; else echo $sum_third;?></td>
		 <td valign="top">&nbsp;<?php if($sumTotal == 0)echo ''; else echo $sumTotal;?></td>
		  <td valign="top">&nbsp;<?php if($CUM_AVR == 0)echo ''; else echo $CUM_AVR;?></td>
         <td valign="top">&nbsp;
            <?php if ($CUM_AVR <= '100' && $CUM_AVR >= '80'):?>
            <?php echo 'A';?>
            <?php endif;?>
            <?php if ($CUM_AVR <= '79' && $CUM_AVR >= '70'):?>
            <?php echo 'B';?>
            <?php endif;?>
            <?php if ($CUM_AVR <= '69' && $CUM_AVR >= '60'):?>
            <?php echo 'C';?>
            <?php endif;?>
            <?php if ($CUM_AVR <= "59" && $CUM_AVR >= '50'):?>
            <?php echo 'P';?>
            <?php endif;?>
            <?php if ($CUM_AVR <= "49" && $CUM_AVR >= '40'):?>
            <?php echo 'E';?>
            <?php endif;?>
            <?php if ($CUM_AVR <= "39" && $CUM_AVR >= '30'):?>
            <?php echo 'F';?>
            <?php endif;?>         </td>
         <td valign="top">&nbsp;<?php echo $obtained_mark_query->row()->comment;?></td>
      </tr>
      <?php endforeach;?>
   </table>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black">
		 <span class="pull-left"><strong>GRADE DETAILS:</strong></span>
		 <span class="pull-right"><strong>Number of Subject Offered: <?php echo $ALL_TERM_SUBHECTS_OFFERED?></strong> </span><br>
		 80-100 = A(Excellent) 70-79 = B(V.Good) 60-69 = C(Good) 50-59 = D(Pass) 40-49 = E(Fair) 0-39 = F(Fail)        
		</td>
      </tr>
   </table>
   <table width="100%" border="1">
      <tr>
         <td width="128"><strong>&nbsp;</strong><strong>Total Score:</strong></td>
         <td width="124">&nbsp;
            <?php
			
			   $this->db->select_sum('sum_first');
			   $this->db->from('mark');
			   $this->db->where('student_id', $student_id);
               $this->db->where('term', 1);
               $this->db->where('session', $session);
               $query = $this->db->get();	
               $cum_sum_first = $query->row()->sum_first;
				
			   $this->db->select_sum('sum_second');
			   $this->db->from('mark');
			   $this->db->where('student_id', $student_id);
               $this->db->where('term', 2);
               $this->db->where('session', $session);
               $query = $this->db->get();	
               $cum_sum_second = $query->row()->sum_second;
               
			   $this->db->select_sum('sum_third');
			   $this->db->from('mark');
			   $this->db->where('student_id', $student_id);
               $this->db->where('term', $term);
               $this->db->where('session', $session);
               $query = $this->db->get();	
               $cum_sum_third = $query->row()->sum_third;
				
				$SUM_CUM = $cum_sum_first + $cum_sum_second + $cum_sum_third;
               	if($SUM_CUM == ""){
               		$SUM_CUM = 0;
               	}else{
               		echo $SUM_CUM;	
               	}
				
               ?>         
		</td>
         <td colspan="2"><strong>&nbsp;<strong>Final Average</strong>:</strong></td>
         <td width="136">&nbsp;
            <?php 

				$DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED = $SUM_CUM / $ALL_TERM_SUBHECTS_OFFERED;
				echo round($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED,2). '%';;
			?>
		</td>
         <td width="144">&nbsp;<strong>Final Grade</strong> </td>
         <td width="127">&nbsp;
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= '100' && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '80'):?>
            <?php echo 'A';?>
            <?php endif;?>
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= '79.9' && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '70'):?>
            <?php echo 'B';?>
            <?php endif;?>
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= '69.9' && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '60'):?>
            <?php echo 'C';?>
            <?php endif;?>
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= "59.9" && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '50'):?>
            <?php echo 'D';?>
            <?php endif;?>
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= "49.9" && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '40'):?>
            <?php echo 'E';?>
            <?php endif;?>
            <?php if ($DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED <= "39.9" && $DIVIDE_ALL_TERM_SCORES_BY_ALL_TERM_SUBJECTS_OFFERED >= '30'):?>
            <?php echo 'F';?>
            <?php endif;?>         
		</td>
      </tr>
   </table>
   <?php $select = $this->db->get_where('udemy_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();?>
   <table width="100%" border="1">
      <tr>
         <td colspan="2">
            <div align="center"><strong>AFFECTIVE ASSESSMENT </strong></div>
         </td>
         <td colspan="2">
            <div align="center"><strong>PSYCHOMOTOR ASSESSMENT</strong></div>
         </td>
      </tr>
      <tr>
         <th width="24%">&nbsp;AFFECTIVE</th>
         <th width="23%" align="center">&nbsp;SCORES</th>
         <th width="29%">&nbsp;PSYCHOMOTOR</td>
         <th width="24%" align="center">&nbsp;SCORES</th>
      </tr>
      <tr>
         <td>&nbsp;Attentiveness</td>
         <td>
            <div align="center"><?=$select->at;?></div>
         </td>
         <td>&nbsp;Club / Society </td>
         <td>
            <div align="center"><?=$select->cl;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Honesty</td>
         <td>
            <div align="center"><?=$select->ho;?></div>
         </td>
         <td>&nbsp;Drawing and Painting </td>
         <td>
            <div align="center"><?=$select->dr;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Neatness</td>
         <td>
            <div align="center"><?=$select->ne;?></div>
         </td>
         <td>&nbsp;Hand Writting </td>
         <td>
            <div align="center"><?=$select->ha;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Politeness</td>
         <td>
            <div align="center"><?=$select->po;?></div>
         </td>
         <td>&nbsp;Hobies</td>
         <td>
            <div align="center"><?=$select->hob;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Punchuality</td>
         <td>
            <div align="center"><?=$select->pu;?></div>
         </td>
         <td>&nbsp;Speech Fluentcy </td>
         <td>
            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;Relationship with Others </td>
         <td>
            <div align="center"><?=$select->re;?></div>
         </td>
         <td>&nbsp;Sport and Game </td>
         <td>
            <div align="center"><?=$select->sp;?></div>
         </td>
      </tr>
   </table>
   <br>
   <table width="100%" border="0">
      <tr>
         <td style="background:white; color:black" align="center">5 = A(Excellent) 4 = B(V.Good) 3 = C(Good) 2 = D(Pass) 1 = E(Fair) 0 = F(Fail)</td>
      </tr>
   </table>
   
			  <table width="1000" border="1">
					  <tr>
						<td width="22%" style="font-size:12px;"><strong>&nbsp;CLASS TEACHER'S COMMENT: </strong></td>
						<td width="78%" style="font-size:12px;">&nbsp;<strong><?=$select->fmc;?></strong></td>
					  </tr>
					  
					  
					  
					  <tr>
						<td style="font-size:12px;"><strong>&nbsp;HEAD TEACHER'S COMMENT: </strong></td>
						<td style="font-size:12px;">&nbsp;<strong><?=$select->pc;?></strong></td>
					  </tr>
			  </table>
			  
			  <table width="1000" border="1">
					  <tr>
						<td ><br>&nbsp;<?=$select->fma;?><br>
						&nbsp;<strong>CLASS TEACHER'S SIGNATURE </strong></td>
						<td colspan="7"><br>&nbsp;<img src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px"><br>
						&nbsp;<strong>HEAD TEACHER'S SIGNATURE </strong></td>
					  </tr>
					  
			  </table>
   <?php endif;?>	<!-- End Term 3 --> 
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
</div>
<p style='overflow:hidden;page-break-before:always;'></p>
<?php endforeach;?>


<div align="center"><button id="print" class="btn btn-success btn-sm" type="button"> <span><i class="fa fa-print"></i> <?=get_phrase('print')?></span> </button></div>
</div>
