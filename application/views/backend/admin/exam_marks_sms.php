
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Send Student Score');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/exam_marks_sms/send/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_exam');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" id="exam_id" class="form-control select2">
                                        <?php
											$this->db->order_by('exam_id', 'desc');  
											$exams =  $this->db->get('exam')->result_array();
                                        	foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>
                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" required>
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $select_all_classes_from_model =  $this->crud_model->get_classes();
                                        foreach($select_all_classes_from_model as $key => $all_classes_selected_from_model):?>
                                        <option value="<?php echo $all_classes_selected_from_model['class_id'];?>"><?php echo $all_classes_selected_from_model['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								

                            <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Receiver');?></label>
                                <div class="col-sm-12">
                                    <select name="receiver"  class="form-control" required>
                                        <option value="parent"><?php echo get_phrase('Send to parent');?></option>
                                        <option value="student"><?php echo get_phrase('Send to student');?></option>
                                    </select>
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('send_student_score');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>