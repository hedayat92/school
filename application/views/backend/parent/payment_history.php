<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('invoices');?></div>
				<div class="panel-body table-responsive">
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><div><?php echo get_phrase('student');?></div></th>
								<th><div><?php echo get_phrase('title');?></div></th>
								<th><div><?php echo get_phrase('description');?></div></th>
								<th><div><?php echo get_phrase('total_amount');?></div></th>
								<th><div><?php echo get_phrase('amount_paid');?></div></th>
								<th><div><?php echo get_phrase('balance');?></div></th>
								<th><div><?php echo get_phrase('status');?></div></th>
								<th><div><?php echo get_phrase('date');?></div></th>
							</tr>
						</thead>
                    <tbody>
                        
                        
                    	<?php 
                    	
                        	$student_name = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                        	foreach ($student_name as $row_student) { 
                        	    
                        	$invoices = $this->db->get_where('invoice', array('student_id' => $row_student['student_id'], 'due' => 0))->result_array();
                    		foreach ($invoices as $row) :
                    	
                    	
                    	?>
                    	
                    	
                    	
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
							<?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?> <?php echo number_format($row['amount'],2,".",",");?>
							</td>
							<td>
							 <?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?> <?php echo number_format($row['amount_paid'],2,".",",");?>							</td> 
							<td>
							 <?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?> <?php echo number_format($row['due'],2,".",",");?>
							</td>
							  <?php if($row['amount_paid'] > 0):?>
                            <td>
                               <span class="label label-success"><?php echo get_phrase('paid');?></span>
                            </td>
                            <?php endif;?>

							<td><?php echo $row['creation_timestamp'];?></td>
							
                        </tr>
                        <?php endforeach;?>
                        <?php }?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>