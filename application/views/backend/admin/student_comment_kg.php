	<?php 
		$session = get_settings('session');
		$term = get_settings('term');
	?>
				<?php 
					  $select = $this->db->get_where('prekg', array('student_id' => $param2, 'session' => $session, 'term' => $term))->row();
				 	  
				?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_remarks_for'); ?> : <?=$this->crud_model->get_type_name_by_id('student', $select->student_id);?></div>
				


				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/student_remarks/prekg/'. $select->prekg_id , array('class' => 'form-horizontal form-goups-bordered validate'));?>
				
					<input class="" type="hidden" value="<?=$select->class_id;?>" name="class_id">
					<input class="" type="hidden" value="<?=$select->student_id;?>" name="student_id">
					<input class="" type="hidden" value="<?=$select->exam_id;?>" name="exam_id">
					<input class="" type="hidden" value="<?=$select->subject_id;?>" name="subject_id">
				
				
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note personal development grading can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="class_teacher_comment" type="text" class="form-control" value="<?=$select->class_teacher_comment;?>" / required>
								
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('head_teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="head_teacher_comment" type="text" class="form-control" value="<?=$select->head_teacher_comment;?>" / required>
                            </div>
                     </div>
					 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('consistently');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="consistently" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->consistently;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('most_of_the_time');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="most_of_the_time" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->most_of_the_time;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('needs_improvement');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="needs_improvement" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->needs_improvement;?>" / required>
                            </div>
                     </div>
							
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				
				
				
				
				
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