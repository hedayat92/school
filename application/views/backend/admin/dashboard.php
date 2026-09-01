<?php
	
	$this->db->where('class_score1', 0);
	$this->db->where('class_score2', 0);
	$this->db->where('class_score3', 0);
	$this->db->delete('mark');
	

?>
		 <!--row -->
            <div class="row">
			
			
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-danger">
                            <div class="r-icon-stats">
                               <i class="fa fa-users bg-danger"></i>
                                <div class="bodystate">
                                    <h4 class="text-white"><strong><?php echo $this->db->count_all_results('student');?></strong></h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/student_information" style="color:white"><?php echo get_phrase('Students');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-info">
                            <div class="r-icon-stats">
                              <i class="fa fa-users bg-info"></i>
                                <div class="bodystate">
                                    <h4 class="text-white"><strong><?php echo $this->db->count_all_results('teacher');?></strong></h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/teacher" style="color:white"><?php echo get_phrase('Teachers');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box bg-success">
                            <div class="r-icon-stats">
                                <i class="fa fa-users bg-success"></i>
                                <div class="bodystate">
                                   <h4 class="text-white"><strong><?php echo $this->db->count_all_results('parent');?></strong></h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/parent" style="color:white"><?php echo get_phrase('parents');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="white-box bg-purple">
                            <div class="r-icon-stats">
                                <i class="fa fa-users bg-purple"></i>
                                <div class="bodystate">
                                    <h4 class="text-white"><strong><?php echo $this->db->count_all_results('accountant');?></strong></h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/accountant" style="color:white"><?php echo get_phrase('Accontants');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                       <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-arrow-circle-up bg-danger"></i>
                                <div class="bodystate">
                                <?php 
                                $this->db->select_sum('amount');
                                $this->db->from('payment');
                                $this->db->where('payment_type', 'expense');
                                $query = $this->db->get();
                                $expense_amount = $query->row()->amount;
                                ?>
                                   <h4 class="text-uppercase">
								   <?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?> <?php echo $expense_amount;?>
								    
									</h4>
                                    <span class="text-muted"><a href="<?= base_url()?>expense/expense"><?php echo get_phrase('Expense');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-arrow-circle-down bg-info"></i>
                                <div class="bodystate">

                                <?php 
                                $this->db->select_sum('amount');
                                $this->db->from('payment');
                                $this->db->where('payment_type', 'income');
                                $query = $this->db->get();
                                $income_amount = $query->row()->amount; ?>
                                   <h4 class="text-uppercase">
                                    <?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?> <?php echo $income_amount;?>
                                     
									 </h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/student_invoice" ><?php echo get_phrase('Income');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-users bg-purple"></i>
                                <div class="bodystate">
                                   <h4>
								   <?php echo $this->db->count_all_results('admin');?>
								    
									</h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/newAdministrator" ><?php echo get_phrase('Admin');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class=" ti-check-box  bg-success"></i>
                                <div class="bodystate">
                                   <h4>
                                    <?php 

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance);
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>
                                    
                                    </h4>
                                    <span class="text-muted"><a href="<?= base_url()?>admin/manage_attendance" ><?php echo get_phrase('Attendance');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
                <!--/row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="stats-row">

                               <canvas id="log-stats" style="height: 130px;"></canvas>

                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="stats-row">
								
								
								<canvas id="AreaChart"></canvas>
			
			
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Recently Added Teachers');?></h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <tr>
                            <?php $get_teacher_from_model = $this->crud_model->list_all_teacher_and_order_with_teacher_id();
                                    foreach ($get_teacher_from_model as $key => $teacher):?>
                                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $teacher['teacher_id']);?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $teacher['name'];?></td>
                                            <td><?php echo $teacher['email'];?></td>
                                            <td><?php echo $teacher['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Recently Added Students');?></h3>
                            <div class="table-responsive">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                            <?php $get_student_from_model = $this->crud_model->list_all_student_and_order_with_student_id();
                                    foreach ($get_student_from_model as $key => $student):?>
                                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $student['name'];?></td>
                                            <td><?php echo $student['email'];?></td>
                                            <td><?php echo $student['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				
				<script src="<?php echo base_url();?>js/line.js"></script>
				<script>
								var barChartData = {
								labels: [
									<?php
									$i = 1;
									while ($i <= 12) {
										$date = date('M', mktime(0, 0, 0, $i, 1));
										echo "'$date'";
										if ($i != 12) {
											echo ',';
										}
										$i++;
									}
									?>
												],
								datasets: [
								
								{
									label: 'Income',
									backgroundColor: '#28a745',
									stack: '1',
									data: [
									
									<?php
									$i = 1;
									while ($i <= 12) {
									$timestamp = date('M', mktime(0, 0, 0, $i, 1));
									$this->db->select_sum('amount');
									$this->db->where('month', $timestamp);
									$this->db->where('year', $running_year);
									$this->db->where('payment_type', 'income');
									$this->db->from('payment');
									$query = $this->db->get();
									$totalincome  = $query->row()->amount;
													
									echo "'$totalincome'";
									
									if ($i != 12) {
											echo ',';
										}
									
									$i++;
									}
									
									?>
									]
								}, 
								
								{
									label: 'Expense',
									backgroundColor: '#f12711',
									stack: '2',
									data: [
										<?php
									$i = 1;
									while ($i <= 12) {
									$timestamp = date('M', mktime(0, 0, 0, $i, 1));
									$this->db->select_sum('amount');
									$this->db->where('month', $timestamp);
									$this->db->where('year', $running_year);
									$this->db->where('payment_type', 'expense');
									$this->db->from('payment');
									$query = $this->db->get();
									$totalDue  = $query->row()->amount;
													
									echo "'$totalDue'";
									
									if ($i != 12) {
											echo ',';
										}
									
									$i++;
									}
									
									?>
									]
								}, 
								
								
								{
									label: 'Invoice',
									backgroundColor: '#ffc107',
									stack: '4',
									data: [
										<?php
									$i = 1;
									while ($i <= 12) {
									$creation_timestamp = date('M', mktime(0, 0, 0, $i, 1));
									$this->db->select_sum('due');
									$this->db->where('month', $creation_timestamp);
									$this->db->where('year', $running_year);
									$this->db->where('due !=', 0);
									$this->db->from('invoice');
									$query = $this->db->get();
									$totalDue  = $query->row()->due;
													
									echo "'$totalDue'";
									
									if ($i != 12) {
											echo ',';
										}
									
									$i++;
									}
									
									?>
									]
								},
								
								
								]
					
							};
							
							
							
						window.onload = function() {
							var ctx = document.getElementById('log-stats').getContext('2d');
							var ctx4 = document.getElementById('AreaChart').getContext('2d');
							var myBar = new Chart(ctx, {
								type: 'bar',
								data: barChartData,
								options: {
									tooltips: {
										mode: 'index',
										intersect: false
									},
									responsive: true,
									scales: {
										xAxes: [{
											stacked: true,
										}],
										yAxes: [{
											stacked: true
										}]
									}
								}
							});
							
							
							
					   
					   var myAreaChart = new Chart(ctx4, {
							type: 'line',
							data: {
								labels: [<?php
									$i = 1;
									while ($i <= 12) {
										$date = date('M', mktime(0, 0, 0, $i, 1));
										echo "'$date'";
										if ($i != 12) {
											echo ',';
										}
										$i++;
									}
									?>],
								datasets: [
								{
									label: 'Present',
									data: [
									<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '1'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: '#28a745',
								},
								{
									label: 'Absent',
									data: [<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '2'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: '#f12711',
								},
								{
									label: 'Late',
									data: [<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '3'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: '#ffc107',
								},
								{
									label: 'Hald Day',
									data: [<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '4'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: '#007bff',
								},
								
								{
									label: 'Holiday',
									data: [<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '5'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: 'purple',
								},
								{
									label: 'Undefine',
									data: [<?php
											$i = 1;
											while ($i <= 12) {
											$timestamp = date('M', mktime(0, 0, 0, $i, 1));
											$query = $this->db->get_where('attendance', 
											array('month' => $timestamp, 'session' => $running_year, 'status' => '0'));
											$totalAttendance  = $query->num_rows();
															
											echo "'$totalAttendance'";
											
											if ($i != 12) {
													echo ',';
												}
											
											$i++;
											}
											
											?>],
									backgroundColor: 'gray',
								}
								
								]
							}
						});
						
							
							
							
						};
						
						
				</script>		
				