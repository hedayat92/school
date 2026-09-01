
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
           
                <div class="panel-body table-responsive">
					<div class="alert alert-info">Select exam, class and subject. Browse for the excel file you downloaded and click on <?php echo get_phrase('upload_score');?> button</div>
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/student_marksheet_subject' , array('enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('exam');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_examination');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="return get_class_subject(this.value)" / required>
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>">Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('subject');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<select name="subject_id" class="form-control" id="subject_selector_holder" / required>
										<option value=""><?php echo get_phrase('select_class_first');?></option>
									</select>
									<p>Please ensure you select the right <strong>[ SUBJECT ]</strong> you enter score for in excel file you downloaded</p>
					  			</div>
								
						</div>
						
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('browse_file');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
									<input type="file" class="form-control" name="score_bulk_upload" /required>
					  			</div>
						</div>
						
						
                            
                            <input class="" type="hidden" value="upload" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-upload"></i>&nbsp;<?php echo get_phrase('upload_score');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>
<script type="text/javascript">
function get_class_subject(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_subject/' + class_id,
        success:    function(response){
            jQuery('#subject_selector_holder').html(response);
        } 

    });
}
</script>
