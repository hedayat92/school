<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">

                NEW ALUMNI


                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;IMPORT STUDENTS OR ADD NEW ALUMNI HERE<i
                            class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div></div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
				
				
				
				
				<div class="row">
					<div class="col-sm-6">
					
					<div class="alert alert-info">MANUAL ENTERING OF ALUMNI</div>
					
						<?php echo form_open(base_url() . 'admin/alumni/insert/' , array('enctype' => 'multipart/form-data'));?>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<input type="text" class="form-control" name="name" autofocus required>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('gender');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<select name="sex" class="form-control" / required>
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="male"><?php echo get_phrase('male');?></option>
									<option value="female"><?php echo get_phrase('female');?></option>
								</select>
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<input type="text" class="form-control" name="phone" required>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('email');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<input type="email" class="form-control" name="email" required>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
							<div class="col-sm-12">
	
								<textarea rows="5" name="address" class="form-control"></textarea>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('marital_status');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<select name="marital_status" class="form-control" / required>
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="married"><?php echo get_phrase('married');?></option>
									<option value="single"><?php echo get_phrase('single');?></option>
									<option value="divorced"><?php echo get_phrase('divorced');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('admitted_year');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<select name="session" class="form-control select2">
									<?php $running_session = get_settings('session'); ?>
									<?php for($i = 0; $i < 10; $i++):?>
									<option value="<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>"
										<?php if($running_session == (2019+$i).'-'.(2019+$i+1)) echo 'selected';?>>
										<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>
									</option>
									<?php endfor;?>
								</select>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('graduating_year');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
	
								<select name="g_year" class="form-control select2">
									<?php $running_session = get_settings('session'); ?>
									<?php for($i = 0; $i < 10; $i++):?>
									<option value="<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>"
										<?php if($running_session == (2019+$i).'-'.(2019+$i+1)) echo 'selected';?>>
										<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>
									</option>
									<?php endfor;?>
								</select>
	
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('Student Club');?> <b
									style="color:red">*</b></label>
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
								<a href="<?php echo base_url();?>admin/club/"><button type="button"
										class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
	
							</div>
						</div>
	
						
	
						<div class="form-group">
							<label class="col-sm-12"><?php echo get_phrase('browse_image');?> <b
									style="color:red">*</b></label>
							<div class="col-sm-12">
								<input type='file' class="dropify" name="userfile" /required>
							</div>
						</div>
	
						<?php if(!(demo())){ ?>
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"><i class="fa fa-save"></i> <?php echo get_phrase('save');?></button>
						</div>
						<?php } ?>
						<?php echo form_close();?>
						</div>
					
						<div class="col-sm-6">
						
							<div class="alert alert-success">AUTO IMPORT STUDENTS TO THE ALUMNI</div>
							
							<?php echo form_open(base_url() . 'admin/student_import' , array('enctype' => 'multipart/form-data'));?>
								<div class="form-group">
									<label class="col-md-12" for="example-text"><?php echo get_phrase('import_from_which_class');?> <b style="color:red">*</b></label>
									<div class="col-sm-12">
										<select name="class_id" id="class_id" class="form-control" onchange="return get_class_mass_student(this.value)" / required>
											<option value=""><?php echo get_phrase('select_class');?></option>
											<?php $class =  $this->db->get('class')->result_array();
											foreach($class as $key => $class):?>
											<option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
											<?php endforeach;?>
									   </select>
									</div>
								</div>
								<strong>LIST OF STUDENTS TO BE IMPORTED : </strong><br><br>
								<div id="mass_student_selector_holder"></div>
								 
								 
							<style>
								.alert-red{
								background-color:red;
								color:white;
								}
							</style>
							<br>
							<blockquote class="blockquote-blue">
								<p>
									<strong>WARNING !</strong>
								</p>
								<p> Ensure you double check the class before clicking import button below. Students imported will be moved to alumni and action cannot be reversed. </p>
							</blockquote>
				
				
						
								<div class="form-group">
									<button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"><i class="fa fa-import"></i> <?php echo get_phrase('import');?></button>
								</div>
						</div>
						<?php echo form_close();?>
					</div>


                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_alumni');?>
            </div>
            <div class="panel-body table-responsive">

                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80">
                                <div><?php echo get_phrase('photo');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('name');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('email');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('sex');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('address');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('phone');?></div>
                            </th>
                           
                            <th>
                                <div><?php echo get_phrase('year');?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('school_club');?></div>
                            </th>
                           
                            <th>
                                <div><?php echo get_phrase('options');?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($select_alumni as $key => $alumni):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('alumni',$alumni['alumni_id']);?>"
                                    class="img-circle" width="30" /></td>
                            <td><?php echo $alumni['name'];?></td>
                            <td><?php echo $alumni['email'];?></td>
                            <td><?php echo $alumni['sex'];?></td>
                            <td><?php echo $alumni['address'];?></td>
                            <td><?php echo $alumni['phone'];?></td>
                            <td>
							<p><span class="label label-danger"><strong>Admitted Year :</strong> <?php echo $alumni['session'];?></span></p>
							<p><span class="label label-success"><strong>Graduated Year :</strong> <?php echo $alumni['g_year'];?></span></p>
							</td>
                            <td><?php echo $this->db->get_where('club' , array('club_id' => $alumni['club_id']))->row()->club_name;?>
                            </td>

                            <td>

                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_alumni/<?php echo $alumni['alumni_id'];?>')"
                                    class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm_modal('<?php echo base_url();?>admin/alumni/delete/<?php echo $alumni['alumni_id'];?>')"
                                    class="btn btn-danger btn-circle btn-xs" style="color:white"><i
                                        class="fa fa-times"></i></a>

                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function select(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = true;
    }
}

function unselect(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = false;
    }
}
</script>
<script type="text/javascript">
function get_class_mass_student(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_alumni_mass_student/' + class_id,
        success:    function(response){
            jQuery('#mass_student_selector_holder').html(response);
        } 

    });
}
</script>