<?php
    if($embedded) { 
    
        class Videos {
            private $videos = array();
            public function __construct($input_id, $input_videos) {
                $this->videos = $input_videos;    
            }
            public function getVideo($input_id) {
                return $this->videos[array_search($input_id, $this->getIDs())];
            }
            
            public function getIDs() {
                $ids = array();
                for($i = 0; $i < count($this->videos); $i++) {
                    $ids[] = $this->videos[$i]->getID();
                }
                return $ids;
            }
        } 
        
        
        class Video {
            private $id;
            private $href;
            private $active = false;
            
            public function __construct($input_id, $input_href, $input_loop) {
                $this->id = $input_id;
                $this->href = $input_href;
                
                // Create Video
                echo '<video id="'.$this->id.'" preload="auto" muted';
                if($input_loop == 1) {
                    echo ' loop ';
                }
                echo '>';
                echo 'Your browser does not support the video tag.';
                echo '<source src="'.$this->href.'" type="video/mp4">'; 
                echo '</video>';
                echo '<script>document.getElementById("'.$this->id.'").style.display="none"</script>';  
            }
            
            public function onEnd($input_parent, $input_ended, $input_area) {
                // Ended functionality
                if($input_ended != "") {
                    echo '<script type="text/javascript">';
                    echo 'document.getElementById("'.$this->id.'").addEventListener("ended",onEnd'.$this->id.',false);';
                    echo 'function onEnd'.$this->id.'(e) {';
                    (new Actions([$this->disable()]))->getActions();
                    echo "active = ".json_encode($input_ended).";";
                    (new Actions([$input_parent->loadArea($input_area)]))->getActions();
                    echo 'document.getElementById("'.$input_ended.'").style.display="";';
                    echo 'document.getElementById("'.$input_ended.'").play()';
                    echo '}';
                    echo '</script>';
                }
            }
            
             public function onStart($input_parent, $input_start) {
                // Started functionality
                if($input_start != "") {
                    echo '<script type="text/javascript">';
                    echo 'document.getElementById("'.$this->id.'").addEventListener("play",onStart'.$this->id.',false);';
                    echo 'function onStart'.$this->id.'(e) {';
                    if ($input_start[0] == "displayTarget") {
                       echo 'document.getElementById(target).style.display="";'; 
                       
                    } else {
                        echo 'document.getElementById("'.$input_start[0].'").style.display="";';
                    }
                    echo '}';
                    echo '</script>';
                }
            }
            
            public function getID() {
                return $this->id;
            }
           
        
            public function load() {
                echo '<script>document.getElementById("'.$this->id.'").play()</script>'; 
                echo '<script>document.getElementById("'.$this->id.'").style.display=""</script>';
                echo "<script>active = ".json_encode($this->id).";</script>";   
            }
        
            public function enable() {
                return new Action([$this->id,$this->id,$this->id,"pause_button","play_button"],["setActive","play()", "style.display = ''","style.display = ''","style.display = 'none'"]);
            }
            
            public function disable() {
                return new Action([$this->id,$this->id,$this->id],["pause()","currentTime = 0" , "style.display = 'none'"]);
            }
            
        }
        
        
        
        class Content {
            public $id;
            public $content; 
            public function __construct($input_id, $input_width, $input_height, $input_x, $input_y, $input_visible, $input_content) {
                $this->id = $input_id;
                $this->content = $input_content
                ?>
                <style> 
                    #<?php echo $input_id; ?>{
                        background-color: #000D;
                        border-radius: 0.2em;
                        position:absolute;
                        transform: translate(-50%, -50%);
                        font-size: 50px;
                        color: white;
                        padding: 10px;
                    }
              
                    @media screen and (max-aspect-ratio: 1920/1080) {
                        #<?php echo $input_id; ?>{
                            top:calc(50% + calc(<?php echo $input_y; ?>vw * 0.5625));
                            left:calc(50% + calc(<?php echo $input_x; ?>vw * 0.5625));
                            height:calc(<?php echo $input_height; ?>vw * 0.5625);
                            width:calc(<?php echo $input_width; ?>vw * 0.5625);
                        }
                    }
                    
                    @media screen and (min-aspect-ratio: 1920/1080) {
                        #<?php echo $input_id; ?>{
                            top:calc(50% + <?php echo $input_y; ?>vh);
                            left:calc(50% + <?php echo $input_x; ?>vh);
                            height:<?php echo $input_height; ?>vh;
                            width:<?php echo $input_width; ?>vh;
                        }
                    }
                </style>
                
                <div id="<?php echo $input_id; ?>"  
                            <?php if(!$input_visible) { ?>
                            style="display: none;"
                        <?php 
                        } 
                        echo ">".$input_content."</div>";

            }
            
            public function getID() {
                return $this->id;
            }
        }
        
        
        
        class Link {
            public $id;
            public $defaultVisible;
            public $area;
            public function __construct($input_area, $input_id, $input_text, $input_opacity, $input_image, $input_matrix, $input_width, $input_height, $input_x, $input_y, $input_visible) {
                $this->id = $input_id;
                $this->defaultVisible = $input_visible;
                $this->area = $input_area;
                ?>
                <style> 
                    #<?php echo $input_id; ?>{
                        background-image: url("<?php echo $input_image; ?>");
                        background-size: cover;
                        opacity: <?php echo $input_opacity; ?>;
                        position:absolute;
                        cursor:pointer;
                        transform: translate(-50%, -50%);
                        color: white;
                        transform:<?php echo $input_matrix; ?>;
                        
                    }
              
                    @media screen and (max-aspect-ratio: 1920/1080) {
                        #<?php echo $input_id; ?>{
                            top:calc(50% + calc(<?php echo $input_y; ?>vw * 0.5625));
                            left:calc(50% + calc(<?php echo $input_x; ?>vw * 0.5625));
                            height:calc(<?php echo $input_height; ?>vw * 0.5625);
                            width:calc(<?php echo $input_width; ?>vw * 0.5625);
                            font-size: calc(5vw * 0.5625);
                        }
                    }
                    
                    @media screen and (min-aspect-ratio: 1920/1080) {
                        #<?php echo $input_id; ?>{
                            top:calc(50% + <?php echo $input_y; ?>vh);
                            left:calc(50% + <?php echo $input_x; ?>vh);
                            height:<?php echo $input_height; ?>vh;
                            width:<?php echo $input_width; ?>vh;
                            font-size: 5vh;
                        }
                    }
                </style>
                <?php
                echo '<div id="'.$input_id.'" onclick="'.$input_id.'Execute()"';  
                if(!$input_visible || $this->area != 0) {
                    echo 'style="display: none;"';
                }
                echo '>';
                echo $input_text;
                echo '</div>';  
            }
            
            public function getVisible() {
                return $this->defaultVisible;
            }
            
            public function addActions($input_actions) {
                ?>
                <script>
                function <?php echo $this->id; ?>Execute(){

                    <?php
                    echo $input_actions->getActions();
                    ?>
  
                }
                </script>
            
             <?php
            }
            
            public function getID() {
                return $this->id;
            }
        }
        
        class Actions {
            private $actions = array();
            public function __construct($input_actions) { 
                $this->actions = $input_actions;
            }
            
            public function getActions() {
                 for($i = 0; $i < count($this->actions); $i++) {
                    $this->actions[$i]->print();
                }
            }
        }
        
        class Action {
            private $action;
            public function __construct($input_target, $input_command) {
                if(is_array($input_target)) {
                    for($i = 0; $i < count($input_target); $i++) {
                        if($input_target[$i] == "activeVideo") {
                            $this->action .= "document.getElementById(active).".$input_command[$i].";\n";
                        } elseif ($input_command[$i] == "setActive") {
                            $this->action .= "active = ".json_encode($input_target[$i]).";\n";
                        } elseif ($input_command[$i] == "setTarget") {
                            $this->action .= "target = ".json_encode($input_target[$i]).";\n"; 
                        } else {
                            $this->action .= "document.getElementById('".$input_target[$i]."').".$input_command[$i].";\n";
                        }
                    }
                } else {
                    if($input_target == "activeVideo") {
                        $this->action .= "document.getElementById(active).".$input_command.";";
                    } elseif ($input_command == "setActive") {
                            $this->action = "active = ".json_encode($input_target).";"; 
                    } elseif ($input_command == "setTarget") {
                            $this->action = "target = ".json_encode($input_target).";";
                    } else {
                        $this->action = "document.getElementById('".$input_target."').".$input_command.";";
                    } 
                }   
            }
            
            public function print() {
                echo $this->action."\n"; 
            }
        }
        
        
        
        class Page {

            public $id;
            public $areas = array();
            public $links = array();
            public $content = array();
            
            public function __construct($input_id, $input_areas) {
                $this->id = $input_id;
                $this->areas = $input_areas;
            }
            
            public function addLink($input_link) {
                $this->links[] = $input_link;
            }
            
            public function getLink($input_id) {
                return $this->links[array_search($input_id, $this->getIDs())];
            }
            
            public function getIDs() {
                $ids = array();
                for($i = 0; $i < count($this->links); $i++) {
                    $ids[] = $this->links[$i]->getID();
                }
                return $ids;
            }
            
            public function addContent($input_content) {
                $this->content[] = $input_content;
            }
            
            public function unloadArea($input_id) { 
                $ids = array();
                $commands = array();
                //unload Links
                for($i = 0; $i < count($this->areas[$input_id]->links); $i++) {
                   $ids[] = $this->areas[$input_id]->links[$i]->getID();
                   $commands[] = "style.display = 'none'";
                }
                //unload Content
                for($i = 0; $i < count($this->areas[$input_id]->content); $i++) {
                   $ids[] = $this->areas[$input_id]->content[$i]->getID();
                   $commands[] = "style.display = 'none'";
                }
                return new Action($ids, $commands);
            }
            
            public function loadArea($input_id) { 
                $ids = array();
                $commands = array();
                //load Links
                for($i = 0; $i < count($this->areas[$input_id]->links); $i++) {
                    if($this->areas[$input_id]->links[$i]->getVisible()) {
                        $ids[] = $this->areas[$input_id]->links[$i]->getID();
                        $commands[] = "style.display = ''";
                    }
                }
                return new Action($ids, $commands);
            }

            public function loadContent($input_content) {
                $ids = array();
                $commands = array();
                for($i = 0; $i < count($this->content); $i++) {
                   $ids[] = $this->content[$i]->getID();
                   $commands[] = "style.display = 'none'";   
                }
                $ids[] = $input_content;
                $commands[] = "style.display = ''";
                return new Action($ids, $commands);
            }
            
            public function unloadContent($input_content) {
                $ids = array();
                $commands = array();
                for($i = 0; $i < count($this->content); $i++) {
                   $ids[] = $this->content[$i]->getID();
                   $commands[] = "style.display = 'none'";   
                }
                $ids[] = $input_content;
                $commands[] = "style.display = 'none'";
                return new Action($ids, $commands);
            }
            
            public function getArea($input_id) {
                return $this->areas[$input_id];
            }
        } 
        
        
        class Area extends Page {
        
            public $id;
            
            public function __construct($input_id) {
                $this->id = $input_id;
            }
        }
        

    }
?>