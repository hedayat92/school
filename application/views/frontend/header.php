            
            
            
            <header class="kingster-header-wrap kingster-header-style-plain  kingster-style-menu-right kingster-sticky-navigation kingster-style-fixed" data-navigation-offset="75px">
                <div class="kingster-header-background"></div>
                <div class="kingster-header-container  kingster-container">
                    <div class="kingster-header-container-inner clearfix">
                        <div class="kingster-logo  kingster-item-pdlr" style="padding-top: 0px; padding-bottom: 0px;">
                            <div class="kingster-logo-inner">
                                <a class="" href="<?=base_url();?>website"><img src="<?php echo base_url();?>uploads/logo.png" style="height:125px;" alt="School Logo" /></a>
                            </div>
                        </div>
                        <div class="kingster-navigation kingster-item-pdlr clearfix ">
                            <div class="kingster-main-menu" id="kingster-main-menu">
                                <ul id="menu-main-navigation-1" class="sf-menu">
                                       
                                            <li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>website"><?=get_phrase('home');?></a></li>
                                       		<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>aboutUs"><?=get_phrase('about_us');?></a></li>
											<li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre"><?=get_phrase('admission');?></a>
												<ul class="sub-menu">
													<li class="menu-item" data-size="60"><a href="<?=base_url();?>howToApply"><?=get_phrase('how_to_apply');?></a></li>
													<li class="menu-item" data-size="60"><a href="<?=base_url();?>applicationForm/index/validate"><?=get_phrase('online_application');?></a></li>
												</ul>
                                    		</li>
											
											<li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre"><?=get_phrase('our_staff');?></a>
												<ul class="sub-menu">
													<li class="menu-item" data-size="60"><a href="<?=base_url();?>teachingStaff"><?=get_phrase('teaching_staff');?></a></li>
													<li class="menu-item" data-size="60"><a href="<?=base_url();?>nonTeachingStaff"><?=get_phrase('non_teaching_staff');?></a></li>
													<li class="menu-item" data-size="60"><a href="<?=base_url();?>executive"><?=get_phrase('school_executive');?></a></li>
												</ul>
                                    		</li>
											<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>alumni"><?=get_phrase('alumni');?></a></li>
											<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>gallery"><?=get_phrase('gallery');?></a></li>
											<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>blog"><?=get_phrase('blog');?></a></li>
											<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>event"><?=get_phrase('events');?></a></li>
											<li class="menu-item menu-item-home" data-size="60"><a href="<?=base_url();?>contact/index/validate"><?=get_phrase('contact_us');?></a></li>
											<li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">
											
											<?php
												if ($set_lang = $this->session->userdata('language')) {
			
												} else {
													$set_lang = get_settings('language');
												}
												$lid = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->db_field;
												$lnm = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->name;
                                			?>
											<img src="<?php echo base_url(); ?>optimum/flag/<?php echo $lid; ?>.png" style="width:20px; height:20px;" />
											<?php echo $lnm;?> <i class="fa fa-caret-down"></i>
											
											
											</a>
												
												<ul class="sub-menu">
												<?php $select_all_languages_from_laguage_table = $this->db->get_where('language_list', array('status' => 'ok'))->result_array();
                                    				foreach ($select_all_languages_from_laguage_table as $key => $selected_languages):?>
													<li <?php if($set_language == $selected_languages['db_field']) { ?> class=" menu-item active" <?php }?>>
													<a class="set_langs" onclick="location.reload();" 
													data-href="<?php echo base_url();?>website/set_language/<?php echo $selected_languages['db_field'];?>">
													<img src="<?php echo base_url();?>optimum/flag/<?php echo $selected_languages['db_field']; ?>.png" style="width:16px; height:16px;" />
													 <?php echo $selected_languages['name']; ?>
													</a></li>
												  <?php endforeach;?>
												</ul>
                                    		</li>
											
                                  
                                   
                                    
                                </ul>
                                <div class="kingster-navigation-slide-bar" id="kingster-navigation-slide-bar"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </header>
			
			