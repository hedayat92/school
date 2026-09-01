<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
				&nbsp;
					<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add 
						<?php echo get_phrase('New Librarian');?> here</a> <a href="#" data-perform="panel-dismiss"></a> 
					</div>
			</div>
				<div class="panel-wrapper collapse out" aria-expanded="true">
                    <div class="panel-body">
					<?php echo form_open(base_url() . 'admin/librarian/insert/' , 
					array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
				<div class="row">
					
						<div class="col-sm-4">
						
							<div class="form-group">
                 				<label class="col-md-12" for="example-text"><?php echo get_phrase ('Name');?> <b style="color:red">*</b></label>

								<div class="col-sm-12">
									<input type="text" name="name" class="form-control" /required>
									<input type="hidden" name="librarian_number" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 10);?>"class="form-control">
								</div>
							</div>
							
							 <div class="form-group">
                 				<label class="col-md-12" for="example-text"><?php echo get_phrase ('Religion');?></label>
								<div class="col-sm-12">
									<input type="text" name="religion" class="form-control">
								</div>
                    		</div>
							
							
							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Phone');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="text" name="phone" class="form-control" / required>
                        </div>
                    </div>
					
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Address');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

							 <input type="text" name="address" class="form-control" / required>
                           
                        </div>
                    </div>
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Googleple');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="googleplus" class="form-control" >
                        </div>
                    </div>
					
					<div class="form-group">
						<label class="col-sm-12" for="example-text"><?php echo get_phrase('department'); ?> <b style="color:red">*</b></label>
					
						<div class="col-sm-12">
							<select name="department_id" class="form-control select2" onchange="get_designation_val(this.value)" required>
								<option value=""><?php echo get_phrase('select_a_department'); ?></option>
								<?php
								$department = $this->db->get('department')->result_array();
								foreach ($department as $row): ?>
									<option value="<?php echo $row['department_id']; ?>">
										<?php echo $row['name']; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div> 
					</div>
					
					
					<div class="form-group">
					   <label class="col-sm-12"><?php echo get_phrase('joining_salary'); ?> <b style="color:red">*</b></label>
					
						<div class="col-sm-12">
							<input type="number" class="form-control" name="joining_salary" value="" required>
						</div> 
					</div>
					
					<div class="form-group">
					 <label class="col-sm-12"><?php echo get_phrase('account_holder_name'); ?> <b style="color:red">*</b></label>
				
					<div class="col-sm-12">
						<input type="text" class="form-control" name="account_holder_name" value="" required />
					</div>
				</div>
				
				<div class="form-group">
				 <label class="col-sm-12"><?php echo get_phrase('branch'); ?></label>
			
				<div class="col-sm-12">
					<input type="text" class="form-control" name="branch" value="" >
				</div> 
			</div>

					
					
					 

					
					
						</div>
						
						<div class="col-sm-4">
								<div class="form-group">
									<label class="col-md-12" for="example-text"><?php echo get_phrase ('DOB');?> <b style="color:red">*</b></label>
									<div class="col-sm-12">
										<input class="form-control m-r-10" name="birthday" type="date" value="<?php echo date('Y-m-d') ?>" id="example-date-input" required>
									</div>
								</div>
								
								<div class="form-group">
                 					<label class="col-md-12" for="example-text"><?php echo get_phrase ('Blood Group');?></label>
                    					<div class="col-sm-12">
                    						<input type="text" name="blood_group" class="form-control">
										</div>
								</div>
								
								
								 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Qualification');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="text" name="qualification" class="form-control" / required>
                        </div>
                    </div>
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Facebook');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="facebook" class="form-control" >
                        </div>
                    </div>
					
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Linkedin');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="linkedin" class="form-control" >
                        </div>
                    </div>

					<div class="form-group">
					<label class="col-sm-12" for="example-text"><?php echo get_phrase('designation'); ?> </label>
				
					<div class="col-sm-12">
						<select name="designation_id" class="form-control" id="designation_holder">
							<option value=""><?php echo get_phrase('select_a_department_first'); ?></option>
						</select>
					</div> 
				</div>
				
				
				<div class="form-group">
				<label class="col-sm-12"><?php echo get_phrase('status'); ?></label>
			
				<div class="col-sm-12">
					<select name="status" class="form-control select2">
						<option value="1"><?php echo get_phrase('active'); ?></option>
						<option value="2"><?php echo get_phrase('inactive'); ?></option>
					</select>
				</div> 
			</div>
			
			
			<div class="form-group">
			 <label class="col-sm-12"><?php echo get_phrase('account_number'); ?> <b style="color:red">*</b></label>
		
			<div class="col-sm-12">
				<input type="text" class="form-control" name="account_number" value="" required />
			</div>
		</div>
		
		<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Document');?>(Librarian CV or any document)</label>
                    <div class="col-sm-12">

                            <input type="file" name="file_name" class="dropify" >
                        </div>
                    </div>
							
	
								
						</div>
						
						
						<div class="col-sm-4">
							<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase ('Sex');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select class="form-control select2" name="sex" / required>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Email');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="email" name="email" class="form-control"/required >
                        </div>
                    </div>
					
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Marital Status');?> <b style="color:red">*</b> </label>
                    <div class="col-sm-12">
                    <select class="form-control select2" name="marital_status" / required>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                    <option value="Other">Other</option>
                    </select>

                        </div>
                    </div>
					
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Twitter');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="twitter" class="form-control" >
                        </div>
                    </div>
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Password');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="password" name="password" class="form-control" /required>
                        </div>
                    </div>
					
					
					<div class="form-group">
						<label class="col-sm-12"><?php echo get_phrase('date_of_joining'); ?> <b style="color:red">*</b></label>
				
						<div class="col-sm-12">
						<input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo date('Y-d-m');?>" required>
						</div> 
					</div>
				
				
					<div class="form-group">
						<label class="col-sm-12"><?php echo get_phrase('date_of_leaving'); ?> </label>
			
						<div class="col-sm-12">
							<input type="date" class="form-control datepicker" name="date_of_leaving" value="">
						</div> 
					</div>
			
					<div class="form-group">
					 	<label class="col-sm-12"><?php echo get_phrase('bank_name'); ?> <b style="color:red">*</b></label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="bank_name" value="" required>
						</div> 
					</div>
		
					<div class="form-group">
						<label class="col-md-12" for="example-text"><?php echo get_phrase ('Image');?> </label>
							<div class="col-sm-12">
								<input type='file' name="userfile" onChange="readURL(this);" style="color:red">
								<img id="blah" src="<?php echo base_url();?>uploads/default_avatar.jpg" 
								alt="your image" height="180" width="200"/ style="border:1px dotted red">
							</div>
						</div>

							
							
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
</div>


