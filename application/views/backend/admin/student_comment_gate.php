	<?php 
		$session = get_settings('session');
		$term = get_settings('term');
		$explode	= explode('-', $param2);
		$class_id 	= $explode[0];
		$exam_id 	= $explode[1];
		$student_id = $explode[2];
		
	?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_remarks_for'); ?> : <?=$this->crud_model->get_type_name_by_id('student', $student_id);?></div>
			
			
				<?php

				 $select = $this->db->get_where('udemy_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();
				 if($select->student_id == "") : 
				 
				 ?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/udemy_stu_rem/save/' , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note that assessment and psychomotor assessment can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">TEACHER'S REMARKS: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fmc" type="text" class="form-control" value="" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">TEACHER'S NAME: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fma" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HEAD OF SCHOOL REMARKS: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pc" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					  <h3>AFFECTIVE ASSESSMENT RATINGS</h3>
					  
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Punctuality <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="at" type="number" onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Attendance <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ho" type="number" onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Reliability <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="ne" type="number" onchange="class_score_change()" class="form-control check"  / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Neatness <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="po" type="number" onchange="class_score_change()" class="form-control check"  / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Politeness <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pu" type="number" onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Relationship with Students <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="re" type="number" onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div>
					 
					  <h3>PSYCHOMOTOR ASSESSMENT RATINGS</h3>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Handwriting <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cl" type="number" onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Games <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="dr" type="number"  onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Sports <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ha" type="number"  onchange="class_score_change()" class="form-control check" / required>
                            </div>
                     </div>
							
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Drawing &amp; Painting <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="hob" type="number" onchange="class_score_change()" class="form-control check"  / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Crafts <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sp" type="number"  onchange="class_score_change()" class="form-control check"  / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Musical Skills <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="spo" type="number"  onchange="class_score_change()" class="form-control check"  / required>
                            </div>
                     </div>
		
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				<?php endif;?>
				
				
				
				<?php 
					  $select = $this->db->get_where('udemy_stu_rem', array('student_id' => $student_id, 'session' => $session, 'term' => $term))->row();
				 	  if($select->student_id != "") : 
				?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/udemy_stu_rem/save/'. $select->id , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note personal development grading can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">TEACHER'S REMARKS: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fmc" type="text" class="form-control" value="<?=$select->fmc;?>" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">TEACHER'S NAME: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fma" type="text" class="form-control" value="<?=$select->fma;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HEAD OF SCHOOL REMARKS: <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pc" type="text" class="form-control" value="<?=$select->pc;?>" / required>
                            </div>
                     </div>
					 
					 <h3>AFFECTIVE ASSESSMENT RATINGS</h3>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Punctuality <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="at" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->at;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Attendance <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ho" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ho;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Reliability <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="ne" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ne;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Neatness <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="po" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->po;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Politeness <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pu" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->pu;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Relationship with Students <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="re" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->re;?>" / required>
                            </div>
                     </div>
					 
					 
					 <h3>PSYCHOMOTOR ASSESSMENT RATINGS</h3>
					 
					 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Handwriting <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cl" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->cl;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Games <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="dr" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->dr;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Sports <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ha" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->ha;?>" / required>
                            </div>
                     </div>
							
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Drawing &amp; Painting <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="hob" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->hob;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Crafts <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sp" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->sp;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">Musical Skills <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="spo" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->spo;?>" / required>
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