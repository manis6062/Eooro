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
	# * FILE: /check_friendlyurl.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
    extract($_GET);
    $domain = DBConnection::getInstance()->getDomain();
    $main = DBConnection::getInstance()->getMain();
    DBQuery::execute(function() use ($main,$domain, $type, $friendly_url, $current_acc,$id) {
    if ($type == "profile") {
        $sql = $main->prepare("SELECT account_id FROM Profile WHERE friendly_url = :friendly_url AND account_id != :account_id");
        $parameters = array(
            ':friendly_url' => $friendly_url,
            ':account_id' => $current_acc
        );
        
        $sql->execute($parameters);
        $num_rows = $sql->rowCount();
       
        if ($num_rows > 0) {
            echo "not ok";
        } else {
            echo "ok";
        }

    }
    /**
     * @modification friendly_url
     */
    if ($type === "listings") {
        $sql = $domain->prepare("SELECT id FROM Listing WHERE friendly_url = :friendly_url  AND id != :id");
        $parameters = array(
            ':friendly_url'=>$friendly_url,
            ':id'=> $id
        );
        $sql->execute($parameters);
        $num_rows = $sql->rowCount();
        if ($num_rows > 0) {
            echo "not ok";
        }
        else{
            echo "ok";
        }
    }
    });