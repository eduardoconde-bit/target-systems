<?php
class StringTool {
    public static function reverse(string $chain):string
    { 
        $reverseChain = "";
        for($cont = (strlen($chain)-1); $cont >= 0; $cont--) {
            $reverseChain .= $chain[$cont];
        }
        return $reverseChain;
    }
}