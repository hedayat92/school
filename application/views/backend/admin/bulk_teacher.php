<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('upload_teachers'); ?></div>

				<?php echo form_open(base_url() . 'admin/teacher/bulk_upload', array('class' => 'form-horizontal form-goups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
					<div class="panel-body table-responsive">
					
						<div class="alert alert-success" style="border:2px dotted gray; padding:20px;">
                            <a href="<?php echo base_url();?>uploads/excel/teacher_blank_excel_template.xlsx" class="text-white">Download Excel Template Here</a>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('excel_file');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
                                    <input name="excel_file" id="bulk" accept=".xlsx, .xls, csv" type="file" class="form-control" / required>
                                </div>
                        </div>
						
						 <div class="col-sm-12">
							<div class="form-group fill">
								<label class="floating-label" for="Icon"><?php echo get_phrase('department');?> <b style="color:red">*</b></label>
								<select name="department_id" id="department_id" class="form-control" onchange="get_designation_val_excel(this.value)"  placeholder="sds" / required>
									<option value=""><?php echo get_phrase('select_a_department'); ?></option>
									<?php
										$department = $this->db->get('department')->result_array();
										foreach ($department as $row): ?>
									<option value="<?php echo $row['department_id']; ?>">
										<?php echo $row['name']; ?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						 <div class="col-sm-12">
							<div class="form-group fill">
								<label class="floating-label" for="Icon"><?php echo get_phrase('designation');?> <b style="color:red">*</b></label>
								<select name="designation_id" class="form-control" id="designation_holder_excel" placeholder="sds" / required>
									<option value=""><?php echo get_phrase('select_a_department_first'); ?>
									</option>
								</select>
							</div>
						</div>
                            
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('upload');?></button>
						</div>
                <?php echo form_close();?>
            </div>                
		</div>
	</div>
</div>
            <!----TABLE LISTING ENDS--->
				<script type="text/javascript">
		function get_designation_val_excel(department_id) {
			if (department_id != '')
				$.ajax({
					url: '<?php echo base_url();?>admin/get_designation/' + department_id,
					success: function(response) {
						console.log(response);
						jQuery('#designation_holder_excel').html(response);
					}
				});
			else
				jQuery('#designation_holder').html('<option value=""><?php echo get_phrase("select_a_department_first"); ?></option>');
		}
	</script>