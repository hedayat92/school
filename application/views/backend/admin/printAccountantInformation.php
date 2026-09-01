<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <?php echo get_phrase("accountant's_profile");?>
							
					<a href="<?php echo base_url();?>admin/accountant" 
                     class="btn btn-orange btn-xs"><i class="fa fa-mail-reply-all"></i>&nbsp;<?php echo get_phrase('back');?>
                    </a>
					
					<a href="<?php echo base_url();?>admin/accountant" 
                     class="btn btn-orange btn-xs"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_accountant');?>
                    </a>
					
	<button type="button" name="b_print" class="btn btn-xs btn-default pull-right" onClick="printdiv('div_print');"><i class="fa fa-print"></i><?php echo get_phrase('print');?></button>	
							</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive" id="div_print">
                
				
				
<?php foreach($accountants as $row):?>			
				
<table class="table" width="1030" border="1">
 
 		<div class="alert alert-default" align="center"><img src="<?php echo base_url() ?>uploads/logo.png"  class="img-circle" width="80" height="80"/>
					<h3><?php echo $system_name;?></h3>
					<?php $address = get_settings('address');?>
					<?php echo $address; ?>
					<h5><?php $phone = get_settings('phone');?></h5>
					<?php echo $phone; ?>&nbsp;&nbsp;Email:&nbsp;&nbsp;<?php $system_email = get_settings('system_email');?>
					<?php echo $system_email; ?>

			</div>
					<hr>
 
  <tr>
    <td width="180" rowspan="4"><img src="<?php echo $this->crud_model->get_image_url('accountant',$row['accountant_id']);?>" alt="user" class="img-thumbnail img-responsive" width="260" height="260"></td>
    <td width="135"><div align="right"><strong>NAME</strong></div></td>
    <td width="671" class="text-uppercase">&nbsp;&nbsp;<?php echo $row ['name']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>accountant NUMBER</strong></div></td>
    <td>&nbsp;&nbsp;<?php echo $row ['accountant_number']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>EMAIL</strong></div></td>
    <td>&nbsp;&nbsp;<?php echo $row ['email']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>GENDER</strong></div></td>
    <td>&nbsp;&nbsp;<?php echo $row ['sex']; ?></td>
  </tr>
  
  <tr>
    <td colspan="3"><div class="alert alert-info">FULL PERSONAL DETAILS</div> </td>
  </tr>
  <tr>
    <td><div align="right"><strong>DATE OF BIRTH</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['birthday']; ?></td>
  </tr>
  
  <tr>
    <td><div align="right"><strong>DEPARTMENT</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $this->crud_model->get_type_name_by_id('department', $row ['department_id']); ?></td>
  </tr>
  
  
  <tr>
    <td><div align="right"><strong>DESIGNATION</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $this->crud_model->get_type_name_by_id('designation', $row ['designation_id']); ?></td>
  </tr>
  
  
  <tr>
    <td><div align="right"><strong>BASIC SALARY</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo get_settings('currency').' '.$row ['joining_salary']; ?></td>
  </tr>
  
   <tr>
    <td><div align="right"><strong>DATE JOIN</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['date_of_joining']; ?></td>
  </tr>
  
   <tr>
    <td><div align="right"><strong>DATE OF LEAVING</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['date_of_leaving']; ?></td>
  </tr>
  
  <tr>
    <td><div align="right"><strong>RELIGION</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['religion']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>PHONE NUMBER</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['phone']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>QUALIFICATION</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['qualification']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>BLOOD GROUP</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['blood_group']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>MARITAL STATUS</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['marital_status']; ?></td>
  </tr>
  <tr>
  <tr>
    <td><div align="right"><strong>AACOUNTANT ADDRESS</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['address']; ?></td>
  </tr> 
  
   <tr>
    <td colspan="3"><div class="alert alert-info">BANK DETAILS</div> </td>
  </tr>
  
  <tr>
    <td><div align="right"><strong>ACCOUNT HOLDER NAMAE</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['account_holder_name']; ?></td>
  </tr>
  
  <tr>
    <td><div align="right"><strong>ACCOUNT NUMBER</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['account_number']; ?></td>
  </tr>
  
  <tr>
    <td><div align="right"><strong>BANK NAME</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['bank_name']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>BANK BRANCH</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['branch']; ?></td>
  </tr>
  
  <tr>
    <td colspan="3"><div class="alert alert-info">SOCIAL INFORMATION</div> </td>
  </tr>
  <tr>
    <td><div align="right"><strong>FACEBOOK</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['facebook']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>TWITTER</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['twitter']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>GOOGLE PLUS</strong> </div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['googleplus']; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>LINKEDIN</strong></div></td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $row ['linkedin']; ?></td>
  </tr>
  <tr>
    <td colspan="3"><div class="alert alert-info">DOWNLOAD FULL DOCUMENTS ABOUT ACCOUNTANT </div>&nbsp;&nbsp;Download Full Document:&nbsp;<a href="<?php echo base_url().'uploads/accountant_image/'.$row['file_name']; ?>"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-download"></i></button></a>
	<hr>
	</td>
  </tr>
</table>
<?php endforeach; ?>

                        </div>
						</div>
						</div>
						</div>
						</div>
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
                    
<script type="text/javascript" src="js/html2canvas.min.js"></script>
<script type="text/javascript" src="js/jspdf.min.js"></script>
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