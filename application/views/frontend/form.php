<?php include "css.php";?>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
    <div class="kingster-mobile-header-wrap">
        <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation " id="kingster-mobile-header">
            <div class="kingster-mobile-header-container kingster-container clearfix">
			
                 <?php include "logo.php";?>
                <div class="kingster-mobile-menu-right">
					
                   <?php include "search.php";?>
                        <?php include "mobile.php";?>
					

                </div>
            </div>
        </div>
    </div>
	
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
		
			
             <?php include "top.php";?>
			 <?php include "header.php";?>



            <div class="kingster-page-title-wrap  kingster-style-medium kingster-left-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title"><?=get_phrase('contact_us')?></h1></div>
                </div>
            </div>
			
			<div class="gdlr-core-pbf-wrapper ">
                        <div class="gdlr-core-pbf-background-wrap" style="background-color: #f5f5f5 ;"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                
                                <div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 50px 20px 0px 20px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 32px ;font-weight: 700 ;">Online Registration Form</h3><br><br>Please ensure you fill correct information below:</div>
                                                </div>
                                            </div>
                                           
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-contact-form-7-item gdlr-core-item-pdlr gdlr-core-item-pdb ">
                                                    <div role="form" class="wpcf7" id="wpcf7-f1979-p1977-o1" lang="en-US" dir="ltr">
                                                        <div class="screen-reader-response"></div>
                                                       <?php echo form_open(base_url() . 'applicationForm/send' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
																
															 <div class="quform-elements">
                                                               
															   <?php if (($this->session->flashdata('flash_message')) != ""): ?>
																<div style="background-color:green; color:white; padding-bottom:10px; padding-top:10px; padding-left:10px"> 
																<?php echo $this->session->flashdata('flash_message'); ?></div>
																<?php endif; ?>
																
																 <?php if (($this->session->flashdata('error_message')) != ""): ?>
																<div style="background-color:red; color:white; padding-bottom:10px; padding-top:10px; padding-left:10px"> 
																<?php echo $this->session->flashdata('error_message'); ?></div>
																<?php endif; ?>
																
																
																<div class="quform-element">
                                                                    <p>Your Name <b style="color:red">*</b>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                            <input id="name" type="text" name="name"  class="form-control" required>
                                                                       		<input type="hidden" class="form-control" name="roll" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" required>
																	    </span> 
                                                                    </p>
                                                                </div>
																
																<div class="quform-element">
                                                                    <p>Your Gender <b style="color:red">*</b>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                            	<select name="sex" class="form-control" required>
																				<option value="">Please select your gender</option>
																						<option value="male">Male</option>
																						<option value="female">Female</option>
																					
																				</select>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																
													<div class="form-group">
														<label class="col-md-12" for="example-text"><?php echo get_phrase('select_class');?> <b style="color:red">*</b></label>
														<div class="col-sm-12">
																<select name="class_id" class="form-control select2" style="width:100%" id="class_id" onChange="return get_class_sections(this.value)" required>
																  <option value=""><?php echo get_phrase('select');?></option>
																  <?php 
																	$classes = $this->db->get('class')->result_array();
																	foreach($classes as $row):
																		?>
																		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
																	<?php endforeach;?>
															  </select>
									
									
															</div> 
														</div>
														
														
													<div class="form-group">
														<label class="col-md-12" for="example-text"><?php echo get_phrase('select_class');?> <b style="color:red">*</b></label>
														<div class="col-sm-12">				
															<select name="section_id" class="form-control" style="width:100%" id="section_selector_holder" / required>
																<option value=""><?php echo get_phrase('select_class_first');?></option>
																
															</select>
														</div>
													</div>
																									
																
																<div class="form-group">
																<label class="col-md-9" for="example-text"><?php echo get_phrase('age');?> <b style="color:red">*</b></label>
																<div class="col-sm-12">
																		<input type="text" class="form-control" name="age" id="age" value="" required> 
																	</div> 
																</div>
																
																
																
                                                                <div class="quform-element">
                                                                    <p>Your Phone <b style="color:red">*</b>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input id="name" type="number" name="phone" class="form-control" required>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																 <div class="quform-element">
                                                                    <p>Your Email <b style="color:red">*</b>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input id="email" type="email" name="email" class="form-control" required>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
                                                                <div class="quform-element">
                                                                    <p>Your Address
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-message">
                                                                            <textarea  id="message" name="address" class="form-control"></textarea>
                                                                        </span>
                                                                    </p>
                                                                </div>
																
																 <div class="quform-element">
                                                                    <p>Please chose your password <b style="color:red">*</b>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input id="password" type="password" name="password" class="form-control" required>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																<div class="quform-element">
                                                                    <p><h3> <label><span style="color:red"><?php echo (isset($question)) ? $question : ''; ?></label></h3>
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input type="hidden" name="answer" value="<?php echo $this->session->userdata('security_ans') ?>" />
																			<input type="text" class="form-control" name="ans" value="" class="input1" placeholder = "Type answers here" style="border:1px dotted red">
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																
                                                                <p>
                                                                    <!-- Begin Submit button -->
                                                                    <div class="quform-submit">
                                                                        <div class="quform-submit-inner">
                                                                            <button type="submit" class="submit-button"><span>Register Now</span></button>
                                                                        </div>
                                                                        <div class="quform-loading-wrap"><span class="quform-loading"></span></div>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="gdlr-core-pbf-column gdlr-core-column-20">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 50px 20px 0px 20px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 28px ;font-weight: 700 ;"><?=get_phrase('location');?></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                                                    <div class="gdlr-core-text-box-item-content" style="font-size: 16px ;">
                                                        <p><?=get_settings('address');?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-icon-list-item gdlr-core-item-pdlr gdlr-core-item-pdb clearfix ">
                                                    <ul>
                                                        <li class=" gdlr-core-skin-divider gdlr-core-with-hover"><span class="gdlr-core-icon-list-icon-wrap"><i class="gdlr-core-icon-list-icon-hover fa fa-envelope-o" style="font-size: 16px ;"  ></i><i class="gdlr-core-icon-list-icon fa fa-envelope-o" style="font-size: 16px ;width: 16px ;" ></i></span>
                                                            <div class="gdlr-core-icon-list-content-wrap"><span class="gdlr-core-icon-list-content" style="font-size: 16px ;"><?=get_settings('system_email');?></span></div>
                                                        </li>
                                                        <li class=" gdlr-core-skin-divider gdlr-core-with-hover"><span class="gdlr-core-icon-list-icon-wrap"><i class="gdlr-core-icon-list-icon-hover fa fa-phone" style="font-size: 16px ;"  ></i><i class="gdlr-core-icon-list-icon fa fa-phone" style="font-size: 16px ;width: 16px ;" ></i></span>
                                                            <div class="gdlr-core-icon-list-content-wrap"><span class="gdlr-core-icon-list-content" style="font-size: 16px ;"><?=get_settings('phone');?></span></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 28px ;font-weight: 700 ;">Map</h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-wp-google-map-plugin-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">
                                                    <div style="overflow:hidden;width: 100%;position: relative;">
                                                        
                                                        <?=$this->db->get_where('more_about', array('id' => '1'))->row()->map_code;?>
                                                        <div style="position: absolute;width: 80%;bottom: 20px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;">

                                                        </div>
                                                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                    </div>
					
					<div class="gdlr-core-page-builder-body"></div>

             <?php include "footer.php";?>
        </div>
    </div>


<script type="text/javascript">
        $(function() {
            $('input[name="birthday"]').date({
                singleDatePicker: true,
                showDropdowns: true
            }, 
            function(start, end, label) {
                var years = moment().diff(start, 'years');
               // alert("You are " + years + " years old.");
                $("#age").val(years);
            });
        });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>website/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>

	<?php include "javascript.php";?>