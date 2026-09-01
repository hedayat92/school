<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-body table-responsive">
                            <section class="m-t-40">
                                <div class="sttabs tabs-style-linetriangle">
                                    <nav>
                                        <ul>
                                            <li><a href="#section-linetriangle-1"><span><?php echo get_phrase('manage_banner');?></span></a></li>
                                            <li><a href="#section-linetriangle-2"><span><?php echo get_phrase('admission_info');?></span></a></li>
                                            <li><a href="#section-linetriangle-3"><span><?php echo get_phrase('about_us_info');?></span></a></li>
                                            <li><a href="#section-linetriangle-4"><span><?php echo get_phrase('general_info');?></span></a></li>
                                            <li><a href="#section-linetriangle-5"><span><?php echo get_phrase('add_executive');?></span></a></li>
                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="section-linetriangle-1">
                  <?php echo form_open(base_url() . 'website/website_setting/banner', 
				  array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
		   
					  <!--<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('text_a');?></label>
						 <input type="text" name="txta"  class="form-control form-control-rounded" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('text_b');?></label>
						 <input type="text" name="txtb"  class="form-control form-control-rounded" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('text_c');?></label>
						 <input type="text" name="txtc"  class="form-control form-control-rounded" required>
					  </div>
					  
					  
					  
					  ,<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('image_direction');?></label>
							<select name="direction" class="form-control form-control-rounded" required>
								<option value="1">Left to right</option>
								<option value="2">Right to left</option>
							</select>
           				</div>-->
						
						<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('banner_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile" onChange="readURL(this);" /required>
       				 		 <img id="blah" src="" alt="" height="200" width="500"/>
						 <p style="color:red">Upload image 1800 x 1119 pixel</p>
					  </div>
					  
		   
					  
					  <?php if(!(demo())){ ?>
					   <div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-sm btn-rounded"><i class="icon-lock"></i> <?php echo get_phrase('save'); ?></button>
						</div>
		  				<?php } ?>
					  <hr class="sep-2">
		   				<?php echo form_close(); ?>
						<div class="table-responsive">
						 <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
						<th><?php echo get_phrase('Image');?></th>
                       
					   <!--  <th><?php echo get_phrase('text_a');?></th>
                        <th><?php echo get_phrase('text_b');?></th>
                        <th><?php echo get_phrase('text_c');?></th>
                        <th><?php echo get_phrase('Actions');?></th>
						-->
                       
                    </tr>
                </thead>
                <tbody>

				<?php $select_all_admin_from_admin_table = $this->website_model->get_all_banners_from_banner_table();
                            foreach ($select_all_admin_from_admin_table as $key => $select_all_admin_from_admin_table):?>
                    <tr>
						<td><img src="<?=base_url()?>uploads/banner/<?=$select_all_admin_from_admin_table['banner_id']?>" width="200" height="100"></td>
                        <!--<td><?php echo $select_all_admin_from_admin_table['txta'];?></td>
						<td><?php echo $select_all_admin_from_admin_table['txtb'];?></td>
						<td><?php echo $select_all_admin_from_admin_table['txtc'];?></td>
						-->
						<td>
						
						 <?php if(!(demo())){ ?>
						<a href="#" onclick="confirm_modal('<?php echo base_url();?>website/website_setting/delete/<?php echo $select_all_admin_from_admin_table['banner_id'];?>');"><button type="button" class="btn btn-danger shadow-danger btn-round btn-sm"><i class="fa fa-times"></i></button></a>
						
						<?php } ?>
						</td>
                       
                       
                    </tr>
							<?php endforeach;?>
                 
                </tbody>
                
            </table>
			</div>
			
			
			 <hr class="sep-2">
                                            
                                        </section>
										
										
										
										
										
                                        <section id="section-linetriangle-2"> 
										
										
										 <?php $id = $this->db->get_where('admission', 
						 array('id' => '1'))->row()->id;?>
				   <?php echo form_open(base_url() . 'website/website_setting/admission/'.$id, array('class' => 'form-horizontal form-groups-bordered validate', 
					 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
					 
					
		   
					<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('title');?></label>
						 <input type="text" name="title"  class="form-control form-control-rounded" value="<?=$this->db->get_where('admission', 
						 array('id' => '1'))->row()->title;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('brief_info');?></label>
						 <textarea id="mymce" name="desc"  ><?=$this->db->get_where('admission', 
						 array('id' => '1'))->row()->desc;?></textarea>
					  </div>
				
						
						<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('first_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile" onChange="readURL(this);">
						 <p style="color:red">Upload image 1000 x 707 pixel</p>
					  </div>
					  
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('second_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile2" onChange="readURL(this);" >
						 <p style="color:red">Upload image 1125 x 763 pixel</p>
					  </div>
					  
		   
					  
					  <?php if(!(demo())){ ?>
					   <div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-sm btn-rounded"><i class="icon-lock"></i> <?php echo get_phrase('save'); ?></button>
						</div>
		  				<?php } ?>
					  <hr class="sep-2">
		   				<?php echo form_close(); ?>
										
										
                                        
                                           
                                         </section>
										 
										 
										 <section id="section-linetriangle-3">
										 
										 
										<?php $id = $this->db->get_where('about', 
						 array('id' => '1'))->row()->id;?>
				   <?php echo form_open(base_url() . 'website/website_setting/about/'.$id, array('class' => 'form-horizontal form-groups-bordered validate', 
					 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
					 
					
		   
					<div class="form-group">
					  <label for="input-6"><?php echo get_phrase('about_us');?></label>
						 <textarea id="mymce" name="title"><?=$this->db->get_where('about', 
						 array('id' => '1'))->row()->title;?></textarea>
					  </div>
					  
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('tour_message');?></label>
						 <input type="text" name="tour"  class="form-control form-control-rounded" value="<?=$this->db->get_where('about', 
						 array('id' => '1'))->row()->tour;?>" required>
					  </div>
					  
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('youtube_link');?></label>
						 <input type="text" name="youtube"  class="form-control form-control-rounded" value="<?=$this->db->get_where('about', 
						 array('id' => '1'))->row()->youtube;?>" required>
					  </div>
					 
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('about_image_cover');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile" onChange="readURL(this);" >
						 <p style="color:red">Upload image 1800 x 700 pixel</p>
					  </div>
					  
		   
					  
					  <?php if(!(demo())){ ?>
					   <div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-sm btn-rounded"><i class="icon-lock"></i> <?php echo get_phrase('save'); ?></button>
						</div>
		  				<?php } ?>
					  <hr class="sep-2">
		   				<?php echo form_close(); ?>
										 
										  </section>
										  
										  
										  
										  
										  
                                        <section id="section-linetriangle-4">
                                           
                                        <?php $id = $this->db->get_where('more_about', 
						 array('id' => '1'))->row()->id;?>
				   <?php echo form_open(base_url() . 'website/website_setting/more_about/'.$id, array('class' => 'form-horizontal form-groups-bordered validate', 
					 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
					 
		   			
					 <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('benefit');?></label>
						 <textarea class="form-control form-control-rounded" name="benefit"><?=$this->db->get_where('more_about', array('id' => '1'))->row()->benefit;?></textarea>
					  </div>
					  
					
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('benefit_video');?></label>
						 <input type="text" name="benefit_video"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->benefit_video;?>" required>
					  </div>
					 
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('benefit_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile" onChange="readURL(this);" >
						 <p style="color:red">Upload image 700 x 523 pixel</p>
					  </div>
					  
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('self_development');?></label>
						 <textarea class="form-control form-control-rounded" name="self"><?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->self;?></textarea>
					  </div>
					  
					
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('self_development_video');?></label>
						 <input type="text" name="self_video"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->self_video;?>" required>
					  </div>
					 
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('self_development_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile2" onChange="readURL(this);" >
						 <p style="color:red">Upload image 700 x 523 pixel</p>
					  </div>
					  
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('spirituality');?></label>
						 <textarea class="form-control form-control-rounded" name="spirit"><?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->spirit;?></textarea>
					  </div>
					  
					
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('spirituality_video');?></label>
						 <input type="text" name="spirit_video"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->spirit_video;?>" required>
					  </div>
					 
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('self_development_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile3" onChange="readURL(this);" >
						 <p style="color:red">Upload image 700 x 523 pixel</p>
					  </div>
					  
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('alumni');?></label>
						 <textarea class="form-control form-control-rounded" name="alumni"><?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->alumni;?></textarea>
					  </div>
					  
					
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('alumni_video');?></label>
						 <input type="text" name="alumni_video"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->alumni_video;?>" required>
					  </div>
					 
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('alumni_image');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile4" onChange="readURL(this);" >
						 <p style="color:red">Upload image 700 x 523 pixel</p>
					  </div>
					  
					  
					  <!--
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('website_logo');?></label>
						 <input type="file" class="form-control form-control-rounded" name="userfile5" onChange="readURL(this);" >
						 <p style="color:red">Upload image 150 x 50 pixel (The best size for app)</p>
					  </div>
					  -->
					  
					  
					<hr class="sep-2">
					<p style="color:red">Only supply your username. eg optimumlinkup is my group page name on https://facebook.com/optimumlinkup</p>
					
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('facebook');?></label>
						 <input type="text" name="facebook"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->facebook;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('twitter');?></label>
						 <input type="text" name="twitter"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->twitter;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('linkedin');?></label>
						 <input type="text" name="linkedin"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->linkedin;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('pinterest');?></label>
						 <input type="text" name="pinterest"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->pinterest;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('googleplus');?></label>
						 <input type="text" name="googleplus"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->googleplus;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('skype');?></label>
						 <input type="text" name="skype"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->skype;?>" required>
					  </div>
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('instagram');?></label>
						 <input type="text" name="instagram"  class="form-control form-control-rounded" value="<?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->instagram;?>" required>
					  </div>
					  
					  <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('how_apply_info');?></label>
						 <textarea id="mymce" name="apply"  class="form-control form-control-rounded"><?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->apply;?></textarea>
					  </div>
					  
					  
					   <div class="form-group">
					  <label for="input-6"><?php echo get_phrase('map_code');?></label>
						 <textarea name="map_code"  class="form-control form-control-rounded"><?=$this->db->get_where('more_about', 
						 array('id' => '1'))->row()->map_code;?></textarea>
					  </div>
					  
		   
					  
					  <?php if(!(demo())){ ?>
					   <div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-sm btn-rounded"><i class="icon-lock"></i> <?php echo get_phrase('save'); ?></button>
						</div>
		  				<?php } ?>
					  <hr class="sep-2">
		   				<?php echo form_close(); ?>
                                        
                                        </section>
										
										
										
										
										 <section id="section-linetriangle-5">
										 
										 <?php echo form_open(base_url() . 'website/website_setting/executive/', array('class' => 'form-horizontal form-groups-bordered validate', 
					 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
					 
							<div class="form-group">
							  <label for="input-6"><?php echo get_phrase('name');?> <b style="color:red">*</b></label>
								 <input type="text" name="name"  class="form-control form-control-rounded" placeholder="Executive Name Here" required>
							  </div>
							  
							   <div class="form-group">
							  <label for="input-6"><?php echo get_phrase('position');?> <b style="color:red">*</b></label>
								 <input type="text" name="post"  class="form-control form-control-rounded" placeholder="eg General Manager" required>
							  </div>
							  
							  <div class="form-group">
							  <label for="input-6"><?php echo get_phrase('executive_image');?> <b style="color:red">*</b></label>
								 <input type="file" class="form-control form-control-rounded" name="userfile" onChange="readURL(this);" >
								 <p style="color:red">Best image Size 128 x 128 pixel</p>
							  </div>
							  
							  <?php if(!(demo())){ ?>
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-block btn-sm btn-rounded"> <?php echo get_phrase('save'); ?></button>
								</div>
							<?php } ?>
						  <hr class="sep-2">
		   			<?php echo form_close(); ?>
					
					
							<div class="table-responsive">
							<table id="example" class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo get_phrase('image');?></th>
									<th><?php echo get_phrase('name');?></th>
								   <th><?php echo get_phrase('position');?></th>
									
								   
								</tr>
							</thead>
							<tbody>
			
							<?php $select_all_admin_from_admin_table = $this->db->get('executive')->result_array();
										foreach ($select_all_admin_from_admin_table as $key => $select_all_admin_from_admin_table):?>
								<tr>
									<td><img src="<?=base_url()?>uploads/executive_image/<?=$select_all_admin_from_admin_table['executive_id']?>" width="100" height="100"</td>
									<td><?php echo $select_all_admin_from_admin_table['name'];?></td>
									<td><?php echo $select_all_admin_from_admin_table['post'];?></td>
								
									<td>
									
									 <?php if(!(demo())){ ?>
									<a href="#" onclick="confirm_modal('<?php echo base_url();?>website/website_setting/delete_exe/<?php echo $select_all_admin_from_admin_table['executive_id'];?>');"><button type="button" class="btn btn-danger shadow-danger btn-round btn-sm"><i class="fa fa-times"></i></button></a>
									
									<?php } ?>
									</td>
								   
								   
								</tr>
										<?php endforeach;?>
							 
							</tbody>
							
						</table>
										 </section>
										
										
										
                                    </div>
                                    <!-- /content -->
                                </div>
                                <!-- /tabs -->
                            </section>
            </div>
        </div>
    </div>
</div>