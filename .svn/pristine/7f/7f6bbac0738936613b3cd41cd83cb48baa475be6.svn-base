<?

/*
 * Tables Used : Review_login_credentials
 *
 */

class App extends Handle {

    public $id;
    public $listing_id;
    public $fullname;
    public $username;
    public $password;
    public $is_enable;

    /**
     * Insert the data user enters into table Review_login_credentials
     */
    public static function InsertUser($listing_id, $fullname, $username, $password, $email, $is_enable) {
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $listing_id, $fullname, $username, $password, $email, $is_enable) {
                    $app_id = Listing::getAppIdFromListingId($listing_id);
                    $listingDetails = Listing::GetListing($listing_id);
                    if (empty($app_id)) {
                        $listingObj = new Listing($listing_id);
                        $custom_dropdown5 = str_replace(' ', '', $listingDetails['title']);
                        $custom_dropdown5 = strtoupper($custom_dropdown5);
                        $custom_dropdown5 = substr($custom_dropdown5, 0, 3);
                        $custom_dropdown5 = $custom_dropdown5 . $listingDetails['location_1'];
                        $random_num = rand(1000, 9999);
                        $listingObj->custom_dropdown5 = $custom_dropdown5 . $random_num;
                        $listingObj->custom_dropdown5 = clean($listingObj->custom_dropdown5);
                        $listingObj->save();
                        $app_id = Listing::getAppIdFromListingId($listing_id);
                    }
                    $business_name = Listing::getBusinessNameFromListingId($listing_id);
                    if (empty($is_enable)) {
                        $is_enable = 'N';
                    }
                    $stmt = $main->prepare("INSERT INTO Review_login_credentials"
                            . " (listing_id,
                    fullname,
                    username,
                    password,
                    email,
                    is_enable,created_on,updated_on,app_id)"
                            . " VALUES"
                            . " (:listing_id,:fullname,:username,"
                            . ":password,:email,:is_enable ,NOW(),NOW(),:app_id)");
                    $parameters = array(
                        ':listing_id' => $listing_id,
                        ':fullname' => $fullname,
                        ':username' => $username,
                        ':password' => md5($password),
                        ':email' => $email,
                        ':is_enable' => $is_enable,
                        ':app_id' => $app_id);
                    $result = $stmt->execute($parameters);
                    if ($result) {
                        $inserted_id = $main->lastInsertId();
                        return $inserted_id;
                    }
                });
    }

    /**
     * Pagination from table Review_login_credentials
     */

    public static function GetUsersInfoSort($listing_id, $page, $number_of_results_per_page, $sort, $sort_order) {
        return DBQuery::execute(function() use ($listing_id, $page, $number_of_results_per_page, $sort, $sort_order) {
                    $main = DBConnection::getInstance()->getMain();
                    // whitelisting allowed order for sort
                    $allowed = array('id', 'fullname', 'username','email','is_locked', 'last_login_on','faillogin_count', 'is_enable');
                    $orderType = array('ASC', 'asc', 'DESC', 'desc');
                    if (in_array($sort, $allowed) && in_array($sort_order, $orderType)) {

                        $stmt = $main->prepare("SELECT id, fullname, username,is_locked,email, last_login_on,faillogin_count, is_enable
                    FROM Review_login_credentials WHERE listing_id = :listing_id 
                    ORDER BY `" . $sort . "` " . $sort_order
                                . " LIMIT :page,:no_of_res");
                        $stmt->bindParam(':listing_id', $listing_id);
                        $stmt->bindValue(':page', (int) $page, \PDO::PARAM_INT);
                        $stmt->bindValue(':no_of_res', (int) $number_of_results_per_page, \PDO::PARAM_INT);
                        $stmt->execute();

                        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    } else {
                        return false;
                    }
                });
    }

    
       /**
     * Pagination from table Review_login_credentials
     */
    
    public static function GetUsersInfoNoSort($listing_id, $page, $number_of_results_per_page) {
        return DBQuery::execute(function() use ($listing_id, $page, $number_of_results_per_page) {
                    $main = DBConnection::getInstance()->getMain();
                    $stmt = $main->prepare("SELECT id, fullname, username,email,is_locked, last_login_on,faillogin_count, is_enable
                    FROM Review_login_credentials WHERE listing_id = :listing_id  
                    ORDER BY id desc LIMIT :page,:no_of_res");
                    $stmt->bindParam(':listing_id', $listing_id);
                    $stmt->bindValue(':page', (int) $page, \PDO::PARAM_INT);
                    $stmt->bindValue(':no_of_res', (int) $number_of_results_per_page, \PDO::PARAM_INT);

                    $stmt->execute();
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                });
    }
    
       /**
     * Pagination from table Review_login_credentials
     */
    

    public static function GetTotalUsers($listing_id) {
        return DBQuery::execute(function() use ($listing_id) {
                    $main = DBConnection::getInstance()->getMain();
                    $stmt = $main->prepare("SELECT count(*) as totalusers "
                            . "FROM Review_login_credentials "
                            . "WHERE listing_id=:listing_id");
                    $stmt->bindParam(':listing_id', $listing_id);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                    if ($row) {
                        return $row['totalusers'];
                    } else {
                        return false;
                    }
                });
    }
    
    
      public static function checkListingExits($listing_id) {
        return DBQuery::execute(function() use ($listing_id) {
                    $main = DBConnection::getInstance()->getMain();
                    $stmt = $main->prepare("SELECT * "
                            . "FROM Review_login_credentials "
                            . "WHERE listing_id=:listing_id");
                    $stmt->bindParam(':listing_id', $listing_id);
                    $result = $stmt->execute();
                    if($result){
                          $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    if ($row) {
                        return $row;
                    } else {
                        return 0;
                    }
                        
                    }
                  
                });
    }
    
    
      public static function checkUniqueUsername($listing_id,$username,$id) {
        return DBQuery::execute(function() use ($listing_id,$username,$id) {
                    $main = DBConnection::getInstance()->getMain();
                    
                    if($id){
                         $stmt = $main->prepare("SELECT * "
                            . "FROM Review_login_credentials "
                            . "WHERE username=:username AND listing_id=:listing_id and id <> :id");
                         $stmt->bindParam(':id', $id);
                    }else{
                         $stmt = $main->prepare("SELECT * "
                            . "FROM Review_login_credentials "
                            . "WHERE username=:username AND listing_id=:listing_id");
                    }
                    
                    
                   
                    $stmt->bindParam(':listing_id', $listing_id);
                    $stmt->bindParam(':username', $username);
                    
                    
                     $result = $stmt->execute();
                    if ($result) {
                        $numRows = $stmt->rowCount();
                        if ($numRows > 0) {
                            return 1;
                        } else {
                            return 0;
                        }
                    }
                });
    }

    public static function getRowsWithId($id)
                {
                    return DBQuery::execute(function() use ($id){
                        $main = DBConnection::getInstance()->getMain();
                        $stmt = $main->prepare('SELECT * FROM Review_login_credentials WHERE id=:id');
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        return $row;
                    });
                }
    

}
