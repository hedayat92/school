<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('upload_parents'); ?></div>

				<?php echo form_open(base_url() . 'admin/parent/bulk_upload', array('class' => 'form-horizontal form-goups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
					<div class="panel-body table-responsive">
					
						<div class="alert alert-success" style="border:2px dotted gray; padding:20px;">
                            <a href="<?php echo base_url();?>uploads/excel/parent_blank_excel_template.xlsx" class="text-white">Download Excel Template Here</a>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="example-text"><?php echo get_phrase('browse_file');?> <b style="color:red">*</b></label>
								<div class="col-sm-12">
                                     <input name="excel_file" id="bulk" accept=".xlsx, .xls, csv" type="file" class="form-control" / required>
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
			