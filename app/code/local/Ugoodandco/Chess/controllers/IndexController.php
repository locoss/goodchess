<?php
class Ugoodandco_Chess_IndexController extends Mage_Core_Controller_Front_Action{
    
    
    public function indexAction(){
         $this->loadLayout();
         $this->renderLayout();
     }
     
     public function testAction(){
         $beaten = Mage::helper('goodchess')->searchBeaten(2, 1, 4, 3);
         var_dump($beaten);
     }
     
     public function startAction(){
         $board = Mage::getSingleton('core/session')->getChessBoard();
         $elements = Mage::getSingleton('goodchess/board')->setElements($board);
         $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($elements));
         return $elements;
     }
     
    public function setStepAction(){
        if($data = $this->getRequest()->getParams()){
            $data = Mage::getModel('goodchess/board')->makeStep($data);
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
            return $data;
        }

    }
             
}