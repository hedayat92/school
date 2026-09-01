<?php $select_leave = $this->db->get_where('leave', array('leave_code' => $param2))->result_array();

foreach ($select_leave as $key => $leave):
?>


<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                           
						
						 <div class="form-group"
                    <div class="col-sm-12">
                        <textarea class="form-control" id="mymce"><?php echo $leave['reason_for_declined'];?></textarea>
                    </div>
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
	