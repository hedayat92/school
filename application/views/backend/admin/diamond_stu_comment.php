	<?php 
		$session = get_settings('session');
		$term = get_settings('term');
		$mid_ter_rep_card = get_settings('mid_ter_rep_card');
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

				 $select = $this->db->get_where('diamond_stu_comment', array('student_id' => $student_id, 'session' => $session, 'term' => $term, 'status' => $mid_ter_rep_card))->row();
				 if($select->student_id == "") : 
				 
				 ?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/diamond_stu_comment/save/' , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note that assessment and psychomotor assessment can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('principal_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="p_comment" type="text" class="form-control" value="" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="tcomment" type="text" class="form-control" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">PUNCTUALITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pu" type="number" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CLASSROOM ATTENDANCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cl" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CARRYING OUT ASSIGNMENT <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="car" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">NEATNESS <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="ne" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">POLITENESS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="po" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HONESTY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ho" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SELF CONTROL <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="se" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">RELATIONSHIP WITH OTHERS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="re" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SENSE OF RESPONSIBILITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sen" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">OBEDIENCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ob" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
							
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">INITIATIVE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ini" type="number" onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">ORGANISATIONAL ABILITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="org" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HANDWRITING <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="han" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">FLUENCY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fl" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">GAMES <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ga" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SPORTS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sp" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">GYMNASTICS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="gy" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">DRAWING & PAINTING <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="dr" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">MUSICAL PERFORMANCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="mu" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HANDLING TOOLS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ha" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div>  
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CRAFTS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cr" type="number"  onchange="class_score_change()" class="form-control check" value="" / required>
                            </div>
                     </div> 
					 
		
                     
                     <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>
                <?php echo form_close();?>
				<?php endif;?>
				
				
				
				<?php 
					  $select = $this->db->get_where('diamond_stu_comment', array('student_id' => $student_id, 'session' => $session, 'term' => $term, 'status' => $mid_ter_rep_card))->row();
				 	  if($select->student_id != "") : 
				?>

				<?php echo form_open(base_url() . $this->session->userdata('login_type').'/diamond_stu_comment/save/'. $select->id , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<h5 id="error_message" class="alert alert-red hide_msg" style="display:none">Please note personal development grading can not be more than 5</h5>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('principal_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="p_comment" type="text" class="form-control" value="<?=$select->p_comment;?>" / required>
								<input name="session" type="hidden" class="form-control" value="<?=get_settings('session');?>" / required>
								<input name="term" type="hidden" class="form-control" value="<?=get_settings('term');?>" / required>
								<input name="student_id" type="hidden" class="form-control" value="<?=$student_id;?>" / required>
								<input name="exam_id" type="hidden" class="form-control" value="<?=$exam_id;?>" / required>
								<input name="class_id" type="hidden" class="form-control" value="<?=$class_id;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('teacher_comment');?> <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="tcomment" type="text" class="form-control" value="<?=$select->tcomment;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">PUNCTUALITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="pu" type="number" class="form-control check" value="<?=$select->pu;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CLASSROOM ATTENDANCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cl" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->cl;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CARRYING OUT ASSIGNMENT <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="car" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->car;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">NEATNESS <b style="color:red">*</b></label>
                    		<div class="col-sm-12"> 
                                <input name="ne" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ne;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">POLITENESS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="po" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->po;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HONESTY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ho" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ho;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SELF CONTROL <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="se" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->se;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">RELATIONSHIP WITH OTHERS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="re" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->re;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SENSE OF RESPONSIBILITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sen" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->sen;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">OBEDIENCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ob" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->ob;?>" / required>
                            </div>
                     </div>
							
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">INITIATIVE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ini" type="number" onchange="class_score_change()" class="form-control check" value="<?=$select->ini;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">ORGANISATIONAL ABILITY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="org" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->org;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HANDWRITING <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="han" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->han;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">FLUENCY <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="fl" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->fl;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">GAMES <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ga" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->ga;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">SPORTS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="sp" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->sp;?>" / required>
                            </div>
                     </div>
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">GYMNASTICS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="gy" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->gy;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">DRAWING & PAINTING <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="dr" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->dr;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">MUSICAL PERFORMANCE <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="mu" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->mu;?>" / required>
                            </div>
                     </div> 
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">HANDLING TOOLS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="ha" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->ha;?>" / required>
                            </div>
                     </div>  
					 
					<div class="form-group">
                 		<label class="col-md-12" for="example-text">CRAFTS <b style="color:red">*</b></label>
                    		<div class="col-sm-12">
                                <input name="cr" type="number"  onchange="class_score_change()" class="form-control check" value="<?=$select->cr;?>" / required>
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