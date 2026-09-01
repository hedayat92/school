				
  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">&nbsp;
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;CREATE NEW LIVE CLASS</a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">
								
								
			<?php echo form_open(base_url() . 'teacher/live_class/add/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
	
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('title');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="title" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('zoom_meeting_id');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="meeting_id" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('zoom_meeting_password');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="meeting_password" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    	<div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%"id="class_id" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
							  <?php 
							  	$teacher_id = $this->session->userdata('teacher_id');
								$classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array(); 
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                <?php endforeach; ?>
                          </select>
						</div> 
					</div>
					
					
					<div class="form-group">
                 			<label class="col-md-9" for="example-text"><?php echo get_phrase('section');?></label>
                    		<div class="col-sm-12">
		                        <select name="section_id" class="form-control" style="width:100%" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                    </select>
			                </div>
					</div>
				
			</div>	
					
					 <div class="col-sm-6">
					 
						 <div class="form-group">
							<label class="col-sm-12"><?php echo get_phrase('date'); ?></label>
							<div class="col-sm-12">
								 <input type="date" class="form-control datepicker" name="date" value="<?php echo date('Y-m-d');?>" required>
							</div> 
					</div>
					
					
		 <!-- .row -->
                            <div class="row">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('meeting_time');?></label>
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" name="start_time" class="form-control" value="13:14">
                                        <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> 
                                    </div>
									<label class="col-md-12" for="example-text"><?php echo get_phrase('time_start');?></label>
                                </div>
								
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="left" data-align="top" data-autoclose="true">
                                        <input type="text" name="end_time" class="form-control" value="13:14">
                                        <span class="input-group-addon"> <span class="glyphicon glyphicon-time">
										</span> 
                                    </div>
									<label class="col-md-12" for="example-text"><?php echo get_phrase('time_end');?></label>
                                </div>

					</div>
        
                <!-- /.row -->
				<hr class="sep-3">
				
				<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('remarks');?></label>
                    	<div class="col-sm-12">
                			<textarea rows="5" name="remarks" class="form-control" placeholder="please specify meeting remarks here" ></textarea>
						</div>
            	</div>
				
				<div class="form-group">
                    	<div class="col-sm-12">
                			<input type="checkbox" class="js-switch" value="1" name="send_notification_sms" checked> <i></i> <?=get_phrase('send_notification_sms')?>
						</div>
            	</div>
				
				
		

		</div>
	</div>
					
		<input type="submit" class="btn btn-success btn-rounded btn-block btn-sm" value="<?php echo get_phrase('save');?>">               
                    
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
								  <?php echo get_phrase('list_live_class');?>
								  <hr class="sep-2">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?=get_phrase('title')?></th>
							<th><?=get_phrase('meeting_id')?></th>
							<th><?=get_phrase('class')?></th>
							<th><?=get_phrase('section')?></th>
							<th><?=get_phrase('date')?></th>
							<th><?=get_phrase('start_time')?></th>
							<th><?=get_phrase('end_time')?></th>
							<th><?=get_phrase('created_by')?></th>
							<th><?=get_phrase('status')?></th>
							
							<th><?=get_phrase('action')?></th>
                        </tr>
                    </thead>
                    <tbody>
                       
					 <?php $select = $this->live_class_model->selectLiveClassInformationByUser();
					 		foreach ($select as $key => $row) : ?>
                        <tr>
							<td><?=$row['title'];?></td>
							<td><?=$row['meeting_id'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', $row['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $row['section_id']);?></td>
							<td><?=date('d M, Y', $row['date'])?></td>
							<td><?=date("h:i A", strtotime($row['start_time'])); ?></td>
                            <td><?=date("h:i A", strtotime($row['end_time'])); ?></td>
							<td>
							
							<?php 
							
							$user = explode('-', $row['created_by']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							</td>
							
							<td>
							<?php  
									$status = '<i class="fa fa-clock-o"></i> ' . get_phrase('waiting');
									$labelmode = 'label-info';
									if (strtotime($row['date']) == strtotime(date("Y-m-d")) && strtotime($row['start_time']) <= time() && time() >= strtotime(date("h:i"))) {
										$status = '<i class="fa fa-camera"></i> ' . get_phrase('live');
										$labelmode = 'label-success';
									}
									if (strtotime($row['date']) < strtotime(date("Y-m-d")) || strtotime($row['end_time']) <= time()) {
										$status = '<i class="fa fa-times"></i> ' . get_phrase('expired');
										$labelmode = 'label-danger';
									}
									echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
								?>
							</td>
		
                            <td>
							
							<a href="<?php echo base_url();?>teacher/edit_live_class/<?php echo $row['live_class_id'];?>"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-edit"></i> edit</button></a>
							
						
							<a href="<?php echo base_url();?>teacher/host_live_class/<?php echo $row['live_class_id'];?>"><button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-youtube-play"></i> start streaming</button></a>
							
							
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>teacher/live_class/delete/<?php echo $row['live_class_id'];?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i> delete</button></a>
							
                            </td>
                        </tr>
							 <?php endforeach;?>

       			
						
                    </tbody>
                </table>
				</div>
			</div>
		</div>
	</div>
</div>


	<script>
    $('form').submit(function (e) {
        $('#install_progress').show();
        $('#modal_1').show();
        $('.btn').val('saving, please wait...');
        $('form').submit();
        e.preventDefault();
    });
	
</script>


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

