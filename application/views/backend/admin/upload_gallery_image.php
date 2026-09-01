<?php foreach($image as $row):?>	
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp; 
							
							<?php echo $row['name']; ?><a href="<?php echo base_url();?>admin/gallery" 
                     class="btn btn- btn-xs pull-right"><i class="fa fa-mail-reply-all"></i>&nbsp;<?php echo get_phrase('back');?>
                    </a>
							
							</div>
						<div class="panel-body table-responsive">
										
			<?php echo form_open(base_url() . 'admin/gallery/upload_images/' . $row['gallery_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('Upload Images');?>*</label>        
					 <div class="col-sm-12">
<input type="file" class="form-control btn btn-info btn-rounded" name="gallery_images[]"
          multiple data-label="<i class='fa fa-upload'></i> &nbsp;Browse Files"
          accept="image/*" / required>
		  <br>
		  <p style="color:#FF0000"> You can select multiple images by pressing and hold control key on your keyboard when you browse image.</p>
		  
		  </div>
</div>	
 <div class="form-group">
							<button type="submit" class="btn btn-suucess btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Upload Image');?></button>
					</div>			
  <?php echo form_close();?>
  
  <hr>
All Images for <?php echo $row['name']; ?>
 <div class="row">
<div class="col-sm-12">
<div class="row">
							
							<div class="col-sm-12">
							<div class="zoom-gallery m-t-30">
									
									<?php
    									$images = $this->db->get_where('galleryimagearray' , array('gallery_id' => $row['gallery_id']))->result_array();
    									foreach ($images as $row2) {
  									?>
                                        <a href="<?php echo base_url(); ?>uploads/gallery_image/gallery_images/<?php echo $row2['imageArray'];?>" title="<?php echo $row['name']; ?>">
                                            <img src="<?php echo base_url(); ?>uploads/gallery_image/gallery_images/<?php echo $row2['imageArray'];?>" width="32.5%" />
                                        </a>
									
           								<?php } ?>
										
                                    </div>
                                </div>
								
								
</div>			
</div>
</div>
<hr>
								<?php
    									$images = $this->db->get_where('galleryimagearray' , array('gallery_id' => $row['gallery_id']))->result_array();
    									foreach ($images as $row3) {
  									?>
										<a href="#" class="btn btn-danger btn-xs btn-circle"
        onclick="confirm_modal('<?php echo site_url('admin/gallery/delete_image/'.$row3['id'].'/'. $row['gallery_id']);?>');" style="color:white">
       <?php echo $row3 ['id']; ?>
      </a>
	  
	  	<?php } ?>					
</div>
</div>
</div>
</div>

<?php endforeach; ?>