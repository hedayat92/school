<style>
    .exam_chart {
    width           : 100%;
        height      : 265px;
        font-size   : 11px;
}
.amcharts-chart-div a{
    display:none !important;
}
  
</style>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                           
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
								<a href="<?php echo base_url();?>admin/student_information" 
                     class="btn btn-info btn-rounded btn-sm pull-right" style="color:white"><i class="fa fa-mail-reply-all"></i>&nbsp;<?php echo get_phrase('back');?>
                    </a>
					
					<a href="<?php echo base_url();?>admin/new_student" 
                     class="btn btn-success btn-rounded btn-sm pull-right" style="color:white"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_student');?>
                    </a>
								<hr>

<?php
$student_name = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
foreach ($student_name as $row):
    ?>
	
<div class="print" style="border:1px solid #fff; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px;"> 
<div class="printableArea"> 



<div class="x_panel" align="center" style="background: linear-gradient(to top, #bc4e9c, #f80759)!important;"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="100" height="100" border="10px solid rgba(256,256,256,0.3); display: inline-block;"/>
<h2><strong style="color:#FFFFFF"><?php echo $row ['name'];?></strong></h2>

</div>


<h2><strong  style="color:#5cb85c">Personal Information</strong></h2>

							<table class="table">
                              <tbody>
                                <tr>
                                  <th>Register No</th>
                                  <td>:<?php echo $row ['roll'];?></td>
                                  <th>Mother Tougue</th>
                                  <td>:<?php echo $row ['m_tongue'];?></td>
                                </tr>
                                <tr>
                                  <th>Section</th>
                                  <td><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></td>
                                  <th>City</th>
                                  <td>:<?php echo $row ['city'];?></td>
                                </tr>
                                <tr>
                                  <th>Gender</th>
                                  <td>:<?php echo $row ['sex'];?></td>
                                  <th>State</th>
                                  <td>:<?php echo $row ['state'];?></td>
                                </tr>
								<tr>
                                  <th>Mobile No</th>
                                  <td>:<?php echo $row ['phone'];?></td>
                                  <th>Email</th>
                                  <td>:<?php echo $row ['email'];?></td>
                                </tr>
								
								<tr>
                                  <th>Class</th>
                                  <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
                                  <th>Nationality</th>
                                  <td>:<?php echo $row ['nationality'];?></td>
                                </tr>
                                <tr>
                                  <th>Birthday</th>
                                  <td>:<?php echo $row ['birthday'];?></td>
                                  <th>Place Birth</th>
                                  <td><?php echo $row ['place_birth'];?></td>
                                </tr>
                                <tr>
                                  <th>Age</th>
                                  <td>:<?php echo $row ['age'];?></td>
                                  <th>Address</th>
                                  <td>:<?php echo $row ['address'];?></td>
                                </tr>
								<tr>
                                  <th>Blood Group</th>
                                  <td>:<?php echo $row ['blood_group'];?></td>
                                  <th>Physical Handicap</th>
                                  <td>:<?php echo $row ['physical_h'];?></td>
                                </tr>
								
                              </tbody>
                            </table>




							
<h2><strong  style="color:#5cb85c">Previous School Attended Information</strong></h2>
<table class="table">
                              <tbody>
                                
                                <tr>
                                  <th>Previous School Name</th>
                                  <td>:<?php echo $row ['ps_attend'];?></td>
                                  <th>Admission Date</th>
                                  <td>:<?php echo $row ['am_date'];?></td>
                                </tr>
								<tr>
                                  <th>The Address</th>
                                  <td>:<?php echo $row ['ps_address'];?></td>
                                  <th>Transfer Certificate</th>
                                  <td>:<?php echo $row ['tran_cert'];?></td>
                                </tr>
								
								<tr>
                                  <th>Purpose Of Leaving</th>
                                  <td>:<?php echo $row ['ps_purpose'];?></td>
                                  <th>Birth Certificate</th>
                                  <td>:<?php echo $row ['dob_cert'];?></td>
                                </tr>
                                <tr>
                                  <th>Class In Which Was Studying</th>
                                  <td>:<?php echo $row ['class_study'];?></td>
                                  <th>Any Given Marksheet</th>
                                  <td>:<?php echo $row ['mark_join'];?></td>
                                </tr>
                                <tr>
                                  <th>Date Of Leaving</th>
                                  <td>:<?php echo $row ['date_of_leaving'];?></td>
                                  <th>Physical Challenge</th>
                                  <td>:<?php echo $row ['physical_h'];?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
							
<h2><strong  style="color:#5cb85c">Parent Information</strong></h2>
<table class="table">
                              <tbody>
                                
                                <tr>
                                  <th>Parent Name:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Email:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;?></td>
                                </tr>
								
								<tr>
                                  <th>Mobile No.:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;?></td>
                                </tr>
                                <tr>
                                  <th>Address:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->address;?></td>
                                </tr>
                                <tr>
                                  <th>Profession:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->profession;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
	<h2><strong  style="color:#5cb85c">Hostel Information</strong></h2>
	<table class="table">

	 <tbody>
                                
                                <tr>
                                  <th>Hostel Name:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Capacity:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->capacity;?></td>
                                </tr>
								
								<tr>
                                  <th>Address:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->address;?></td>
                                </tr>
                                
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->description;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
<h2><strong  style="color:#5cb85c">Tranportation Information</strong></h2>
<table class="table">

	 <tbody>
                                
                                <tr>
                                  <th>Transportation Name</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Number of Vehicle</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->number_of_vehicle;?></td>
                                </tr>
								
								
                                <tr>
                                  <th>Route Fare</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->route_fare;?></td>
                                </tr>
                                <tr>
                                  <th>Description</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->description;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
<h2><strong  style="color:#5cb85c">Student Timetable</strong></h2>
							 <table cellpadding="0" cellspacing="0" border="0"  class="table">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                if($d==1)$day='sunday';
                                                else if($d==2)$day='monday';
                                                else if($d==3)$day='tuesday';
                                                else if($d==4)$day='wednesday';
                                                else if($d==5)$day='thursday';
                                                else if($d==6)$day='friday';
                                                else if($d==7)$day='saturday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $class_id);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
															<button class="btn btn-info btn-rounded btn-sm" >
                                                         <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
																<?php
                                                                    if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                                                        echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                                                    if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                                                        echo '('.$row2['time_start'].':'.$row2['time_start_min'].'-'.$row2['time_end'].':'.$row2['time_end_min'].')';
                                                                ?>
                                                            </button>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>

<?php endforeach; ?>


  <button id="print" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button"> <span><i class="fa fa-print"></i>&nbsp;Print</span> </button>                         
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<!--
<script type="text/javascript" src="<?php echo base_url();?>js/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jspdf.min.js"></script>
<script type="text/javascript">
    var pages = $('.print');
    var doc = new jsPDF();
    var j = 0;
    for (var i = 0 ; i < pages.length; i++) {
        html2canvas(pages[i]).then(function(canvas) {
        var img=canvas.toDataURL("image/png");
        // debugger;
        var height =  canvas.height / 440 * 80;
        doc.addImage(img,'JPEG',10,0,190,height);
        if (j < (pages.length - 1) ) doc.addPage();
        if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
        j++;
        });
    }
    
</script>
-->