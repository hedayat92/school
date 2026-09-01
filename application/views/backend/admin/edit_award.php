<?php $award = $this->db->get_where('award', array('award_code' => $param2))->result_array();
foreach($award as $key => $award):
?>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_award'); ?></div>
										<div class="panel-body table-responsive">

                    <?php echo form_open(site_url('admin/award/update/' . $param2), array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                    <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('award_name'); ?></label>

                    <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" value="<?php echo $award['name'];?>" />
                        </div>
                    </div>

                   <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('gift'); ?></label>

                    <div class="col-sm-12">
                            <input type="text" class="form-control" name="gift" value="<?php echo $award['gift'];?>"/>
                        </div>
                    </div>

                   
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('amount'); ?></label>

                    <div class="col-sm-12">
                            <input type="text" class="form-control" name="amount" value="<?php echo $award['amount'];?>" />
                        </div>
                    </div>


                    <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('employee'); ?></label>

                    <div class="col-sm-12">
                        <select name="user_id" class="form-control select2" required>
                            <?php
								$user_array = ['teacher', 'accountant', 'librarian','hostel','hrm'];
								for ($i=0; $i < sizeof($user_array); $i++):
								$user_list = $this->db->get_where($user_array[$i])->result_array();
								foreach ($user_list as $employees):
							?>
                            <option value="<?php echo $user_array[$i].'-'.$employees[$user_array[$i].'_id']; ?>"
							<?php if($award['user_id'] == $user_array[$i].'-'.$employees[$user_array[$i].'_id']) echo 'selected="selected"';?>
							><?php echo $employees['name']; ?></option>
						<?php endforeach;?>
						<?php endfor;?>


                        </select>
                    </div>
                </div>

               

                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('date'); ?></label>
                    
                    <div class="col-sm-12">
                            <input type="date" class="form-control" name="date" value="<?php echo $award['date'];?>" />
                        </div>
                    </div>
  <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-sm btn-rounded"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_award');?></button>
							</div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
	

<?php endforeach; ?>