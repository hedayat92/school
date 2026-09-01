<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				
				<a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/bulk_student/')" 
				class="btn btn-info btn-sm btn-rounded"><i class="fa fa-upload"></i> <?php echo get_phrase('bulk_students_upload');?></a>
				
	<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;CLICK HERE TO ADD<i class="btn btn-primary btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div></div>
    <div class="panel-wrapper collapse out" aria-expanded="true">
                        <div class="panel-body">

					<?php echo form_open(base_url() . 'admin/new_student/multiple_student' , array('class' => 'form-inline form-groups-bordered validate'));?>		
											 <span id="designation">
											  <br>
												<div class="form-group">
														<div class="col-md-2">
														<input name="name[]" id="name" type="text" class="form-control" placeholder="<?php echo get_phrase('name');?>" >
														</div>
					
														<div class="col-md-2">
														<input name="email[]" id="email" type="email" class="form-control" placeholder="<?php echo get_phrase('email');?>">
														</div>
					
														<div class="col-md-2">
														<input name="password[]" id="password" type="password" class="form-control" placeholder="<?php echo get_phrase('password');?>">
														</div>
					
														<div class="col-md-2">
														<input name="roll[]" id="roll" value="" placeholder="admission no" type="text" 
														class="form-control">
														</div>
					
														<div class="col-md-2">
														<input name="phone[]" id="phone" type="text" class="form-control" placeholder="<?php echo get_phrase('phone');?>">
														</div>
														
														<div class="col-md-2">
														<input name="address[]" id="address" type="text" class="form-control" placeholder="<?php echo get_phrase('address');?>">
														</div>
														
														<div class="col-md-2">
														<select name="sex[]" id="sex" class="form-control ">
															<option value=""><?php echo get_phrase('select_gender');?></option>
															<option value="male"><?php echo get_phrase('male');?></option>
															<option value="female"><?php echo get_phrase('female');?></option>
														</select>
														</div>
														
														<div class="col-md-2">
															<select name="parent_id[]" id="parent_id" class="form-control " style="width:100%">
                              									<option value=""><?php echo get_phrase('select_parent');?></option>
																  <?php 
																	$parents = $this->db->get('parent')->result_array();
																	foreach($parents as $row):
																		?>
																		<option value="<?php echo $row['parent_id'];?>">
																			<?php echo $row['name'];?>
																		</option>
																	<?php
																	endforeach;
																  ?>
                          									</select>
														</div>
														
														<div class="col-md-2">
															<select name="house_id[]" class="form-control " style="width:100%" >
															  <option value=""><?php echo get_phrase('select');?></option>
															  <?php 
																$house = $this->db->get('house')->result_array();
																foreach($house as $row):
																	?>
																	<option value="<?php echo $row['house_id'];?>">
																		<?php echo $row['name'];?>
																	</option>
																<?php
																endforeach;
															  ?>
														  </select>
														</div>
														
														<div class="col-md-2">
															<select name="club_id[]" class="form-control" style="width:100%" >
														  <option value=""><?php echo get_phrase('select');?></option>
														  <?php 
															$club = $this->db->get('club')->result_array();
															foreach($club as $row):
																?>
																<option value="<?php echo $row['club_id'];?>">
																	<?php echo $row['club_name'];?>
																</option>
															<?php
															endforeach;
														  ?>
													  </select>
														</div>
														
														<div class="col-md-2">
															<select name="student_category_id[]" class="form-control" style="width:100%" >
															  <option value=""><?php echo get_phrase('select');?></option>
															  <?php 
																$student_category = $this->db->get('student_category')->result_array();
																foreach($student_category as $row):
																	?>
																	<option value="<?php echo $row['student_category_id'];?>">
																		<?php echo $row['name'];?>
																	</option>
																<?php
																endforeach;
															  ?>
														  </select>
														</div>
														
					
												</div>
                        					</span>
											
											 <span id="designation_input">
											 
											 <div class="form-group">
											 <br>
														<div class="col-md-2">
														<input name="name[]" id="name" type="text" class="form-control" placeholder="<?php echo get_phrase('name');?>">
														</div>
					
														<div class="col-md-2">
														<input name="email[]" id="email" type="email" class="form-control" placeholder="<?php echo get_phrase('email');?>">
														</div>
					
														<div class="col-md-2">
														<input name="password[]" id="password" type="password" 
														class="form-control" placeholder="<?php echo get_phrase('password');?>">
														</div>
					
														<div class="col-md-2">
														<input name="roll[]" id="roll" value="" placeholder="admission no" type="text" 
														class="form-control">
														</div>
					
														<div class="col-md-2">
														<input name="phone[]" id="phone" type="text" class="form-control" placeholder="<?php echo get_phrase('phone');?>">
														</div>
														
														<div class="col-md-2">
														<input name="address[]" id="address" type="text" class="form-control" placeholder="<?php echo get_phrase('address');?>">
														</div>
														
														<div class="col-md-2">
														<select name="sex[]" id="sex" class="form-control ">
															<option value=""><?php echo get_phrase('select_gender');?></option>
															<option value="male"><?php echo get_phrase('male');?></option>
															<option value="female"><?php echo get_phrase('female');?></option>
														</select>
														</div>
														
														<div class="col-md-2">
															<select name="parent_id[]" id="parent_id" class="form-control " style="width:100%" >
                              									<option value=""><?php echo get_phrase('select_parent');?></option>
																  <?php 
																	$parents = $this->db->get('parent')->result_array();
																	foreach($parents as $row):
																		?>
																		<option value="<?php echo $row['parent_id'];?>">
																			<?php echo $row['name'];?>
																		</option>
																	<?php
																	endforeach;
																  ?>
                          									</select>
														</div>
														
														<div class="col-md-2">
															<select name="house_id[]" class="form-control select2" style="width:100%">
															  <option value=""><?php echo get_phrase('select');?></option>
															  <?php 
																$house = $this->db->get('house')->result_array();
																foreach($house as $row):
																	?>
																	<option value="<?php echo $row['house_id'];?>">
																		<?php echo $row['name'];?>
																	</option>
																<?php
																endforeach;
															  ?>
														  </select>
														</div>
														
														<div class="col-md-2">
															<select name="club_id[]" class="form-control select2" style="width:100%" >
														  <option value=""><?php echo get_phrase('select');?></option>
														  <?php 
															$club = $this->db->get('club')->result_array();
															foreach($club as $row):
																?>
																<option value="<?php echo $row['club_id'];?>">
																	<?php echo $row['club_name'];?>
																</option>
															<?php
															endforeach;
														  ?>
													  </select>
														</div>
														
														<div class="col-md-2">
															<select name="student_category_id[]" class="form-control select2" style="width:100%" >
															  <option value=""><?php echo get_phrase('select');?></option>
															  <?php 
																$student_category = $this->db->get('student_category')->result_array();
																foreach($student_category as $row):
																	?>
																	<option value="<?php echo $row['student_category_id'];?>">
																		<?php echo $row['name'];?>
																	</option>
																<?php
																endforeach;
															  ?>
														  </select>
														</div>
														
					
														<div class="col-md-1">
														<button type="button" class="btn btn-info btn-circle btn-sm" 
														onClick="deleteParentElement(this)"><i class="fa fa-times"></i></button>
														</div>
													  
													
												</div>
											 </span>
						
                        <button type="button" class="btn btn-info btn-sm 
						btn-rounded btn-block" onClick="add_designation()"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Add More');?></button> 
						
						<br><br><br><br>
						
							<label for="square-radio-1"><?php echo get_phrase('select_class');?></label>  &nbsp;&nbsp;&nbsp;
								<select name="class_id" id="class_id" class="form-control"  onchange="get_sections(this.value)" >
									<option value=""><?php echo get_phrase('select_class');?></option>
										<?php
											$classes = $this->db->get('class')->result_array();
											foreach($classes as $row):
										?>
										<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
										<?php endforeach;?>
								</select>
		
									<label for="square-radio-2"><?php echo get_phrase('term/section');?></label>&nbsp;&nbsp;&nbsp;
									<select name="section_id" id="section_id"  class="form-control">
										<option value=""><?php echo get_phrase('select_class_first') ?></option>
									</select>      
                                 	
						
								 
						<br><br><br>
						<div class="alert alert-default" style="color:red">Please note that all textfields are required.</div>
                                             
                        <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-save"></i>&nbsp;<?php echo get_phrase('save');?></button>
                    	<?php echo form_close();?>           
                </div>
            </div>
		</div>
    </div>
