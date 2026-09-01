<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-info">
                          
			<div class="panel-body table-responsive">
				<?php echo get_phrase('add_image'); ?>
			<hr>


                	<?php echo form_open(base_url().'admin/gallery/create' , 
					array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

 
 					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('title');?> <b style="color:red">*</b></label>        
						 <div class="col-sm-12">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>

					<div class="form-group"> 
					<label class="col-sm-12"><?php echo get_phrase('content');?>*</label>        
						<div class="col-sm-12">
							<textarea id="mymce"  name="content"  placeholder="Enter short contents here"></textarea>
						</div>
					</div>
					
					<div class="form-group"> 
					<label class="col-sm-12"><?php echo get_phrase('date');?> <b style="color:red">*</b></label>        
						<div class="col-sm-12">
							<input class="form-control m-r-10" name="date" type="date" value="<?php echo date ('Y-m-d'); ?>" id="example-date-input" required>
					 	</div>
					</div>

					<div class="form-group"> 
					<label class="col-sm-12"><?php echo get_phrase('Cover Image');?> <b style="color:red">*</b></label>        
						<div class="col-sm-12">
							<input type="file" name="userfile" class="dropify" / required>
						</div>
					</div>	

  
                    <div class="form-group">
						<button type="submit" class="btn btn-rounded btn-block btn-info btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
					</div>				

 				<?php echo form_close();?>    
		</div>                
	</div>
</div>
			<!----CREATION FORM ENDS-->
		
<div class="col-sm-6">
	<div class="panel panel-info">
		<div class="panel-body table-responsive">
			<?php echo get_phrase('list'); ?>
			<hr>
			
                	<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('title');?></div></th>
							<th width="80"><div><?php echo get_phrase('image');?></div></th>
                            <th><div><?php echo get_phrase('actions');?></div></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        		<?php 
                                $gallery	=	$this->db->get('gallery')->result_array();
                                foreach($gallery as $row):?>
                        <tr>
						<td><?php echo $row ['name'];?></td>
                            <td><img src="<?=$this->crud_model->get_image_url('gallery', $row['gallery_id'])?>"  width="50" height="50" /></td>
                           

                            <td>
							<a href="<?php echo base_url();?>admin/gallery/delete/<?php echo $row['gallery_id'];?>" onclick="return confirm('Are you sure want to delete?');" 
								class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>				
						<a href="<?php echo base_url('admin/upload_gallery_image/'.$row['gallery_id']);?>" class="btn btn-rounded btn-sm btn-info" style="color:white">
						<i class="fa fa-upload"></i>&nbsp;Upload Images</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
            <!----TABLE LISTING ENDS--->
			