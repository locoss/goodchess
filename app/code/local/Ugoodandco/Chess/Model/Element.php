<?php
class Ugoodandco_Chess_Model_Element {
    
    protected $type;
    protected $supermode;
    protected $active;
    protected $position;
    protected $image;
    //public $steps;
    
    public function __construct() {
        $this->supermode = false;
        $this->active = false;
    }
    
    public function setSuperMode(){
        $this->supermode = true;
    }
    
    public function getMode(){
        return $this->supermode;
    }
    
    public function setWhite(){
        $this->type = 'w';
        $this->image = Mage::getUrl('media') . 'chess' .DS. 'white.png';
    }
    
    public function setBlack(){
        $this->type = 'b';
        $this->image = Mage::getUrl('media') . 'chess' .DS. 'black.png';
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setActive(){
        if($this->supermode && $this->type){
            $this->active = true;
        }
    }
    
    public function isActive(){
        return $this->active;
    }
    
    public function setPosition($position){
        $this->position = $position;
    }
    
    public function getPosition(){
        return $this->position;
    }
    
    public function getImage(){
        return $this->image;
    }
    
   /* public function analyzeSteps(){
        $current_position = $this->position;
        $super_mode = $this->getMode();
        Mage::getSingleton('core/session')->getChessElements();
        if(!$super_mode){
            
        }
    }*/
    
}