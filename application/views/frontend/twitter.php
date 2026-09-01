<div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first" data-skin="Blue Title">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-left" id="div_1dd7_64" data-sync-height="height-3" data-sync-height-center>
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_65"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_66">
                                                        <div class="gdlr-core-twitter-item gdlr-core-item-pdb" id="div_1dd7_67">
                                                           
                                                            <div class="gdlr-core-block-item-title-nav ">
                                                                <div class="gdlr-core-flexslider-nav gdlr-core-plain-style gdlr-core-block-center"></div>
                                                            </div>
                                                            
                                                            <div class="gdlr-core-twitter-content">
                                                                <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel" data-column="1" data-nav="navigation" data-nav-parent="gdlr-core-twitter-item">
                                                                    <ul class="slides" id="ul_1dd7_0">
                                                                       
																	   
																	   
																	   <?php
																		  $this->db->order_by('noticeboard_id', 'RANDOM');
																		  $query = $this->db->get('noticeboard');
																		  $select = $query->result_array();
																		   foreach ($select as $row) {
																		?>
																	   
																	    <li class="gdlr-core-item-mglr">
                                                                            <div class="gdlr-core-twitter-item-list">
                                                                                <span class="gdlr-core-twitter-item-list-content"><?=$row['title']?>
                                                                                    <a target="_blank" href="<?=base_url().'event/details/'.$row['slug'];?>"></a>
                                                                                </span>
                                                                                <span class="gdlr-core-twitter-item-list-date gdlr-core-skin-caption">
                                                                                    <a class="gdlr-core-twitter-date" href="<?=base_url().'event/details/'.$row['slug'];?>" target="_blank"> <?=date('d, M Y', $row['timestamp'])?></a>
                                                                                </span>
                                                                            </div>
                                                                        </li>
																		
																		<?php } ?>
																		
																		
                                                                       
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="White Text">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-right" id="div_1dd7_68" data-sync-height="height-3">
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_69"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-no-caption gdlr-core-item-pdlr" id="div_1dd7_70">
                                                    <div class="gdlr-core-column-service-media gdlr-core-media-image" id="div_1dd7_71">
													<img src="<?php echo base_url();?>uploads/logo.png" alt="" width="42" height="39" title="apply-logo" /></div>
                                                    <div class="gdlr-core-column-service-content-wrapper">
                                                        <div class="gdlr-core-column-service-title-wrap">
                                                            <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_22"><?=get_phrase('contact_us_now');?></h3></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="gdlr-core-pbf-column-link" href="<?php echo base_url();?>contact/index/validate" target="_self"></a>
                                    </div>
                                </div>