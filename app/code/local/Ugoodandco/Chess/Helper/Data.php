<?php
class Ugoodandco_Chess_Helper_Data extends Mage_Core_Helper_Abstract{

    public function getBoard(){
       $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
       $board = array();
       $position = 0;
       for($i = 1; $i <= 8; $i++){
           if($i > 1){
                    if($position == 0){
                        $position = 1;
                    }else{
                        $position = 0;
                    }
                }
            for($j = 0; $j < 8; $j++){
               
                
                if($j%2 == $position){
                    $type = 'w';
                }else{
                     $type = 'b';
                   
                }
                $board[$i][$alpha[$j]] = array(
                    'type' => $type,
                    'element' => null,
                );
            }
       }
       $board = array_reverse($board, true);
       if(!Mage::getSingleton('core/session')->getChessBoard()){
           Mage::getSingleton('core/session')->setChessBoard($board);
       }
       
       return $board;
    }
    
    public function searchBeaten($from_n, $from_ai, $to_n, $to_ai){
        
        $num_index = 0;
        $a_index = 0;
        if($from_n - $to_n > 1){
            $num_index = $from_n - 1;
        }
        
        if($to_n - $from_n > 1){
            $num_index = $from_n + 1;
        }
        
        if($from_ai - $to_ai > 1){
            $a_index = $from_ai - 1;
        }
        
        if($to_ai - $from_ai > 1){
            $a_index = $to_ai - 1;
        }
        
        if($a_index + $num_index > 0){
            return array($num_index, $a_index);
        }
        
        return null;
    }
    
    
}





