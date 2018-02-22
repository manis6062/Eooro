<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class Subscriber extends Handle
{
    protected $id;
    
    protected $first_name;
    
    protected $last_name;

    protected $email;
    
    protected $password;
    
    protected $is_active;
    
    protected $frequency;
    
    protected $type;
    
    protected $created_ts;
    
    protected $updated_ts;
    
    public function __construct( $var="", $domain_id = false )
    {
        if (is_numeric($var) && ($var)) {
            $db = $this->getDb( $domain_id );
            $sql = "SELECT * FROM NewsletterSubscribers WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));

            $this->makeFromRow($row);
        }
        else {
            if (!is_array($var)) {
                $var = (array)$var;
            }
            $this->makeFromRow( $var );
        }
    }
    
    /**
     * @todo check if the data ($row) is valid or not
     * @param array/object $row
     */
    function makeFromRow($row="") 
    {
        foreach( $row as $key => $value ){
            $this->$key = $value;
        }
    }
    
    function Save() {

        $dbObj = $this->getDb();

        $this->prepareToSave();
        $array = get_object_vars( $this );

	if ( is_numeric(trim($this->id, "'")) ) {
            // update code
            $sql = 'UPDATE NewsletterSubscribers SET ';
            foreach ( $array as $key => $values ){
                if ( $key !== 'id' ) {
                    $sql .= " ".$key."=".$values.",";
                }
            }
            $sql = rtrim( $sql, ',' );
            $sql .= " WHERE id=$this->id";
        }
        else {
            // insert code
            // splitting field name and values
            $field_names    = array_keys( $array );
            $field_values   = array_values( $array );
            
            $sql = "INSERT INTO NewsletterSubscribers (".implode(',', $field_names)
                    .") VALUES (".implode( ",", $field_values ).") ";           
        }
        $dbObj->query( $sql );
    }
    
    /**
     * Return falsey if not registered and truthy if registered
     * 
     * @param string $email
     * @return int 0 if not registered 1 if registered
     */
    function isEmailRegistered($email)
    {
        $dbObj = $this->getDb();

        $sql = "SELECT id FROM NewsletterSubscribers WHERE email='$email'";
        return $dbObj->numRowsQuery( $sql );
    }
}