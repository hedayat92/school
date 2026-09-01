				
  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                           
                                <div class="panel-body">
								<i class="fa fa-youtube-play"></i> EDIT LIVE CLASS
								<a href="<?php echo site_url('admin/live_class/'); ?>"><button type="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-mail-reply-all"></i> back</button></a>
								<hr class="sep-2">
                                    
			<?php 
			$select = $this->db->get_where('live_class', array('live_class_id' => $live_class_id))->result_array();
			foreach ($select as $key => $row) : ?>					
			<?php echo form_open(base_url() . 'admin/live_class/edit/'. $live_class_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
	
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('title');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('zoom_meeting_id');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $row['meeting_id'];?>" name="meeting_id" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('zoom_meeting_password');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="meeting_password" value="<?php echo $row['meeting_password'];?>" required>

						</div>
					</div>
					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    	<div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%"id="class_id" onchange="return get_class_sections(this.value, <?php echo $live_class_id;?>)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->crud_model->get_classes(); foreach($classes as $class): ?>
                            		<option value="<?php echo $class['class_id'];?>"<?php if($row['class_id'] == $class['class_id']) echo 'selected="selected"';?>><?php echo $class['name'];?></option>
                                <?php endforeach; ?>
                          </select>
						</div> 
					</div>
					
					
					<div class="form-group">
                 			<label class="col-md-9" for="example-text"><?php echo get_phrase('section');?></label>
                    		<div class="col-sm-12">
		                        <select name="section_id" class="form-control" style="width:100%" id="section_selector_holder" / required>
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                    </select>
			                </div>
					</div>
				
			</div>	
					
					 <div class="col-sm-6">
					 
						 <div class="form-group">
							<label class="col-sm-12"><?php echo get_phrase('date'); ?></label>
							<div class="col-sm-12">
								 <input type="date" class="form-control datepicker" name="date" value="<?php echo date('Y-m-d', $row['date']);?>" required>
							</div> 
					</div>
					
					
		 <!-- .row -->
                            <div class="row">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('meeting_time');?></label>
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" name="start_time" class="form-control" value="<?php echo $row['start_time'];?>">
                                        <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> 
                                    </div>
									<label class="col-md-12" for="example-text"><?php echo get_phrase('time_start');?></label>
                                </div>
								
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="left" data-align="top" data-autoclose="true">
                                        <input type="text" name="end_time" class="form-control" value="<?php echo $row['end_time'];?>">
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
                			<textarea rows="5" name="remarks" class="form-control" placeholder="please specify meeting remarks here" ><?php echo $row['remarks'];?></textarea>
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
				<?php endforeach;?>
									
									
				</div>
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

	<script>
        $(document).ready(function() {
            var class_id = $('#class_id').val();
            var live_class_id = '<?php echo $live_class_id;?>';
            get_class_sections(class_id,live_class_id);
            
        });
    </script>
	
	<script>
    $('form').submit(function (e) {
        $('#install_progress').show();
        $('#modal_1').show();
        $('.btn').val('Editting and sending sms of live class, please wait...');
        $('form').submit();
        e.preventDefault();
    });
	
</script>

