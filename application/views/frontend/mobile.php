                    <div class="kingster-mobile-menu"><a class="kingster-mm-menu-button kingster-mobile-menu-button kingster-mobile-button-hamburger" href="#kingster-mobile-menu"><span></span></a>
                        <div class="kingster-mm-menu-wrap kingster-navigation-font" id="kingster-mobile-menu" data-slide="right">
                            <ul id="menu-main-navigation" class="m-menu">
                               			<li class="menu-item menu-item-home"><a href="<?=base_url();?>login"><?=get_phrase('login_portal');?></a></li>
                                        <li class="menu-item menu-item-home"><a href="<?=base_url();?>website"><?=get_phrase('home');?></a></li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>aboutUs"><?=get_phrase('about_us');?></a></li>
										 
										 <li class="menu-item menu-item-has-children"><a href="#"><?=get_phrase('admissions');?></a>
											<ul class="sub-menu">
												<li class="menu-item"><a href="<?=base_url();?>howToApply"><?=get_phrase('how_to_apply');?></a></li>
												<li class="menu-item"><a href="<?=base_url();?>applicationForm/index/validate"><?=get_phrase('online_application');?></a></li>
											</ul>
                                		</li>
										
										<li class="menu-item menu-item-has-children"><a href="#"><?=get_phrase('our_staff');?></a>
											<ul class="sub-menu">
												<li class="menu-item"><a href="<?=base_url();?>teachingStaff"><?=get_phrase('teaching_staff');?></a></li>
												<li class="menu-item"><a href="<?=base_url();?>nonTeachingStaff"><?=get_phrase('non_teaching_staff');?></a></li>
												<li class="menu-item"><a href="<?=base_url();?>executive"><?=get_phrase('school_executive');?></a></li>
											</ul>
                                		</li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>alumni"><?=get_phrase('alumni');?></a></li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>gallery"><?=get_phrase('gallery');?></a></li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>blog"><?=get_phrase('blogs');?></a></li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>event"><?=get_phrase('events');?></a></li>
										<li class="menu-item menu-item-home"><a href="<?=base_url();?>contact/index/validate"><?=get_phrase('contact_us');?></a></li>
										
										<li class="menu-item menu-item-has-children"><a href="#">
										
											<?php
												if ($set_lang = $this->session->userdata('language')) {
			
												} else {
													$set_lang = get_settings('language');
												}
												$lid = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->db_field;
												$lnm = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->name;
                                			?>
											<?php echo $lnm;?>
										</a>
											<ul class="sub-menu">
											<?php $select_all_languages_from_laguage_table = $this->db->get_where('language_list', array('status' => 'ok'))->result_array();
                                    				foreach ($select_all_languages_from_laguage_table as $key => $selected_languages):?>
												<li <?php if($set_language == $selected_languages['db_field']) { ?> 
												class=" menu-item active" <?php }?>>
												
												<a class="set_langs" onclick="location.reload();" 
													data-href="<?php echo base_url();?>admin/set_language/<?php echo $selected_languages['db_field'];?>">
													<img src="<?php echo base_url(); ?>optimum/flag/<?php echo $selected_languages['db_field']; ?>.png" style="width:16px; height:16px;" />
													 <?php echo $selected_languages['name']; ?>
													</a>
												</li>
												 <?php endforeach;?>
											</ul>
                                		</li>
                
                            </ul>
                        </div>
                    </div>