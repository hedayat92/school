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
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 32px ;font-weight: 700 ;">Leave us your info</h3></div>
                                                </div>
                                            </div>
                                           
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-contact-form-7-item gdlr-core-item-pdlr gdlr-core-item-pdb ">
                                                    <div role="form" class="wpcf7" id="wpcf7-f1979-p1977-o1" lang="en-US" dir="ltr">
                                                        <div class="screen-reader-response"></div>
                                                       <?php echo form_open(base_url() . 'contact/send' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
																
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
                                                                    <p>Select Category (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                           <select name="category" class="form-control" required>
																				<?php 
																				$enquiry_category = $this->db->get('enquiry_category')->result_array();
																				foreach($enquiry_category as $key => $row):
																				?>
																					<option value="<?php echo $row['category'];?>"><?php echo $row['category'];?></option>
																				<?php
																				endforeach;
																				?>
																			</select>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																<div class="quform-element">
                                                                    <p>Purpose of Visiting (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                            																			
																			<select name="purpose" class="form-control" required>
																				<?php 
																				$purpose = $this->db->get('enquiry_category')->result_array();
																				foreach($purpose as $key => $row):
																				?>
																					<option value="<?php echo $row['purpose'];?>"><?php echo $row['purpose'];?></option>
																				<?php
																				endforeach;
																				?>
																			</select>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																<div class="quform-element">
                                                                    <p>Inquiry to (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                            	<select name="whom_to_meet" class="form-control" required>
																					<?php 
																					$whom = $this->db->get('enquiry_category')->result_array();
																					foreach($whom as $key => $row):
																					?>
																						<option value="<?php echo $row['whom'];?>"><?php echo $row['whom'];?></option>
																					<?php
																					endforeach;
																					?>
																				</select>
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																
																<div class="quform-element">
                                                                    <p>Your Name (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-name">
                                                                            <input id="name" type="text" name="name"  class="input1" aria-required="true" aria-invalid="false">
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																
                                                                <div class="quform-element">
                                                                    <p>Your Phone (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input id="name" type="number" name="mobile" class="input1" aria-required="true" aria-invalid="false">
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
																 <div class="quform-element">
                                                                    <p>Your Email (required)
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-email">
                                                                            <input id="email" type="email" name="email" class="input1" aria-required="true" aria-invalid="false">
                                                                        </span> 
                                                                    </p>
                                                                </div>
																
                                                                <div class="quform-element">
                                                                    <p>Your Message
                                                                        <br>
                                                                        <span class="wpcf7-form-control-wrap your-message">
                                                                            <textarea  id="message" name="content" cols="40" rows="10" class="input1" aria-invalid="false"></textarea>
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
                                                                            <button type="submit" class="submit-button"><span>Send</span></button>
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
                    </div
					
					
					
					
					
					
                ><div class="gdlr-core-page-builder-body"></div>

             <?php include "footer.php";?>
        </div>
    </div>


	<?php include "javascript.php";?>