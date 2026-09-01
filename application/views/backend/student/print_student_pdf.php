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

hr.style4 {
	border-top: 1px dotted #8c8b8b;
}

hr.style5 {
	background-color: #fff;
	border-top: 2px dashed #8c8b8b;
}




</style>


<div class="row">
  <div class="col-sm-12">
  	<div class="panel"> 
  		<div class="table-responsive">
		
		
		
		<div class="printableArea">
		<div class="print" style="border:1px solid #000; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px;">
		
    <?php
	$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
    $select_student_from_model = $this->db->get_where('student', array('student_id'   => $this->session->userdata('student_id')))->result_array();
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
				<div class="row panel-body"> 
                    <div class="col-sm-9" > 
								<table width="1000" border="0">
								  <tr>
									<td>
										<!-- <div class="col-md-2">
											<img src="<?php echo base_url();?>uploads/logo.png" width="100px" height="100px">
										</div>-->
											<div class="col-md-8" style="text-align: center;">
												<div class="tile-stats tile-white tile-white-primary">
													<span style="text-align: center;font-size: 29px;">
														<?php echo $system_name;?>
													</span>
													<br/>
													
													<span style="text-align: center;font-size: 20px;">
														<?=get_settings('system_title');?>
													</span>
													<br/>
													<span style="text-align: center;font-size: 18px;">
                                                    <?php echo $system_address;?>
													</span>
													<br/>
													<br/>
												
              
												</div>
											</div>
											<!--<div class="col-md-2 logo" >
                                            <img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="100px">
											</div>-->
										</div>
										
									</td>
								  </tr>
								</table>
								
								
								<table width="700" border="0">
								  <tr>
									<td width=""> STUDENT'S REPORTS FOR:</td>
									<td width=""><strong><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></strong></td>
									<td width="">SESSION :</td>
									<td width=""><strong><?=get_settings('session');?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								  <tr>
									<td width="">NAME:</td>
									<td width=""><strong><?=$student_name;?></strong></td>
									<td width="">ADMISSION NO :</td>
									<td width=""><strong><?=$student_roll;?></strong></td>
									<td width="">CLASS:</td>
									<td width=""><strong><?=$class_name;?></strong></td>
								  </tr>
								  <tr>
									<td width="">PERFORMANCE IN SUBJECT:</td>
									<td width="">NUMBER IN CLASS:</td>
									<td width=""><strong><?=$number_class?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>	

								
								<br />
						        <table width="100%" style="border:1px solid black">
								   <tr style="border:1px solid black">
										<td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>subject:</strong></td>
										<td style="border:1px solid black; padding-left:3px;transform:rotate(-5deg);"><strong>CA</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Exam <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Total <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>2nd Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>3rd Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Annual <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Position</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Teacher's <br>Remarks</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Signature</strong></td>
								   </tr>
								   <tr style="border:1px solid black">
								   <td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>MARKS OBTAINABLE</strong></td>
								   </tr>
									
                                   <?php $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                            foreach ($select_subject as $key => $subject):?>
								   <tr>
								   
										<td style="border:1px solid black; padding-left:3px"><?php echo $subject['name'];?></td>
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 1));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            $class_score_two    = $obtained_mark_query->row()->class_score2;
                                            $class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $class_score_two + $class_score_three + $exam_score;
											
											$update['sum_first'] = $total_score;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
                                        } 
                                        ?>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_CA == 0)echo '';else echo $total_CA;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($exam_score == 0)echo ''; else echo $exam_score;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
										<td style="border:1px solid black; padding-left:3px"></td>
										
                                      
										<td style="border:1px solid black; padding-left:3px"></td>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
										<td style="border:1px solid black; padding-left:3px">
										
										
										<?php
										
										$subject_id = $subject['subject_id'];
 										$sql = "SELECT mark_id, sum_first, FIND_IN_SET( sum_first,(
												SELECT GROUP_CONCAT( sum_first  ORDER BY sum_first DESC ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id ))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND sum_first = $total_score AND sum_first != 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo '--'; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?>
										
										</td>

										<td style="border:1px solid black; padding-left:3px"><?=$obtained_mark_query->row()->comment;?></td>
										<td style="border:1px solid black; padding-left:3px">
										<?php 
										$teacgerSubjectID = $obtained_mark_query->row()->subject_id;
										$returningTeacherId = $this->db->get_where('subject', array('subject_id' => $teacgerSubjectID ))->row()->teacher_id;
										?>
											<img src="<?php echo base_url();?>uploads/teacher_image/teacher_<?=$returningTeacherId?>.jpg" alt="sign" width="60px" height="30px">
										</td>
								    </tr>
									<?php endforeach;?>
							    </table>
								
								
								<hr>
								
								<table width="700" border="0">
								  <tr>
									<td width=""> Overall Total</td>
									<td width=""><strong>
									
                                <?php 
								$set = get_settings('session');
                                $this->db->select_sum('sum_first');
                                $this->db->from('mark');
                                $this->db->where('student_id', $student_id);
								$this->db->where('term', 1);
								$this->db->where('session', $set);
								
                                $query = $this->db->get();	
								echo $sumTotalOfFirstScore = $query->row()->sum_first;
								
											
											$class_position_first['class_position_first'] = $sumTotalOfFirstScore;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $class_position_first);
											
									
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 1, 
									'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
                                ?>
									
									</strong></td>
									<td width="">Overall Percentage:</td>
									<td width=""><strong>
									<?=round($sumTotalOfFirstScore /$getSubjectNumbered,2)?> %
									
									</strong></td>
									<td width="">Position: </td>
									<td width=""><strong>
										<?php
										
										
 										$sql = "SELECT mark_id, class_position_first, FIND_IN_SET( class_position_first,(
												SELECT GROUP_CONCAT( class_position_first  ORDER BY class_position_first desc ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id ))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND class_position_first = $sumTotalOfFirstScore AND class_position_first != 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo '--'; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?>
										 </strong></td>
								  </tr>
								  
								  <tr>
									<td width="">Passed/Failed: </td>
									<td width="">___________</td>
									<td width="">Next Term Begins:</td>
									<td width=""><strong><?=get_settings('next_term_begin')?></strong></td>
									
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>
								
								
						    <br>
							
							<hr class="style16">
							<p align="center"> <strong>CUT ALONG THIS LINE</strong> </p>
							THE PRINCIPAL<br>
							I RECEIVED REPORT SHEET OF MY CHILD FOR THE <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
							WITH THANKS <strong style="margin-left:230px"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><br>
							<strong style="margin-left:470px">SIGNATURE</strong>
						
						</div>
						
						
						<div class="col-sm-3" style="height:1040px; border:1px solid black;">
							<div align="center">
								<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/logo.png" height="150px">
							</div>
							
							
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>1. AFFECTIVE DOMIAIN </strong></td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>2. PUNCTUALITY &amp; REGULARITY </strong></td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Attendance</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>School <br>Opens</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Present</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Absent</td>
								  </tr>
								  
								</table>
								
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Punctuality</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Honesty</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Neatness</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Respect</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Leadership</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Mixing</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Demeanour</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Obedience</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>3. PSYCHOMOTOR SKILLS </strong></td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Library</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Sporting</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>								  
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Cultural</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Technical</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Others</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club Society ____________________</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">House Master's Remarks ___________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Class Teacher's Remarks __________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Principal's Remarks ______________
									_____________________________
									_____________________________
									_____________________________
									_____________________________

									<div align="center">
										<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px">
									</div>
									_________________________
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL STAMP & SIGN</td>
								  </tr>
								</table>
								

						
						</div>
					</div>
					<?php endif;?>
					
					
					
					
					
					
					
					
					
					
					
					
			<?php if($term == 2) : ?>
				<div class="row panel-body"> 
                    <div class="col-sm-9" > 
								<table width="1000" border="0">
								  <tr>
									<td>
										<!-- <div class="col-md-2">
											<img src="<?php echo base_url();?>uploads/logo.png" width="100px" height="100px">
										</div>-->
											<div class="col-md-8" style="text-align: center;">
												<div class="tile-stats tile-white tile-white-primary">
													<span style="text-align: center;font-size: 29px;">
														<?php echo $system_name;?>
													</span>
													<br/>
													
													<span style="text-align: center;font-size: 20px;">
														<?=get_settings('system_title');?>
													</span>
													<br/>
													<span style="text-align: center;font-size: 18px;">
                                                    <?php echo $system_address;?>
													</span>
													<br/>
													<br/>
												
              
												</div>
											</div>
											<!--<div class="col-md-2 logo" >
                                            <img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="100px">
											</div>-->
										</div>
										
									</td>
								  </tr>
								</table>
								
								
								
								<table width="700" border="0">
								  <tr>
									<td width=""> STUDENT'S REPORTS FOR:</td>
									<td width=""><strong><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></strong></td>
									<td width="">SESSION :</td>
									<td width=""><strong><?=get_settings('session');?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								  <tr>
									<td width="">NAME:</td>
									<td width=""><strong><?=$student_name;?></strong></td>
									<td width="">ADMISSION NO :</td>
									<td width=""><strong><?=$student_roll;?></strong></td>
									<td width="">CLASS:</td>
									<td width=""><strong><?=$class_name;?></strong></td>
								  </tr>
								  <tr>
									<td width="">PERFORMANCE IN SUBJECT:</td>
									<td width="">NUMBER IN CLASS:</td>
									<td width=""><strong><?=$number_class?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>
								

								
								<br />
						        <table width="100%" style="border:1px solid black">
								   <tr style="border:1px solid black">
										<td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>subject:</strong></td>
										<td style="border:1px solid black; padding-left:3px;transform:rotate(-5deg);"><strong>CA</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Exam <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Total <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>1st Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>3rd Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Annual <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Position</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Teacher's <br>Remarks</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Signature</strong></td>
								   </tr>
								   <tr style="border:1px solid black">
								   <td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>MARKS OBTAINABLE</strong></td>
								   </tr>
									
                                   <?php $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                            foreach ($select_subject as $key => $subject):?>
								   <tr>
								   
										<td style="border:1px solid black; padding-left:3px"><?php echo $subject['name'];?></td>
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 2));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            $class_score_two    = $obtained_mark_query->row()->class_score2;
                                            $class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $class_score_two + $class_score_three + $exam_score;
											
											$update['sum_second'] = $total_score;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
                                        } 
                                        ?>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_CA == 0)echo '';else echo $total_CA;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($exam_score == 0)echo ''; else echo $exam_score;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
										
										<td style="border:1px solid black; padding-left:3px"><?php //echo $total_score1;?> </td>
										
                                      
										<td style="border:1px solid black; padding-left:3px"></td>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
										<td style="border:1px solid black; padding-left:3px">
										
										<?php
										
										$subject_id = $subject['subject_id'];
 										$sql = "SELECT mark_id, sum_second, FIND_IN_SET( sum_second,(
												SELECT GROUP_CONCAT( sum_second  ORDER BY sum_second DESC ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND sum_second = $total_score AND sum_second!= 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo '--'; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?>
										
										</td>

										<td style="border:1px solid black; padding-left:3px"><?=$obtained_mark_query->row()->comment;?></td>
										<td style="border:1px solid black; padding-left:3px">
										<?php 
										$teacgerSubjectID = $obtained_mark_query->row()->subject_id;
										$returningTeacherId = $this->db->get_where('subject', array('subject_id' => $teacgerSubjectID ))->row()->teacher_id;
										?>
											<img src="<?php echo base_url();?>uploads/teacher_image/teacher_<?=$returningTeacherId?>.jpg" alt="sign" width="60px" height="30px">
										</td>
								    </tr>
									<?php endforeach;?>
							    </table>
								
								
								<hr>
								
								<table width="700" border="0">
								  <tr>
									<td width=""> Overall Total</td>
									<td width=""><strong>
									
                                <?php 
									$set = get_settings('session');
									$this->db->select_sum('sum_second');
									$this->db->from('mark');
									$this->db->where('student_id', $student_id);
									$this->db->where('term', 2);
									$this->db->where('session', $set);
									
									$query = $this->db->get();
									echo $sumTotalOfSecondScore = $query->row()->sum_second;
									
											$update['class_position_second'] = $sumTotalOfSecondScore;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);	
									
									$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 2, 
									'student_id' => $student_id, 'exam_score !=' => 0))->num_rows();
                                ?>
									
									</strong></td>
									<td width="">Overall Percentage:</td>
									<td width=""><strong>
									<?=round($sumTotalOfSecondScore /$getSubjectNumbered,2)?> %
									
									</strong></td>
									<td width="">Position: </td>
									<td width=""><strong>
										<?php
										
										
 										$sql = "SELECT mark_id, class_position_second, FIND_IN_SET( class_position_second,(
												SELECT GROUP_CONCAT( class_position_second  ORDER BY class_position_second desc ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id ))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND class_position_second = $sumTotalOfSecondScore AND class_position_second != 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo '--'; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?>
										 </strong></td>
								  </tr>
								  
								  <tr>
									<td width="">Passed/Failed: </td>
									<td width="">___________</td>
									<td width="">Next Term Begins:</td>
									<td width=""><strong><?=get_settings('next_term_begin')?></strong></td>
									
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>
								
							<br>
							
							<hr class="style16">
							<p align="center"> <strong>CUT ALONG THIS LINE</strong> </p>
							THE PRINCIPAL<br>
							I RECEIVED REPORT SHEET OF MY CHILD FOR THE <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
							WITH THANKS <strong style="margin-left:230px"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><br>
							<strong style="margin-left:470px">SIGNATURE</strong>
						
						</div>
						
						
						<div class="col-sm-3" style="height:1040px; border:1px solid black;">
							<div align="center">
								<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/logo.png" height="150px">
							</div>
							
							
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>1. AFFECTIVE DOMIAIN </strong></td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>2. PUNCTUALITY &amp; REGULARITY </strong></td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Attendance</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>School <br>Opens</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Present</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Absent</td>
								  </tr>
								  
								</table>
								
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Punctuality</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Honesty</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Neatness</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Respect</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Leadership</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Mixing</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Demeanour</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Obedience</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>3. PSYCHOMOTOR SKILLS </strong></td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Library</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Sporting</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>								  
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Cultural</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Technical</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Others</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club Society ____________________</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">House Master's Remarks ___________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Class Teacher's Remarks __________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Principal's Remarks ______________
									_____________________________
									_____________________________
									_____________________________
									_____________________________

									<div align="center">
										<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px">
									</div>
									_________________________
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL STAMP & SIGN</td>
								  </tr>
								</table>
								

						
						</div>
					</div>
					<?php endif;?>
					
					
					
					
					
					
					
					
					
					
				<?php if($term == 3) : ?>
				<div class="row panel-body"> 
                    <div class="col-sm-9" > 
								<table width="1000" border="0">
								  <tr>
									<td>
										<!-- <div class="col-md-2">
											<img src="<?php echo base_url();?>uploads/logo.png" width="100px" height="100px">
										</div>-->
											<div class="col-md-8" style="text-align: center;">
												<div class="tile-stats tile-white tile-white-primary">
													<span style="text-align: center;font-size: 29px;">
														<?php echo $system_name;?>
													</span>
													<br/>
													
													<span style="text-align: center;font-size: 20px;">
														<?=get_settings('system_title');?>
													</span>
													<br/>
													<span style="text-align: center;font-size: 18px;">
                                                    <?php echo $system_address;?>
													</span>
													<br/>
													<br/>
												
              
												</div>
											</div>
											<!--<div class="col-md-2 logo" >
                                            <img src="<?php echo $this->crud_model->get_image_url('student', $student_selected['student_id']); ?>"  height="100px">
											</div>-->
										</div>
										
									</td>
								  </tr>
								</table>
								
								<table width="700" border="0">
								  <tr>
									<td width=""> STUDENT'S REPORTS FOR:</td>
									<td width=""><strong><?php if($term == 1) echo '1ST TERM'; elseif($term == 2) echo '2ND TERM'; else echo '3RD TERM';?></strong></td>
									<td width="">SESSION :</td>
									<td width=""><strong><?=get_settings('session');?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								  <tr>
									<td width="">NAME:</td>
									<td width=""><strong><?=$student_name;?></strong></td>
									<td width="">ADMISSION NO :</td>
									<td width=""><strong><?=$student_roll;?></strong></td>
									<td width="">CLASS:</td>
									<td width=""><strong><?=$class_name;?></strong></td>
								  </tr>
								  <tr>
									<td width="">PERFORMANCE IN SUBJECT:</td>
									<td width="">NUMBER IN CLASS:</td>
									<td width=""><strong><?=$number_class?></strong></td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>

								
								<br />
						        <table width="100%" style="border:1px solid black">
								   <tr style="border:1px solid black">
										<td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>subject:</strong></td>
										<td style="border:1px solid black; padding-left:3px;transform:rotate(-5deg);"><strong>CA</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Exam <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Total <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>1st Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>2nd Term <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Annual <br>Score</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Position</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Teacher's <br>Remarks</strong></td>
										<td style="border:1px solid black; padding-left:3px"><strong>Signature</strong></td>
								   </tr>
								   <tr style="border:1px solid black">
								   <td style="border:1px solid black; padding-left:3px; text-transform:uppercase;"><strong>MARKS OBTAINABLE</strong></td>
								   </tr>
									
                                   <?php $select_subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                            foreach ($select_subject as $key => $subject):?>
								   <tr>
								   
										<td style="border:1px solid black; padding-left:3px"><?php echo $subject['name'];?></td>
                                        <?php 
										$obtained_mark_query = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 3));
                                        
										if($obtained_mark_query->num_rows() > 0){

                                            $class_score_one    = $obtained_mark_query->row()->class_score1;
                                            $class_score_two    = $obtained_mark_query->row()->class_score2;
                                            $class_score_three  = $obtained_mark_query->row()->class_score3;
                                            $exam_score         = $obtained_mark_query->row()->exam_score;
											$total_CA        	= $class_score_one + $class_score_two + $class_score_three;
                                            $total_score        = $class_score_one + $class_score_two + $class_score_three + $exam_score;
											

                                        } 
                                        ?>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_CA == 0)echo '';else echo $total_CA;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($exam_score == 0)echo ''; else echo $exam_score;?> </td>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score == 0)echo ''; else echo $total_score;?></td>
										
                                        <?php 
										$obtained_mark_query1 = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 1));
                                        
										if($obtained_mark_query1->num_rows() > 0){

                                            $class_score_one1    = $obtained_mark_query1->row()->class_score1;
                                            $class_score_two1    = $obtained_mark_query1->row()->class_score2;
                                            $class_score_three1  = $obtained_mark_query1->row()->class_score3;
											$exam_score1         = $obtained_mark_query1->row()->exam_score;
											$total_score1        = $class_score_one1 + $class_score_two1 + $class_score_three1 + $exam_score1;



                                        } 
                                        ?>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score1 == 0)echo ''; else echo $total_score1;?></td>
										
                                        <?php 
										$obtained_mark_query2 = $this->db->get_where('mark', 
											array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
											'student_id' => $student_id, 'term' => 2));
                                        
										if($obtained_mark_query2->num_rows() > 0){

                                            $class_score_one2    = $obtained_mark_query2->row()->class_score1;
                                            $class_score_two2    = $obtained_mark_query2->row()->class_score2;
                                            $class_score_three2  = $obtained_mark_query2->row()->class_score3;
											$exam_score2         = $obtained_mark_query2->row()->exam_score;
											$total_score2        = $class_score_one2 + $class_score_two2 + $class_score_three2 + $exam_score2;



                                        } 
                                        ?>
										<td style="border:1px solid black; padding-left:3px"><?php if($total_score2 == 0)echo ''; else echo $total_score2;?></td>
										
										<?php 
										$sumTotal = $total_score + $total_score1 + $total_score2;
										$annualTotalScore = $sumTotal / 3;
										
											/********     {Want to save the result of all anual into the mark table}     ****************/
											
											$update['sum_third'] = round($annualTotalScore);
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);
											
										?>
			
										
										
										<td style="border:1px solid black; padding-left:3px"><?php if(round($annualTotalScore) == 0) echo ''; else echo (round($annualTotalScore));?></td>
										<td style="border:1px solid black; padding-left:3px">
										<?php
										
										$subject_id = $subject['subject_id'];
 										$sql = "SELECT mark_id, sum_third, FIND_IN_SET( sum_third,(
												SELECT GROUP_CONCAT( sum_third  ORDER BY sum_third desc ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id ))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND sum_third = round($annualTotalScore) AND sum_third != 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo ''; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?>
										
										</td>

										<td style="border:1px solid black; padding-left:3px"><?=$obtained_mark_query->row()->comment;?></td>
										<td style="border:1px solid black; padding-left:3px">
										<?php 
										$teacgerSubjectID = $obtained_mark_query->row()->subject_id;
										$returningTeacherId = $this->db->get_where('subject', array('subject_id' => $teacgerSubjectID ))->row()->teacher_id;
										?>
											<img src="<?php echo base_url();?>uploads/teacher_image/teacher_<?=$returningTeacherId?>.jpg" alt="sign" width="60px" height="30px">
										</td>
								    </tr>
									<?php endforeach;?>
							    </table>
								
								<hr>
								
								<table width="700" border="0">
								  <tr>
									<td width=""> Overall Total</td>
									<td width=""><strong>
									
                                <?php 
									$set = get_settings('session');
									$this->db->select_sum('sum_third');
									$this->db->from('mark');
									$this->db->where('student_id', $student_id);
									$this->db->where('term', 3);
									$this->db->where('session', $set);
									
					$query = $this->db->get();									
					echo $sumTotalOfThirdScore = $query->row()->sum_third;
				
											$update['class_position_third'] = $sumTotalOfThirdScore;
											$this->db->where('subject_id' , $subject['subject_id']);
											$this->db->where('student_id' , $student_id);
											$this->db->update('mark', $update);	
				
					$getSubjectNumbered = $this->db->get_where('mark', array('class_id' => $class_id, 'term' => 3,'student_id' => $student_id, 
					'sum_third !=' => 0))->num_rows();
									
                                ?>
									
									</strong></td>
									<td width="">Overall Percentage:</td>
									<td width=""><strong>
											<?=round($sumTotalOfThirdScore /$getSubjectNumbered,2)?> %
									
									</strong></td>
									<td width="">Position: </td>
									<td width=""><strong>
									<?php
										
										
 										$sql = "SELECT mark_id, class_position_third, FIND_IN_SET( class_position_third,(
												SELECT GROUP_CONCAT( class_position_third  ORDER BY class_position_third desc ) 
												FROM mark WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id ))
												AS rank 
												FROM mark
												WHERE exam_id = $exam_id AND class_id = $class_id AND subject_id = $subject_id AND class_position_third = $sumTotalOfThirdScore AND class_position_third != 0"; 
        
        								$rank =  $this->db->query($sql)->row()->rank; 
        
										if($rank == 0){
											echo '--'; 
										}
        
										if($rank == 1){
											echo $rank.'st';
										}elseif($rank == 2){
										   echo $rank.'nd'; 
										}elseif($rank == 3){
										   echo $rank.'rd'; 
										}elseif($rank > 3 ){
											echo $rank.'th';         
										}else{
											echo '--'; 
										}
										
										
										?> </strong></td>
								  </tr>
								  
								  <tr>
									<td width="">Passed/Failed: </td>
									<td width="">___________</td>
									<td width="">Next Term Begins:</td>
									<td width=""><strong><?=get_settings('next_term_begin')?></strong></td>
									
									<td width="">&nbsp;</td>
									<td width="">&nbsp;</td>
								  </tr>
								</table>
								
								
						    <br>
							
							<hr class="style16">
							<p align="center"> <strong>CUT ALONG THIS LINE</strong> </p>
							THE PRINCIPAL<br>
							I RECEIVED REPORT SHEET OF MY CHILD FOR THE <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
							WITH THANKS <strong style="margin-left:230px"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><br>
							<strong style="margin-left:470px">SIGNATURE</strong>
						
						</div>
						
						
						<div class="col-sm-3" style="height:1040px; border:1px solid black;">
							<div align="center">
								<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/logo.png" height="150px">
							</div>
							
							
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>1. AFFECTIVE DOMIAIN </strong></td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>2. PUNCTUALITY &amp; REGULARITY </strong></td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Attendance</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>School <br>Opens</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Present</td>
									<td style="font-size:11px;border:1px solid black;padding:5px;">Times <br>Absent</td>
								  </tr>
								  
								</table>
								
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Punctuality</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Honesty</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Neatness</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Respect</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Leadership</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Mixing</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Demeanour</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Obedience</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;"><strong>3. PSYCHOMOTOR SKILLS </strong></td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Library</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Sporting</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>								  
								  </tr>
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Cultural</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Technical</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Others</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								  
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(1) ____</td>
									<td style="font-size:11px;border:1px solid black;padding:6px;">(2) ____</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Club Society ____________________</td>
								  </tr>
								</table>
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">House Master's Remarks ___________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Class Teacher's Remarks __________
									_____________________________
									_____________________________
									_____________________________
									_____________________________</td>
								  </tr>
								</table>
								
								<table width="100%" border="0">
								  <tr>
									<td style="font-size:11px;border:1px solid black;padding:6px;">Principal's Remarks ______________
									_____________________________
									_____________________________
									_____________________________
									_____________________________

									<div align="center">
										<img style="padding-top:10px;padding-bottom:10px" src="<?php echo base_url();?>uploads/signature.png" width="150px" height="50px">
									</div>
									_________________________
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL STAMP & SIGN</td>
								  </tr>
								</table>
								

						
						</div>
					</div>
					<?php endif;?>
					
					
					
					
					
					
						
						
          

                    <hr>
                    <?php endforeach;?>
				<hr />
				
					</div>
				</div>
				<button id="print" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button"> <span><i class="fa fa-print"></i>&nbsp;Print</span> </button>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript" src="<?php echo base_url();?>js/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jspdf.min.js"></script>
<script type="text/javascript">
    var pages = $('.print');
    var doc = new jsPDF();
    var j = 0;
    for (var i = 0 ; i < pages.length; i++) {
        html2canvas(pages[i]).then(function(canvas) {
        var img=canvas.toDataURL("image/png");
        // debugger;
        var height =  canvas.height / 440 * 80;
        doc.addImage(img,'PNG',10,0,190,height);
        if (j < (pages.length - 1) ) doc.addPage();
        if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
        j++;
        });
    }
    
</script>
