<div class="row">
	<div class="col-sm-12">
	   <div class="panel panel-info">
		  <div class="panel-heading"> <i class="fa fa-users"></i> <?php echo get_phrase('students');?></div>
			 <div class="panel-body table-responsive">
			 	
				<div class="alert alert-danger" id="show_error" style="display:none; background:red; color:#fff">Please select class and section <b style="color:#fff">*</b></div>
			 
			 
				<div class="row">
				   <div class="col-sm-5">
					  <div class="form-group">
					  	<label for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
						 <select id="class_id" class="form-control" style="width:100%" onchange="get_sections(this.value)">
							<option value=""><?php echo get_phrase('class');?></option>
							<?php $class =  $this->db->get('class')->result_array();
							   foreach($class as $key => $class):?>
							<option value="<?php echo $class['class_id'];?>"
							   <?php if($class_id == $class['class_id']) echo 'selected';?>><?php echo $class['name'];?></option>
							<?php endforeach;?>
						 </select>
					  </div>
				   </div>
				   <div class="col-sm-5">
					  <div class="form-group">
					  	<label for="example-text"><?php echo get_phrase('section');?> <b style="color:red">*</b></label>
						<select name="section_id" id="section_id"  class="form-control">
							<option value=""><?php echo get_phrase('section') ?></option>
						</select> 
					  </div>
				   </div>
				   <div class="col-sm-2">
				   	  <label for="example-text">&nbsp;</label>
					  <button type="button" id="find" class="btn btn-success btn-rounded btn-sm btn-block"><i class="fa fa-search"></i> Filter</button>
				   </div>
				</div>
				<!-- PHP that includes table for subject starts here  ------>
				<div id="data">
				   <?php include 'showStudentClasswise.php';?>
				</div>
				<!-- PHP that includes table for subject ends here  ------>
			 </div>
		  </div>
	   </div>
	</div>
</div>

<script type="text/javascript">

	function get_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
            }
        });

    }

</script>
<script type="text/javascript">
   $(document).ready(function() {
   
   	$('#find').on('click', function() 
   	{
   		var class_id = $('#class_id').val();
   		var section_id = $('#section_id').val();
   		 if (class_id == "" || section_id == "") {
   				
			$('#show_error').show();   	
            
			return false;
		}
   		$.ajax({
   			url: '<?php echo site_url('admin/getStudentClasswise/');?>' + class_id + '/' + section_id
   		}).done(function(response) {
   			$('#data').html(response);
   		});
   	});
   
   });
   
   
</script>
