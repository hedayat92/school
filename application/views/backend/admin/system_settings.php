<div class="row">

	<div class="col-sm-7">
		<div class="panel panel-info">

			<div class="panel-heading"><i class="fa fa-gear"></i>  <?php echo get_phrase('System Settings');?></div>
			<div class="panel-body table-responsive">

				<?php echo form_open(base_url(). 'systemsetting/system_settings/do_update', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Name');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_name" value="<?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Short Name');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="short_name" value="<?php echo $this->db->get_where('settings', array('type' => 'short_name'))->row()->description;?>">
					</div>
				</div>
				


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Title');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_title" value="<?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Address');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="address" value="<?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Phone');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="phone" value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Paypal Email');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="paypal_email" value="<?php echo $this->db->get_where('settings', array('type' => 'paypal_email'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Currency');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="currency" value="<?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Email');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_email" value="<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?>">
					</div>
				</div>

		
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Text Alignment');?></label>
					<div class="col-sm-12">
						
						<select name="text_align" class="form-control">
							<?php $align =  $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;?>
								<option value="left-to-right" <?php if ($align == 'left-to-right') echo 'selected';?>> Left to right</option>
								<option value="right-to-left" <?php if ($align == 'right-to-left') echo 'selected';?>> Right to left</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('language'); ?></label>
                    <div class="col-sm-12">
                        <select name="language" class="form-control select2">
                            <?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $key => $field) {
                                if ($field == 'phrase_id' || $field == 'phrase')
                                    continue;

                                $current_default_language = $this->db->get_where('settings', array('type' => 'language'))->row()->description;
                                ?>
                                <option value="<?php echo $field; ?>"
                                        <?php if ($current_default_language == $field) echo 'selected'; ?>> <?php echo $field; ?> </option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
				


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Running Session');?></label>
					<div class="col-sm-12">
						

					<select name="session" class="form-control select2" >
                          <?php $running_session = $this->db->get_where('settings', array('type' => 'session'))->row()->description; ?>
                          <option value=""><?php echo get_phrase('select_running_session');?></option>
                          <?php for($i = 0; $i < 10; $i++):?>
                              <option value="<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>"
                                <?php if($running_session == (2019+$i).'-'.(2019+$i+1)) echo 'selected';?>>
                                  <?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>
                              </option>
                          <?php endfor;?>
                     </select>


					</div>
				</div>
				
				 <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('timezone'); ?></label>
                    <div class="col-sm-12">
				
				<select name="timezone" class="form-control form-control-rounded" >
				 <?php $timezone = $this->db->get_where('settings', array('type' => 'timezone'))->row()->description; ?>
                   <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                  <?php foreach ($tzlist as $tz): ?>
                    <!-- <option value="<?php // echo $tz ;?>" @if(env('TIMEZONE') == $tz) selected @endif><?php //echo $tz ;?></option>-->
					<option value="<?php echo $tz ;?>"<?php if($tz == $timezone) echo 'selected';?>><?php echo $tz ;?></option>
                  <?php endforeach; ?>
                 </select>
				  </div>
                </div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('System Footer');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="footer" value="<?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Tawkto Chat');?></label>
					<div class="col-sm-12">
						<textarea rows="3" class="form-control" name="tawk_to"><?php echo $this->db->get_where('settings', array('type' => 'tawk_to'))->row()->description;?></textarea>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Voguepay ID');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="voguepay" value="<?php echo $this->db->get_where('settings', array('type' => 'voguepay'))->row()->description;?>">
					</div>
				</div>


				<?php 
					$selectPaymentGatwayFromAddonTable = $this->db->get_where('addons', array('unique_key' => 'paystack'))->row();
					if($selectPaymentGatwayFromAddonTable != "") : 
				?>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('paystack_secret_key');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="paystack" value="<?php echo $this->db->get_where('settings', array('type' => 'paystack'))->row()->description;?>">
					</div>
				</div>
				<?php endif;?>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('paytm_merchant_key');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="paytm_merchant_key" value="<?php echo $this->db->get_where('settings', array('type' => 'paytm_merchant_key'))->row()->description;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('paytm_merchant_id');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="paytm_merchant_id" value="<?php echo $this->db->get_where('settings', array('type' => 'paytm_merchant_id'))->row()->description;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('paytm_merchant_website');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="paytm_merchant_website" value="<?php echo $this->db->get_where('settings', array('type' => 'paytm_merchant_website'))->row()->description;?>">
					</div>
				</div>
				
				

				<?php 
					$selectZoomFromAddonTable = $this->db->get_where('addons',array('unique_key'=> 'zoom', 'addon_key' => 'live_streaming', 'status' => 'installed'))->row();
					if($selectZoomFromAddonTable != "") : 
				?>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Zoom Api Key');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="zoom_api_key" value="<?php echo $this->db->get_where('settings', array('type' => 'zoom_api_key'))->row()->description;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Zoom Api Secret Key');?></label>
					<div class="col-sm-12">
						<input class="form-control" name="zoom_api_secret_key" value="<?php echo $this->db->get_where('settings', array('type' => 'zoom_api_secret_key'))->row()->description;?>">
					</div>
				</div>
				<?php endif;?>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('next_term_begin');?></label>
					<div class="col-sm-12">
						<input type="date" class="form-control" name="next_term_begin" value="<?php echo $this->db->get_where('settings', array('type' => 'next_term_begin'))->row()->description;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('select_current_term');?></label>
					<div class="col-sm-12">
						
						<select name="term" class="form-control">
							<?php $term =  get_settings('term')?>
								<option value="1" <?php if ($term == '1') echo 'selected';?>> First Term</option>
								<option value="2" <?php if ($term == '2') echo 'selected';?>> Second Term</option>
								<option value="3" <?php if ($term == '3') echo 'selected';?>> Third Term</option>
								
						</select>
					</div>
				</div>
				
				<?php if(get_settings('report_template') == 'diamond'):?>
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('select_current_report_to_print');?></label>
					<div class="col-sm-12">
						<?php $mid_ter_rep_card =  get_settings('mid_ter_rep_card')?>
						<select name="mid_ter_rep_card" class="form-control">
								<option value="1" <?php if ($mid_ter_rep_card == '1') echo 'selected';?>> PRINT CA 1 MID-TERM REPORT</option>
								<option value="2" <?php if ($mid_ter_rep_card == '2') echo 'selected';?>> PRINT CA 2 MID-TERM REPORT</option>
								<option value="3" <?php if ($mid_ter_rep_card == '3') echo 'selected';?>> PRINT TERMINAL REPORT CARD</option>
								
						</select>
						<p style="color:red">Before you select PRINT TERMINAL REPORT CARD, ensure you have entered score for CA1 and CA2 with the Exam</p>
					</div>
				</div>
				<?php endif;?>
				
				
				
				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('check_result_status');?></label>
					<div class="col-sm-12">
						
						<select name="check_result" class="form-control">
							<?php $check_result =  $this->db->get_where('settings', array('type' => 'check_result'))->row()->description;?>
								<option value="0" <?php if ($check_result == 0) echo 'selected';?>> DISABLE STUDENTS FROM CHECKING RESULT</option>
								<option value="1" <?php if ($check_result == 1) echo 'selected';?>> ENABLE STUDENTS TO CHECK RESULT</option>
						</select>
					</div>
				</div>
				
				
				  <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('principal_&_stamp_&_signature'); ?></label>
                    <div class="col-sm-12">
						<input type='file' class="form-control" name="userfile" />
						<img id="blah" src="<?php echo base_url(); ?>uploads/signature.png" alt="" height="20" width="150"/>
					</div>
				</div>

				<?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>

				<?php echo form_close();?>

			</div>

		</div>

	</div>


