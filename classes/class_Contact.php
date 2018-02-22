<?

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
    #                                                                    #
    # This file may not be redistributed in whole or part.               #
    # eDirectory is licensed on a per-domain basis.                      #
    #                                                                    #
    # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
    #                                                                    #
    # http://www.edirectory.com | http://www.edirectory.com/license.html #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /classes/class_contact.php
    # ----------------------------------------------------------------------------------------------------

    class Contact extends Handle {

        var $account_id;
        var $updated;
        var $entered;
        var $first_name;
        var $last_name;
        var $company;
        var $address;
        var $address2;
        var $city;
        var $state;
        var $zip;
        var $country;
        var $phone;
        var $fax;
        var $email;
        var $url;

     // function Contact($var='') {
     //     if (is_numeric($var) && ($var)) {
     //         $db = db_getDBObject(DEFAULT_DB,true);;
     //         $sql = "SELECT * FROM Contact WHERE account_id = $var";
     //         $row = mysql_fetch_array($db->query($sql));
     //         $this->makeFromRow($row);
     //     }
     //     else {
     //           if (!is_array($var)) {
     //               $var = array();
     //           }
     //         $this->makeFromRow($var);
     //     }
     // }
                function __construct($var='') 
                {
                    if($var && is_numeric($var)){
                        try{
                            
                            $row = $this->getExistingRecord($var);
                            $this->makeFromRow($row);
                        }
                        catch (PDOException $e){
                            //handle
                        }
                    }
                    else {
                        if(!is_array($var)){
                            $var = array();
                        }
                        $this->makeFromRow($var);
                    }
                }

        function makeFromRow($row='') {
            
            // fixing user url field if needed.
            if (trim($row["url"]) != "" && $row["url_protocol"]) {
                if (string_strpos($row["url"], "://") !== false) {
                    $aux_url = explode("://", $row["url"]);
                    $aux_url = $aux_url[1];
                    $row["url"] = $aux_url;
                }
                $row["url"] = $row["url_protocol"] . $row["url"];
            }

            if ($row['account_id']) $this->account_id = $row['account_id'];
            else if (!$this->account_id) $this->account_id = 0;
            if ($row['entered']) $this->entered = $row['entered'];
            else if (!$this->entered) $this->entered = 0;
            if ($row['updated']) $this->updated = $row['updated'];
            else if (!$this->updated) $this->updated = 0;
            if ($row['first_name']) $this->first_name = $row['first_name'];
            else if (!$this->first_name) $this->first_name = "";
             if ($row['last_name']) $this->last_name = $row['last_name'];
            else if (!$this->last_name) $this->last_name = "";
            if ($row['company']) $this->company = $row['company'];
            else if (!$this->company) $this->company = "";
            if ($row['address']) $this->address = $row['address'];
            else if (!$this->address) $this->address = "";
            if ($row['address2']) $this->address2 = $row['address2'];
            else if (!$this->address2) $this->address2 = "";
            if ($row['city']) $this->city = $row['city'];
            else if (!$this->city) $this->city = "";
            if ($row['state']) $this->state = $row['state'];
            else if (!$this->state) $this->state = "";
            if ($row['zip']) $this->zip = $row['zip'];
            else if (!$this->zip) $this->zip = "";
             if ($row['country']) $this->country = $row['country'];
            else if (!$this->country) $this->country = "";
            if ($row['phone']) $this->phone = $row['phone'];
            else if (!$this->phone) $this->phone = "";
             if ($row['fax']) $this->fax = $row['fax'];
            else if (!$this->fax) $this->fax = "";
            if ($row['email']) $this->email = $row['email'];
            else if (!$this->email) $this->email = "";
            if ($row['url']) $this->url = $row['url'];
            else if (!$this->url) $this->url = "";
          // $this->first_name = $row['first_name'];
          // $this->last_name  = $row['last_name'];
          // $this->company    = $row['company'];
          // $this->address    = $row['address'];
          // $this->address2   = $row['address2'];
        //   $this->city       = $row['city'];
          // $this->state      = $row['state'];
        //   $this->zip        = $row['zip'];
         //  $this->country    = $row['country'];
        //   $this->phone      = $row['phone'];
           //$this->fax        = $row['fax'];
           // $this->email      = $row['email'];
           // $this->url        = $row['url'];





            // $this->first_name = $row['first_name'];
            // $this->last_name  = $row['last_name'];
            // $this->company    = "";
            // $this->address    = "";
            // $this->address2   = "";
            // $this->city       = "";
            // $this->state      = "";
            // $this->zip        = "";
            // $this->country    = "";
            // $this->phone      = "";
            // $this->fax        = "";
            // $this->email      = $row['email'];
            // $this->url        = "";
        }

                function Save()
                {
                    $record = $this->getExistingRecord($this->account_id);
                    if($record){
                        //update
                        return $this->update();
                    }
                    else {
                        //insert
                        return $this->insert();
                    }
                }
                
                private function update()
                {
                    $main = DBConnection::getInstance()->getMain();
                    return DBQuery::execute(function() use ($main){
                        $stmt = $main->prepare("UPDATE Contact SET"
                            . " updated = NOW(),"
                            . " entered = NOW(),"
                            . " first_name =:firstname,"
                            . " last_name =:lastname,"
                            . " company =:company,"
                            . " address =:address,"
                            . " address2 =:address2,"
                            . " city = :city,"
                            . " state = :state,"
                            . " zip = :zip,"
                            . " country = :country,"
                            . " phone = :phone,"
                            . " fax = :fax,"
                            . " email = :email,"
                            . " url = :url "
                            . " WHERE account_id = :account_id");
                        $parameters = array(
                            ':firstname' => $this->first_name,
                            ':lastname'  => $this->last_name,
                            ':company'   => $this->company,
                            ':address'   => $this->address,
                            ':address2'  => $this->address2,
                            ':city'      => $this->city,
                            ':state'     => $this->state,
                            ':zip'       => $this->zip,
                            ':country'   => $this->country,
                            ':phone'     => $this->phone,
                            ':fax'       => $this->fax,
                            ':email'     => $this->email,
                            ':url'       => $this->url,
                            ':account_id'=> $this->account_id
                            );
                        return $stmt->execute($parameters);
                    });
                }
                
                private function insert()
                {   
                
                 $main = DBConnection::getInstance()->getMain();
                    return DBQuery::execute(function() use ($main){
                        $stmt = $main->prepare("INSERT INTO Contact"
                            . " (account_id,
                                updated,
                                entered,
                                first_name,
                                last_name,
                                company,
                                address,
                                address2,
                                city, "
                            . "state, zip, country,phone, fax, email, url)"
                            . " VALUES"
                            . " (:account_id, NOW(), NOW(), :first_name, :last_name, :company, "
                            . ":address, :address2, :city, :state, :zip, :country,:phone, "
                            . ":fax, :email, :url)");
                        $parameters = array(
                            ':account_id'    => $this->account_id,
                            ':first_name'    => $this->first_name,
                            ':last_name'     => $this->last_name,
                            ':company'      => $this->company,
                            ':address'      => $this->address,
                            ':address2'     => $this->address2,
                            ':city'         => $this->city,
                            ':state'        => $this->state,
                            ':zip'          => $this->zip,
                            ':country'      => $this->country,
                            ':phone'        => $this->phone,
                            ':fax'          => $this->fax,
                            ':email'        => $this->email,
                            ':url'          => $this->url
                            
                        );
                        return $stmt->execute($parameters);
                        
                    });
                }
                
                private function getExistingRecord($account_id)
                {
                    return DBQuery::execute(function() use ($account_id){
                        $main = DBConnection::getInstance()->getMain();
                        $stmt = $main->prepare('SELECT * FROM Contact WHERE account_id=:account_id');
                        $stmt->bindParam(':account_id', $account_id);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        return $row;
                    });
                }
                
//      function Delete() {
//          $dbObj = db_getDBObject(DEFAULT_DB,true);;
//          $sql = "DELETE FROM Contact WHERE account_id = $this->account_id";
//          $dbObj->query($sql);
//      }

                function Delete()
                {
                    DBQuery::execute(function(){
                        $main = DBConnection::getInstance()->getMain();
                        $stmt = $main->prepare("DELETE FROM Contact WHERE account_id = :account_id");
                        $stmt->bindParam(':account_id', $this->account_id);
                        $stmt->execute();
                    });
                }
    }

?>