<?php if($section_id!=null && $month!=null && $year!=null && $class_id!=null):?>
<div class="row" align="center">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <div align="center">
								
            <h3 style="color: #696969;">Attendance Sheet</h3>
            <?php 
                $classes    =   $this->db->get('class')->result_array();
                foreach ($classes as $key => $class) {
                    if(isset($class_id) && $class_id==$class['class_id']) $class_name = $class['name'];
                }
                $sections    =   $this->db->get('section')->result_array();
                foreach ($sections as $key => $section) {
                    if(isset($section_id) && $section_id==$section['section_id']) $section_name = $section['name'];
                }
            ?>
            <?php
                $full_date = "5"."-".$month."-".$year;
                $full_date = date_create($full_date);
                $full_date = date_format($full_date,"F, Y");?>
            <h4 style="color: #696969;">Class <?php echo $class_name; ?> : Section <?php echo $section_name; ?><br><?php echo $full_date; ?></h4>
			<hr>
      
        </div>
			<style type="text/css">
				table.dataTable.table-condensed > thead > tr > th {
				  padding-right: 3px !important;
				}
			</style>  
			
					<table class="table dataTable table-condensed table-bordered text-dark text-center">
						<tbody>
							<tr>
								<td><strong>Weekends :</strong> <strong>W</strong> </td>
								<td><strong>Present :</strong> <i class="fa fa-circle" style="color: #00a651;"></i></td>
								<td><strong>Absent : <i class="fa fa-circle" style="color: #EE4749;"></i></td>
								<td><strong>Late : <i class="fa fa-circle" style="color: #FF6600;"></i></td>
								<td><strong>Half Day : <i class="fa fa-circle" style="color: #0000FF;"></i></td>
							</tr>
						</tbody>
					</table>		
			                          
    <table cellpadding="0" cellspacing="0" border="0" class="table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:left;background-color: #f5f5f5;">Student<br>Name</th>
                    <?php
					
					
						$weekends = $this->crud_model->getWeekendDaysSession();
                    	$days = date("t",mktime(0,0,0,$month,1,$year)); 
                        //for ($i=0; $i < $days; $i++) { 
						for($i = 1; $i <= $days; $i++){
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
                    <td align="left"><?php echo $student['name'];?></td>
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
                                <i class="fa fa-circle" style="color:black;"></i>
                                <?php endif;?>
                                <?php if ($status == "1"):?>
                                    <i class="fa fa-circle" style="color: #00a651;"></i>
									<?php $total_present++;?>
                                <?php endif;?>
								
								<?php if ($status == "2"):?>
                                    <i class="fa fa-circle" style="color: #EE4749;"></i>
									<?php $total_absent++;?>
                                <?php endif;?>
								
								<?php if ($status == "3"):?>
                                    <i class="fa fa-circle" style="color:#FF6600;"></i>
									<?php $total_late++;?>
                                <?php endif;?>
								
								<?php if ($status == "4"):?>
                                    <i class="fa fa-circle" style="color: #0000FF;"></i>
									<?php $total_half_day++;?>
                                <?php endif;?>
								<?php if (in_array($date, $weekends)) { ?>
								 <span class="text-danger">W</span>
								 <?php $total_weekends++;?>
								<?php } ?>
                            </td> 
					<?php } ?> 
					
					
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
              <?php } ?>
            </tbody>
        </table>

        <a href="<?php echo base_url();?>admin/printAttendanceReport/<?php echo $class_id ;?>/<?php echo $section_id ;?>/<?php echo $month ;?>/<?php echo $year ;?>" class="btn btn-success btn-sm mt-4" style="color:white"> <i class="fa fa-print"></i> Print</a>
		
	</div>
	</div>
	</div>
	</div>
	</div>

<?php endif;?>