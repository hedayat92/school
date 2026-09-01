
<?php $select = $this->db->get_where('video_class', array('video_class_id' => $param2))->result_array();
foreach ($select as $key => $row) : 

	$getVideoUrlType = $row['lesson_type'];
	$getVideoLinkPlayer = $row['type'];
	$link = $row['link'];
?>
<?php if ($getVideoUrlType == 'video') { ?>
<div class="row">
	<div class="col-sm-12">
	

		 <div class="panel-body table-responsive">
			<strong>Title :</strong>&nbsp;<?=$row['title'] ?>&nbsp;<strong>Description</strong>:&nbsp;<?=$row['remarks']?>&nbsp;<strong>Date Uploaded:</strong>&nbsp;<?=date('d, M Y', $row['date'])?>
			<hr>
				 <video width="700" height="300" controls>
					<source src="<?=base_url();?>uploads/video_class/<?=$row['file_name']?>" type="video/mp4">
				 </video> 
			</div>
                            
	</div>
</div>
<?php }?>

<?php if ($getVideoUrlType == 'links' && $getVideoLinkPlayer == 'youtube') { ?>

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">
	  


        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
		
			<iframe src="<?=$link;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		
		</div>

      </div>

		  <!--Footer-->
		  <div class="modal-footer justify-content-center flex-column flex-md-row">
        	<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
      	</div>

    </div>
    <!--/.Content-->

<?php }?>



<?php if ($getVideoUrlType == 'links' && $getVideoLinkPlayer == 'vimeo') { ?>

 <!--Content-->
    <div class="modal-content">

		  <!--Body-->
		  <div class="modal-body mb-0 p-0">
	
			<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
				<iframe src="<?=$link;?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
	
		  </div>
		  
		  <!--Footer-->
		  <div class="modal-footer justify-content-center flex-column flex-md-row">
        	<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
      	</div>
		  
	</div>
<?php }?>



<?php endforeach;?>