<div class="row">
                    <div class="col-sm-6">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_noticeboard'); ?></div>
										<div class="panel-body table-responsive">


        <?php echo form_open(base_url(). 'admin/noticeboard/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<!----CREATION FORM STARTS---->

	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('noticeboard_title');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
				<input name="title" type="text" class="form-control"/ required>
        </div>
    </div>
							
							
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('Location');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
				<input type="text" class="form-control" name="location"/ required>
        </div>
    </div>
							
							
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('content');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
			    <textarea class="form-control" name="description" ></textarea>
        </div>
    </div>
							
							
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('noticeboard_date');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
		    <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d');?>" id="example-date-input" required>   							
        </div>
    </div>
	
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('cover_image');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
		     <input type="file" class="form-control" name="userfile" onChange="readURL(this);" required>
				<img id="blah" src="" alt="" height="200" width="450"/>
				<p style="color:red">Upload image 500 x 257 pixel</p>						
        </div>
    </div>
	
	

    <div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('Send SMS ?');?></label>
        <div class="col-sm-12">
		    <input class="js-switch" name="sendsms" type="checkbox" >   							
        </div>
    </div>
          
                            
    <div class="form-group">
            <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('send_noticeboard');?></button>
    </div>
    <?php echo form_close();?>            
                
                </div>                
			</div>
		</div>
			<!----CREATION FORM ENDS-->
		
    <div class="col-sm-6">
			<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_noticeboard'); ?></div>
							


        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                    
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><div><?php echo get_phrase('title');?></div></th>
                                            <th><div><?php echo get_phrase('location');?></div></th>
                                            <th><div><?php echo get_phrase('date');?></div></th>
                                            <th><div><?php echo get_phrase('options');?></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php

                            $count = 1;  
                                    $select_noticeboard = $this->db->get('noticeboard')->result_array();
                                        foreach($select_noticeboard as $key => $noticeboard):

                                ?>
                                        <tr>
                                            <td><?php echo $noticeboard ['title'];?></td>
                                            <td><?php echo $noticeboard ['location'];?></td>
                                            <td><?php echo date('d M,Y', $noticeboard ['timestamp']);?></td>
                                            <td>
                                            
                                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_noticeboard/<?php echo $noticeboard['noticeboard_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url();?>admin/noticeboard/delete/<?php echo $noticeboard['noticeboard_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                                            
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
			