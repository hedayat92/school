					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                          
                                <div class="panel-body table-responsive">
								  <?php echo get_phrase('list_live_class');?>
								  <hr class="sep-2">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
							<th><?=get_phrase('created_by')?></th>
                            <th><?=get_phrase('title')?></th>
							<th><?=get_phrase('class')?></th>
							<th><?=get_phrase('section')?></th>
							<th><?=get_phrase('meeting_date')?></th>
							<th><?=get_phrase('meeting_time')?></th>
							<th><?=get_phrase('status')?></th>
							<th><?=get_phrase('description')?></th>
							
							<th><?=get_phrase('action')?></th>
                        </tr>
                    </thead>
                    <tbody>
                       
					 <?php $select = $this->live_class_model->selectJitsiStudentByClassSection();
					 		foreach ($select as $key => $row) : ?>
                        <tr>
							<td>
							<?php 
							
							$user = explode('-', $row['user_id']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							
							</td>

							<td><?=$row['title'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', $row['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $row['section_id']);?></td>
							<td><?=date('d M, Y', $row['meeting_date'])?></td>
                            <td><?=$row['start_time'] .' - '.$row['end_time']?></td>
							<td><span class="label label-<?php if($row['status'] == 'pending') echo 'warning';elseif($row['status'] == 'live') echo 'success'; else echo 'danger';?>"><?=$row['status']?></span></td>
							<td><?=$row['description']?></td>
							<td>
							
							
							<?php if($row['status'] == 'live') :?>
							<a href="<?php echo base_url();?>teacher/stream_jitsi/<?php echo $row['jitsi_id'];?>"><button type="button" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-youtube-play"></i> Join Class</button></a>
							<?php endif;?>
							
							
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
