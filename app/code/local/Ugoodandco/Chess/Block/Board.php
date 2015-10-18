<?php

class Ugoodandco_Chess_Block_Board extends Mage_Core_Block_Template{
    
    
    public function getBoard(){
        $board = Mage::getModel('goodchess/board')->getBoard();
        return $board;
    }

}