<div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <?php 
														$sql = "select * from noticeboard order by noticeboard_id desc limit 1";
														$query = $this->db->query($sql)->result_array();
														foreach ($query as $row) : ?>
											<div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align">
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-round" id="div_1dd7_92">
                                                        <img src="<?php echo base_url().'uploads/events/'.$row['noticeboard_id'];?>.jpg" width="700" height="372" alt="" />
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_31"><?=$row['title']?></h3>
                                                    </div>
                                                    <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_8">
													<p align="justify"><?=substr($row['description'], 0, 200)?> ...</p>
                                                    </span>
                                                </div>
                                            </div>
											<?php endforeach;?>
											
                                            <!-- <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                                    <a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="#" id="a_1dd7_6">
                                                        <i class="gdlr-core-pos-left fa fa-heart"  ></i>
                                                        <span class="gdlr-core-content" >Become a donor</span>
                                                    </a>
                                                </div>
                                            </div> -->
											
											
											
                                        </div>
                                    </div>
                                </div>