<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
abstract class UserModel
{
    protected $id;
    
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var Contact 
     */
    protected $user;
    
    /**
     * True for owner and False for reviewer.
     * 
     * @var string
     */
    protected $userType;
    
    abstract public function getSentMessageSQL( $details );
    
    abstract public function getMessageSeenSQL( $details );
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId( $id )
    {
        $this->id = $id;
    }
    
    public function getName()
    {
        return $this->user->getString('first_name').' '.$this->user->getString('last_name');
    }
    
    public function setUser( $id )
    {
        $this->user = new Contact( $id );
        $this->setId( $id );
    }
    function getUserType()
    {
        return $this->userType;
    }
}