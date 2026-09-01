<?php include "css.php";?>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
    <div class="kingster-mobile-header-wrap">
        <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation " id="kingster-mobile-header">
            <div class="kingster-mobile-header-container kingster-container clearfix">
			
                 <?php include "logo.php";?>
                <div class="kingster-mobile-menu-right">
					
                   <?php include "search.php";?>
                        <?php include "mobile.php";?>
					

                </div>
            </div>
        </div>
    </div>
	
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
		
			
             <?php include "top.php";?>
			 <?php include "header.php";?>



            <div class="kingster-page-title-wrap  kingster-style-medium kingster-left-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title"><?=get_phrase('gallery')?></h1></div>
                </div>
            </div>
			
			
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-wrapper ">
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-event-item gdlr-core-item-pdb">
										
										<div class="gdlr-core-event-item-holder clearfix">
                                            
			
											
											<?php
												  $this->db->order_by('gallery_id', 'RANDOM');
												  $query = $this->db->get('gallery', $per_page, $this->uri->segment(3));
												  $select = $query->result_array();
												   foreach ($select as $row) {
											?>
											
											
                                         
                                            <div class="gdlr-core-event-item-list gdlr-core-style-grid gdlr-core-item-pdlr gdlr-core-column-20  clearfix" style="margin-bottom: 45px ;">
                                                <div class="gdlr-core-event-item-thumbnail">
												<style>
													#size{
													width:400!important;
													size:257 !important;
													}
												</style>
                                                    <a href="<?=base_url().'uploads/gallery_image/'.$row['gallery_id'].'.jpg'?>" data-lightbox-group="gdlr-core-img-group-1" class="gdlr-core-lightgallery gdlr-core-js" ><img src="<?=base_url().'uploads/gallery_image/'.$row['gallery_id'].'.jpg'?>" id="size"></a>
                                                </div>
                                                <div class="gdlr-core-event-item-content-wrap">
                                                    <h3 class="gdlr-core-event-item-title"><a href="<?=base_url().'gallery/details/'.$row['gallery_id'];?>" ><?=substr($row['name'], 0,30)?>...</a></h3>
                                                    <div class="gdlr-core-event-item-info-wrap"><span class="gdlr-core-event-item-info gdlr-core-type-time"><span class="gdlr-core-head" ><i class="icon_clock_alt" ></i></span><span class="gdlr-core-tail"><?=$row['date']?></span></span>
                                                    </div>
                                                </div>
                                            </div>
											
											<?php } ?>
											
									
											
											
											
											
											
                                        </div>
										
										
										
											
											
												<?php echo $this->pagination->create_links(); ?>
												
                                         
											
											
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <?php include "footer.php";?>
        </div>
    </div>


	<?php include "javascript.php";?>