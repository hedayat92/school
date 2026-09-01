  
  
  <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
								
<table id="example23" class="display nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('file_type');?></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('class');?></th>
            <th><?php echo get_phrase('subject');?></th>
            <th><?php echo get_phrase('teacher');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('actions');?></th>
        </tr>
    </thead>

    <tbody>

    <?php $counter = 1; 
	 
     $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
     $select_student_class_id = $student_profile->class_id;
	 

    $assignment = $this->db->get_where('assignment', array('class_id' => $select_student_class_id ))->result_array();
                foreach($assignment as $key => $assignment):
				$done = $this->db->get_where('done', array('student_id' => $this->session->userdata('student_id'), 'assignment_id' => $assignment['assignment_id']))->row();
				?>
            <tr>
                <td><?php echo $counter++;?></td>
                <td>
                <?php if($assignment['file_type']=='img' || $assignment['file_type']== 'jpg' || $assignment['file_type']== 'png'){?>
                <img src="<?php echo base_url();?>optimum/images/image.png" style="max-height:40px;">
                <?php }?>
                <?php if($assignment['file_type']=='docx'){?>
                <img src="<?php echo base_url();?>optimum/images/doc.jpg" style="max-height:40px;">
                <?php }?>
                <?php if($assignment['file_type']=='pdf'){?>
                <img src="<?php echo base_url();?>optimum/images/pdf.jpg" style="max-height:40px;">
                <?php }?>
                <?php if($assignment['file_type']=='xlsx'){?>
                <img src="<?php echo base_url();?>optimum/images/text.png" style="max-height:40px;">
                <?php }?>
                <?php if($assignment['file_type']=='txt'){?>
                <img src="<?php echo base_url();?>optimum/images/text.png" style="max-height:40px;">
                <?php }?>

              
                </td>
                <td><?php echo $assignment['name'];?></td>
                <td><?php echo $this->db->get_where('class', array('class_id' => $assignment['class_id']))->row()->name;?></td>
                <td><?php echo $this->db->get_where('subject', array('subject_id' => $assignment['subject_id']))->row()->name;?></td>
                <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $assignment['teacher_id']))->row()->name;?></td>
                <td><?php echo $assignment['description'];?></td>
                <td>
                
				<a href="<?php echo base_url().'uploads/assignment/'. $assignment['file_name'];?>"><button type="button" class="btn btn-info btn-rounded btn-sm" ><i class="fa fa-download"></i> assignment</button></a>
				
				<?php if($done->student_id != null) : ?>
				<a href="<?php echo base_url().'uploads/assignment/'.$done->file_name; ?>" class="btn btn-success btn-rounded btn-sm" style="color:white">
                        <i class="fa fa-download"></i> submitted
                 </a>
				 <?php endif;?>
				
				 
				 <?php if($done->student_id == null) : ?>
				  <hr>
				 <div class="alert alert-info">Assignment not submitted
					<form action="<?php echo base_url();?>student/submit" method="post" enctype="multipart/form-data">
					<input class="" type="hidden" value="<?=$assignment['assignment_id']?>" name="assignment_id" / required>
					<input class="" name="file_name" type="file" / required>
					<button type="submit" class="btn btn-primary btn-sm btn-rounded">submit assignment</button>
					</form>
					</div>
				 <?php endif;?>
				 
					
                   
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

