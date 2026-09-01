<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_award'); ?></div>
										<div class="panel-body table-responsive">
										
<?php echo form_open(site_url('admin/award/create'), array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('award_name'); ?> <b style="color:red">*</b></label>

                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" required value="" autofocus />
                        <input type="hidden" class="form-control" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" name="award_code" readonly="true">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('gift'); ?> <b style="color:red">*</b></label>

                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="gift" required value="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('amount'); ?> <b style="color:red">*</b></label>

                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="amount" required value="" />
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('employee'); ?> <b style="color:red">*</b></label>

                    <div class="col-sm-12">
                        <select name="user_id" class="form-control select2" required>
						<?php
						$user_array = ['teacher', 'accountant', 'librarian','hostel','hrm'];
  						for ($i=0; $i < sizeof($user_array); $i++):
    					$user_list = $this->db->get_where($user_array[$i])->result_array();
						
						foreach ($user_list as $employees):
	
						?>
                            <option value="<?php echo $user_array[$i].'-'.$employees[$user_array[$i].'_id']; ?>"><?php echo $employees['name']; ?></option>
						<?php endforeach;?>
						<?php endfor;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('date'); ?> <b style="color:red">*</b></label>
                    
                    <div class="col-sm-12">
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date" /required>
                    </div>
                </div>

                 <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-sm btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_award');?></button>
							</div>
 <?php echo form_close(); ?>                
 				</div>                
			</div>
		</div>
			<!----CREATION FORM ENDS-->


<div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_awards'); ?></div>
							


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">    <thead>
        <tr>
            <th><div>ID</div></th>
            <th><div><?php echo get_phrase('award_name'); ?></div></th>
            <th><div><?php echo get_phrase('gift'); ?></div></th>
            <th><div><?php echo get_phrase('amount'); ?></div></th>
            <th><div><?php echo get_phrase('awarded_employee'); ?></div></th>
            <th><div><?php echo get_phrase('date'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
    </thead>
    <tbody>
    

    			<?php 
				$counter = 1; $award = $this->db->get('award')->result_array();
				foreach ($award as $key => $award):
				$user_to_show = explode('-', $award['user_id']);
				$user_to_show_type = $user_to_show[0];
				$user_to_show_id = $user_to_show[1];
    			?>
      
            <tr>
                <td><?php echo $counter++;?></td>
                <td><?php echo $award['name'];?></td>
                <td><?php echo $award['gift'];?></td>
                <td><?php echo $award['amount'];?></td>
                <td><?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name;?></td>
                <td><?php echo $award['date'];?></td>
                
                <td>
				
				<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/edit_award/<?php echo $award['award_code'];?>');" 
                        class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit" style="color:white"></i></a>
						
                    <a href="#"  onclick="confirm_modal('<?php echo base_url(); ?>admin/award/delete/<?php echo $award['award_code'];?>');" 
                         class="btn btn-danger btn-circle btn-xs" onclick="return confirm('Are you sure to delete?');" style="color:white">
                         <i class="fa fa-times"></i> </a>
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
            <!----TABLE LISTING ENDS--->
			
