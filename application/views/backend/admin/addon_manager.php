<div class="row"> 
	<div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-gears"></i>&nbsp;&nbsp;<?php echo get_phrase('available_addons'); ?></div>
             <div class="panel-body table-responsive">
				<iframe scrolling="yes" class="col-md-12 w-100" frameborder="none" style="height: 510px;" src="https://www.optimumlinkupsoftware.com/category/add-on"></iframe>
			</div>
		</div>
	</div>
</div>


<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_addon'); ?></div>

                <?php echo form_open(base_url() . 'updater/update', 
                array('class' => 'form-horizontal form-goups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="panel-body table-responsive">

					<div class="form-group">
                 	    <label class="col-md-12" for="example-text"><?php echo get_phrase('browse_file_to_install');?> <b style="color:red">*</b></label>
                            <div class="col-sm-12">
					            <input class="form-control m-r-10" name="file_name" type="file"  /required>
                            </div>
                    </div>
                            
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('install');?></button>
    				</div>
                <?php echo form_close();?>
                </div>                
			</div>
			</div>
			<!----CREATION FORM ENDS-->
	
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-gears"></i>&nbsp;&nbsp;<?php echo get_phrase('list_addon'); ?></div>
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
				        <thead>
                		<tr>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('unique_key');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                            <th><div><?php echo get_phrase('version');?></div></th>
						</tr>
                  
					</thead>
                    <tbody>

                    <?php 
                            $selectAddondata = $this->db->get('addons')->result_array();
                    foreach ($selectAddondata as $key => $value): ?>
                        <tr>
                            <td><?=$value ['name'];?></td>
							<td><?=$value ['unique_key'];?></td>
							<td><span class="label label-<?php if($value['status'] == 'installed') echo 'success'; else echo 'warning';?>"><?=$value['status'];?></span></td>
							<td><?=$value ['version'];?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
            <!----TABLE LISTING ENDS--->
			