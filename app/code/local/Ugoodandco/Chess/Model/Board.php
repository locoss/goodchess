<?php
class Ugoodandco_Chess_Model_Board {
    public function getBoard(){
        return Mage::helper('goodchess')->getBoard();
    }
    
    public function setElements($board){
        $elements = [];
        $i = 0;
        foreach($board as $row => $cells){
            if($row < 3 || $row > 6){
                foreach($cells as $cell => $options){
                    if($options['type'] == 'b'){
                        $board[$row][$cell]['element'] = Mage::getModel('goodchess/element');
                        $board[$row][$cell]['element']->setPosition($row . $cell);
                        //$options['element'] = new Figure();
                        if($row < 3){
                            $board[$row][$cell]['element']->setWhite();
                            $board[$row][$cell]['element']->setActive(true);
                        }else{
                            $board[$row][$cell]['element']->setBlack();
                        }
                        $elements[$i]['type'] = $board[$row][$cell]['element']->getType();
                        $elements[$i]['position'] = $board[$row][$cell]['element']->getPosition();
                        $elements[$i]['image'] = $board[$row][$cell]['element']->getImage();
                        $elements[$i]['supermode'] = $board[$row][$cell]['element']->getMode();
                        //$elements[$i]['steps'] = $board[$row][$cell]['element']->analyzeSteps();
                        $elements_objects[] = $board[$row][$cell]['element'];
                        $i++;
                    }
                }
            }
        }
        Mage::getSingleton('core/session')->setChessElements($elements_objects);
        return $elements;
    }
    
    
    public function makeStep($data){
            $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
            $elements = Mage::getSingleton('core/session')->getChessElements();
            
            
            $from_ai=  array_search(substr($data['from'], -1), $alpha);
            $to_ai = array_search(substr($data['to'], -1), $alpha); 
            $from_n = substr($data['from'],0,1);
            $to_n = substr($data['to'],0,1);
            
            $beaten = Mage::helper('goodchess')->searchBeaten($from_n, $from_ai, $to_n, $to_ai);
            Mage::log($beaten, null, 'beaten_before.log');
            if($beaten != null){
                $beaten = $beaten[0] . $alpha[$beaten[1]];
                Mage::log($beaten, null, 'beaten_after.log');
            }
            
            foreach($elements as $key => $element){
                if($element->getPosition() == $data['from']){
                    $element->setPosition($data['to']);
                    $step['image'] = $element->getImage();
                }
                if($beaten){
                    if($element->getPosition() == $beaten){
                        
                        $step['remove'] = $beaten;
                        unset($elements[$key]);
                    }
                }
            }
            
            return $step;
    }
}


