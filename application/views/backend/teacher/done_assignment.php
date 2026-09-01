 
  <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list');?></div>
                                <div class="panel-body table-responsive">
								
<table id="example23" class="display nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('student');?></th>
            <th><?php echo get_phrase('subject');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('actions');?></th>
        </tr>
    </thead>

    <tbody>

    <?php $counter = 1; $assignment = $this->db->get('done')->result_array();
                foreach($assignment as $key => $assignment):
				
				$subject_id = $this->db->get_where('assignment', array('assignment_id' => $assignment['assignment_id']))->row()->subject_id;
				?>
            <tr>
                <td><?php echo $counter++;?></td>
               
                <td><?php echo $this->db->get_where('assignment', array('assignment_id' => $assignment['assignment_id']))->row()->name;?></td>
               <td><?php echo $this->db->get_where('student', array('student_id' => $assignment['student_id']))->row()->name;?></td>
                <td><?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;?></td>
                <td><?php echo $this->db->get_where('assignment', array('assignment_id' => $assignment['assignment_id']))->row()->description;?></td>
                <td>
                <a href="<?php echo base_url().'uploads/assignment/'. $assignment['file_name'];?>"><button type="button" class="btn btn-info btn-circle btn-xs" ><i class="fa fa-download"></i></button></a>		
                   
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
function get_class_subject(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_subject/' + class_id,
        success:    function(response){
            jQuery('#subject_selector_holder').html(response);
        } 

    });
}
</script>
