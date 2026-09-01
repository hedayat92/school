<div class="row">
     
					
<div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_awards'); ?></div>
							


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">    <thead>
        <tr>
            <th><div><?php echo get_phrase('award_name'); ?></div></th>
            <th><div><?php echo get_phrase('gift'); ?></div></th>
            <th><div><?php echo get_phrase('amount'); ?></div></th>
            <th><div><?php echo get_phrase('date'); ?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
       
		$user_information_here = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $this->db->order_by('award_id', 'desc');
        $select_award_added_to_me = $this->db->get_where('award', array('user_id' => $user_information_here))->result_array();
        foreach ($select_award_added_to_me as $key => $row):
		
		 ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['gift']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>


</div>
			</div>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
