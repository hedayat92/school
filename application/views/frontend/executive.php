<?php include "css.php";?>
<style>

</style>
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
                        <h1 class="kingster-page-title"><?=get_phrase('executives')?></h1></div>
                </div>
            </div>
			
			<div class="kingster-content-container kingster-container">
                    <div class=" kingster-sidebar-wrap clearfix kingster-line-height-0 kingster-sidebar-style-none">
                        <div class=" kingster-sidebar-center kingster-column-60 kingster-line-height">
                            <div class="kingster-content-wrap kingster-item-pdlr clearfix">
                                <div class="kingster-content-area">
                                        <div class="kingster-single-article clearfix">
                                            <div class="kingster-single-article-content">
                                                
												
												<?php
												  $this->db->order_by('executive_id', 'RANDOM');
												  $query = $this->db->get('executive', $per_page, $this->uri->segment(3));
												  $select = $query->result_array();
												   foreach ($select as $row) {
												?>
											
											
                                         
                                            <div class="gdlr-core-event-item-list gdlr-core-style-grid gdlr-core-item-pdlr gdlr-core-column-20  clearfix" style="margin-bottom: 45px ;">
                                                <div class="gdlr-core-event-item-thumbnail">
												<style>
													#size{
													border-radius:20% !important;
													height:400px !important;
													
													}
												</style>
                                                    <a href="<?=base_url().'uploads/executive_image/'.$row['executive_id'].'.jpg'?>" id="size" data-lightbox-group="gdlr-core-img-group-1" class="gdlr-core-lightgallery gdlr-core-js" ><img src="<?=base_url().'uploads/executive_image/'.$row['executive_id'].'.jpg'?>" id="size"></a>
													
                                                </div>
												
												
												
                                                <div class="gdlr-core-event-item-content-wrap">
                                                    <h3 class="gdlr-core-event-item-title"><a href="" ><?=$row['name']?></a></h3>
                                                    <div class="gdlr-core-event-item-info-wrap"><span class="gdlr-core-event-item-info gdlr-core-type-time"><span class="gdlr-core-head" ></span><span class="gdlr-core-tail"><strong>Position:</strong> <?=$row['post']?></span></span>
                                                    </div>
                                                </div>
                                            </div>
											
											<?php } ?>
                                            </div>
											
                                        </div>
										<?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gdlr-core-page-builder-body"></div>

             <?php include "footer.php";?>
        </div>
    </div>


	<?php include "javascript.php";?>