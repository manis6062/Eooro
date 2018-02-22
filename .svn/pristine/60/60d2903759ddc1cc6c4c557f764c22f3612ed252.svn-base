logfile="cron.log"
folderpath="/var/www/vhosts/vps65937-6.lcnservers.com/httpdocs/10300/cron/"
DATE=`date +%Y-%m-%d:%H:%M:%S`
echo "${DATE} downloading geolite binary..." >> $folderpath$logfile                                    
wget -P $folderpath http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz
echo "${DATE} download complete !!" >> $folderpath$logfile
echo "${DATE} unzipping..." >> $folderpath$logfile
gunzip "${folderpath}GeoLiteCity.dat.gz"
echo "${DATE} unzipping completed !!" >> $folderpath$logfile
echo "${DATE} moving file..." >> $folderpath$logfile
rm -f /usr/share/GeoIP/GeoIPCity.dat
mv "${folderpath}GeoLiteCity.dat" /usr/share/GeoIP/GeoIPCity.dat
echo "${DATE} completed !!" >> $folderpath$logfile
