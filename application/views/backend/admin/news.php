<div class="row">
                    <div class="col-sm-6">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_news'); ?></div>
										<div class="panel-body table-responsive">


        <?php echo form_open(base_url(). 'admin/news/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<!----CREATION FORM STARTS---->

	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('title');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
				<input name="title" type="text" class="form-control"/ required>
        </div>
    </div>
							

							
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('content');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
			    <textarea class="form-control" name="description" ></textarea>
        </div>
    </div>
							
							
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('date');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
		    <input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d');?>" id="example-date-input" required>   							
        </div>
    </div>
	
	<div class="form-group">
            <label class="col-md-12" for="example-text"><?php echo get_phrase('cover_image');?> <b style="color:red">*</b></label>
        <div class="col-sm-12">
		     <input type="file" class="form-control" name="userfile" onChange="readURL(this);" required>
				<img id="blah" src="" alt="" height="200" width="500"/>
				<p style="color:red">Upload image 500 x 257 pixel</p>						
        </div>
    </div>
	

          
                            
				<?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-default btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>
    <?php echo form_close();?>            
                
                </div>                
			</div>
		</div>
			<!----CREATION FORM ENDS-->
		
    <div class="col-sm-6">
			<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_news'); ?></div>
							


        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
                    
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><div><?php echo get_phrase('title');?></div></th>
                                            <th><div><?php echo get_phrase('content');?></div></th>
                                            <th><div><?php echo get_phrase('date');?></div></th>
                                            <th><div><?php echo get_phrase('options');?></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php

                            $count = 1;  
                                    $select_news = $this->db->get('news')->result_array();
                                        foreach($select_news as $key => $news):

                                ?>
                                        <tr>
                                            <td><?php echo $news ['title'];?></td>
                                            <td><?php echo $news ['description'];?></td>
                                            <td><?php echo date('d M,Y', $news ['timestamp']);?></td>
                                            <td>
                                            
                                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_news/<?php echo $news['news_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url();?>admin/news/delete/<?php echo $news['news_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                                            
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
			