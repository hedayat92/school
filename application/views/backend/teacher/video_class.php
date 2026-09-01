<div class="row">
	<div class="col-sm-5">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-play"></i>&nbsp;&nbsp;<?=get_phrase('add_video'); ?></div>
				<?=form_open(base_url() . 'teacher/video_class/add', 
				array('class' => 'form-horizontal form-goups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="panel-body table-responsive">
					
					
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('title');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="title"/ required>
								</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('class');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select name="class_id" id = "class_id" class="form-control selectboxit"
										onchange="return get_class_section_subject(this.value)" required>
										<option value=""><?php echo get_phrase('select_class');?></option>
											<?php 
											$teacher_id = $this->session->userdata('teacher_id');
											$classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array(); 
											foreach($classes as $row): ?>
											<option value="<?=$row['class_id'];?>"><?=$row['name'];?></option>
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
									<input class="form-control m-r-10" name="date" type="date" value="<?=date('Y-m-d')?>" id="example-date-input" /required>
								 </div>
						</div>
						
						
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?=get_phrase('video_lesson_type');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select class="form-control" id="showForm" name="lesson_type" onchange = "ShowHideDiv()">
										<option value=""><?=get_phrase('select_video_lesson_type');?></option>
										<option value="video"><?php echo get_phrase('upload_video');?></option>
										<option value="links"><?php echo get_phrase('video_url');?></option>
									
									</select>
								</div>
						</div>
						
						
						<div id="video" style="display: none">
							<div class="form-group">
								<label class="col-md-12" for="example-text"><?=get_phrase('upload_video');?> <b style="color:red">*</b></label>
									<div class="col-md-12">
										<input class="form-control" name="file_name" accept=".mp4" type="file">
										<p style="color:red">Please upload only mp4 videos files for now *</p>
									 </div>
									 
									 
							</div>
						</div>
						
						<div id="links" style="display: none">
							<div class="form-group">
								<label class="col-md-12" for="example-text"><?=get_phrase('video_url');?> <b style="color:red">*</b></label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="link" placeholder="Enter video url here">
									 </div>
									 
									 <div class="col-md-4">
									<select class="form-control" name="type">
										<option value=""><?=get_phrase('select_link_type');?></option>
										<option value="youtube"><?php echo get_phrase('youtube');?></option>
										<option value="vimeo"><?php echo get_phrase('vimeo');?></option>
									
									</select>
									 </div>
							</div>
						</div>
						
						<hr class="sep-3">
				
						<div class="form-group">
								<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
								<div class="col-sm-12">
									<textarea rows="5" name="remarks" class="form-control" placeholder="please specify full description about video here" ></textarea>
								</div>
						</div>
						
						<div class="form-group">
                    		<div class="col-sm-12">
                				<input type="checkbox" class="js-switch" value="1" name="send_notification_sms" checked> <i></i> <?=get_phrase('send_notification_sms')?>
							</div>
            			</div>
				

				<?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-default btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>
					
                <?=form_close();?>
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
	
 	<div class="col-sm-7">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?=get_phrase('list_video_classroom'); ?></div>
				<div class="panel-body table-responsive">
			
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
						<thead>
                		<tr>
                    		<th><div><?=get_phrase('title');?></div></th>
                    		<th><div><?=get_phrase('class');?></div></th>
							<th><div><?=get_phrase('section');?></div></th>
                    		<th><div><?=get_phrase('subject');?></div></th>
							<th><div><?=get_phrase('date');?></div></th>
							<th><div><?=get_phrase('uploader');?></div></th>
                            <th><div><?=get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>

                    <?php $select = $this->live_class_model->selectVideoClassInformationByUser();
					 		foreach ($select as $key => $video) : ?>
                        <tr>
                            <td><?=$video['title'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', 	 $video['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $video['section_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('subject', $video['subject_id']);?></td>
							<td><?=date('d, M Y', $video['date']);?></td>
							<td>
							
							<?php 
							
							$user = explode('-', $video['user']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							
							
							</td>
							<td>
								<a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/watch_video/<?=$video['video_class_id'];?>')" 
								class="btn btn-success btn-rounded btn-xs"><i class="fa fa-play"></i> watch</a>
								
								<a href="<?php echo base_url();?>teacher/edit_video_class/<?=$video['video_class_id'];?>">
								<button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-edit"></i> edit</button></a>
								
								
								<a href="<?php echo base_url();?>teacher/video_class/delete/<?=$video['video_class_id'];?>" 
								onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" 
								style="color:white"><i class="fa fa-times"></i></a>
								
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
            <!----TABLE LISTING ENDS--->
			
			
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
			