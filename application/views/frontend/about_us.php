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
                        <h1 class="kingster-page-title"><?=get_phrase('about_us')?></h1></div>
                </div>
            </div>
			
			<div class="kingster-content-container kingster-container">
                    <div class=" kingster-sidebar-wrap clearfix kingster-line-height-0 kingster-sidebar-style-none">
                        <div class=" kingster-sidebar-center kingster-column-60 kingster-line-height">
                            <div class="kingster-content-wrap kingster-item-pdlr clearfix">
                                <div class="kingster-content-area">
                                    <article id="post-1268" class="post-1268 post type-post status-publish format-standard has-post-thumbnail hentry category-blog category-post-format tag-news">
                                        <div class="kingster-single-article clearfix">
                                            <div class="kingster-single-article-content">
                                                
												<p align="justify">
													<?=$this->db->get_where('about', array('id' => '1'))->row()->title;?>
												</p>
                                                
                                            </div>
                                        </div>
                                    </article>
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