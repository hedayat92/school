<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp; <?php echo get_phrase('pending_admission');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">

    <thead>
        <tr>
            
            <th>Roll</th>
            <th>Name</th>
            <th>Email</th>
            <th>Sex</th>
            <th>Phone</th>
            <th>Age</th>
			<th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php
		$select = $this->db->get('form')->result_array();
    	foreach ($select as $key => $value):?>
        			
            <tr>
                <td><?php echo $value ['roll'];?></td>
                <td><?php echo $value ['name'];?></td>
                <td><?php echo $value ['email'];?></td>
                <td><?php echo $value ['sex'];?></td>
                <td><?php echo $value ['phone'];?></td>
                <td><?php echo $value ['age'];?></td>
				<td>
					<span class="label label-<?php if($value['status'] == 'pending') echo 'warning'; else echo 'success';?>"><?php echo $value ['status'];?></span>
				</td>
                <td>
                <?php if($value['status'] == 'pending') : ?>
				 <a href="<?php echo base_url();?>admin/pending_admission/delete/<?php echo $value['form_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
				
                <a href="<?php echo base_url();?>admin/pending_admission/approve/<?php echo $value['form_id'];?>" onclick="return confirm('Are you sure want to approve student. Please note that you will have to update student info?');" class="btn btn-success btn-rounded btn-sm" style="color:white"><i class="fa fa-check"></i> Approve ?</a>
                <?php endif;?>
				<?php if($value['status'] != 'pending') : ?>
				<?php $select2 = $this->db->get_where('student', array('email' => $value['email']))->row(); ?>
		<a href="<?php echo base_url();?>admin/edit_student/<?php echo $select2->student_id;?>" ><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-plus"></i> continue registration</button></a>
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