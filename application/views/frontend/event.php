<div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" id="div_1dd7_94">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32"><?=get_phrase('Upcoming Events')?></h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
													
													<?php 
															$noti = $this->website_model->select_all_events_limit();
															foreach ($noti as $row) : 
															?>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <div class="gdlr-core-event-item-list gdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_97">
                                                            <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                <span class="gdlr-core-date" ><?=date('d', $row['timestamp'])?></span>
                                                                <span class="gdlr-core-month"><?=date('M', $row['timestamp'])?></span>
                                                            </span>
                                                            <div class="gdlr-core-event-item-content-wrap">
                                                                <h3 class="gdlr-core-event-item-title">
                                                                    <a href="<?=base_url().'event/details/'.$row['slug'];?>" ><?=substr($row['title'], 0,50)?>...</a>
                                                                </h3>
                                                                <div class="gdlr-core-event-item-info-wrap">
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_clock_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail"><?=date('d, M Y', $row['timestamp'])?></span>
                                                                    </span>
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_pin_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail"><?=$row['location']?></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
													<?php endforeach;?>
                                                </div>
                                            </div>