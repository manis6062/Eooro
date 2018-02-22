<?php

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
	# * FILE: /members/billing/receipt.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	function writeLog( $log )
        {
            $filename   = EDIRECTORY_ROOT .'/custom/log/paypal-'. gmdate( 'Ymd' ) .'.txt';

            $logArray = getArray( $log );

            if ( file_exists( $filename ) ) {
                $handle = fopen( $filename, "a" );
                // no need to read title  $title  = fgetcsv($handle);
                // write log body
                fwrite($handle, $logArray);
                fclose( $handle );
            }
            else{
                $handle = fopen( $filename,"a+" );
                fwrite($handle, $logArray);
                fclose( $handle );
            }
        }
    
        function getArray( $obj )
        { $string = PHP_EOL;
            foreach ( $obj as $key => $value ){
                $string .= $key .'='. $value .' ';
            }
            return $string.PHP_EOL;
        }
//        writeLog( $_POST );
            
        include(INCLUDES_DIR."/code/billing_paypal.php");

?>
