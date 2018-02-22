<?php
/**
 * A simple Array to xml Converter
 * 
 * @author          Subigya Jyoti Panta
 * @description     It converts multidimentional arrays to respective divisions
 *                  in xml.
 * @version         1.0
 * @copyright (c) 2014, www.eooro.com
 * @example         An array of the form :
 *              *                  array(
 *                                     'name'      => 'subigya',
 *                                     'sex'       => 'male',
 *                                     'clothes'   => array(
 *                                             'shirt'     => array('red','black'),
 *                                             'pant'      => 'blue'
 *                                     ),
 *                                     'hair'      => 'long'
 *                                 );
 *                  is converted to XML of the form:
 *                  <wrapper>
 *                      <name>subigya</name>
 *                      <sex>male</sex>
 *                      <clothes>
 *                          <shirt>
 *                              <item-0>red</item-0>
 *                              <item-1>black</item-1>
 *                          </shirt>
 *                          <pant>blue</pant>
 *                      </clothes>
 *                      <hair>long</hair>
 *                  </wrapper>
 */
class ArrayToXml
{
    /**
     * Array that is to be converted to xml
     * @var Array
     */
    protected $array;
    
    /**
     * @var SimpleXMLElement
     */
    protected $xml;
    
    /**
     * An object that converts given array to xml string or file
     * 
     * @param Array $array
     * @param String $wrapper It is the MAIN wrapper of the XML document. 
     *                        Similar to <html></html> in an HTML document.
     *                        In HTML document, $wrapper = 'html'.
     */
    public function __construct( $array, $wrapper )
    {
        $this->array    = $array;
        try {
            $wrapper    = "<$wrapper></$wrapper>";
            $this->xml  = new SimpleXMLElement( '<?xml version="1.0"?>'.$wrapper );
        }
        catch ( Exception $ex ) {
            echo $ex->getMessage() . ' --- You should provide a wrapper for your xml. --- ';
        }
    }
    
    /**
     * Sets the array that is to be converted to xml.
     * @param type $array
     */
    public function setArray( $array )
    {
        $this->array = $array;
    }
    
    /**
     * Returns current array, that can be converted to xml.
     * @return Array
     */
    public function getArray()
    {
        return $this->array;
    }
    
    /**
     * Returns xml string that is formed from the array.
     * @return string
     */
    public function getXmlString()
    {
        return $this->xml->asXML();
    }
    
    /**
     * Specify path and name where file is to be saved.
     * 
     * @param String $filename full path to filename
     */
    public function saveXml( $filename )
    {
        $this->xml->saveXML( $filename );
    }
    
    /**
     * Converts array to xml and returns $this object.
     * 
     * @return \ArrayToXml
     */
    public function convert( $convert_number_to_item_no = true )
    {
        $this->converter( $this->array, $this->xml, $convert_number_to_item_no );
        return $this;
    }


    /**
     * Converts the multidimentional array to xml.
     * 
     * @param array $arraySource
     * @param SimpleXMLElement $xml
     * @param boolean $no_to_item convert array with numeric key to item-1 or not.
     */
    protected function converter( $arraySource, &$xml, $no_to_item = true )
    {
        // converting algorithm
        foreach( $arraySource as $key => $value ){
            if ( is_array($value) ) {
                if ( !is_numeric($key) ) {
                    $subnode    = $xml->addChild( $key );
                    $this->converter( $value, $subnode );
                }
                else { // yes key is numeric
                    if ( $no_to_item ) {
                        $subnode    = $xml->addChild( 'item-'.$key );
                        $this->converter( $value, $subnode, $no_to_item );
                    }
                    else{
                        foreach ( $value as $item_key => $item_value ){
                            $subnode = $xml->addChild( $item_key );
                            $this->converter( $item_value, $subnode, $no_to_item );
                        }
                    }
                }
            }
            else {
//                if ( $no_to_item ) {
                    if ( !is_numeric($key) ) {
                        $xml->addChild( $key, $value );
                    }
                    else{ // yes it is... $key is number
                        $xml->addChild( 'item-'.$key, $value );
                    }
//                }
//                else{
//                    $xml->addChild( $key, $value );
//                }
            }
        }
    }
}