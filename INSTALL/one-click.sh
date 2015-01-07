#!/bin/bash

apt-get install php5 php5-memcache php5-pgsql apache2 -y
cat vhost-demo > /etc/apache2/sites-available/a.www.mejoratuescuela.org.conf
a2enmod rewrite
cp -r ../../mte-v1.0/ /var/www/mte
a2ensite a.www.mejoratuescuela.org
a2dissite 000-default.conf
a2dissite default-ssl.conf
cp /etc/php5/apache2/php.ini /etc/php5/apache2/php.ini.bk
cat /etc/php5/apache2/php.ini.bk| sed -r "s/^short_open_tag( |=|Off)+$/short_open_tag = On/"> /etc/php5/apache2/php.ini
cd /var/www/
git clone https://github.com/mekler/mxnphp.git
service apache2 restart
