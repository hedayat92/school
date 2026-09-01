
                <?php echo form_open(base_url(). 'admin/new_student/import_student', 
										array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>
					<div class="panel-body table-responsive">
					
						<div class="alert alert-success" style="border:2px dotted gray; padding:20px;">
                            <a href="<?php echo base_url();?>uploads/excel/student_blank_excel_template.xlsx" class="text-white">Download Excel Template Here</a>
						</div>
										<hr>
										

										<div class="form-group">
                 							<label class="col-md-9" for="example-text"><?php echo get_phrase('select_class');?></label>
                   						 		<div class="col-sm-12">
													<select name="class_id" id="class_id" class="form-control select2"  onchange="get_sections_class(this.value)" / required>
														<option value=""><?php echo get_phrase('select_class');?></option>
														<?php
															$classes = $this->db->get('class')->result_array();
															foreach($classes as $row):
														?>
															<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
														<?php endforeach;?>
													</select>
												</div>
										</div>
										
										<div class="form-group">
                 							<label class="col-md-9" for="example-text"><?php echo get_phrase('select_section');?></label>
                   						 		<div class="col-sm-12">
												<select name="section_id" id="section_class"  class="form-control" / required>
													<option value=""><?php echo get_phrase('select_class_first') ?></option>
												</select>  
												</div>
										</div>
										
										<div class="form-group">
                 							<label class="col-md-9" for="example-text"><?php echo get_phrase('select_excel_file');?></label>
                   						 		<div class="col-sm-12">
												<input type="file" placeholder="ass" name="excel_file" id="excel_file" accept=".xlsx, .xls, csv" class="form-control" / required>
												</div>
										</div>
				  						
							
						
                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add');?></button>
							</div>
                <?php echo form_close();?>
				
				
				<script type="text/javascript">

	function get_sections_class(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_class').html(response);
            }
        });

    }

</script>
