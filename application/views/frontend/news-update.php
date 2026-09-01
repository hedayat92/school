<div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_45" data-sync-height="height-2">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-widget">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_46">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_10"><?=get_phrase('News & Updates')?></h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_47"></div>
                                                        </div>
                                                        <a class="gdlr-core-block-item-read-more" href="#" target="_self" id="a_1dd7_5"><?=get_phrase('Read All News')?></a>
                                                    </div>
													
													<?php 
														$sql = "select * from news order by news_id desc limit 1";
														$query = $this->db->query($sql)->result_array();
														foreach ($query as $row) : ?>
                                                    <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                                        <div class="gdlr-core-item-list-wrap gdlr-core-column-30">
                                                            <div class="gdlr-core-item-list-inner gdlr-core-item-mglr">
                                                                <div class="gdlr-core-blog-grid ">
                                                                    <div class="gdlr-core-blog-thumbnail gdlr-core-media-image  gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                                        <a href="<?=base_url().'blog/details/'.$row['slug'];?>">
                                                                            <img src="<?=base_url().'uploads/news/'.$row['news_id'].'.jpg'?>" width="700" height="430" alt="" />
                                                                        </a>
                                                                    </div>
																	
																	
                                                                    <div class="gdlr-core-blog-grid-content-wrap">
                                                                        <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                                            <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                                                <a href="#"><?=date('d, M Y', $row['timestamp'])?></a>
                                                                            </span>
                                                                            <!-- <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-tag">
                                                                                <a href="#" rel="tag">Admission</a>-->
                                                                               
                                                                                
                                                                            </span>
                                                                        </div>
                                                                        <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_11">
                                                                            <a href="<?=base_url().'blog/details/'.$row['slug'];?>" ><?=substr($row['title'], 0,30)?></a>...
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<?php endforeach;?>
														
														
														
														
														<?php 
														$sql = "select * from news order by rand() desc limit 3";
														$query = $this->db->query($sql)->result_array();
														foreach ($query as $row) : ?>
                                                        <div class="gdlr-core-item-list-wrap gdlr-core-column-30">
														
														
                                                            <div class="gdlr-core-item-list gdlr-core-blog-widget gdlr-core-item-mglr clearfix gdlr-core-style-small">
                                                                <div class="gdlr-core-blog-thumbnail gdlr-core-media-image  gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                                    <a href="#">
                                                                        <img src="<?=base_url().'uploads/news/'.$row['news_id'].'.jpg'?>" alt="" width="150" height="150" title="Student" />
                                                                    </a>
                                                                </div>
                                                                <div class="gdlr-core-blog-widget-content">
                                                                    <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                                        <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                                            <a href="#"><?=date('d, M Y', $row['timestamp'])?></a>
                                                                        </span>
                                                                        <!-- <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-tag">
                                                                            <a href="#" rel="tag">Hot</a>
                                                                            <span class="gdlr-core-sep">,</span>
                                                                            <a href="#" rel="tag">Updates</a>
                                                                        </span>-->
                                                                    </div>
                                                                    <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_12">
                                                                        <a href="<?=base_url().'blog/details/'.$row['slug'];?>" ><?=substr($row['title'], 0,30)?></a>...
                                                                    </h3>
                                                                </div>
                                                            </div>			
                                                        </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>