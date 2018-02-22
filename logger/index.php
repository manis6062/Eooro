<?php
//include("../conf/loadconfig.inc.php");
include_once 'logconfig.php';
include_once 'logger.php';
include_once 'slog.php';
include_once 'userlog.php';
include_once 'mongodblogger.php';


$logConfig  = LogConfig::getInstance()->getConfig();
$logger     = new MongoDbLogger( 'userlogs', $logConfig['database'] );
$log        = new UserLog();

$logger->writeLog( $log->createLog() );
