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
                        <h1 class="kingster-page-title"><?=$news_details->title?></h1></div>
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
                                        <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-category "><a href="<?=base_url()?>blog" rel="tag"><?=get_phrase('list_news')?></a><span class="gdlr-core-sep"></span> </div>
                                    </div>
                                </div>	
			<div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-sidebar-wrapper ">
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-40 gdlr-core-pbf-sidebar-padding gdlr-core-line-height gdlr-core-column-extend-left" style="padding: 60px 10px 30px 0px;">
                                <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7 ;"></div>
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                                <div class="gdlr-core-item-list gdlr-core-blog-full  gdlr-core-item-mglr gdlr-core-style-left">
                                                    <div class="gdlr-core-blog-thumbnail gdlr-core-media-image  gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                        <a href="#"><img src="<?=base_url()?>uploads/news/<?=$news_details->news_id?>.jpg" width="900" height="500"  alt="" />
                                                            <div class="gdlr-core-sticky-banner gdlr-core-title-font"><i class="fa fa-bolt"></i><?=get_phrase('reading_news')?></div>
                                                        </a>
                                                    </div>
													
                                                    <div class="gdlr-core-blog-full-frame gdlr-core-skin-e-background">
                                                        <div class="gdlr-core-blog-full-head clearfix">
                                                            <div class="gdlr-core-blog-full-head-right">
                                                                <h3 class="gdlr-core-blog-title gdlr-core-skin-title" style="font-size: 33px ;font-weight: 700 ;letter-spacing: 0px ;"><a href="#" ><?=$news_details->title?></a></h3>
                                                                <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider"><span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date"><a href="#"><?=date('d, M Y', $news_details->timestamp)?></a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="gdlr-core-blog-content"><?=$news_details->description?></div>
                                                    </div>
                                                </div>
												
												
                                               
                                            </div>
                                            <!-- <div class="gdlr-core-pagination  gdlr-core-style-round gdlr-core-left-align gdlr-core-item-pdlr"><span aria-current='page' class='page-numbers current'>1</span> <a class='page-numbers' href='page/2/index.html'>2</a> <a class='page-numbers' href='page/3/index.html'>3</a>
                                                <a class="next page-numbers" href="page/2/index.html"></a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-right gdlr-core-column-extend-right  kingster-sidebar-area gdlr-core-column-20 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7 ;"></div>
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
									
                                    <div id="gdlr-core-recent-post-widget-1" class="widget widget_gdlr-core-recent-post-widget kingster-widget">
                                        <h3 class="kingster-widget-title"><?=get_phrase('recent_news')?></h3><span class="clear"></span>
                                        <div class="gdlr-core-recent-post-widget-wrap gdlr-core-style-1">
                                            
                                            
                                        <?php 
										$sql = "select * from news order by rand() desc limit 20";
										$query = $this->db->query($sql)->result_array();
										foreach ($query as $row) { ?>
                                            <div class="gdlr-core-recent-post-widget clearfix">
                                                <div class="gdlr-core-recent-post-widget-thumbnail gdlr-core-media-image"><img src="<?=base_url()?>uploads/news/<?=$row['news_id']?>.jpg" alt="" width="150" height="150" title="<?=$row['title']?>" /></div>
                                                <div class="gdlr-core-recent-post-widget-content">
                                                    <div class="gdlr-core-recent-post-widget-title"><a href="<?=base_url().'blog/details/'.$row['slug']?>"><?=$row['title']?></a></div>
                                                    <div class="gdlr-core-recent-post-widget-info"><span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date"><a href="#"><?=date('d, M Y', $row['timestamp'])?></a></span><span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-author"><span class="gdlr-core-head" >By</span><a href="#" title="Posts by John Smith" rel="author">John Smith</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>


                                        </div>
                                    </div>
                                    
                                    <!-- <div id="tag_cloud-1" class="widget widget_tag_cloud kingster-widget">
                                        <h3 class="kingster-widget-title">Tag Cloud</h3><span class="clear"></span>
                                        
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link tag-link-7 tag-link-position-1" style="font-size: 12.2pt;" aria-label="Admission (2 items)">Admission</a>
                                            <a href="#" class="tag-cloud-link tag-link-5 tag-link-position-2" style="font-size: 8pt;" aria-label="Article (1 item)">Article</a>
                                            <a href="#" class="tag-cloud-link tag-link-14 tag-link-position-3" style="font-size: 12.2pt;" aria-label="Event (2 items)">Event</a>
                                            <a href="#" class="tag-cloud-link tag-link-103 tag-link-position-4" style="font-size: 8pt;" aria-label="Hot (1 item)">Hot</a>
                                            <a href="#" class="tag-cloud-link tag-link-10 tag-link-position-5" style="font-size: 12.2pt;" aria-label="News (2 items)">News</a>
                                            <a href="#" class="tag-cloud-link tag-link-12 tag-link-position-6" style="font-size: 22pt;" aria-label="Post Format (7 items)">Post Format</a>
                                            <a href="#" class="tag-cloud-link tag-link-6 tag-link-position-7" style="font-size: 15pt;" aria-label="Research (3 items)">Research</a>
                                            <a href="#" class="tag-cloud-link tag-link-9 tag-link-position-8" style="font-size: 8pt;" aria-label="Social (1 item)">Social</a>
                                            <a href="#" class="tag-cloud-link tag-link-13 tag-link-position-9" style="font-size: 8pt;" aria-label="Sport (1 item)">Sport</a>
                                            <a href="#" class="tag-cloud-link tag-link-8 tag-link-position-10" style="font-size: 12.2pt;" aria-label="Student (2 items)">Student</a>
                                            <a href="#" class="tag-cloud-link tag-link-11 tag-link-position-11" style="font-size: 12.2pt;" aria-label="Updates (2 items)">Updates</a>
                                        </div>
                                    </div> -->

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