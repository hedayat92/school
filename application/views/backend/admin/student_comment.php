	<?php 
		$session = get_settings('session');
		$term = get_settings('term');
	?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_remarks_for'); ?> : <?=$this->crud_model->get_type_name_by_id('student', $param2);?></div>
			
			
				<?php

				 $select = $this->db->get_where('stu_rem', array('student_id' => $param2, 'session' => $session, 'term' => $term))->row();
				 if($select->student_id == "") : 
				 
				 ?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/student_remarks/save/' , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note personal development grading can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="class_comment" type="text" class="form-control" value="" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$param2;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('head_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="head_comment" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('mental_alertness');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ma" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('physical_development');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pd" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('relating_with_teachers');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="rt" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('relating_with_mates');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="rm" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('general_habit_&_attitude');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="gha" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('punctuality');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="p" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('neatness');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="n" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('leadership_traits');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="lt" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
							
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				<?php endif;?>
				
				
				
				<?php 
					  $select = $this->db->get_where('stu_rem', array('student_id' => $param2, 'session' => $session, 'term' => $term))->row();
				 	  if($select->student_id != "") : 
				?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/student_remarks/save/'. $select->stu_rem_id , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note personal development grading can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="class_comment" type="text" class="form-control" value="<?=$select->class_comment;?>" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$param2;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('head_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="head_comment" type="text" class="form-control" value="<?=$select->head_comment;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('mental_alertness');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ma" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ma;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('physical_development');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pd" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->pd;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('relating_with_teachers');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="rt" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->rt;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('relating_with_mates');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="rm" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->rm;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('general_habit_&_attitude');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="gha" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->gha;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('punctuality');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="p" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->p;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('neatness');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="n" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->n;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('leadership_traits');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="lt" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->lt;?>" / required>
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
						<script>				  
							function class_score_change() {
							  var check = document.getElementsByClassName('check');
								for (var i = check.length - 1; i >= 0; i--) {
								  var value = check[i].value;
									if (value > 5) {
										check[i].value = 0;
											$('#error_message').show();
									}
								}
							}

						</script>
						    <!-- auto hide message div-->
    <script type="text/javascript">
        $( document ).ready(function(){
           $('.hide_msg').delay(2000).slideUp();
        });
    </script>