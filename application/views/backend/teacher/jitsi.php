				
  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">&nbsp;
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;CREATE NEW LIVE CLASS</a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">
								
								
			<?php echo form_open(base_url() . 'teacher/jitsi/add/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
	
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('title');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="title" required>

						</div>
					</div>

					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    	<div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%"id="class_id" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->crud_model->get_classes(); foreach($classes as $row): ?>
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


                    <div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                    	<div class="col-sm-12">
                			<textarea rows="5" name="description" class="form-control" placeholder="please specify meeting description here" ></textarea>
						</div>
            	</div>
				
			</div>	
					
					 <div class="col-sm-6">
					 
						 <div class="form-group">
							<label class="col-sm-12"><?php echo get_phrase('date'); ?></label>
							<div class="col-sm-12">
								 <input type="date" class="form-control datepicker" name="meeting_date" value="<?php echo date('Y-m-d');?>" required>
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
				
				<br>
                <div class="form-group">
                 			<label class="col-md-9" for="example-text"><?php echo get_phrase('status');?></label>
                    		<div class="col-sm-12">
		                        <select name="status" class="form-control" >
		                            <option value=""><?php echo get_phrase('select_meeting_status');?></option>
                                    <option value="pending">Pending</option>
                                    <option value="live">Live</option>
                                    <option value="expired">Expired</option>
                                </select>
			                </div>
					</div>

                <hr class="sep-3">
				<div class="form-group">
                    	<div class="col-sm-12">
                			<input type="checkbox" id="check" value="1" name="send_notification_sms"> <i></i> <?=get_phrase('send_notification_sms')?>
						</div>
                        <p style="color:red" id="initial">Meeting will not be sent to mobile number(s)!</p>
                        <p style="color:green" id="send_sms">Meetting info will be sent to parent and students' phone number(s). Note that only parent(s) and student(s) in the class selected will receive message</p>
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
							<th><?=get_phrase('created_by')?></th>
                            <th><?=get_phrase('title')?></th>
							<th><?=get_phrase('class')?></th>
							<th><?=get_phrase('section')?></th>
							<th><?=get_phrase('meeting_date')?></th>
							<th><?=get_phrase('meeting_time')?></th>
							<th><?=get_phrase('status')?></th>
							<th><?=get_phrase('description')?></th>
							
							<th><?=get_phrase('action')?></th>
                        </tr>
                    </thead>
                    <tbody>
                       
					 <?php $select = $this->live_class_model->selectJitsiStaffInsert();
					 		foreach ($select as $key => $row) : ?>
                        <tr>
							<td>
							<?php 
							
							$user = explode('-', $row['user_id']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							
							</td>

							<td><?=$row['title'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', $row['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $row['section_id']);?></td>
							<td><?=date('d M, Y', $row['meeting_date'])?></td>
                            <td><?=$row['start_time'] .' - '.$row['end_time']?></td>
							<td><span class="label label-<?php if($row['status'] == 'pending') echo 'warning';elseif($row['status'] == 'live') echo 'success'; else echo 'danger';?>"><?=$row['status']?></span></td>
							<td><?=$row['description']?></td>
							<td>
							
							<a href="<?php echo base_url();?>teacher/edit_jitsi/<?php echo $row['jitsi_id'];?>"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-edit"></i> edit</button></a>
							
							<?php if($row['status'] == 'live') :?>
							<a href="<?php echo base_url();?>teacher/stream_jitsi/<?php echo $row['jitsi_id'];?>"><button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-youtube-play"></i> start meeting</button></a>
							<?php endif;?>
							
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>teacher/jitsi/delete/<?php echo $row['jitsi_id'];?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i> delete</button></a>
							
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


    $('#check').click(function(){

        if($('#check').is(':checked') == true){
            $("#send_sms").show(500);
            $("#initial").hide(500);
        }else{

            $("#send_sms").hide(500);
            $("#initial").show(500);
        }

    });

    $("#send_sms").hide();


</script>

