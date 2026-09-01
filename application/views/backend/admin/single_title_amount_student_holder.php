<?php $query = $this->db->get_where('fee_type', array('class_id' => $class_id, 'term' => get_settings('term'), 'session' => get_settings('session')));
if($query->num_rows() > 0):
    $titles = $query->result_array();?>

    <div class="form-group">
        <label class="col-md-12" for="example-text"><?php echo get_phrase('fee_title');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">

            <select name="dummy" id="dummy" class="form-control" onchange="return get_single_class_title_amount(this.value)" / required>
			<option value="">Select Fee Title</option>
            <?php foreach($titles as $key => $title):?>
                <option value="<?php echo $title['id'];?>"><?php echo $title['title'];?></option>
            <?php endforeach;?>

            </select>
        </div>
    </div>
<?php endif;?>


    <div id="single_class_title_amount"> </div>


<?php $query = $this->db->get_where('student', array('class_id' => $class_id));
if($query->num_rows() > 0):
    $students = $query->result_array();?>

    <div class="form-group">
        <label class="col-md-12" for="example-text"><?php echo get_phrase('student');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">

            <select name="student_id" class="form-control" /required>
            <?php foreach($students as $key => $student):?>
                <option value="<?php echo $student['student_id'];?>"><?php echo $student['name'];?></option>
            <?php endforeach;?>

            </select>
        </div>
    </div>
<?php endif;?>