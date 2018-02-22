<?php

#!/usr/bin/php -q


	#----------------------------------------------------------------
	# 								Manual:
	#
	#			Put thisfilename "thisfilename.php"
	#			in /var/www/ or /var/www/html (whichever you have)
	#			This file should have permission 777 
	#			and should be executable +x
	#
	# 			Put the following in > Terminal > crontab -e
	# 			*/1 * * * *  /var/www/thisfilename.php
	#			This will run the cronjob every minute.
	#
	# 			For checking log run this :
	# 			sudo tail -f /var/log/syslog | grep CRON
	#			To get out of tail -f press Ctrl C
	#
	# 			Final output is filename called newfile.txt
	# 			in same directory. thisfilename.php is this file in 
	# 			root directory (var/www)
	#
	#--------------------------------------------------------------
/*
	chdir(dirname(__FILE__));
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "John Doe\n";
	fwrite($myfile, $txt);
	$txt = "Jane Doe\n";
	fwrite($myfile, $txt);
	fclose($myfile);
*/
?>

