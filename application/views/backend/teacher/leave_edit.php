<?php
$edit_data = $this->db->get_where('leave', array('leave_id' => $param2))->result_array();
foreach($edit_data as $row) { ?>
   
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_leave'); ?></div>
										<div class="panel-body table-responsive">

 
	<?php echo form_open(base_url() . 'teacher/leave/update/' . $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>


                      <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('start_date'); ?></label>
                    
                    <div class="col-sm-12">
                            <input type="date" class="form-control" name="start_date" value="<?php echo date('Y-m-d', $row['start_date']); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('end_date'); ?></label>
                    
                    <div class="col-sm-12">
                            <input type="date" class="form-control" name="end_date" value="<?php echo date('Y-m-d', $row['end_date']); ?>" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('reason'); ?></label>

                    <div class="col-sm-12">
                            <textarea class="form-control" name="reason" rows="3" required><?php echo $row['reason']; ?></textarea>
                        </div>
                    </div>

                   <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-sm btn-rounded"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_leave');?></button>
							</div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>