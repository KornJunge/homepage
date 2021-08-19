<?php
    if($embedded) {  
    
    
        $page_main = new Page("main");
        $page_test = new Page("test");
        
        
        echo '<div class="video-container">';
        $videos = [ new Video("main01", "content/Untitled.mp4"), 
                    new Video("test01", "content/Untitled2.mp4")
                    ];
                    
        $videos[0]->enable();
        $page_main->addLink(new Link("main_link01", 16, 9, 20, 20,
                            new Actions([
                            new Action("main01","style.display = 'none'"),
                            new Action("test01","style.display = ''")
                            ])));
        $page_main->addLink(new Link("test_link01", 16, 9, 40, 40,
                            new Actions([
                            new Action("main01","style.display = ''"),
                            new Action("test01","style.display = 'none'")
                            ])));        
        ?>
             
        
        </div>
        
       

    <?php
    }
?>