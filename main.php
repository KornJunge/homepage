<?php
    if($embedded) {  
        echo "<script>var active = 'main01';</script>";
    
        $landscape = new Page("landscape",
                     [new Area("landscape_main"),
                     new Area("landscape_left"),
                     new Area("landscape_right")]);
        /*$portrait = new Page("portrait",
                     [new Area("portrait_main"),
                     new Area("portrait_left"),
                     new Area("portrait_right")]);    */

        echo '<div class="video-container">'; 
        
        
        
        
        $videos = [ new Video("main01", "content/homepage_main_loop.mp4", 1), 
                    new Video("test01", "content/Untitled2.mp4", 1),
                    new Video("links_nach", "content/homepage_links_nach.mp4", 0),
                    new Video("links", "content/homepage_links.mp4", 1),
                    new Video("links_von", "content/homepage_links_von.mp4", 0),
                    ];
                    
        $videos[0]->load();
        
        
        
        
        
        $landscape->addContent(new Content("main_page_content_01", 100, 70, 30, 0, 0, "Ich habe ein Pupsgesicht :-*"));
        
        $landscape->addLink(new Link("pause_button", false, 0.2, "content/pause.gif", false, 8, 8, 0, 45, 1));
        $landscape->addLink(new Link("play_button", false, 0.2, "content/play.gif", false, 8, 8, 0, 45, 0));
        
        $landscape->getArea(0)->addLink(new Link("main_link01", "Video 1", 0.6, false, "matrix(1, 0.01, 0, 1, 0, 0)", 16, 6, -50.5, -24.8, 1));
        $landscape->getArea(0)->addLink(new Link("test_link01", "Video 2", 0.6, false, "matrix(1, 0.01, 0, 1, 0, 0)", 16, 6, -50.5, -18.5, 1));
        $landscape->getArea(0)->addLink(new Link("main_content01_on", "Fotos", 0.6, false, "matrix(1, 0.2, 0, 1, 0, 0)", 16, 6, -75, -39.5, 1));
        $landscape->getArea(0)->addLink(new Link("main_content01_off", "Fotos", 0.6, false, "matrix(1, 0.2, 0, 1, 0, 0)", 16, 6, -75, -39.5, 0));
        $landscape->getArea(0)->addLink(new Link("left_content", "links!", 0.6, false, "matrix(1, 0.2, 0, 1, 0, 0)", 16, 6, -75, -33, 1));
        
        $landscape->getArea(1)->addLink(new Link("left_link01", "zur&uuml;ck", 0.6, false, "matrix(1, 0, 0, 1, 0, 0)", 16, 6, 40, -30.8, 0));
        
        
        
        
        $videos[2]->onEnd($landscape, "links", 1);
        $videos[4]->onEnd($landscape, "main01", 0);
        
        
        
        
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
                            
       $landscape->getArea(0)->getLink("main_link01")->addActions(new Actions([
                            $videos[0]->disable(),
                            $videos[1]->enable(),
                            new Action("pause_button","style.display = ''"),
                            new Action("play_button","style.display = 'none'"),
                            ]));
        
        $landscape->getArea(0)->getLink("test_link01")->addActions(new Actions([
                            $videos[1]->disable(),
                            $videos[0]->enable(),
                            new Action("pause_button","style.display = ''"),
                            new Action("play_button","style.display = 'none'"),
                            ]));
                            
        $landscape->getArea(0)->getLink("main_content01_on")->addActions(new Actions([
                            $landscape->loadContent("main_page_content_01"),
                            new Action("main_content01_on","style.display = 'none'"),
                            new Action("main_content01_off","style.display = ''"),  
                            ]));
                            
        $landscape->getArea(0)->getLink("main_content01_off")->addActions(new Actions([
                            $landscape->unloadContent("main_page_content_01"),
                            new Action("main_content01_off","style.display = 'none'"),
                            new Action("main_content01_on","style.display = ''"),  
                            ]));
        
        $landscape->getArea(0)->getLink("left_content")->addActions(new Actions([
                            $landscape->unloadArea(0),
                            $videos[0]->disable(),
                            $videos[2]->enable(),  
                            ]));
                            
        $landscape->getArea(1)->getLink("left_link01")->addActions(new Actions([
                            $landscape->unloadArea(1),
                            $videos[3]->disable(),
                            $videos[4]->enable(),  
                            ]));         
                                                  
        echo '</div>';
    }
?>