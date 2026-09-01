<?php $select_news = $this->db->get_where('news', array('news_id' => $param2))->result_array();

foreach ($select_news as $key => $news):
?>


<div class="row">
    <div class="col-sm-12">
	 	<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_news'); ?></div>
	        	<div class="panel-body table-responsive">
                                    <?php echo form_open(base_url(). 'admin/news/update/' . $param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                            <!----CREATION FORM STARTS---->

                                <div class="form-group">
                                        <label class="col-md-12" for="example-text"><?php echo get_phrase('news_title');?></label>
                                    <div class="col-sm-12">
                                            <input name="title" value="<?php echo $news['title'];?>" type="text" class="form-control"/ required>
                                    </div>
                                </div>
                                                        
                                  
                                                        
                                <div class="form-group">
                                        <label class="col-md-12" for="example-text"><?php echo get_phrase('content');?></label>
                                    <div class="col-sm-12">
                                            <textarea  class="form-control" name="description" ><?php echo $news['description'];?></textarea>
                                    </div>
                                </div>
                                                        
                                                        
                                <div class="form-group">
                                        <label class="col-md-12" for="example-text"><?php echo get_phrase('news_date');?></label>
                                    <div class="col-sm-12">
                                        <input class="form-control m-r-10" name="timestamp" type="date" value="<?=date('Y-m-d',$news['timestamp']);?>" id="example-date-input" required>   							
                                    </div>
                                </div>
								
								<div class="form-group">
                 					<label class="col-md-12" for="example-text"><?php echo get_phrase ('Image');?></label>
                   				 	<div class="col-sm-12">
										<input type="file" name="userfile" class="form-control">
										<img src="<?=base_url().'uploads/news/'.$news['news_id'].'.jpg'?>" width="30" height="30">
                        			</div>
                    			</div>
                                    
                                                        
                                <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('update');?></button>
                                </div>
                                <?php echo form_close();?>            
                
                </div>                
			</div>
		</div>
    </div>





<?php endforeach; ?>


<script src="<?php echo JAVASCRIPTS_URL; ?>plugins/bower_components/tinymce/tinymce.min.js"></script>
    <script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>