<div class="col-sm-5">
<div class="panel panel-info">
<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('System Logo'); ?></div>
<div class="panel-wrapper collapse in" aria-expanded="true">
<div class="panel-body table-responsive">

<?php echo form_open(base_url() . 'systemsetting/system_settings/upload_logo', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'));
        ?>			
					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('browse_image');?>*</label>        
					 <div class="col-sm-12">
  		  			 <input type='file' class="form-control" name="userfile" onChange="readURL(this);" /required>
       				 <img id="blah" src="<?php echo base_url(); ?>uploads/logo.png" alt=""width="150"/>
					</div>
					</div>	
					
				<?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>
		
				<?php echo form_close(); ?>




				THEME SETTINGS
				<hr>
				
				<?php echo form_open(base_url() . 'systemsetting/system_settings/themeSettings', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'));
        ?>
                
				<div class="radio radio-custom">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'default') echo 'checked';?> name="skin_colour" id="radio2" value="default">
                  <label for="radio2"> Default Theme</label>
				</div>

				<div class="radio radio-success">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'green') echo 'checked';?> name="skin_colour" id="radio3" value="green">
                  <label for="radio3"> Green Theme</label>
				</div>

				<div class="radio radio-gray">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'gray') echo 'checked';?> name="skin_colour" id="radio4" value="gray">
                  <label for="radio4"> Gray Theme</label>
				</div>

				<div class="radio radio-black">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'black') echo 'checked';?> name="skin_colour" id="radio5" value="black">
                  <label for="radio5"> Dark Theme </label>
				</div>

				<div class="radio radio-purple">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'purple') echo 'checked';?> name="skin_colour" id="radio6" value="purple">
                  <label for="radio6"> Purple Theme</label>
				</div>

				<div class="radio radio-info">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'blue') echo 'checked';?> name="skin_colour" id="radio7" value="blue">
                  <label for="radio7"> Blue Theme</label>
				</div>
				
				
		<br>		
				
               <?php if(!(demo())){ ?>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('save');?></button>
				</div>
				<?php } ?>
                    <?php echo form_close();?>
					
					
					
				{ BROWSE AND UPLOAD LOGIN iMAGE }
				<hr>
				
				<?php echo form_open(site_url('systemsetting/system_settings/login_info') , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>
				
				   <div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('login_image'); ?></label>
						<div class="col-sm-12">
						<input type='file' class="form-control form-control-rounded" name="userfile" onChange="readURL2(this);" / required>
       				 	<img id="blah2" src="<?php echo base_url(); ?>assets/images/account-bgc.jpg" alt="" height="200" width="350"/>
                      </div>
                  </div>
				  
				  <?php if(!(demo())){ ?>
				 <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-block btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save'); ?></button>
                </div>
				<?php } ?>
				
				<?php echo form_close();?>
				
				<hr>
				
                <?php echo form_open(site_url('updater/update') , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>

                  <div class="form-group"> 
					 <label class="col-sm-12">BROWSE FOR ZIP FILE TO UPDATE</label>        
					 <div class="col-sm-12">

                            <input type="file" name="file_name"  class="dropify" required>

                        </div>
                    </div>

                <?php if(!(demo())){ ?>
				 <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-block btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save'); ?></button>
                </div>
				<?php } ?>

                <?php echo form_close(); ?>
				
				

</div>
</div>

</div>
</div>

</div>