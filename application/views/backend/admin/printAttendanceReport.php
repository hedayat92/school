<div class="row" align="center">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
<div class="printableArea">
        <div align="center">
        <img src="<?php echo base_url();?>uploads/logo.png" width="60px" height="60px" class="img-circle"><br/>
        <span style="text-align:center; font-size:25px"><?php echo $system_name;?></span><br/>
        <span style="text-align:center; font-size:15px"><?php echo $system_address;?></span>
        </div>
        <br>
                                
   <table cellpadding="0" cellspacing="0" border="0" class="table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align: left;background-color: #f5f5f5;">Student<br>Name</th>
                    <?php
						$weekends = $this->crud_model->getWeekendDaysSession();
                    	$days = date("t",mktime(0,0,0,$month,1,$year)); 
                        for ($i=1; $i <= $days; $i++) { 
						$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
                     ?>
					<th style="text-align: center; background-color:<?php if(in_array($date, $weekends)) echo '#f99';else echo '#f5f5f5' ?>"><?php echo date('D', strtotime($date)); ?><br><?php echo date('d', strtotime($date)); ?></th>   
                    <?php } ?>
					<th class="text-center" style="padding-right: 15px !important;background-color: #f5f5f5;">(%)</th>
					<th class="text-center" style="padding-right: 15px !important;background-color: #f5f5f5;">W</th>
					<th class="text-center text-success" style="padding-right: 15px !important;background-color: #f5f5f5;">P</th>
					<th class="text-center text-danger" style="padding-right: 15px !important;background-color: #f5f5f5;">A</th>
					<th class="text-center text-tertiary" style="padding-right: 15px !important;background-color: #f5f5f5;">L</th>
					<th class="text-center text-tertiary" style="background-color: #f5f5f5;">HD</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                //STUDENTS ATTENDANCE
                $students   =   $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
                foreach($students as $key => $student)
                {
				$total_present = 0;
				$total_absent = 0;
				$total_late = 0;
				$total_half_day = 0;
				$total_weekends = 0;
				$studentID = $student['student_id'];
              ?>
                <tr class="gradeA">
                    <td align="left"><!--<img src="<?php //echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30px" height="30px">--><?php echo $student['name'];?></td>
                    <?php 
					$weekends = $this->crud_model->getWeekendDaysSession();
                    for ($i=1; $i <= $days; $i++) {
                    $full_date = $year."-".$month."/".$i;
                    $verify_data  =  array('student_id' => $student['student_id'], 'date' => $full_date);
                    $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                    $status     = $attendance->status;
					$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
                    ?>
                            <td style="text-align: center;">
							
                                <?php if ($status == "0"):?>
                                <h5 style="color:black;">U</h5>
                                <?php endif;?>
                                <?php if ($status == "1"):?>
                                    <h5 style="color: #00a651;">P</h5>
									<?php $total_present++;?>
                                <?php endif;?>
								
								<?php if ($status == "2"):?>
                                    <h5 style="color: #EE4749;">A</h5>
									<?php $total_absent++;?>
                                <?php endif;?>
								
								<?php if ($status == "3"):?>
                                    <h5 style="color:#FF6600;">L</h5>
									<?php $total_late++;?>
                                <?php endif;?>
								
								<?php if ($status == "4"):?>
                                    <h5 style="color: #0000FF;">HD</h5>
									<?php $total_half_day++;?>
                                <?php endif;?>
								<?php if (in_array($date, $weekends)) { ?>
								 <span class="text-danger">W</span>
								 <?php $total_weekends++;?>
								<?php } ?>
                            </td>    
                           <?php }?>
									<td class="center"><?php 
										$total_working_days = ($total_present + $total_absent + $total_late + $total_half_day);
										if ($total_working_days == 0) {
											echo "-";
										} else {
											$total_present = ($total_present + $total_late + $total_half_day);
											$percentage = ($total_present / $total_working_days) * 100;
											echo round($percentage);
										}
									?></td>
									<td class="center"><?=$total_weekends?></td>
									<td class="center"><?=$total_present?></td>
									<td class="center"><?=$total_absent?></td>
									<td class="center"><?=$total_late?></td>
									<td class="center"><?=$total_half_day?></td> 
                </tr>
                <?php }?>
            </tbody>
        </table>
        <hr>
        <div align="center">
					<table class="table dataTable table-condensed table-bordered text-dark text-center">
						<tbody>
							<tr>
								<td><strong>Weekends :</strong> W</td>
								<td><strong>Present :</strong> P</td>
								<td><strong>Absent :</strong> A</td>
								<td><strong>Late :</strong> L</td>
								<td><strong>Half Day :</strong> HD</td>
							</tr>
						</tbody>
					</table>
        </div>
    </div>

    <br>
    <button id ="print" class="btn btn-info btn-sm btn-rounded btn-block"><i class="fa fa-print"></i> Print</button>

	</div>
	</div>
	</div>
	</div>
	</div>