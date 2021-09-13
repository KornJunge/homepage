<?php
    if($embedded) {  
        echo "<script>var active = 'main01';
                      var target = 'left_page_content_01';</script>";
    
        $landscape = new Page("landscape",
                     [new Area("landscape_main"),
                     new Area("landscape_left"),
                     new Area("landscape_right")]);
        /*$portrait = new Page("portrait",
                     [new Area("portrait_main"),
                     new Area("portrait_left"),
                     new Area("portrait_right")]);    */

        echo '<div class="video-container">'; 
        
        
        
        
        $landscape_videos = new Videos("landscape_videos",[ 
                    new Video("main", "content/homepage_main_loop.mp4", 1),
                    new Video("links_nach", "content/homepage_links_nach.mp4", 0),
                    new Video("links", "content/homepage_links.mp4", 1),
                    new Video("links_von", "content/homepage_links_von.mp4", 0),
                    new Video("rechts_nach", "content/homepage_rechts_nach.mp4", 0),
                    new Video("rechts", "content/homepage_rechts.mp4", 1),
                    new Video("rechts_von", "content/homepage_rechts_von.mp4", 0),
                    ]);
                    
        $landscape_videos->getVideo("main")->load();
        
        
        
        
        
        $landscape->getArea(0)->addContent(new Content("main_page_content_01", 100, 70, 30, -5, 0, "Zeitraffer"));
        $landscape->getArea(0)->addContent(new Content("main_page_content_02", 100, 70, 30, -5, 0, "Fotos"));
        
        $landscape->getArea(1)->addContent(new Content("left_page_content_01", 110, 75, 20, -5, 0, "Kontakt"));
        $landscape->getArea(1)->addContent(new Content("left_page_content_02", 110, 75, 20, -5, 0, "Impressum"));
        
        $landscape->getArea(2)->addContent(new Content("right_page_content_01", 120, 75, 10, 0, 0, "Service"));
        $landscape->getArea(2)->addContent(new Content("right_page_content_02", 120, 75, 10, 0, 0, "&Uuml;ber mich"));
        // "Ich habe ein Pupsgesicht :-*"
        $landscape->addLink(new Link(0,"pause_button", false, 0.2, "content/pause.gif", false, 8, 8, 0, 45, 1));
        $landscape->addLink(new Link(0,"play_button", false, 0.2, "content/play.gif", false, 8, 8, 0, 45, 0));
        
        $landscape->getArea(0)->addLink(new Link(0, "right_content01", "Service", 0.6, false, "matrix(1, 0, 0, 1, 0, 0)", 16, 6, -53, -24.4, 1));
        $landscape->getArea(0)->addLink(new Link(0, "right_content02", "&Uuml;ber mich", 0.6, false, "matrix(1, 0, 0, 1, 0, 0)", 22, 6, -53, -18.1, 1));
        $landscape->getArea(0)->addLink(new Link(0, "main_content01_on", "Zeitraffer", 0.6, false, "matrix(1, 0.18, 0, 1, 0, 0)", 16, 6, -76, -39.5, 1));
        $landscape->getArea(0)->addLink(new Link(0, "main_content01_off", "Zeitraffer", 0.6, false, "matrix(1, 0.18, 0, 1, 0, 0)", 16, 6, -76, -39.5, 0));
        $landscape->getArea(0)->addLink(new Link(0, "main_content02_on", "Fotos", 0.6, false, "matrix(1, 0.18, 0, 1, 0, 0)", 16, 6, -76, -33, 1));
        $landscape->getArea(0)->addLink(new Link(0, "main_content02_off", "Fotos", 0.6, false, "matrix(1, 0.18, 0, 1, 0, 0)", 16, 6, -76, -33, 0));
        $landscape->getArea(0)->addLink(new Link(0, "left_content01", "Kontakt", 0.6, false, "matrix(1, 0.01, 0, 1, 0, 0)", 16, 6, -79, -25, 1));
        $landscape->getArea(0)->addLink(new Link(0, "left_content02", "Impressum", 0.6, false, "matrix(1, 0.01, 0, 1, 0, 0)", 16, 6, -79, -18.5, 1));
        
        $landscape->getArea(1)->addLink(new Link(1, "left_link01", false, 0.2, "content/zurueck.gif", false, 8, 8, 80, 45, 1));
        
        $landscape->getArea(2)->addLink(new Link(2, "right_link01", false, 0.2, "content/zurueck_inverted.gif", false, 8, 8, -80, 45, 1));
        
        
        
        
        $landscape_videos->getVideo("links_nach")->onEnd($landscape, "links", 1);
        $landscape_videos->getVideo("links_von")->onEnd($landscape, "main", 0);
        $landscape_videos->getVideo("rechts_nach")->onEnd($landscape, "rechts", 2);
        $landscape_videos->getVideo("rechts_von")->onEnd($landscape, "main", 0);
        
        $landscape_videos->getVideo("links")->onStart($landscape, ["displayTarget"]);
        $landscape_videos->getVideo("rechts")->onStart($landscape, ["displayTarget"]);
        
        
        $landscape->getLink("pause_button")->addActions(new Actions([
                            new Action("activeVideo","pause()"),   
                            new Action("pause_button","style.display = 'none'"),
                            new Action("play_button","style.display = ''"),
                            ])); 
        
        $landscape->getLink("play_button")->addActions(new Actions([
                            new Action("activeVideo","play()"),
                            new Action("pause_button","style.display = ''"), 
                            new Action("play_button","style.display = 'none'"),
                            ])); 
                            

                            
        $landscape->getArea(0)->getLink("main_content01_on")->addActions(new Actions([
                            $landscape->loadContent("main_page_content_01"),
                            $landscape->unloadContent("main_page_content_02"),
                            new Action("main_content02_off","style.display = 'none'"),
                            new Action("main_content02_on","style.display = ''"), 
                            new Action("main_content01_on","style.display = 'none'"),
                            new Action("main_content01_off","style.display = ''"),  
                            ]));
                            
        $landscape->getArea(0)->getLink("main_content01_off")->addActions(new Actions([
                            $landscape->unloadContent("main_page_content_01"),
                            new Action("main_content01_off","style.display = 'none'"),
                            new Action("main_content01_on","style.display = ''"),  
                            ]));
                            
        $landscape->getArea(0)->getLink("main_content02_on")->addActions(new Actions([
                            $landscape->unloadContent("main_page_content_01"),
                            $landscape->loadContent("main_page_content_02"),
                            new Action("main_content01_off","style.display = 'none'"),
                            new Action("main_content01_on","style.display = ''"), 
                            new Action("main_content02_on","style.display = 'none'"),
                            new Action("main_content02_off","style.display = ''"),  
                            ]));
                            
        $landscape->getArea(0)->getLink("main_content02_off")->addActions(new Actions([
                            $landscape->unloadContent("main_page_content_02"),
                            new Action("main_content02_off","style.display = 'none'"),
                            new Action("main_content02_on","style.display = ''"),  
                            ]));
        
        $landscape->getArea(0)->getLink("left_content01")->addActions(new Actions([
                            $landscape->unloadArea(0),
                            new Action("left_page_content_01","setTarget"),
                            $landscape_videos->getVideo("main")->disable(),
                            $landscape_videos->getVideo("links_nach")->enable(),  
                            ]));
                            
        $landscape->getArea(0)->getLink("left_content02")->addActions(new Actions([
                            $landscape->unloadArea(0),
                            new Action("left_page_content_02","setTarget"),
                            $landscape_videos->getVideo("main")->disable(),
                            $landscape_videos->getVideo("links_nach")->enable(),  
                            ]));
                            
        $landscape->getArea(0)->getLink("right_content01")->addActions(new Actions([
                            $landscape->unloadArea(0),
                            new Action("right_page_content_01","setTarget"),
                            $landscape_videos->getVideo("main")->disable(),
                            $landscape_videos->getVideo("rechts_nach")->enable(),  
                            ]));
                            
        $landscape->getArea(0)->getLink("right_content02")->addActions(new Actions([
                            $landscape->unloadArea(0),
                            new Action("right_page_content_02","setTarget"),
                            $landscape_videos->getVideo("main")->disable(),
                            $landscape_videos->getVideo("rechts_nach")->enable(),  
                            ]));
                            
        $landscape->getArea(1)->getLink("left_link01")->addActions(new Actions([
                            $landscape->unloadArea(1),
                            $landscape_videos->getVideo("links")->disable(),
                            $landscape_videos->getVideo("links_von")->enable(),
                            ]));
                            
        $landscape->getArea(2)->getLink("right_link01")->addActions(new Actions([
                            $landscape->unloadArea(2),
                            $landscape_videos->getVideo("rechts")->disable(),
                            $landscape_videos->getVideo("rechts_von")->enable(), 
                            ]));       
                                                  
        echo '</div>';
    }
?>