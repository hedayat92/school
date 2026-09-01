<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_fee_type'); ?>
            </div>
			
			
			<?php if (!isset($edit_fee_type)) : ?>
			
            <?php echo form_open(base_url() . 'admin/fee_type/save', array('class' => 'form-horizontal form-goups-bordered validate'));?>
            <div class="panel-body table-responsive">

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('title');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input name="title" type="text" class="form-control" / required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('amount');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input name="amount" type="number" class="form-control" / required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> </label>
                    <div class="col-sm-12">

                        <select name="class_id" id="class_id" class="form-control" / required>
                            <option value=""><?php echo get_phrase('select_class');?></option>

                            <?php 
								$class =  $this->db->get('class')->result_array();
                    			foreach($class as $key => $class):
							?>
                            <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?> </option>
                            <?php endforeach;?>
                        </select>


                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('date');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input class="form-control m-r-10" name="date" type="date" value="<?=date('Y-m-d')?>"
                            id="example-date-input" /required>
                    </div>
                </div>
				
				
			<div class="alert alert-info">Fee payment type will be saved based on the term and session selected in system settings. Ensure you set your term and session first 
				<a href="<?php echo base_url()?>systemsetting/system_settings" style="color:white"><i class="fa fa-arrow-right"></i> HERE</a>
			</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success btn-rounded btn-sm "><i
                            class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
                </div>
                <?php echo form_close();?>
				
				
				<?php endif;?>
				
				
				
				<?php 
				
					if (isset($edit_fee_type)) : 
				
					$id = $edit_fee_type;
					$sql = $this->db->get_where('fee_type', array('id' => $id))->result_array();
					foreach($sql as $key => $row) :
				
				?>
				
				
            <?php echo form_open(base_url() . 'admin/fee_type/save/' . $id, array('class' => 'form-horizontal form-goups-bordered validate'));?>
            <div class="panel-body table-responsive">

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('title');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input name="title" type="text" value="<?=$row['title'];?>" class="form-control" / required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('amount');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input name="amount" type="number" value="<?=$row['amount'];?>" class="form-control" / required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> </label>
                    <div class="col-sm-12">

                        <select name="class_id" id="class_id" class="form-control" / required>
                            <option value=""><?php echo get_phrase('select_class');?></option>

                            <?php 
								$class =  $this->db->get('class')->result_array();
                    			foreach($class as $key => $class):
							?>
                            <option value="<?php echo $class['class_id'];?>"
							<?php if($row['class_id'] == $class['class_id']) echo 'selected="selected"';?>><?php echo $class['name'];?> 
							</option>
                            <?php endforeach;?>
                        </select>


                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('date');?> <b
                            style="color:red">*</b></label>
                    <div class="col-sm-12">
                        <input class="form-control m-r-10" name="date" type="date" value="<?=date('Y-m-d', $row['date']);?>"
                            id="example-date-input" /required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i
                            class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
                </div>
				
				
				 <?php echo form_close();?>
				  
				  <?php endforeach;?>
				
				
				<?php endif;?>
				
				
				
            </div>
        </div>
    </div>
    <!----CREATION FORM ENDS-->

    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"> <i
                    class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_fee_types'); ?>
            </div>



            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>


                            <tr>

                                <th>
                                    <div><?php echo get_phrase('class');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('title');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('amount');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('date');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('actions');?></div>
                                </th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php 
								$select = $this->db->get_where('fee_type', array('term' => get_settings('term'), 'session' => get_settings('session')))->result_array();
								foreach ($select as $key => $type): 
							?>
                            <tr>
                                <td><?php echo $this->crud_model->get_type_name_by_id('class', $type['class_id']);?></td>
                                <td><?php echo $type ['title'];?></td>
                                <td><?php echo $system_currency .' '. number_format($type ['amount'], 2, ".",",");?></td>
                                <td><?php echo date('d, M Y',$type['date']);?></td>
                                <td>

                                    <a href="<?php echo base_url();?>admin/fee_type/edit/<?php echo base64_encode($type['id']);?>"
                                        class="btn btn-info btn-circle btn-xs" style="color:white"><i class="fa fa-edit"></i>
                                    </a>

                                    <a href="<?php echo base_url();?>admin/fee_type/delete/<?php echo $type['id'];?>"
                                        onclick="return confirm('Are you sure want to delete?');"
                                        class="btn btn-danger btn-circle btn-xs" style="color:white"><i
                                            class="fa fa-times"></i>
                                    </a>
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