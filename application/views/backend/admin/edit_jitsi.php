				
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">&nbsp;
                EDIT LIVE CLASS
            </div>
            
            <div class="panel-body">
								
			<?php foreach($toSelectFromJitsiWithId as $value) : ?>			
			<?php echo form_open(base_url() . 'admin/jitsi/edit/'.$value['jitsi_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
	
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('title');?></label>
                    	<div class="col-sm-12">
							<input type="text" class="form-control" name="title" value="<?=$value['title']?>" required>

						</div>
					</div>

					
					<div class="form-group">
                 		<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    	<div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%"id="class_id" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->crud_model->get_classes(); foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>"<?php if($value['class_id']==$row['class_id']) echo 'selected="selected"';?>><?php echo $row['name'];?></option>
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
                			<textarea rows="5" name="description" class="form-control" placeholder="please specify meeting description here" ><?=$value['description']?></textarea>
						</div>
            	</div>
				
			</div>	
					
					 <div class="col-sm-6">
					 
						 <div class="form-group">
							<label class="col-sm-12"><?php echo get_phrase('date'); ?></label>
							<div class="col-sm-12">
								 <input type="date" class="form-control datepicker" name="meeting_date" value="<?=date('Y-m-d', $value['meeting_date'])?>" required>
							</div> 
					</div>
					
					
		 <!-- .row -->
                            <div class="row">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('meeting_time');?></label>
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" name="start_time" class="form-control" value="<?=$value['start_time']?>">
                                        <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> 
                                    </div>
									<label class="col-md-12" for="example-text"><?php echo get_phrase('time_start');?></label>
                                </div>
								
                                <div class="col-lg-6">
                                    <div class="input-group clockpicker " data-placement="left" data-align="top" data-autoclose="true">
                                        <input type="text" name="end_time" class="form-control" value="<?=$value['end_time']?>">
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
                                    <option value="pending"<?php if($value['status'] == 'pending') echo 'selected="selected"';?>>Pending</option>
                                    <option value="live"<?php if($value['status'] == 'live') echo 'selected="selected"';?>>Live</option>
                                    <option value="expired"<?php if($value['status'] == 'expired') echo 'selected="selected"';?>>Expired</option>
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
 `           </div>
        </div>`
					
		<input type="submit" class="btn btn-success btn-rounded btn-block btn-sm" value="<?php echo get_phrase('save');?>">               
                    
        <?php echo form_close();?>
        <?php endforeach;?>	
									
									
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




$(document).ready(function(){
    var class_id = $('#class_id').val();
    get_class_sections(class_id);
});

</script>