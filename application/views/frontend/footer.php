            <footer>
                <div class="kingster-footer-wrapper ">
                    <div class="kingster-footer-container kingster-container clearfix">
                        <div class="kingster-footer-column kingster-item-pdlr kingster-column-15">
                            <div id="text-2" class="widget widget_text kingster-widget">
                                <div class="textwidget">
                                    <p> 
										<a class="" href="<?=base_url();?>website"><img src="<?php echo base_url();?>uploads/logo.png" height="40" alt="School Logo" /></a>
                                        <br /> <span class="gdlr-core-space-shortcode" id="span_1dd7_10"></span>
                                       <?=get_settings('address');?></p>
                                    <p><span id="span_1dd7_11"><?=get_settings('phone');?></span>
                                        <br /> <span class="gdlr-core-space-shortcode" id="span_1dd7_12"></span>
                                        <br /> <a id="a_1dd7_8" href="mailto:<?=get_settings('system_email');?>"><?=get_settings('system_email');?></a></p>
                                    <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-left-align">
                                        <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_111"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kingster-footer-column kingster-item-pdlr kingster-column-15">
                            <div id="gdlr-core-custom-menu-widget-2" class="widget widget_gdlr-core-custom-menu-widget kingster-widget">
                                <h3 class="kingster-widget-title"><?=get_phrase('quick_links');?></h3><span class="clear"></span>
                                <div class="menu-our-campus-container">
                                    <ul id="menu-our-campus" class="gdlr-core-custom-menu-widget gdlr-core-menu-style-plain">
                                        <li class="menu-item"><a href="<?=base_url();?>howToApply"><?=get_phrase('how_to_apply');?></a></li>
                                        <li class="menu-item"><a href="<?=base_url();?>login"><i class="fa fa-sign-in"></i> <?=get_phrase('login_portal');?></a></li>
                                        <li class="menu-item"><a href="<?=base_url();?>blog"><?=get_phrase('follow_daily_news');?></a></li>
										<li class="menu-item"><a href="<?=base_url();?>teachingStaff"><?=get_phrase('teaching_staff');?></a></li>
                                        <li class="menu-item"><a href="<?=base_url();?>nonTeachingStaff"><?=get_phrase('non_teaching_staff');?></a></li>
                                        <li class="menu-item"><a href="<?=base_url();?>executive"><?=get_phrase('school_executive');?></a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="kingster-footer-column kingster-item-pdlr kingster-column-15">
                            <div id="gdlr-core-custom-menu-widget-3" class="widget widget_gdlr-core-custom-menu-widget kingster-widget">
                                <h3 class="kingster-widget-title"><?=get_phrase('news');?></h3><span class="clear"></span>
                                <div class="menu-campus-life-container">
                                    <ul id="menu-campus-life" class="gdlr-core-custom-menu-widget gdlr-core-menu-style-plain">
										<?php 
										$sql = "select * from news order by rand() desc limit 6";
										$query = $this->db->query($sql)->result_array();
										foreach ($query as $row) : ?>
                                        <li class="menu-item"><a href="<?=base_url().'blog/details/'.$row['slug'];?>"><img src="<?=base_url().'uploads/news/'.$row['news_id'].'.jpg'?>" width="30" height="30" style="border-radius:5%"> <?=substr($row['title'], 0,25)?></a>...</li>
										<?php endforeach;?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
						
                        <div class="kingster-footer-column kingster-item-pdlr kingster-column-15">
                            <div id="gdlr-core-custom-menu-widget-4" class="widget widget_gdlr-core-custom-menu-widget kingster-widget">
                                <h3 class="kingster-widget-title"><?=get_phrase('like_facebook_page');?></h3><span class="clear"></span>
                                <div class="menu-academics-container">
                                    <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->facebook;?>&width=260&height=260&colorscheme=light&show_faces=true&header=true&stream=false&show_border=true&appId=194009127410715" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:210px;" allowTransparency="true"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="kingster-copyright-wrapper">
                    <div class="kingster-copyright-container kingster-container clearfix">
                        <div class="kingster-copyright-left kingster-item-pdlr"><?=get_settings('footer').' ('.date('Y').')';?></div>
                        <div class="kingster-copyright-right kingster-item-pdlr">
                            <div class="gdlr-core-social-network-item gdlr-core-item-pdb  gdlr-core-none-align" id="div_1dd7_112">
                                <a href="https://facebook.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->facebook;?>" target="_blank" class="gdlr-core-social-network-icon" title="facebook">
                                    <i class="fa fa-facebook" ></i>
                                </a>
                                <a href="https://googleplus.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->googleplus;?>" target="_blank" class="gdlr-core-social-network-icon" title="google-plus">
                                    <i class="fa fa-google-plus" ></i>
                                </a>
                                <a href="https://linkedin.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->linkedin;?>" target="_blank" class="gdlr-core-social-network-icon" title="linkedin">
                                    <i class="fa fa-linkedin" ></i>
                                </a>
                                <a href="https://skype.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->skype;?>" target="_blank" class="gdlr-core-social-network-icon" title="skype">
                                    <i class="fa fa-skype" ></i>
                                </a>
                                <a href="https://twitter.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->twitter;?>" target="_blank" class="gdlr-core-social-network-icon" title="twitter">
                                    <i class="fa fa-twitter" ></i>
                                </a>
                                <a href="https://instagram.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->instagram;?>" target="_blank" class="gdlr-core-social-network-icon" title="instagram">
                                    <i class="fa fa-instagram" ></i>
                                </a>
								<a href="https://pinterest.com/<?=$this->db->get_where('more_about',
								array('id' => '1'))->row()->pinterest;?>" target="_blank" class="gdlr-core-social-network-icon" title="pinterest">
                                    <i class="fa fa-pinterest" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>