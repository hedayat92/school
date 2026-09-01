<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-play"></i>&nbsp;&nbsp;<?=get_phrase('edit_video'); ?>
			
			<a href="<?php echo site_url('admin/video_class/'); ?>"><button type="button" 
			class="btn btn-default btn-sm pull-right"><i class="fa fa-mail-reply-all"></i> back</button></a>
			</div>
			
			
			<?php 
					$select = $this->db->get_where('video_class', array('video_class_id' => $video_class_id))->result_array();
					foreach ($select as $key => $row) : 
			?>
			
				<?=form_open(base_url() . 'admin/video_class/edit/' . $video_class_id, 
				array('class' => 'form-horizontal form-goups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="panel-body table-responsive">
					
					
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('title');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="title" value="<?=$row['title'];?>"/ required>
								</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('class');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select name="class_id" id = "class_id" class="form-control selectboxit"
										onchange="return get_class_section_subject(this.value, <?php echo $live_class_id;?>)" required>
										<option value=""><?php echo get_phrase('select_class');?></option>
										<?php $classes = $this->db->get('class')->result_array();
											foreach($classes as $class): ?>
											<option value="<?php echo $class['class_id'];?>"<?php if($row['class_id'] == $class['class_id']) echo 'selected="selected"';?>>
											<?php echo $class['name'];?></option>
										<?php
										endforeach;
										?>
									</select>
								</div>
						</div>

                		<div id="section_subject_selection_holder"></div>
						
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('date');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<input class="form-control m-r-10" name="date" type="date" value="<?=date('Y-m-d', $row['date'])?>" id="example-date-input" /required>
								 </div>
						</div>
						
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('video_lesson_type');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select class="form-control" id="showForm" name="lesson_type" onchange = "ShowHideDiv()">
										<option value="video"<?php if($row['lesson_type' == 'video'])echo 'selected="selected"';?>><?php echo get_phrase('upload_video');?></option>
										<option value="links"<?php if($row['lesson_type' == 'links'])echo 'selected="selected"';?>><?php echo get_phrase('video_url');?></option>
									
									</select>
								</div>
						</div>
						
						
						<div id="video" style="display: none">
							<div class="form-group">
								<label class="col-md-12" for="example-text"><?=get_phrase('upload_video');?> <b style="color:red">*</b></label>
									<div class="col-md-12">
										<!--<input class="form-control" name="file_name" accept=".mp4" type="file">-->
										<p style="color:red">Please re-upload video file and save</p>
									</div>
									 
									 
							</div>
						</div>
						
						
						<div id="links" style="display: none">
							<div class="form-group">
								<label class="col-md-12" for="example-text"><?=get_phrase('video_url');?> <b style="color:red">*</b></label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="link" value="<?=$row['link']?>" placeholder="Enter video url here">
									 </div>
									 
									 <div class="col-md-4">
									<select class="form-control" name="type">
										<option value=""><?=get_phrase('select_link_type');?></option>
										<option value="youtube"<?php if($row['type' == 'youtube'])echo 'selected="selected"';?>><?php echo get_phrase('youtube');?></option>
										<option value="vimeo"<?php if($row['type' == 'vimeo'])echo 'selected="selected"';?>><?php echo get_phrase('vimeo');?></option>
									
									</select>
									 </div>
							</div>
						</div>
				

						
					
						<div class="form-group">
								<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
								<div class="col-sm-12">
									<textarea rows="5" name="remarks" class="form-control"><?=$row['remarks'];?></textarea>
								</div>
						</div>
						
						<div class="form-group">
                    		<div class="col-sm-12">
                				<input type="checkbox" class="js-switch" value="1" name="send_notification_sms" checked> <i></i> <?=get_phrase('send_notification_sms')?>
							</div>
            			</div>
				

								
						<div class="form-group">
							 <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?=get_phrase('save');?></button>
						</div>
					
                <?=form_close();?>
				<?php endforeach;?>
			</div>                
		</div>
	</div>
			<!----CREATION FORM ENDS-->
			
	<script type="text/javascript">
		function ShowHideDiv() {
			var showForm 	= document.getElementById("showForm");
			var video 	= document.getElementById("video");
			var links 	= document.getElementById("links");
			video.style.display 		= showForm.value == "video" ? "block" : "none";
			links.style.display 		= showForm.value == "links" ? "block" : "none";
		}
	</script>
	
 
</div>			
			
	<script type="text/javascript">
    var class_id = '';
    var starting_hour = '';
    var starting_minute = '';
    var ending_hour = '';
    var ending_minute = '';

    jQuery(document).ready(function($) {
        $('#add_class_routine').attr('disabled','disabled')
        });
    
        function get_class_section_subject(class_id) {
            $.ajax({
            url: '<?=base_url();?>admin/get_class_section_subject/' + class_id ,
            success: function(response){
            jQuery('#section_subject_selection_holder').html(response);
            }
            });
        }
 
    </script>
	
	<script>
        $(document).ready(function() {
            var class_id = $('#class_id').val();
            var video_class_id = '<?php echo $video_class_id;?>';
            get_class_section_subject(class_id,video_class_id);
			ShowHideDiv();
			
			
        });
    </script>
	
			