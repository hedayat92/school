
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Enter Student Score');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/marks' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Exam');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">

                                        <?php
											$this->db->order_by('exam_id', 'desc'); 
											$exams =  $this->db->get('exam')->result_array();
                                        	foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?></label>
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <select name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
                                        <option value="">Select student in <?php echo $row['name'] ;?></option>

                                        <?php $students = $this->crud_model->get_students($row['class_id']);
                                        foreach ($students as $key => $student): ?>
                                        <option value="<?php echo $student['student_id'];?>"<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?>><?php echo $student['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Select Class First');?></option>
                                    </select>
                                </div>
                            </div>
							
							
                            <!--
							<div class="form-group">
								<label class="col-md-12" for="example-text"><?php echo get_phrase('class_section');?></label>
                                <div class="col-sm-12">
									<select name="section_id" class="form-control" id="section_selector_holder" / required>
										<option value=""><?php echo get_phrase('select_section');?></option>
									</select>
                                </div>
                            </div>
							-->
							
							

                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Details');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>

	<style>
		.alert-red{
			background-color: red;
			color:white;
		}
	</style>
	
	<?php if($class_id > 0 && $student_id > 0 && $exam_id > 0):?>	

    <?php $select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
            foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student): 

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $class_subject_exam_student['subject_id']);
                $query = $this->db->get_where('mark', $verify_data);
				
				$sql = "select * from mark order by mark_id desc limit 1";
				$return_query = $this->db->query($sql)->row()->mark_id + 1;
				$verify_data['mark_id'] = $return_query;
				$verify_data['term'] 	= get_settings('term');
				$verify_data['session']	= get_settings('session');

                if($query->num_rows() < 1)
                    $this->db->insert('mark', $verify_data);
					
					$this->db->where('student_id', 0);
					$this->db->delete('mark');
					
					
            endforeach;?>


					
    <div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_student_score'); ?></div>
                <div class="panel-body table-responsive">
							   
						
						
						<?php if($report_template == 'udemy') : ?>
						
						<h5 id="error_message" class="alert alert-red" style="display:none">CA score must not be greater 20 and exam score must not be greater than 60</h5>
						<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td>CA 1 (20%)</td>
										<td>CA 2 (20%)</td>
										<td><?php echo get_phrase('exam_score');?> (60%)</td>
										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

										<?php $select_subject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
											foreach ($select_subject_with_class_id as $key => $class_subject_exam_student): 
								
												$verify_data = array('exam_id' => $exam_id, 
												'class_id' => $class_id, 'student_id' => $student_id, 
												'subject_id' => $class_subject_exam_student['subject_id']);
												
												$query = $this->db->get_where('mark', $verify_data);
												$update_subject_marks = $query->result_array();
								
												foreach ($update_subject_marks as $key => $general_select):
										   ?>
                    	
										
											<?php echo form_open(base_url() . 'admin/marks/'. $exam_id . '/' . $class_id);?>
										<tr>
											<td>
												<?php echo $class_subject_exam_student['name'];?>
											</td>
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score1'];?>" 
												name="class_score1_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()">
											</td>
											
											 
											<td>
												<input type="text" class="class_score form-control" value="<?php echo $general_select['class_score2'];?>" 
												name="class_score2_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()">
											</td>
											
											  <td>
												<input type="text" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" 
												name="exam_score_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="exam_score_change()">
											 </td>

			
											<td>
												<input type="text" value="<?php echo $general_select['comment'];?>" name="comment_<?php echo $class_subject_exam_student['subject_id'];?>" class="form-control">
											</td>
												<input type="hidden" name="mark_id_<?php echo $class_subject_exam_student['subject_id'] ;?>" 
												value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
										</tr>

									<?php endforeach; endforeach;?>
                    			</tbody>
   				  </table>
							

                      	<button type="submit" class="btn btn-sm btn-rounded btn-block  btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>		
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
			
			
	
			
			
    }
</script>