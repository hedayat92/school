<div class="row">
 	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?=get_phrase('list_video_classroom'); ?></div>
				<div class="panel-body table-responsive">
			
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
						<thead>
                		<tr>
                    		<th><div><?=get_phrase('title');?></div></th>
                    		<th><div><?=get_phrase('class');?></div></th>
							<th><div><?=get_phrase('section');?></div></th>
                    		<th><div><?=get_phrase('subject');?></div></th>
							<th><div><?=get_phrase('date');?></div></th>
							<th><div><?=get_phrase('uploader');?></div></th>
                            <th><div><?=get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>

                    <?php $select = $this->live_class_model->selectVideoClassByStudentClassId();
					 		foreach ($select as $key => $video) : ?>
                        <tr>
                            <td><?=$video['title'];?></td>
							<td><?=$this->crud_model->get_type_name_by_id('class', 	 $video['class_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('section', $video['section_id']);?></td>
							<td><?=$this->crud_model->get_type_name_by_id('subject', $video['subject_id']);?></td>
							<td><?=date('d, M Y', $video['date']);?></td>
							<td>
							
							<?php 
							
							$user = explode('-', $video['user']);
							$user_type = $user[0];
							$user_id = $user[1];
							echo $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row()->name;
							?>
							
							
							</td>
							<td>
								<a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/watch_video/<?=$video['video_class_id'];?>')" 
								class="btn btn-success btn-rounded btn-xs"><i class="fa fa-play"></i> watch</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
            <!----TABLE LISTING ENDS--->