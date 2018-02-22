<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class FacebookPlugin
{
    public function onUserReview( $eventObj, $eventName, $dispatcherObj )
    {
//        TODO: status update garne code hya cha.
//        
//        $userDetails = $this->getUserDetails();
//        if ( $userDetails ) {
//            // post details
//            $item       = $eventObj->getItem(); 
//            $review     = $eventObj->getReview();
//            $link       = DEFAULT_URL . '/listing/' . $item->getString('friendly_url') . '.html';
//            
//            // for Image
//            $image = "";
//            $imageObj = new Image( $item->getNumber("image_id"));
//            if ($imageObj->imageExists()) {
//                    $image = IMAGE_URL."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".string_strtolower($imageObj->getString("type"));
//            }
//            // to post on facebook
//            try{
//                $facebook = new Facebook();
//                $facebook->setSessionFromAccessToken();
//                    $facebookPost =  array(
//                            'access_token'  => $facebook->getAccessToken(),
//                            'message'       => $review->getString( 'review' ). '. '.
//                                               $review->getString( 'rating' ) . ' out of 5 Stars ',
//                            'name'          => $item->getString("title"),
//                            'caption'       => $item->getString("description"),
//                            'link'          => $link, 
//    //			'description'   => $item->getString("description"),
//                            'picture'       => $image
//
//                    );
//                    /**
//                     * 'status_update' => 'https://www.facebook.com/dialog/permissions.request?_path=permissions.request&'
//                                                . 'app_id=145634995501895&'
//                                                . 'redirect_uri=https%3A%2F%2Fwww.facebook.com%2Fconnect%2Flogin_success.html%3Fdisplay%3Dpage&response_type=token&fbconnect=1&'
//                                                . 'perms=status_update&from_login=1&m_sess=1&rcount=1'
//                     */
//                    $userId = $facebook->getUser();
//                    $response = $facebook->api('/'.$userId.'/feed', 'POST', $facebookPost);
//                    $response = implode("\n", $response);
//    //		return $response;;
//    //            var_dump( $eventObj );
//            }
//            catch ( Exception $ex ){
//                // handle it
//            }
//        }
//        else { // user is not logged in using facebook
//            return;
//        }
    }
    
    /**
     * To get facebook user id from session.
     */
    protected function getUserDetails()
    {
        $details = null;
        foreach ($_SESSION as $key => $value ){
            if ( preg_match( '/^fb_([a-zA-Z0-9_]+)$/', $key, $matches ) ) {
                $details[ $matches[1] ] = $value;
            }
        }
        return $details;
    }
}