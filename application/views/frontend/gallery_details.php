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


											<?php
												$nameTitle = $this->db->get_where('gallery' , array('gallery_id' => $gallery_id))->row();
											?>
            <div class="kingster-page-title-wrap  kingster-style-medium kingster-left-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title"><?=$nameTitle->name;?></h1></div>
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
										
										
										
										<div class="kingster-single-article-head-right">
                                    <div class="kingster-blog-info-wrapper">
                                        <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-author vcard author post-author "><span class="fn"><a href="<?=base_url()?>" title="Go back home" rel="author"><?=get_phrase('home')?></a></span></div>
                                        <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-category "><a href="<?=base_url()?>gallery" rel="tag"><?=get_phrase('list_gallery')?></a><span class="gdlr-core-sep"></span> </div>
                                    </div>
                                </div>	
                                            
										
								
								<div class="gdlr-core-pbf-wrapper " style="padding: 100px 20px 30px 20px;">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" style="padding-bottom: 60px ;">
                                        <div class="gdlr-core-title-item-title-wrap clearfix">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="text-transform: none ;">
											
											<?=$nameTitle->name;?>
											</h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption">
											<?=$nameTitle->content;?>
											</span></div>
                                </div>

                                <div class="gdlr-core-pbf-element">
								
								
                                    <div class="gdlr-core-gallery-item gdlr-core-item-pdb clearfix  gdlr-core-gallery-item-style-grid">
                                        <div class="gdlr-core-gallery-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                            

											<?php foreach ($gallery_details as $row3) { ?>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-15 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image">
                                                    <a class="gdlr-core-lightgallery gdlr-core-js " href="<?php echo base_url(); ?>uploads/gallery_image/gallery_images/<?php echo $row3['imageArray'];?>" data-lightbox-group="gdlr-core-img-group-1"><img src="<?php echo base_url(); ?>uploads/gallery_image/gallery_images/<?php echo $row3['imageArray'];?>" width="700" height="660" alt="" /><span class="gdlr-core-image-overlay "><i class="gdlr-core-image-overlay-icon gdlr-core-size-22 fa fa-search"  ></i></span></a>
                                                </div>
                                            </div>
											<?php } ?>
											
											
											
											
                                    
                                           
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
								
								
								
								
			
							
							
							
                        
											
											
                                        </div>
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