</div>






<div class="row">
<div class="col-sm-12">
<div class="panel panel-info">
                          
                                <div class="panel-body table-responsive">
								
								
								<!-- <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/bulk_student/');">
						<button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Bulk Student');?>
						</button></a> -->
								
								
				  	<div class="row panel-body">
                    <div class="col-sm-6">
						
					<div class="alert alert-success"><?php echo get_phrase('admission_form'); ?>&nbsp;-&nbsp;PART A</div>

				
                <?php echo form_open(base_url() . 'admin/new_student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				<div class="form-group"> 
					 <div class="col-sm-12">
  		  			  <input type='file' name="userfile" onChange="readURL(this);" style="color:red">
       				 <img id="blah"  src="<?php echo base_url();?>uploads/user.jpg" alt="your image" height="150" width="150"/ style="border:1px dotted red">
					 
					</div>
					</div>	
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('running_session');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
                  <input type="text" class="form-control" name="session"  value="<?php echo $this->db->get_where('settings', array('type' => 'session'))->row()->description; ?>" readonly="true">
				 <input type="text" class="form-control" name="roll" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" required>
				 <p style="color:green">You can change this to manual student admission number</p>
                    </div>
                </div>
				
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('full_name');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="name" required autofocus>
						</div>
					</div>

					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('parent');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="parent_id" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 	<a href="<?php echo base_url();?>admin/parent/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
						</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%" id="class_id" onchange="return get_class_sections(this.value)" / required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
		<a href="<?php echo base_url();?>admin/classes/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>


						</div> 
					</div>

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('term/section');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
		                        <select name="section_id" class="form-control" style="width:100%" id="section_selector_holder" / required>
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
	<a href="<?php echo base_url();?>admin/section/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
			                </div>
					</div>
					
						
					<input type="hidden" class="form-control" name="roll" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" required>
						
					

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('birthday');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<input type="text"  class="form-control" name="birthday" required>
						</div> 
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('age');?> </label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="age" id="age" value="" readonly="true">
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('place_birth');?> </label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="place_birth" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('gender');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%" / required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('mother_tongue');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="m_tongue" value="" / required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="religion" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('blood_group');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="blood_group" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('address');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
					<textarea name="address" cols="" class="form-control" rows=""></textarea>
						</div> 
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('city');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="city" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Student House');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="house_id" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$house = $this->db->get('house')->result_array();
								foreach($house as $row):
									?>
                            		<option value="<?php echo $row['house_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 	<a href="<?php echo base_url();?>studenthouse/studentHouse/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
						</div>
						
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Student Club');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="club_id" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$club = $this->db->get('club')->result_array();
								foreach($club as $row):
									?>
                            		<option value="<?php echo $row['club_id'];?>">
										<?php echo $row['club_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 	<a href="<?php echo base_url();?>admin/club/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
						</div>
					
					
					</div>
					
					
					<div class="col-sm-6">
					
					<div class="alert alert-success"><?php echo get_phrase('admission_form'); ?>&nbsp;-&nbsp;PART B</div>
					
				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('state');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="state" value="" >
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('nationality');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="nationality" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('phone');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="phone" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('email');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="email" value="" required>
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('password');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
					<input type="password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)" required>
					<strong id="password_strength"></strong>
						</div> 
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('previous_school_name');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="ps_attended" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('the_address');?></label>
                    <div class="col-sm-12">
						<textarea name="ps_address" cols="" class="form-control" rows=""></textarea>
						</div>
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('purpose_of_leaving');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="ps_purpose" data-validate="required" value="" autofocus>
						</div>
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('class_in_which_was_studying');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="class_study" data-validate="required" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('date_of_leaving');?></label>
                    <div class="col-sm-12">
							<input type="date" value="2011-08-19" id="example-date-input" class="form-control datepicker" name="date_of_leaving">

						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('admission_date');?></label>
                    <div class="col-sm-12">
							<input type="date" value="2011-08-19" id="example-date-input" class="form-control datepicker" name="am_date">

						</div> 
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('transfer_certificate');?></label>
                    <div class="col-sm-12">
							<select name="tran_cert" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>
					
				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('birth_certificate');?></label>
                    <div class="col-sm-12">
							<select name="dob_cert" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>

				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('any_given_marksheet');?></label>
                    <div class="col-sm-12">
							<select name="mark_join" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
							
						</div> 
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('physical_handicap');?></label>
                    <div class="col-sm-12">
							<select name="physical_h" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('dormitory');?></label>
                    <div class="col-sm-12">
							<select name="dormitory_id" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row):
	                              ?>
                              		<option value="<?php echo $row['dormitory_id'];?>"><?php echo $row['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						  <a href="<?php echo base_url();?>admin/dormitory/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
						</div> 
					</div>


	<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('transport_route');?></label>
                    <div class="col-sm-12">
							<select name="transport_id" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row):
	                              ?>
                              		<option value="<?php echo $row['transport_id'];?>"><?php echo $row['name'];?></option>
                          		<?php endforeach;?>
                          </select>
	<a href="<?php echo base_url();?>admin/transport/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Student Category');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
							<select name="student_category_id" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$student_category = $this->db->get('student_category')->result_array();
								foreach($student_category as $row):
									?>
                            		<option value="<?php echo $row['student_category_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 	<a href="<?php echo base_url();?>studentcategory/studentCategory/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
						</div>
						
					<!--<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('documents');?>&nbsp;(Student's Documents)</label>
                    <div class="col-sm-12">
             	<input type="file" name="file_name" class="form-control" required>
			 
			  <p style="color:red">Accept zip, pdf, word, excel, rar and others</p>
			  
					</div>
					</div> -->
					
					</div>
					</div>
					
					

				<?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-default btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>
					
					
                <?php echo form_close();?>
	
			</div>		
		</div>	
    </div> 
</div>





<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>


<script type="text/javascript">

	function CheckPasswordStrength(password) {
	var password_strength = document.getElementById("password_strength");

        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }

        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.

        var passed = 0;

        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }

        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
            case 2:
                strength = "Weak";
                color = "red";
                break;
            case 3:
                 strength = "Medium";
                color = "orange";
                break;
            case 4:
                 strength = "Strong";
                color = "green";
                break;
               
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;

if(passed <= 2){
         document.getElementById('show').disabled = true;
        }else{
            document.getElementById('show').disabled = false;
        }

    }

</script>

<script type="text/javascript">
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            }, 
            function(start, end, label) {
                var years = moment().diff(start, 'years');
               // alert("You are " + years + " years old.");
                $("#age").val(years);
            });
        });
</script>


<script>    
    $('#designation_input').hide();
    
    // CREATING BLANK DESIGNATION INPUT
    var blank_designation = '';
    $(document).ready(function () {
        blank_designation = $('#designation_input').html();
    });

    function add_designation()
    {
        $("#designation").append(blank_designation);
    }

    // REMOVING DESIGNATION INPUT
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

</script>


<script type="text/javascript">

	function get_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
            }
        });

    }

</script>