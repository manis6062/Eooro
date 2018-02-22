<?php

/**
 * Description of CustomPdo
 *
 * @author Subigya
 */
class MyPDO extends \PDO
{
    /**
     * Can be used only where "whereIn" is used.
     * 
     * @param string $statement
     * @param string $placeholder
     * @param string|array $replacementStringOrArray
     * @param array $driver_options
     * @return \PDOStatement
     */
//    public function prepare_wherein($statement, $placeholder, $replacementStringOrArray, $parameters = false,$driver_options = array(),$isBufered=true) {
//        
//        if(is_string($replacementStringOrArray)){
//            $replacement = explode(',', $replacementStringOrArray);
//        }
//        else if(is_array($replacementStringOrArray)){
//            $replacement = $replacementStringOrArray;
//        }
//        else {
//            throw new \InvalidArgumentException('Replacement should be an array or a string');
//        }
//        $no_of_parameters = count($replacement);
//        
//        $questionMarks = str_repeat('?,', $no_of_parameters -1).'?';
//        $parameter_count = count($parameters);
//        if($parameters){
//            foreach($parameters as $key=>$param){
//                $statement = str_replace($key, '?', $statement);
//            }
//        }
//        $statement = str_replace($placeholder, $questionMarks, $statement);
//        //added in order to handle buffered query
//        if($isBufered){
//            $prepared_statement = $this->prepare($statement, $driver_options);
//        }
//        else{
//            $prepared_statement = $this->prepare($statement, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
//        }
//        // bind values to the value tokens
//       $j=0;
//        if($parameters){    
//            foreach($parameters as $key=>$params){
//                $prepared_statement->bindParam($j+1,$params);
//                $j++;
//            }
//        }
//        
//         for($i=0; $i<$no_of_parameters; $i++){
//            $prepared_statement->bindParam($j+1, $replacement[$i]);
//            $j++;
//        }
//
//        return $prepared_statement;
//    }
    
    /**
     * @author Hari
     * Can be used only where "whereIn" is used.
     * 
     * @param string $statement
     * @param string $placeholder
     * @param string|array $replacementStringOrArray
     * @param array $driver_options
     * @param string $isBufered
     * @return \PDOStatement
     */
    public function prepare_wherein($statement, $placeholder, $replacementStringOrArray, $parameters = false,$driver_options = array(),$isBufered=true) {
        if(is_string($replacementStringOrArray)){
            $replacement = explode(',', $replacementStringOrArray);
        }
        else if(is_array($replacementStringOrArray)){
            $replacement = $replacementStringOrArray;
        }
        else {
            throw new \InvalidArgumentException('Replacement should be an array or a string');
        }
        $inPart=array();
         foreach ($replacement as $key => $value){
             $paramKey=":in_".$key;
             $inPart[]=$paramKey;
             $parameters[$paramKey]=$value;
         }
         $inPart=  implode(",", $inPart);
         $statement=str_replace($placeholder, $inPart, $statement);
         if($isBufered){
            $statement=$this->prepare($statement);
         }
         else{
            $statement = $this->prepare($statement, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
         }
         foreach ($parameters as $key => &$value) {
                $statement->bindParam($key, $value);
         }
         return $statement;
    }
    
}
