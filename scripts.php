<?php
    if($embedded) {  
        class Video {
            private $name;
            private $href;
            
            public function __construct($input_id, $input_href) {
                $this->id = $input_id;
                $this->href = $input_href;
                echo '<video id="'.$this->id.'" autoplay loop muted>';
                echo 'Your browser does not support the video tag.';
                echo '<source src="'.$this->href.'" type="video/mp4">'; 
                echo '</video>';
                echo '<script>document.getElementById("'.$this->id.'").style.display="none"</script>';  
            }
        
            public function enable() {
                echo '<script>document.getElementById("'.$this->id.'").style.display=""</script>';   
            }
            
            public function disable() {
                echo '<script>document.getElementById("'.$this->id.'").style.display="none"</script>';   
            }
        }
        
        
        
        class Link {
        
            public function __construct($input_id, $input_width, $input_height, $input_x, $input_y, $input_actions) {
                ?>
                <style> 
                    #<?php echo $input_id; ?>{
                        background:blue;
                        position:absolute;
                        cursor:pointer;
                        transform: translate(-50%, -50%);
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
                <div id="<?php echo $input_id; ?>" onclick="<?php echo $input_id; ?>Execute()"></div>
                
                <script>
                function <?php echo $input_id; ?>Execute(){

                    <?php
                    echo $input_actions->getActions();
                    ?>
  
                }
                </script>

            
             <?php
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
                $this->action = "document.getElementById('".$input_target."').".$input_command.";";    
            }
            
            public function print() {
                echo $this->action."\n"; 
            }
        }
        
        
        
        class Page {

            public $id;
            public $links = array();
            public $content = array();
            
            public function __construct($input_name) {
                $this->name = $input_name;
            }
            
            public function addLink($input_link) {
                $this->links[] = $input_link;
                
            }
            
            public function addContent($input_content) {
                $this->content[] = $input_content;
            }
            
          
            
        
        } 
        
        
        
        ?>
        <script>
          //video = document.getElementById('main01');
          //document.getElementById('video_main').style.display = 'none';
          //source = document.getElementById('source');
          //<video onclick="this.paused? this.play() : this.pause()">
          
          
          //function PlayVideo(){
         // document.getElementById('main01').pause();
          //document.getElementById("main01").style.display="none";
         // document.getElementById("test01").style.display="";
            //video.pause();
            //video.style.display = 'none';
            //video.load();
            //video.play();
         // }
          
        </script>

    <?php
    }
?>