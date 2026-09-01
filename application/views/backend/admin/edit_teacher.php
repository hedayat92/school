<?php 
		$teachers = $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->result_array();
    	foreach ($teachers as $key => $row):
?>
				
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
                            
            <div class="panel-body">	
            <?php echo form_open(base_url() . 'admin/teacher/update/'. $row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                        <div class="col-sm-6">

                        

                            <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                            <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"  / required>

                                </div>
                            </div>
					
                            <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('role');?></label>
                            <div class="col-sm-12">
                                    <select name="role" class="form-control select2" style="width:100%" required>
                                    <option value="1"<?php if($row['role'] == '1') echo 'selected="selected"' ;?>><?php echo get_phrase('class_teacher');?></option>
                                    <option value="2"<?php if($row['role'] == '2') echo 'selected="selected"' ;?>><?php echo get_phrase('subject_teacher');?></option>
                                </select>
                                </div> 
                            </div>
					
                            <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('birthday');?></label>
                                <div class="col-sm-12">
                                <input type="text" class="datepicker form-control" name="birthday" value="<?php echo $row['birthday'];?>"/>                                </div> 
                            </div>
					
                            <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('gender');?></label>
                                <div class="col-sm-12">
                                    <select name="sex" class="form-control select2" style="width:100%" required>
                                    <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                    	<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div> 
                            </div>
					
						    <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('religion');?></label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="religion" value="<?php echo $row ['religion']; ?>" >
						        </div> 
					        </div>
					
					        <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('blood_group');?></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="blood_group" value="<?php echo $row ['blood_group']; ?>" >
						        </div> 
					        </div>
					
						    <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
						        </div> 
					        </div>

				            <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-12">
							        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" required >
						        </div> 
					        </div>
                    
					        <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-12">
							        <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
						        </div>
					        </div>
					
					        <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('qualification');?></label>
                                <div class="col-sm-12">
							        <input type="text" class="form-control" name="qualification" value="<?php echo $row['qualification'];?>">
						        </div>
					        </div>
					
					        <div class="form-group">
                                <label class="col-sm-12"><?php echo get_phrase('marital_status');?>*</label>
                                <div class="col-sm-12">
                                    <select class=" form-control select2" name="marital_status" style="width:100%" required>
                                    <option value="Married" <?php if($row['marital_status'] == 'Married')echo 'selected';?>><?php echo get_phrase('Married');?></option>
                                    	<option value="Single" <?php if($row['marital_status'] == 'Single')echo 'selected';?>><?php echo get_phrase('Single');?></option>
										<option value="Divorced" <?php if($row['marital_status'] == 'Divorced')echo 'selected';?>><?php echo get_phrase('Divorced');?></option>
                                    	<option value="Engaged" <?php if($row['marital_status'] == 'Engaged')echo 'selected';?>><?php echo get_phrase('Engaged');?></option>
                                    </select>
                                </div>
                            </div>
					
                            <div class="form-group">
                                    <label class="col-md-12" for="furl"><?php echo get_phrase('facebook');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="furl" name="facebook" value="<?php echo $row['facebook']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="turl"><?php echo get_phrase('twitter');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="turl" name="twitter" class="form-control" value="<?php echo $row['twitter']; ?>" >
                                    </div>
                                </div>
					
						    <div class="form-group">
                 	            <label class="col-md-12" for="example-text"><?php echo get_phrase('googleplus');?></label>
                                <div class="col-sm-12">
							        <input type="text" class="form-control" name="googleplus" value="<?php echo $row['googleplus'];?>">
						        </div>
					        </div>
				
					    </div>	
					
                    <div class="col-sm-6">
		            <hr class="sep-2">
                    <div class="alert alert-primary">HUMAN RESOURCES INFORMATION</div>
                    <hr class="sep-2">			 
					
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('department'); ?></label>
                        <div class="col-sm-12">
                            <select name="department_id" id="department_id" class="form-control select2" 
							onchange="return get_designation_val(this.value, <?php echo $teacher_id;?>)" required>
								<?php
                                $department = $this->db->get('department')->result_array();
                                foreach ($department as $row2): ?>
                                    <option value="<?php echo $row2['department_id']; ?>"
                                    <?php if($row['department_id'] == $row2['department_id']) echo 'selected="selected"' ;?>><?php echo $row2['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('designation'); ?></label>

                        <div class="col-sm-12">
                            <select name="designation_id" class="form-control" id="designation_holder">
                                <option value=""><?php echo get_phrase('select_a_department_first'); ?></option>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('date_of_joining'); ?></label>

                        <div class="col-sm-12">
                            <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo $row['date_of_joining'];?>" required>
                        </div> 
                    </div>
                    <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('joining_salary'); ?></label>

                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="joining_salary" value="<?php echo $row['joining_salary'];?>" required>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-12">
                            <select name="status" class="form-control select2">
                                <option value="1"<?php if($row ['status'] == '1') echo 'selected="selected"';?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"<?php if($row ['status'] == '2') echo 'selected="selected"';?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('date_of_leaving'); ?></label>

                        <div class="col-sm-12">
                            <input type="date" class="form-control datepicker" name="date_of_leaving" value="<?php echo $row['date_of_leaving'];?>" required>
                        </div> 
                    </div>

                    <hr class="sep-2">	
                        <div class="alert alert-primary">BANK ACCOUNT DETAILS</div>
                    <hr class="sep-2">	

                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('account_holder_name'); ?></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="account_holder_name" value="<?php echo $row['account_holder_name'];?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('account_number'); ?></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="account_number" value="<?php echo $row['account_number'];?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('bank_name'); ?></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="bank_name" value="<?php echo $row['bank_name'];?>" required>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('branch'); ?></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="branch" value="<?php echo $row['branch'];?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('linkedin');?></label>
                            <div class="col-sm-12">
                            <input type="text" id="inurl" name="linkedin" class="form-control" value="<?php echo $row['linkedin']; ?>">
						</div>
					</div>

                    <div class="form-group"> 
					 		<label class="col-sm-12"><?php echo get_phrase('browse_image');?>*</label>        
					 		<div class="col-sm-12">
  		  			 			<input type='file' class="form-control" name="userfile"/>
       				 			<img id="blah" src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" alt="" height="200" width="200"/>

							</div>
					</div>	

                </div>
            </div>

            <div class="form-group">			
                <button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
            </div>			
                <?php echo form_close();?>				
									
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>



		<script type="text/javascript">
		
			function get_designation_val(department_id) {
		
				$.ajax({
					url: '<?php echo base_url();?>admin/get_designation/' + department_id ,
					success: function(response)
					{
						jQuery('#designation_holder').html(response);
					}
				});
		
			}
		
		</script>





		<script>
			$(document).ready(function() {
				var department_id = $('#department_id').val();
				var teacher_id = '<?php echo $teacher_id;?>';
				get_designation_val(department_id,teacher_id);
				
			});
		</script>
	
