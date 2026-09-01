<?php $select_leave = $this->db->get_where('leave', array('leave_code' => $param2))->result_array();

foreach ($select_leave as $key => $leave):
?>


<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('update'); ?></div>

<?php echo form_open(base_url() . 'hrm/leave/update/' . $leave['leave_code'] , array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
                    <div class="form-group">
                       <label class="col-md-12" for="example-text"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-12">
                            <select name="status" class="form-control select2">
                                    <option value="1" <?php if($leave['status'] == 1) echo 'selected'; ?>>
                                        <?php echo get_phrase('approved'); ?></option>
                                    <option value="0" <?php if($leave['status'] == 0) echo 'selected'; ?>>
                                        <?php echo get_phrase('pending'); ?></option>
                                    <option value="2" <?php if($leave['status'] == 2) echo 'selected'; ?>>
                                        <?php echo get_phrase('declined'); ?></option>
                                </select>
                            </div>
                        </div>
						
						 <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('reason'); ?></label>

                    <div class="col-sm-12">
                        <textarea class="form-control" name="reason_for_declined" rows="3" required><?php echo $leave['reason_for_declined'];?></textarea>
                    </div>
                </div>
				
							
                            
                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_leave');?></button>
							</div>
                <?php echo form_close();?>
                </div>                
			</div>
		</div>
</div>


<?php endforeach; ?>