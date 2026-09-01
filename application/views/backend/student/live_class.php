		 <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                          
                                <div class="panel-body table-responsive">
								  <?php echo get_phrase('list_live_class');?>
								  <hr class="sep-2">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?=get_phrase('title')?></th>
							<th><?=get_phrase('meeting_id')?></th>
							<th><?=get_phrase('class')?></th>
							<th><?=get_phrase('section')?></th>
							<th><?=get_phrase('date')?></th>
							<th><?=get_phrase('start_time')?></th>
							<th><?=get_phrase('end_time')?></th>
							<th><?=get_phrase('created_by')?></th>
							<th><?=get_phrase('status')?></th>
							
							<th><?=get_phrase('action')?></th>
                        </tr>
                    </thead>
                    <tbody>
                       
					 <?php $select = $this->live_class_model->selectLiveClassByStudentClassId();
					 		foreach ($select as $key => $row) : ?>
                        <tr>
							<td><?=$row['title'];?></td>
							<td><?=$row['meeting_id'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', $row['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $row['section_id']);?></td>
							<td><?=date('d M, Y', $row['date'])?></td>
							<td><?=date("h:i A", strtotime($row['start_time'])); ?></td>
                            <td><?=date("h:i A", strtotime($row['end_time'])); ?></td>
							<td>
							
							<?php 
							
							$user = explode('-', $row['created_by']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							</td>
							
							<td>
							<?php  
									$status = '<i class="fa fa-clock-o"></i> ' . get_phrase('waiting');
									$labelmode = 'label-info';
									if (strtotime($row['date']) == strtotime(date("Y-m-d")) && strtotime($row['start_time']) <= time() && time() >= strtotime(date("h:i"))) {
										$status = '<i class="fa fa-camera"></i> ' . get_phrase('live');
										$labelmode = 'label-success';
									}
									if (strtotime($row['date']) < strtotime(date("Y-m-d")) || strtotime($row['end_time']) <= time()) {
										$status = '<i class="fa fa-times"></i> ' . get_phrase('expired');
										$labelmode = 'label-danger';
									}
									echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
								?>
							</td>
		
                            <td>
							
							
						
							<a href="<?php echo base_url();?>student/host_live_class/<?php echo $row['live_class_id'];?>"><button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-youtube-play"></i> <?=get_phrase('join live class')?></button></a>
							
							
							
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


	<script>
    $('form').submit(function (e) {
        $('#install_progress').show();
        $('#modal_1').show();
        $('.btn').val('saving, please wait...');
        $('form').submit();
        e.preventDefault();
    });
	
</script>


<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>

