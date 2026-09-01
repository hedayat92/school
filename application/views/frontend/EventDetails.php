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
			



            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="kingster-blog-title-wrap  kingster-style-custom kingster-feature-image" style="background-image: url(<?=base_url()?>uploads/about/blog.jpg) ;">
                    <div class="kingster-header-transparent-substitute"></div>
                    <div class="kingster-blog-title-overlay" style="opacity: 0.01 ;"></div>
                    <div class="kingster-blog-title-bottom-overlay"></div>
                    <div class="kingster-blog-title-container kingster-container">
                        <div class="kingster-blog-title-content kingster-item-pdlr" style="padding-top: 400px ;padding-bottom: 80px ;">
                            <header class="kingster-single-article-head clearfix">
                                <div class="kingster-single-article-date-wrapper  post-date updated">
                                    <div class="kingster-single-article-date-day"><?=date('d',$event_details->timestamp)?></div>
                                    <div class="kingster-single-article-date-month"><?=date('M',$event_details->timestamp)?></div>
                                </div>
                                
								<div class="kingster-single-article-head-right">
                                    <h1 class="kingster-single-article-title"><?=substr($event_details->title,0,50)?>...</h1>
                                    <div class="kingster-blog-info-wrapper">
                                        <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-author vcard author post-author "><span class="fn"><a href="<?=base_url()?>" title="Go back home" rel="author"><?=get_phrase('home')?></a></span></div>
                                        <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-category "><a href="<?=base_url()?>event" rel="tag"><?=get_phrase('event')?></a><span class="gdlr-core-sep"></span> </div>
                                    </div>
                                </div>
								
                            </header>
                        </div>
                    </div>
                </div>
                <div class="kingster-breadcrumbs">
                    <div class="kingster-breadcrumbs-container kingster-container">
                        <div class="kingster-breadcrumbs-item kingster-item-pdlr"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Kingster." href="<?=base_url()?>" class="home"><span property="name"><?=get_phrase('home')?></span></a>
                            <meta property="position" content="1">
                            </span>&gt;<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="You are reading currect event." href="#" class="taxonomy category"><span property="name"><?=get_phrase('blog')?></span></a>
                            <meta property="position" content="2">
                            </span>&gt;
                            <meta property="position" content="3">
                            </span>
                        </div>
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
                                                <p><?=$event_details->description?></p>
                                                
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