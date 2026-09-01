<div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="Newsletter">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_100">
                                        <div class="gdlr-core-pbf-background-wrap">
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_101" data-parallax-speed="0"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align" id="div_1dd7_102">
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" id="div_1dd7_103">
													<img src="<?php echo base_url();?>optimum/front/upload/icon-envelope.png" alt="" width="78" height="60" title="icon-envelope" /></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_104">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_33"><?=get_phrase('Subscribe To Newsletter');?></h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_9"><?=get_phrase('Get updates to news & events');?></span></div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-newsletter-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-style-rectangle-full">
																<?php if (($this->session->flashdata('flash_message')) != ""): ?>
																<div style="background-color:green; color:white; padding-bottom:10px; padding-top:10px; padding-left:10px"> 
																<?php echo $this->session->flashdata('flash_message'); ?></div>
																<?php endif; ?>
																 <?php if (($this->session->flashdata('error_message')) != ""): ?>
																<div style="background-color:red; color:white; padding-bottom:10px; padding-top:10px; padding-left:10px"> 
																<?php echo $this->session->flashdata('error_message'); ?></div>
																<?php endif; ?>
                                                    <div class="newsletter newsletter-subscription">
														<form class="gdlr-core-newsletter-form clearfix" action="<?php echo base_url();?>website/subscriber/" method="post">
                                                            <div class="gdlr-core-newsletter-email">
                                                                <input class="newsletter-email gdlr-core-skin-e-background gdlr-core-skin-e-content" 
																placeholder="Your Email Address" type="email" name="email" size="30" required />
                                                            </div>
                                                            <div class="gdlr-core-newsletter-submit">
                                                                <input class="newsletter-submit" type="submit" value="Subscribe" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        
                                    </div>
                                </div>