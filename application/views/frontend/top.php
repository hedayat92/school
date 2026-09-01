<div class="kingster-top-bar">
                <div class="kingster-top-bar-background"></div>
                <div class="kingster-top-bar-container kingster-container ">
                    <div class="kingster-top-bar-container-inner clearfix">
                        <div class="kingster-top-bar-left kingster-item-pdlr"><i class="fa fa-envelope-open-o" id="i_fd84_0"></i> <a href="mailto:<?=get_settings('system_email');?>"><?=get_phrase('send_email');?></a> <i class="fa fa-phone" id="i_fd84_1"></i> <a href="tel:<?=get_settings('phone');?>"><?=get_settings('phone');?></a>&nbsp;: <a href=""><i class="fa fa-map-marker" id="i_fd84_1"></i><?=get_settings('address');?></a></div>
                        <div class="kingster-top-bar-right kingster-item-pdlr">
                            <ul id="kingster-top-bar-menu" class="sf-menu kingster-top-bar-menu kingster-top-bar-right-menu">
                          
					<?php $sess = $this->session->userdata('login_type');
					if($sess == 'admin' ||$sess == 'teacher' || $sess == 'librarrian' || 
					$sess == 'hostel' || $sess == 'accountant' || 
					$sess == 'hrm' || $sess == 'parent' || $sess == 'student') : ?>
					
					 <li class="menu-item kingster-normal-menu"><a href="<?=base_url();?><?=$this->session->userdata('login_type')?>/dashboard">
					 <img src="<?=$this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))?>" style="border-radius:50%; height:30px"> <?=get_phrase('dashboard');?></a></li>
					 <?php endif;?>
					 
					 <?php
					if($sess != 'admin' && $sess != 'teacher' && $sess != 'librarrian' && 
					$sess != 'hostel' && $sess != 'accountant' && 
					$sess != 'hrm' && $sess != 'parent' && $sess != 'student') : ?>
					
                    <li class="menu-item kingster-normal-menu"><a href="<?=base_url();?>login"><i class="fa fa-sign-in" id="i_fd84_1"></i> <?=get_phrase('login_portal');?></a></li>
                    <?php endif;?>       
							</ul>
                            </div>
                    </div>
                </div>
            </div>