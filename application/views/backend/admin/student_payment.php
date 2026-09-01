<div class="row">
    <div class="col-sm-6">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Create Single Invoice');?></div>
                    <div class="panel-body table-responsive">
			
    <!----CREATION FORM STARTS---->

    <?php echo form_open(base_url() . 'admin/student_payment/single_invoice' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                
            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Invoice Number');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="invoice_number" value="<?php echo rand(10000, 1000000). 'INV'. date('Y');?>" / required>
                </div>
            </div>


            <!--
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Title');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title" / required>
                </div>
            </div>
			-->



            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="class_id" id="class_id" class="form-control select2" onchange="return get_class_student(this.value)" / required>
                    <option value=""><?php echo get_phrase('select_class');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                </div>
            </div>
			
			
			<div id="single_title_amount_student_holder"></div>

								
			<!--
			<div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="student_id" class="form-control" id="student_selector_holder" / required>
                    <option value=""><?php echo get_phrase('select_student');?></option>
                    </select>
                </div>
            </div>
			-->


			<div class="form-group">
                <label class="col-md-12" for="example-text"><?php echo get_phrase('select_date');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                 	<input type="date" name="creation_timestamp" value="<?php echo date('Y-m-d');?>" class="form-control datepicker" id="example-date-input" required>
                </div>
            </div>

            <!--
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Amount');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="amount" / required>
                </div>
            </div>
			-->

            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Discount');?> %</label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" name="discount" min="0" value="0">
                </div>
            </div>

 			<!--
            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Amount Paid');?></label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" name="amount_paid" min="0" value="0">
                </div>
            </div>
			-->
								
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Status');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="status" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('payment_status');?></option>
                    <option value="1">Paid</option>
                    <option value="2">Unpaid</option>
                   </select>

                </div>
            </div>

            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Method');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="payment_method" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('payment_method');?></option>
                    <option value="1">Card</option>
                    <option value="2">Cash</option>
                    <option value="3">Cheque</option>
                   </select>

                </div>
            </div>


            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Description');?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('create');?></button>
			</div>
							
    </form>                
		</div>
	</div>
</div>
			<!----CREATION FORM ENDS-->

<div class="col-sm-6">
	<div class="panel panel-info">
        <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Create Mass Invoice');?></div>
            <div class="panel-body table-responsive">
				
        <?php echo form_open(base_url() . 'admin/student_payment/mass_invoice' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Invoice Number');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="invoice_number" value="<?php echo rand(10000, 1000000). 'INV'. date('Y');?>" / required>
                </div>
            </div>


           <!--
		    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Title');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title" / required>
                </div>
            </div>
			-->



            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="class_id" id="class_id" class="form-control select2" onchange="return get_class_mass_student(this.value)" / required>
                    <option value=""><?php echo get_phrase('select_class');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                </div>
            </div>
			
			<div id="mass_title_amount_student_holder"></div>

								
			<!--
			<div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                   <div id="mass_student_selector_holder"></div>
                </div>
            </div>
			-->


			<div class="form-group">
                <label class="col-md-12" for="example-text"><?php echo get_phrase('select_date');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                 	<input type="date" name="creation_timestamp" value="<?php echo date('Y-m-d');?>" class="form-control datepicker" id="example-date-input" required>
                </div>
            </div>

            <!--
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Amount');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="amount" / required>
                </div>
            </div>
			-->

            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Discount');?> </label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" name="discount" value="0" min="0">
                </div>
            </div>


 			<!--
            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Amount Paid');?></label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" name="amount_paid" min="0" value="0">
                </div>
            </div>
			-->

								
			<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Status');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="status" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('payment_status');?></option>
                    <option value="1">Paid</option>
                    <option value="2">Unpaid</option>
                   </select>

                </div>
            </div>

            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Payment Method');?> <b style="color:red">*</b></label>
                <div class="col-sm-12">
                    <select name="payment_method" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('payment_method');?></option>
                    <option value="1">Card</option>
                    <option value="2">Cash</option>
                    <option value="3">Cheque</option>
                   </select>

                </div>
            </div>


            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Description');?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('create');?></button>
			</div>
							
    </form>                                  
			</div>
		</div>
	</div>
</div>
			
            <!----TABLE LISTING ENDS--->

<script type="text/javascript">
function select(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = true;
    }
}

function unselect(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = false;
    }
}


/*
function get_class_student(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_student/' + class_id,
        success:    function(response){
            jQuery('#student_selector_holder').html(response);
        } 

    });
}
*/


function get_class_student(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_single_title_amount_student_holder/' + class_id,
        success:    function(response){
            jQuery('#single_title_amount_student_holder').html(response);
        } 

    });
}


function get_single_class_title_amount(id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_single_class_title_amount/' + id,
        success:    function(response){
            jQuery('#single_class_title_amount').html(response);
        } 

    });
}



function get_class_mass_student(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_mass_title_amount_student_holder/' + class_id,
        success:    function(response){
            jQuery('#mass_title_amount_student_holder').html(response);
        } 

    });
}


function get_mass_class_title_amount(id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_mass_class_title_amount/' + id,
        success:    function(response){
            jQuery('#mass_class_title_amount').html(response);
        } 

    });
}


</script>




<!--
<script type="text/javascript">
function get_class_mass_student(class_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_class_mass_student/' + class_id,
        success:    function(response){
            jQuery('#mass_student_selector_holder').html(response);
        } 

    });
}
</script>
-->