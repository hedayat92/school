<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                                <div class="panel-body table-responsive">
                                <?php echo form_open(base_url().'payment/paymentSetting/update', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>




                                <strong>STRIPE PAYMENT SETTINGS</strong>&nbsp;<i class="fa fa-angle-double-right"></i> <a href="https://dashboard.stripe.com/register">Register Here</a>
				<hr>

								<?php
                                $stripe_settings = $this->crud_model->get_settings('stripe_setting');
                                $stripe = json_decode($stripe_settings);
                            	?>	
				 
				 <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('active'); ?></label>
                    <div class="col-sm-12">
                      <select name="stripe_active" class="form-control">
                                                <option value="0"
                                                    <?php if ($stripe[0]->stripe_active == 0) echo 'selected';?>>
                                                        <?php echo get_phrase('no');?></option>
                                                <option value="1"
                                                    <?php if ($stripe[0]->stripe_active == 1) echo 'selected';?>>
                                                        <?php echo get_phrase('yes');?></option>
                                            </select>
                    </div>
                </div>
				
				 <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('test_mode') ?></label>
                    <div class="col-sm-12">
                        <select name="testmode" class="form-control">
                                            <option value="on"
                                                <?php if ($stripe[0]->testmode == 'on') echo 'selected';?>>
                                                    <?php echo get_phrase('on');?></option>
                                            <option value="off"
                                                <?php if ($stripe[0]->testmode == 'off') echo 'selected';?>>
                                                    <?php echo get_phrase('off');?></option>
                                            </select>
                    </div>
                </div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('test_secret_key') ?></label>
                    <div class="col-sm-12">
                         <input type="text" class="form-control"
                                                name="secret_key"
                                                    value="<?php echo $stripe[0]->secret_key;?>" required />
                    </div>
                </div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('test_public_key') ?></label>
                    <div class="col-sm-12">
                     <input type="text" class="form-control"
                                                name="public_key"
                                                    value="<?php echo $stripe[0]->public_key;?>" required />
                    </div>
                </div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"> <?php echo get_phrase('live_secret_key') ?></label>
                    <div class="col-sm-12">
                    <input type="text" class="form-control"
                                                name="secret_live_key"
                                                    value="<?php echo $stripe[0]->secret_live_key;?>" required />
                    </div>
                </div>
				
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('live_public_key') ?></label>
                    <div class="col-sm-12">
                    <input type="text" class="form-control"
                                                name="public_live_key"
                                                    value="<?php echo $stripe[0]->public_live_key;?>" required />
                    </div>
                </div>


             
				 
				  <hr>
				<strong>PAYPAL PAYMENT SETTINGS</strong>&nbsp;<i class="fa fa-angle-double-right"></i> <a href="https://paypal.com/welcome/signup/#/email_password" target="_blank">Register Here</a>
				<hr>
								 <?php
                                $paypal_settings = $this->crud_model->get_settings('paypal_setting');
                                $paypal = json_decode($paypal_settings);
                            ?>	
	
				 
				 <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('active'); ?></label>
                    <div class="col-sm-12">
                       <select name="paypal_active" class="form-control">
                                                <option value="0"
                                                    <?php if ($paypal[0]->paypal_active == 0) echo 'selected';?>>
                                                        <?php echo get_phrase('no');?></option>
                                                <option value="1"
                                                    <?php if ($paypal[0]->paypal_active == 1) echo 'selected';?>>
                                                        <?php echo get_phrase('yes');?></option>
                                            </select>
                    </div>
                </div>
				
				 <div class="form-group">
                   <label class="col-md-12" for="example-text"> <?php echo get_phrase('mode') ?></label>
                    <div class="col-sm-12">
                      <select name="paypal_mode" class="form-control">
                       <option value="sandbox"
                        <?php if ($paypal[0]->paypal_mode == 'sandbox') echo 'selected';?>>
                        <?php echo get_phrase('sandbox');?></option>
                        <option value="production"
                         <?php if ($paypal[0]->paypal_mode == 'production') echo 'selected';?>>
                        <?php echo get_phrase('production');?></option>
                        </select>
                    </div>
                </div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"> <?php echo get_phrase('client_id').' ('.get_phrase('sandbox').')'; ?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="sandbox_client_id" value="<?php echo $paypal[0]->sandbox_client_id;?>" required />
                    </div>
                </div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('client_id').' ('.get_phrase('production').')'; ?></label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control"  name="production_client_id" value="<?php echo $paypal[0]->production_client_id;?>" required />
                    </div>
                </div>



				<hr>
				<strong>RAZORPAY PAYMENT SETTINGS</strong>&nbsp;<i class="fa fa-angle-double-right"></i> <a href="https://dashboard.razorpay.com/signup" target="_blank">Register Here</a>
				<hr>
				<?php
				$razorpay_settings = $this->crud_model->get_settings('razorpay_setting');
				$razorpay = json_decode($razorpay_settings);
				?>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('active'); ?></label>
					<div class="col-sm-12">
						<select name="razorpay_active" class="form-control">
							<option value="0"
								<?php if ($razorpay[0]->razorpay_active == 0) echo 'selected';?>>
									<?php echo get_phrase('no');?></option>
							<option value="1"
								<?php if ($razorpay[0]->razorpay_active == 1) echo 'selected';?>>
									<?php echo get_phrase('yes');?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('key_id'); ?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="key_id" value="<?php echo $razorpay[0]->key_id;?>" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('key_secret'); ?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="key_secret" value="<?php echo $razorpay[0]->key_secret;?>" required />
					</div>
				</div>

                <div class="form-group">
						<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
					</div>

<?php echo form_close();?>
                            </div>
                        </div>
                    </div>
</div>