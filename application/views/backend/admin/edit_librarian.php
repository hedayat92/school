<?php 
$select_librarian = $this->db->get_where('librarian', array('librarian_id' => $param2))->result_array();
foreach($select_librarian as $key => $librarian):  ?>



<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				<?php echo get_phrase('New Librarian');?></div>
                        <div class="panel-body">

                        <?php echo form_open(base_url() . 'admin/librarian/update/'. $librarian['librarian_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

 					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Name');?> <b style="color:red">*</b></label>

                    <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo $librarian['name'];?>" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('DOB');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
                    <input class="form-control m-r-10" name="birthday" type="date" value="<?php echo $librarian['birthday'];?>" id="example-date-input" required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Sex');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
                    <select class="form-control select2" name="sex" / required>

                    <option value="Male"<?php if ($librarian['sex'] == 'Male') echo 'selected;' ?>><?php echo get_phrase('Male');?></option>
                    <option value="Female"<?php if ($librarian['sex'] == 'Female') echo 'selected;' ?>><?php echo get_phrase('Female');?></option>
                    </select>

                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Religion');?></label>
                    <div class="col-sm-12">
                    <input type="text" name="religion" value="<?php echo $librarian['religion'];?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Blood Group');?></label>
                    <div class="col-sm-12">
                    <input type="text" name="blood_group"  value="<?php echo $librarian['blood_group'];?>" class="form-control">
                        </div>
                    </div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Email');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="email" name="email" value="<?php echo $librarian['email'];?>" class="form-control" /required>
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Phone');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="text" name="phone" value="<?php echo $librarian['phone'];?>" class="form-control" /required>
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Qualification');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <input type="text" name="qualification" value="<?php echo $librarian['qualification'];?>" class="form-control" /required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Marital Status');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
                    <select class="form-control select2" name="marital_status" / required>
                    <<option value="Married"<?php if ($librarian['marital_status'] == 'Married') echo 'selected;' ?>><?php echo get_phrase('Married');?></option>
                    <option value="Single"<?php if ($librarian['marital_status'] == 'Single') echo 'selected;' ?>><?php echo get_phrase('Single');?></option>
                    <option value="Other"<?php if ($librarian['marital_status'] == 'Other') echo 'selected;' ?>><?php echo get_phrase('Other');?></option>
                    </select>

                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Address');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">
                            <textarea class="form-control" name="address"><?php echo $librarian['address'];?></textarea>
                        </div>
                    </div>
					
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('department');?> <b style="color:red">*</b></label>
                    <div class="col-sm-12">

                            <select name="department_id" id="department_id" class="form-control select2" 
							onchange="return get_designation_val(this.value, <?php echo $param2;?>)" required>
								<?php
                                $department = $this->db->get('department')->result_array();
                                foreach ($department as $row2): ?>
                                    <option value="<?php echo $row2['department_id']; ?>"
                                    <?php if($librarian['department_id'] == $row2['department_id']) echo 'selected="selected"' ;?>><?php echo $row2['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
							
                        </div>
                    </div>
					
					 <div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase ('designation');?> <b style="color:red">*</b></label>
                    	<div class="col-sm-12">
                          <select name="designation_id" class="form-control" id="designation_holder_modal" / required>
							<option value=""><?php echo get_phrase('select_a_department_first'); ?></option>
						</select>
                        </div>
                    </div>
					
					
					<div class="form-group">
						<label class="col-sm-12"><?php echo get_phrase('date_of_joining'); ?> <b style="color:red">*</b></label>
				
						<div class="col-sm-12">
							<input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo $librarian['date_of_joining'];?>" required>
						</div> 
					</div>
				
				
				<div class="form-group">
					<label class="col-sm-12"><?php echo get_phrase('date_of_leaving'); ?> </label>
			
					<div class="col-sm-12">
						<input type="date" class="form-control datepicker" name="date_of_leaving" value="<?php echo $librarian['date_of_leaving'];?>">
					</div> 
				</div>
				
				<div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-12">
                            <select name="status" class="form-control select2">
                                <option value="1"<?php if($librarian ['status'] == '1') echo 'selected="selected"';?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"<?php if($librarian ['status'] == '2') echo 'selected="selected"';?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div> 
                    </div>
					
					 <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('joining_salary'); ?></label>

                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="joining_salary" value="<?php echo $librarian['joining_salary'];?>" required>
                        </div> 
                    </div>
			
				 <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('account_holder_name'); ?> <b style="color:red">*</b></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="account_holder_name" value="<?php echo $librarian['account_holder_name'];?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('account_number'); ?> <b style="color:red">*</b></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="account_number" value="<?php echo $librarian['account_number'];?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('bank_name'); ?> <b style="color:red">*</b></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="bank_name" value="<?php echo $librarian['bank_name'];?>" required>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('branch'); ?> <b style="color:red">*</b></label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="branch" value="<?php echo $librarian['branch'];?>" >
                        </div> 
                    </div>
		
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Facebook');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="facebook" value="<?php echo $librarian['facebook'];?>" class="form-control" >
                        </div>
                    </div>
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Facebook');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="facebook" value="<?php echo $librarian['facebook'];?>" class="form-control" >
                        </div>
                    </div>
					
					 <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Facebook');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="facebook" value="<?php echo $librarian['facebook'];?>" class="form-control" >
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Facebook');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="facebook" value="<?php echo $librarian['facebook'];?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Twitter');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="twitter" value="<?php echo $librarian['twitter'];?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Googleple');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="googleplus" value="<?php echo $librarian['googleplus'];?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Linkedin');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="linkedin" value="<?php echo $librarian['linkedin'];?>" class="form-control" >
                        </div>
                    </div>


    

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Image');?></label>
                    <div class="col-sm-12">

                            <input type="file" name="userfile" class="form-control">
                            <img src="<?php echo  $this->crud_model->get_image_url('librarian', $librarian['librarian_id']) ;?>" width="30" height="30">
                        </div>
                    </div>


                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
					</div>
			<?php echo form_close();?>
            </div>
		</div>
    </div>
</div>

<?php endforeach;?>


<script type="text/javascript">
    
    function get_designation_val(department_id) {
        if(department_id != '')
            $.ajax({
                url: '<?php echo base_url();?>admin/get_designation/' + department_id,
                success: function(response)
                {
                    console.log(response);
                    jQuery('#designation_holder_modal').html(response);
                }
            });
        else
            jQuery('#designation_holder_modal').html('<option value=""><?php echo get_phrase("select_a_department_first"); ?></option>');
    }
    
</script>

		<script>
			$(document).ready(function() {
				var department_id = $('#department_id').val();
				var librarian_id = '<?php echo $param2;?>';
				get_designation_val(department_id,librarian_id);
				
			});
		</script>