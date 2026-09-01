<div class="alert alert-default" align="justify">
	<strong><?php echo get_phrase('instruction').': '; ?></strong>
	Please note that this multiple upload is only application to true or false question for now till we update filling in the blanks and multiple choice.<br><br>
	When you download sample excel format, you need to know the online_exam_id. For this exam the online_exam_id is&nbsp;&nbsp; <strong style="color:red"><?php echo $online_exam_id;?></strong>
	<hr>
			<div class="form-group">
				<a href="<?php echo base_url();?>uploads/sample.xlsx"><label for="exampleInputEmail1"><?php echo get_phrase('Download Sample Here');?></label></a>										
			</div>
</div>

				<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo form_open(base_url(). 'admin/manage_online_exam/upload/', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo get_phrase('Upload Question');?></label>
                                            <input type="file" class="form-control" name="userfile" value="">
											<input type="hidden" class="form-control" name="online_exam_id" value="<?php echo $online_exam_id;?>">
                                        </div>
                                        
                                        
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?php echo get_phrase('Save');?></button>
                                   <?php echo form_close();?>
                                   
                            </div>
                        </div>
                    </div>
</div>