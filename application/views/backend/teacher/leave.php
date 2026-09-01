

<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_leave'); ?></div>
										<div class="panel-body table-responsive">
																		 
	<?php echo form_open(base_url() . 'teacher/leave/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>


                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('start_date'); ?></label>
                    
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name="start_date"  value="<?=date('Y-m-d')?>" /required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('end_date'); ?></label>
                    
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name="end_date" value="<?=date('Y-m-d')?>" / required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('reason'); ?></label>

                    <div class="col-sm-12">
                        <textarea class="form-control" name="reason" rows="3" required></textarea>
                    </div>
                </div>

               <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-sm btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_leave');?></button>
							</div>
                    </form>                
                </div>                
			</div>
		</div>
										
										
										
<div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_leave'); ?></div>
							


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div>ID</div></th>
            <th><div><?php echo get_phrase('start_date'); ?></div></th>
            <th><div><?php echo get_phrase('end_date'); ?></div></th>
            <th><div><?php echo get_phrase('reason'); ?></div></th>
            <th><div><?php echo get_phrase('status'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
		$user_information_here = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $this->db->order_by('leave_id', 'desc');
        $leave = $this->db->get_where('leave',
            array('teacher_id' => $user_information_here))->result_array();
        foreach($leave as $row): ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['leave_code']; ?></td>
                <td><?php echo date('d/m/Y', $row['start_date']); ?></td>
                <td><?php echo date('d/m/Y', $row['end_date']); ?></td>
                <td><?php echo substr($row['reason'], 0, 50) . '...'; ?></td>
                <td>
                    <?php
                    if($row['status'] == 0)
                        echo '<div class="label label-info">' . get_phrase('pending') . '</div>';
                    if($row['status'] == 1)
                        echo '<div class="label label-success">' . get_phrase('approved') . '</div>';
                    if($row['status'] == 2)
                        echo '<div class="label label-danger">' . get_phrase('declined') . '</div>';
                    ?>
					<a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/leave_reasons/<?php echo $row['leave_code'];?>')" class="btn btn-info btn-sm btn-rounded">Reasons...</a>
                </td>
                <td>
				
				<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/leave_edit/<?php echo $row['leave_id']; ?>');" 
                        class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
						
                  <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>teacher/leave/delete/<?php echo $row['leave_id']; ?>');" 
                         class="btn btn-danger btn-circle btn-xs" onclick="return confirm('Are you sure to delete?');" style="color:white">
                            <i class="fa fa-times"></i> </a>  

                   

                </td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
			</div>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->