<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                           
                                <div class="panel-body table-responsive">
								<?php echo get_phrase('list_librarians');?>
								<hr class="sep-2">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('sex');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($select_librarian as $key => $librarian):	?>	
                               
                        <tr>
                            <td><img src="<?php echo  $this->crud_model->get_image_url('librarian', $librarian['librarian_id']) ;?>" class="img-circle" width="30" height="30"></td>
                            <td><?php echo $librarian['name'];?></td>
                            <td><?php echo $librarian['email'];?></td>
                            <td><?php echo $librarian['sex'];?></td>
                            <td><?php echo $librarian['phone'];?></td>
                            <td>
                            
                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_librarian/<?php echo $librarian['librarian_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url();?>admin/printLibrarianInformation/<?php echo $librarian['librarian_id'];?>/LibrarianName=<?php echo $librarian['name'];?>"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-print"></i></button></a>
                            <a onclick="confirm_modal('<?php echo base_url();?>admin/librarian/delete/<?php echo $librarian['librarian_id'];?>')" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                            <a href="<?php echo base_url() . 'uploads/librarian_image/' . $librarian['file_name'];?>"><button class="btn btn-success btn-circle btn-xs"><i class="fa fa-download"></i></button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
				
			
				
				
</div>


</div>
</div>
</div
></div>

<script type="text/javascript">
    
    function get_designation_val(department_id) {
        if(department_id != '')
            $.ajax({
                url: '<?php echo base_url();?>admin/get_designation/' + department_id,
                success: function(response)
                {
                    console.log(response);
                    jQuery('#designation_holder').html(response);
                }
            });
        else
            jQuery('#designation_holder').html('<option value=""><?php echo get_phrase("select_a_department_first"); ?></option>');
    }
    
</script>

