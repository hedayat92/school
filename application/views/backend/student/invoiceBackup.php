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
								<th><div><?php echo get_phrase('options');?></div></th>
							</tr>
						</thead>
                    <tbody>
                    	<?php foreach($invoices as $key => $row):?>
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
							  <?php if($row['due'] == 0):?>
                            <td>
                               <span class="label label-success"><?php echo get_phrase('paid');?></span>
                            </td>
                            <?php endif;?>
                            <?php if($row['due'] > 0):?>
                             <td>
                                 <span class="label label-danger"><?php echo get_phrase('unpaid');?></span>
                             </td>
                            <?php endif;?>

							<td><?php echo $row['creation_timestamp'];?></td>
							<td>
								<?php if ($row ['due']> 0):?>                    	
                                    <?php echo form_open(base_url() . 'student/invoice/make_payment/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>" />
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-paypal"></i> Paypal payment</button>								  
                                    </form>
									<br>
									
									<form >
									  <script src="https://js.paystack.co/v1/inline.js"></script>
									  <button class="btn btn-success btn-sm"  type="button" onclick="payWithPaystack()"> <i class="fa fa-credit-card"></i>&nbsp;
									  Paystack payment</button>   
									</form>
									
									<?php 
									 $amount = $row['amount'];
									 $amountPaid = $row['amount_paid'];
									 $discount = $row['discount'];
									 $percent = $discount / 100;
									 $money = $percent * $amount;
									 $real_amount = $amount - $money - $amountPaid;
		 							?>
									
									<script>
									  function payWithPaystack(){
										var handler = PaystackPop.setup({
										  key: '<?php echo $this->db->get_where('settings', array('type' => 'paystack'))->row()->description; ?>',
										  email: '<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description; ?>',
										  amount: <?php echo $real_amount; ?>00,
										 
										  metadata: {
											 custom_fields: [
												{
													display_name: "Mobile Number",
													variable_name: "mobile_number",
													value: "<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?>"
												}
											 ]
										  },
										  callback: function(response){
											  alert('success. transaction ref is ' + response.reference);
											  window.location = "<?php echo base_url();?>student/vouguepay_success/<?php echo $row['invoice_id'];?>";	  
										  },
										  onClose: function(){
											  alert('UNFINISHED PAYMENT, PLEASE TRY AGAIN TO COMPLETE YOUR TRANSATION');
										  }
										});
										handler.openIframe();
									  }
								</script>
		
									
									<form method='POST' action='https://voguepay.com/pay/'>
										<input type="hidden" name="v_merchant_id" value="<?php echo $this->db->get_where('settings', 
										array('type' => 'voguepay'))->row()->description; ?>" />
										<input type="hidden" name="memo" value="PAYMENT TO <?php echo $this->db->get_where('settings', 
										array('type' => 'system_name'))->row()->description; ?>" />
										<input type="hidden" name="success_url" value="<?php echo base_url();?>student/vouguepay_success/<?php echo $row['invoice_id'];?>" />
										<input type="hidden" name="merchant_ref" value="<?php echo $this->db->get_where('settings', 
										array('type' => 'voguepay'))->row()->description; ?>" />
										<input type="hidden" name="cur" value="NGN" />
										<input type="hidden" name="item_1" value="<?php echo $row['title'];?>" />
										
										<input type="hidden" name="price_1" value="<?php echo $real_amount; ?>" />
										<input type="hidden" name="description_1" value="Payment For <?php echo $row['description'];?>" /><br />
										<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-paypal"></i> Vogue payment</button>		 		
									<!--<input type="image" src="../cmopol/pay.jpg" alt="PAY WITH CREDIT CARD"/>-->
									</form>

									

								<?php endif; ?>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>

		
		
